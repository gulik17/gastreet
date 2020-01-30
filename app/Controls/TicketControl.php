<?php
/**
 * cp project
 * Компонент для отображения страниц, созданных админом
 */
class TicketControl extends IndexControl {
    public $pageTitle    = "Билеты — GASTREET 2020";
    public $pageTitle_en = "Tickets — GASTREET 2020";
    public $pageDesc = "Самое ожидаемое отраслевое образовательное событие в стране, 5000 участников со всего мира";
    public $pageDesc_en = "The largest educational industry-specific event in the country, 5,000 participants from all over the world";

    public function render() {
        //UserManager::redirectIfNoLogin($this->actor, '/');
        //UserManager::redirectIfNoProfile($this->actor);
        $this->layout = '/ticketindex.html';

        $this->addData("useAjax", 1);
        $parentObj = null;
        $um = new UserManager();
        if ($this->actor && $this->actor->parentUserId) {
            $parentObj = $um->getById($this->actor->parentUserId);
        }

        // авторизован ли под участником
        $user = null;
        $child = Context::getObject("__child");
        if ($child) {
            $user = $child;
            $this->addData("child", $child);
        } else if ($parentObj) {
            $child = $this->actor;
            $user = $child;
            $this->addData("child", $child);
        } else if ($this->actor) {
            $user = $this->actor;
        }

        // что в корзине по основному билету
        $disableAllBecauseNoBaseTicket = false;
        $bm = new BasketManager();
        $userTickets = null;
        if ($user) {
            if ($child) {
                $userTickets = $bm->getTicketsByChildId($child->id);
            } else {
                $userTickets = $bm->getTicketsByUserIdNoChildren($user->id);
            }
            if (!count($userTickets)) {
                $disableAllBecauseNoBaseTicket = true;
            } else {
                $this->addData("userBasketTickets", $userTickets);
            }
        } else {
            $disableAllBecauseNoBaseTicket = true;
        }

        // билеты
        $btm = new BaseTicketManager();
        $tickets = $btm->getAllActive();
        $this->addData("tickets", $tickets);
    }
}