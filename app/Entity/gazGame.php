<?php

/**
 * Баскетбол ГАЗ
 *
 */
class gazGame extends Entity {
    public $entityTable = 'gazGame';
    public $primaryKey = 'id';
    public $user_id = null;
    public $tsCreated = null;
    public $team = null;

    function getFields() {
        return array (
            "id" => self::ENTITY_FIELD_INT,
            "user_id" => self::ENTITY_FIELD_INT,
            "tsCreated" => self::ENTITY_FIELD_INT,
            "team" => self::ENTITY_FIELD_STRING,
        );
    }
}