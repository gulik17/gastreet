<?php

/**
 * Класс для редактирования данных пользователя 
 */
class EditVolunteerControl extends BaseAdminkaControl {
    public $pageTitle = "Редактирование волонтера";

    public function render() {
        $id = Request::getInt("id");
        if (!$id) {
            $this->pageTitle = "Добавление нового волонтера";
            //Adminka::redirectBack("Не указан ID");
        } else {
            $vm = new VolunteerManager();
            $vmObj = $vm->getById($id);
            if (!$vmObj) {
                Adminka::redirectBack("Волонтер не найден");
            } else {
                $this->addData("volunteer", $vmObj);
                if ($vmObj->img) {
                    $file = $vmObj->img;
                    $fullFileName = Configurator::get("application:volunteersFolder") . "resized/" . $file;
                    if (file_exists($fullFileName)) {
                        $this->addData("volunteerImg1", $file);
                    }
                }
            }
        }
        $this->addData("country", $this->country);
        $this->addData("statusList", Volunteer::getStatusDesc());
    }
}