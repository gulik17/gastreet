<?php

/**
 * 
 */
class ApplyCashBackAction extends AdminkaAction {
    public function execute() {
        $cbId = Request::getInt("id");
        if (!$cbId) {
            Adminka::redirect("managecashback", "Не задан ID пользователя");
        }
        $cbm = new CashBackManager();
        $cashback = $cbm->getById($cbId);
        if (!$cashback) {
            Adminka::redirect("managecashback", "Кэшбэк не найден");
        }
        if ($cashback->tsUsed > 0) {
            Adminka::redirect("managecashback", "Кэшбэк уже использован");
        }
        $cashback->tsUsed = time();
        $cbm->save($cashback);

        Adminka::redirect("managecashback", "Кэшбэк активирован");
    }
}