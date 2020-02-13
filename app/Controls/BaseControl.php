<?php
/**
 * cp project
 * Общий контрол, наследуемый от фреймворка
 */

class BaseControl extends Control {
    public $pageTitle    = "GASTREET 2020 - International Restaurant Show";
    public $pageTitle_en = "GASTREET 2020 - International Restaurant Show";
    public $pageDesc     = "";
    public $pageDesc_en  = "";
    public $pageImg  = "https://gastreet.com/images/fb_share_6.jpg";
    public $pageUri  = "";
    public $lang    = null;
    public $time    = null;
    public $layout = "blank.html";
    public $host;
    public $jivoSite = 0;
    public $ticketsCount = 0;
    public $country = null;
    public $city = null;
    public $dev = null;
    public $app = null;
    public $actor = null;
    public $includedJS = null;
    public $browser = null;
    public $gcode = null;

    public function preRender() {
        $this->time = time();
        $this->actor = Context::getActor();
        $this->lang = UIGenerator::getLang();
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'webview') !== false) {
            $this->app = 1;
        }

        if (isset($_SERVER['HTTP_HOST'])) {
            $this->host = str_replace('www.', '', strtolower($_SERVER['HTTP_HOST']));
        } else {
            Request::send404();
        }

        $code = Request::getVar("code");
        if ( ($code == 'gastreetpartner') || Context::getObject('code') == 'gastreetpartner' ) {
            if (Request::getVar("code")) {
                Context::setObject('code', 'gastreetpartner');
            }
            $this->gcode = 'gastreetpartner';
            $this->addData("gastreetpartner", 1);
        } else {
            $this->addData("gastreetpartner", 0);
        }

        //if ( ( ($code == 'sukhih') || (Context::getObject('code') == 'sukhih') ) && (time() < 1577836800) ) {
        if ( ($code == 'sukhih') || (Context::getObject('code') == 'sukhih') ) {
            if (Request::getVar("code")) {
                Context::setObject('code', 'sukhih');
            }
            $this->gcode = 'sukhih';
            $this->addData("gastreetspecial", 1);
        } else {
            $this->addData("gastreetspecial", 0);
        }

        if ( ($code == 'rebro') || (Context::getObject('code') == 'rebro') ) {
            if (Request::getVar("code")) {
                Context::setObject('code', 'rebro');
            }
            $this->gcode = 'rebro';
            $this->addData("gastreetrebro", 1);
        } else {
            $this->addData("gastreetrebro", 0);
        }

        if ( ($code == 'lubimki') || (Context::getObject('code') == 'lubimki') ) {
            if (Request::getVar("code")) {
                Context::setObject('code', 'lubimki');
            }
            $this->gcode = 'lubimki';
            $this->addData("gastreetlubimki", 1);
        } else {
            $this->addData("gastreetlubimki", 0);
        }

        if ( ($code == 'ambassadors') || (Context::getObject('code') == 'ambassadors') ) {
            if (Request::getVar("code")) {
                Context::setObject('code', 'ambassadors');
            }
            $this->gcode = 'ambassadors';
            $this->addData("gastreetambassadors", 1);
        } else {
            $this->addData("gastreetambassadors", 0);
        }

        // Устанавливаем язык пользователя
        if ($this->actor) {
            if ( (Request::getVar("lang")) && ( (Request::getVar("lang") == 'en') || (Request::getVar("lang") == 'ru') ) ) {
                $um = new UserManager();
                $userObj = $um->getById($this->actor->id);
                $userObj->lang = Request::getVar("lang");
                $userObj = $um->save($userObj);
                $this->lang == Request::getVar("lang");
                $this->actor = Context::getActor();
                UIGenerator::setLang($this->lang);
            } else {
                if ( isset($this->actor->lang) ) {
                    $this->lang = $this->actor->lang;
                }
            }
        }

        if ($this->lang == 'en') {
            $this->pageTitle = $this->pageTitle_en;
            $this->pageDesc = $this->pageDesc_en;
        }
        $this->jivoSite = Configurator::get("application:jivoSite");
        // Фомрирование списка стран и городов согласно текущей локализации
        $clm = new CountryLangManager();
        $this->country = $clm->getAllCountryLang($this->lang);
        unset($clm);
        $clm = new CityLangManager();
        $this->city = $clm->getAllCityLang($this->lang);
        unset($clm);
        $this->dev = Request::getVar("dev");
        $this->addData("dev", $this->dev);

        $user_agent = $_SERVER["HTTP_USER_AGENT"];
	if (strpos($user_agent, "Firefox") !== false) $this->browser = "Firefox";
	elseif (strpos($user_agent, "Opera") !== false) $this->browser = "Opera";
	elseif (strpos($user_agent, "Chrome") !== false) $this->browser = "Chrome";
	elseif ( (strpos($user_agent, "MSIE") !== false) || (strpos($user_agent, "Edge") !== false) ) $this->browser = "Internet Explorer";
	elseif (strpos($user_agent, "Safari") !== false) $this->browser = "Safari";
	else $this->browser = "Неизвестный";
    }

    // будет переназначен
    public function render() {
        Request::send404();
    }

    public function postRender() {
        BaseApplication::writeSqlLog();
    }
}