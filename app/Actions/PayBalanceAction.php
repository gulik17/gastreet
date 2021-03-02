<?php

/**
 * Покупка внутренним балансом
 */
class PayBalanceAction extends AuthorizedUserAction implements IPublicAction {
    public function execute() {
        // по пользователю
        $um = new UserManager();
        $umObj = $um->getById($this->actor->id);
        // текущий пользователей
        $userId = $this->actor->id;
        $isNoFinish = false;
        // баланс текущего пользователя
        $balance = $umObj->ulBalance;
        // подопечные пользователи текущего юзера
        $children = $um->getByParentId($this->actor->id);
        if (is_array($children) && count($children)) {
            foreach ($children AS $child) {
                $balance = $balance + $child->ulBalance;
            }
        }
        if (!$balance) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("Your internal balance is zero", "danger");
            } else {
                Enviropment::redirectBack("Ваш внутренний баланс равен нулю", "danger");
            }
        }
        // список подчиненных
        $childrenIds = array();
        $mainUserIds = array();
        // начальный баланс
        $startBalance = $balance;
        // собрали $balance
        // начинаем транзакцию
        $um->startTransaction();
        try {
            // надо найти сумму по действующему бронированию
            // на эту сумму надо уменьшить стоимость, включить данное число в скидку
            // уменьшать надо после скидки
            $bookbman = new BookingManager();
            // что в корзине по основному билету
            $bm = new BasketManager();
            if ($this->actor->parentUserId) {
                $purchasedTickets = $bm->getTicketsByChildId($this->actor->id);
            } else {
                $purchasedTickets = $bm->getTicketsByUserId($this->actor->id);
            }
            
            Logger::info("BASKET PAY BALANCE TICKET");
            Logger::info($purchasedTickets);
            // далее покупка
            if (count($purchasedTickets)) {
                foreach ($purchasedTickets AS $purchasedTicket) {
                    if ($purchasedTicket['needAmount'] - $purchasedTicket['payAmount'] - $purchasedTicket['ulAmount'] + $purchasedTicket['returnedAmount'] - $purchasedTicket['discountAmount'] > 0 && $purchasedTicket['status'] != Basket::STATUS_PAID) {
                        $needAmount = $purchasedTicket['needAmount'] - $purchasedTicket['payAmount'] - $purchasedTicket['ulAmount'] + $purchasedTicket['returnedAmount'] - $purchasedTicket['discountAmount'];
                        // 15000    = 15000                          - 0                             - 0                            + 0                                  - 0
                        // в билет прописываем оплату
                        $basket = $bm->getById($purchasedTicket['id']);
                        if ($basket) {
                            // если было бронирование
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
                                // уменьшим сумму долга
                                $needAmount = $needAmount - $booking->payAmount;
                            }
                            $needAmount = ($needAmount > 0) ? $needAmount : 0;

                            // платим за билет, уменьшаем баланс
                            $balance = $balance - $needAmount;
                            if ($balance < 0) {
                                throw new Exception("code001");
                            }
                            // данные в базу
                            $basket->tsPay = time();
                            $basket->ulAmount = $needAmount;
                            $basket->returnedAmount = 0;
                            $basket->status = Basket::STATUS_PAID;
                            $basket = $bm->save($basket);
                            // список подчиненных для QR кода
                            if ($basket->childId) {
                                $childrenIds[$basket->childId] = $basket->childId;
                            } else {
                                $mainUserIds[$basket->userId] = $basket->userId;
                            }
                        }
                    }
                }
            }

            // что в корзине по мастер-классам
            $bpm = new BasketProductManager();
            if ($this->actor->parentUserId) {
                $purchasedProducts = $bpm->getProductsByChildId($this->actor->id);
            } else {
                $purchasedProducts = $bpm->getProductsByUserId($this->actor->id);
            }
            if (count($purchasedProducts)) {
                foreach ($purchasedProducts AS $purchasedProduct) {
                    if ($purchasedProduct['needAmount'] - $purchasedProduct['payAmount'] - $purchasedProduct['ulAmount'] + $purchasedProduct['returnedAmount'] - $purchasedProduct['discountAmount'] > 0 && $purchasedProduct['status'] != BasketProduct::STATUS_PAID) {
                        $needAmount = $purchasedProduct['needAmount'] - $purchasedProduct['payAmount'] - $purchasedProduct['ulAmount'] + $purchasedProduct['returnedAmount'] - $purchasedProduct['discountAmount'];
                        // в билет прописываем оплату
                        $basketProduct = $bpm->getById($purchasedProduct['id']);
                        if ($basketProduct) {
                            // если было бронирование
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
                                // $basketProduct->discountAmount = $basketProduct->discountAmount + $booking->payAmount;
                                // уменьшим сумму долга
                                // $needAmount = $needAmount - $booking->payAmount;
                            }
                            $needAmount = ($needAmount > 0) ? $needAmount : 0;
                            // платим за билет, уменьшаем баланс
                            $balance = $balance - $needAmount;
                            if ($balance < 0) {
                                throw new Exception("code001");
                            }
                            // данные в базу
                            $basketProduct->tsPay = time();
                            $basketProduct->ulAmount = $needAmount;
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
            }

            // распределяем затраты по всем участникам (минусуем баланс)
            if ($balance < $startBalance) {
                if (is_array($children) && count($children)) {
                    // общая сумма того, что нужно списать
                    $deltaAmount = $startBalance - $balance;
                    // сначала списываем у основного пользователя
                    if ($umObj->ulBalance >= $deltaAmount) {
                        if ($balance < 0) {
                            throw new Exception("code001");
                        }
                        $umObj->ulBalance = $balance;
                        $umObj = $um->save($umObj);
                    } else {
                        // не хватает у основного покупателя
                        $deltaAmount = $deltaAmount - $umObj->ulBalance;
                        $umObj->ulBalance = 0;
                        $umObj = $um->save($umObj);
                        // остаток распределим по остальным
                        foreach ($children AS $child) {
                            if ($deltaAmount > 0) {
                                if ($child->ulBalance >= $deltaAmount) {
                                    // хватает у доп. пользователя
                                    if ($child->ulBalance - $deltaAmount < 0) {
                                        throw new Exception("code001");
                                    }
                                    $child->ulBalance = $child->ulBalance - $deltaAmount;
                                    $deltaAmount = 0;
                                    $child = $um->save($child);
                                    break;
                                } else {
                                    // не хватает у доп. пользователя
                                    $deltaAmount = $deltaAmount - $child->ulBalance;
                                    $child->ulBalance = 0;
                                    $child = $um->save($child);
                                }
                            }
                        }
                    }
                } else {
                    // пользователь только один, без дополнительных
                    if ($balance < 0) {
                        throw new Exception("code001");
                    }
                    $umObj->ulBalance = $balance;
                    $umObj = $um->save($umObj);
                }
            } else {
                $isNoFinish = true;
            }
        } catch (Exception $e) {
            $um->rollbackTransaction();
            Logger::error($e);
            if ($e->getMessage() == "code001") {
                if ($this->lang == 'en') {
                    Enviropment::redirectBack("Insufficient funds", "danger");
                } else {
                    Enviropment::redirectBack("Бро, чтобы оплатить, пополни баланс до полной стоимости покупки", "emoji8");
                }
            } else {
                if ($this->lang == 'en') {
                    Enviropment::redirectBack("Error occurred, please try again later or contact the administrator", "danger");
                } else {
                    Enviropment::redirectBack("Произошла ошибка, попробуйте позднее или обратитесь к администратору", "danger");
                }
            }
        }
        $um->commitTransaction();

        // загасить бронь
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

        if ($isNoFinish) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("Payment with internal balance funds failed", "danger");
            } else {
                Enviropment::redirectBack("Оплата средствами внутреннего баланса не была совершена", "danger");
            }
        } else {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("Payment with internal balance funds made", "success");
            } else {
                Enviropment::redirectBack("Оплата средствами внутреннего баланса совершена", "success");
            }
        }
    }
}