<?php
/**
 * ДАННЫЕ ДЛЯ ПОДКЛЮЧЕНИЯ К ПЛАТЕЖНОМУ ШЛЮЗУ
 *
 * USERNAME         Логин магазина, полученный при подключении.
 * PASSWORD         Пароль магазина, полученный при подключении.
 * GATEWAY_URL      Адрес платежного шлюза.
 * RETURN_URL       Адрес, на который надо перенаправить пользователя
 *                  в случае успешной оплаты.
 */

class AlfaService {
    const USERNAME = 'gastreet-api';
    const PASSWORD = '9nE+jXy+SYz+2uU';
    const GATEWAY_URL = 'https://pay.alfabank.ru/payment/rest/';
    const RETURN_URL = 'https://gastreet.com/basket';
    const FAIL_URL = 'https://gastreet.com/basket';

    /**
     * Функция для работы с CRON
     * Находит оплаты которые были сформированы для шлюза Альфа банка
     * Возвращает одну оплату, чтобы не нагружать систему
     * @throws Exception
     */
    public function getAlfaPay() {
        $bem = new BaseEntityManager();
        $sql = "SELECT * FROM `pay` AS p WHERE `p`.`type` = '" . Pay::TYPE_CARD . "' AND `p`.`tsCreated` > '" . (time() - 7200) . "' AND `p`.`status` = '" . Pay::STATUS_NEW . "' AND `p`.`monetaOperationId` IS NOT NULL ORDER BY `p`.`id` ASC";
        $res = $bem->getByAnySQL($sql)[0];
        return (strlen($res['monetaOperationId']) > 30) ? $res : null;
    }

    public function getAlfaPayBooking() {
        $bem = new BaseEntityManager();
        $sql = "SELECT * FROM `payBooking` AS p WHERE `p`.`status` = '" . PayBooking::STATUS_NEW . "' AND `p`.`monetaOperationId` IS NOT NULL ORDER BY `p`.`id` ASC";
        $res = $bem->getByAnySQL($sql)[0];
        return (strlen($res['monetaOperationId']) > 30) ? $res : null;
    }

    public function getAlfaPayBalance() {
        $bem = new BaseEntityManager();
        $sql = "SELECT * FROM `payBalance` AS p WHERE `p`.`status` = '" . PayBalance::STATUS_NEW . "' AND `p`.`monetaOperationId` IS NOT NULL ORDER BY `p`.`id` ASC";
        $res = $bem->getByAnySQL($sql)[0];
        return (strlen($res['monetaOperationId']) > 30) ? $res : null;
    }

    /**
     * ФУНКЦИЯ ДЛЯ ВЗАИМОДЕЙСТВИЯ С ПЛАТЕЖНЫМ ШЛЮЗОМ
     *
     * Для отправки POST запросов на платежный шлюз используется
     * стандартная библиотека cURL.
     *
     * ПАРАМЕТРЫ
     *      method      Метод из API.
     *      data        Массив данных.
     *
     * ОТВЕТ
     *      response    Ответ.
     */
    private function gateway($method, $data) {
        $curl = curl_init(); // Инициализируем запрос
        curl_setopt_array($curl, [
            CURLOPT_URL => static::GATEWAY_URL.$method, // Полный адрес метода
            CURLOPT_RETURNTRANSFER => true, // Возвращать ответ
            CURLOPT_POST => true, // Метод POST
            CURLOPT_POSTFIELDS => http_build_query($data) // Данные в запросе
        ]);
        $response = curl_exec($curl); // Выполняем запрос

        $response = json_decode($response, true); // Декодируем из JSON в массив
        curl_close($curl); // Закрываем соединение
        return $response; // Возвращаем ответ
    }

    public function getPaymentData($order_id, $cost, $description, $param = []) {
        $data = [
            'userName' => static::USERNAME,
            'password' => static::PASSWORD,
            'orderNumber' => urlencode($order_id),
            'amount' => urlencode($cost),
            'description' => $description,
            'returnUrl' => static::RETURN_URL,
            'failUrl' => static::FAIL_URL,
        ];

        if ($param) {
            $data['jsonParams'] =  json_encode([
                'email' => $param['email'],
                'phone' => $param['phone'],
            ]);
        }

        /**
         * ЗАПРОС РЕГИСТРАЦИИ ОДНОСТАДИЙНОГО ПЛАТЕЖА В ПЛАТЕЖНОМ ШЛЮЗЕ
         *      register.do
         *
         * ПАРАМЕТРЫ
         *      userName        Логин магазина.
         *      password        Пароль магазина.
         *      orderNumber     Уникальный идентификатор заказа в магазине.
         *      amount          Сумма заказа в копейках.
         *      returnUrl       Адрес, на который надо перенаправить пользователя в случае успешной оплаты.
         *
         * ОТВЕТ
         *      В случае ошибки:
         *          errorCode       Код ошибки. Список возможных значений приведен в таблице ниже.
         *          errorMessage    Описание ошибки.
         *
         *      В случае успешной регистрации:
         *          orderId         Номер заказа в платежной системе. Уникален в пределах системы.
         *          formUrl         URL платежной формы, на который надо перенаправить браузер клиента.
         *
         *  Код ошибки      Описание
         *      0           Обработка запроса прошла без системных ошибок.
         *      1           Заказ с таким номером уже зарегистрирован в системе.
         *      3           Неизвестная (запрещенная) валюта.
         *      4           Отсутствует обязательный параметр запроса.
         *      5           Ошибка значения параметра запроса.
         *      7           Системная ошибка.
         */
        return $this->gateway('register.do', $data);
    }

    /**
     * ОБРАБОТКА ДАННЫХ ПОСЛЕ ПЛАТЕЖНОЙ ФОРМЫ
     */
    public function getOrderStatus($orderId, $language = 'ru') {
        $data = [
            'userName' => static::USERNAME,
            'password' => static::PASSWORD,
            'orderId'  => $orderId,
            'language' => $language,
        ];

        /**
         * ЗАПРОС СОСТОЯНИЯ ЗАКАЗА
         *      getOrderStatus.do
         *
         * ПАРАМЕТРЫ
         *      userName        Логин магазина.
         *      password        Пароль магазина.
         *      orderId         Номер заказа в платежной системе. Уникален в пределах системы.
         *
         * ОТВЕТ
         *      ErrorCode       Код ошибки. Список возможных значений приведен в таблице ниже.
         *      OrderStatus     По значению этого параметра определяется состояние заказа в платежной системе.
         *                      Список возможных значений приведен в таблице ниже. Отсутствует, если заказ не был найден.
         *
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
         *      6           Авторизация отклонена.
         */
        return $this->gateway('getOrderStatus.do', $data);

        // Вывод кода ошибки и статус заказа
        //echo "<b>Error code:</b> {$response['ErrorCode']}<br>
        //<b>Order status:</b> {$response['OrderStatus']}<br>";
    }
}