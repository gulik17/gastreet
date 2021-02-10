<?php

/**
 * Контрол для визуального представления окружения покупателя
 * после входа в систему
 *
 */
class UserAreaControl extends AuthorizedUserControl {
    public $pageTitle = "Новости — GASTREET 2021";

    public function render() {
        UserManager::redirectIfNoProfile($this->actor);

        $ts = time();
        $this->addData("ts", $ts);
        $this->addData("host", $this->host);

        $dateTimeArray = getdate(time());
        $dateHour = $dateTimeArray['hours'];

        $helloWord = "";

        if ($dateHour >= 17 || $dateHour <= 3) {
            $helloWord = "Добрый вечер";
        }
        if ($dateHour >= 12 && $dateHour < 17) {
            $helloWord = "Добрый день";
        }
        if ($dateHour >= 3 && $dateHour < 12) {
            $helloWord = "Доброе утро";
        }
        $this->addData("hellotimeday", $helloWord);
        $this->addData("actor", $this->actor);

        // ----------------------REDIRECT-----------------------------
        // есть ли что-то в корзине у пользователя
        // что в корзине по основному билету
        $bm = new BasketManager();
        if ($this->actor->parentUserId) {
            $purchasedTickets = $bm->getTicketsByChildId($this->actor->id);
        } else {
            $purchasedTickets = $bm->getTicketsByUserIdNoChildren($this->actor->id);
        }
        // редирект
        if (is_array($purchasedTickets) && count($purchasedTickets)) {
            //Enviropment::redirect("basket", "Внимание! Срок резервирования <u>неоплаченного</u> товара в корзине сокращён до 1-го часа.");
            Enviropment::redirect("basket");
        } else {
            Enviropment::redirect("catalog", "Вы авторизованы на сайте");
        }

        // ----------------------REDIRECT-----------------------------

        if ($this->actor->parentUserId) {
            $um = new UserManager();
            $parent = $um->getById($this->actor->parentUserId);
            $this->addData("parent", $parent);
        }
    }
}