<?php
/**
 */
class Discount extends Entity {
    const STATUS_ENABLED = 'STATUS_ENABLED';
    const STATUS_DISABLED = 'STATUS_DISABLED';
    const STATUS_USED = 'STATUS_USED';

    const TYPE_REGULAR = 'TYPE_REGULAR';
    const TYPE_DISPOSABLE = 'TYPE_DISPOSABLE';

    public $entityTable = 'discount';
    public $primaryKey = 'id';
    public $userId = null;
    public $userTypeId = null;
    public $code = null;
    public $percent = null;
    public $type = null;
    public $status = null;

	function __construct() {}

    public static function getStatusDesc($stat = null) {
        $statList = array(
            self::STATUS_ENABLED => "Включено",
            self::STATUS_DISABLED => "Отключено",
            self::STATUS_USED => "Использовано",
        );
        return $stat ? $statList[$stat] : $statList;
    }

    public static function getTypeDesc($type = null) {
        $typeList = array(
            self::TYPE_DISPOSABLE => "Одноразовый",
            self::TYPE_REGULAR => "Многоразовый",
        );
        return $type ? $typeList[$type] : $typeList;
    }

    function getFields() {
        return array(
            "id" => self::ENTITY_FIELD_INT,
            "userId" => self::ENTITY_FIELD_INT,
            "userTypeId" => self::ENTITY_FIELD_INT,
            "code" => self::ENTITY_FIELD_STRING,
            "percent" => self::ENTITY_FIELD_STRING,
            "type" => self::ENTITY_FIELD_STRING,
            "status" => self::ENTITY_FIELD_STRING,
        );
    }
}