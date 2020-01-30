<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 13.02.17
 * Time: 11:38
 */
class EditVideoControl extends BaseAdminkaControl {
    public $pageTitle = "Редактирование видеоролика";

    public function render() {
        $id = Request::getInt("id");
        if (!$id) {
            $this->pageTitle = "Добавить видеоролик";
        } else {
            $vm = new VideoManager();
            $vmObj = $vm->getById($id);
            if (!$vmObj) {
                Adminka::redirect("managevideo", "Видеоролик не найден");
            } else {
                $this->addData("video", $vmObj);
                // image
                $file = $vmObj->id . ".jpg";
                $fullFileName = Configurator::get("application:videoFolder") . "resized/" . $file;
                if (file_exists($fullFileName)) {
                    $this->addData("videoImg", $file);
                }
            }
        }
        $this->addData("statusList", Video::getStatusDesc());
    }
}