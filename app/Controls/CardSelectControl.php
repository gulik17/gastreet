<?php

/**
 *
 */
class CardSelectControl extends AuthorizedUserControl {
    public $pageTitle = "Выбор карты для оплаты — GASTREET 2020";
    public $pageTitle_en = "Choose a card for payment — GASTREET 2020";

    public function render() {
        UserManager::redirectIfNoProfile($this->actor);

        $ts = time();
        $this->addData("ts", $ts);
        $this->addData("host", $this->host);
        $this->addData("actor", $this->actor);

        $total = floatval(Request::getVar('total'));
        $this->addData("total", $total);

        // промо-код
        $code = Request::getVar('code');
        $this->addData("code", $code);

        // промо-коды
        $code = Request::getVar('codes');
        $this->addData("codes", $code);

        // есть ли у человека сохраненные карты, то пусть выбирает
        $ucm = new UserCardManager();
        $ucmObjs = $ucm->getByUserId($this->actor->id);
        if (!$ucmObjs) {
            if ($this->lang == 'en') {
                Enviropment::redirect("basket", "You do not have any saved bank cards", "danger");
            } else {
                Enviropment::redirect("basket", "У Вас нет сохраненных банковских карт", "danger");
            }
        }
        $this->addData("ucmObjs", $ucmObjs);
    }
}