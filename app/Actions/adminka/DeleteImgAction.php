<?php

/**
 *
 */
class DeleteImgAction extends AdminkaAction {

    public function execute() {
        $doAct = "Изображение удалено";
        $id = Request::getInt("id");
        $file = Request::getVar("file");
        $item = Request::getVar("item");
        if (!$id) {
            Adminka::redirectBack("Не задан ID изображения");
        }
        if ($item == 'products') {
            $folder = Configurator::get("application:productsFolder");
        } else if ($item == 'speackers') {
            $folder = Configurator::get("application:speackersFolder");
        } else if ($item == 'volunteer') {
            $folder = Configurator::get("application:volunteersFolder");
        } else {
            Adminka::redirectBack("Ошибка имени задания");
        }
        
        if (!$file) {
            @unlink($folder . "uploaded/" . $id . ".jpg");
            @unlink($folder . "resized/" . $id . ".jpg");
        } else {
            @unlink($folder . "uploaded/" . $file);
            @unlink($folder . "resized/" . $file);
        }

        Adminka::redirectBack($doAct);
    }
}