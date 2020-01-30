<?php

/**
 */
class StuffTicketAction extends AdminkaAction {

    public function execute() {
        $userId = Request::getInt("userId");
        if (!$userId) {
            Adminka::redirect("managestuff", "Не задан ID пользователя");
        }

        $um = new UserManager();
        $user = $um->getById($userId);
        if (!$user) {
            Adminka::redirect("managestuff", "Пользователь не найден");
        }
        if ($user->type != User::TYPE_STAFF) {
            Adminka::redirect("managestuff", "Пользователь не является членом команды");
        }

        $ticketId = Request::getInt("ticketId");
        if (!$ticketId) {
            Adminka::redirect("managestuff", "Не задан ID билета");
        }

        $btm = new BaseTicketManager();
        $ticket = $btm->getById($ticketId);
        if (!$ticket) {
            Adminka::redirect("managestuff", "Не найден билет");
        }

        if ($user->baseTicketId) {
            Adminka::redirectBack("У данного члена команды уже есть билет");
        }

        $ts = time();

        $user->baseTicketId = $ticketId;
        $user->tsTicketAdd = time();
        $user = $um->save($user);

        // добавить в корзину basket
        $bm = new BasketManager();
        $bmObj = new Basket();
        $bmObj->userId = $userId;

        $bmObj->tsCreated = $ts;
        $bmObj->tsUpdated = $ts;
        $bmObj->tsPay = $ts;
        $bmObj->baseTicketId = $ticketId;
        $bmObj->baseTicketName = $ticket->name;
        $bmObj->baseTicketStatus = $ticket->status;
        $bmObj->needAmount = $ticket->price;
        $bmObj->payAmount = $ticket->price;
        $bmObj->status = Basket::STATUS_PAID;
        $bmObj = $bm->save($bmObj);

        // пересчёт корзины
        $bm->startTransaction();
        try {
            $bm->rebuildBasket($userId);
        } catch (Exception $e) {
            $bm->rollbackTransaction();
            Logger::error($e);
            Enviropment::redirectBack(Enviropment::ERROR_MSG);
        }
        $bm->commitTransaction();

        // запрос не переформирование Qr кода
        UserManager::createQrCode($userId);

        Adminka::redirectBack("Билет добавлен");
    }

}
