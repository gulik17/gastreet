<?php
/**
 * Диалог от текущего userId кому-то
 */
class MessageTo extends Entity
{
	public $entityTable = 'messageTo';
	public $primaryKey = 'id';
	public $userId = null;
	public $userToId = null;
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
			'userToId' => self::ENTITY_FIELD_INT,
			'message' => self::ENTITY_FIELD_STRING,
			'dateCreate' => self::ENTITY_FIELD_INT,
			'dateUpdate' => self::ENTITY_FIELD_INT,
			'isDeleteReceiver' => self::ENTITY_FIELD_INT,
			'isDeleteSender' => self::ENTITY_FIELD_INT,
        );
	}
}