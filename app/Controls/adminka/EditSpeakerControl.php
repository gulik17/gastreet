<?php

/**
 *
 */
class EditSpeakerControl extends BaseAdminkaControl {

    public $pageTitle = "Редактирование спикера";

    public function render() {
        $id = Request::getInt("id");

        if (!$id) {
            $this->pageTitle = "Создание спикера";
        } else {
            $sm = new SpeakerManager();
            $smObj = $sm->getById($id);

            if (!$smObj) {
                Adminka::redirect("managespeakers", "Спикер не найден");
            } else {
                $this->addData("speaker", $smObj);
                if ($smObj->pic1) {
                    $file = $smObj->pic1;
                    $fullFileName = Configurator::get("application:speackersFolder") . "resized/" . $file;
                    if (file_exists($fullFileName)) {
                        $this->addData("speackerImg1", $file);
                    }
                }
                if ($smObj->pic_app) {
                    $file = $smObj->pic_app;
                    $fullFileName = Configurator::get("application:speackersFolder") . "resized/" . $file;
                    if (file_exists($fullFileName)) {
                        $this->addData("speackerImg_app", $file);
                    }
                }
            }
        }

        $this->addData("statusList", Speaker::getStatusDesc());
        $this->addData("countryList", Speaker::getCountry());

        $partnersArray = array();
        $pm = new ParthnerManager();
        $partners = $pm->getAll();
        if (is_array($partners) && count($partners)) {
            foreach ($partners AS $partner) {
                $partnersArray[$partner->id] = $partner->name;
            }
            $this->addData("partners", $partnersArray);
        }
    }
}