<?php
/**
* Сущность лог отправленных сообщений
*
*/
class MessageLog extends Entity {
    const STATUS_NEW = 'STATUS_NEW';
    const STATUS_SENT = 'STATUS_SENT';
    const STATUS_SENDED = 'STATUS_SENDED';

    public $entityTable = 'messageLog';
    public $primaryKey = 'id';
    public $broadcastTemplateId = null;
    public $userId = null;
    public $operatorId = null;
    public $phone = null;
    public $email = null;
    public $message = null;
    public $status = null;
    public $jobId = null;
    public $tsCreate = null;
    public $tsSent = null;

    public static function getStatusDesc($name = null) {
        $list = [
            self::STATUS_NEW => "Новое",
            self::STATUS_SENT => "Отправлено",
            self::STATUS_SENDED => "Отправлено Uni",
        ];
        return $name ? $list[$name] : $list;
    }

	function getFields() {
       return [
            "id" => self::ENTITY_FIELD_INT,
            "broadcastTemplateId" => self::ENTITY_FIELD_INT,
            "userId" => self::ENTITY_FIELD_INT,
            "operatorId" => self::ENTITY_FIELD_INT,
            "phone" => self::ENTITY_FIELD_STRING,
            "email" => self::ENTITY_FIELD_STRING,
            "message" => self::ENTITY_FIELD_STRING,
            "status" => self::ENTITY_FIELD_STRING,
            "jobId" => self::ENTITY_FIELD_STRING,
            "tsCreate" => self::ENTITY_FIELD_INT,
            "tsSent" => self::ENTITY_FIELD_INT,
       ];
    }
}
