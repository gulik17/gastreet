<?php

/**
 *
 */
class folkSpeaker extends Entity {
    const STATUS_ENABLED = 'STATUS_ENABLED';
    const STATUS_DISABLED = 'STATUS_DISABLED';
    const TYPE_SPEAKER = 'TYPE_SPEAKER';
    const TYPE_CHEF = 'TYPE_CHEF';

    const DESC_FINANCE = 'DESC_FINANCE';
    const DESC_GUEST = 'DESC_GUEST';
    const DESC_PERSONAL = 'DESC_PERSONAL';
    const DESC_CHEF = 'DESC_CHEF';
    const DESC_OTHER = 'DESC_OTHER';

    public $entityTable = 'folkSpeaker';
    public $primaryKey = 'id';
    public $status = null;
    public $first_name = null;
    public $last_name = null;
    public $user_type = null;
    public $speaker_desc = null;
    public $phone = null;
    public $email = null;
    public $company = null;
    public $position = null;
    public $description = null;
    public $photo = null;
    public $video = null;
    public $instagram = null;
    public $facebook = null;
    public $vkontakte = null;
    public $ondoklassniki = null;
    public $sort_order = null;
    public $ts_create = null;
    public $ts_update = null;

    public static function getStatusDesc($stat = null) {
        $statList = [
            self::STATUS_ENABLED => "Включено",
            self::STATUS_DISABLED => "Выключено",
        ];
        return $stat ? $statList[$stat] : $statList;
    }

    public static function getUserType($type = null) {
        $typeList = [
            self::TYPE_SPEAKER => "Спикер",
            self::TYPE_CHEF => "Шеф",
        ];
        return $type ? $typeList[$type] : $typeList;
    }

    public static function getSpeakerDesc($desc = null) {
        $descList = [
            self::DESC_FINANCE => "Финансы",
            self::DESC_GUEST => "Гости / Маркетинг",
            self::DESC_PERSONAL => "Персонал",
            self::DESC_CHEF => "Шефская",
            self::DESC_OTHER => "Другая",
        ];
        return $desc ? $descList[$desc] : $descList;
    }

    function getFields() {
        return [
            'id' => self::ENTITY_FIELD_INT,
            'status' => self::ENTITY_FIELD_STRING,
            'first_name' => self::ENTITY_FIELD_STRING,
            'last_name' => self::ENTITY_FIELD_STRING,
            'user_type' => self::ENTITY_FIELD_STRING,
            'speaker_desc' => self::ENTITY_FIELD_STRING,
            'phone' => self::ENTITY_FIELD_STRING,
            'email' => self::ENTITY_FIELD_STRING,
            'company' => self::ENTITY_FIELD_STRING,
            'position' => self::ENTITY_FIELD_STRING,
            'description' => self::ENTITY_FIELD_STRING,
            'photo' => self::ENTITY_FIELD_STRING,
            'video' => self::ENTITY_FIELD_STRING,
            'instagram' => self::ENTITY_FIELD_STRING,
            'facebook' => self::ENTITY_FIELD_STRING,
            'vkontakte' => self::ENTITY_FIELD_STRING,
            'ondoklassniki' => self::ENTITY_FIELD_STRING,
            'sort_order' => self::ENTITY_FIELD_INT,
            'ts_create' => self::ENTITY_FIELD_INT,
            'ts_update' => self::ENTITY_FIELD_INT,
        ];
    }
}
