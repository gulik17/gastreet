<?php

/**
 *
 */
class InvoicePayedAction extends AdminkaAction {

    public function execute() {
        $id = Request::getInt("id");
        if (!$id) {
            Adminka::redirect("manageinvoices", "Не указан ID счёта");
        }
        $pm = new PayManager();
        $pmObj = $pm->getById($id);
        if (!$pmObj) {
            Adminka::redirect("manageinvoices", "Не найден счёт");
        }
        if ($pmObj->type != Pay::TYPE_INVOICE) {
            Adminka::redirect("manageinvoices", "Тип счёта не позволяет отметить его оплаченным");
        }
        if ($pmObj->status == Pay::STATUS_PAID) {
            Adminka::redirect("manageinvoices", "Данный счёт уже был оплачен");
        }

        // дата оплаты (если пришла через форму)
        $tsPay = time();
        $inBalance = Request::getVar("inBalance");
        $startDay = Request::getInt("startDay");
        $startMonth = Request::getInt("startMonth");
        $startYear = Request::getInt("startYear");
        if ($startDay && $startMonth && $startYear) {
            $tsPay = strtotime($startMonth . '/' . $startDay . '/' . $startYear . ' 12:00:00');
        }

        $additionalMessage = "";

        $amount = Request::getInt("amount");

        // старт транзакции
        $pm->startTransaction();
        try {
            // всё норм, продолжаем
            $leftAmount = ($amount) ? $amount : $pmObj->needAmount;
            // то что оплатил пользователь по счёту
            if ($amount) {
                $userPayAmount = $amount;
            } else {
                $userPayAmount = $pmObj->needAmount;
            }
            // то что оплатил пользователь за найденные билеты
            $payForTickets = 0;

            // вынимаем из счёта что по нему хотел оплатить покупатель
            $payForTicketIds = unserialize($pmObj->payForTicketIds);
            $payForProductIds = unserialize($pmObj->payForProductIds);
            // поднимаем пользователя
            $userId = $pmObj->userId;
            // надо учесть скидку за бронирование
            $um = new UserManager();
            $bookbman = new BookingManager();
            $user = $um->getById($userId);
            // распределение оплаты по имеющимся корзинам
            $childrenIds = array();
            $mainUserIds = array();
            
            if (!$inBalance) { // Проверим, нужно ли оплачивать билеты
                if (is_array($payForTicketIds) && count($payForTicketIds)) {
                    $bm = new BasketManager();
                    $baskets = $bm->getByUserIdAndIds($userId, $payForTicketIds);
                    if (is_array($baskets) && count($baskets)) {
                        foreach ($baskets AS $basket) {
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
                                $payAmount = $basket->needAmount - $basket->payAmount - $basket->ulAmount + $basket->returnedAmount - $basket->discountAmount;
                                $payAmount = ($payAmount > 0) ? $payAmount : 0;
                                $leftAmount = $leftAmount - $payAmount;
                                if ($leftAmount >= 0) {
                                    // то что оплатил пользователь за найденные билеты
                                    $payForTickets = $payForTickets + $payAmount;
                                    // данные в базу
                                    $basket->payId = $pmObj->id;
                                    $basket->tsPay = $tsPay;
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
                                } else {
                                    $additionalMessage .= "<br>Оплаченой суммы не хватило для оплаты билета";
                                    break;
                                }
                            }
                        }
                    }
                }

                if (is_array($payForProductIds) && count($payForProductIds)) {
                    $bpm = new BasketProductManager();
                    $basketProducts = $bpm->getByUserIdAndIds($userId, $payForProductIds);
                    if (is_array($basketProducts) && count($basketProducts)) {
                        foreach ($basketProducts AS $basketProduct) {
                            if ($basketProduct->status != BasketProduct::STATUS_PAID) {
                                $payAmount = $basketProduct->needAmount - $basketProduct->payAmount - $basketProduct->ulAmount + $basketProduct->returnedAmount - $basketProduct->discountAmount;
                                $payAmount = ($payAmount > 0) ? $payAmount : 0;
                                $leftAmount = $leftAmount - $payAmount;
                                if ($leftAmount >= 0) {
                                    // то что оплатил пользователь за найденные билеты
                                    $payForTickets = $payForTickets + $payAmount;
                                    // данные в базу
                                    $basketProduct->payId = $pmObj->id;
                                    $basketProduct->tsPay = $tsPay;
                                    $basketProduct->payAmount = $payAmount;
                                    $basketProduct->returnedAmount = 0;
                                    $basketProduct->status = BasketProduct::STATUS_PAID;
                                    $basketProduct = $bpm->save($basketProduct);
                                    // список подчиненных
                                    if ($basketProduct->childId) {
                                        $childrenIds[$basketProduct->childId] = $basketProduct->childId;
                                    } else {
                                        $mainUserIds[$basketProduct->userId] = $basketProduct->userId;
                                    }
                                } else {
                                    $additionalMessage .= "<br>Оплаченой суммы не хватило для оплаты всех мастер-классов";
                                    break;
                                }
                            }
                        }
                    }
                }
            }

            // установить сумму платежа
            if ($amount) {
                $setPayAmount = $amount;
            } else {
                $setPayAmount = ($pmObj->needAmount > 0) ? $pmObj->needAmount : 0;
            }

            $pmObj->payAmount = $setPayAmount;
            $pmObj->status = Pay::STATUS_PAID;
            $pmObj->tsUpdated = $tsPay;
            $pmObj = $pm->save($pmObj);

            // если остались деньги, то добавим их на личный счёт пользователя
            if ($userPayAmount - $payForTickets > 0) {
                $addUlBalance = $userPayAmount - $payForTickets;
                $currentUlBalance = $user->ulBalance;
                $newUlBalance = $currentUlBalance + $addUlBalance;
                $user->ulBalance = $newUlBalance;
                $user = $um->save($user);
                $additionalMessage .= "<br> {$addUlBalance} руб. добавлено на баланс пользователя ID {$userId}.";
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
                    // записать пользователю билет
                    if ($getChild) {
                        if (!$getBasket) {
                            $getChild->baseTicketId = null;
                            $getChild->tsTicketAdd = null;
                            $um->save($getChild);
                        } else if (!$getChild->baseTicketId && $getBasket) {
                            $getChild->baseTicketId = $getBasket->baseTicketId;
                            $getChild->tsTicketAdd = time();
                            $um->save($getChild);
                        }

                        UserManager::createQrCode($childId);
                        UserManager::sendTicketViaEmail($childId);
                    }
                }
            }
        } catch (Exception $e) {
            $pm->rollbackTransaction();
            Logger::error($e);
            Adminka::redirect("manageinvoices", "Не удалось сохранить данные, попробуйте позднее или сообщите администратору об ошибке (1) <pre>" . print_r($e, true)."</pre>");
        }
        // зафиксировали транзакцию
        $pm->commitTransaction();

        // Qr код доступа
        UserManager::createQrCode($userId);
        UserManager::sendTicketViaEmail($userId);
        // для подчиненных тоже надо сгенегить QR код
        $um = new UserManager();
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

        if ($leftAmount < 0) {
            Logger::error("leftAmount: " . $leftAmount);
            Logger::error($pmObj);
        }

        Adminka::redirect("manageinvoices", "Счёт ID {$id} отмечен как оплаченный." . $additionalMessage);
    }
}