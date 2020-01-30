<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 15.02.17
 * Time: 10:50
 */
class CustomBroadcast extends Entity
{
	public $entityTable = 'customBroadcast';
	public $primaryKey = 'id';
	public $type = null;
    public $userType = null;
	public $name = null;
	public $subject = null;
	public $message = null;
	public $sms = null;
	public $status = null; 		// 0-new, 1-running, 2-completed
    public $ticketId = null;
    public $productId = null;
	public $tsCreated = null;
	public $tsUpdated = null;

	const STATUS_NEW = 0;
	const STATUS_RUNNING = 1;
	const STATUS_COMPLETED = 2;

	const TYPE_EMAIL = 'EMAIL';
	const TYPE_SMS = 'SMS';

	function __construct() {}

	public static function getStatusDesc($stat = null) {
		$statList = array(
			self::STATUS_NEW 		=> 'Новая',
			self::STATUS_RUNNING 	=> 'В процессе',
			self::STATUS_COMPLETED 	=> 'Завершена'
		);
		return $stat ? $statList[$stat] : $statList;
	}

	public static function getTypeDesc($type = null) {
		$typeList = array(
			self::TYPE_EMAIL	=> 'E-Mail',
			self::TYPE_SMS	 	=> 'SMS',
		);
		return $type ? $typeList[$type] : $typeList;
	}

	function getFields() {
		return array(
			'id' 		=> self::ENTITY_FIELD_INT,
			'type' 		=> self::ENTITY_FIELD_STRING,
            'userType'  => self::ENTITY_FIELD_INT,
			'name' 		=> self::ENTITY_FIELD_STRING,
			'subject'	=> self::ENTITY_FIELD_STRING,
			'message' 	=> self::ENTITY_FIELD_STRING,
			'sms'		=> self::ENTITY_FIELD_STRING,
			'status' 	=> self::ENTITY_FIELD_INT,
            'ticketId' 	=> self::ENTITY_FIELD_INT,
            'productId' => self::ENTITY_FIELD_INT,
			'tsCreated' => self::ENTITY_FIELD_INT,
			'tsUpdated' => self::ENTITY_FIELD_INT
		);
	}
}