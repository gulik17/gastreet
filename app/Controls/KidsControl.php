<?php
/**
 *
 */
class KidsControl extends IndexControl {
    public $pageTitle = "GASTREET Kids — GASTREET 2020";
    public $pageTitle_en = "GASTREET Kids — GASTREET 2020";

    public function render() {
        $this->gcode = "kids_body_page";
        $this->includedJS .= Enviropment::loadScript('/js/pages/kids.js', 'js');
    }
}