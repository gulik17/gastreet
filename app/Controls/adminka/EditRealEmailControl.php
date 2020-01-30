<?php

/**
 * Контрол для  создания/редактирования новости
 */
class EditRealEmailControl extends BaseAdminkaControl {

    public $pageTitle = "Редактирование мыла на скидку";

    public function render() {
        $id = Request::getInt("id");
        if (!$id) {
            $this->pageTitle = "Создание мыла на скидку";
        } else {
            $rem = new RealEmailManager();
            $remObj = $rem->getById($id);
            if (!$remObj) {
                Adminka::redirect("managerealemail", "Мыло на скидку не найден");
            }
            $this->addData("discount", $remObj);
        }
    }
}