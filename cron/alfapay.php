<?php

require_once __DIR__ . '/../config.core.php';

// требуется полный путь к файлам для запуска в режиме cli
require_once SOLO_CORE_PATH  . '/Config/framework.php';
require_once SOLO_CORE_PATH  . '/BaseApplication.php';
require_once SOLO_CORE_PATH  . '/Enviropment.php';
include_once APPLICATION_DIR . '/alfa-client/alfa.class.php';

$service = new AlfaService();
$payObj = $service->getAlfaPay();

//print_r($payObj);

if ($payObj) {
    $status = $service->getOrderStatus($payObj['monetaOperationId']);
    if (array_key_exists('ErrorCode', $status)) {
        /**
         *  Код ошибки      Описание
         *      0           Обработка запроса прошла без системных ошибок.
         *      2           Заказ отклонен по причине ошибки в реквизитах платежа.
         *      5           Доступ запрещён;
         *                  Пользователь должен сменить свой пароль;
         *                  Номер заказа не указан.
         *      6           Неизвестный номер заказа.
         *      7           Системная ошибка.
         *
         *  Статус заказа   Описание
         *      0           Заказ зарегистрирован, но не оплачен.
         *      1           Предавторизованная сумма захолдирована (для двухстадийных платежей).
         *      2           Проведена полная авторизация суммы заказа.
         *      3           Авторизация отменена.
         *      4           По транзакции была проведена операция возврата.
         *      5           Инициирована авторизация через ACS банка-эмитента.
         *      6           Авторизация отклонена. */
        $pm = new PayManager();
        if ($status['ErrorCode'] > 0) {
            $payObj = $pm->getById($payObj['id']);
            $payObj->status = Pay::STATUS_REJECT;
            $payObj->tsUpdated = time();
            $payObj = $pm->save($payObj);
        } else {
            if ($status['OrderStatus'] == 2) {
                $res = $pm->PayOrder($status['OrderNumber'], ($status['Amount']/100), $payObj['monetaOperationId']);
            } else if ($status['OrderStatus'] == 3) {
                $payObj = $pm->getById($payObj['id']);
                $payObj->status = Pay::STATUS_REJECT;
                $payObj->tsUpdated = time();
                $payObj = $pm->save($payObj);
            }
        }
    }
}

$payObj = $service->getAlfaPayBooking();

if ($payObj) {
    $status = $service->getOrderStatus($payObj['monetaOperationId']);

    if (array_key_exists('ErrorCode', $status)) {
        $pbm = new PayBookingManager();
        if ($status['ErrorCode'] > 0) {
            $payObj = $pbm->getById($payObj['id']);
            $payObj->status = PayBooking::STATUS_REJECT;
            $payObj->tsUpdated = time();
            $payObj = $pbm->save($payObj);
        } else {
            if ($status['OrderStatus'] == 2) {
                $res = $pm->PayBooking($status['OrderNumber'], ($status['Amount']/100), $payObj['monetaOperationId']);
            } else if ($status['OrderStatus'] == 3) {
                $payObj = $pbm->getById($payObj['id']);
                $payObj->status = PayBooking::STATUS_REJECT;
                $payObj->tsUpdated = time();
                $payObj = $pbm->save($payObj);
            }
        }
    }
}



$payObj = $service->getAlfaPayBalance();

if ($payObj) {
    $status = $service->getOrderStatus($payObj['monetaOperationId']);
    die();
    if (array_key_exists('ErrorCode', $status)) {
        $pbm = new PayBalanceManager();
        if ($status['ErrorCode'] > 0) {
            $payObj = $pbm->getById($payObj['id']);
            $payObj->status = PayBooking::STATUS_REJECT;
            $payObj->tsUpdated = time();
            $payObj = $pbm->save($payObj);
        } else {
            if ($status['OrderStatus'] == 2) {
                $res = $pm->PayBooking($status['OrderNumber'], ($status['Amount']/100), $payObj['monetaOperationId']);
            } else if ($status['OrderStatus'] == 3) {
                $payObj = $pbm->getById($payObj['id']);
                $payObj->status = PayBooking::STATUS_REJECT;
                $payObj->tsUpdated = time();
                $payObj = $pbm->save($payObj);
            }
        }
    }
}
