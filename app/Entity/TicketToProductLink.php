<?php

/**
 *
 */
class TicketToProductLink extends Entity {
    public $entityTable = 'ticketToProductLink';
    public $primaryKey = 'id';
    public $baseTicketId = null;
    public $productId = null;

    function getFields() {
        return array(
            "id" => self::ENTITY_FIELD_INT,
            "baseTicketId" => self::ENTITY_FIELD_INT,
            "productId" => self::ENTITY_FIELD_INT,
        );
    }
}