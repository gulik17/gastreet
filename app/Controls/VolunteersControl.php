<?php
/**
 *
 */
class VolunteersControl extends IndexControl {
    public $pageTitle = "Волонтеры — GASTREET 2020";
    public $pageTitle_en = "Volunteers — GASTREET 2020";

    public function render() {
        $this->controlName = "Волонтеры";
        $vm = new VolunteerManager();
        $array['year']     = Request::getVar("year");
        $array['city']     = Request::getVar("city");
        $array['position'] = Request::getVar("position");

        if (Request::getMethod() == 'POST') {
            $vmList = $vm->getFilteredVolunteerList($array);
        } else {
            $vmList = $vm->getActive(0, 'sort');
        }
        
        $vmCityList = $vm->getActiveCity();
        $vmPositionList = $vm->getActivePosition();
        
        $this->addData("vmList", $vmList);
        $this->addData("vmCityList", $vmCityList);
        $this->addData("vmPositionList", $vmPositionList);
        $this->addData("year", $array['year']);
        $this->addData("city", $array['city']);
        $this->addData("position", $array['position']);
        $this->includedJS .= Enviropment::loadScript('/js/pages/speakers.js', 'js');
    }
}