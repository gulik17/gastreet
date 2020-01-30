<?php

class DelRealEmailAction extends AdminkaAction {
    public function execute() {
        $id = Request::getInt("id");
        $rem = new RealEmailManager();
        if ($id) {
            $remObj = $rem->getById($id);
        }
        if (!$remObj) {
            Adminka::redirectBack("Ящик не найден");
        }
        $rem->remove($id);
        Adminka::redirect("managerealemail", "Ящик удален");
    }
}