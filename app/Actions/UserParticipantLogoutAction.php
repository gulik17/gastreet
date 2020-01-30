<?php

/**
 *
 */
class UserParticipantLogoutAction extends AuthorizedUserAction implements IPublicAction {

    public function execute() {
        // проверить заполнен ли профайл данного пользователя
        UserManager::redirectIfNoProfile($this->actor);
        // есть ли кто-то в сессии
        $child = Context::getObject("__child");
        if ($child) {
            Context::clearObject("__child");
            Enviropment::redirect("basket", "Выход осуществлен");
        } else {
            Context::clearObject("__user");
            Context::clearObject("__master");
            Enviropment::redirect("/", "Выход осуществлен");
        }
    }
}