<?php

/**
 * Контрол для визуального представления формы для
 * регистрации/входа нового пользователя
 */
class LoginControl extends IndexControl {
    public $pageTitle = "Вход — GASTREET 2021";
    public $pageTitle_en = "Login — GASTREET 2021";

    public function render() {
        if ($this->actor) {
            Enviropment::redirect("userarea", "Вы уже вошли на сайт");
        }
    }
}