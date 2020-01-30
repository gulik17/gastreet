<?php

/**
 * Добавить участника
 *
 */
class AddOlimpicAction extends AuthorizedUserAction implements IPublicAction {
    public function execute() {
        // проверить заполнен ли профайл данного пользователя
        UserManager::redirectIfNoProfile($this->actor);

        //deb($this);
        
        $bm = new BasketManager();
        if ($this->actor->parentUserId) {
            $purchasedTickets = $bm->getTicketsByChildId($this->actor->id);
        } else {
            $purchasedTickets = $bm->getTicketsByUserIdNoChildren($this->actor->id);
        }
        
        // Проверим не под допом ли это зашли
        $child = Context::getObject("__child");
        if ($child) {
            $purchasedTickets = $bm->getTicketsByChildId($child->id);
            // Проверяем наличие оплаченного билета в корзине у текущего юзера
            $olimpicBtn = false; // Вернуть в false для нормальной работы
            if ( ($child->baseTicketId == 2) || ($child->baseTicketId == 6) ) {
                if ($purchasedTickets[0]['status'] == Basket::STATUS_PAID) {
                    $olimpicBtn = true;
                }
            }
        } else {
            // Проверяем наличие оплаченного билета в корзине у текущего юзера
            $olimpicBtn = false; // Вернуть в false для нормальной работы
            if ( ($this->actor->baseTicketId == 2) || ($this->actor->baseTicketId == 6) ) {
                if ($purchasedTickets[0]['status'] == Basket::STATUS_PAID) {
                    $olimpicBtn = true;
                }
            }
        }

        // отправим СМС уведомление участнику
        //UserManager::notifyRegisterParticipantSms($phone, $user->id);

        if ($olimpicBtn) {
            $tsCreated = time();
            if ($child) {
                $user_id = $child->id;
            } else {
                $user_id = $this->actor->id;
            }
            $com = new ChefOlimpicManager();
            $comActor = $com->getByUserId($user_id);
            if ($comActor > 0) {
                if ($this->lang == 'en') {
                    Enviropment::redirectBack("You are already registered to participate in the Olympics!", "info");
                } else {
                    Enviropment::redirectBack("Вы уже зарегистрированы на участие в&nbsp;Олимпиаде!", "info");
                }
            }
            $comActive = $com->getActive();

            if (count($comActive) >= 30 ) {
                $status = ChefOlimpic::STATUS_QUEUE;
            } else {
                $status = ChefOlimpic::STATUS_ENABLED;
            }
            
            $olimpicUser = new ChefOlimpic();
            
            $olimpicUser->user_id = $user_id;
            $olimpicUser->tsCreated = $tsCreated;
            $olimpicUser->status = $status;
            $olimpicUser = $com->save($olimpicUser);
            
            UserManager::sendNotifyOlimpic4User($this->actor->id);

            if ($this->lang == 'en') {
                Enviropment::redirectBack("Your participation is registered!", "success");
            } else {
                Enviropment::redirectBack("Ваше участие зарегистрировано!", "success");
            }
        } else {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("You can not participate in the Olympics!", "danger");
            } else {
                Enviropment::redirectBack("Вы не можете участвовать в&nbsp;Олимпиаде!", "danger");
            }
        }
    }
}