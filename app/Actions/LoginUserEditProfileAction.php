<?php

/**
 *
 */
class LoginUserEditProfileAction extends AuthorizedUserAction implements IPublicAction {

    public function execute() {
        $id = Request::getInt("id");
        if (!$id) {
            if ($this->lang == 'en') {
                Enviropment::redirect("No participant ID entered");
            } else {
                Enviropment::redirect("Не указан ID участника");
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
                Enviropment::redirectBack("No participant found");
            } else {
                Enviropment::redirectBack("Не найден участник");
            }
        }

        // всё готово, записываем участника в сессию
        Context::setObject("__child", $child);

        Enviropment::redirect("usereditprofile");
    }
}