<?php

/**
 *
 */
class UpdateBitAction extends AdminkaAction {
    public function execute() {
        $id = Request::getInt("id");
        if ($id) {
            $result = UserManager::createQrCode($id);
        } else {
            Adminka::redirectBack("Пользователь не найден");
        }
        /*public function bitSaveTicket(
         * $phone, 
         * $email,
         * $confirmedEmail, 
         * $lastname, 
         * $name, 
         * $type, 
         * $organization,
         * $position, 
         * $amount, 
         * $ticketType, 
         * $payed, 
         * $accessListArray, 
         * $signature)*/

        Adminka::redirect("user&id=$id", "Данные обновлены");
    }
}