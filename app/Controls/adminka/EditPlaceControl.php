<?php

class EditPlaceControl extends BaseAdminkaControl {

    public $pageTitle = "Редактирование места проживания";

    public function render() {
        $id = Request::getInt("id");
        if ($id === 0) {
            $this->pageTitle = "Создание места проживания";
        } else {
            $plm = new PlaceManager();
            $plmObj = $plm->getById($id);
            if (!$plmObj) {
                Adminka::redirect("manageplaces", "Место проживания не найдено");
            } else {
                $inclusive = unserialize($plmObj->inclusive);
                $notinclusive = unserialize($plmObj->notinclusive);
                $this->addData("place", $plmObj);
                $this->addData("inclusive", $inclusive);
                $this->addData("notinclusive", $notinclusive);
                // image
                $file = $plmObj->pic1;
                $fullFileName = Configurator::get("application:placesFolder") . "resized/" . $file;
                if (file_exists($fullFileName)) {
                    $this->addData("placeImg1", $file);
                }

                $file = $plmObj->pic2;
                $fullFileName = Configurator::get("application:placesFolder") . "resized/" . $file;
                if (file_exists($fullFileName)) {
                    $this->addData("placeImg2", $file);
                }

                $file = $plmObj->pic3;
                $fullFileName = Configurator::get("application:placesFolder") . "resized/" . $file;
                if (file_exists($fullFileName)) {
                    $this->addData("placeImg3", $file);
                }
            }
        }
        $this->addData("statusList", Place::getStatusDesc());
    }
}