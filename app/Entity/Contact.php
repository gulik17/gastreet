<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 12.02.17
 * Time: 9:34
 */
class Contact extends Entity {
    const TYPE_PARTICIPANTS = 'TYPE_PARTICIPANTS';
    const TYPE_PARTNERS = 'TYPE_PARTNERS';
    const TYPE_MEDIA = 'TYPE_MEDIA';
    const TYPE_SPEAKERS = 'TYPE_SPEAKERS';
    const TYPE_VOLUNTEERS = 'TYPE_VOLUNTEERS';
    public $entityTable = 'contacts';
    public $primaryKey = 'id';
    public $sortOrder = null;
    public $title = null;
    public $title_en = null;
    public $name = null;
    public $name_en = null;
    public $type = null;
    public $email = null;
    public $phone = null;
    public $whatsapp = null;
    public $viber = null;
    public $telegram = null;
    public $phone2 = null;
    public $facebookurl = null;
    public $tsCreated = null;
    public $tsUpdated = null;

    public static function getTypeDesc($type = null, $lang = null) {
        $typeList = array(
            self::TYPE_PARTICIPANTS => "Участникам",
            self::TYPE_PARTNERS => "Партнерам",
            self::TYPE_MEDIA => "СМИ",
            self::TYPE_SPEAKERS => "Спикерам",
            self::TYPE_VOLUNTEERS => "Волонтерам",
        );
        if ($lang == 'en') {
            $typeList = array(
                self::TYPE_PARTICIPANTS => "For participants",
                self::TYPE_PARTNERS => "For partners",
                self::TYPE_MEDIA => "For media",
                self::TYPE_SPEAKERS => "For speakers",
                self::TYPE_VOLUNTEERS => "For volunteers",
            );
        }
        return $type ? $typeList[$type] : $typeList;
    }
    
    function getFields() {
        return array(
            'id' => self::ENTITY_FIELD_INT,
            'sortOrder' => self::ENTITY_FIELD_INT,
            'title' => self::ENTITY_FIELD_STRING,
            'title_en' => self::ENTITY_FIELD_STRING,
            'name' => self::ENTITY_FIELD_STRING,
            'name_en' => self::ENTITY_FIELD_STRING,
            'type' => self::ENTITY_FIELD_STRING,
            'email' => self::ENTITY_FIELD_STRING,
            'phone' => self::ENTITY_FIELD_STRING,
            'whatsapp' => self::ENTITY_FIELD_STRING,
            'viber' => self::ENTITY_FIELD_STRING,
            'telegram' => self::ENTITY_FIELD_STRING,
            'phone2' => self::ENTITY_FIELD_STRING,
            'facebookurl' => self::ENTITY_FIELD_STRING,
            'tsCreated' => self::ENTITY_FIELD_INT,
            'tsUpdated' => self::ENTITY_FIELD_INT
        );
    }
}