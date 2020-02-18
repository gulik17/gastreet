<?php
/**
* Утилиты для работы со строками, массивами и ссылками
*/
class Utility {
    /**
     * Функция урезает строку $text до $maxLen символов, с учетом апострофов
     *
     * @param string $text - строка
     * @param int $maxLen - максимальная длина строки
     * @param bool $allowHtml - разрешены ли теги html
     * @return string
     */
    public static function limitString($text, $maxLen, $allowHtml = false) {
        if(!$allowHtml) {
            $text = stripslashes($text);
            $text = htmlspecialchars_decode($text);
        }
        if(mb_strlen($text, "utf-8") > $maxLen)
            $text = mb_substr($text, 0, $maxLen, "utf-8");
        if(!$allowHtml) {
            $text = htmlspecialchars($text);
            $text = addslashes($text);
        }
        return $text;
    }

    /**
     * Функция возвращает число и слово в нужном падеже, в зависимости от числа
     *
     * @param int $count - количество
     * @param string $form1 - склонение 1
     * @param string $form2 - склонение 2
     * @param string $form5 - склонение 5
     * @param bool $merge - объединять или нет количество и склонение
     * @return string
     */
    public static function declension($count, $form1, $form2, $form5, $merge = true) {
        $count = $count ? $count : 0;
        $number = abs($count) % 100;
	if ($number > 10 && $number < 20) {
            return $merge ? "$count $form5" : $form5;
        }
        $number = $number % 10;
        if ($number > 1 && $number < 5) {
            return $merge ? "$count $form2" : $form2;
        }
        if ($number == 1) {
            return $merge ? "$count $form1" : $form1;
        }
        return $merge ? "$count $form5" : $form5;
    }

    /**
     * Функция возвращает первые $limit элементов массива
     *
     * @param array object $array - массив
     * @param int $limit - количество элементов которые должны вернуться
     * @return array object
     */
    public static function limit($array, $limit) {
        if(!$array) {
            return $array;
        }
        $chunk = array_chunk($array, $limit, true);
        return $chunk[0];
    }

    /**
     * Функция подготавливает строку для почты
     *
     * @param string $inputStr
     * @return string
     */
    public static function prepareStringForMail($inputStr) {
        $outputStr = str_replace("&quot;",'"',$inputStr);
        $outputStr = str_replace("&lt;",'<',$outputStr);
        $outputStr = str_replace("&gt;",'>',$outputStr);
        $outputStr = str_replace("\r\n","<br />",$outputStr);
        $outputStr = str_replace("\n","<br />",$outputStr);
        return $outputStr;
    }

    /**
     * Функция возвращает случайные $limit элементов из массива $array. если $limit не задан, то просто перемешивает
     *
     * @param array object $array - массив
     * @param int $limit - количество элементов которые должны вернуться
     * @return array object
     */
    public static function random($array, $limit = null) {
        if(!$array) {
            return $array;
        }
        shuffle($array);
        if($limit) {
            $array = Utility::limit($array, $limit);
        }
        return $array;
    }

    /**
     * Функция сортирует массив $array по ключам $key так, как они находятся в массиве $ids
     *
     * @param array int $array - массив ключей
     * @param array object/array $array - массив
     * @param string $key - по какому элементу объекта/массива сортировать
     * @return array object
     */
    public static function sort($ids, $array, $key = "id") {
        if(!$ids || !$array) {
            return [];
        }
        $unsorted = [];
        foreach($array as $item) {
            if ( (is_array($item)) && (array_key_exists($key, $item)) ) {
                $unsorted[$item[$key]] = $item;
            } else {
                $unsorted[$item->$key] = $item;
            }
        }
        $sorted = [];
        foreach($ids as $id) {
            if(array_key_exists($id, $unsorted)) {
                $sorted[$id] = $unsorted[$id];
            }
        }
        return $sorted;
    }

    /**
     * Функция конвертирует url в формат slash
     *
     * @param string $url - ссылка в формате "a?b=c"
     * @return string
     */
    public static function toSlashUrl($url) {
        $url = str_replace("index.php", "", $url);
        $url = str_replace("?show=", "", $url);
        $url = preg_replace("/[&=]/", "/", $url);
        if($url[0] != "/" && strpos($url, "http://") === false && strpos($url, "https://") === false) {
            $url = "/$url";
        }
        return $url;
    }

    /**
     * Функция конвертирует url в формат get
     *
     * @param string $url - ссылка в формате "a/b/c"
     * @return string
     */
    public static function toGetUrl($url) {
        $split = explode("/", $url);
        $url = "";
        foreach($split as $key => $value) {
            if($key == 0) {
                $url .= "/";
            } else if($key == 1) {
                $url .= $value;
            } else if($key == 2) {
                $url .= "?{$value}";
            } else if($key % 2) {
                $url .= "={$value}";
            } else {
                $url .= "&amp;{$value}";
            }
        }
        return $url;
    }

    /**
     * Функция рекурсивно удаляет каталог
     *
     * @param string $dir Каталог
     * @param boolean $deleteRootToo Удалить указанный каталог
     * @return boolean Результат выполнения
     */
    public static function unlinkRecursive($dir, $deleteRootToo) {
        foreach (glob($dir . '/*') as $one) {
            if (is_file($one)) {
                unlink($one);
            } else if (is_dir($one) && $one != '.' && $one != '..') {
                self::unlinkRecursive($one, true);
            }
        }
        return $deleteRootToo ? rmdir($dir) : true;
    }

    /**
     * преобразование даты от датапикера в unixtime
     * 
     * @param type $strData
     * @return type
     */
    public static function pickerDateToTime($strData) {
        $strData = trim($strData);
        $timeArr = [0, 0, 0];
        // 30.07.2010 12:30
        // проверим не было ли выбрано время
        $seArr = explode(" ", $strData);
        if (count($seArr) == 2) {
            $timeArr = explode(":", $seArr[1]);
            $timeArr[2] = 0;
            $deArr = explode(".", $seArr[0]);
        } else {
            $deArr = explode(".", $strData);
        }
        if (count($deArr) == 3) {
            return mktime($timeArr[0], $timeArr[1], $timeArr[2], $deArr[1], $deArr[0], $deArr[2]);
        } else {
            return null;
        }
    }

    /**
     * Преобразование unix time() в дату как у датапикера d.m.Y
     * http://www.php.net/manual/en/function.strftime.php
     * 
     * @param datetime $timestamp UnixTime
     * @return string
     */
    public static function pickerTimeToDate($timestamp) {
        return strftime('%d.%m.%Y', $timestamp);
    }

    /**
     * Функция ворачивает рандомное четырех значное число
     * 
     * @return integer
     */
    public static function getRnd4Diz() {
        return rand(1,4);
    }

    /**
     * Функция получает реферский URL
     * 
     * @return string
     */
    public static function getRefUrl() {
        if (isset($_SERVER['HTTP_REFERER'])) {
            $refURL = $_SERVER['HTTP_REFERER'];
            if (isset($_SERVER['HTTPS'])) {
                $cleanUrl = str_replace("https://www.".$_SERVER['HTTP_HOST']."/", "", $refURL);
                if (strstr($cleanUrl, "htt")) {
                    $cleanUrl = str_replace("https://".$_SERVER['HTTP_HOST']."/", "", $refURL);
                }
            } else {
                $cleanUrl = str_replace("http://www.".$_SERVER['HTTP_HOST']."/", "", $refURL);
                if (strstr($cleanUrl, "htt")) {
                    $cleanUrl = str_replace("http://".$_SERVER['HTTP_HOST']."/", "", $refURL);
                }
            }
            return $cleanUrl;
        }
    }

    /**
     * Функция транслитерации
     * 
     * @param string $str текст на кириллице
     * @return string текст на латинице
     */
    public static function rus2lat($str) {
        $ttable = [
            "й" => "y",
            "ц" => "ts",
            "у" => "u",
            "к" => "k",
            "е" => "e",
            "н" => "n",
            "г" => "g",
            "ш" => "sh",
            "щ" => "shh",
            "з" => "z",
            "х" => "h",
            "ъ" => "",
            "ф" => "f",
            "ы" => "y",
            "в" => "v",
            "а" => "a",
            "п" => "p",
            "р" => "r",
            "о" => "o",
            "л" => "l",
            "д" => "d",
            "ж" => "zh",
            "э" => "je",
            "я" => "ia",
            "ч" => "ch",
            "с" => "s",
            "м" => "m",
            "и" => "i",
            "т" => "t",
            "ь" => "",
            "б" => "b",
            "ю" => "ju",
            "ё" => "yo",
            " " => "",
            "-" => "",
            "Й" => "Y",
            "Ц" => "TS",
            "У" => "U",
            "К" => "K",
            "Е" => "E",
            "Н" => "N",
            "Г" => "G",
            "Ш" => "SH",
            "Щ" => "SHH",
            "З" => "Z",
            "Х" => "H",
            "Ъ" => "",
            "Ф" => "F",
            "Ы" => "Y",
            "В" => "V",
            "А" => "A",
            "П" => "P",
            "Р" => "R",
            "О" => "O",
            "Л" => "L",
            "Д" => "D",
            "Ж" => "ZH",
            "Э" => "JE",
            "Я" => "IA",
            "Ч" => "CH",
            "С" => "S",
            "М" => "M",
            "И" => "I",
            "Т" => "T",
            "Ь" => "",
            "Б" => "B",
            "Ю" => "JU",
            "Ё" => "Yo",
	];
        $result = strtr($str, $ttable);
        return $result;
    }

    /**
     * Выделяет имя хоста из ссылки
     * 
     * @param string $url ссылка
     * @return mixed возвращает или домен или false
     */
    public static function prepareHostName($url) {
        $url = mb_strtolower($url, 'utf8');
        if (strstr($url, 'http://') === false && strstr($url, 'https://') === false) {
            $url = parse_url('http://'.$url);
        } else {
            $url = parse_url($url);
        }
        if (($url['host'])) {
            return $url['host'];
        }
        return false;
    }

    /**
     * Выделяет центральную часть ссылки (домен без .ru)
     * 
     * @param type $url
     * @param type $isSearch
     * @return boolean
     */
    public static function prepareMainUrlPart($url, $isSearch = false) {
        $stopArray = ['www', 'ww', 'http', 'https'];
        $url = mb_strtolower($url,'utf8');
        $urlParts = explode('.', $url);
        if (!count($urlParts) && !$isSearch) {
            return false;
        }
        if (!count($urlParts) && $isSearch) {
            if (in_array($url, $stopArray)) {
                return false;
            }
            return $url;
        }
        $mainPart = $urlParts[0];
        if (in_array($mainPart, $stopArray)) {
            return false;
        }
        return $mainPart;
    }

    /**
     * Преобразование даты в d-m-Y
     * 
     * @param mixed $string Дата
     * @param string $format Шаблон даты
     * @return type
     */
    public static function dateFormat($string, $format = "d-m-Y") {
        $monthShortEn = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $monthLongEn = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $daysLongEn = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $daysShortEn = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $monthShortRu = ["янв", "фев", "мар", "апр", "мая", "июн", "июл", "авг", "сен", "окт", "ноя", "дек"];
        $monthLongRu = ["января", "февраля", "марта", "апреля", "мая", "июня", "июля", "августа", "сентября", "октября", "ноября", "декабря"];
        // $monthLongRu = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];
        $daysRu = ["понедельник", "вторник","среда","четверг","пятница","суббота","воскресенье"];
        // если это timestamp
        if (preg_match("/^[0-9]+$/", $string)) {
            $string = date("c", $string);
        }
        $date = new XDateTime($string);
        $txt = $date->format($format);
        $txt = str_replace($monthLongEn, $monthLongRu, $txt);
        $txt = str_replace($monthShortEn, $monthShortRu, $txt);
        $txt = str_replace($daysLongEn, $daysRu, $txt);
        $txt = str_replace($daysShortEn, $daysRu, $txt);
        return $txt;
    }

    /**
     * Получить содержимое страницы по ссылке
     * 
     * @param string $url ссылка на страницу от куда будет получать контент
     * @return string контент страницы
     */
    public static function getContent($url) {
        $ch = curl_init($url);
        // Параметры курла
        curl_setopt($ch, CURLOPT_USERAGENT, 'IE20');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, '1');
        // Получаем html
        $text = curl_exec($ch);
        curl_close($ch);
        return $text;
    }

    /**
     * Конвертирует html -> bbcode
     * 
     * @param string $text текст в HTML
     * @return string текст в формате BB
     */
    public static function html2bbcode($text) {
        if (!$text || $text == '') {
            return false;
        }
        $text = str_replace("</p>", "\r\n", $text);
        $text = str_replace("<br>", "\r\n", $text);
        $text = str_replace("<br/>", "\r\n", $text);
        $text = str_replace("<br />", "\r\n", $text);
        $text = str_replace("<p>", "", $text);
        $text = strip_tags($text);
        return $text;
    }

    /**
     * Конвертирует bbcode -> html
     * 
     * @param string $text текст BB код
     * @return string текст в HTML
     */
    public static function bbcode2html($text) {
        if (!$text || $text == '') {
            return false;
        }
        $str_search = [
            "#\\\n#is",
            "#\[table\](.+?)\[\/table\]#is",
            "#\[tr\](.+?)\[\/tr\]#is",
            "#\[td\](.+?)\[\/td\]#is",
            "#\[b\](.+?)\[\/b\]#is",
            "#\[i\](.+?)\[\/i\]#is",
            "#\[u\](.+?)\[\/u\]#is",
            "#\[code\](.+?)\[\/code\]#is",
            "#\[quote\](.+?)\[\/quote\]#is",
            "#\[url=(.+?)\](.+?)\[\/url\]#is",
            "#\[url\](.+?)\[\/url\]#is",
            "#\[img\](.+?)\[\/img\]#is",
            "#\[img width=(.+?),height=(.+?)\](.+?)\[\/img\]#is",
            "#\[video\](.+?)\[\/video\]#is",
            "#\[size=(.+?)\](.+?)\[\/size\]#is",
            "#\[color=(.+?)\](.+?)\[\/color\]#is",
            "#\[list\](.+?)\[\/list\]#is",
            "#\[list=(1|a|I)\](.+?)\[\/list\]#is",
            "#\[\*\](.+?)\[\/\*\]#"
        ];
        $str_replace = [
            "<br />",
            "<table>\\1</table>",
            "<tr>\\1</tr>",
            "<td>\\1</td>",
            "<b>\\1</b>",
            "<i>\\1</i>",
            "<span style='text-decoration:underline'>\\1</span>",
            "<code class='code'>\\1</code>",
            "<table width = '95%'><tr><td>Цитата</td></tr><tr><td class='quote'>\\1</td></tr></table>",
            "<a href='\\1' target='_blank'>\\2</a>",
            "<a href='\\1' target='_blank'>\\1</a>",
            "<img src='\\1' />",
            "<img width='\\1' height='\\2' src='\\3' />",
            "<iframe src='http://www.youtube.com/embed/\\1' width='400' height='300' frameborder='0'></iframe>",
            "<span style='font-size:\\1%'>\\2</span>",
            "<span style='color:\\1'>\\2</span>",
            "<ul>\\1</ul>",
            "<ol type='\\1'>\\2</ol>",
            "<li>\\1</li>"
        ];
        $text = preg_replace($str_search, $str_replace, $text);
        // смайлы
        $text = str_replace(':)', '<img src="/images/smiles/sm1.png" class="sm">', $text);
        $text = str_replace(':D', '<img src="/images/smiles/sm2.png" class="sm">', $text);
        $text = str_replace(';)', '<img src="/images/smiles/sm3.png" class="sm">', $text);
        $text = str_replace(':up:', '<img src="/images/smiles/sm4.png" class="sm">', $text);
        $text = str_replace(':down:', '<img src="/images/smiles/sm5.png" class="sm">', $text);
        $text = str_replace(':shock:', '<img src="/images/smiles/sm6.png" class="sm">', $text);
        $text = str_replace(':angry:', '<img src="/images/smiles/sm7.png" class="sm">', $text);
        $text = str_replace(':(', '<img src="/images/smiles/sm8.png" class="sm">', $text);
        $text = str_replace(':sick:', '<img src="/images/smiles/sm9.png" class="sm">', $text);
        return $text;
    }

    /**
     * Получает IP клиента
     * 
     * @return string IP адрес
     */
    public static function getClientIp() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } else if(getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } else if(getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } else if(getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } else if(getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } else if(getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            $ipaddress = 'UNKNOWN';
        }
        return $ipaddress;
    }

    public static function getSurrentHost() {
        if (isset($_SERVER['HTTP_HOST'])) {
            $host = str_replace('www.', '', strtolower($_SERVER['HTTP_HOST']));
        } else {
            $host = Configurator::get("application:url");
        }
        return $host;
    }

    /**
     * Отправка SMS через сервис sms.ru
     * 
     * @param string $to номер получателя sms. До 100 номеров за раз. Номера через запятую в формате 79880001122
     * @param string $message Отправляемое сообщение
     * @return boolean True если сообщение успешно ушло на сервер для отправки
     */
    public static function sendSms($to, $message) {
        $ch = curl_init("https://sms.ru/sms/send");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
            "api_id" => Configurator::get("sms:ApiKey"),
            "to" => $to, // До 100 штук до раз
            "msg" => $message, // Если приходят крякозябры, то уберите iconv и оставьте только "Привет!"
            "json" => 1 // Для получения более развернутого ответа от сервера
        )));
        $body = curl_exec($ch);
        curl_close($ch);

        $json = json_decode($body);
        if ($json) { // Получен ответ от сервера
            if ($json->status == "OK") { // Запрос выполнился
                return true;
            } else { // Запрос не выполнился (возможно ошибка авторизации, параметрах, итд...)
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 
     * @param type $path
     * @return type
     */
    public static function escape_win($path) {
        $path = strtoupper($path);
        return strtr($path, ["\\U0430"=>"а", "\\U0431"=>"б", "\\U0432"=>"в",
            "\\U0433"=>"г", "\\U0434"=>"д", "\\U0435"=>"е", "\\U0451"=>"ё", "\\U0436"=>"ж", "\\U0437"=>"з", "\\U0438"=>"и",
            "\\U0439"=>"й", "\\U043A"=>"к", "\\U043B"=>"л", "\\U043C"=>"м", "\\U043D"=>"н", "\\U043E"=>"о", "\\U043F"=>"п",
            "\\U0440"=>"р", "\\U0441"=>"с", "\\U0442"=>"т", "\\U0443"=>"у", "\\U0444"=>"ф", "\\U0445"=>"х", "\\U0446"=>"ц",
            "\\U0447"=>"ч", "\\U0448"=>"ш", "\\U0449"=>"щ", "\\U044A"=>"ъ", "\\U044B"=>"ы", "\\U044C"=>"ь", "\\U044D"=>"э",
            "\\U044E"=>"ю", "\\U044F"=>"я", "\\U0410"=>"А", "\\U0411"=>"Б", "\\U0412"=>"В", "\\U0413"=>"Г", "\\U0414"=>"Д",
            "\\U0415"=>"Е", "\\U0401"=>"Ё", "\\U0416"=>"Ж", "\\U0417"=>"З", "\\U0418"=>"И", "\\U0419"=>"Й", "\\U041A"=>"К",
            "\\U041B"=>"Л", "\\U041C"=>"М", "\\U041D"=>"Н", "\\U041E"=>"О", "\\U041F"=>"П", "\\U0420"=>"Р", "\\U0421"=>"С",
            "\\U0422"=>"Т", "\\U0423"=>"У", "\\U0424"=>"Ф", "\\U0425"=>"Х", "\\U0426"=>"Ц", "\\U0427"=>"Ч", "\\U0428"=>"Ш",
            "\\U0429"=>"Щ", "\\U042A"=>"Ъ", "\\U042B"=>"Ы", "\\U042C"=>"Ь", "\\U042D"=>"Э", "\\U042E"=>"Ю", "\\U042F"=>"Я"
        ]);
    }

    /**
     * Число прописью
     * 
     * @param int $num число
     * @return string
     */
    public static function num2str($num) {
        $nul = 'ноль';
        $ten = [
            ['','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'],
            ['','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'],
        ];
        $a20 = ['десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать'];
        $tens = [2 => 'двадцать', 'тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто'];
        $hundred = ['', 'сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот'];
        $unit = [ // Units
            ['копейка' ,'копейки' ,'копеек'    ,1],
            ['рубль'   ,'рубля'   ,'рублей'    ,0],
            ['тысяча'  ,'тысячи'  ,'тысяч'     ,1],
            ['миллион' ,'миллиона','миллионов' ,0],
            ['миллиард','милиарда','миллиардов',0],
        ];
        list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
        $out = [];
        if (intval($rub)>0) {
            foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
                if (!intval($v)) continue;
                $uk = sizeof($unit)-$uk-1; // unit key
                $gender = $unit[$uk][3];
                list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
                // mega-logic
                $out[] = $hundred[$i1]; # 1xx-9xx
                if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
                else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
                // units without rub & kop
                if ($uk>1) $out[]= self::morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
            } //foreach
        } else {
            $out[] = $nul;
        }
        $out[] = self::morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
        $out[] = $kop.' '.self::morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
        return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
    }

    /**
     * Склоняем словоформу
     * 
     * @param type $n
     * @param type $f1
     * @param type $f2
     * @param type $f5
     * @return type
     */
    public static function morph($n, $f1, $f2, $f5) {
        $n = abs(intval($n)) % 100;
        if ($n>10 && $n<20) return $f5;
        $n = $n % 10;
        if ($n>1 && $n<5) return $f2;
        if ($n==1) return $f1;
        return $f5;
    }

    /**
     * 
     * @param type $value
     * @return type
     */
    public static function mobilephone($value) {
        $strPhone  = ( ($value[0] != "8") && ($value[0] != "+") ) ? "+" : "";
        $strPhone .= substr($value, 0, 1);
        $strPhone .= " (";
        $strPhone .= substr($value, 1, 3);
        $strPhone .= ") ";
        $strPhone .= substr($value, 4, 3);
        $strPhone .= "-";
        $strPhone .= substr($value, 7, 2);
        $strPhone .= "-";
        $strPhone .= substr($value, 9, strlen($value) - 9);
        return $strPhone;
    }

    /**
     * Обработка номера телефона ( +8(988) 500-11-22 => 79885001122 )
     * 
     * @param type $phone
     * @return type
     */
    public static function preparePhone($phone) {
        $phone = str_replace([' ','+','-','(',')'], '', $phone);
        if (substr($phone, 0, 1) == '8' || substr($phone, 0, 1) == '7') {
            $phone = '7' . substr($phone, 1, strlen($phone) - 1);
        } else if (strlen($phone) == 10) {
            $phone = '7' . $phone;
        }
        $phone = (float)$phone;
        $phone = strval($phone);
        return $phone;
    }
    
    /**
     * Функция переводит первую букву в слове в верхний регистр (иванов иван => Иванов Иван)
     * 
     * @param string $str входной параметр
     * @return string преобразованное предложение
     */
    public static function mb_ucwords($str) { 
        return mb_convert_case($str, MB_CASE_TITLE, "UTF-8"); 
    }
    
    /**
     * Функция преобразует Имя или Фамилию в корректно написанный вид иВа+нов/Иванов
     * 
     * Логика:
     * - Переводим в нижний регистр
     * - Заменяем все ненужные символы на пробел
     * - Обрезаем пробелы по бокам
     * - Переводим в верхний регистр Первую букву в слове
     * - заменяем пробелы на дефис, это может быть в случае если фамилия или имя или отчество двойное. (новиКов-пРибой => Новиков-Прибой)
     *
     * @param string $name Имя или Фамилия или Отчество
     * @return mixed Результат выполнения/ Возвращает либо корректное имя/фамилию либо false если переменная содержит менее 3-х символов
     */
    public static function getCorrectName($name) {
        if (strlen(trim($name)) < 3) {
            return false;
        }
        $var_array = ['.',',',';','+','(',')','-'];
        return str_replace(' ', '-', mb_ucwords(trim(str_replace($var_array, ' ', strtolower($name)))));
    }

    /**
     * Вырезает все кроме букв
     * 
     * @param string $value текст который будем обрабатывать
     * @return string обработаный текст
     */
    public static function leaveOnlySymbols($value) {
        return preg_replace('/[^a-zA-Zа-яА-Я ёЁ]/ui', '', htmlspecialchars_decode($value));
    }
}

