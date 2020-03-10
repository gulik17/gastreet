<?php

/**
 *
 */
class Place extends Entity {
    const STATUS_ENABLED = 'STATUS_ENABLED';
    const STATUS_DISABLED = 'STATUS_DISABLED';

    public $entityTable = 'place';
    public $primaryKey = 'id';
    public $sortOrder = null;
    public $name = null;
    public $name_en = null;
    public $suptitle = null;
    public $subtitle = null;
    public $alias = null;
    public $phone = null;
    public $email = null;
    public $inclusive = null;
    public $notinclusive = null;
    public $stars = null;
    public $level = null;
    public $price = null;
    public $description = null;
    public $description_en = null;
    public $modal_desc = null;
    public $modal_desc_en = null;
    public $pic1 = null;
    public $pic2 = null;
    public $pic3 = null;
    public $pic4 = null;
    public $videoUrl = null;
    public $status = null;
    public $tsCreated = null;
    public $tsUpdated = null;

    public static function getStatusDesc($stat = null) {
        $statList = [
            self::STATUS_ENABLED => "Включено",
            self::STATUS_DISABLED => "Выключено",
        ];
        return $stat ? $statList[$stat] : $statList;
    }

    function getFields() {
        return [
            'id' => self::ENTITY_FIELD_INT,
            'sortOrder' => self::ENTITY_FIELD_INT,
            'name' => self::ENTITY_FIELD_STRING,
            'name_en' => self::ENTITY_FIELD_STRING,
            'suptitle' => self::ENTITY_FIELD_STRING,
            'subtitle' => self::ENTITY_FIELD_STRING,
            'alias' => self::ENTITY_FIELD_STRING,
            'phone' => self::ENTITY_FIELD_STRING,
            'email' => self::ENTITY_FIELD_STRING,
            'inclusive' => self::ENTITY_FIELD_STRING,
            'notinclusive' => self::ENTITY_FIELD_STRING,
            'stars' => self::ENTITY_FIELD_INT,
            'level' => self::ENTITY_FIELD_STRING,
            'price' => self::ENTITY_FIELD_STRING,
            'description' => self::ENTITY_FIELD_STRING,
            'description_en' => self::ENTITY_FIELD_STRING,
            'modal_desc' => self::ENTITY_FIELD_STRING,
            'modal_desc_en' => self::ENTITY_FIELD_STRING,
            'pic1' => self::ENTITY_FIELD_STRING,
            'pic2' => self::ENTITY_FIELD_STRING,
            'pic3' => self::ENTITY_FIELD_STRING,
            'pic4' => self::ENTITY_FIELD_STRING,
            'videoUrl' => self::ENTITY_FIELD_STRING,
            'status' => self::ENTITY_FIELD_STRING,
            'tsCreated' => self::ENTITY_FIELD_INT,
            'tsUpdated' => self::ENTITY_FIELD_INT,
        ];
    }
}