<?php
/**
*/
class Prize extends Entity
{
    const STATUS_ENABLED = 'STATUS_ENABLED';
    const STATUS_DISABLED = 'STATUS_DISABLED';

    const TYPE_NEWS = 'TYPE_NEWS';
    const TYPE_READ = 'TYPE_READ';

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

    public static function getStatusDesc($s = false)
    {
        $list = [
            self::STATUS_ENABLED => "Включено",
            self::STATUS_DISABLED => "Отключено",
        ];
        return $s ? $list[$s] : $list;
    }

    public static function getType($s = false)
    {
        $list = [
            self::TYPE_NEWS => "Новости",
            self::TYPE_READ => "Почитать",
        ];
        return $s ? $list[$s] : $list;
    }

	function getFields()
    {
		return [
			"id"          	=> self::ENTITY_FIELD_INT,
			"name"        	=> self::ENTITY_FIELD_STRING,
			"annotation"	=> self::ENTITY_FIELD_STRING,
			"description"	=> self::ENTITY_FIELD_STRING,
			"name_en"       => self::ENTITY_FIELD_STRING,
			"annotation_en" => self::ENTITY_FIELD_STRING,
			"description_en"=> self::ENTITY_FIELD_STRING,
			"status"      	=> self::ENTITY_FIELD_STRING,
			"type"      	=> self::ENTITY_FIELD_STRING,
			"youtube"     	=> self::ENTITY_FIELD_STRING,
            "tsUpdate"    	=> self::ENTITY_FIELD_INT,
		];
	}
}
