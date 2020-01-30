<?php
/**
 * Нотификации по каментам
 */
class CoNotification extends Entity {
	public $entityTable = 'coNotification';
	public $primaryKey = 'id';
	public $userId = null;
	public $dateUpdate = null;

	function __construct() {}

    function getFields() {
        return array(
            'id' => self::ENTITY_FIELD_INT,
			'userId' => self::ENTITY_FIELD_INT,
			'dateUpdate' => self::ENTITY_FIELD_INT,
        );
    }
}