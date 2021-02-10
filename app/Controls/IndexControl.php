<?php
/**
 * cp project
 * Контрол для визуального представления главной страницы сайта
 */

class IndexControl extends BaseControl {
    /** Это глобальные переменные шаблона */
    public $pageTitle = "GASTREET 2021 - International Restaurant Show - Отраслевая площадка для рестораторов";
    public $pageDesc = "";
    public $pageKeys = "";
    public $pageImg = "https://gastreet.com/images/fb_share_6.jpg?v=1";
    public $controlName = "";
    public $page = null;
    public $includedJS = null;

    public function preRender() {
        parent::preRender();
        $this->layout = '/index.html';
        if ($this->actor) {
            $this->addData("actor", $this->actor);
            $tsOnline = ($this->actor->tsOnline) ? $this->actor->tsOnline : 0;
            if (isset($tsOnline) && (time() - $tsOnline > 60 * 3) ) {
                $um = new UserManager();
                $this->actor = $um->checkRegistered($this->actor);
                $um->updateVisitTime($this->actor->id);
            }
            $this->ticketsCount = UserManager::getBacketCount($this->actor);
        }
    }

    public function render(){
        Enviropment::redirect("page");
    }

    public function postRender(){
        BaseApplication::writeSqlLog();
    }
}