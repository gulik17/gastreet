<?php
/**
 *
*/
class SpeakerControl extends IndexControl {
    public $pageTitle = "Спикер — GASTREET 2021";
    public $pageTitle_en = "Speaker — GASTREET 2021";

    public function render() {
        $this->controlName = "Спикеры";
        $id = Request::getInt("id");
        if (!$id) {
            Enviropment::redirectBack("Не указан ID");
        }
        $spm = new SpeakerManager();
        $spmObj = $spm->getById($id);
        if (!$spmObj) {
            Enviropment::redirectBack("Не найден Спикер");
        }
        $this->addData("spmObj", $spmObj);
        $this->pageTitle .= $spmObj->name . " " . $spmObj->secondName . " " . $spmObj->company . " " . $spmObj->cityName . " " . $spmObj->position;
        $spm = new SpeakerManager();
        $spmList = $spm->getActive(8);
        $this->addData("spmList", $spmList);
    }
}