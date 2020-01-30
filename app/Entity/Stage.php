<?php
/**
 * Этап
 */
class Stage extends Entity {
    public $entityTable = 'stage';
    public $primaryKey = 'id';
    public $compId = null;
	public $name = null;
	public $status = null;
	public $tsCreate = null;
    public $delim = 1;          // кол-во победителей этапа

    const STATUS_NEW = "STATUS_NEW";
    const STATUS_ACTIVE = "STATUS_ACTIVE";
    const STATUS_FINISHED = "STATUS_FINISHED";

	function __construct() {}

    function getFields() {
        return array(
            'id' => self::ENTITY_FIELD_INT,
            'compId' => self::ENTITY_FIELD_INT,
			'name' => self::ENTITY_FIELD_STRING,
			'status' => self::ENTITY_FIELD_STRING,
			'tsCreate' => self::ENTITY_FIELD_INT,
            'delim' => self::ENTITY_FIELD_INT,
        );
    }

    public static function getStatusDesc($stat = null) {
        $statList = array(
            self::STATUS_NEW => "Новый",
            self::STATUS_ACTIVE => "Активен",
            self::STATUS_FINISHED => "Завершен",
        );

        return $stat ? $statList[$stat] : $statList;
    }
}