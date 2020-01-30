<?php
/**
 * Очередь заданий для асинхронного выполнения сложных задач
 *
 */
class QueueMysql extends Entity {
    public $entityTable = 'queueMysql';
    public $primaryKey = 'id';
	public $taskName = null;
	public $fromUserId = null;
	public $otherData = null;
	public $dateCreate = null;
	public $dateStart = null;
	public $dateFinish = null;
	public $isFinish = 0;
	public $isError = 0;

	function __construct() {}

	function getFields() {
		return array(
			'id' => self::ENTITY_FIELD_INT,
			'taskName' => self::ENTITY_FIELD_STRING,
			'fromUserId' => self::ENTITY_FIELD_INT,
			'otherData' => self::ENTITY_FIELD_STRING,
			'dateCreate' => self::ENTITY_FIELD_INT,
			'dateStart' => self::ENTITY_FIELD_INT,
			'dateFinish' => self::ENTITY_FIELD_INT,
			'isFinish' => self::ENTITY_FIELD_INT,
			'isError' => self::ENTITY_FIELD_INT,
		);
	}
}
