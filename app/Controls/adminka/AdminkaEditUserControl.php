<?php

/**
 * Класс для редактирования данных пользователя 
 */
class AdminkaEditUserControl extends BaseAdminkaControl {
    public $pageTitle = "Редактирование пользователя";

    public function render() {
        $id = Request::getInt("id");
        if (!$id) {
            $this->pageTitle = "Добавление нового пользователя";
            //Adminka::redirectBack("Не указан ID");
        } else {
            $um = new UserManager();
            $umObj = $um->getById($id);
            if (!$umObj) {
                Adminka::redirectBack("Пользователь не найден");
            } else {
                $this->addData("user", $umObj);
            }
        }
        $utm = new UserTypeManager();
        $usertypes = array();
        $types = $utm->getAll();
        if (is_array($types) && count($types)) {
            foreach ($types AS $type) {
                $usertypes[$type->id] = $type->name;
            }
            $this->addData("types", $usertypes);
        }
        $this->addData("country", $this->country);
        //deb($this->country);
    }
}