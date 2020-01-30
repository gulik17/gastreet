<?php

/**
 *
 */
class AdminDelProductAction extends AdminkaAction {

    public function execute() {
        $doAct = "Продукт удален";
        $id = Request::getInt("id");
        if (!$id) {
            Adminka::redirectBack("Не задан ID продукта");
        }

        $pm = new ProductManager();
        $pmObj = $pm->getById($id);
        if (!$pmObj) {
            Adminka::redirectBack("Продукт не найден");
        }

        // проверить нет ли данного товара в корзинах, если есть, то удалить его нельзя
        $bpm = new BasketProductManager();
        $bpmUserIds = $bpm->getUserIdsByProductId($id);
        if ($bpmUserIds) {
            Adminka::redirectBack("Нельзя удалить продукт, т.к. он есть в корзинах у пользователях");
        }

        $pm->remove($id);

        @unlink(Configurator::get("application:productsFolder") . "uploaded/" . $id . ".jpg");
        @unlink(Configurator::get("application:productsFolder") . "resized/" . $id . ".jpg");

        Adminka::redirect("manageproducts", $doAct);
    }
}