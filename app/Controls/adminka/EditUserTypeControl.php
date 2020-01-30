<?php

/**
 *
 */
class EditUserTypeControl extends BaseAdminkaControl {
    public $pageTitle = "Редактирование типа пользователя";

    public function render() {
        $id = Request::getInt("id");
        if (!$id) {
            $this->pageTitle = "Создание типа пользователя";
        } else {
            $utm = new UserTypeManager();
            $utmObj = $utm->getById($id);
            if (!$utmObj) {
                Adminka::redirect("manageusertype", "Тип пользователя не найден");
            } else {
                $this->addData("userType", $utmObj);
            }
        }
    }
}