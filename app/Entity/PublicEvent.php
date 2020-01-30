<?php
/**
 * Сущность уведомление (публичное)
 *
 */
class PublicEvent extends Entity {
    public $entityTable = 'publicEvent';
    public $primaryKey = 'id';
	public $fromUserId = null;
	public $fromNickName = null;
	public $toUserId = null;
	public $message = null;
	public $dateCreate = null;
	public $dateRead = null;

	function __construct() {}

	function getFields() {
		return array(
			'id' => self::ENTITY_FIELD_INT,
			'fromUserId' => self::ENTITY_FIELD_INT,
			'fromNickName' => self::ENTITY_FIELD_STRING,
			'toUserId' => self::ENTITY_FIELD_INT,
			'message' => self::ENTITY_FIELD_STRING,
			'dateCreate' => self::ENTITY_FIELD_INT,
			'dateRead' => self::ENTITY_FIELD_INT,
		);
	}
}
