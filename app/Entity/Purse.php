<?php
/**
 * Сущность Единый Кошелёк
 *
 */
class Purse extends Entity {
	public $entityTable = 'purse';
	public $primaryKey = 'id';
	public $userId = null;
	public $merchantId = null;
	public $skey = null;
	public $status = 1;

	function __construct() {}

	function getFields() {
		return array(
			'id' => self::ENTITY_FIELD_INT,
			'userId' => self::ENTITY_FIELD_INT,
			'merchantId' => self::ENTITY_FIELD_STRING,
			'skey' => self::ENTITY_FIELD_STRING,
			'status' => self::ENTITY_FIELD_INT,
		);
	}
}
