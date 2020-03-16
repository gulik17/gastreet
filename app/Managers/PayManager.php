<?php

/**
 * Менеджер
 */
class PayManager extends BaseEntityManager {

    public function PayOrder($ORDER_ID, $SYSTEM_INCOME, $TRANSACTION_ID) {
        Logger::init(Configurator::getSection("logger"));
        $leftAmount = $SYSTEM_INCOME;
        // надо учесть скидку за бронирование
        $um = new UserManager();
        $bookbman = new BookingManager();
        // проверили, выполняем действия
        $orderIdArray = explode('_', $ORDER_ID);
        $payId = $orderIdArray[0];
        $balanceAmount = 0;
        $pm = new PayManager();
        $pmObj = $pm->getById($payId);
        if ($pmObj && $pmObj->needAmount == $SYSTEM_INCOME) {
            if ($pmObj->status != Pay::STATUS_PAID) {
                $payForTicketIds = unserialize($pmObj->payForTicketIds);
                $payForProductIds = unserialize($pmObj->payForProductIds);
                $userId = $pmObj->userId;
                $childrenIds = [];
                $mainUserIds = [];
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
                                $basket->monetaOperationId = $TRANSACTION_ID;
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
                    } else if (!is_array($payForProductIds) && !count($payForProductIds)) {
                        $balanceAmount = $SYSTEM_INCOME;
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
                                $basketProduct->monetaOperationId = $TRANSACTION_ID;
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

                $pmObj->payAmount = $SYSTEM_INCOME;
                $pmObj->monetaOperationId = $TRANSACTION_ID;
                $pmObj->status = Pay::STATUS_PAID;
                $pmObj->tsUpdated = time();
                $pmObj = $pm->save($pmObj);

                if ($balanceAmount > 0) {
                    $um = new UserManager();
                    // Если все билеты уже в статусе оплачен, закинем эти деньги на баланс
                    if ($balanceAmount == $SYSTEM_INCOME) {
                        $um->increaseUlBalance($userId, $SYSTEM_INCOME);
                    } else { // Если некоторые билеты уже в статусе оплачен, закинем эти деньги на баланс
                        $um->increaseUlBalance($userId, $balanceAmount);
                    }
                    //Logger::error("PAY FOR PAYED: ({$TRANSACTION_ID})");
                    //Logger::error($pmObj);
                }

                //Logger::info("BANK PAYED: ({$TRANSACTION_ID})");
                //Logger::info($pmObj);

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
//                if ($leftAmount < 0) {
//                    Logger::error("leftAmount: " . $leftAmount);
//                    Logger::error($pmObj);
//                }
            } //else {
//                Logger::error("DOUBLE PAY: ({$TRANSACTION_ID})");
//                Logger::error($pmObj);
//            }
            return 'SUCCESS';
        } //else if ($pmObj) {
//            Logger::error("wrond need amount: ({$TRANSACTION_ID})");
//            Logger::error($pmObj);
//        }
        return 'ERROR, SEE LOG';
    }

    public function PayBooking($ORDER_ID, $SYSTEM_INCOME, $TRANSACTION_ID) {
        // это бронирование
        $orderIdArray = explode('_', $ORDER_ID);
        $payId = $orderIdArray[0];
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
                        $bomItem->monetaOperationId = $TRANSACTION_ID;
                        $bomItem->status = Booking::STATUS_PAID;
                        $bomItem->tsPay = time();
                        $bomItem->tsFinish = time() + intval(SettingsManager::getValue('days_bron')) * 60 * 60 * 24; // 86400
                        $bomItem = $bom->save($bomItem);
                    }
                }
            }

            $pbmObj->payAmount = $SYSTEM_INCOME;
            $pbmObj->monetaOperationId = $TRANSACTION_ID;
            $pbmObj->status = PayBooking::STATUS_PAID;
            $pbmObj->tsUpdated = time();
            $pbmObj = $pbm->save($pbmObj);
        }
        // result меняем на success
        return 'SUCCESS';
    }

    public function getByIds($inpIds) {
        if (!$inpIds)
            return null;

        if (count($inpIds) == 0)
            return null;
        $ids = implode(",", $inpIds);
        $res = $this->get(new SQLCondition("id IN ($ids)", null, "id"));
        return Utility::sort($inpIds, $res);
    }

    public function getByUserId($userId, $tsStart = 0, $tsFinish = 0) {
        $condition = "userId = {$userId}";
        if ($tsStart) {
            $condition .= " AND tsCreated >= {$tsStart} ";
        }
        if ($tsFinish) {
            $condition .= " AND tsCreated <= {$tsFinish} ";
        }
        $sql = new SQLCondition($condition);
        $sql->orderBy = "tsCreated DESC";
        return $this->get($sql);
    }

    public function getByUserIdAndStatus($userId, $status = 'STATUS_PAID') {
        $condition = "userId = {$userId} AND status = '{$status}'";
        $sql = new SQLCondition($condition);
        $sql->orderBy = "tsCreated DESC";
        return $this->get($sql);
    }

    public function getFilteredPayIds($filterArray) {
        // не выбран ни один фильтр
        if ($filterArray['basicfilter'] == 1) {
            $sql = "SELECT id FROM pay AS p WHERE p.type='" . Pay::TYPE_INVOICE . "' ORDER BY p.id DESC";
            $res = $this->getColumn($sql);
            return $res;
        }

        $res = null;
        $allConditions = array();
        $allConditions[] = "p.type = '" . Pay::TYPE_INVOICE . "'";
        if ($filterArray["basicfilter"] == 2) {
            if ($filterArray["id"]) {
                $allConditions[] = "p.id = {$filterArray["id"]}";
            }
            if (count($allConditions) > 0) {
                $allConditions = " WHERE " . implode(" AND ", $allConditions);
            }

            $sql = "SELECT id FROM pay AS p {$allConditions} ORDER BY p.id DESC";
            $res = $this->getColumn($sql);
        }

        return $res;
    }

    public function getBuyerIds() {
        $sql = "SELECT userId FROM pay AS p WHERE p.status='" . Pay::STATUS_PAID . "'";
        $res = $this->getColumn($sql);
        return $res;
    }

    public function removeOldInvoices($daysOld) {
        $daysOld = intval($daysOld);
        $secondsOld = 60 * 60 * 24 * $daysOld;
        $ts = time();

        $sql = "DELETE FROM pay WHERE type = 'TYPE_INVOICE' AND status = 'STATUS_NEW' AND tsCreated + {$secondsOld} < {$ts}";
        $this->executeNonQuery($sql);
    }

    public function markOrderPayed($payForTicketIds, $payForProductIds, $userId) {
        $childrenIds = array();
        $mainUserIds = array();
        if (is_array($payForTicketIds) && count($payForTicketIds)) {
            $bm = new BasketManager();
            $baskets = $bm->getByIds($payForTicketIds);
            if (is_array($baskets) && count($baskets)) {
                foreach ($baskets AS $basket) {
                    $payAmount = $basket->needAmount - $basket->payAmount - $basket->ulAmount + $basket->returnedAmount - $basket->discountAmount;
                    $basket->tsPay = time();
                    $basket->payAmount = ($payAmount > 0) ? $payAmount : 0;
                    $basket->returnedAmount = 0;
                    $basket->status = Basket::STATUS_PAID;
                    $basket = $bm->save($basket);
                    // список подчиненных
                    if ($basket->childId) {
                        $childrenIds[$basket->childId] = $basket->childId;
                    } else {
                        $mainUserIds[$basket->userId] = $basket->userId;
                    }
                }
            }
        }
        if (is_array($payForProductIds) && count($payForProductIds)) {
            $bpm = new BasketProductManager();
            $basketProducts = $bpm->getByIds($payForProductIds);
            if (is_array($basketProducts) && count($basketProducts)) {
                foreach ($basketProducts AS $basketProduct) {
                    $payAmount = $basketProduct->needAmount - $basketProduct->payAmount - $basketProduct->ulAmount + $basketProduct->returnedAmount - $basketProduct->discountAmount;
                    $basketProduct->tsPay = time();
                    $basketProduct->payAmount = ($payAmount > 0) ? $payAmount : 0;
                    $basketProduct->returnedAmount = 0;
                    $basketProduct->status = BasketProduct::STATUS_PAID;
                    $basketProduct = $bpm->save($basketProduct);
                    // список подчиненных
                    if ($basketProduct->childId) {
                        $childrenIds[$basketProduct->childId] = $basketProduct->childId;
                    } else {
                        $mainUserIds[$basketProduct->userId] = $basketProduct->userId;
                    }
                }
            }
        }

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
                    } else if (!$getChild->baseTicketId) {
                        $getChild->baseTicketId = $getBasket->baseTicketId;
                        $getChild->tsTicketAdd = time();
                        $um->save($getChild);
                    }
                    UserManager::createQrCode($childId);
                    UserManager::sendTicketViaEmail($childId);
                }
            }
        }

        return true;
    }

}
