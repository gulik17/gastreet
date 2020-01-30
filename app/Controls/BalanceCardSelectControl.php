<?php

/**
 *
 */
class BalanceCardSelectControl extends AuthorizedUserControl {
    public $pageTitle = "Выбор карты для пополнения баланса — GASTREET 2020";
    public $pageTitle_en = "Select a card to replenish balance — GASTREET 2020";

    public function render() {
        UserManager::redirectIfNoProfile($this->actor);

        $ts = time();
        $this->addData("ts", $ts);
        $this->addData("host", $this->host);
        $this->addData("actor", $this->actor);

        $amount = floatval(Request::getVar('amount'));
        $this->addData("amount", $amount);

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