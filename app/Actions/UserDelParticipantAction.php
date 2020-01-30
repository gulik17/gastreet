<?php

/**
 *
 */
class UserDelParticipantAction extends AuthorizedUserAction implements IPublicAction {

    public function execute() {
        $id = Request::getInt("id");
        if (!$id) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("No participant ID entered", "danger");
            } else {
                Enviropment::redirectBack("Не указан ID участника", "danger");
            }
        }

        // надо разлогиниться доп.участником, если залогинен
        $um = new UserManager();
        $user = $this->actor;
        $child = Context::getObject("__child");
        if ($child) {
            $user = $um->getById($child->parentUserId);
            Context::clearObject("__child");
        }

        $child = $um->getByUserIdAndChildId($user->id, $id);
        if (!$child) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("No participant found", "danger");
            } else {
                Enviropment::redirectBack("Не найден участник", "danger");
            }
        }

        $canRemove = true;

        // проверим нет ли оплаченных заказов
        $bm = new BasketManager();
        $bmList = $bm->getTicketsByChildId($id);
        if (is_array($bmList) && count($bmList)) {
            foreach ($bmList AS $bmItem) {
                if ($bmItem['payAmount'] > 0 || $bmItem['ulAmount'] > 0 || $bmItem['returnedAmount'] > 0) {
                    $canRemove = false;
                    break;
                }
            }
        }

        // и мастерклассов
        $bpm = new BasketProductManager();
        $bpmList = $bpm->getProductsByChildId($id);
        if (is_array($bpmList) && count($bpmList)) {
            foreach ($bpmList AS $bpmItem) {
                if ($bpmItem['payAmount'] > 0 || $bpmItem['ulAmount'] > 0 || $bpmItem['returnedAmount'] > 0) {
                    $canRemove = false;
                    break;
                }
            }
        }

        if ($canRemove) {
            $um->startTransaction();
            try {
                // всё готово
                // удаляем корзины (тупо в цикле)
                if (is_array($bmList) && count($bmList)) {
                    foreach ($bmList AS $bmItem) {
                        $bm->remove($bmItem['id']);
                    }
                }
                if (is_array($bpmList) && count($bpmList)) {
                    foreach ($bpmList AS $bpmItem) {
                        $bpm->remove($bpmItem['id']);
                    }
                }
                // удаляем участника
                $um->remove($id);
            } catch (Exception $e) {
                $um->rollbackTransaction();
                Logger::error($e);
                if ($this->lang == 'en') {
                    Enviropment::redirectBack("Participant logged in, deletion impossible", "danger");
                } else {
                    Enviropment::redirectBack("Участник авторизован на сайте, удаление не возможно", "danger");
                }
            }
            $um->commitTransaction();
            if ($this->lang == 'en') {
                Enviropment::redirectBack("Participant deleted", "success");
            } else {
                Enviropment::redirectBack("Участник удален", "success");
            }
        } else {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("Participant cannot be removed since he/she made posted payments", "danger");
            } else {
                Enviropment::redirectBack("Участник не может быть удалён, т.к. имеет проведённые оплаты", "danger");
            }
        }
    }
}