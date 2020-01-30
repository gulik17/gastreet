<?php
/**
 *
 */
class UserQrCode extends Entity {
    const STATUS_ACTIVE = 'STATUS_ACTIVE';
    const STATUS_REMOVED = 'STATUS_REMOVED';

	public $entityTable = 'userQrCode';
	public $primaryKey = 'id';
    public $userId = null;
    public $parenentId = null;
    public $code = null;
    public $status = null;
    public $tsCreated = null;
    public $tsUpdated = null;

	function __construct() {}

    public static function getStatusDesc($stat = null) {
        $statList = array(
            self::STATUS_ACTIVE => "Активен",
            self::STATUS_REMOVED => "Удалён",
        );
        return $stat ? $statList[$stat] : $statList;
    }

	function getFields() {
		return array(
			'id' => self::ENTITY_FIELD_INT,
            'userId' => self::ENTITY_FIELD_INT,
            'parenentId' => self::ENTITY_FIELD_INT,
            'code' => self::ENTITY_FIELD_STRING,
			'status' => self::ENTITY_FIELD_STRING,
            'tsCreated' => self::ENTITY_FIELD_INT,
            'tsUpdated' => self::ENTITY_FIELD_INT,
		);
	}
}
