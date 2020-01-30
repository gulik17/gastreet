<?php

/**
 *
 */
class EditParthnerControl extends BaseAdminkaControl {

    public $pageTitle = "Редактирование партнера";

    public function render() {
        $id = Request::getInt("id");
        if (!$id) {
            $this->pageTitle = "Создание партнера";
        } else {
            $pm = new ParthnerManager();
            $pmObj = $pm->getById($id);
            if (!$pmObj) {
                Adminka::redirect("manageparthners", "Партнер не найдена");
            } else {
                $this->addData("parthner", $pmObj);
                // image
                $file = $pmObj->pic;
                $fullFileName = Configurator::get("application:parthnersFolder") . "resized/" . $file;
                if (file_exists($fullFileName)) {
                    $this->addData("parthnerImg", $file);
                }
            }
        }

        $this->addData("statusList", Parthner::getStatusDesc());

        $ptm = new ParthnerTypeManager();
        $parthnerTypes = $ptm->getAll();
        if (is_array($parthnerTypes) && count($parthnerTypes)) {
            $parthnerTypesArray = array();
            foreach ($parthnerTypes AS $parthnerType) {
                $parthnerTypesArray[$parthnerType->id] = $parthnerType->name;
            }
            $this->addData('parthnerTypes', $parthnerTypesArray);
        }
    }
}