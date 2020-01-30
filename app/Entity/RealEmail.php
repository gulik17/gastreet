<?php

/**
 * Таблица мыл Реала
 */
class RealEmail extends Entity {
    public $entityTable = 'realEmail';
    public $primaryKey = 'id';
    public $email = null;
    public $name = null;
    public $description = null;

    function getFields() {
        return array(
            'id' => self::ENTITY_FIELD_INT,
            'email' => self::ENTITY_FIELD_STRING,
            'name' => self::ENTITY_FIELD_STRING,
            'description' => self::ENTITY_FIELD_STRING,
        );
    }
}