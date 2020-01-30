<?php

class DelGazAction extends AdminkaAction {
    public function execute() {
        $id = Request::getInt("id");
        $ggm = new GazGameManager();
        $ggmObj = null;
        if ($id) {
            $ggmObj = $ggm->getById($id);
        }
        if (!$ggmObj) {
            Adminka::redirectBack("Запись не найдена");
        }
        $ggm->remove($id);
        Adminka::redirect("managegaz", "Запись удалена");
    }
}