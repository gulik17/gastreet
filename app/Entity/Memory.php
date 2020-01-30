<?php

/**
 * Корзина
 *
 */
class Memory extends Entity {
    const STATUS_NEW = 'STATUS_NEW';
    const STATUS_OK = 'STATUS_OK';

    public $entityTable = 'memory';
    public $primaryKey = 'id';
    public $user_id = null;
    public $subject = null;
    public $message = null;
    public $status = null;
    public $ts_created = null;

    public static function getStatusDesc($stat = null, $lang = null) {
        if ($lang == 'en') {
            $statList = array(
                self::STATUS_NEW => "New",
                self::STATUS_OK => "Moderated",
            );
        } else {
            $statList = array(
                self::STATUS_NEW => "Новый",
                self::STATUS_OK => "Опубликован",
            );
        }
        return $stat ? $statList[$stat] : $statList;
    }

    function getFields() {
        return array(
            "id" => self::ENTITY_FIELD_INT,
            "user_id" => self::ENTITY_FIELD_INT,
            "subject" => self::ENTITY_FIELD_STRING,
            "message" => self::ENTITY_FIELD_STRING,
            "status" => self::ENTITY_FIELD_STRING,
            "ts_created" => self::ENTITY_FIELD_INT,
        );
    }

}
