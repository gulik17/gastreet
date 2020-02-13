<?php

require_once __DIR__ . '/../config.core.php';

// требуется полный путь к файлам для запуска в режиме cli
require_once SOLO_CORE_PATH  . '/Config/framework.php';
require_once SOLO_CORE_PATH  . '/BaseApplication.php';
require_once SOLO_CORE_PATH  . '/Enviropment.php';
include_once APPLICATION_DIR . '/alfa-client/alfa.class.php';

//print_r(__DIR__);

//Logger::init(Configurator::getSection("logger"));

$pm = new PayManager();
$pmObj = $pm->getAlfaPay();

if ($pmObj) {
    $service = new AlfaService();
    $status = $service->getOrderStatus($pmObj['monetaOperationId']);

    //print_r($pmObj);

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

        if ($status['ErrorCode'] > 0) {
            $pmObj = $pm->getById($pmObj['id']);
            $pmObj->status = Pay::STATUS_REJECT;
            $pmObj->tsUpdated = time();
            $pmObj = $pm->save($pmObj);
        } else {
            if ($status['OrderStatus'] == 2) {
                $res = $pm->PayOrder($status['OrderNumber'], ($status['Amount']/100), $pmObj['monetaOperationId']);
            } else if ($status['OrderStatus'] == 3) {
                $pmObj = $pm->getById($pmObj['id']);
                $pmObj->status = Pay::STATUS_REJECT;
                $pmObj->tsUpdated = time();
                $pmObj = $pm->save($pmObj);
            }
        }
        //deb($status, 0);
    }
}
$pmObj = null;
$pbm = new PayBookingManager();
$pmObj = $pm->getAlfaPayBooking();

if ($pmObj) {
    $service = new AlfaService();
    $status = $service->getOrderStatus($pmObj['monetaOperationId']);

    print_r($pmObj);

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

        if ($status['ErrorCode'] > 0) {
            $pmObj = $pbm->getById($pmObj['id']);
            $pmObj->status = PayBooking::STATUS_REJECT;
            $pmObj->tsUpdated = time();
            $pmObj = $pbm->save($pmObj);
        } else {
            if ($status['OrderStatus'] == 2) {
                $res = $pm->PayBooking($status['OrderNumber'], ($status['Amount']/100), $pmObj['monetaOperationId']);
            } else if ($status['OrderStatus'] == 3) {
                $pmObj = $pbm->getById($pmObj['id']);
                $pmObj->status = PayBooking::STATUS_REJECT;
                $pmObj->tsUpdated = time();
                $pmObj = $pbm->save($pmObj);
            }
        }
        //deb($status, 0);
    }
}