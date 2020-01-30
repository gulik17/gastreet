<?php

/**
 * Действие для входа в корзину по хэшу
 *
 */
class UserbasketAction extends BaseAction implements IPublicAction {
    public function execute() {
        Context::logOff();
        $code = Request::getVar("code");
        if (!$code) {
            if ($this->lang == 'en') {
                Enviropment::redirect("/", "No confirmation code entered", "danger");
            } else {
                Enviropment::redirect("/", "Не указан код подтверждения", "danger");
            }
        }

        $user = null;
        $um = new UserManager();
        $userIdArray = $um->getIdByBasketHash($code);
        if (isset($userIdArray[0])) {
            $user = $um->getById($userIdArray[0]);
        }
        if (!$user) {
            if ($this->lang == 'en') {
                Enviropment::redirect("/", "Incorrect confirmation code", "danger");
            } else {
                Enviropment::redirect("/", "Неверный код подтверждения", "danger");
            }
        }

        // авторизуем на сайте пользователя
        Context::setActor($user);
        if ($this->lang == 'en') {
            Enviropment::redirect("basket", "Please check your basket", "info");
        } else {
            Enviropment::redirect("basket", "Проверьте Вашу корзину", "info");
        }
    }
}