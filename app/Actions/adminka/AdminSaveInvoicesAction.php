<?php

/**
 * получение CSV-файла
 * (страница «Счета на оплату»)
 * 
 * № счета
 * Дата счета
 * Наименование услуги
 * Сумма к оплате
 * Оплачено
 * Наименование контрагента
 * ИНН
 * КПП
 * БИК
 * К/сч
 * Р/сч
 * Почтовый адрес
 * Статус
 * Дата оплаты
 * ID пользователя
 * ФИО
 * Телефон */

class AdminSaveInvoicesAction extends AdminkaAction {

    const FIELD_DELIMITER = "\t";
    const LINE_DELIMITER = "\r\n";
    const STATUS_NEW = "STATUS_NEW";
    const STATUS_PAID = "STATUS_PAID";

    public function execute() {
        $invoicesManager = new InvoicesManager();
        $SQLResponse = $invoicesManager->getAllInvoice();

        $tableHeader = "№ счета" . self::FIELD_DELIMITER
                . "Дата счета" . self::FIELD_DELIMITER
                . "Наименование услуги" . self::FIELD_DELIMITER
                . "Сумма к оплате" . self::FIELD_DELIMITER
                . "Оплачено" . self::FIELD_DELIMITER
                . "Наименование контрагента" . self::FIELD_DELIMITER
                . "ИНН" . self::FIELD_DELIMITER
                . "КПП" . self::FIELD_DELIMITER
                . "БИК" . self::FIELD_DELIMITER
                . "К/сч" . self::FIELD_DELIMITER
                . "Р/сч" . self::FIELD_DELIMITER
                . "Почтовый адрес" . self::FIELD_DELIMITER
                . "Статус" . self::FIELD_DELIMITER
                . "Дата оплаты" . self::FIELD_DELIMITER
                . "ID пользователя" . self::FIELD_DELIMITER
                . "ФИО" . self::FIELD_DELIMITER
                . "Телефон";
        $tableHeader .= self::LINE_DELIMITER;

        $tableBody = "";

        if (is_array($SQLResponse) && count($SQLResponse)) {
            foreach ($SQLResponse as $element) {
                $tableBody .= $element["id"] . self::FIELD_DELIMITER
                        . self::timestampToDate($element["tsCreated"]) . self::FIELD_DELIMITER
                        . "Информационно-консультационные услуги" . self::FIELD_DELIMITER
                        . $element["needAmount"] . self::FIELD_DELIMITER
                        . $element["payAmount"] . self::FIELD_DELIMITER
                        . $element["company"] . self::FIELD_DELIMITER
                        . $element["inn"] . self::FIELD_DELIMITER
                        . $element["kpp"] . self::FIELD_DELIMITER
                        . $element["bik"] . self::FIELD_DELIMITER
                        . $element["corr"] . self::FIELD_DELIMITER
                        . $element["rs"] . self::FIELD_DELIMITER
                        . $element["address"] . self::FIELD_DELIMITER
                        . self::getStatusDescription($element["status"]) . self::FIELD_DELIMITER
                        . self::timestampToDate($element["tsUpdated"]) . self::FIELD_DELIMITER
                        . $element["userId"] . self::FIELD_DELIMITER
                        . $element["lastname"] . " " . $element["name"] . self::FIELD_DELIMITER
                        . $element["phone"] . self::FIELD_DELIMITER;
                $tableBody .= self::LINE_DELIMITER;
            }

            // Чистим лишние символы
            $table = $tableHeader . htmlspecialchars_decode($tableBody, ENT_QUOTES);
            // Задаем имя файла
            $fileName = "Счета на оплату.csv";
            // Способ кодирования содержимого сущности при передаче.
            header('Content-Encoding: UTF-8');
            // Способ распределения сущностей в сообщении при передаче нескольких фрагментов.
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            // Формат и способ представления сущности.
            header('Content-Type: text/csv; charset=UTF-8');
            // Дата предполагаемого истечения срока актуальности сущности.
            header('Expires: 0');
            echo "\xEF\xBB\xBF";  // UTF-8 BOM
            echo $table;
            exit;
        } else {
            Adminka::redirect("manageinvoices", "В БД нет данных для выгрузки!");
        }
    }

    private static function getStatusDescription($status) {
        $status = strval($status);
        $statusList = array(
            self::STATUS_NEW => "Новый",
            self::STATUS_PAID => "Оплачен"
        );
        return array_key_exists($status, $statusList) ? $statusList[$status] : $status;
    }

    private static function timestampToDate($timestamp) {
        if (intval($timestamp)) {
            $format = "d.m.Y H:i:s";  // например, 31.12.2017 23:59:59
            return date($format, intval($timestamp));
        } else {
            return $timestamp;
        }
    }
}