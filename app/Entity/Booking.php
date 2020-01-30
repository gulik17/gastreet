<?php

/**
 */
class Booking extends Entity {

    const STATUS_NEW = 'STATUS_NEW';
    const STATUS_PAID = 'STATUS_PAID';

    public $entityTable = 'booking';
    public $primaryKey = 'id';
    public $userId = null;
    public $childId = null;
    public $tsCreate = null;
    public $tsPay = null;
    public $tsFinish = null;
    public $payAmount = null;
    public $monetaOperationId = null;
    public $status = null;

    function getFields() {
        return array(
            'id' => self::ENTITY_FIELD_INT,
            'userId' => self::ENTITY_FIELD_INT,
            'childId' => self::ENTITY_FIELD_INT,
            'tsCreate' => self::ENTITY_FIELD_INT,
            'tsPay' => self::ENTITY_FIELD_INT,
            'tsFinish' => self::ENTITY_FIELD_INT,
            'payAmount' => self::ENTITY_FIELD_STRING,
            'monetaOperationId' => self::ENTITY_FIELD_STRING,
            'status' => self::ENTITY_FIELD_STRING,
        );
    }

}
