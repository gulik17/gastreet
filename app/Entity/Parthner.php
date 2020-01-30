<?php

/**
 *
 */
class Parthner extends Entity {

    const STATUS_ENABLED = 'STATUS_ENABLED';
    const STATUS_DISABLED = 'STATUS_DISABLED';

    public $entityTable = 'parthner';
    public $primaryKey = 'id';
    public $sortOrder = null;
    public $name = null;
    public $url = null;
    public $title = null;
    public $pic = null;
    public $parthnerTypeId = null;
    public $tsUpdate = null;
    public $status = null;

    function __construct() {
        
    }

    public static function getStatusDesc($stat = null) {
        $statList = array(
            self::STATUS_ENABLED => "Включено",
            self::STATUS_DISABLED => "Выключено",
        );
        return $stat ? $statList[$stat] : $statList;
    }

    function getFields() {
        return array(
            'id' => self::ENTITY_FIELD_INT,
            'sortOrder' => self::ENTITY_FIELD_INT,
            'name' => self::ENTITY_FIELD_STRING,
            'url' => self::ENTITY_FIELD_STRING,
            'title' => self::ENTITY_FIELD_STRING,
            'pic' => self::ENTITY_FIELD_STRING,
            'parthnerTypeId' => self::ENTITY_FIELD_INT,
            'tsUpdate' => self::ENTITY_FIELD_INT,
            'status' => self::ENTITY_FIELD_STRING,
        );
    }
}