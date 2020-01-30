<?php

/*
 * 
 */

class EditUserDetailsControl extends BaseAdminkaControl {
    public $pageTitle = "Редактирование реквизитов пользователя";

    public function render() {
        $id = Request::getInt("id");
        if ($id) {
            $udm = new UserDetailsManager();
            $udmObj = $udm->getById($id);
            if (!$udmObj) {
                Adminka::redirect("user", "Реквизиты не найдены");
            } else {
                $this->addData("userDetails", $udmObj);
            }
        }
    }
}