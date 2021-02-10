<?php

/**
 * Контрол покажет инфу о владельце
 */
class ViewUserControl extends AuthorizedUserControl {
    public $pageTitle = "Информация об пользователе — GASTREET 2021";
    public $pageTitle_en = "User Information — GASTREET 2021";

    public function render() {
        $id = Request::getInt("id");
        $this->addData("backurl", Utility::getRefUrl());

        $ts = time();
        $this->addData("ts", $ts);
        if ($id) {
            $um = new UserManager();
            $curUser = $um->getById($id);
            if (!$curUser) {
                if ($this->lang == 'en') {
                    Enviropment::redirectBack("No participant found", "danger");
                } else {
                    Enviropment::redirectBack("Не найден участник", "danger");
                }
            } else {
               // if ($curUser->isOwner) {
                //    Enviropment::redirect("ownersinfo/id/" . $id);
                //}
                //$this->addData("curuser", $curUser);
            }
        } else {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("No participant ID set", "danger");
            } else {
                Enviropment::redirectBack("Не задан ID участника", "danger");
            }
        }
    }
}