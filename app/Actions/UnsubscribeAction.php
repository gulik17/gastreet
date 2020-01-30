<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 26.02.17
 * Time: 18:38
 */
class UnsubscribeAction extends BaseAction {

    public function execute() {
        $code = Request::getVar("code");
        $code = addslashes($code);
        $um = new UserManager();
        if (!empty($code)) {
            $users = $um->get(new SQLCondition('disableBroadcastKey = \'' . $code . '\''));
            if (!is_null($users)) {
                /** @var User $user */
                $user = $users[0];
                $user->disableBroadcast = 1;
                $um->save($user);
                if ($this->lang == 'en') {
                    Enviropment::redirect("/", "You have been unsubscribed from the mailing list", "success");
                } else {
                    Enviropment::redirect("/", "Вы отключены от рассылки", "success");
                }
            } else {
                if ($this->lang == 'en') {
                    Enviropment::redirect("/", "No user found", "danger");
                } else {
                    Enviropment::redirect("/", "Пользователь не найден", "danger");
                }
            }
        } else {
            if ($this->lang == 'en') {
                Enviropment::redirect("/", "No parameter set", "danger");
            } else {
                Enviropment::redirect("/", "Не задан параметр", "danger");
            }
        }
    }

}
