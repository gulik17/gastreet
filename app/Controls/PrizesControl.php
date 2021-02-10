<?php
/**
 *
 */
class PrizesControl extends IndexControl {
    public $pageTitle = "Новости и ништяки — GASTREET 2021";

    public function render() {
        $this->controlName = "Новости и ништяки";
        $pm = new PrizeManager();
        $pmList = $pm->getActive();
        $this->addData("pmList", $pmList);
    }
}