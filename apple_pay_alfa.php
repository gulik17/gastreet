<?php

    require_once __DIR__ . '/config.core.php';

    // требуется полный путь к файлам для запуска в режиме cli
    require_once SOLO_CORE_PATH  . '/Config/framework.php';
    require_once SOLO_CORE_PATH  . '/BaseApplication.php';
    require_once SOLO_CORE_PATH  . '/Enviropment.php';
	
	Logger::init(Configurator::getSection("logger"));

	define('USERNAME', 'gastreet-api');
	define('PASSWORD', '9nE+jXy+SYz+2uU');
	//define('PASSWORD', 'gastreet*?1');
	define('MERCHANT', 'gastreet');
	define('GATEWAY_URL', 'https://pay.alfabank.ru/payment/');
	//define('GATEWAY_URL', 'https://web.rbsuat.com/ab/');
	define('RETURN_URL', 'https://gastreet.com/basket');
	define('FAIL_URL', 'https://gastreet.com/basket');

	$param['email'] = "gulik.v@bk.ru";
	$param['phone'] = "79885069291";

	function gateway($method, $data) {
		$curl = curl_init(); // Инициализируем запрос
		curl_setopt_array($curl, [
			CURLOPT_URL => GATEWAY_URL.$method, // Полный адрес метода
			CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
			CURLOPT_RETURNTRANSFER => true, // Возвращать ответ
			CURLOPT_POST => true, // Метод POST
			CURLOPT_POSTFIELDS => $data // Данные в запросе
		]);
		$response = curl_exec($curl); // Выполняем запрос
		 
		$response = json_decode($response, true); // Декодируем из JSON в массив
		curl_close($curl); // Закрываем соединение
		return $response; // Возвращаем ответ
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$json = json_decode($_POST['json'], true);
		$data = [
			'merchant' => MERCHANT,
			'orderNumber' => urlencode($json['orderNumber']."_P"),
			'description' => $json['desc'],
			'language' => 'ru',
			//'additionalParameters' => ['email' => $param['email'], 'phone' => $param['phone']],
			'paymentToken' => base64_encode(json_encode($json['paymentData']))
		];

		$data = json_encode($data);
		$response = gateway('applepay/payment.do', $data);

		//print_r($response);
		
		Logger::info("APPLE PAY NOTIFY APFABANK (response):");
        Logger::info($response);

        if (isset($response['success']) && ($response['success'] == 1) ) { // В случае успеха запишем полученый ID транзакции в базу
            $pm = new PayManager();
            $pmObj = $pm->getById($json['orderNumber']);
            $pmObj->monetaOperationId = $response['data']['orderId'];
            $pmObj->tsUpdated = time();
            $pmObj = $pm->save($pmObj);
        } else if (isset($response['errorCode'])) { // В случае ошибки вывести ее
			echo 'Ошибка #' . $response['errorCode'] . ': ' . $response['errorMessage'];
		}
	}