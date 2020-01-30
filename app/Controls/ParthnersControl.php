<?php
/**
 *
 */
class ParthnersControl extends IndexControl {
    public $pageTitle = "Партнеры — GASTREET 2020";

    public function render() {
        $this->controlName = "Партнеры";
        $pm = new ParthnerManager();
        $parthners = $pm->getActive();
        $this->addData("parthners", $parthners);
    }
}