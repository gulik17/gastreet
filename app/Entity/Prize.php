<?php
/**
*/
class Prize extends Entity {
    const STATUS_ENABLED = 'STATUS_ENABLED';
    const STATUS_DISABLED = 'STATUS_DISABLED';

    public $entityTable = 'prize';
    public $primaryKey = 'id';
	public $name = null;
	public $annotation = null;
	public $description = null;
	public $name_en = null;
	public $annotation_en = null;
	public $description_en = null;
	public $status = null;
	public $youtube = null;
    public $tsUpdate = null;

	function __construct() {}

    public static function getStatusDesc($stat = null) {
        $statList = array(
            self::STATUS_ENABLED => "Включено",
            self::STATUS_DISABLED => "Отключено",
        );
        return $stat ? $statList[$stat] : $statList;
    }

	function getFields() {
		return array(
			"id"          	=> self::ENTITY_FIELD_INT,
			"name"        	=> self::ENTITY_FIELD_STRING,
			"annotation"	=> self::ENTITY_FIELD_STRING,
			"description"	=> self::ENTITY_FIELD_STRING,
			"name_en"       => self::ENTITY_FIELD_STRING,
			"annotation_en" => self::ENTITY_FIELD_STRING,
			"description_en"=> self::ENTITY_FIELD_STRING,
			"status"      	=> self::ENTITY_FIELD_STRING,
			"youtube"     	=> self::ENTITY_FIELD_STRING,
            "tsUpdate"    	=> self::ENTITY_FIELD_INT,
		);
	}
}