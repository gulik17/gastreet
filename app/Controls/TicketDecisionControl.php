<?php
/**
*/
class TicketDecisionControl extends AuthorizedUserControl {
    public $pageTitle = "Покупка билета — GASTREET 2020";

    public function render() {
        $ts = time();
        $this->addData("ts", $ts);
        $this->addData("host", $this->host);
        $this->addData("actor", $this->actor);

        $parentObj = null;
        $um = new UserManager();
        if ($this->actor->parentUserId) {
            $parentObj = $um->getById($this->actor->parentUserId);
        }

        $child = Context::getObject("__child");
        if ($child || $parentObj) {
            Enviropment::redirect("userparticipant", "Вы зашли участником, поэтому данное действие запрещено");
        }

        $ticket = Request::getInt("ticket");
        if (!$ticket) {
            Enviropment::redirectBack("Не выбран товар!");
        }

        $btm = new BaseTicketManager();
        $ticketObj = $btm->getById($ticket);
        if (!$ticketObj) {
            Enviropment::redirectBack("Не найден товар!");
        }

        $this->addData("ticketObj", $ticketObj);

        // что в корзине по основному билету
        $bm = new BasketManager();
        $tickets = $bm->getTicketsByUserId($this->actor->id);
        if (count($tickets)) {
            $this->addData("tickets", $tickets);
        }

        $allTickets = $btm->getAllActive();
        $this->addData("allTickets", $allTickets);
    }
}