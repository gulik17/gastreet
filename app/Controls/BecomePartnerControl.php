<?php

class BecomePartnerControl extends IndexControl {
    public $pageTitle = "Стать партнером — GASTREET 2021";
    public $pageTitle_en = "Become a Partner — GASTREET 2021";

    public function render() {

        $this->includedJS .= Enviropment::loadScript('/js/pages/partner.js', 'js');
    }
}