<?php

/**
 * Контекст приложения
 * 
 * Представляет собой репозиторий основных объектов приложения. 
 * Стартует сессию.
 * Управление и контроль за данными сессии.
 * 
 * PHP version 5
 * 
 * @category Framework
 * @package  Core
 * @author   Andrey Filippov <afi@i-loto.ru>
 * @license  %license% name
 * @version  SVN: $Id: Entity.php 9 2007-12-25 11:26:03Z afi $
 * @link     nolink
 */
final class Context {
    /**
     * Экземпляр класса Context
     * 
     * @var Context
     */
    private static $instance = null;

    /**
     * Приватный конструктор
     * 
     * @param string $name Имя контекста (сессии)
     * 
     * @return void
     */
	 
	function __construct($name) {
		Session::start($name);
	}

    /**
     * Стартует контекст
     * 
     * @param string $name Имя контекста (сессии)
     * 
     * @return Context
     * */
    public static function start($name) {
        if (!isset(self::$instance)) {
            self::$instance = new Context($name);
        }
        return self::$instance;
    }

    /**
     * Установка пользователя в контекст
     * 
     * @param mixed $user Данные пользователя
     * 
     * @return void
     */
    public static function setActor($user) {
        Session::set("__user", $user);
    }

    /**
     * Возвращает текущего пользователя
     * 
     * @return mixed
     */
    public static function getActor() {
        $user = Session::get("__user");
        if (is_array($user)) {
            $user = (object) $user;
        }
        return $user;
    }

    public static function setArray($arrayValue) {
        if (is_array($arrayValue)) {
            Session::set("__arrval", @serialize($arrayValue));
        } else {
            Session::set("__arrval", null);
        }
    }

    public static function getArray() {
        return @unserialize(Session::get("__arrval"));
    }

    /**
     * Установка объекта в сессию
     * 
     * @param string $objName Имя объекта
     * @param mixed $objValue Данные
     * 
     * @return void
     */
    public static function setObject($objName, $objValue) {
        Session::set($objName, $objValue);
    }

    /**
     * Возвращает объект из сессии
     * 
     * @param string $objName Имя объекта
     * 
     * @return mixed
     */
    public static function getObject($objName) {
        return Session::get($objName);
    }

    /**
     * Удаление объекта из сессии
     * 
     * @param string $objName Имя объекта
     * 
     * @return void
     */
    public static function clearObject($objName) {
        Session::clear($objName);
    }

    /**
     * Установка в сессию объекта, описывающего флаг уведомления
     * 
     * @param mixed $errors объект, описывающий ошибку
     * 
     * @deprecated Обдумать удаление этотго метода
     * @return void
     */
    public static function setNotification($notification) {
        Session::set("__notification", $notification);
    }

    /**
     * возвращает из сессии объект, описывающий уведомление
     * и удаляет его из сессии
     * 
     * @return mixed	
     */
    public static function getNotification() {
        return Session::push("__notification");
    }

    /**
     * Установка в сессию объекта, описывающего ошибку
     * 
     * @param mixed $errors объект, описывающий ошибку
     * 
     * @deprecated Обдумать удаление этотго метода
     * @return void
     */
    public static function setError($errors) {
        Session::set("__error", $errors);
    }
    
    /**
     * возвращает из сессии объект, описывающий ошибку
     * и удаляет его из сессии
     * 
     * @return mixed	
     */
    public static function getError() {
        return Session::push("__error");
    }

    /**
     * Реализует механизм выхода пользователя из системы.
     * Удаляет из контекста данные пользователя
     * 
     * @deprecated
     * 
     * @return void
     */
    public static function logOff() {
        Context::setActor(false);
    }

    /**
     * Нельзя клонировать 
     * 
     * @return void
     */
    public function __clone() {
        throw new Exception("Can't clone singleton object " . __CLASS__);
    }
}