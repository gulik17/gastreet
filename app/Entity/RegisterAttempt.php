<?php
/**
* Сущность попытка регистрации
*
*/
class RegisterAttempt extends Entity {
    public $entityTable = 'registerAttempt';
    public $primaryKey = 'id';
	public $phone = null;
    public $code = null;
    public $ip = null;
    public $ts = null;
    public $client = null;

    function __construct() {}

	function getFields() {
       return array(
			"id" => self::ENTITY_FIELD_INT,
			"phone" => self::ENTITY_FIELD_STRING,
			"code" => self::ENTITY_FIELD_STRING,
			"ip" => self::ENTITY_FIELD_STRING,
			"ts" => self::ENTITY_FIELD_INT,
			"client" => self::ENTITY_FIELD_STRING,
       );
    }
}