<?php

/**
 *
 */
class SaveSpeakerAction extends AdminkaAction {
    public function execute() {
        $doAct = "Спикер добавлен";

        $id = Request::getInt("id");
        $sortOrder = Request::getInt("sortOrder");
        $status = Request::getVar("status");
        $country = Request::getVar("country");
        $name = Request::getVar("name");
        $secondName = Request::getVar("secondName");
        $name_en = Request::getVar("name_en");
        $secondName_en = Request::getVar("secondName_en");
        $company = preg_replace('/\&quot;([^\"]*)\&quot;/ismU', "«$1»", Request::getVar("company"));
        $company_en = preg_replace('/\&quot;([^\"]*)\&quot;/ismU', "«$1»", Request::getVar("company_en"));
        $position = Request::getVar("position");
        $position_en = Request::getVar("position_en");
        $cityName = Request::getVar("cityName");
        $cityName_en = Request::getVar("cityName_en");
        $description = Request::getVar("description");
        $description_en = Request::getVar("description_en");
        $tags = Request::getVar("tags");
        $years = Request::getVar("years");
        $partner_id = Request::getInt("partner_id");
        $michelin = Request::getInt("michelin");
        $facebook = Request::getVar("facebook");
        $vk = Request::getVar("vk");
        $instagram = Request::getVar("instagram");
        $twitter = Request::getVar("twitter");
        $site = Request::getVar("site");

        if (!$name) {
            Adminka::redirectBack("Незаполнено Имя спикера");
        }

        $sm = new SpeakerManager();
        $smObj = null;

        if ($id) {
            $smObj = $sm->getById($id);
        }

        if (!$smObj) {
            $smObj = new Speaker();
            $smObj->tsCreated = time();
        } else {
            $doAct = "Спикер отредактирован";
        }

        $smObj->sortOrder = $sortOrder;
        $smObj->status = $status;
        $smObj->country = $country;
        $smObj->name = $name;
        $smObj->secondName = $secondName;
        $smObj->name_en = $name_en;
        $smObj->secondName_en = $secondName_en;
        $smObj->company = $company;
        $smObj->company_en = $company_en;
        $smObj->position = $position;
        $smObj->position_en = $position_en;
        $smObj->cityName = $cityName;
        $smObj->cityName_en = $cityName_en;
        $smObj->description = $description;
        $smObj->description_en = $description_en;
        $smObj->tags = $tags;
        $smObj->years = $years;
        $smObj->partner_id = $partner_id;
        $smObj->michelin = $michelin;
        $smObj->facebook = $facebook;
        $smObj->vk = $vk;
        $smObj->instagram = $instagram;
        $smObj->twitter = $twitter;
        $smObj->site = $site;
        $smObj->tsUpdated = time();

        $smObj = $sm->save($smObj);

        // image (X)
        $fileNameParam = 'file1';
        if (Request::isFile($fileNameParam)) {
            $image = new UploadedFile($fileNameParam);
            $file = $smObj->id . "." . $image->extension;
            $image->rename($file);
            $image->saveTo(Configurator::get("application:speackersFolder") . "resized/");
            
            $smObj->pic1 = $file;
            $smObj = $sm->save($smObj);
        }
        
        $fileNameParam = 'file2';
        if (Request::isFile($fileNameParam)) {
            $image = new UploadedFile($fileNameParam);
            $file = $smObj->id . "_app." . $image->extension;
            $image->rename($file);
            $image->saveTo(Configurator::get("application:speackersFolder") . "resized/");
            
            $smObj->pic_app = $file;
            $smObj = $sm->save($smObj);
        }

        if (strpos($smObj->tags, '2019') !== false) {
            $eventicious = new Eventicious();
            $eventicious->setHost(Configurator::get("eventicious:host"));
            $eventicious->setCode(Configurator::get("eventicious:code"));

            if ($smObj->status == Speaker::STATUS_ENABLED) {
                // Т.к. инфу о наличии записи получить нет возможности, пробуем отредактировать
                $result = $eventicious->speakersUpdate(
                            $smObj->id + 1000000, // т.к. спикеры и участники находятся в обной таблице, чтобы их ID не переселись при редактировании, нужно ID спикеров накрутить на 1 000 000
                            $smObj->name,
                            $smObj->secondName,
                            htmlspecialchars_decode($smObj->company, ENT_NOQUOTES),
                            $smObj->position,
                            $smObj->cityName,
                            $smObj->vk,
                            $smObj->twitter,
                            $smObj->facebook,
                            htmlspecialchars_decode($smObj->description, ENT_NOQUOTES));
                // Проверяем код ответа сервера на запрос редактирования записи
                if ($result['result_code'] == 200) {
                    $mes = "Eventicious: ID $smObj->id Отредактирован";
                }

                // Если редактируемая запись не была найдена, сервер приложения вернет код 404 (НО ЭТОТ ПИДР КАКОГО ТО ХУЯ ВОРАЧИВАЕТ 400)
                if ($result['result_code'] == 400) {
                    // Создаем запись
                    $result = $eventicious->speakersCreate(
                            $smObj->id + 1000000,
                            $smObj->name,
                            $smObj->secondName,
                            htmlspecialchars_decode($smObj->company, ENT_NOQUOTES),
                            $smObj->position,
                            $smObj->cityName,
                            $smObj->vk,
                            $smObj->twitter,
                            $smObj->facebook,
                            "",
                            "",
                            htmlspecialchars_decode($smObj->description, ENT_NOQUOTES),
                            true,
                            "https://gastreet.com/images/speackers/resized/".$smObj->pic_app."?v=".$smObj->tsUpdated);
                    $mes = "Eventicious: ID $smObj->id Создан";
                }

                // Пишем НЕизвестную ошибку в логи
                if ( ($result['result_code'] != 400) && ($result['result_code'] != 200) ) {
                    $mes = "Eventicious: ID $smObj->id Ошибка " . $result['result_code'] . " См. логи";
                    Logger::error($mes);
                    Logger::error($result);
                }
            } else {
                $result = $eventicious->speakersDelete($smObj->id + 1000000);
                if ($result['result_code'] == 200) {
                    $mes = "Eventicious: ID $smObj->id Удален";
                } else if ($result['result_code'] == 400) {
                    $mes = "Eventicious: ID $smObj->id Ненайден";
                } else {
                    $mes = "Eventicious: ID $smObj->id Ошибка: " . $result['result_code'];
                }
            }
        } else {
            $mes = "Eventicious: Не синхронизируется";
        }
        Adminka::redirect("managespeakers", $doAct.'<br>'.$mes);
    }
}