<?php
/**
 *
 */
class UserDetails extends Entity {
    const STATUS_NEW = 'STATUS_NEW';

    public $entityTable = 'userDetails';
    public $primaryKey = 'id';
    public $userId = null;
    public $parenentId = null;
    public $company = null;
    public $cityName = null;
    public $countryName = null;
    public $inn = null;
    public $kpp = null;
    public $rs = null;
    public $bank = null;
    public $corr = null;
    public $bik = null;
    public $director = null;
    public $buh = null;
    public $status = null;
    public $tsCreated = null;
    public $tsUpdated = null;
    public $company_type = null;
    public $address = null;

    public static function getStatusDesc($stat = null) {
        $statList = array(
            self::STATUS_NEW => "Новый",
        );
        return $stat ? $statList[$stat] : $statList;
    }

    function getFields() {
        return array (
            'id'          => self::ENTITY_FIELD_INT,
            'userId'      => self::ENTITY_FIELD_INT,
            'parenentId'  => self::ENTITY_FIELD_INT,
            'company'     => self::ENTITY_FIELD_STRING,
            'cityName'    => self::ENTITY_FIELD_STRING,
            'countryName' => self::ENTITY_FIELD_STRING,
            'inn'         => self::ENTITY_FIELD_STRING,
            'kpp'         => self::ENTITY_FIELD_STRING,
            'rs'          => self::ENTITY_FIELD_STRING,
            'bank'        => self::ENTITY_FIELD_STRING,
            'corr'        => self::ENTITY_FIELD_STRING,
            'bik'         => self::ENTITY_FIELD_STRING,
            'director'    => self::ENTITY_FIELD_STRING,
            'buh'         => self::ENTITY_FIELD_STRING,
            'status'      => self::ENTITY_FIELD_STRING,
            'tsCreated'   => self::ENTITY_FIELD_INT,
            'tsUpdated'   => self::ENTITY_FIELD_INT,
            'address'     => self::ENTITY_FIELD_STRING,
            'company_type'=> self::ENTITY_FIELD_INT);
    }
}