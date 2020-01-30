<?php

/**
 * cp project
 * Сущность связь автор - сайт
 */
class Authorsite extends Entity {
    public $entityTable = 'authorsite';
    public $primaryKey = 'id';
    public $userId = null;
    public $siteId = null;
    public $dateCreate = null;
    public $status = null;

    const STATUS_ENABLED = 'STATUS_ENABLED';
    const STATUS_DISABLED = 'STATUS_DISABLED';

    function getFields() {
        return array(
            "id" => self::ENTITY_FIELD_INT,
            "userId" => self::ENTITY_FIELD_INT,
            "siteId" => self::ENTITY_FIELD_INT,
            "dateCreate" => self::ENTITY_FIELD_INT,
            'status' => self::ENTITY_FIELD_STRING,
        );
    }
}