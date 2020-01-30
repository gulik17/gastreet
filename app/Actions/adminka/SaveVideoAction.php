<?php

class SaveVideoAction extends AdminkaAction {
    public function execute() {
        $doAct = "Видеоролик добавлен";
        $id = Request::getInt("id");
        $v_group = Request::getInt("v_group");
        $sortOrder = Request::getInt("sortOrder");
        $status = Request::getVar("status");
        $name = Request::getVar("name");
        $name_en = Request::getVar("name_en");
        $url = Request::getVar("url");

        $vm = new VideoManager();
        $vmObj = null;
        if ($id) {
            $vmObj = $vm->getById($id);
        }
        if (!$vmObj) {
            $vmObj = new Video();
        } else {
            $doAct = "Спикер отредактирован";
        }

        $vmObj->v_group = $v_group;
        $vmObj->sortOrder = $sortOrder;
        $vmObj->status = $status;
        $vmObj->name = $name;
        $vmObj->name_en = $name_en;
        $vmObj->url = $url;

        $vmObj = $vm->save($vmObj);

        // был ли добавлен файл
        $fileNameParam = 'file1';
        if (Request::isFile($fileNameParam)) {
            require_once APPLICATION_DIR . "/Lib/resize.class.php";

            $file = $vmObj->id . ".jpg";
            $image = new UploadedFile($fileNameParam);
            $image->rename($file);
            $image->saveTo(Configurator::get("application:videoFolder") . "uploaded/");

            // сделаем копию
            $w = 360;
            $h = 197;
            $fullFileName = Configurator::get("application:videoFolder") . "uploaded/" . $file;
            if (file_exists($fullFileName)) {
                @unlink(Configurator::get("application:videoFolder") . "resized/" . $file);
                $newFileName = Configurator::get("application:videoFolder") . "resized/" . $file;
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

        Adminka::redirect("managevideo", $doAct);
    }
}