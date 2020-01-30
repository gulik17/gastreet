<?php
/**
 * Лог действий операторов
 * 
 */
class OperLog extends Entity {
    public $entityTable = 'operLog';
    public $primaryKey = 'id';
	public $operId = null;
	public $actionName = null;
	public $entityName = null;
	public $entityId = null;
	public $actionDateTime = null;

	function __construct() {}

    function getFields() {
        return array(
            'id' => self::ENTITY_FIELD_INT,
			'operId' => self::ENTITY_FIELD_INT,
        	'actionName' => self::ENTITY_FIELD_STRING,
			'entityName' => self::ENTITY_FIELD_STRING,
			'entityId' => self::ENTITY_FIELD_INT,
			'actionDateTime' => self::ENTITY_FIELD_INT,
        );
    }	
}
