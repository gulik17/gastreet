<?php

/**
 *
 */
class BaseTicketToDiscountLink extends Entity {
    const STATUS_ENABLED = 'STATUS_ENABLED';
    const STATUS_DISABLED = 'STATUS_DISABLED';

    public $entityTable = 'baseTicketToDiscountLink';
    public $primaryKey = 'id';
    public $baseTicketId = null;
    public $discountId = null;

    function getFields() {
        return array(
            "id" => self::ENTITY_FIELD_INT,
            "baseTicketId" => self::ENTITY_FIELD_INT,
            "discountId" => self::ENTITY_FIELD_INT,
        );
    }
}