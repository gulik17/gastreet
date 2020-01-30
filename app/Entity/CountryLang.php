<?php

/**
 * @version $Id: template.php 9 2010-01-19 11:00:28Z afi $
 * @author */
class countryLang extends Entity {
    public $entityTable = 'countryLang';
    public $primaryKey = 'id';
    public $alias = null;
    public $name = null;
    public $name_en = null;

    function __construct() {}

    function getFields() {
        return array(
            'id' => self::ENTITY_FIELD_INT,
            'alias' => self::ENTITY_FIELD_STRING,
            'name' => self::ENTITY_FIELD_STRING,
            'name_en' => self::ENTITY_FIELD_STRING,
        );
    }
}