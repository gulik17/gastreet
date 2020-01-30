<?php
/**
 */
class StuffDelTicketAction extends AdminkaAction
{
    public function execute()
    {
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

        $user->baseTicketId = null;
        $user->tsTicketAdd  = null;
        $user = $um->save($user);

        // удалить из корзины
        $bm = new BasketManager();
        $bmObj = $bm->getByUserIdAndTicketIds($userId, array($ticketId));
        if ($bmObj) {
            $bm->remove($bmObj[0]->id);
        }

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

        Adminka::redirectBack("Билет удален");

    }

}
