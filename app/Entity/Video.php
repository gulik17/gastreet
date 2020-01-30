<?php

class Video extends Entity {
    const STATUS_ENABLED = 'STATUS_ENABLED';
    const STATUS_DISABLED = 'STATUS_DISABLED';
    public $entityTable = 'video';
    public $primaryKey = 'id';
    public $sortOrder = null;
    public $v_group = null;
    public $name = null;
    public $name_en = null;
    public $url = null;
    public $status = null;
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
            'id'        => self::ENTITY_FIELD_INT,
            'v_group'   => self::ENTITY_FIELD_INT,
            'sortOrder' => self::ENTITY_FIELD_INT,
            'name'      => self::ENTITY_FIELD_STRING,
            'name_en'   => self::ENTITY_FIELD_STRING,
            'url'       => self::ENTITY_FIELD_STRING,
            'status'    => self::ENTITY_FIELD_STRING,
            'tsCreated' => self::ENTITY_FIELD_INT,
            'tsUpdated' => self::ENTITY_FIELD_INT,
        );
    }
}