<?php

/**
 * @version $Id: template.php 9 2010-01-19 11:00:28Z afi $
 * @author
 */
class CityLang extends Entity {
    public $entityTable = 'cityLang';
    public $primaryKey = 'id';
    public $alias = null;
    public $name = null;
    public $name_en = null;
    public $country_code = null;

    function __construct() {}

    function getFields() {
        return array(
            'id' => self::ENTITY_FIELD_INT,
            'alias' => self::ENTITY_FIELD_STRING,
            'name' => self::ENTITY_FIELD_STRING,
            'name_en' => self::ENTITY_FIELD_STRING,
            'country_code' => self::ENTITY_FIELD_STRING,
        );
    }
}