<?php
/**
 *
 */
class ReloginactorAction extends AuthorizedUserAction implements IPublicAction {
    public function execute() {
        // есть ли кто-то в сессии
        $child = Context::getObject("__child");
        if ($child) {
            Context::clearObject("__child");
            UserManager::redirectIfNoProfile($this->actor);
            if ($this->lang == 'en') {
                Enviropment::redirect("catalog", "Please proceed to shopping", "info");
            } else {
                Enviropment::redirect("catalog", "Совершайте покупки", "info");
            }
        } else {
            UserManager::redirectIfNoProfile($this->actor);
            Enviropment::redirect("catalog");
        }
    }
}