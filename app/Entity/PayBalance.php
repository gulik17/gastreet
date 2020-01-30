<?php
/**
 *
 */
class PayBalance extends Entity {
    const STATUS_NEW = 'STATUS_NEW';
    const STATUS_PAID = 'STATUS_PAID';

	public $entityTable = 'payBalance';
	public $primaryKey = 'id';
    public $userId = null;
    public $parenentId = null;
    public $userCardId = null;
    public $needAmount = null;
    public $payAmount = null;
    public $status = null;
    public $tsCreated = null;
    public $tsUpdated = null;
    public $monetaOperationId = null;

	function __construct() {}

    public static function getStatusDesc($stat = null) {
        $statList = array(
            self::STATUS_NEW => "Новый",
            self::STATUS_PAID => "Оплачен",
        );
        return $stat ? $statList[$stat] : $statList;
    }

	function getFields() {
		return array(
			'id' => self::ENTITY_FIELD_INT,
            'userId' => self::ENTITY_FIELD_INT,
            'parenentId' => self::ENTITY_FIELD_INT,
            'userCardId' => self::ENTITY_FIELD_INT,
			'needAmount' => self::ENTITY_FIELD_STRING,
            'payAmount' => self::ENTITY_FIELD_STRING,
			'status' => self::ENTITY_FIELD_STRING,
            'tsCreated' => self::ENTITY_FIELD_INT,
            'tsUpdated' => self::ENTITY_FIELD_INT,
            'monetaOperationId' => self::ENTITY_FIELD_STRING,
		);
	}
}
