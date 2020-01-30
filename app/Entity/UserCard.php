<?php
/**
 *
 */
class UserCard extends Entity {
    const STATUS_NEW = 'STATUS_NEW';

	public $entityTable = 'userCard';
	public $primaryKey = 'id';
    public $userId = null;
    public $parenentId = null;
    public $cardnumber = null;
    public $paymenttoken = null;
    public $status = null;
    public $tsCreated = null;
    public $tsUpdated = null;

	function __construct() {}

    public static function getStatusDesc($stat = null) {
        $statList = array(
            self::STATUS_NEW => "Новая",
        );
        return $stat ? $statList[$stat] : $statList;
    }

	function getFields() {
		return array(
			'id' => self::ENTITY_FIELD_INT,
            'userId' => self::ENTITY_FIELD_INT,
			'parenentId' => self::ENTITY_FIELD_INT,
			'cardnumber' => self::ENTITY_FIELD_STRING,
            'paymenttoken' => self::ENTITY_FIELD_STRING,
            'status' => self::ENTITY_FIELD_STRING,
            'tsCreated' => self::ENTITY_FIELD_INT,
            'tsUpdated' => self::ENTITY_FIELD_INT,
		);
	}
}
