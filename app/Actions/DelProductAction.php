<?php

/**
 *
 */
class DelProductAction extends AuthorizedUserAction implements IPublicAction {
    public function execute() {
        // проверить заполнен ли профайл пользователя
        UserManager::redirectIfNoProfile($this->actor);

        $parentObj = null;
        $extuserObj = null;
        $extuser = Request::getInt("extuser");
        $mode = Request::getVar("mode");
        $um = new UserManager();
        if ($extuser && $mode == 'existuser') { // удаление товара допа из под основного участника
            $extuserObj = $um->getById($extuser);
        }
        if ($this->actor->parentUserId) { // авторизован под допом
            $parentObj = $um->getById($this->actor->parentUserId);
        }

        $child = Context::getObject("__child");
        if ($child) {
            $user = $child;
        } elseif ($parentObj) {
            $user = $parentObj;
        } elseif ($extuserObj) {
            $user = $extuserObj;
            $child = true;
        } else {
            $user = $this->actor;
        }

        $id = Request::getInt("id");
        if (!$id) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("No ticket selected!");
            } else {
                Enviropment::redirectBack("Не выбран билет!");
            }
        }

        $bpm = new BasketProductManager();
        $bpmObj = $bpm->getById($id);
        if (!$bpmObj) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("No ticket selected!");
            } else {
                Enviropment::redirectBack("Не найден билет!");
            }
        }

        $isActorReady = false;
        if (($child && $bpmObj->userId == $user->parentUserId) || (!$child && $bpmObj->userId == $user->id)) {
            // echo "isActorReady<br/>";
            $isActorReady = true;
        }

        if ($isActorReady && $bpmObj->status == Basket::STATUS_NEW) {
            // запишив в лог, что пользователь удалил билет
            Logger::info("USER DEL PRODUCT BASKET: " . $bpmObj->id . ", userId: " . $bpmObj->userId . ", childId: " . $bpmObj->childId);
            Logger::info($bpmObj);

            $bpm->remove($bpmObj->id);
            $bm = new BasketManager();
            $bm->startTransaction();
            try {
                $bm->rebuildBasket($user->id);
                if ($user->parentUserId && $user->parentUserId != $user->id) {
                    $bm->rebuildBasket($user->parentUserId);
                }
            } catch (Exception $e) {
                $bm->rollbackTransaction();
                Logger::error($e);
                Enviropment::redirectBack(Enviropment::ERROR_MSG . "(4)");
            }
            $bm->commitTransaction();
            if ($this->lang == 'en') {
                Enviropment::redirectBack("Ticket removed");
            } else {
                Enviropment::redirectBack("Билет был удален");
            }
        } else {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("You cannot delete this ticket");
            } else {
                Enviropment::redirectBack("Данный билет нельзя удалить");
            }
        }
    }
}