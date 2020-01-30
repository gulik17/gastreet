<?php

/**
 * Корзина
 *
 */
class ChefOlimpic extends Entity {
    const STATUS_ENABLED = 'STATUS_ENABLED';
    const STATUS_DISABLED = 'STATUS_DISABLED';
    const STATUS_QUEUE = 'STATUS_QUEUE';

    public $entityTable = 'chefOlimpic';
    public $primaryKey = 'id';
    public $user_id = null;
    public $tsCreated = null;
    public $status = null;
	
	function __construct() {}

    public static function getStatusDesc($stat = null, $lang = null) {
        if ($lang == 'en') {
            $statList = array(
                self::STATUS_ENABLED => "Enabled",
                self::STATUS_DISABLED => "Disabled",
                self::STATUS_QUEUE => "Queue",
            );
        } else {
            $statList = array(
                self::STATUS_ENABLED => "Сдал",
                self::STATUS_DISABLED => "Не сдал",
                self::STATUS_QUEUE => "В очереди",
            );
        }
        return $stat ? $statList[$stat] : $statList;
    }

    function getFields() {
        return array (
            "id" => self::ENTITY_FIELD_INT,
            "user_id" => self::ENTITY_FIELD_INT,
            "tsCreated" => self::ENTITY_FIELD_INT,
            "status" => self::ENTITY_FIELD_STRING,
        );
    }
}