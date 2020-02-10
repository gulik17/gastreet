<?php

/**
 *
 */
class folkPhones extends Entity {
    const STATUS_CONFIRM = 'STATUS_CONFIRM';
    const STATUS_NEW = 'STATUS_NEW';

    public $entityTable = 'folkPhones';
    public $primaryKey = 'id';
    public $speaker_id = null;
    public $phone = null;
    public $code = null;
    public $status = null;
    public $ts_update = null;

    public static function getStatusDesc($stat = null) {
        $statList = [
            self::STATUS_CONFIRM => "Подтвержден",
            self::STATUS_NEW => "Новый",
        ];
        return $stat ? $statList[$stat] : $statList;
    }

    function getFields() {
        return [
            'id' => self::ENTITY_FIELD_INT,
            'speaker_id' => self::ENTITY_FIELD_INT,
            'phone' => self::ENTITY_FIELD_STRING,
            'code' => self::ENTITY_FIELD_INT,
            'status' => self::ENTITY_FIELD_STRING,
            'ts_update' => self::ENTITY_FIELD_INT,
        ];
    }
}
