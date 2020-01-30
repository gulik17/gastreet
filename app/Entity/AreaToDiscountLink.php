<?php

/**
 *
 */
class AreaToDiscountLink extends Entity {

    public $entityTable = 'areaToDiscountLink';
    public $primaryKey = 'id';
    public $areaId = null;
    public $discountId = null;

    function getFields() {
        return array(
            "id" => self::ENTITY_FIELD_INT,
            "areaId" => self::ENTITY_FIELD_INT,
            "discountId" => self::ENTITY_FIELD_INT,
        );
    }
}