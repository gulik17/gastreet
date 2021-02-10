<?php
/**
 *
 */
class KidsControl extends IndexControl {
    public $pageTitle = "GASTREET Kids — GASTREET 2021";
    public $pageTitle_en = "GASTREET Kids — GASTREET 2021";

    public function render() {
        $this->gcode = "kids_body_page";
        $this->includedJS .= Enviropment::loadScript('/js/pages/kids.js', 'js');
    }
}