<?php
/**
 * Компонент отображает табы
 */
class TabmenuControl extends BaseControl implements IComponent {
    private $current;

    function __construct($current = null) {
        $this->current = $current;
    }

    // рендер
    public function render() {
        $actor = Context::getActor();
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