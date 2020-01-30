<?php

/*
  EventOnline api helper class

  Use getLastError() after api call error to get error description.

  See the function description next to the implementation.

  public function __construct($host, $api_login, $api_password)

  // last api error
  public function getLastError()

  // api host
  public function setHost($host)
  public function getHost()

  // api login
  public function setApiLogin($api_login)
  public function getApiLogin()

  // api password
  public function setApiPassword($api_password)
  public function getApiPassword()

  // current jwt auth token
  public function getToken()

  // masterclasses list
  public function getMasterclasses()
  // save masterclass
  public function saveMasterclass($masterclass_id, $name, $time_spending, $withcontrol)
  // delete masterclass
  public function deleteMasterclass($masterclass_id)

  // save ticket
  public function saveTicket($signature, $first_name, $middle_name, $last_name,
  $email, $phone, $organization, $rank, $status, $ticket_type, $printed,
  $note, $masterclass_array)
  // delete ticket
  public function deleteTicket($signature)

 */

class EventOnline {

    protected $host;         // api host
    protected $api_login;    // api user login
    protected $api_password; // api user password
    protected $token;        // auth token (have expired time 15 min)
    protected $last_error;   // api last error

    public function __construct($host, $api_login, $api_password) {
        $this->host = $this->fixHost($host);
        $this->api_login = $api_login;
        $this->api_password = $api_password;
        $this->token = '';
        $this->last_error = '';
    }

    /* SETTERS AND GETTERS */

    public function getLastError() {
        return $this->last_error;
    }

    public function setHost($host) {
        if ($this->host != $host) {
            $this->host = $this->fixHost($host);
            $this->token = '';
        }
    }

    public function getHost() {
        return $this->host;
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

    /* API METHODS */

    /*
     *  method api/v1/masterclasses/get
     *  return masterclasses list or false
     *
     *  return masterclasses list in object like this (example):
     *    { "error": false,
     *      "description": "",
     *      "masterclasses": [
     *        {
     *          "id": 1,
     *          "name": "Мастеркласс #1",
     *          "time_spending": "0000-00-00 00:00:00"
     *          "withcontrol": "1"
     *        }, {
     *          "id": 3,
     *          "name": "Мастеркласс #2",
     *          "time_spending": "0000-00-00 00:00:00"
     *          "withcontrol": "0"
     *        }
     *      ]
     *    }
     *   
     */

    public function getMasterclasses() {
        // api call
        $result = $this->apiPost($this->host . 'api/v1/masterclasses/get', []);
        // process result
        if ($result['result_code'] == 200) {
            return $result['content'];
        } else {
            return false;
        }
    }

    /*
     *  method api/v1/masterclasses/save
     *  save masterclass
     *
     *  request params:
     *    (int) masterclass-id // Код мастеркласса (если не указан или 0 - будет создан новый мастеркласс)
     *    (string) name // Наименование мастеркласса
     *    (string YYYY-MM-DD HH:NN:SS) time-spending // Время проведения
     *    (bool) withcontrol // Контроль входа
     *   
     *  return masterclass id or false 
     */

    public function saveMasterclass($masterclass_id, $name, $time_spending, $withcontrol) {
        // api call
        $result = $this->apiPost($this->host . 'api/v1/masterclasses/save', [
            'masterclass-id' => $masterclass_id,
            'name' => $name,
            'time-spending' => $time_spending,
            'withcontrol' => $withcontrol,
        ]);
        // process result
        if ($result['result_code'] == 200) {
            return $result['content']->{"masterclass-id"};
        } else {
            return false;
        }
    }

    /*
     *  method api/v1/masterclasses/delete
     *  delete masterclass
     *
     *  request params:
     *    (int) masterclass-id // Код мастеркласса
     *
     *  return masterclass id or false 
     */

    public function deleteMasterclass($masterclass_id) {
        // api call
        $result = $this->apiPost($this->host . 'api/v1/masterclasses/delete', [
            'masterclass-id' => $masterclass_id,
        ]);
        // process result
        if ($result['result_code'] == 200) {
            return $result['content']->{"masterclass-id"};
        } else {
            return false;
        }
    }

    /*
     *  method api/v1/tickets/save
     *  save ticket
     *
     *  request params:
     *   (string) signature // Сигнатура билета (если не указана или '' - будет создан новый билет)
     *   (string) first-name // Имя
     *   (string) middle-name // Отчество
     *   (string) last-name // Фамилия
     *   (string) email // Email
     *   (string) phone // Телефон
     *   (string) organization // Организация
     *   (string) rank // Должность
     *   (string) status // Статус билета
     *   (string) ticket-type // Тип билета
     *   (bool) printed // Признак печати бейджа
     *   (string) note // Заметки
     *   (int array) masterclass // Массив кодов доступных мастерклассов
     *
     *  return ticket signature or false 
     */

    public function saveTicket($signature, $first_name, $middle_name, $last_name, $email, $phone, $organization, $rank, $status, $ticket_type, $printed, $note, $masterclass_array) {
        // prepare data
        $params = [
            'signature' => $signature,
            'first-name' => $first_name, // Имя
            'middle-name' => $middle_name, // Отчество
            'last-name' => $last_name, // Фамилия
            'email' => $email, // Email
            'phone' => $phone, // Телефон
            'organization' => $organization, // Организация
            'rank' => $rank, // Должность
            'status' => $status, // Статус билета
            'ticket-type' => $ticket_type, // Тип билета
            'printed' => $printed, // Признак печати бейджа
            'note' => $note, // Заметки
        ];
        foreach ($masterclass_array as $masterclass_id) {
            $params['masterclass'][] = $masterclass_id;
        }
        // api call   
        $result = $this->apiPost($this->host . 'api/v1/tickets/save', $params);
        // process result
        if ($result['result_code'] == 200) {
            return $result['content']->signature;
        } else {
            return false;
        }
    }

    /*
     *  method api/v1/tickets/delete
     *  delete ticket
     *
     *  request params:
     *    (str) signature - qr-code of ticket
     *
     *  return ticket signature (from server) or false 
     */

    public function deleteTicket($signature) {
        // api call
        $result = $this->apiPost($this->host . 'api/v1/tickets/delete', [
            'signature' => $signature,
        ]);
        // process result
        if ($result['result_code'] == 200) {
            return $result['content']->signature;
        } else {
            return false;
        }
    }

    /* PRIVATE METHODS */

    private function fixHost($host) {
        return rtrim($host, "/") . '/';
    }

    public function Auth() {
        // api call
        $result = $this->do_post_request($this->host . 'auth/jwt/token', [
            'login' => $this->api_login,
            'password' => $this->api_password,
        ]);
        // process result
        if (!$result) {
            $this->token = '';
            return false;
        }

        $answer = json_decode($result['content']);

        if (!$answer->error && $answer->token) {
            $this->token = $answer->token;
            return true;
        } else {
            $this->token = '';
            $this->last_error = $answer->description;
            return false;
        }
    }

    private function checkAuth() {
        if (!$this->token) {
            if (!$this->Auth()) {
                return false;
            }
        }
        return true;
    }

    /*
     *  REST UTILS
     */

    private function extract_result_code($http_str) {
        // Must be "HTTP/1.1 200 OK" or similar
        if (strpos($http_str, 'HTTP/1.1') === 0) {
            return substr($http_str, 9, 3) + 0;
        } else {
            return 0;
        }
    }

    private function do_post_request($url, $data, $referer = "") {
        // convert the data array into URL Parameters like a=1&b=2 etc.
        $data = http_build_query($data);
        // parse the given URL
        $url = parse_url($url);

        if ($url["scheme"] != "http") {
            return [
                "result_code" => 0,
                "error" => 'Not Http Request',
            ];
        }

        // extract host and path from url
        $host = $url["host"];
        $path = $url["path"];

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
            "content" => $content,
        );
    }

    /*
     *  execute api request and return data in format:
     *  [
     *       'result_code' =>, // http result code
     *       'content' =>, // parsed json data
     *  ]
     */

    private function apiPost($url, $data) {
        $response = [];
        $this->last_error = '';
        do {
            $repeat = false;
            $this->checkAuth();
            // prepare data
            $params = $data;
            $params['token'] = $this->token;
            // api call            
            $result = $this->do_post_request($url, $params);
            // check result
            $response['result_code'] = $result['result_code'];
            // parse content            
            $response['content'] = json_decode($result['content']);
            switch ($result['result_code']) {
                case 401:
                    // token expired
                    $this->token = '';
                    if ($response['content']->description == 'Token Not Found') {
                        $repeat = true;
                    }
                    break;
                case 406:
                    if ($response['content']->error) {
                        $this->last_error = $response['content']->description;
                    }
                    break;
            }
        } while ($repeat);

        return $response;
    }

}
