<?php
/**
 *
*/
class ProgrammsControl extends IndexControl {
    public $pageTitle = "Программы по тематикам — GASTREET 2021";
    public $pageTitle_en = "Programs by subjects — GASTREET 2021";

    public function render() {
        $this->controlName = "Программы";
        $areaType = (Request::getInt("type")) ? Request::getInt("type") : 1;
        // поднимем типы программа
        $atm = new AreaTypeManager();
        $atmList = $atm->getAll();
        $this->addData("areaType", $areaType);
        $this->addData("atmList", $atmList);
        // поднимем программы
        $am = new AreaManager();
        $amList = $am->getActive("sortOrder");
        $this->addData("amList", $amList);
    }
}