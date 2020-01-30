<?php
/**
 * cp project
 * Сущность подсказка
 */
class Hint extends Entity {
    public $entityTable = 'hint';
    public $primaryKey = 'id';
	public $alias = null;
	public $title = null;
	public $hint = null;
	public $contAlias = null;

	function __construct() {}

    function getFields() {
        return array(
            'id' => self::ENTITY_FIELD_INT,
			'alias' => self::ENTITY_FIELD_STRING,
			'title' => self::ENTITY_FIELD_STRING,
			'hint' => self::ENTITY_FIELD_STRING,
			'contAlias' => self::ENTITY_FIELD_STRING,
        );
    }
}