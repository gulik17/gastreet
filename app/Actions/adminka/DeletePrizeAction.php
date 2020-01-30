<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 13.02.17
 * Time: 12:49
 */
class DeletePrizeAction extends AdminkaAction {
    public function execute() {
        $id = Request::getInt("id");
        $pm = new PrizeManager();
        if ($id) {
            $pmObj = $pm->getById($id);
        }
        if (!$pmObj) {
            Adminka::redirectBack("Новость не найдена");
        }
        $pm->delPrize($id);
        Adminka::redirect("manageprizes", "Новость удалена");
    }
}