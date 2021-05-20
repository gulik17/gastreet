<?php

/**
 * Сущность мастер-класс, ужин
 *
 */
class Product extends Entity {
    const STATUS_ENABLED = 'STATUS_ENABLED';
    const STATUS_DISABLED = 'STATUS_DISABLED';
    const STATUS_CANCELED = 'STATUS_CANCELED';

    public $entityTable = 'product';
    public $primaryKey = 'id';
    public $ext_id = null;
    public $placeId = null;
    public $areaId = null;
    public $speakerId = null;
    public $speaker2Id = null;
    public $speaker3Id = null;
    public $speaker4Id = null;
    public $speaker5Id = null;
    public $speaker6Id = null;
    public $speaker7Id = null;
    public $speaker8Id = null;
    public $speaker9Id = null;
    public $speaker10Id = null;
    public $speaker11Id = null;
    public $speaker12Id = null;
    public $partner_id = null;
    public $status = null;
    public $showInSchedule = null;
    public $name = null;
    public $description = null;
    public $firstName = null;
    public $secondName = null;
    public $cityName = null;
    public $company = null;
    public $position = null;
    public $youtube = null;
    public $tags = null;
    public $tag_desc = null;
    public $plan = null;
    public $price = null;
    public $pic1 = null;
    public $pic2 = null;
    public $oldPrice = null;
    public $maxCount = null;
    public $leftCount = null;
    public $leftCountTs = null;
    public $eventTsStart = null;
    public $eventTsFinish = null;
    public $tsUpdate = null;

    public static function getStatusDesc($stat = null, $lang = null) {
        if ($lang == 'en') {
            $statList = array(
                self::STATUS_ENABLED => "Active",
                self::STATUS_DISABLED => "Not active",
                self::STATUS_CANCELED => "Canceled",
            );
        } else {
            $statList = array(
                self::STATUS_ENABLED => "Активен",
                self::STATUS_DISABLED => "Выключен",
                self::STATUS_CANCELED => "Отменен",
            );
        }
        return $stat ? $statList[$stat] : $statList;
    }

    function getFields() {
        return array(
            "id" => self::ENTITY_FIELD_INT,
            "ext_id" => self::ENTITY_FIELD_INT,
            "placeId" => self::ENTITY_FIELD_INT,
            "areaId" => self::ENTITY_FIELD_INT,
            "speakerId" => self::ENTITY_FIELD_INT,
            "speaker2Id" => self::ENTITY_FIELD_INT,
            "speaker3Id" => self::ENTITY_FIELD_INT,
            "speaker4Id" => self::ENTITY_FIELD_INT,
            "speaker5Id" => self::ENTITY_FIELD_INT,
            "speaker6Id" => self::ENTITY_FIELD_INT,
            "speaker7Id" => self::ENTITY_FIELD_INT,
            "speaker8Id" => self::ENTITY_FIELD_INT,
            "speaker9Id" => self::ENTITY_FIELD_INT,
            "speaker10Id" => self::ENTITY_FIELD_INT,
            "speaker11Id" => self::ENTITY_FIELD_INT,
            "speaker12Id" => self::ENTITY_FIELD_INT,
            "partner_id" => self::ENTITY_FIELD_INT,
            "status" => self::ENTITY_FIELD_STRING,
            "showInSchedule" => self::ENTITY_FIELD_INT,
            "name" => self::ENTITY_FIELD_STRING,
            "description" => self::ENTITY_FIELD_STRING,
            'firstName' => self::ENTITY_FIELD_STRING,
            'secondName' => self::ENTITY_FIELD_STRING,
            'cityName' => self::ENTITY_FIELD_STRING,
            'company' => self::ENTITY_FIELD_STRING,
            'position' => self::ENTITY_FIELD_STRING,
            "youtube" => self::ENTITY_FIELD_STRING,
            "tags" => self::ENTITY_FIELD_STRING,
            "tag_desc" => self::ENTITY_FIELD_STRING,
            "plan" => self::ENTITY_FIELD_STRING,
            "price" => self::ENTITY_FIELD_STRING,
            "pic1" => self::ENTITY_FIELD_STRING,
            "pic2" => self::ENTITY_FIELD_STRING,
            "oldPrice" => self::ENTITY_FIELD_STRING,
            "maxCount" => self::ENTITY_FIELD_STRING,
            "leftCount" => self::ENTITY_FIELD_INT,
            "leftCountTs" => self::ENTITY_FIELD_INT,
            "eventTsStart" => self::ENTITY_FIELD_INT,
            "eventTsFinish" => self::ENTITY_FIELD_INT,
            "tsUpdate" => self::ENTITY_FIELD_INT,
        );
    }
}