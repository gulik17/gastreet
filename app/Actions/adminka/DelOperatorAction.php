<?php

class DelOperatorAction extends AdminkaAction {
    public function execute() {
        $id = Request::getInt("id");
        $om = new OperatorManager();
        if ($id) {
            $omObj = $om->getById($id);
        }
        if (!$omObj) {
            Adminka::redirectBack("Оператор не найден");
        }
        $om->remove($id);
        Adminka::redirect("manageoperators", "Оператор удален");
    }
}