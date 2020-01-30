<?php

/**
 * Контрол для визуального представления формы для
 * регистрации нового пользователя
 */
class UserRegisterControl extends IndexControl {
    public $pageTitle = "Регистрация нового пользователя — GASTREET 2020";

    public function render() {
        if (Request::getVar("recode") == 'rebro') {
            Context::setObject('recode', 'rebro');
        }
        if ($this->actor) {
            if (Context::getObject('recode') == 'rebro') {
                Enviropment::redirect("basket");
            }
            Enviropment::redirect("userarea", "Вы уже вошли на сайт");
        }
    }
}