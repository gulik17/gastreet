<?php

/**
 *
 */
class SaveProductAction extends AdminkaAction {
    public function execute() {
        $doAct = "Продукт добавлен";
        $id = Request::getInt("id");
        $status = Request::getVar("status");
        $showInSchedule = Request::getVar("showInSchedule");
        $name = Request::getVar("name");

        $firstName = Request::getVar("firstName");
        $secondName = Request::getVar("secondName");
        $company = Request::getVar("company");
        $position = Request::getVar("position");
        $cityName = Request::getVar("cityName");

        $price = Request::getVar("price");
        $maxCount = Request::getVar("maxCount");
        $placeId = Request::getInt("placeId");
        $areaId = Request::getInt("areaId");
        $speakerId = Request::getInt("speakerId");
        $speaker2Id = Request::getInt("speaker2Id");
        $speaker3Id = Request::getInt("speaker3Id");
        $speaker4Id = Request::getInt("speaker4Id");
        $speaker5Id = Request::getInt("speaker5Id");
        $speaker6Id = Request::getInt("speaker6Id");
        $partner_id = Request::getInt("partner_id");

        $startDay = Request::getInt("startDay");
        $startMonth = Request::getInt("startMonth");
        $startYear = Request::getInt("startYear");
        $startHours = Request::getInt("startHours");
        $startMinutes = Request::getInt("startMinutes");

        $finishDay = Request::getInt("finishDay");
        $finishMonth = Request::getInt("finishMonth");
        $finishYear = Request::getInt("finishYear");
        $finishHours = Request::getInt("finishHours");
        $finishMinutes = Request::getInt("finishMinutes");

        $description = Request::getVar("description");
        $youtube = Request::getVar("youtube");
        $tags = Request::getVar("tags");
        $tag_desc = Request::getVar("tag_desc");

        //$price = floatval(str_replace(',', '.', $price));

        $eventTsStart = null;
        if ($startDay && $startMonth && $startYear) {
            $eventTsStart = strtotime($startMonth . '/' . $startDay . '/' . $startYear . ' ' . $startHours . ':' . $startMinutes . ':00');
        }

        $eventTsFinish = null;
        if ($finishDay && $finishMonth && $finishYear) {
            $eventTsFinish = strtotime($finishMonth . '/' . $finishDay . '/' . $finishYear . ' ' . $finishHours . ':' . $finishMinutes . ':00');
        }

        if (!$eventTsStart) {
            $eventTsStart = time();
        }

        if (!$eventTsFinish) {
            $eventTsFinish = time();
        }

        $oldProductStatus = null;
        $pm = new ProductManager();
        $pmObj = null;
        if ($id) {
            $pmObj = $pm->getById($id);
            if ($pmObj) {
                $oldProductStatus = $pmObj->status;
            }
        }
        if (!$pmObj) {
            $pmObj = new Product();
        } else {
            $doAct = "Продукт отредактирован";
        }

        if ($pmObj->price && $price != $pmObj->oldPrice && $price != $pmObj->price) {
            $pmObj->oldPrice = $pmObj->price;
        }

        $pmObj->status = $status;
        $pmObj->showInSchedule = ($showInSchedule == 'on') ? 1 : 0;

        if ($id && $pmObj->name != $name) {
            // проапдейтить в корзинах наименование данного МК
            $bpm = new BasketProductManager();
            $bpm->updateProductName($id, $name);
        }

        $pmObj->name = $name;
        $pmObj->firstName = $firstName;
        $pmObj->secondName = $secondName;
        $pmObj->cityName = $cityName;
        $pmObj->company = $company;
        $pmObj->position = $position;
        $pmObj->price = $price;
        $pmObj->maxCount = $maxCount;
        $pmObj->placeId = $placeId;
        $pmObj->areaId = $areaId;
        $pmObj->speakerId = $speakerId;
        $pmObj->speaker2Id = $speaker2Id;
        $pmObj->speaker3Id = $speaker3Id;
        $pmObj->speaker4Id = $speaker4Id;
        $pmObj->speaker5Id = $speaker5Id;
        $pmObj->speaker6Id = $speaker6Id;
        $pmObj->partner_id = $partner_id;
        $pmObj->description = $description;
        $pmObj->youtube = $youtube;
        $pmObj->tags = $tags;
        $pmObj->tag_desc = $tag_desc;
        $pmObj->eventTsStart = $eventTsStart;
        $pmObj->eventTsFinish = $eventTsFinish;
        $pmObj->tsUpdate = time();
        $pmObj = $pm->save($pmObj);

        // был ли добавлен файл
        $fileNameParam = 'file1';
        if (Request::isFile($fileNameParam)) {
            $image = new UploadedFile($fileNameParam);
            $file = $pmObj->id . "." . $image->extension;
            $image->rename($file);
            $image->saveTo(Configurator::get("application:productsFolder") . "resized/");
            $pmObj->pic1 = $file;
            $pmObj = $pm->save($pmObj);
        }

        // image (X_b)
        $fileNameParam = 'file2';
        if (Request::isFile($fileNameParam)) {
            $image = new UploadedFile($fileNameParam);
            $file = $pmObj->id . "_b." . $image->extension;
            $image->rename($file);
            $image->saveTo(Configurator::get("application:productsFolder") . "resized/");
            $pmObj->pic2 = $file;
            $pmObj = $pm->save($pmObj);
        }

        // переколбасить Name в корзинах (productName в basketProduct) и переколбасить productStatus там же
        $bpm = new BasketProductManager();
        $bpm->updateProductNameAndStatus($pmObj->id, $pmObj->name, $pmObj->status);
        $bpm->updateProductName($pmObj->id, $pmObj->name, $pmObj->eventTsStart, $pmObj->eventTsFinish);
        
        // если статус поменялся на "Отмена"
        if ($oldProductStatus && $oldProductStatus != $status && $pmObj->status == Product::STATUS_CANCELED) {
            $qm = new QueueMysqlManager();
            $qm->savePlaceTask("notifyproductcancel", null, serialize(array("productId" => $pmObj->id, "productName" => base64_encode($pmObj->name), "productStatus" => $pmObj->status)));
        }

        $eventicious = new Eventicious();
        $eventicious->setHost(Configurator::get("eventicious:host"));
        $eventicious->setCode(Configurator::get("eventicious:code"));

        if ($pmObj->status == Product::STATUS_ENABLED) {
            $speakersIds = array();
            if ($pmObj->speakerId > 0) {
                $speakersIds[] = $pmObj->speakerId + 1000000;
            }
            if ($pmObj->speaker2Id > 0) {
                $speakersIds[] = $pmObj->speaker2Id + 1000000;
            }
            if ($pmObj->speaker3Id > 0) {
                $speakersIds[] = $pmObj->speaker3Id + 1000000;
            }
            if ($pmObj->speaker4Id > 0) {
                $speakersIds[] = $pmObj->speaker4Id + 1000000;
            }
            if ($pmObj->speaker5Id > 0) {
                $speakersIds[] = $pmObj->speaker5Id + 1000000;
            }
            if ($pmObj->speaker6Id > 0) {
                $speakersIds[] = $pmObj->speaker6Id + 1000000;
            }

            $locationsIds[] = $pmObj->placeId;
            // "2014-07-24T18:00"
            $startTime = date('Y-m-d\TH:i', $pmObj->eventTsStart);
            $endTime = date('Y-m-d\TH:i', $pmObj->eventTsFinish);

            // Т.к. инфу о наличии записи получить нет возможности, пробуем отредактировать
            // $id, $title, $description, $startTime, $endTime, $trackId, $speakersIds, $locationsIds, $style, $language = "ru-RU"
            $result = $eventicious->sessionsUpdate(
                    $pmObj->id,
                    strip_tags(htmlspecialchars_decode($pmObj->name, ENT_NOQUOTES)),
                    htmlspecialchars_decode($pmObj->description, ENT_NOQUOTES),
                    $startTime,
                    $endTime,
                    $pmObj->areaId,
                    $speakersIds,
                    $locationsIds,
                    0);
            // Проверяем код ответа сервера на запрос редактирования записи

            if ($result['result_code'] == 200) {
                $mes = "Eventicious: ID $pmObj->id Отредактирован";
            }

            // Если редактируемая запись не была найдена, сервер приложения вернет код 400
            if ($result['result_code'] == 400) {
                // Создаем запись
                $result = $eventicious->sessionsCreate(
                        $pmObj->id,
                        strip_tags(htmlspecialchars_decode($pmObj->name, ENT_NOQUOTES)),
                        htmlspecialchars_decode($pmObj->description, ENT_NOQUOTES),
                        $startTime,
                        $endTime,
                        $pmObj->areaId,
                        $speakersIds,
                        $locationsIds,
                        0);
                $mes = "Eventicious: ID $pmObj->id Создан";
            }

            if ($result['result_code'] == 400) {
                $mes = $result['content']->message;
            }

            // Пишем НЕизвестную ошибку в логи
            if ( ($result['result_code'] != 400) && ($result['result_code'] != 200) ) {
                $mes = "Eventicious: ID $pmObj->id Ошибка " . $result['result_code'] . " См. логи";
                Logger::error($mes);
                Logger::error($result);
            }
            if ( ($pmObj->leftCount > 0) && ($pmObj->price > 0) ) {
                if ($result['result_code'] == 200) {
                    $result = $eventicious->sessionsAttachmentsUpdate($pmObj->id, 'Купить', 'https://gastreet.com/index.php?do=add&product='.$pmObj->id, $pmObj->id);
                    if ($result['result_code'] == 200) {
                        $mes .= "Eventicious: ID $pmObj->id Ссылка отредактированна"."<br>";
                    }
                    if ($result['result_code'] == 400) {
                        $result = $eventicious->sessionsAttachmentsCreate($pmObj->id, 'Купить', 'https://gastreet.com/index.php?do=add&product='.$pmObj->id, $pmObj->id);
                        if ($result['result_code'] == 200) {
                            $mes .= "Eventicious: ID $pmObj->id Сссылка добавлена"."<br>";
                        }
                    }
                }
            }
        } else {
            $result = $eventicious->sessionsDelete($pmObj->id);
            // Проверяем код ответа сервера на запрос редактирования записи
            if ($result['result_code'] == 200) {
                $mes = "Eventicious: ID $pmObj->id Удален";
                $eventicious->sessionsAttachmentsDelete($pmObj->id, $pmObj->id);
            } else if ($result['result_code'] == 400) {
                $mes = "Eventicious: ID $pmObj->id Ненайден";
            } else {
                $mes = "Eventicious: ID $pmObj->id Ошибка: " . $result['result_code'];
            }
        }
        
        Adminka::redirect("manageproducts", $doAct.'<br>'.$mes);
    }
}