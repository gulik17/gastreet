<?php

/**
 * Получение данных из HTTP запроса.
 * Их предварительная обработка.
 * Отправка HTTP заголовков
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
class Request {

    /**
     * Возвращает HTTP_REFERER
     *
     * @return string
     */
    public static function prevUri() {
        if (array_key_exists("HTTP_REFERER", $_SERVER)) {
            return $_SERVER["HTTP_REFERER"];
        } else {
            return "/";
        }
    }

    /**
     * Возвращает REQUEST_URI
     *
     * @return string
     */
    public static function requestUri() {
        return $_SERVER["REQUEST_URI"];
    }

    /**
     * Возвращает true, если HTTP запрос выполнен методом POST
     *
     * @return boolean
     */
    public static function isPost() {
        return "POST" == Request::getMethod();
    }

    /**
     * Возвращает true, если HTTP запрос выполнен методом GET
     *
     * @return boolean
     */
    public static function isGet() {
        return "GET" == Request::getMethod();
    }

    /**
     * Возвращает имя метода, которым был отправлен запрос
     *
     * @return string
     * */
    public static function getMethod() {
        return $_SERVER["REQUEST_METHOD"];
    }

    /**
     * Возвращает клиентский IP адрес
     *
     * @return string
     */
    public static function getIp() {
        return $_SERVER["REMOTE_ADDR"];
    }

    /**
     * Возвращает значение переменной HTTP из запроса
     *
     * @param string $name Имя переменной
     * @param mixed $default Значение переменной, которое будет возвращего по умолчанию
     * @param boolean $allowHTML Если true, то не преобразует
     *      специальные символы в HTML сущности и не экранирует кавычки
     *
     * @return mixed
     */
    public static function getVar($name, $default = null, $allowHTML = false) {
        $res = self::getRawData($name, $default);
        if (null === $res || "" === $res) {
            return $default;
        }
        // преобразование специальных символов в HTML сущности и экранирование кавычек
        if (!$allowHTML) {
            $res = self::clearInput(htmlspecialchars($res));
        }
        return $res;
    }

    /**
     * Возвращает нефильтрованный данные из запроса
     *
     * @param string $name Имя переменной
     * @param mixed $default Значение по умолчанию
     *
     * @return mixed
     */
    private static function getRawData($name, $default = null) {
        $res = null;
        switch (true) {
            case isset($_GET[$name]):
                $res = $_GET[$name];
                break;
            case isset($_POST[$name]):
                $res = $_POST[$name];
                break;
            default:
                return $default;
        }
        return $res;
    }

    /**
     * Экранирует спецсимволы.
     * Удаляет пробелы в начале и конце строки
     *
     * @param string $input Входящая строка
     *
     * @return string
     */
    public static function clearInput($input) {
        $input = trim($input);
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        return addslashes($input);
    }

    /**
     * Возвращает массив с данными о загруженном файле
     *
     * @param string $name Имя поля
     *
     * @return array
     */
    public function getFile($name) {
        return $_FILES[$name];
    }

    /**
     * Проверяет, был ли загружен файл
     *
     * @param string $name Имя поля
     *
     * @return boolean
     */
    public static function isFile($name) {
        if (isset($_FILES[$name]) && $_FILES[$name]["error"] != UPLOAD_ERR_NO_FILE) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Возвращает значение переменной, приведенное к целому числу
     *
     * @param string $name Имя переменной
     * @param int $default Значение по умолчанию
     *
     * @return integer
     */
    public static function getInt($name, $default = 0) {
        $res = self::getVar($name, $default, false);
        return intval($res);
    }

    /**
     * Возвращает массив из HTTP запроса
     *
     * @param string $name Имя переменной
     * @param mixed $default Значение по умолчанию
     * @param boolean $allowHTML Очищать данные в массиве или нет
     *
     * @return array
     */
    public static function getArray($name, $default = null, $allowHTML = false) {
        $res = self::getRawData($name, $default);
        if (is_array($res)) {
            Request::stripArray($res, $allowHTML);
            return $res;
        } else {
            return $default;
        }
    }

    /**
     * Экранирует спецсимволы. Рекурсивно обходит массив со значениями
     *
     * @param array &$array Массив с данными
     * @param boolean $allowHTML Очищать данные в массиве или нет
     *
     * @return array
     */
    public static function stripArray(&$array, $allowHTML) {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                self::stripArray($array[$key], $allowHTML);
            } else {
                if (!$allowHTML) {
                    $value = htmlspecialchars($value);
                    $value = self::clearInput($value);
                }
                $array[$key] = $value;
            }
        }
    }

    /**
     * Возвращает значение переменной, приведенное к float
     *
     * @param string $name Имя переменной
     * @param float $default Значение по умолчанию
     *
     * @return float
     */
    public static function getFloat($name, $default = 0.00) {
        $res = self::getVar($name, $default, false);
        return floatval($res);
    }

    /**
     * Отправляет заголовки, приводящие к редиректу на
     * указанный URL
     *
     * @param string $uri URL для редиректа
     *
     * @return void
     */
    public static function redirect($uri = null) {
        if ($uri == null) {
            $uri = "/";
        }
        header("Location: " . $uri);
        exit();
    }

    /**
     * Проверяет, был ли выполнен запрос с применением AJAX
     *
     * @return bool
     * */
    public static function isAJAXRequest() {
        if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Отправляет заголовки, запрещающие кеширование на клиенте
     *
     * @return void
     */
    public static function sendNoCacheHeaders() {
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    }

    /**
     * Отправляет HTTP заголовок Content-Type
     *
     * @param string $encoding Кодировка. Напр. windows-1251, utf-8 etc. By default: utf-8
     * @param string $type Значение Content-Type. По умолчанию: text/html
     *
     * @return void
     * */
    public static function sendHeaderContentType($encoding = "utf-8", $type = "text/html") {
        header("content-type: {$type};charset={$encoding} \r\n");
    }

    /**
     * Отправляет HTTP заголовок 404
     * и выводит содержимое страницы 404 в браузер
     *
     * @param string $info Дополнительная информация
     *
     * @return void
     */
    public static function send404($info = null) {
        if (!headers_sent()) {
            if ($info) {
                header("Location: /404.php#{$info}");
            } else {
                header("Location: /404.php");
            }
            exit();
        } else {
            if ($info) {
                echo "404 page not found#{$info}";
            } else {
                echo "404 page not found";
            }
            exit();
        }
    }

    // массив маппинга для коротких ссылок
    public static function getMappingArray() {
        return array("sovmestnie-pokupki-nachalo" => array("control" => "page", "param" => "name", "value" => "sovmestnie-pokupki-nachalo", "change" => false, "tail" => ""), "o-sisteme-sovmestnyh-pokupok" => array("control" => "page", "param" => "name", "value" => "o-sisteme-sovmestnyh-pokupok", "change" => false, "tail" => ""), "chto-dumajut-ljudi-o-sovmestnyh-pokupkah" => array("control" => "page", "param" => "name", "value" => "chto-dumajut-ljudi-o-sovmestnyh-pokupkah", "change" => false, "tail" => ""), "chto-dumajut-ljudi-o-sovmestnyh-pokupkah" => array("control" => "page", "param" => "name", "value" => "chto-dumajut-ljudi-o-sovmestnyh-pokupkah", "change" => false, "tail" => ""), "obratnaja-storona-sovmestnyh-pokupok" => array("control" => "page", "param" => "name", "value" => "obratnaja-storona-sovmestnyh-pokupok", "change" => false, "tail" => ""), "sovmestnye-pokupki-rukovodstvo-dlja-nachinajuwih" => array("control" => "page", "param" => "name", "value" => "sovmestnye-pokupki-rukovodstvo-dlja-nachinajuwih", "change" => false, "tail" => ""), "sovmestnaja-pokupka-odezhdy-v-internet-magazine" => array("control" => "page", "param" => "name", "value" => "sovmestnaja-pokupka-odezhdy-v-internet-magazine", "change" => false, "tail" => ""), "sovmestnye-pokupki-na-forumah" => array("control" => "page", "param" => "name", "value" => "sovmestnye-pokupki-na-forumah", "change" => false, "tail" => ""), "sovmestnye-pokupki-sekret-jekonomii" => array("control" => "page", "param" => "name", "value" => "sovmestnye-pokupki-sekret-jekonomii", "change" => false, "tail" => ""), "sovmestnyepokupki-otlichnyj-sposob-borby-s-krizisom" => array("control" => "page", "param" => "name", "value" => "sovmestnyepokupki-otlichnyj-sposob-borby-s-krizisom", "change" => false, "tail" => ""));
    }
}