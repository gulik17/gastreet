<?php

/**
 *
 */
class SavePlaceAction extends AdminkaAction {

    public function execute() {
        $doAct = "Место проведения добавлено";

        $id = Request::getInt("id");
        $sortOrder = Request::getInt("sortOrder");
        $status = Request::getVar("status");
        $name = Request::getVar("name");
        $name_en = Request::getVar("name_en");
        $suptitle = Request::getVar("suptitle");
        $subtitle = Request::getVar("subtitle");
        $phone = Request::getVar("phone");
        $email = Request::getVar("email");
        $stars = Request::getInt("stars");
        $level = Request::getVar("level");
        $price = Request::getVar("price");
        $description = Request::getVar("description");
        $description_en = Request::getVar("description_en");
        $modal_desc = Request::getVar("modal_desc");
        $modal_desc_en = Request::getVar("modal_desc_en");
        $pic1 = Request::getVar("pic1");
        $videoUrl = Request::getVar("videoUrl");
        $inclusive = Request::getArray("inclusive");
        $notinclusive = Request::getArray("notinclusive");
        
        $array = [0,0,0,0,0,0,0];
        if ($inclusive) {
            foreach ($inclusive as &$in) {
                $array[$in] = $in;
            }
        }
        $inclusive = $array;
        
        $array = [0,0,0,0,0,0,0];
        if ($notinclusive) {
            foreach ($notinclusive as &$in) {
                $array[$in] = $in;
            }
        }
        $notinclusive = $array;

        $plm = new PlaceManager();
        $plmObj = null;
        if ($id) {
            $plmObj = $plm->getById($id);
        }
        if (!$plmObj) {
            $plmObj = new Place();
        } else {
            $doAct = "Место проведения отредактировано";
        }

        $plmObj->sortOrder = $sortOrder;
        $plmObj->status = $status;
        $plmObj->name = $name;
        $plmObj->name_en = $name_en;
        $plmObj->suptitle = $suptitle;
        $plmObj->subtitle = $subtitle;
        $plmObj->phone = $phone;
        $plmObj->email = $email;
        $plmObj->inclusive = serialize($inclusive);
        $plmObj->notinclusive = serialize($notinclusive);
        $plmObj->stars = $stars;
        $plmObj->level = $level;
        $plmObj->price = $price;
        $plmObj->description = $description;
        $plmObj->description_en = $description_en;
        $plmObj->modal_desc = $modal_desc;
        $plmObj->modal_desc_en = $modal_desc_en;
        $plmObj->pic1 = $pic1;
        $plmObj->videoUrl = $videoUrl;
        $plmObj = $plm->save($plmObj);

        // был ли добавлен файл
        $fileNameParam = 'file1';
        if (Request::isFile($fileNameParam)) {
            require_once APPLICATION_DIR . "/Lib/resize.class.php";

            $file = $plmObj->id . ".jpg";
            $image = new UploadedFile($fileNameParam);
            $image->rename($file);
            $image->saveTo(Configurator::get("application:placesFolder") . "uploaded/");

            // сделаем копию
            $w = 510;
            $h = 223;
            $fullFileName = Configurator::get("application:placesFolder") . "uploaded/" . $file;
            if (file_exists($fullFileName)) {
                @unlink(Configurator::get("application:placesFolder") . "resized/" . $file);
                $newFileName = Configurator::get("application:placesFolder") . "resized/" . $file;
                try {
                    $obj = new Resize($fullFileName);
                    $obj->setNewImage($newFileName);
                    $obj->setProportionalFlag('A');
                    $obj->setProportional(1);
                    $obj->setNewSize($h, $w);
                    $obj->make();
                } catch (Exception $e) {
                    Logger::error($e);
                }
            }
        }
        
        $eventicious = new Eventicious();
        $eventicious->setHost(Configurator::get("eventicious:host"));
        $eventicious->setCode(Configurator::get("eventicious:code"));
        
        // Это сообщение должно замениться, если этого не произойдет, то значит была ошибка
        $mes = "Eventicious: ID $plmObj->id Ошибка";

        // Т.к. инфу о наличии записи получить нет возможности, пробуем отредактировать
        $result = $eventicious->locationsUpdate($plmObj->id, $plmObj->id, $plmObj->name);
        // Проверяем код ответа сервера на запрос редактирования записи
        if ($result['result_code'] == 200) {
            $mes = "Eventicious: ID $plmObj->id Отредактирован";
        }

        // Если редактируемая запись не была найдена, сервер приложения вернет код 404
        if ($result['result_code'] == 404) {
            // Создаем запись
            $result = $eventicious->locationsCreate($plmObj->id, $plmObj->id, $plmObj->name);
            $mes = "Eventicious: ID $plmObj->id Создан";
        }

        // Пишем НЕизвестную ошибку в логи
        if ( ($result['result_code'] != 404) && ($result['result_code'] != 200) ) {
            Logger::error($mes);
            Logger::error($result);
        }

        Adminka::redirect("manageplaces", $doAct."<br>".$mes);
    }
}