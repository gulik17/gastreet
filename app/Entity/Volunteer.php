<?php
/**
* Сущность пользователь
*
*/
class Volunteer extends Entity {
    const STATUS_ACTIVE = 'STATUS_ACTIVE';
    const STATUS_DISABLED = 'STATUS_DISABLED';
    public $entityTable = 'volunteer';
    public $primaryKey = 'id';
    public $sort = null;
    public $status = null;
    public $phone = null;
    public $email = null;
    public $lastname = null;
    public $name = null;
    public $cityName = null;
    public $countryName = null;
    public $company = null;
    public $position = null;
    public $description = null;
    public $years = null;
    public $facebook = null;
    public $vk = null;
    public $instagram = null;
    public $img = null;
    // тайминги
    public $ts_created = null;
    public $ts_updated = null;

    public static function getStatusDesc($stat = null) {
        $statList = array (
            self::STATUS_ACTIVE => "Активный",
            self::STATUS_DISABLED => "Выключен",
        );
        return $stat ? $statList[$stat] : $statList;
    }

    function getFields() {
        return array (
            "id" => self::ENTITY_FIELD_INT,
            "sort" => self::ENTITY_FIELD_INT,
            "status" => self::ENTITY_FIELD_STRING,
            "phone" => self::ENTITY_FIELD_STRING,
            "email" => self::ENTITY_FIELD_STRING,
            "lastname" => self::ENTITY_FIELD_STRING,
            "name" => self::ENTITY_FIELD_STRING,
            "cityName" => self::ENTITY_FIELD_STRING,
            "countryName" => self::ENTITY_FIELD_STRING,
            "company" => self::ENTITY_FIELD_STRING,
            "position" => self::ENTITY_FIELD_STRING,
            "description" => self::ENTITY_FIELD_STRING,
            "years" => self::ENTITY_FIELD_STRING,
            "facebook" => self::ENTITY_FIELD_STRING,
            "vk" => self::ENTITY_FIELD_STRING,
            "instagram" => self::ENTITY_FIELD_STRING,
            "img" => self::ENTITY_FIELD_STRING,
            "ts_created" => self::ENTITY_FIELD_INT,
            "ts_updated" => self::ENTITY_FIELD_INT,
        );
    }
}