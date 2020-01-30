<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 13.02.17
 * Time: 13:20
 */
class DelFaqAction extends AdminkaAction {
    public function execute() {
        $id = Request::getInt("id");
        $fm = new FaqManager();
        $fmObj = null;
        if ($id) {
            $fmObj = $fm->getById($id);
        }
        if (!$fmObj) {
            Adminka::redirectBack("Вопрос не найден");
        }
        $fm->remove($id);
        Adminka::redirect("managefaq", "Вопрос удален");
    }
}