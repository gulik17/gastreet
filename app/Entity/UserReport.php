<?php
/**
 */
class UserReport extends Entity {
    const STATUS_NEW = 'STATUS_NEW';
    const STATUS_GENERATED = 'STATUS_GENERATED';

    public $entityTable = 'userReport';
    public $primaryKey = 'id';
	public $tsStart = null;
    public $startInfo = null;
    public $tsFinish = null;
    public $finishInfo = null;
    public $tsGenerateStart = null;
    public $tsGenerateFinish = null;
    public $totalUsersCount = null;
    public $currentUsersProcessed = null;
    public $currentUserId = null;
    public $status = null;

	function __construct() {}
	
    function getFields() {
        return array (
            'id' => self::ENTITY_FIELD_INT,
            'tsStart' => self::ENTITY_FIELD_INT,
			'startInfo' => self::ENTITY_FIELD_STRING,
			'tsFinish' => self::ENTITY_FIELD_INT,
			'finishInfo' => self::ENTITY_FIELD_STRING,
			'tsGenerateStart' => self::ENTITY_FIELD_INT,
            'tsGenerateFinish' => self::ENTITY_FIELD_INT,
            'totalUsersCount' => self::ENTITY_FIELD_INT,
            'currentUsersProcessed' => self::ENTITY_FIELD_INT,
            'currentUserId' => self::ENTITY_FIELD_INT,
            'status' => self::ENTITY_FIELD_STRING,
        );
    }
}