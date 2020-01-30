<?php

/**
 *
 */
class LoginActorEditProfileAction extends AuthorizedUserAction implements IPublicAction {
    public function execute() {
        // есть ли кто-то в сессии
        $child = Context::getObject("__child");
        if ($child) {
            Context::clearObject("__child");
            Enviropment::redirect("usereditprofile");
        } else {
            Enviropment::redirect("usereditprofile");
        }
    }
}