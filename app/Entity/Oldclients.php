<?php
/**
 */
class Oldclients extends Entity {
    public $entityTable = 'oldclients';
    public $primaryKey  = 'id';
    public $lastname    = null;
    public $name        = null;
    public $email       = null;
    public $phone       = null;
    public $year        = null;

    function __construct() {}
	
    function getFields() {
        return array (
            'id' => self::ENTITY_FIELD_INT,
            'lastname' => self::ENTITY_FIELD_STRING,
            'name' => self::ENTITY_FIELD_STRING,
            'email' => self::ENTITY_FIELD_STRING,
            'phone' => self::ENTITY_FIELD_STRING,
            'year' => self::ENTITY_FIELD_INT,
        );
    }
}
