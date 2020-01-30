<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 14.02.17
 * Time: 11:13
 */
class DelAreaTypeAction extends AdminkaAction {

    public function execute() {
        $id = Request::getInt("id");

        $atm = new AreaTypeManager();
        if ($id) {
            $atmObj = $atm->getById($id);
        }
        if (!$atmObj) {
            Adminka::redirectBack("Тип программы не найден");
        }

        $atm->remove($id);

        Adminka::redirect("manageareatype", "Тип программы удален");
    }

}
