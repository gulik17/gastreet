<?php

class BecomePartnerControl extends IndexControl {
    public $pageTitle = "Стать партнером — GASTREET 2020";
    public $pageTitle_en = "Become a Partner — GASTREET 2020";

    public function render() {

        $this->includedJS .= Enviropment::loadScript('/js/pages/partner.js', 'js');
    }
}