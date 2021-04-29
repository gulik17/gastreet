<?php
/**
 */
class UserReportLine extends Entity
{
    public $entityTable = 'userReportLine';
    public $primaryKey = 'id';
	public $reportId = null;
    public $userId = null;
    public $userStatus = null;

    // данные пользователя
    public $phone = null;
    public $email = null;
    public $utm = null;
    public $typeUser = null;
    public $lastname = null;
    public $name = null;
    public $cityName = null;
    public $countryName = null;
    public $company = null;
    public $position = null;
    public $ulBalance = null;

    // реквизиты
    public $inn = null;
    public $details = null;

    public $parentUserId = null;
    public $parentUserInfo = null;
    public $userCreated = null;
    public $userRegister = null;
    public $userOnline = null;
    public $youAboutUs = null;
    public $metroCard = null;
    public $bookingSerialized = null;
    public $bookingSerializedData = null;
    public $bookingInfo = null;
    public $needAmount = null;
    public $basketSerialized = null;
    public $basketSerializedData = null;
    public $basketInfo = null;
    public $basketProductSerialized = null;
    public $basketProductSerializedData = null;
    public $basketProductInfo = null;
    public $paySerialized = null;
    public $paySerializedData = null;
    public $payInfo = null;

	function __construct() {}
	
    function getFields()
    {
        return array (
            'id' => self::ENTITY_FIELD_INT,
            'reportId' => self::ENTITY_FIELD_INT,
            'userId' => self::ENTITY_FIELD_INT,
            'userStatus' => self::ENTITY_FIELD_STRING,
            'phone' => self::ENTITY_FIELD_STRING,
            'email' => self::ENTITY_FIELD_STRING,
            'utm' => self::ENTITY_FIELD_STRING,
            'typeUser' => self::ENTITY_FIELD_STRING,
            'lastname' => self::ENTITY_FIELD_STRING,
            'name' => self::ENTITY_FIELD_STRING,
            'cityName' => self::ENTITY_FIELD_STRING,
            'countryName' => self::ENTITY_FIELD_STRING,
            'company' => self::ENTITY_FIELD_STRING,
            'position' => self::ENTITY_FIELD_STRING,
            'ulBalance' => self::ENTITY_FIELD_STRING,
            'inn' => self::ENTITY_FIELD_STRING,
            'details' => self::ENTITY_FIELD_STRING,
            'parentUserId' => self::ENTITY_FIELD_INT,
            'parentUserInfo' => self::ENTITY_FIELD_STRING,
            'userCreated' => self::ENTITY_FIELD_STRING,
            'userRegister' => self::ENTITY_FIELD_STRING,
            'userOnline' => self::ENTITY_FIELD_STRING,
            'youAboutUs' => self::ENTITY_FIELD_STRING,
            'metroCard' => self::ENTITY_FIELD_STRING,
            'bookingSerialized' => self::ENTITY_FIELD_STRING,
            'bookingSerializedData' => self::ENTITY_FIELD_STRING,
            'bookingInfo' => self::ENTITY_FIELD_STRING,
            'needAmount' => self::ENTITY_FIELD_STRING,
            'basketSerialized' => self::ENTITY_FIELD_STRING,
            'basketSerializedData' => self::ENTITY_FIELD_STRING,
            'basketInfo' => self::ENTITY_FIELD_STRING,
            'basketProductSerialized' => self::ENTITY_FIELD_STRING,
            'basketProductSerializedData' => self::ENTITY_FIELD_STRING,
            'basketProductInfo' => self::ENTITY_FIELD_STRING,
            'paySerialized' => self::ENTITY_FIELD_STRING,
            'paySerializedData' => self::ENTITY_FIELD_STRING,
            'payInfo' => self::ENTITY_FIELD_STRING,
        );
    }
}
