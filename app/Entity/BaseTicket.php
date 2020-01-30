<?php

/**
 * Сущность основной билет
 *
 */
class BaseTicket extends Entity {

    const STATUS_ENABLED = 'STATUS_ENABLED';
    const STATUS_DISABLED = 'STATUS_DISABLED';

    public $entityTable = 'baseTicket';
    public $primaryKey = 'id';
    public $status = null;
    public $name = null;
    public $name_en = null;
    public $annotation = null;
    public $description = null;
    public $price = null;
    public $oldPrice = null;
    public $plan = null;
    public $maxCount = null;
    public $leftCount = null;
    public $leftCountTs = null;
    public $eventTsStart = null;
    public $eventTsFinish = null;

    public static function getStatusDesc($stat = null, $lang = null) {
        if ($lang == 'en') {
            $statList = array(
                self::STATUS_ENABLED => "Active",
                self::STATUS_DISABLED => "Not active",
            );
        } else {
            $statList = array(
                self::STATUS_ENABLED => "Активен",
                self::STATUS_DISABLED => "Выключен",
            );
        }
        return $stat ? $statList[$stat] : $statList;
    }

    function getFields() {
        return array(
            "id" => self::ENTITY_FIELD_INT,
            "status" => self::ENTITY_FIELD_STRING,
            "name" => self::ENTITY_FIELD_STRING,
            "name_en" => self::ENTITY_FIELD_STRING,
            "annotation" => self::ENTITY_FIELD_STRING,
            "description" => self::ENTITY_FIELD_STRING,
            "price" => self::ENTITY_FIELD_STRING,
            "oldPrice" => self::ENTITY_FIELD_STRING,
            "plan" => self::ENTITY_FIELD_INT,
            "maxCount" => self::ENTITY_FIELD_INT,
            "leftCount" => self::ENTITY_FIELD_INT,
            "leftCountTs" => self::ENTITY_FIELD_INT,
            "eventTsStart" => self::ENTITY_FIELD_INT,
            "eventTsFinish" => self::ENTITY_FIELD_INT,
        );
    }
}