<?php
/**
 * Сущность дополнительные права пользователя
 */
class UserPermissions extends Entity {
	public $entityTable = 'userPermissions';
	public $primaryKey = 'id';
	public $userId = null;
	public $type = null;
	public $additionalData = null;

	const TYPE_MODERATOR = "TYPE_MODERATOR";

	function __construct() {}

    function getFields() {
        return array(
            'id' => self::ENTITY_FIELD_INT,
			'userId' => self::ENTITY_FIELD_INT,
			'type' => self::ENTITY_FIELD_STRING,
			'additionalData' => self::ENTITY_FIELD_STRING,
        );
    }

	public static function getTypeDesc($type = null) {
		$types = array(
			self::TYPE_MODERATOR => "Модератор",
		);
		if ($type && !isset($types[$type])) {
			return false;
		}
		return $type ? $types[$type] : $types;
	}
}