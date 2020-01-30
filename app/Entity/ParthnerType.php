<?php

/**
  */
class ParthnerType extends Entity {
	public $entityTable = 'parthnerType';
	public $primaryKey = 'id';
	public $name = null;
	public $tsCreated = null;
	public $tsUpdated = null;

	function __construct() {}

	function getFields() {
		return array(
			'id' => self::ENTITY_FIELD_INT,
			'name' => self::ENTITY_FIELD_STRING,
			'tsCreated' => self::ENTITY_FIELD_INT,
			'tsUpdated' => self::ENTITY_FIELD_INT,
		);
	}
}