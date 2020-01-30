<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 13.02.17
 * Time: 12:49
 */
class DelVideoAction extends AdminkaAction {
    public function execute() {
        $id = Request::getInt("id");
        $vm = new VideoManager();
        if ($id) {
            $vmObj = $vm->getById($id);
        }
        if (!$vmObj) {
            Adminka::redirectBack("Видеоролик не найден");
        }
        $vm->delVideo($id);
        Adminka::redirect("managevideo", "Видеоролик удален");
    }
}