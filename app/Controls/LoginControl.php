<?php

/**
 * Контрол для визуального представления формы для
 * регистрации/входа нового пользователя
 */
class LoginControl extends IndexControl {
    public $pageTitle = "Вход — GASTREET 2020";
    public $pageTitle_en = "Login — GASTREET 2020";

    public function render() {
        if ($this->actor) {
            Enviropment::redirect("userarea", "Вы уже вошли на сайт");
        }
    }
}