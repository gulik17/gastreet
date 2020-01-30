<?php

/**
 * Сущность шаблон рассылки
 *
 */
class BroadcastTemplate extends Entity {

    const STATUS_ACTIVE = 'STATUS_ACTIVE';
    const STATUS_DISABLED = 'STATUS_DISABLED';
    const EDIT_TYPE_AVAILABLE = 'EDIT_TYPE_AVAILABLE';
    const EDIT_TYPE_NOT_AVAILABLE = 'EDIT_TYPE_NOT_AVAILABLE';
    const SEND_TYPE_SMS = 'SEND_TYPE_SMS';
    const SEND_TYPE_EMAIL = 'SEND_TYPE_EMAIL';
    const TRIGGER_TYPE_REGISTER_PHONE = 'TRIGGER_TYPE_REGISTER_PHONE';
    const TRIGGER_TYPE_REGISTER_PARTICIPANT = 'TRIGGER_TYPE_REGISTER_PARTICIPANT';
    const TRIGGER_TYPE_EMAIL_CONFIRM_REQUEST = 'TRIGGER_TYPE_EMAIL_CONFIRM_REQUEST';
    const TRIGGER_TYPE_EMAIL_CONFIRM_SUCCESS = 'TRIGGER_TYPE_EMAIL_CONFIRM_SUCCESS';
    const TRIGGER_TYPE_NOTIFY_PRODUCT_CANCEL = 'TRIGGER_TYPE_NOTIFY_PRODUCT_CANCEL';
    const TRIGGER_TYPE_NOTIFY_OLD_BASKET = 'TRIGGER_TYPE_NOTIFY_OLD_BASKET';
    const TRIGGER_TYPE_NOTIFY_OLD_BOOKING = 'TRIGGER_TYPE_NOTIFY_OLD_BOOKING';
    const TRIGGER_TYPE_REMOVE_OLD_BASKET = 'TRIGGER_TYPE_REMOVE_OLD_BASKET';
    const TRIGGER_TYPE_WITHOUT_TICKET_USER = 'TRIGGER_TYPE_WITHOUT_TICKET_USER';

    public $entityTable = 'broadcastTemplate';
    public $primaryKey = 'id';
    public $status = null;
    public $editType = null;
    public $sendType = null;
    public $triggerType = null;
    public $triggerMin = null;
    public $triggerMax = null;
    public $triggerValue = null;
    public $message = null;
    public $tsUpdate = null;

    public static function getStatusDesc($name = null) {
        $list = array(
            self::STATUS_ACTIVE => "Активна",
            self::STATUS_DISABLED => "Выключена",
        );
        return $name ? $list[$name] : $list;
    }

    public static function getEditTypeDesc($name = null) {
        $list = array(
            self::EDIT_TYPE_AVAILABLE => "Можно редактировать",
            self::EDIT_TYPE_NOT_AVAILABLE => "Нельзя редактировать",
        );
        return $name ? $list[$name] : $list;
    }

    public static function getSendTypeDesc($name = null) {
        $list = array(
            self::SEND_TYPE_SMS => "Отправка SMS",
            self::SEND_TYPE_EMAIL => "Отправка email",
        );
        return $name ? $list[$name] : $list;
    }

    public static function getTriggerTypeDesc($name = null) {
        $list = array(
            self::TRIGGER_TYPE_REGISTER_PHONE => "На телефон отправлен код регистрации",
            self::TRIGGER_TYPE_REGISTER_PARTICIPANT => "Вас зарегистрировали на Gastreet",
            self::TRIGGER_TYPE_EMAIL_CONFIRM_REQUEST => "Отправлен код подтверждения e-mail",
            self::TRIGGER_TYPE_EMAIL_CONFIRM_SUCCESS => "E-mail подтвержден",
            self::TRIGGER_TYPE_NOTIFY_PRODUCT_CANCEL => "Уведомление об отмене события",
            self::TRIGGER_TYPE_NOTIFY_OLD_BASKET => "Приближается снятие резерва",
            self::TRIGGER_TYPE_NOTIFY_OLD_BOOKING => "Приближается снятие бронирования",
            self::TRIGGER_TYPE_REMOVE_OLD_BASKET => "Резерв снят",
            self::TRIGGER_TYPE_WITHOUT_TICKET_USER => "Скорее забирай свой билет на GASTREET",
        );
        return $name ? $list[$name] : $list;
    }

    function getFields() {
        return array(
            "id" => self::ENTITY_FIELD_INT,
            "status" => self::ENTITY_FIELD_STRING,
            "editType" => self::ENTITY_FIELD_STRING,
            "sendType" => self::ENTITY_FIELD_STRING,
            "triggerType" => self::ENTITY_FIELD_STRING,
            "triggerMin" => self::ENTITY_FIELD_STRING,
            "triggerMax" => self::ENTITY_FIELD_STRING,
            "triggerValue" => self::ENTITY_FIELD_STRING,
            "message" => self::ENTITY_FIELD_STRING,
            "tsUpdate" => self::ENTITY_FIELD_INT,
        );
    }

}
