<?php
/**
 *
 */
class UserType extends Entity {
    public $entityTable = 'userType';
    public $primaryKey = 'id';
    public $name = null;
    public $name_en = null;

	function __construct() {}

    function getFields() {
        return array (
            'id' => self::ENTITY_FIELD_INT,
            'name' => self::ENTITY_FIELD_STRING,
            'name_en' => self::ENTITY_FIELD_STRING,
        );
    }
}