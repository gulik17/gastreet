<?php
/**
* Сущность попытка подтверждения мыла
*
*/
class EmailConfirmAttempt extends Entity {
    const EXPIRATION_DAYS = 3;

    const STATUS_NEW = 'STATUS_NEW';
    const STATUS_CONFIRMED = 'STATUS_CONFIRMED';
    const STATUS_EXPIRED = 'STATUS_EXPIRED';

    public $entityTable = 'emailConfirmAttempt';
    public $primaryKey = 'id';
	public $userId = null;
    public $email = null;
    public $confirmCode = null;
    public $status = null;
    public $ipGenerate = null;
    public $ipConfirm = null;
    public $tsGenerate = null;
    public $tsConfirm = null;

	function __construct() {}

    public static function getStatusDesc($stat = null) {
        $statList = array(
            self::STATUS_NEW => "Новый",
            self::STATUS_CONFIRMED => "Подтвержден",
            self::STATUS_EXPIRED => "Истек",
        );
        return $stat ? $statList[$stat] : $statList;
    }

	function getFields() {
       return array(
			"id" => self::ENTITY_FIELD_INT,
			"userId" => self::ENTITY_FIELD_INT,
			"email" => self::ENTITY_FIELD_STRING,
			"confirmCode" => self::ENTITY_FIELD_STRING,
			"status" => self::ENTITY_FIELD_STRING,
			"ipGenerate" => self::ENTITY_FIELD_STRING,
            "ipConfirm" => self::ENTITY_FIELD_STRING,
            "tsGenerate" => self::ENTITY_FIELD_INT,
            "tsConfirm" => self::ENTITY_FIELD_INT,
       );
    }
}