<?php

/**
 *
 */
class Faq extends Entity {
	public $entityTable = 'faq';
	public $primaryKey = 'id';

	public $ggroup = null;
	public $sortOrder = null;
	public $question = null;
	public $answer = null;
	public $question_en = null;
	public $answer_en = null;
	public $tsCreated = null;
	public $tsUpdated = null;

	function getFields() {
		return array(
			'id' => self::ENTITY_FIELD_INT,
			'ggroup' => self::ENTITY_FIELD_INT,
			'sortOrder' => self::ENTITY_FIELD_INT,
			'question' => self::ENTITY_FIELD_STRING,
			'answer' => self::ENTITY_FIELD_STRING,
			'question_en' => self::ENTITY_FIELD_STRING,
			'answer_en' => self::ENTITY_FIELD_STRING,
			'tsCreated' => self::ENTITY_FIELD_INT,
			'tsUpdated' => self::ENTITY_FIELD_INT
		);
	}
}