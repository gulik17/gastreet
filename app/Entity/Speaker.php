<?php

/**
 *
 */
class Speaker extends Entity
{
    const STATUS_ENABLED = 'STATUS_ENABLED';
    const STATUS_DISABLED = 'STATUS_DISABLED';

    const COUNTRY_AMB = 'amb';
    const COUNTRY_RU = 'ru';
    const COUNTRY_GB = 'gb';
    const COUNTRY_ES = 'es';
    const COUNTRY_IT = 'it';
    const COUNTRY_KZ = 'kz';
    const COUNTRY_UZ = 'uz';
    const COUNTRY_US = 'us';
    const COUNTRY_DE = 'de';
    const COUNTRY_PL = 'pl';
    const COUNTRY_UA = 'ua';
    const COUNTRY_FR = 'fr';
    const COUNTRY_EE = 'ee';
    const COUNTRY_LV = 'lv';
    const COUNTRY_SI = 'si';
    const COUNTRY_TR = 'tr';

    public $entityTable = 'speaker';
    public $primaryKey = 'id';
    public $country = null;
    public $name = null;
    public $secondName = null;
    public $name_en = null;
    public $secondName_en = null;
    public $cityName = null;
    public $cityName_en = null;
    public $company = null;
    public $company_en = null;
    public $position = null;
    public $position_en = null;
    public $description = null;
    public $description_en = null;
    public $tags = null;
    public $years = null;
    public $pic1 = null;
    public $pic_app = null;
    public $partner_id = null;
    public $michelin = null;
    public $facebook = null;
    public $vk = null;
    public $instagram = null;
    public $twitter = null;
    public $site = null;
    public $presentation = null;
    public $status = null;
    public $sortOrder = null;
    public $tsCreated = null;
    public $tsUpdated = null;

    public static function getStatusDesc($s = false)
    {
        $list = [
            self::STATUS_ENABLED => "Включено",
            self::STATUS_DISABLED => "Выключено",
        ];
        return $s ? $list[$s] : $list;
    }

    public static function getCountry($s = false)
    {
        $list = [
            self::COUNTRY_AMB =>"Амбасадор",
            self::COUNTRY_RU => "Россия",
            self::COUNTRY_GB => "Великобритания",
            self::COUNTRY_DE => "Германия",
            self::COUNTRY_ES => "Испания",
            self::COUNTRY_IT => "Италия",
            self::COUNTRY_KZ => "Казахстан",
            self::COUNTRY_PL => "Польша",
            self::COUNTRY_LV => "Латвия",
            self::COUNTRY_SI => "Словения",
            self::COUNTRY_US => "США",
            self::COUNTRY_TR => "Турция",
            self::COUNTRY_UZ => "Узбекистан",
            self::COUNTRY_UA => "Украина",
            self::COUNTRY_FR => "Франция",
            self::COUNTRY_EE => "Эстония",
        ];
        return $s ? $list[$s] : $list;
    }

    function getFields()
    {
        return [
            'id' => self::ENTITY_FIELD_INT,
            'country' => self::ENTITY_FIELD_STRING,
            'name' => self::ENTITY_FIELD_STRING,
            'secondName' => self::ENTITY_FIELD_STRING,
            'name_en' => self::ENTITY_FIELD_STRING,
            'secondName_en' => self::ENTITY_FIELD_STRING,
            'cityName' => self::ENTITY_FIELD_STRING,
            'cityName_en' => self::ENTITY_FIELD_STRING,
            'company' => self::ENTITY_FIELD_STRING,
            'company_en' => self::ENTITY_FIELD_STRING,
            'position' => self::ENTITY_FIELD_STRING,
            'position_en' => self::ENTITY_FIELD_STRING,
            'description' => self::ENTITY_FIELD_STRING,
            'description_en' => self::ENTITY_FIELD_STRING,
            'tags' => self::ENTITY_FIELD_STRING,
            'years' => self::ENTITY_FIELD_STRING,
            'pic1' => self::ENTITY_FIELD_STRING,
            'pic_app' => self::ENTITY_FIELD_STRING,
            'partner_id' => self::ENTITY_FIELD_INT,
            'michelin' => self::ENTITY_FIELD_INT,
            'facebook' => self::ENTITY_FIELD_STRING,
            'vk' => self::ENTITY_FIELD_STRING,
            'instagram' => self::ENTITY_FIELD_STRING,
            'twitter' => self::ENTITY_FIELD_STRING,
            'site' => self::ENTITY_FIELD_STRING,
            'presentation' => self::ENTITY_FIELD_STRING,
            'status' => self::ENTITY_FIELD_STRING,
            'sortOrder' => self::ENTITY_FIELD_INT,
            'tsCreated' => self::ENTITY_FIELD_INT,
            'tsUpdated' => self::ENTITY_FIELD_INT,
        ];
    }
}
