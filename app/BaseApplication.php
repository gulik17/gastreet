<?php
/**
 * Базовый класс для приложений
 */
class BaseApplication extends Application {
    private static $scripts = [];
    private static $files_js = [];
    private static $files_css = [];
    private static $rev = null;

    /**
     * Функция осуществляет контроль загрузки JS и CSS на страницу
     *
     * @param $fileName путь к файлу
     * @param $type тип файла, м.б. js, css
     */
    public static function loadScript($fileName, $type = null) {
        $hash = md5($fileName);
        if ( !in_array($hash, self::$scripts) ) {
            self::$scripts[] = $hash;
            if ($type == 'js') {
                self::$files_js[] = $fileName;
            } else if ($type == 'css') {
                self::$files_css[] = $fileName;
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Функция возвращает скрипты которые были добавлены функцией loadScript
     */
    public static function loadJS() {
        if (count(self::$files_js) > 0) {
            $result = null;
            foreach (self::$files_js as $item) {
                $normalPath = Application::normalizePath($item);
                $item = Application::fullPath($item);
                if (file_exists($item)) {
                    $revision = filectime($item);
                    $result .= "<script type=\"text/javascript\" src=\"{$normalPath}?v={$revision}\"></script>"."\r";
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    /**
     * Функция возвращает css которые были добавлены функцией loadScript
     */
    public static function loadCSS() {
        if (count(self::$files_css) > 0) {
            $result = null;
            foreach (self::$files_css as $item) {
                $normalPath = Application::normalizePath($item);
                $item = Application::fullPath($item);
                if (file_exists($item)) {
                    $revision = filectime($item);
                    $result .= "<link type=\"text/css\" href=\"{$normalPath}?v={$revision}\" rel=\"stylesheet\" {$media}/>"."\r";
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    /**
     * Функция устанавливает номер ревизии
     */
    public static function setRevision() {
        $revFile = Configurator::get("application:revisionFile");
        if(self::$rev === null) {
            $revisionXml = simplexml_load_file($revFile);
            self::$rev = $revisionXml->entry["revision"];
        }
        return self::$rev;
    }

    /**
     * Функция возвращает номер ревизии
     *
     * @return int
     */
    public static function getRevision() {
        if(self::$rev === null) {
            self::setRevision();
        }
        return self::$rev;
    }

    /**
     * Функция пишет в лог все SQL запросы, произошедшие до вызова этого метода
     *
     */
    public static function writeSqlLog() {
        $debug = Configurator::get("application:debug");
        if($debug) {
            $log = Application::getConnection("master")->getQueryHistory();
            $res = "Request URI : " . $_SERVER['REQUEST_URI'] . "\n";
            if (count($log) > 0) {
                foreach ($log as $item) {
                    $res .= "{$item}\n";
                }
                Logger::debug($res);
            }
        }
    }

    /**
     * Определим, является ли браузер MSIE7,8
     *
     * @return bool
     */
    public static function isMSIE() {
        $ua = @$_SERVER['HTTP_USER_AGENT'];
        if(preg_match("/MSIE [7|8].0/", $ua)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Принудительная установка HTTP_REFERER в сессию
     * в случае использования MSIE7
     *
     * @return void
     */
    public static function setReferef() {
        $uri = @$_SERVER["REQUEST_URI"];
        if ($uri == null) {
            $uri = "/";
        }
        // если мы запрашивали Action, то не будем 
        // сохранять этот URL как referer
        // чтобы не возвращаться на него
        if (preg_match("/php\?do/", $uri)) {
            return false;
        } else {
            Session::set("__http_referer", $uri);
        }
    }

    /**
     * Возвращает принудительно установленный HTTP_REFERER
     * в случае использования MSIE7
     *
     * @return string
     */
    public static function getReferef() {
        return Session::get("__http_referer");
    }
}