<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 15.02.17
 * Time: 20:20
 */
class BroadcastQueue extends Entity {

    public $entityTable = 'broadcastQueue';
    public $primaryKey = 'id';
    public $broadcastId = null;
    public $userId = null;
    public $status = null;
    public $tsCreated = null;
    public $tsUpdated = null;

    const STATUS_ERROR = 0;
    const STATUS_OK = 1;

    public static function getStatusDesc($stat = null) {
        $statList = array(
            self::STATUS_ERROR => 'Ошибка',
            self::STATUS_OK => 'Успех',
        );
        return $stat ? $statList[$stat] : $statList;
    }

    function getFields() {
        return array(
            'id' => self::ENTITY_FIELD_INT,
            'broadcastId' => self::ENTITY_FIELD_INT,
            'userId' => self::ENTITY_FIELD_INT,
            'status' => self::ENTITY_FIELD_INT,
            'tsCreated' => self::ENTITY_FIELD_INT,
            'tsUpdated' => self::ENTITY_FIELD_INT
        );
    }

}
