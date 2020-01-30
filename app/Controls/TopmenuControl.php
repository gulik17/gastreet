<?php

/**
 * Компонент отображает верхнее меню
 */
class TopmenuControl extends BaseControl implements IComponent {
    private $current;
    public $lang = "ru";

    function __construct($current = null) {
        $this->current = $current;
    }

    // рендер
    public function render() {
        $actor = Context::getActor();
        
        $um = new UserManager();
        $this->lang = UIGenerator::getLang();
        if ($actor) {
            if (Request::getVar("lang")) {
                $userObj = $um->getById($actor->id);
                $userObj->lang = $this->lang;
                $userObj = $um->save($userObj);
            } else {
                $this->lang = $actor->lang;
            }
            $this->ticketsCount = UserManager::getBacketCount($this->actor);
        }

        $this->addData("actor", $actor);
        $this->addData("curMenu", $this->current);

        $host = $_SERVER['HTTP_HOST'];
        $this->addData("host", $host);

        $curPage = Utils::getCurrenControlName();

        if ($curPage == 'userpay') {
            $curPage = 'finanses';
        }
        if (strpos($curPage, 'zparse') !== false || in_array($curPage, array('ownerviewopt', 'ownereditopt', 'ownerparsers'))) {
            $curPage = 'owneroptlist';
        }
        if (in_array($curPage, array('owneraddzakupkahead', 'ownerclonezakupka', 'ownerbroadcast', 'ownerviewzakupka', 'ownereditvikup'))) {
            $curPage = 'ownerzhlist';
        }
        if ($curPage == 'officeordersissue') {
            $curPage = 'officemanager';
        }
        $this->addData("curPage", $curPage);

        $allTLinks = array();
        if ($actor) {
            $allTLinks[] = array("cname" => "basket", "link" => Configurator::get('application:protocol') . $host . '/index.php?show=basket', "name" => "Корзина", "title" => "Корзина");
        } else {
            $allTLinks[] = array("cname" => "userlogin", "link" => Configurator::get('application:protocol') . $host . '/index.php?show=userlogin', "name" => "Войти", "title" => "Войти");
            $allTLinks[] = array("cname" => "userregister", "link" => Configurator::get('application:protocol') . $host . '/index.php?show=userregister', "name" => "Регистрация", "title" => "Регистрация");
        }

        $this->addData("menu", $allTLinks);

        $userTLinks = array();
        if ($actor) {
            $qrm = new UserQrCodeManager();
            $qrmObj = $qrm->getOneActiveByUserId($actor->id);
            if ($qrmObj) {
                $this->addData("qrmObj", $qrmObj);
            }

            $child = Context::getObject("__child");
            if ($child && !$actor->parentUserId) {
                $this->addData("child", $child);
            }
        }
        $this->addData("usermenu", $userTLinks);
    }
}