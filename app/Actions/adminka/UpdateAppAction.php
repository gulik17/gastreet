<?php

/**
 *
 */
class UpdateAppAction extends AdminkaAction {
    public function execute() {
        $id = Request::getInt("id");
        $umObj = null;
        $um = new UserManager();
        $mes = '';
        if ($id) {
            //Adminka::redirectBack("Не указан ID пользователя");
            $umObj = $um->getById($id);
        } else {
            $umObj = new User();
            //Adminka::redirectBack("Пользователь не найден");
        }

        $eventicious = new Eventicious();
        $eventicious->setHost(Configurator::get("eventicious:host"));
        $eventicious->setCode(Configurator::get("eventicious:code"));
        
        $result = $eventicious->speakersDelete($umObj->id);
        // Проверяем код ответа сервера на запрос редактирования записи
        if ($result['result_code'] == 200) {
            $mes .= "Eventicious: ID $umObj->id Отредактирован<br>";
        }
        
        if ($id) {
            $mes = UserManager::updateUser4App($umObj);
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