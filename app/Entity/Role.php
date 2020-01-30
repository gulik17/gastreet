<?php
/**
 * Роль оператора
 * 
 */
class Role extends Entity {
    public $entityTable = 'role';
    public $primaryKey = 'id';
	public $name = null;
	public $permissions = null;

	function __construct() {}

    function getFields() {
        return array(
            'id' => self::ENTITY_FIELD_INT,
			'name' => self::ENTITY_FIELD_STRING,
        	'permissions' => self::ENTITY_FIELD_STRING,
        );
    }	
}
