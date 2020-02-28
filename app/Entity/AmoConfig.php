<?php

/**
 *
 */
class AmoConfig extends Entity {
    public $entityTable = 'amoConfig';
    public $primaryKey = 'id';
    public $access_token = null;
    public $refresh_token = null;
    public $expires_in = null;

    function getFields() {
        return [
            'id' => self::ENTITY_FIELD_INT,
            'access_token' => self::ENTITY_FIELD_STRING,
            'refresh_token' => self::ENTITY_FIELD_STRING,
            'expires_in' => self::ENTITY_FIELD_INT,
        ];
    }
}