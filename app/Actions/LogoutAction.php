<?php
/**
* Выход с сайта
*
*/
class LogoutAction extends AuthorizedUserAction implements IPublicAction {
    public function execute() {
        Context::logOff();
        Context::clearObject("__child");
        Context::clearObject("__user");
        Context::clearObject("__master");
        Context::clearObject("code");
        Context::clearObject("recode");
        Context::clearObject("app");
        sleep(1);
        Enviropment::setCookie('forum_cookie', '');
        if ($this->lang == 'en') {
            Enviropment::redirect("/", "All the best, please visit us again!");
        } else {
            Enviropment::redirect("/", "Всего доброго, заходите ещё!");
        }
    }
}