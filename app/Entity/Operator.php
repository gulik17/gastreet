<?php

/**
 * cp project
 * Сущность оператор
 */
class Operator extends Entity {
    const ENTITY_STATUS_NOTACTIVE = 0;
    const ENTITY_STATUS_ACTIVE    = 1;
    const ENTITY_STATUS_DELETED   = 2;
    const ENTITY_STATUS_BLOCKED   = 3;
    const ENTITY_STATUS_PENDING   = 4; // на модерации
    
    const STATUS_NOTACTIVE = 'STATUS_NOTACTIVE';
    const STATUS_ACTIVE    = 'STATUS_ACTIVE';
    const STATUS_DELETED   = 'STATUS_DELETED';
    const STATUS_BLOCKED   = 'STATUS_BLOCKED';
    const STATUS_PENDING   = 'STATUS_PENDING'; // на модерации

    public $entityTable = 'operator';
    public $primaryKey = 'id';
    public $login = null;
    public $password = null;
    public $name = null;
    public $phone = null;
    public $role = null;
    public $dateCreate = null;
    public $dateLastVisit = null;
    public $entityStatus = null;
    public $status = null;

    public static function getStatusDesc($stat = null) {
        $statList = array (
            self::STATUS_NOTACTIVE => "Неактивный",
            self::STATUS_ACTIVE => "Активный",
            self::STATUS_DELETED => "Удален",
            self::STATUS_BLOCKED => "Заблокирован",
            self::STATUS_PENDING => "На модерации",
        );
        return $stat ? $statList[$stat] : $statList;
    }

    function isNotActive() {
        return $this->entityStatus == self::ENTITY_STATUS_NOTACTIVE;
    }

    function isActive() {
        return $this->entityStatus == self::ENTITY_STATUS_ACTIVE;
    }

    function isDeleted() {
        return $this->entityStatus == self::ENTITY_STATUS_DELETED;
    }

    function isBlocked() {
        return $this->entityStatus == self::ENTITY_STATUS_BLOCKED;
    }

    function isPending() {
        return $this->entityStatus == self::ENTITY_STATUS_PENDING;
    }

    function getFields() {
        return array(
            'id'            => self::ENTITY_FIELD_INT,
            'login'         => self::ENTITY_FIELD_STRING,
            'password'      => self::ENTITY_FIELD_STRING,
            'name'          => self::ENTITY_FIELD_STRING,
            'phone'         => self::ENTITY_FIELD_STRING,
            'role'          => self::ENTITY_FIELD_STRING,
            'dateCreate'    => self::ENTITY_FIELD_INT,
            'dateLastVisit' => self::ENTITY_FIELD_INT,
            'entityStatus'  => self::ENTITY_FIELD_INT,
            'status'        => self::ENTITY_FIELD_STRING,
        );
    }
}