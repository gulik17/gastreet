<?php

$errorHandlerFileName = "check_" . date("Ymd") . ".txt";
$errorHandlerMessage = date("d.m.Y") . " POST: " . print_r($_POST, true) . " GET: " . print_r($_GET, true);

$fp = fopen($errorHandlerFileName, "a");
if ($fp) {
    flock($fp, LOCK_EX);
    fwrite($fp, $errorHandlerMessage);
    flock($fp, LOCK_UN);
    fclose($fp);
}

/*
 * Тестовые данные
 *
  [MNT_COMMAND] => CHECK
  [MNT_ID] => 49634189
  [MNT_TRANSACTION_ID] => 34_1484559108
  [MNT_AMOUNT] => 16.00
  [MNT_CURRENCY_CODE] => RUB
  [MNT_TEST_MODE] => 0
  [MNT_SIGNATURE] => 81f98582263c50f919839dd6bdf6f703


  http://gss/cron/checkurl.php?MNT_COMMAND=CHECK&MNT_ID=49634189&MNT_TRANSACTION_ID=34_1484559108&MNT_AMOUNT=16.00&MNT_CURRENCY_CODE=RUB&MNT_TEST_MODE=0&MNT_SIGNATURE=81f98582263c50f919839dd6bdf6f703

 */

require_once __DIR__ . '/../config.core.php';

// требуется полный путь к файлам для запуска в режиме cli
require_once SOLO_CORE_PATH . '/app/Config/framework.php';
require_once SOLO_CORE_PATH . '/app/BaseApplication.php';
require_once SOLO_CORE_PATH . '/app/Enviropment.php';

Logger::init(Configurator::getSection("logger"));

$tmp = Configurator::get("application:tempDir");
$accountCode = Configurator::get("moneta:accountCode");

$isDebug = getVar('isDebug');

$MNT_COMMAND = getVar('MNT_COMMAND');
$MNT_ID = getVar('MNT_ID');
$MNT_TRANSACTION_ID = getVar('MNT_TRANSACTION_ID');
$MNT_OPERATION_ID = getVar('MNT_OPERATION_ID');
$MNT_AMOUNT = getVar('MNT_AMOUNT');
$MNT_CURRENCY_CODE = getVar('MNT_CURRENCY_CODE');
$MNT_SUBSCRIBER_ID = getVar('MNT_SUBSCRIBER_ID');
$MNT_TEST_MODE = getVar('MNT_TEST_MODE');
$MNT_SIGNATURE = getVar('MNT_SIGNATURE');

if (!$MNT_TEST_MODE) {
    $MNT_TEST_MODE = '0';
}

$signature = md5($MNT_COMMAND . $MNT_ID . $MNT_TRANSACTION_ID . $MNT_OPERATION_ID . $MNT_AMOUNT . $MNT_CURRENCY_CODE . $MNT_SUBSCRIBER_ID . $MNT_TEST_MODE . $accountCode);

/*
  MNT_SIGNATURE = MD5(MNT_COMMAND + MNT_ID + MNT_TRANSACTION_ID + MNT_OPERATION_ID
  + MNT_AMOUNT + MNT_CURRENCY_CODE + MNT_SUBSCRIBER_ID + MNT_TEST_MODE
  + КОД ПРОВЕРКИ ЦЕЛОСТНОСТИ ДАННЫХ)
 */
if (strpos($MNT_TRANSACTION_ID, '_U') !== false) {
    // это пополнение внутреннего баланса
    $transactionIdArray = explode('_', $MNT_TRANSACTION_ID);
    $payId = $transactionIdArray[0];
    $transactionId = $MNT_TRANSACTION_ID;
    // всё ОК, можно оплачивать
    $resultCode = 402;
    $description = '';
} else if (strpos($MNT_TRANSACTION_ID, '_B') !== false) {
    // это бронирование
    // надо проверить коллизии
    $transactionIdArray = explode('_', $MNT_TRANSACTION_ID);
    $payId = $transactionIdArray[0];
    $transactionId = $MNT_TRANSACTION_ID;
    $hasOnePayed = false;
    $pbm = new PayBookingManager();
    $pbmObj = $pbm->getById($payId);
    if ($pbmObj) {
        $userId = $pbmObj->userId;
        $payBookingIds = @unserialize($pbmObj->payForBookingIds);
        $bm = new BookingManager();
        if (is_array($payBookingIds) && count($payBookingIds)) {
            $bmList = $bm->getByUserIdAndIds($userId, $payBookingIds);
            if (is_array($bmList) && count($bmList)) {
                foreach ($bmList AS $bmItem) {
                    if ($bmItem->payAmount && $bmItem->payAmount == $pbmObj->needAmount) {
                        $hasOnePayed = true;
                        break;
                    }
                }
            }
        }
    }
    if ($hasOnePayed) {
        // надо прервать оплату
        $resultCode = 500;
        $description = "Бронирование уже было частично или полностью оплачено, перейдите в корзину для уточнения статуса бронирования!";
    } else {
        // всё ОК, можно оплачивать
        $resultCode = 402;
        $description = '';
    }
} else {
    // проверили, выполняем действия
    $transactionIdArray = explode('_', $MNT_TRANSACTION_ID);
    $payId = $transactionIdArray[0];
    $transactionId = $MNT_TRANSACTION_ID;

    $hasOnePayed = false;
    $pm = new PayManager();
    $pmObj = $pm->getById($payId);
    if ($pmObj) {
        $userId = $pmObj->userId;
        $payForTicketIds = @unserialize($pmObj->payForTicketIds);
        $payForProductIds = @unserialize($pmObj->payForProductIds);
        // проверить не были ли уже оплачены какие-то из товаров
        $bm = new BasketManager();
        if (is_array($payForTicketIds) && count($payForTicketIds)) {
            $bmList = $bm->getByIds($payForTicketIds);
            if (is_array($bmList) && count($bmList)) {
                foreach ($bmList AS $bmItem) {
                    if ($bmItem->needAmount + $bmItem->returnedAmount - $bmItem->discountAmount <= $bmItem->payAmount + $bmItem->ulAmount) {
                        $hasOnePayed = true;
                        break;
                    }
                }
            }
        }
        // по товарам
        $bpm = new BasketProductManager();
        if (is_array($payForProductIds) && count($payForProductIds)) {
            $bpmList = $bpm->getByIds($payForProductIds);
            if (is_array($bpmList) && count($bpmList)) {
                foreach ($bpmList AS $bpmItem) {
                    if ($bpmItem->needAmount + $bpmItem->returnedAmount - $bpmItem->discountAmount <= $bpmItem->payAmount + $bpmItem->ulAmount) {
                        $hasOnePayed = true;
                        break;
                    }
                }
            }
        }
    }
    if ($hasOnePayed) {
        // надо прервать оплату
        $resultCode = 500;
        $description = "Заказ уже был частично или полностью оплачен, перейдите в корзину для уточнения статуса заказа!";
    } else {
        // всё ОК, можно оплачивать
        $resultCode = 402;
        $description = '';
    }
}

/*
  MNT_SIGNATURE = MD5(MNT_RESULT_CODE + MNT_ID + MNT_TRANSACTION_ID + КОД ПРОВЕРКИ ЦЕЛОСТНОСТИ ДАННЫХ)
 */

$signature = md5($resultCode . $MNT_ID . $MNT_TRANSACTION_ID . $accountCode);
sendAnswer($MNT_ID, $transactionId, $resultCode, $description, $signature);

// echo "<br/><br/>resultCode: <br/>" . $resultCode . "<br/>"; exit;
// функции
function sendAnswer($MNT_ID, $transactionId, $resultCode, $description, $signature) {

    header('Content-Type: text/xml');
    $answer = '<?xml version="1.0" encoding="UTF-8"?>
<MNT_RESPONSE>
<MNT_ID>' . $MNT_ID . '</MNT_ID>
<MNT_TRANSACTION_ID>' . $transactionId . '</MNT_TRANSACTION_ID>
<MNT_RESULT_CODE>' . $resultCode . '</MNT_RESULT_CODE>';

    if ($description) {
        $answer .= '<MNT_DESCRIPTION>' . $description . '</MNT_DESCRIPTION>';
    }

    $answer .= '<MNT_SIGNATURE>' . $signature . '</MNT_SIGNATURE>
</MNT_RESPONSE>';

    echo $answer;

    // записать ответ в лог
    $errorHandlerFileName = "check_" . date("Ymd") . ".txt";
    $errorHandlerMessage = "ANSWER: " . $answer;

    $fp = fopen($errorHandlerFileName, "a");
    if ($fp) {
        flock($fp, LOCK_EX);
        fwrite($fp, $errorHandlerMessage);
        flock($fp, LOCK_UN);
        fclose($fp);
    }
    exit;
}

// функции
function clearInput($input) {
    $input = trim($input);
    if (get_magic_quotes_gpc()) {
        $input = stripslashes($input);
    }
    return addslashes($input);
}

function getRawData($name, $default = null) {
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

function getVar($name, $default = null, $allowHTML = false) {
    $res = getRawData($name, $default);
    if (null === $res || "" === $res)
        return $default;

    // преобразование специальных символов в HTML сущности
    if (!$allowHTML)
        $res = htmlspecialchars($res);

    // экранирование кавычек
    if (!$allowHTML)
        $res = clearInput($res);
    return $res;
}