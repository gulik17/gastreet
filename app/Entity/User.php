<?php
/**
* Сущность пользователь
*
*/
class User extends Entity
{
    const STATUS_NEW = 'STATUS_NEW';
    const STATUS_REGISTERED = 'STATUS_REGISTERED';
    const TYPE_USER = 'TYPE_USER';
    const TYPE_STAFF = 'TYPE_STAFF';
    const SIZE_XS = 'SIZE_XS';
    const SIZE_S = 'SIZE_S';
    const SIZE_M = 'SIZE_M';
    const SIZE_L = 'SIZE_L';
    const SIZE_XL = 'SIZE_XL';
    const SIZE_XXL = 'SIZE_XXL';
    const SIZE_XXXL = 'SIZE_XXXL';
    const SIZE_XXXXL = 'SIZE_XXXXL';
    const SIZE_XXXXXL = 'SIZE_XXXXXL';

    public $entityTable = 'user';
    public $primaryKey = 'id';
    public $parentUserId = null;
    public $baseTicketId = null;
    public $tsTicketAdd = null;
    public $tsTicketPay = null;
    public $status = null;
    public $type = 'TYPE_USER';
    public $typeId = null;
    public $phone = null;
    public $email = null;
    public $disableBroadcast = null;
    public $disableBroadcastKey = null;
    public $confirmedEmail = null;
    public $lastname = null;
    public $name = null;
    public $tsBorn = null;
    public $code = null;
    public $cityName = null;
    public $countryName = null;
    public $company = null;
    public $position = null;
    public $userSize = null;
    public $isUl = null;
    public $hasEdit = null;
    // внутренний баланс, деньги - безнал, которые не удалось распределить
    public $ulBalance = null;
    // тайминги
    public $tsCreated = null;
    public $tsRegister = null;
    public $tsOnline = null;
    public $youAboutUs = null;
    public $wantRebro = null;
    public $userInfo = null;
    public $bitUpdate = null;
    public $utm = null;
    public $metro_card = null;
    public $lang = null;

    public static function getStatusDesc($stat = null)
    {
        $statList = [
            self::STATUS_NEW => "Новый",
            self::STATUS_REGISTERED => "Зарегистрирован",
        ];
        return $stat ? $statList[$stat] : $statList;
    }

    public static function getUserSize($size = null)
    {
        $sizeList = [
            self::SIZE_XS => 'XS',
            self::SIZE_S => 'S',
            self::SIZE_M => 'M',
            self::SIZE_L => 'L',
            self::SIZE_XL => 'XL',
            self::SIZE_XXL => 'XXL',
            self::SIZE_XXXL => 'XXXL',
            self::SIZE_XXXXL => 'XXXXL',
            self::SIZE_XXXXXL => 'XXXXXL',
        ];
        return $size ? $sizeList[$size] : $sizeList;
    }

    public static function getTypeDesc($type = null)
    {
        $typeList = [
            self::TYPE_USER => "Участник",
            self::TYPE_STAFF => "Команда",
        ];
        return $type ? $typeList[$type] : $typeList;
    }

    function getFields()
    {
        return [
            "id" => self::ENTITY_FIELD_INT,
            "parentUserId" => self::ENTITY_FIELD_INT,
            "baseTicketId" => self::ENTITY_FIELD_INT,
            "tsTicketAdd" => self::ENTITY_FIELD_INT,
            "tsTicketPay" => self::ENTITY_FIELD_INT,
            "status" => self::ENTITY_FIELD_STRING,
            "type" => self::ENTITY_FIELD_STRING,
            "typeId" => self::ENTITY_FIELD_INT,
            "phone" => self::ENTITY_FIELD_STRING,
            "email" => self::ENTITY_FIELD_STRING,
            "disableBroadcast" => self::ENTITY_FIELD_INT,
            "disableBroadcastKey" => self::ENTITY_FIELD_STRING,
            "confirmedEmail" => self::ENTITY_FIELD_STRING,
            "lastname" => self::ENTITY_FIELD_STRING,
            "name" => self::ENTITY_FIELD_STRING,
            "tsBorn" => self::ENTITY_FIELD_INT,
            "code" => self::ENTITY_FIELD_STRING,
            "cityName" => self::ENTITY_FIELD_STRING,
            "countryName" => self::ENTITY_FIELD_STRING,
            "company" => self::ENTITY_FIELD_STRING,
            "position" => self::ENTITY_FIELD_STRING,
            "userSize" => self::ENTITY_FIELD_STRING,
            "isUl" => self::ENTITY_FIELD_INT,
            "hasEdit" => self::ENTITY_FIELD_INT,
            "ulBalance" => self::ENTITY_FIELD_STRING,
            "tsCreated" => self::ENTITY_FIELD_INT,
            "tsRegister" => self::ENTITY_FIELD_INT,
            "tsOnline" => self::ENTITY_FIELD_INT,
            "wantRebro" => self::ENTITY_FIELD_STRING,
            "youAboutUs" => self::ENTITY_FIELD_STRING,
            "userInfo" => self::ENTITY_FIELD_STRING,
            "bitUpdate" => self::ENTITY_FIELD_INT,
            "utm" => self::ENTITY_FIELD_STRING,
            "metro_card" => self::ENTITY_FIELD_STRING,
            "lang" => self::ENTITY_FIELD_STRING,
        ];
    }
}
