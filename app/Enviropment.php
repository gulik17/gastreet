<?php

/**
 * Слой бизнес-логики приложения
 * 
 */
class Enviropment extends BaseApplication {

    const ERROR_MSG = 'Не удалось сохранить данные, попробуйте позднее или сообщите администратору об ошибке ';
    const ERROR_MSG_EN = 'Failed to save data, try later or report an error to the administrator ';

    private static $instance = null;

    /**
     * Функция возвращает экземпляр класса
     * @return Shop object
     */
    public static function getInstance() {
        if (!isset(self::$instance)) {
            $class = __CLASS__;
            self::$instance = new $class;
            self::$instance->init();
        }
        return self::$instance;
    }

    /**
     * Нельзя создавать копии
     */
    public function __clone() {
        throw new Exception("Can't clone singleton object " . __CLASS__);
    }

    /**
     * Флаг того, что GUID корзины определён ...
     *
     * @var unknown_type
     */
    private static $isBasketCookieAlreadySet = false;

    /**
     * В этом методе инициализируются 
     * все необходимые объекты
     *
     * @return void
     */
    private function init() {
        // проверим есть ли текстовый файлик о том, что на сайте идёт обновление
        if (file_exists('mounting.txt')) {
            $URL = "mounting.html";
            header("Location: {$URL}");
        } else {
            // костыль для IE7,8
            // т.к. он некорректно определяет HTTP_REFERER
            self::setReferef();
            require_once 'app/Lib/IntrusionDetector/IntrusionDetector.php';
            $detector = new IntrusionDetector(Configurator::getSection("IntrusionDetector"));
            // выставляем куку для проверки, включены ли куки в браузере
            self::setCheckUpCookie();
            $user = Context::getActor();
            // всегда обновляем из базы текущего юзера
            if ($user != null) {
                $successLogin = false;
                $um = new UserManager();
                $newUser = $um->getById($user->id);
                if ($newUser != null) {
                    Context::setActor($newUser);
                    $successLogin = true;
                }
                if ($successLogin == false)
                    Context::logOff();
            }
            // если все же юзер есть в контексте, то обновим время его последней активности
            self::setLastActivity();
        }
    }

    /**
     * Метод для принудительной переинициализации приложения
     *
     * @return void
     */
    public function reInit() {
        $this->init();
    }

    /**
     * Функция упрощает редирект на страницы магазина
     * 
     * @param string $url Адрес, на который происходит редирект
     *               Если не задан - редирект на предыдущую страницу
     * @param mixed $message Сообщение
     * @param string $flag Флаг отображения уведомления (success, info, warning, danger)
     * @return void
     */
    public static function redirect($url = null, $message = null, $flag = null) {
        $arr['flag'] = $flag;
        $arr['message'] = $message;

        if ($message != null) {
            Context::setNotification($arr);
        }
        
        if ($url == "/") {
            Request::redirect();
        } elseif ($url != null) {
            $result = Configurator::get('application:protocol') . $_SERVER['HTTP_HOST'] . Utils::linkTarget($url);
            // КОП
            $result = str_replace('?show=index.php?', '?', $result);
            Request::redirect($result);
        } else {
            self::redirectBack($message);
        }
    }

    public static function isSecure() {
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
    }
    
    public static function loadScript($file, $type= null, $media = null) {
        $res = BaseApplication::loadScript($file, $type);
        if ($res === false) {
            return "";
        }
        $fileName = Application::normalizePath($file);
        $fullName = Application::fullPath($file);
        $media = $media ? "media=\"" . $media . "\" " : "";
        if (file_exists($fullName)) {
            $revision = filectime($fullName);
            if ($type == "js") {
                return "<script type=\"text/javascript\" src=\"{$fileName}?v={$revision}\"></script>";
            }
            if ($type == "css") {
                return "<link type=\"text/css\" href=\"{$fileName}?v={$revision}\" rel=\"stylesheet\" {$media}/>";
            }
            if ($type == "swf") {
                return "{$fileName}?v={$revision}";
            }
        }
    }

    /**
     * Функция делает редирект на предыдущую страницу
     *
     * @param string $message Сообщение
     */
    public static function redirectBack($message = null, $flag = null) {
        // отладка
        // echo "message: {$message}"; exit;
        $arr['flag'] = $flag;
        $arr['message'] = $message;
        if ($message != null) {
            Context::setNotification($arr);
        }
        $backURL = "";
        // костыль для IE7,8 , т.к. некорректно определяется HTTP_REFERER
        if (self::isMSIE()) {
            $backURL = self::getReferef();
        } else {
            $backURL = Request::prevUri();
        }
        Request::redirect($backURL);
    }

    /**
     * Функция проверяет, включены ли куки у клиента
     * 
     * Делается это так: при каждой инициализации приложения
     * выставляем куку с именем "checkup" = 1 на время сессии
     * 
     * в этом методе проверяется, если этой куки нет, то они выключены
     * 
     * @return bool
     */
    public static function isCookieEnabled() {
        $respond = self::getCookie('checkup');
        return $respond !== null;
    }

    /**
     * Функция устанавливает тестовую куку на год
     */
    public static function setCheckUpCookie() {
        if (!headers_sent()) {
            setcookie("checkup", 1, time() + 60 * 60 * 24 * 356, "/");
        }
    }

    /**
     * Функция устанавливает последнее время активности пользователя
     * для последующего котроля активности до таймаута
     */
    public static function setLastActivity() {
        Session::set("__time", time());
    }

    /**
     * Функция возвращает последнее время активности пользователя
     *
     * @return string
     */
    public static function getLastActivity() {
        return Session::get("__time");
    }

    /**
     * Функция отдает произвольную куку
     *  
     * @param string $coockieName название куки
     * @return занчение куки или null
     */
    public static function getCookie($cookieName) {
        return isset($_COOKIE[$cookieName]) ? $_COOKIE[$cookieName] : null;
    }

    /**
     * Функция установливает произвольную куку
     * 
     * @param string $cookieName название куки
     * @param string $cookieValue значение куки
     * 
     */
    public static function setCookie($cookieName, $cookieValue) {
        if (!headers_sent()) {
            if ($cookieName == "basketGUID") {
                setcookie($cookieName, $cookieValue, 0, "/");
            } else {
                setcookie($cookieName, $cookieValue, time() + 60 * 60 * 24 * 30, "/");
            }
        }
    }

    /**
     * Функция очищает куку
     * 
     * @param string $cookieName название куки
     */
    public static function unsetCookie($cookieName) {
        if (!headers_sent()) {
            setcookie($cookieName, null, time() - 3600, "/");
        }
    }

    public static function unsetAllCookies() {
        if (!headers_sent()) {
            foreach ($_COOKIE as $ind => $val) {
                self::unsetCookie($ind);
            }
        }
    }

    /**
     * Функция устанавливает\возвращает идентификатор корзины в куки
     *
     * @return string
     */
    public static function getBasketGUID() {
        $getBaskedGUID = self::getCookie("basketGUID");
        if ($getBaskedGUID == null) {
            $getBaskedGUID = Utils::getGUID();
            if (!self::$isBasketCookieAlreadySet) {
                if (!headers_sent()) {
                    self::setCookie("basketGUID", $getBaskedGUID);
                }
                self::$isBasketCookieAlreadySet = true;
            }
        }
        return $getBaskedGUID;
    }

    public static function prepareForMail($inputString) {
        if (!$inputString) {
            return null;
        }
        $outputString = str_replace("&quot;", '"', $inputString);
        $outputString = str_replace("&lt;", '<', $outputString);
        $outputString = str_replace("&gt;", '>', $outputString);
        //$outputString = str_replace("\r\n", "<br />", $outputString);
        //$outputString = str_replace("\n", "<br />", $outputString);
        return $outputString;
    }
    
    public static function translit($s) {
        $s = (string) $s; // преобразуем в строковое значение
        $s = strip_tags($s); // убираем HTML-теги
        $s = str_replace(array("\n", "\r"), " ", $s); // убираем перевод каретки
        $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
        $s = trim($s); // убираем пробелы в начале и конце строки
        $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
        $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
        $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s); // очищаем строку от недопустимых символов
        $s = str_replace(" ", "-", $s); // заменяем пробелы знаком минус
        return $s; // возвращаем результат
    }
    
    public static function getABC($from = 97, $to = 122) {
        $abc = '';
        $range = range($from, $to);
        foreach($range as $letter) {
            $abc[] = chr($letter);
        }
        return $abc;
    }

    // авторизация на форуме vbulleting
    public static function vBulletinLogin($host, $user, $pass) {
        $host = Configurator::get('application:protocol') . $host;

        $forumUrl = "{$host}/forum/login.php";

        $data = "req_username={$user}&req_password={$pass}&save_pass=1";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $forumUrl);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
        curl_setopt($ch, CURLOPT_TIMEOUT, '10');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($ch);
        // echo $content; exit;
        preg_match_all('|Set-Cookie: (.*);|U', $content, $results);
        if (isset($results[1]) && is_array($results[1]) && count($results[1])) {
            foreach ($results[1] AS $oneCookieKey => $oneCookieVal) {
                $pareArray = explode('=', $oneCookieVal);
                if (count($pareArray) == 2) {
                    $cookieKey = $pareArray[0];
                    $cookieVal = $pareArray[1];
                    Enviropment::setCookie($cookieKey, $cookieVal);
                }
            }
        }
        curl_close($ch);
    }
}