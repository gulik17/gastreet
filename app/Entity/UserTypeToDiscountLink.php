<?php
/**
*
*/
class UserTypeToDiscountLink extends Entity {
    public $entityTable = 'userTypeToDiscountLink';
    public $primaryKey = 'id';
    public $areaId = null;
    public $discountId = null;

    function __construct() {}

	function getFields() {
       return array(
			"id" => self::ENTITY_FIELD_INT,
            "userTypeId" => self::ENTITY_FIELD_INT,
			"discountId" => self::ENTITY_FIELD_INT,
       );
    }
}
