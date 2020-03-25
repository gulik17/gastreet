<?php

class AmoCRM {
    /**
     * @var string
     */
    public $baseDomain = 'www.amocrm.ru';

    /**
     * @var string
     */
    public $protocol = 'https://';

    /**
     * @var array
     */
    public $scopes = [];

    /**
     * @var string
     */
    public $authorizationHeader = 'Bearer';

    /**
     * @var array
     */
    public $headers = [
        'User-Agent' => 'amoCRM/oAuth Client 1.0'
    ];

    /**
     * AmoCRM constructor.
     * @param array $options
     */
    public function __construct($options = []) {
        if (isset($options['baseDomain'])) {
            $this->baseDomain = $options['baseDomain'];
        }
    }

    /**
     * @param string $domain
     */
    public function setBaseDomain($domain) {
        $this->baseDomain = $domain;
    }

    /**
     * @return string
     */
    public function getBaseDomain() {
        return $this->baseDomain;
    }

    /**
     * @return string
     */
    public function getClientId() {
        return $this->clientId;
    }

    /**
     * Get authorization url to begin OAuth flow
     *
     * @return string
     */
    public function getBaseAuthorizationUrl() {
        return $this->protocol . $this->baseDomain . '/oauth/';
    }

    /**
     * Get access token url to retrieve token
     *
     * @param array $params
     *
     * @return string
     */
    public function getBaseAccessTokenUrl(array $params) {
        return $this->protocol . $this->baseDomain . '/oauth2/access_token';
    }

    /**
     * Get the default scopes used by this provider.
     *
     * @return array
     */
    protected function getDefaultScopes() {
        return [];
    }

    public function urlAccount() {
        return $this->protocol . $this->baseDomain . '/';
    }

    /**
     * Generate a user object from a successful user details request.
     *
     * @param array $response
     * @param AccessToken $token
     * @return AmoCRMResourceOwner
     */
    protected function createResourceOwner(array $response, AccessToken $token) {
        return new AmoCRMResourceOwner($response);
    }

    /**
     * @inheritDoc
     */
    protected function checkResponse(ResponseInterface $response, $data) {
        if ($response->getStatusCode() >= 400) {
            throw AmoCRMException::errorResponse($response, $data);
        }
    }

    /**
     * Get provider url to fetch user details
     *
     * @param AccessToken $token
     *
     * @return string
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token) {
        return $this->urlAccount() . '/v3/user';
    }

    /**
     * Get access tocken by code
     */

    public function getAccessTockenByCode() {
        $subdomain = 'infogastreetcom'; //Поддомен нужного аккаунта
        $link = 'https://' . $subdomain . '.amocrm.ru/oauth2/access_token'; //Формируем URL для запроса

        /** Соберем данные для запроса */
        $data = [
            'client_id' => '8c117ac3-7f66-4a54-a37d-3a5fab849a57',
            'client_secret' => '5Gf7usLZMZkXro0G36D6Rw4eu0MsFmt2gWlWjq0wITSqMuYGUy9Oh3AntfHJrAuJ',
            'grant_type' => 'authorization_code',
            'code' => 'def50200c30e1ad92c23d1df3d9b6352ed614c23c42afc55d7b26200bef93ef711da96f3f0609d084e41e2d9e63364b158d1b99997ab62b645489e7fa6c52ef84332979d20dfae37564927fc38068c945140f53e849efa00803f277dbdd7f54daa908b4ebbe92a505217e80c9c44b8ed7e829c9d9d3bef80f8551b24f4b5a44954e937187d49a1abbfa81c8181b0ea119a3dd2f2683aa6de3d8a349c6493a3f99825ea69a7176f0ae608dacf449d9c3eb4c0a6081477a2b2661af6294d785144a0788ed2ae2969ba80ff5deaf3def31f8820f26dea34b969445629c245730e92c1a486a92af2bc4a96f288600e6e023685399844dfa184bff70cfbadb06bbb531086e054472507cf197b47a3bef72e9fb296ba4a5d8417c9f15c46c97391b3e8c3e57bdd9cffc34dff1afb5118c88a05f1be6e4cee49e4af948328a2011356483b104650a36b6c8aa2d6b6ba88613765055bd13bf850f7429c5eeb4c3f7abb55999fe1d8314853c42caabd67f0f9e1acab333dda482792727eeb07cfaca334c1b2735d8408902a2456ebb9cb82275864f1b1caa67c9fc298e26cc45bedecdc30d889e95416639f7cca7f7c65200c5c409e88fbc7134a2c5670494938ecd9',
            'redirect_uri' => 'https://gastreet.com/',
        ];

       // deb($data);

        /**
         * Нам необходимо инициировать запрос к серверу.
         * Воспользуемся библиотекой cURL (поставляется в составе PHP).
         * Вы также можете использовать и кроссплатформенную программу cURL, если вы не программируете на PHP.
         */
        $curl = curl_init(); //Сохраняем дескриптор сеанса cURL
        /** Устанавливаем необходимые опции для сеанса cURL  */
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-oAuth-client/1.0');
        curl_setopt($curl,CURLOPT_URL, $link);
        curl_setopt($curl,CURLOPT_HTTPHEADER,['Content-Type:application/json']);
        curl_setopt($curl,CURLOPT_HEADER, false);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, 2);
        $out = curl_exec($curl); //Инициируем запрос к API и сохраняем ответ в переменную
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        /** Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
        $code = (int) $code;
        $errors = [
            400 => 'Bad request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not found',
            500 => 'Internal server error',
            502 => 'Bad gateway',
            503 => 'Service unavailable',
        ];

        try {
            /** Если код ответа не успешный - возвращаем сообщение об ошибке  */
            if ($code < 200 || $code > 204) {
               throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
            }
        }
        catch(\Exception $e) {
            die('Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode());
        }

        /**
         * Данные получаем в формате JSON, поэтому, для получения читаемых данных,
         * нам придётся перевести ответ в формат, понятный PHP
         */
        $response = json_decode($out, true);
        return $response;
    }

    public function getCookieFile() {
        #Массив с параметрами, которые нужно передать методом POST к API системы
        $user = [
            'USER_LOGIN' => 'info@gastreet.com', #Ваш логин (электронная почта)
            'USER_HASH' => '5Gf7usLZMZkXro0G36D6Rw4eu0MsFmt2gWlWjq0wITSqMuYGUy9Oh3AntfHJrAuJ', #Хэш для доступа к API (смотрите в профиле пользователя)
        ];
        $subdomain = 'infogastreetcom'; #Наш аккаунт - поддомен
        #Формируем ссылку для запроса
        $link = 'https://' . $subdomain . '.amocrm.ru/private/api/auth.php?type=json';
        /* Нам необходимо инициировать запрос к серверу. Воспользуемся библиотекой cURL (поставляется в составе PHP). Вы также можете
        использовать и кроссплатформенную программу cURL, если вы не программируете на PHP. */
        $curl = curl_init(); #Сохраняем дескриптор сеанса cURL
        #Устанавливаем необходимые опции для сеанса cURL
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
        curl_setopt($curl, CURLOPT_URL, $link);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($user));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_COOKIEJAR, SOLO_CORE_PATH.'/amocrm/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $out = curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE); #Получим HTTP-код ответа сервера
        curl_close($curl); #Завершаем сеанс cURL
        /* Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
        $code = (int) $code;
        $errors = [
            301 => 'Moved permanently',
            400 => 'Bad request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not found',
            500 => 'Internal server error',
            502 => 'Bad gateway',
            503 => 'Service unavailable',
        ];
        try {
            #Если код ответа не равен 200 или 204 - возвращаем сообщение об ошибке
            if ($code != 200 && $code != 204) {
                throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error', $code);
            }
        } catch (Exception $E) {
            die('Ошибка: ' . $E->getMessage() . PHP_EOL . 'Код ошибки: ' . $E->getCode());
        }
        /*
        Данные получаем в формате JSON, поэтому, для получения читаемых данных,
        нам придётся перевести ответ в формат, понятный PHP */
        $Response = json_decode($out, true);
        $Response = $Response['response'];
        //Флаг авторизации доступен в свойстве "auth"
        if (isset($Response['auth'])) {
            return 'Авторизация прошла успешно';
        }

        return 'Авторизация не удалась';
    }
}
