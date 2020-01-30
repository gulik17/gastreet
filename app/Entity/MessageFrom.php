<?php
/**
 * Диалог от кого-то текущему userId
 */
class MessageFrom extends Entity
{
	public $entityTable = 'messageFrom';
	public $primaryKey = 'id';
	public $userId = null;
	public $userFromId = null;
	public $message = null;
	public $dateCreate = null;
	public $dateUpdate = null;
	public $isDeleteReceiver = 0;
	public $isDeleteSender = 0;

	function __construct() {}

	function getFields() {
        return array(
			'id' => self::ENTITY_FIELD_INT,
			'userId' => self::ENTITY_FIELD_INT,
			'userFromId' => self::ENTITY_FIELD_INT,
			'message' => self::ENTITY_FIELD_STRING,
			'dateCreate' => self::ENTITY_FIELD_INT,
			'dateUpdate' => self::ENTITY_FIELD_INT,
			'isDeleteReceiver' => self::ENTITY_FIELD_INT,
			'isDeleteSender' => self::ENTITY_FIELD_INT,
        );
	}
}
