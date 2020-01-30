<?php

/**
 * Корзина
 *
 */
class Basket extends Entity {

    const STATUS_NEW = 'STATUS_NEW';
    const STATUS_PAID = 'STATUS_PAID';

    public $entityTable = 'basket';
    public $primaryKey = 'id';
    public $userId = null;
    public $childId = null;
    public $payId = null;
    public $tsCreated = null;
    public $tsUpdated = null;
    public $tsPay = null;
    public $baseTicketId = null;
    public $baseTicketName = null;
    public $baseTicketName_en = null;
    public $baseTicketStatus = null;
    public $needAmount = null;
    public $payAmount = null;
    public $discountAmount = null;
    public $returnedAmount = null;
    public $ulAmount = null;
    public $discountId = null;
    public $discountCode = null;
    public $discountPercent = null;
    public $discountType = null;
    public $discountUserTypeId = null;
    public $monetaOperationId = null;
    public $status = null;

    public static function getStatusDesc($stat = null, $lang = null) {
        if ($lang == 'en') {
            $statList = array(
                self::STATUS_NEW => "Not paid",
                self::STATUS_PAID => "Paid",
            );
        } else {
            $statList = array(
                self::STATUS_NEW => "Не оплачено",
                self::STATUS_PAID => "Оплачено",
            );
        }
        return $stat ? $statList[$stat] : $statList;
    }

    function getFields() {
        return array(
            "id" => self::ENTITY_FIELD_INT,
            "userId" => self::ENTITY_FIELD_INT,
            "childId" => self::ENTITY_FIELD_INT,
            "payId" => self::ENTITY_FIELD_INT,
            "tsCreated" => self::ENTITY_FIELD_INT,
            "tsUpdated" => self::ENTITY_FIELD_INT,
            "tsPay" => self::ENTITY_FIELD_INT,
            "baseTicketId" => self::ENTITY_FIELD_INT,
            "baseTicketName" => self::ENTITY_FIELD_STRING,
            "baseTicketName_en" => self::ENTITY_FIELD_STRING,
            "baseTicketStatus" => self::ENTITY_FIELD_STRING,
            "needAmount" => self::ENTITY_FIELD_STRING,
            "payAmount" => self::ENTITY_FIELD_STRING,
            "discountAmount" => self::ENTITY_FIELD_STRING,
            "returnedAmount" => self::ENTITY_FIELD_STRING,
            "ulAmount" => self::ENTITY_FIELD_STRING,
            "discountId" => self::ENTITY_FIELD_INT,
            "discountCode" => self::ENTITY_FIELD_STRING,
            "discountPercent" => self::ENTITY_FIELD_INT,
            "discountType" => self::ENTITY_FIELD_STRING,
            "discountUserTypeId" => self::ENTITY_FIELD_INT,
            "monetaOperationId" => self::ENTITY_FIELD_STRING,
            "status" => self::ENTITY_FIELD_STRING,
        );
    }

}
