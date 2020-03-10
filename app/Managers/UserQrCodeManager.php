<?php

/**
 * Менеджер
 */
class UserQrCodeManager extends BaseEntityManager {
    protected $host = 'http://gastreet2019reg.1bit.ru/';         // api host
    protected $api_login = '7ego3_admin';    // api user login
    protected $api_password = 'MfcXaLdC'; // api user password
    protected $token = '';        // auth token (have expired time 15 min)
    protected $last_error = '';   // api last error

    /* SETTERS AND GETTERS */

    public function getLastError() {
        return $this->last_error;
    }

    public function setHost($host) {
        if ($this->host != $host) {
            $this->host = $this->fixHost($this->host);
            $this->token = '';
        }
    }

    public function getHost() {
        return $this->fixHost($this->host);
    }

    public function setApiLogin($api_login) {
        if ($this->api_login != $api_login) {
            $this->api_login = $api_login;
            $this->token = '';
        }
    }

    public function getApiLogin() {
        return $this->api_login;
    }

    public function setApiPassword($api_password) {
        if ($this->api_password != $api_password) {
            $this->api_password = $api_password;
            $this->token = '';
        }
    }

    public function getApiPassword() {
        return $this->api_password;
    }

    public function getToken() {
        return $this->token;
    }

    public function getByIds($inpIds) {
        if (!$inpIds) {
            return null;
        }
        if (count($inpIds) == 0) {
            return null;
        }
        $ids = implode(",", $inpIds);
        $res = $this->get(new SQLCondition("id IN ($ids)", null, "id"));
        return Utility::sort($inpIds, $res);
    }

    public function getByUserId($userId) {
        $condition = "userId = {$userId}";
        $sql = new SQLCondition($condition);
        $sql->orderBy = "tsCreated DESC";
        return $this->get($sql);
    }

    public function getAllRemoved() {
        $condition = "status = 'STATUS_REMOVED'";
        $sql = new SQLCondition($condition);
        $sql->orderBy = "tsCreated DESC";
        return $this->get($sql);
    }

    public function getByUserIds($inpIds) {
        if (!$inpIds) {
            return null;
        }
        if (count($inpIds) == 0) {
            return null;
        }
        $ids = implode(",", $inpIds);
        $res = $this->get(new SQLCondition("userId IN ($ids)", null, "userId"));
        return $res;
    }

    public function getByParentId($parenentId) {
        $condition = "parenentId = {$parenentId}";
        $sql = new SQLCondition($condition);
        $sql->orderBy = "tsCreated DESC";
        return $this->get($sql);
    }

    public function getOneActiveByUserId($userId) {
        $condition = "userId = {$userId} AND status = '" . UserQrCode::STATUS_ACTIVE . "'";
        $sql = new SQLCondition($condition);
        return $this->getOne($sql);
    }

    public function getOneActiveByCode($code) {
        $condition = "code = '{$code}' AND status = '" . UserQrCode::STATUS_ACTIVE . "'";
        $sql = new SQLCondition($condition);
        return $this->getOne($sql);
    }

    public function getOneByCode($code) {
        $condition = "code = '{$code}'";
        $sql = new SQLCondition($condition);
        return $this->getOne($sql);
    }

    // методы для работы с 1С-Бит (статические)
    /**
     * Удаление (POST запрос) [host]/ext/ticket/delete?login=[login]&password=[password]&ticket-signature=[signature]
     * Добавил проверку на повтор QR кода из вашей системы
     * Если не передаем QR, то проверка по ФИО
     */
    public function bitDeleteTicket($signature) {
        /*
         * поиск по signature
         */
        $ret_s = '';
        // reset error
        $this->last_error = '';

        do {
            $repeat = false;
            // check auth
            if (!$this->token) {
                if (!$this->Auth()) {
                    return false; // this is error on save
                }
            }
            $params = [
                'token' => $this->token,
                'signature' => $signature,
            ];
            $result = self::makeBitRequest("api/v1/tickets/", "delete", $params);
            // check result
            switch ($result['result_code']) {
                case 200:
                    // parse content
                    $content = json_decode($result['content']);
                    $ret_s = $content->signature;
                    break;
                case 401:
                    // token expired
                    $this->token = '';
                    $repeat = true;
                    break;
                case 406:
                    // parse content
                    $content = json_decode($result['content']);
                    $ret_s = $content->signature;
                    if ($content->error) {
                        $this->last_error = $content->description;
                    }
                    break;
            }
        } while ($repeat);
        return $ret_s;
    }

    // обновить билет
    public function bitSaveTicket($phone, $email, $confirmedEmail, $lastname, $name, $type, $catType, $organization, $position, $amount, $ticketType, $payed, $accessListArray, $signature) {
        /*(string) token // Токен авторизации, полученный методом http://metroconf.tmweb.ru/auth/jwt/token
          (string) signature // Сигнатура билета (если не указана или '' - будет создан новый билет)
          (string) first-name // Имя
          (string) middle-name // Отчество
          (string) last-name // Фамилия
          (string) email // Email
          (string) phone // Телефон
          (string) organization // Организация
          (string) rank // Должность
          (string) status // Статус билета
          (string) ticket-type // Тип билета
          (bool) printed // Признак печати бейджа
          (string) note // Заметки
          (int array) masterclass // Массив кодов доступных мастерклассов */

        $ret_s = '';
        // reset error
        $this->last_error = '';

        $email = ($confirmedEmail) ? $confirmedEmail : $email;

        $note  = "Статус билета: $payed\n";
        $note .= "Категория пользователя: $catType\n";
        $note .= "Общая сумма оплаты: $amount руб.\n";
        $note .= "Последнее обновление: " . date("Y-m-d H:i:s");

        // do while result
        do {
            $repeat = false;
            // check auth
            /*if (!$this->token) {
                if (!$this->Auth()) {
                    return false; // this is error on save
                }
            }*/
            // prepare data
            $params = [
                //'token' => $this->token,
                'signature' => $signature,
                'first-name' => $name, // Имя
                'middle-name' => '', // Отчество
                'last-name' => $lastname, // Фамилия
                'email' => $email, // Email
                'phone' => $phone, // Телефон
                'organization' => $organization, // Организация
                'rank' => $position, // Должность
                'status' => $type, // Тип пользователя
                'ticket-type' => $ticketType, // Тип билета (Название билета Gastreet)
                'note' => $note, // Заметки, можно передать все, что хотим и ни чего за это не будет xD
            ];
            foreach ($accessListArray as $masterclass_id) {
                $params['masterclass'][] = $masterclass_id;
            }
            // api call            
            $result = self::makeBitRequest("api/v1/tickets/", "save", $params);

            // check result
            switch ($result['result_code']) {
                case 200:
                    // parse content
                    $content = json_decode($result['content']);
                    $ret_s = $content->signature;
                    break;
                case 401:
                    // token expired
                    $this->token = '';
                    $repeat = true;
                    break;
                case 406:
                    // parse content
                    $content = json_decode($result['content']);
                    $ret_s = $content->signature;
                    if ($content->error) {
                        $this->last_error = $content->description;
                    }
                    break;
            }
        } while ($repeat);
        return $ret_s;
    }
    
    // Удалить МК
    
    /*
     *  method api/v1/masterclasses/delete
     *  delete masterclass
     *
     *  request params:
     *    (int) masterclass-id // Код мастеркласса
     *
     *  return masterclass id
     *  set $this->last_error on error
     */
    public function bitDeleteEvent($masterclass_id) {
        $id = 0;
        // reset error
        $this->last_error = '';
        // do while result
        do {
            $repeat = false;
            // check auth
            if (!$this->token) {
                if (!$this->Auth()) {
                    return false; // this is error on save
                }
            }
            // prepare data
            $params = [
                'token' => $this->token,
                'masterclass-id' => (int) $masterclass_id,
            ];
            // api call           
            $result = $this->makeBitRequest('api/v1/masterclasses/', 'delete', $params);
            // check result
            switch ($result['result_code']) {
                case 200:
                    // parse content
                    $content = json_decode($result['content']);
                    $id = $content->{"id"};
                    break;
                case 401:
                    // token expired
                    $this->token = '';
                    $repeat = true;
                    break;
                case 406:
                    // parse content
                    $content = json_decode($result['content']);
                    $id = $content->{"id"};
                    if ($content->error)  {
                        $this->last_error = $content->description;
                    }
                    break;
            }
        } while( $repeat );
        
        return (int) $masterclass_id;
    }

    // обновить событие
    public function bitUpdateEvent($masterclass_id, $name, $time_spending, $withcontrol) {
        $id = 0;
        // reset error
        $this->last_error = '';

        // do while result
        do {
            $repeat = false;
            // check auth
            if (!$this->token) {
                if (!$this->Auth()) {
                    return false; // this is error on save
                }
            }
            // prepare data
            $params = [
                'token' => $this->token,
                'masterclass-id' => (int) $masterclass_id,
                'name' => $name,
                'time-spending' => $time_spending,
                'withcontrol' => $withcontrol,
            ];
            // api call            
            $result = $this->makeBitRequest('api/v1/masterclasses/', 'save', $params);
            // check result
            switch ($result['result_code']) {
                case 200:
                    // parse content
                    $content = json_decode($result['content']);
                    $id = $content->{"masterclass-id"};
                    break;
                case 401:
                    // token expired
                    $this->token = '';
                    $repeat = true;
                    break;
                case 406:
                    // parse content
                    $content = json_decode($result['content']);
                    $id = $content->{"masterclass-id"};
                    if ($content->error) {
                        $this->last_error = $content->description;
                    }
                    break;
            }
        } while ($repeat);
        return $id;
    }

    private function extract_result_code($http_str) {
        // Must be "HTTP/1.1 401 Unauthorized" or similar
        if (strpos($http_str, 'HTTP/1.1') === 0) {
            return substr($http_str, 9, 3) + 0;
        } else {
            return 0;
        }
    }

    // отправить запрос
    private function makeBitRequest($methodLink, $command, $data, $referer = "") {
        $url = $this->host . $methodLink . $command;
        $url = parse_url($url);
        if ($url["scheme"] != "http") {
            return [
                "result_code" => 0,
                "error" => 'Not Http Request',
            ];
        }
        $data = http_build_query($data);

        // extract host and path from url
        $host = $url["host"];
        $path = $url["path"];

        $errno = null;
        $errstr = null;

        // open a socket connection with port 80, set timeout 40 sec.
        $fp = fsockopen($host, 80, $errno, $errstr, 40);
        $result = "";

        if ($fp) {
            // send a request headers
            fputs($fp, "POST $path HTTP/1.1\r\n");
            fputs($fp, "Host: $host\r\n");
            if ($referer != "") {
                fputs($fp, "Referer: $referer\r\n");
            }
            fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
            fputs($fp, "Content-length: " . strlen($data) . "\r\n");
            fputs($fp, "Connection: close\r\n\r\n");
            fputs($fp, $data);

            // receive result from request
            while (!feof($fp))
                $result .= fgets($fp, 128);
        } else {
            return [
                "result_code" => 0,
                "error" => "$errstr ($errno)",
            ];
        }

        // close socket connection
        fclose($fp);

        // split result header from the content
        $result = explode("\r\n\r\n", $result, 2);

        $header = isset($result[0]) ? $result[0] : "";
        $content = isset($result[1]) ? $result[1] : "";

        // return as structured array:
        return array(
            "result_code" => $this->extract_result_code($header),
            // "header" => $header,
            "content" => $content,
        );
    }

    /* PRIVATE METHODS */
    private function fixHost($host) {
        return rtrim($host, "/") . '/';
    }

    public function Auth() {
        $params = [
            'login' => $this->api_login,
            'password' => $this->api_password,
        ];

        $result = $this->makeBitRequest('auth/jwt/', 'token', $params);
        if (!$result) {
            $this->token = '';
            return false;
        }
        $answer = json_decode($result['content']);
        if ( is_object($answer) ) {
            if (!$answer->error && $answer->token) {
                $this->token = $answer->token;
                return true;
            } else {
                $this->token = '';
                $this->last_error = $answer->description;
                return false;
            }
        } else {
            $this->token = '';
            $this->last_error = "Неожиданный ответ от сервера";
            return false;
        }
    }
}