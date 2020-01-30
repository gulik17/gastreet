<?php
/**
 *
 */
class PaymentAction extends AuthorizedUserAction implements IPublicAction {
    public function execute() {
        // сколько покупатель видел в корзине
        $total = floatval(Request::getVar('total'));
        $mode  = Request::getVar('mode');
        // по пользователю
        $um    = new UserManager();
        $umObj = $um->getById($this->actor->id);
        // сколько по рассчетам
        $needAmount = 0;
         // проверить заполнен ли профайл пользователя
        UserManager::redirectIfNoProfile($this->actor);
        
        if (!Configurator::get("rfi:rfi_enable")) {
            Enviropment::redirectBack("Оплата отключена, обратитесь в администрацию сайта", "danger");
            exit;
        }
        
        // надо найти сумму по действующему бронированию
        // на эту сумму надо уменьшить стоимость, включить данное число в скидку
        // уменьшать надо после скидки
        $bookbman = new BookingManager();
        // что в корзине по основному билету
        $bm = new BasketManager();
        $purchasedTicketIds = array();
        $purchasedTickets = ($umObj->parentUserId) ? $bm->getTicketsByChildId($this->actor->id) : $bm->getTicketsByUserId($this->actor->id);
        // далее покупка
        if (count($purchasedTickets)) {
            foreach ($purchasedTickets AS $purchasedTicket) {
                if ($purchasedTicket['needAmount'] - $purchasedTicket['payAmount'] - $purchasedTicket['ulAmount'] + $purchasedTicket['returnedAmount'] - $purchasedTicket['discountAmount'] > 0) {
                    $purchasedTicketIds[] = $purchasedTicket['id'];
                    $needTicketAmount = $purchasedTicket['needAmount'] - $purchasedTicket['payAmount'] - $purchasedTicket['ulAmount'] + $purchasedTicket['returnedAmount'] - $purchasedTicket['discountAmount'];
                    // если было бронирование
                    $basket = $bm->getById($purchasedTicket['id']);
                    if ($basket) {
                        $bookings = ($basket->childId) ? $bookbman->getActiveByChildId($basket->childId) : $bookbman->getActiveByUserIdNoChildren($basket->userId);
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
        $purchasedProducts = ($umObj->parentUserId) ? $bpm->getProductsByChildId($this->actor->id) : $bpm->getProductsByUserId($this->actor->id);
        if (count($purchasedProducts)) {
            foreach ($purchasedProducts AS $purchasedProduct) {
                if ($purchasedProduct['needAmount'] - $purchasedProduct['payAmount'] - $purchasedProduct['ulAmount'] + $purchasedProduct['returnedAmount'] - $purchasedProduct['discountAmount'] > 0) {
                    $purchasedProductIds[] = $purchasedProduct['id'];
                    $needProductAmount = $purchasedProduct['needAmount'] - $purchasedProduct['payAmount'] - $purchasedProduct['ulAmount'] + $purchasedProduct['returnedAmount'] - $purchasedProduct['discountAmount'];

                    $basketProduct = $bpm->getById($purchasedProduct['id']);
                    if ($basketProduct) {
                        // если было бронирование
                        $bookings = ($basketProduct->childId) ? $bookbman->getActiveByChildId($basketProduct->childId) : $bookbman->getActiveByUserIdNoChildren($basketProduct->userId);
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

        //deb($needAmount);
        //if ( ($umObj->ulBalance !== 0) && ($needAmount >= $umObj->ulBalance) ) {
         //   $needAmount = $needAmount - $umObj->ulBalance;
        //}

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
            $paymObj->needAmount = $needAmount;
            $paymObj->status = Pay::STATUS_NEW;
            $paymObj->type = Pay::TYPE_CARD;
            $paymObj->tsCreated = time();
            $paymObj->payForTicketIds = serialize($purchasedTicketIds);
            $paymObj->payForProductIds = serialize($purchasedProductIds);
            $paymObj = $paym->save($paymObj);

            $descText = ($this->lang == 'en') ? "Order payment" : "Оплата заказа";

            if ($mode != "alfa") {
                include_once APPLICATION_DIR . "/alba-client/alba.php";
                $service_id = Configurator::get("rfi:key");
                $key = Configurator::get("rfi:key");
                $service = new AlbaService($service_id, Configurator::get("rfi:secretKey"));
                try {
                    $result = $service->showPaymentForm(
                        'spg',
                        $needAmount,
                        $descText . " №" . $paymObj->id . ' - ' . $this->actor->phone,
                        $paymObj->id . '_' . time(),
                        ($this->actor->confirmedEmail) ? $this->actor->confirmedEmail : $this->actor->email,
                        $this->actor->phone,
                        $paymObj->id . '_P', // _U - пополнение внутреннего баланса. _B оплата брони. _P - оплата 
                        $key
                    );
                } catch (AlbaException $e) {
                    echo $e->getMessage();
                }
                echo $result;
                exit;
            } else {
                include_once APPLICATION_DIR . "/alfa-client/alfa.class.php";
                $service = new AlfaService();
                $data = [
                    'email' => ($this->actor->confirmedEmail) ? $this->actor->confirmedEmail : $this->actor->email,
                    'phone' => $this->actor->phone,
                ];

                $result = $service->getPaymentData(
                    $paymObj->id . '_P', // _U - пополнение внутреннего баланса. _B оплата брони. _P - оплата
                    $needAmount*100,
                    $descText . " №" . $paymObj->id . ' - ' . $this->actor->phone,
                    $data
                );

                if (array_key_exists('ErrorCode', $result)) {
                    echo "<b>Error code:</b> {$result['ErrorCode']}<br><b>Error description:</b> {$result['errorMessage']}<br>";
                } else {
                    $paymObj->monetaOperationId = $result['orderId'];
                    $paymObj = $paym->save($paymObj);
                    Request::redirect($result['formUrl']);
                }

                exit;
            }
            // автолоадер обратно
            spl_autoload_register(["Configurator", "autoload"]);
        }
    }
}