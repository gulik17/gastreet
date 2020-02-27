<?php
/**
* Сущность пользователь
*
*/
class CashBack extends Entity {
    public $entityTable = 'cashBack';
    public $primaryKey = 'id';
    public $lastname = null;
    public $name = null;
    public $city = null;
    public $phone = null;
    public $email = null;
    public $summa = null;
    public $balance = null;
    public $tsUsed = null;

    function getFields() {
        return [
            "id" => self::ENTITY_FIELD_INT,
            "lastname" => self::ENTITY_FIELD_STRING,
            "name" => self::ENTITY_FIELD_STRING,
            "city" => self::ENTITY_FIELD_STRING,
            "phone" => self::ENTITY_FIELD_STRING,
            "email" => self::ENTITY_FIELD_STRING,
            "summa" => self::ENTITY_FIELD_STRING,
            "balance" => self::ENTITY_FIELD_STRING,
            "tsUsed" => self::ENTITY_FIELD_STRING,
        ];
    }
}