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
            'code' => 'def50200ec72681c9f81ad331c0697ea3188da32a02d6e59d84a93394d2b30ca64a0b304a9074f35e4ea769b77e769ccf8b895b709379a78f5108a4b429de9ee43ba01adc6866c300b9afefabd9d0e03efb1ada42d82f84fc47a2ac76fa9b5236d05e2eafe19e335b8dc97816b166c1c72611f0a97e71c5087e6f966ba763a122cbc091e35b85285dbdf2eb0b54518234428704d7f9f84f62801e744c8669a09e5a086bc98eab850f9bb825ca8aa5aac662dc3624bfc5ba1915d98835cb7a497234270c5b153169c9693eb5d29d28be313d1da0fe82f402f0b7d7d0246af155d45991517d34b00c1cfa1009c12e4349ef11ee0b2ccf82d3b4fc196606c1c8353e8cd0dddf94c4a0fab277073617d80923f0675cc7985b2e464d39031fb2cdec4a636a91aa0bd1b9ce27a629ac81c4069c30f0c1937d6d8bfb17a3f96a644ed6cddab25b9fad054448a7a90daf123b421b623aa4caa391c829c610138741dbf0e166d433ecfa0ca74eb79a43dec71ec8f1ba64509e97c9f6109670a5f489a1a17607cc167f8e8363275bec5216db0229e453554ae7a7d3a70c351e09d98ef0a6f26ce9313bbcfe1667267c7430c4639f71034b0580f5063633c0f0005473c',
            'redirect_uri' => 'https://gastreet.com/',
        ];

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
        $code = (int)$code;
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
            if ($code < 200 && $code > 204) {
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
        deb($response);
    }
}
