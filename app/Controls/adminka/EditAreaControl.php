<?php

/**
 *
 */
class EditAreaControl extends BaseAdminkaControl {
    public $pageTitle = "Редактирование плащадки";

    public function render() {
        $id = Request::getInt("id");
        if (!$id) {
            $this->pageTitle = "Создание плащадки";
        } else {
            $am = new AreaManager();
            $amObj = $am->getById($id);
            if (!$amObj) {
                Adminka::redirect("manageareas", "Плащадка не найдена");
            } else {
                $this->addData("area", $amObj);
                // images
                $file1 = '01' . $amObj->id . '.jpg';
                $file2 = '02' . $amObj->id . '.jpg';
                $file3 = '03' . $amObj->id . '.jpg';
                $fullFileName1 = Configurator::get("application:areasFolder") . "resized/" . $file1;
                $fullFileName2 = Configurator::get("application:areasFolder") . "resized/" . $file2;
                $fullFileName3 = Configurator::get("application:areasFolder") . "resized/" . $file3;
                if (file_exists($fullFileName1)) {
                    $this->addData("areaImg1", $file1);
                }
                if (file_exists($fullFileName2)) {
                    $this->addData("areaImg2", $file2);
                }
                if (file_exists($fullFileName3)) {
                    $this->addData("areaImg3", $file3);
                }
            }
        }

        $this->addData("statusList", Area::getStatusDesc());

        $atm = new AreaTypeManager();
        $areaTypes = $atm->getAll();
        if (is_array($areaTypes) && count($areaTypes)) {
            $areaTypesArray = array();
            foreach ($areaTypes AS $areaType) {
                $areaTypesArray[$areaType->id] = $areaType->name;
            }
            $this->addData('areaTypes', $areaTypesArray);
        }
    }
}