<?php

/**
 * Базовый класс для действий, требующих авторизации пользователя
 *
 */
class AuthorizedUserAction extends BaseAction implements IPublicAction {
    public function preExecute() {
        parent::preExecute();
        $isAjax = Request::getInt("isAjax");
        if ($this->actor == null || !($this->actor instanceof User)) {
            if ($isAjax) {
                echo json_encode("go_userlogin");
                exit;
            } else {
                if ($this->lang == 'en') {
                    Enviropment::redirect("userlogin", "Please log in", "danger");
                } else {
                    Enviropment::redirect("userlogin", "Необходимо войти на сайт", "danger");
                }
            }
        }

        // метку присутствия на сайте обновим 1 раз в 3 минуты
        if (time() - $this->actor->tsOnline > 60 * 3) {
            $um = new UserManager();
            $this->actor = $um->checkRegistered($this->actor);
            $um->updateVisitTime($this->actor->id);
        }
    }

    public function execute() {
        // не отрабатываем этот Action
        Request::redirect("/");
    }
}