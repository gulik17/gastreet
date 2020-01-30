<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 13.02.17
 * Time: 13:20
 */
class DelOlimpicAction extends AdminkaAction {
    public function execute() {
        $id = Request::getInt("id");
        $com = new ChefOlimpicManager();
        $comObj = null;
        if ($id) {
            $comObj = $com->getById($id);
        }
        if (!$comObj) {
            Adminka::redirectBack("Запись не найдена");
        }
        $com->remove($id);
        Adminka::redirect("manageolimpic", "Запись удалена удален");
    }
}