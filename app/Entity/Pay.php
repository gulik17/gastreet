<?php

/**
 *
 */
class Pay extends Entity {
    // Статусы оплаты
    const STATUS_NEW = 'STATUS_NEW';
    const STATUS_PAID = 'STATUS_PAID';
    const STATUS_REJECT = 'STATUS_REJECT';
    // Типы оплаты
    const TYPE_CARD = 'TYPE_CARD';
    const TYPE_BALANCE = 'TYPE_BALANCE';
    const TYPE_CARD_RECURRENT = 'TYPE_CARD_RECURRENT';
    const TYPE_INVOICE = 'TYPE_INVOICE';
    const TYPE_CREDIT = 'TYPE_CREDIT';

    public $entityTable = 'pay'; // Имя таблицы
    public $primaryKey = 'id';  // Индекс таблицы Pay
    // Поля таблицы Pay
    public $userId = null;
    public $parenentId = null;
    public $userCardId = null;
    public $baseTicketId = null;
    public $productId = null;
    public $needAmount = null;
    public $discountId = null;
    public $payAmount = null;
    public $status = null;
    public $type = null;
    public $tsCreated = null;
    public $tsUpdated = null;
    public $monetaOperationId = null;
    public $payForTicketIds = null;
    public $payForProductIds = null;

    public static function getStatusDesc($stat = null) {
        $statList = array(
            self::STATUS_NEW => "Новый",
            self::STATUS_PAID => "Оплачен",
            self::STATUS_REJECT => "Отклонен",
        );
        return $stat ? $statList[$stat] : $statList;
    }

    public static function getTypeDesc($type = null) {
        $typeList = array(
            self::TYPE_BALANCE => "Пополнение баланса",
            self::TYPE_CARD => "Оплата картой",
            self::TYPE_CARD_RECURRENT => "Оплата сохраненной картой",
            self::TYPE_INVOICE => "Счёт на безналичку",
            self::TYPE_CREDIT => "Оплата в кредит",
        );
        return $type ? $typeList[$type] : $typeList;
    }

    function getFields() {
        return array(
            'id' => self::ENTITY_FIELD_INT,
            'userId' => self::ENTITY_FIELD_INT,
            'parenentId' => self::ENTITY_FIELD_INT,
            'userCardId' => self::ENTITY_FIELD_INT,
            'baseTicketId' => self::ENTITY_FIELD_INT,
            'productId' => self::ENTITY_FIELD_INT,
            'needAmount' => self::ENTITY_FIELD_STRING,
            'discountId' => self::ENTITY_FIELD_INT,
            'payAmount' => self::ENTITY_FIELD_STRING,
            'status' => self::ENTITY_FIELD_STRING,
            'type' => self::ENTITY_FIELD_STRING,
            'tsCreated' => self::ENTITY_FIELD_INT,
            'tsUpdated' => self::ENTITY_FIELD_INT,
            'monetaOperationId' => self::ENTITY_FIELD_STRING,
            'payForTicketIds' => self::ENTITY_FIELD_STRING,
            'payForProductIds' => self::ENTITY_FIELD_STRING,
        );
    }
}