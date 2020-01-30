<?php

/**
 *
 */
class PayCardAction extends AuthorizedUserAction implements IPublicAction {

    public function execute() {
        // сколько покупатель видел в корзине
        $total = floatval(Request::getVar('total'));
        $cardId = Request::getInt('cardId');
        if (!$cardId) {
            header("Location: /index.php?do=payment&mode=paynewcard&total={$total}");
            exit;
        }

        // по пользователю
        $um = new UserManager();
        $umObj = $um->getById($this->actor->id);

        $ucm = new UserCardManager();
        $ucmObj = $ucm->getById($cardId);
        if (!$ucmObj) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("No payment card selected", "danger");
            } else {
                Enviropment::redirectBack("Не выбрана карта оплаты", "danger");
            }
        }
        if ($ucmObj->userId != $this->actor->id) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("No payment card selected", "danger");
            } else {
                Enviropment::redirectBack("Не выбрана карта оплаты", "danger");
            }
        }
        // сколько по рассчетам
        $needAmount = 0;
        // надо найти сумму по действующему бронированию
        // на эту сумму надо уменьшить стоимость, включить данное число в скидку
        // уменьшать надо после скидки
        $bookbman = new BookingManager();
        // что в корзине по основному билету
        $bm = new BasketManager();
        $purchasedTicketIds = array();
        if ($umObj->parentUserId) {
            $purchasedTickets = $bm->getTicketsByChildId($this->actor->id);
        } else {
            $purchasedTickets = $bm->getTicketsByUserId($this->actor->id);
        }
        // далее покупка
        if (count($purchasedTickets)) {
            foreach ($purchasedTickets AS $purchasedTicket) {
                if ($purchasedTicket['needAmount'] - $purchasedTicket['payAmount'] - $purchasedTicket['ulAmount'] + $purchasedTicket['returnedAmount'] - $purchasedTicket['discountAmount'] > 0) {
                    $purchasedTicketIds[] = $purchasedTicket['id'];
                    $needTicketAmount = $purchasedTicket['needAmount'] - $purchasedTicket['payAmount'] - $purchasedTicket['ulAmount'] + $purchasedTicket['returnedAmount'] - $purchasedTicket['discountAmount'];
                    // если было бронирование
                    $basket = $bm->getById($purchasedTicket['id']);
                    if ($basket) {
                        if ($basket->childId) {
                            $bookings = $bookbman->getActiveByChildId($basket->childId);
                        } else {
                            $bookings = $bookbman->getActiveByUserIdNoChildren($basket->userId);
                        }
                        $booking = null;
                        if (isset($bookings[0])) {
                            $booking = $bookings[0];
                            // уменьшим сумму долга
                            $needTicketAmount = $needTicketAmount - $booking->payAmount;
                        }
                        $needTicketAmount = ($needTicketAmount > 0) ? $needTicketAmount : 0;
                    }

                    $needAmount = $needAmount + $needTicketAmount;
                }
            }
        }

        // что в корзине по мастер-классам
        $bpm = new BasketProductManager();
        $purchasedProductIds = array();
        if ($umObj->parentUserId) {
            $purchasedProducts = $bpm->getProductsByChildId($this->actor->id);
        } else {
            $purchasedProducts = $bpm->getProductsByUserId($this->actor->id);
        }
        if (count($purchasedProducts)) {
            foreach ($purchasedProducts AS $purchasedProduct) {
                if ($purchasedProduct['needAmount'] - $purchasedProduct['payAmount'] - $purchasedProduct['ulAmount'] + $purchasedProduct['returnedAmount'] - $purchasedProduct['discountAmount'] > 0) {
                    $purchasedProductIds[] = $purchasedProduct['id'];
                    $needProductAmount = $purchasedProduct['needAmount'] - $purchasedProduct['payAmount'] - $purchasedProduct['ulAmount'] + $purchasedProduct['returnedAmount'] - $purchasedProduct['discountAmount'];

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
                            // уменьшим сумму долга
                            // $needProductAmount = $needProductAmount - $booking->payAmount;
                        }
                        $needProductAmount = ($needProductAmount > 0) ? $needProductAmount : 0;
                    }

                    $needAmount = $needAmount + $needProductAmount;
                }
            }
        }

        $paym = new PayManager();
        if (!$needAmount) {
            $paym->markOrderPayed($purchasedTicketIds, $purchasedProductIds, $this->actor->id);
            if ($this->lang == 'en') {
                Enviropment::redirectBack("You've been granted 100% discount", "info");
            } else {
                Enviropment::redirectBack("Вам была предоставлена скидка 100%", "info");
            }
        } else {
            // создаем новую запись в таблице Pay
            $paymObj = new Pay();
            $paymObj->userId = $this->actor->id;
            $paymObj->userCardId = $ucmObj->id;
            $paymObj->needAmount = $needAmount;
            $paymObj->status = Pay::STATUS_NEW;
            $paymObj->type = Pay::TYPE_CARD_RECURRENT;
            $paymObj->tsCreated = time();
            $paymObj->payForTicketIds = serialize($purchasedTicketIds);
            $paymObj->payForProductIds = serialize($purchasedProductIds);
            $paymObj = $paym->save($paymObj);

            $reccurentAccount = Configurator::get("moneta:reccurentAccount");
            $accountId = Configurator::get("moneta:accountId");

            // оплата через merchant API
            $sdkAppFileName = APPLICATION_DIR . "/moneta-sdk-lib/autoload.php";
            include_once($sdkAppFileName);
            $monetaSDK = new \Moneta\MonetaSdk();
            $monetaSDK->checkMonetaServiceConnection();

            $result = $monetaSDK->sdkMonetaPayment($reccurentAccount, $accountId, $needAmount, $paymObj->id . '_' . time(), array('PAYMENTTOKEN' => $ucmObj->paymenttoken), "Оплата ID {$paymObj->id} участия картой #{$ucmObj->id} от {$this->actor->phone}");

            if (!$result || (is_object($result) && isset($result->error) && $result->error)) {
                // автолоадер обратно
                spl_autoload_register(array("Configurator", "autoload"));
                // сохр. в лог
                $infoData = "PayCard user: " . print_r($this->actor, true) . " Pay obj: " . print_r($paymObj, true);
                if ($result) {
                    $infoData .= " MonetaPayment result: " . print_r($result, true);
                }
                Logger::info($infoData);
                $paym->remove($paymObj->id);
                if ($this->lang == 'en') {
                    Enviropment::redirect("basket", "Order payment error", "danger");
                } else {
                    Enviropment::redirect("basket", "Произошла ошибка при оплате заказа", "danger");
                }
            } else {
                // автолоадер обратно
                spl_autoload_register(array("Configurator", "autoload"));
            }
        }
    }
}