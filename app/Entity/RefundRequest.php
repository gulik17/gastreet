<?php
/**
 *
 */
class RefundRequest extends Entity {
    const STATUS_NEW = 'STATUS_NEW';
    const STATUS_PAID = 'STATUS_PAID';

    const TYPE_CARD = 'TYPE_CARD';
    const TYPE_INVOICE = 'TYPE_INVOICE';

	public $entityTable = 'refundRequest';
	public $primaryKey = 'id';
    public $userId = null;
    public $parenentId = null;
    public $payId = null;
    public $basketId = null;
    public $basketProductId = null;
    public $needAmount = null;
    public $requestAmount = null;
    public $returnedAmount = null;
    public $status = null;
    public $type = null;
    public $tsCreated = null;
    public $tsUpdated = null;

	function __construct() {}

    public static function getStatusDesc($stat = null) {
        $statList = array(
            self::STATUS_NEW => "Новый",
            self::STATUS_PAID => "Выплачено",
        );
        return $stat ? $statList[$stat] : $statList;
    }

    public static function getTypeDesc($type = null) {
        $typeList = array(
            self::TYPE_CARD => "Возврат на карту",
            self::TYPE_INVOICE => "Возврат безналом",
        );
        return $type ? $typeList[$type] : $typeList;
    }

	function getFields() {
		return array(
			'id' => self::ENTITY_FIELD_INT,
            'userId' => self::ENTITY_FIELD_INT,
            'parenentId' => self::ENTITY_FIELD_INT,
            'payId' => self::ENTITY_FIELD_INT,
            'basketId' => self::ENTITY_FIELD_INT,
            'basketProductId' => self::ENTITY_FIELD_INT,
            'needAmount' => self::ENTITY_FIELD_STRING,
            'requestAmount' => self::ENTITY_FIELD_STRING,
			'returnedAmount' => self::ENTITY_FIELD_STRING,
			'status' => self::ENTITY_FIELD_STRING,
            'type' => self::ENTITY_FIELD_STRING,
            'tsCreated' => self::ENTITY_FIELD_INT,
            'tsUpdated' => self::ENTITY_FIELD_INT,
		);
	}
}
