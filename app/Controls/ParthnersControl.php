<?php
/**
 *
 */
class ParthnersControl extends IndexControl {
    public $pageTitle = "Партнеры — GASTREET 2021";

    public function render() {
        $this->controlName = "Партнеры";
        $pm = new ParthnerManager();
        $parthners = $pm->getActive();
        $this->addData("parthners", $parthners);
    }
}