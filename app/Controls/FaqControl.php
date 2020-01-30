<?php

/**
 *
 */
class FaqControl extends IndexControl {
    public $pageTitle = "ЧаВо - ответы на вопросы — GASTREET 2020";

    public function render() {
        //Enviropment::redirect('/');
        $this->controlName = "ЧаВо";
        $fm = new FaqManager();
        $fmList = $fm->getAll('sortOrder');
        $this->addData("fmList", $fmList);
        //deb($this);
    }
}