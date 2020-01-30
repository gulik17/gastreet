<?php
/**
 *
 */
class PaymentCard extends Entity {
	public $entityTable = 'paymentCard';
	public $primaryKey = 'id';
    public $userId = null;
    public $payId = null;
    public $monetaOperationId = null;
    public $paymenttoken = null;
    public $cardnumber = null;
    public $status = null;
    public $tsCreated = null;
    public $tsUpdated = null;

	function getFields() {
		return array(
			'id' => self::ENTITY_FIELD_INT,
            'userId' => self::ENTITY_FIELD_INT,
			'payId' => self::ENTITY_FIELD_INT,
			'monetaOperationId' => self::ENTITY_FIELD_STRING,
			'paymenttoken' => self::ENTITY_FIELD_STRING,
            'cardnumber' => self::ENTITY_FIELD_STRING,
			'status' => self::ENTITY_FIELD_STRING,
            'tsCreated' => self::ENTITY_FIELD_INT,
            'tsUpdated' => self::ENTITY_FIELD_INT,
		);
	}
}
