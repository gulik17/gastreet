<?php
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
    if (null === $res || "" === $res) {
        return $default;
    }
    // преобразование специальных символов в HTML сущности
    if (!$allowHTML) {
        $res = htmlspecialchars($res);
    }
    // экранирование кавычек
    if (!$allowHTML) {
        $res = clearInput($res);
    }
    return $res;
}

$errorHandlerFileName = "pay_".date("Ymd").".txt";
$errorHandlerMessage = date("d.m.Y") . " POST: " . print_r($_POST, true) . " GET: " . print_r($_GET, true);

$fp = fopen($errorHandlerFileName, "a");
if ($fp) {
    flock($fp, LOCK_EX);
    fwrite($fp, $errorHandlerMessage);
    flock($fp, LOCK_UN);
    fclose($fp);
}

require_once __DIR__ . '/../config.core.php';

// требуется полный путь к файлам для запуска в режиме cli
require_once SOLO_CORE_PATH.'/Config/framework.php';
require_once SOLO_CORE_PATH.'/BaseApplication.php';
require_once SOLO_CORE_PATH.'/Enviropment.php';
include_once APPLICATION_DIR . '/alba-client/alba.php';

Logger::init(Configurator::getSection("logger"));

$tmp = Configurator::get("application:tempDir");

$result = 'FAIL';

// пример запроса
// MNT_ID=51916974&MNT_TRANSACTION_ID=1481897171548529&MNT_OPERATION_ID=123149253&MNT_AMOUNT=12.00&MNT_CURRENCY_CODE=RUB&
// MNT_TEST_MODE=0&MNT_SIGNATURE=7f9bb2ca79d9a017055423495959a768&paymentSystem.unitId=1686945&MNT_CORRACCOUNT=303&
// PAYMENTTOKEN=0123143206&MNT_DUPLICATE_ID=123143206&MNT_IS_IFRAME=&MNT_IS_REGULAR=1&MNT_PAY_SYSTEM=plastic&
// MNT_FORWARD_FORM=1&MNT_FORM_METHOD=POST&MNT_FEE=-0.33&paymenttoken=0123143206&cardnumber=427666******5301

//$accountCode = Configurator::get("rfi:secretKey");
$secretKey = Configurator::get("rfi:secretKey");

$RFI_TRANSACTION_ID = getVar('tid');
$RFI_NAME           = getVar('name');
$RFI_COMMENT        = getVar('comment');
$RFI_PARTNER_ID     = getVar('partner_id');
$RFI_SERVICE_ID     = getVar('service_id');
$RFI_ORDER_ID       = getVar('order_id');
$RFI_TYPE           = getVar('type');
$RFI_PARTNER_INCOME = getVar('partner_income');
$RFI_SYSTEM_INCOME  = getVar('system_income');
$RFI_TEST_MODE      = getVar('test');
$RFI_CHECK          = getVar('check');

if (!$RFI_TEST_MODE) {
    $RFI_TEST_MODE = '';
}

$leftAmount = $RFI_SYSTEM_INCOME;
$check = $RFI_TRANSACTION_ID . $RFI_NAME . $RFI_COMMENT . $RFI_PARTNER_ID . $RFI_SERVICE_ID . $RFI_ORDER_ID . $RFI_TYPE . $RFI_PARTNER_INCOME . $RFI_SYSTEM_INCOME . $RFI_TEST_MODE . $secretKey;
$signature  = md5( $check );

if ((!$secretKey || $signature == $RFI_CHECK) && strpos($RFI_ORDER_ID, '_') !== false) {
    if (strpos($RFI_ORDER_ID, '_U') !== false) {
        // это пополнение внутреннего баланса
        $orderIdArray = explode('_', $RFI_ORDER_ID);
        $payId = $orderIdArray[0];
        
        $payb = new PayBalanceManager();
        $paybObj = $payb->getById($payId);
        if ($paybObj) {
            $userId = $paybObj->userId;
            // обновляем статус операции
            $paybObj->payAmount = $RFI_SYSTEM_INCOME;
            $paybObj->monetaOperationId = $RFI_TRANSACTION_ID;
            $paybObj->status = PayBooking::STATUS_PAID;
            $paybObj->tsUpdated = time();
            $paybObj = $payb->save($paybObj);
            // обновляем баланс пользователя
            $um = new UserManager();
            $um->increaseUlBalance($userId, $RFI_SYSTEM_INCOME);
        }

        // result меняем на success
        $result = 'SUCCESS';
    } else if (strpos($RFI_ORDER_ID, '_B') !== false) {
        // это бронирование
        $orderIdArray = explode('_', $RFI_ORDER_ID);
        $payId = $orderIdArray[0];
        
        $hasOnePayed = false;
        $pbm = new PayBookingManager();
        $pbmObj = $pbm->getById($payId);
        if ($pbmObj) {
            $userId = $pbmObj->userId;
            $payBookingIds = @unserialize($pbmObj->payForBookingIds);
            $bom = new BookingManager();
            if (is_array($payBookingIds) && count($payBookingIds)) {
                // $bookingPayAmount = $RFI_SYSTEM_INCOME / count($payBookingIds);
                $bookingPayAmount = intval(SettingsManager::getValue('amount_bron'));
                $bomList = $bom->getByUserIdAndIds($userId, $payBookingIds);
                if (is_array($bomList) && count($bomList)) {
                    foreach ($bomList AS $bomItem) {
                        // ставим "Оплачено" всем booking
                        $bomItem->payAmount = $bookingPayAmount;
                        $bomItem->monetaOperationId = $RFI_TRANSACTION_ID;
                        $bomItem->status = Booking::STATUS_PAID;
                        $bomItem->tsPay = time();
                        $bomItem->tsFinish = time() + intval(SettingsManager::getValue('days_bron')) * 60 * 60 * 24; // 86400
                        $bomItem = $bom->save($bomItem);
                    }
                }
            }

            $pbmObj->payAmount = $RFI_SYSTEM_INCOME;
            $pbmObj->monetaOperationId = $RFI_TRANSACTION_ID;
            $pbmObj->status = PayBooking::STATUS_PAID;
            $pbmObj->tsUpdated = time();
            $pbmObj = $pbm->save($pbmObj);
        }
        // result меняем на success
        $result = 'SUCCESS';
    } else if (strpos($RFI_ORDER_ID, '_P') !== false) {
        // надо учесть скидку за бронирование
        $um = new UserManager();
        $bookbman = new BookingManager();
        // проверили, выполняем действия
        $orderIdArray = explode('_', $RFI_ORDER_ID);
        $payId = $orderIdArray[0];
        $balanceAmount = 0;
        $pm = new PayManager();
        $pmObj = $pm->getById($payId);
        if ($pmObj && $pmObj->needAmount == $RFI_SYSTEM_INCOME) {
            if ($pmObj->status != Pay::STATUS_PAID) {
                $payForTicketIds = unserialize($pmObj->payForTicketIds);
                $payForProductIds = unserialize($pmObj->payForProductIds);
                $userId = $pmObj->userId;
                $childrenIds = array();
                $mainUserIds = array();
                if (is_array($payForTicketIds) && count($payForTicketIds)) {
                    $bm = new BasketManager();
                    $baskets = $bm->getByIds($payForTicketIds);
                    if (is_array($baskets) && count($baskets)) {
                        foreach ($baskets AS $basket) {
                            // Проверим, не получилось ли так, что в это же время юзер оплатил параллельно
                            if ($basket->status != Basket::STATUS_PAID) {
                                // есть ли действующее бронирование по данному пользователю
                                if ($basket->childId) {
                                    $bookings = $bookbman->getActiveByChildId($basket->childId);
                                } else {
                                    $bookings = $bookbman->getActiveByUserIdNoChildren($basket->userId);
                                }

                                $booking = null;
                                if (isset($bookings[0])) {
                                    $booking = $bookings[0];
                                    // увеличим скидку на сумму бронирования
                                    $basket->discountAmount = $basket->discountAmount + $booking->payAmount;
                                }
                                
                                // сумма оплаты
                                $payAmount = $basket->needAmount - $basket->payAmount - $basket->ulAmount + $basket->returnedAmount - $basket->discountAmount;
                                $payAmount = ($payAmount > 0) ? $payAmount : 0;

                                //$user = $um->getById($userId);
                                //if ($user->ulBalance !== 0) {
                                    // Если у юзера баланс не равен нулю, то нужно вычесть убрать эту сумму
                                    // с баланса, т.к. юзер заплатил сумму за вычетом баланса
                                //    $user->ulBalance = 0;
                                //    $user = $um->save($user);
                                //}

                                $basket->payId = $pmObj->id;
                                $basket->tsPay = time();
                                $basket->payAmount = $payAmount;
                                $basket->returnedAmount = 0;
                                $basket->monetaOperationId = $RFI_TRANSACTION_ID;
                                $basket->status = Basket::STATUS_PAID;
                                $basket = $bm->save($basket);
                                $leftAmount = $leftAmount - $basket->payAmount;
                                // список подчиненных
                                if ($basket->childId) {
                                    $childrenIds[$basket->childId] = $basket->childId;
                                } else {
                                    $mainUserIds[$basket->userId] = $basket->userId;
                                }
                            } else {
                                // Собираем деньги которыми юзер пытался оплатить уже оплаченное
                                $balanceAmount = $balanceAmount + $basket->payAmount;
                            }
                        }
                    }
                }
                if (is_array($payForProductIds) && count($payForProductIds)) {
                    $bpm = new BasketProductManager();
                    $basketProducts = $bpm->getByIds($payForProductIds);
                    if (is_array($basketProducts) && count($basketProducts)) {
                        foreach ($basketProducts AS $basketProduct) {
                            // Проверим, не получилось ли так, что в это же время юрез оплатил параллельно
                            if ($basketProduct->status != BasketProduct::STATUS_PAID) {
                                // есть ли действующее бронирование по данному пользователю
                                if ($basketProduct->childId) {
                                    $bookings = $bookbman->getActiveByChildId($basketProduct->childId);
                                } else {
                                    $bookings = $bookbman->getActiveByUserIdNoChildren($basketProduct->userId);
                                }
                                $booking = null;
                                // TODO: если попросят, надо предоставить скидку но только один раз!
                                if (isset($bookings[0])) {
                                    $booking = $bookings[0];
                                    // увеличим скидку на сумму бронирования
                                    // $basketProduct->discountAmount = $basketProduct->discountAmount + $basketProduct->payAmount;
                                }
                                // сумма оплаты
                                $payAmount = $basketProduct->needAmount - $basketProduct->payAmount - $basketProduct->ulAmount + $basketProduct->returnedAmount - $basketProduct->discountAmount;
                                $basketProduct->payId = $pmObj->id;
                                $basketProduct->tsPay = time();
                                $basketProduct->payAmount = ($payAmount > 0) ? $payAmount : 0;;
                                $basketProduct->returnedAmount = 0;
                                $basketProduct->monetaOperationId = $RFI_TRANSACTION_ID;
                                $basketProduct->status = BasketProduct::STATUS_PAID;
                                $basketProduct = $bpm->save($basketProduct);
                                $leftAmount = $leftAmount - $basketProduct->payAmount;
                                // список подчиненных
                                if ($basketProduct->childId) {
                                    $childrenIds[$basketProduct->childId] = $basketProduct->childId;
                                } else {
                                    $mainUserIds[$basketProduct->userId] = $basketProduct->userId;
                                }
                            } else {
                                // Собираем деньги которыми юзер пытался оплатить уже оплаченное
                                $balanceAmount = $balanceAmount + $basketProduct->payAmount;
                            }
                        }
                    }
                }

                $pmObj->payAmount = $RFI_SYSTEM_INCOME;
                $pmObj->monetaOperationId = $RFI_TRANSACTION_ID;
                $pmObj->status = Pay::STATUS_PAID;
                $pmObj->tsUpdated = time();
                $pmObj = $pm->save($pmObj);
                
                if ($balanceAmount > 0) {
                    $um = new UserManager();
                    // Если все билеты уже в статусе оплачен, закинем эти деньги на баланс
                    if ($balanceAmount == $RFI_SYSTEM_INCOME) {
                        $um->increaseUlBalance($userId, $RFI_SYSTEM_INCOME);
                    } else { // Если некоторые билеты уже в статусе оплачен, закинем эти деньги на баланс
                        $um->increaseUlBalance($userId, $balanceAmount);
                    }
                    Logger::error("PAY FOR PAYED: ({$RFI_TRANSACTION_ID})");
                    Logger::error($pmObj);
                }
                
                Logger::info("BANK PAYED: ({$RFI_TRANSACTION_ID})");
                Logger::info($pmObj);

                // загасить бронь
                $um = new UserManager();
                $bookbman = new BookingManager();
                if (is_array($mainUserIds) && count($mainUserIds)) {
                    foreach ($mainUserIds AS $mainUserId) {
                        $mainUser = $um->getById($mainUserId);
                        if ($mainUser) {
                            $bm = new BasketManager();
                            if ($mainUser->parentUserId) {
                                $bookbman->setAsFinishedAllActiveByChildId($mainUserId);
                                $getBasket = $bm->getTicketsByChildId($mainUserId);
                            } else {
                                $bookbman->setAsFinishedAllActiveByUserId($mainUserId);
                                $getBasket = $bm->getTicketsByUserIdNoChildren($mainUserId);
                            }
                            if (isset($getBasket[0])) {
                                $getBasket = (object) $getBasket[0];
                            }
                            // записать пользователю билет
                            if (!$getBasket) {
                                $mainUser->baseTicketId = null;
                                $mainUser->tsTicketAdd = null;
                                $um->save($mainUser);
                            } else if (!$mainUser->baseTicketId) {
                                $mainUser->baseTicketId = $getBasket->baseTicketId;
                                $mainUser->tsTicketAdd = time();
                                $um->save($mainUser);
                            }
                            // Qr код доступа
                            UserManager::createQrCode($mainUserId);
                            UserManager::sendTicketViaEmail($mainUserId);
                        }
                    }
                }

                // для подчиненных тоже надо сгенегить QR код
                if (count($childrenIds)) {
                    $bm = new BasketManager();
                    foreach ($childrenIds AS $childId) {
                        $bookbman->setAsFinishedAllActiveByChildId($childId);
                        $getBasket = $bm->getTicketsByChildId($childId);
                        if (isset($getBasket[0])) {
                            $getBasket = (object) $getBasket[0];
                        }
                        $getChild = $um->getById($childId);
                        if ($getChild) {
                            // записать пользователю билет
                            if (!$getBasket) {
                                $getChild->baseTicketId = null;
                                $getChild->tsTicketAdd = null;
                                $um->save($getChild);
                            } else if (!$getChild->baseTicketId && $getBasket && isset($getBasket[0])) {
                                $getBasket = $getBasket[0];
                                $getChild->baseTicketId = $getBasket['baseTicketId'];
                                $getChild->tsTicketAdd = time();
                                $um->save($getChild);
                            }
                            UserManager::createQrCode($childId);
                            UserManager::sendTicketViaEmail($childId);
                        }
                    }
                }

                // странная ситуация
                if ($leftAmount < 0) {
                    Logger::error("leftAmount: " . $leftAmount);
                    Logger::error($pmObj);
                }
            } else {
                Logger::error("DOUBLE PAY: ({$RFI_TRANSACTION_ID})");
                Logger::error($pmObj);
            }
            $result = 'SUCCESS';
        } else if ($pmObj) {
            Logger::error("wrond need amount: ({$RFI_TRANSACTION_ID})");
            Logger::error($pmObj);
        }
    }
}
echo $result;