<?php

/**
 *
 */
class AdminDelticketAction extends AdminkaAction {

    public function execute() {
        $id = Request::getInt("id");
        if (!$id) {
            Adminka::redirectBack("Не указан ID");
        }

        $bm = new BasketManager();
        $basket = $bm->getById($id);
        if (!$basket) {
            Adminka::redirectBack("Билет не найден");
        }

        if ($basket->childId) {
            $userId = $basket->childId;
        } else {
            $userId = $basket->userId;
        }

        Logger::info("AdminDelticket, id: {$id}, userId: {$userId}");
        Logger::info($basket);

        $um = new UserManager();
        $user = $um->getById($userId);
        // очистить данные о билете у пользователя
        $user->baseTicketId = null;
        $user->tsTicketAdd = null;
        $user = $um->save($user);

        // удалить сам билет
        $bm->remove($id);

        // ребилд QR кодов
        $qrmObj = UserManager::removeQrCode($userId);
        $qrmObj = UserManager::createQrCode($userId);

        Adminka::redirectBack("Билет был удалён");
    }

}
