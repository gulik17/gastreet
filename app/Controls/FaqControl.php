<?php

/**
 *
 */
class FaqControl extends IndexControl {
    public $pageTitle = "ЧаВо - ответы на вопросы — GASTREET 2020";
    public function render() {
        $this->controlName = "ЧаВо";
        $fm = new FaqManager();
        $fmList = $fm->getForFaq('sortOrder');
        $this->addData("fmList", $fmList);
    }
}