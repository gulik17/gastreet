<?php

/**
 *
 */
class Area extends Entity {
    const STATUS_ENABLED = 'STATUS_ENABLED';
    const STATUS_DISABLED = 'STATUS_DISABLED';
    public $entityTable = 'area';
    public $primaryKey = 'id';
    public $name = null;
    public $name_en = null;
    public $description = null;
    public $description_en = null;
    public $pic1 = null;
    public $color = null;
    public $status = null;
    public $areaTypeId = null;
    public $photoDescription = null;
    public $annotation = null;
    public $url = null;
    public $sortOrder = null;
    public $tsCreated = null;
    public $tsUpdated = null;

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
            'name' => self::ENTITY_FIELD_STRING,
            'name_en' => self::ENTITY_FIELD_STRING,
            'description' => self::ENTITY_FIELD_STRING,
            'description_en' => self::ENTITY_FIELD_STRING,
            'pic1' => self::ENTITY_FIELD_STRING,
            'color' => self::ENTITY_FIELD_STRING,
            'status' => self::ENTITY_FIELD_STRING,
            'areaTypeId' => self::ENTITY_FIELD_INT,
            'photoDescription' => self::ENTITY_FIELD_STRING,
            'annotation' => self::ENTITY_FIELD_STRING,
            'url' => self::ENTITY_FIELD_STRING,
            'sortOrder' => self::ENTITY_FIELD_INT,
            'tsCreated' => self::ENTITY_FIELD_INT,
            'tsUpdated' => self::ENTITY_FIELD_INT,
        );
    }
}