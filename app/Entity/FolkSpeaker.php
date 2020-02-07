<?php

/**
 *
 */
class FolkSpeaker extends Entity {
    const STATUS_ENABLED = 'STATUS_ENABLED';
    const STATUS_DISABLED = 'STATUS_DISABLED';

    public $entityTable = 'folkSpeaker';
    public $primaryKey = 'id';
    public $status = null;
    public $first_name = null;
    public $last_name = null;
    public $user_type = null;
    public $phone = null;
    public $email = null;
    public $company = null;
    public $position = null;
    public $text = null;
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

    function getFields() {
        return [
            'id' => self::ENTITY_FIELD_INT,
            'status' => self::ENTITY_FIELD_STRING,
            'first_name' => self::ENTITY_FIELD_STRING,
            'last_name' => self::ENTITY_FIELD_STRING,
            'user_type' => self::ENTITY_FIELD_STRING,
            'phone' => self::ENTITY_FIELD_STRING,
            'email' => self::ENTITY_FIELD_STRING,
            'company' => self::ENTITY_FIELD_STRING,
            'position' => self::ENTITY_FIELD_STRING,
            'text' => self::ENTITY_FIELD_STRING,
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
