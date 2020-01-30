<?php

/**
 *
 */
class SaveParthnerAction extends AdminkaAction {

    public function execute() {
        $doAct = "Партнер добавлен";

        $id = Request::getInt("id");
        $sortOrder = Request::getInt("sortOrder");
        $status = Request::getVar("status");
        $name = Request::getVar("name");
        $url = Request::getVar("url");
        $title = Request::getVar("title");
        $parthnerTypeId = Request::getInt("parthnerTypeId");

        $pm = new ParthnerManager();
        $pmObj = null;
        if ($id) {
            $pmObj = $pm->getById($id);
        }
        if (!$pmObj) {
            $pmObj = new Parthner();
        } else {
            $doAct = "Партнер отредактирован";
        }

        $url = strtolower($url);
        if (strpos($url, 'http://') === false && strpos($url, 'https://') === false) {
            $url = 'http://' . $url;
        }

        $pmObj->sortOrder = $sortOrder;
        $pmObj->status = $status;
        $pmObj->name = $name;
        $pmObj->url = $url;
        $pmObj->title = $title;
        $pmObj->tsUpdate = time();
        $pmObj->parthnerTypeId = $parthnerTypeId;

        $pmObj = $pm->save($pmObj);

        // был ли добавлен файл
        $fileNameParam = 'file1';
        if (Request::isFile($fileNameParam)) {
            require_once APPLICATION_DIR . "/Lib/resize.class.php";

            $image = new UploadedFile($fileNameParam);
            $file = $pmObj->id . "." . $image->extension;
            $image->rename($file);
            $image->saveTo(Configurator::get("application:parthnersFolder") . "resized/");
            
            $pmObj->pic = $file;
            $pmObj = $pm->save($pmObj);
            
            
            //$image->saveTo(Configurator::get("application:parthnersFolder") . "uploaded/");

            /*
            // сделаем копию
            $w = 350;
            $h = 290;
            $fullFileName = Configurator::get("application:parthnersFolder") . "uploaded/" . $file;
            if (file_exists($fullFileName)) {
                @unlink(Configurator::get("application:parthnersFolder") . "resized/" . $file);
                $newFileName = Configurator::get("application:parthnersFolder") . "resized/" . $file;
                try {
                    $obj = new Resize($fullFileName);
                    $obj->setNewImage($newFileName);
                    $obj->setProportionalFlag('H');
                    $obj->setProportional(1);
                    $obj->setNewSize($h, $w);
                    $obj->make();
                } catch (Exception $e) {
                    Logger::error($e);
                }
            }*/
        }

        Adminka::redirect("manageparthners", $doAct);
    }

}
