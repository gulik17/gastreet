<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 13.02.17
 * Time: 16:50
 */
class AreaType extends Entity {

    public $entityTable = 'areaType';
    public $primaryKey = 'id';
    public $name = null;
    public $tsCreated = null;
    public $tsUpdated = null;

    function getFields() {
        return array(
            'id' => self::ENTITY_FIELD_INT,
            'name' => self::ENTITY_FIELD_STRING,
            'tsCreated' => self::ENTITY_FIELD_INT,
            'tsUpdated' => self::ENTITY_FIELD_INT,
        );
    }
}