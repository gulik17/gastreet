<?php

/**
 * Сущность рассылка всем на мыло
 *
 */
class Broadcast extends Entity {

    public $entityTable = 'broadcast';
    public $primaryKey = 'id';
    public $dateCreate;
    public $message;
    public $status = self::STATUS_NEW;

    const STATUS_NEW = "STATUS_NEW";
    const STATUS_APPROVED = "STATUS_APPROVED";
    const STATUS_DECLINED = "STATUS_DECLINED";
    const STATUS_SENT = "STATUS_SENT";

    function getFields() {
        return array(
            'id' => self::ENTITY_FIELD_INT,
            'dateCreate' => self::ENTITY_FIELD_INT,
            'message' => self::ENTITY_FIELD_STRING,
            'status' => self::ENTITY_FIELD_STRING,
        );
    }

}
