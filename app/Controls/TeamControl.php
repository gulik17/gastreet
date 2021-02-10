<?php

/**
 *
 */
class TeamControl extends AuthorizedUserControl {
    public $pageTitle = "Команда - ответы на вопросы — GASTREET 2021`";
    public function render() {
        $this->controlName = "Команда";
        $fm = new FaqManager();
        $fmList = $fm->getAll('sortOrder');
        $this->addData("fmList", $fmList);
    }
}