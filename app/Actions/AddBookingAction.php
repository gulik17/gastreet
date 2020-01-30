<?php
/**
 *
 */
class AddBookingAction extends AuthorizedUserAction implements IPublicAction {
    public function execute() {
        // оплата сохраненной картой
        $cardId = Request::getInt("cardId");
        $mode  = Request::getVar('mode');

        $ucmObj = null;
        if ($cardId) {
            $ucm = new UserCardManager();
            $ucmObj = $ucm->getById($cardId);
        }
        // проверить заполнен ли профайл пользователя
        UserManager::redirectIfNoProfile($this->actor);
        $agree = Request::getVar("agree");
        if (!$agree) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("Please agree with the terms and conditions", "danger");
            } else {
                Enviropment::redirectBack("Необходимо согласие с условиями", "danger");
            }
        }

        if (!Configurator::get("rfi:rfi_enable")) {
            Enviropment::redirectBack("Оплата отключена, обратитесь в администрацию сайта", "danger");
            exit;
        }

        $parentObj = null;
        $um = new UserManager();
        if ($this->actor->parentUserId) {
            $parentObj = $um->getById($this->actor->parentUserId);
        }
        $childId = null;
        if ($parentObj) {
            $mainUser = $parentObj;
            $childId = $this->actor->id;
        } else {
            $mainUser = $this->actor;
        }
        // надо собрать список child для бронирований
        $childrenIds = array();
        // у кого уже оплачены основные билеты? по ним не надо выставлять бронирование
        $basketman = new BasketManager();
        if (!$parentObj) {
            $childrenList = $um->getByParentId($mainUser->id);
            
            if (is_array($childrenList) && count($childrenList)) {
                foreach ($childrenList AS $childObj) {
                    $purchasedBaskets = $basketman->getPaidTicketsByChildId($childObj->id);
                    if ( (!$purchasedBaskets) && ($childObj->baseTicketId != null) ) {
                        $childrenIds[$childObj->id] = $childObj->id;
                    }
                }
            }
        }

        // надо на детей или ноль
        $countNeedPersons = count($childrenIds);

        // активные оплаченные бронирования
        $childrenReservedIds = array();
        $isSelfPaid = false;
        $bm = new BookingManager();
        $bmActiveList = $bm->getActiveByUserId($mainUser->id);
        if (is_array($bmActiveList) && count($bmActiveList)) {
            foreach ($bmActiveList AS $bmObj) {
                // проверить не оплачено ли за данного child
                if ($parentObj && $bmObj->childId == $childId) {
                    if ($this->lang == 'en') {
                        Enviropment::redirectBack("You already have paid reservation", "danger");
                    } else {
                        Enviropment::redirectBack("У Вас уже есть оплаченное бронирование", "danger");
                    }
                    break;
                }
                // проверить оплачено ли за себя
                if (!$parentObj && $bmObj->userId == $mainUser->id && !$bmObj->childId) {
                    $isSelfPaid = true;
                }
                if (!$parentObj && $bmObj->childId && in_array($bmObj->childId, $childrenIds)) {
                    $childrenReservedIds[$bmObj->childId] = $bmObj->childId;
                    $countNeedPersons--;
                }
            }
        }
        if ($countNeedPersons < 0) {
            $countNeedPersons = 0;
        }
        // есть за что платить, составим массив
        $payReadyArray = array();
        // надо оплатить за себя
        if (!$isSelfPaid) {
            $purchasedBaskets = $basketman->getPaidTicketsByUserId($mainUser->id);
            if (!$purchasedBaskets) {
                $payReadyArray[] = array("userId" => $mainUser->id, "childId" => null);
                $countNeedPersons++;
            }
        }
        if (!$countNeedPersons) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("You already have paid reservation", "danger");
            } else {
                Enviropment::redirectBack("У Вас уже есть оплаченное бронирование", "danger");
            }
        }
        if (is_array($childrenIds) && count($childrenIds)) {
            foreach ($childrenIds AS $childId) {
                if (!in_array($childId, $childrenReservedIds)) {
                    $payReadyArray[] = array("userId" => $mainUser->id, "childId" => $childId);
                }
            }
        }

        if (is_array($payReadyArray) && count($payReadyArray)) {
            $amount = $countNeedPersons * intval(SettingsManager::getValue('amount_bron'));
            if ($amount == 0) {
                if ($this->lang == 'en') {
                    Enviropment::redirectBack("There are paid tickets in your basket", "danger");
                } else {
                    Enviropment::redirectBack("В корзине уже есть оплаченные билеты", "danger");
                }
            } else {
                // добавим объекты booking
                $bookingIds = array();
                foreach ($payReadyArray AS $payReadyItem) {
                    $bmObj = new Booking();
                    $bmObj->userId = $payReadyItem['userId'];
                    if ($payReadyItem['childId']) {
                        $bmObj->childId = $payReadyItem['childId'];
                    }
                    $bmObj->tsCreate = time();
                    $bmObj->status = Booking::STATUS_NEW;
                    $bmObj = $bm->save($bmObj);
                    $bookingIds[$bmObj->id] = $bmObj->id;
                }
                // добавим paybooking
                $pbm = new PayBookingManager();
                $pbmObj = new PayBooking();
                $pbmObj->userId = $mainUser->id;
                if ($cardId) {
                    $pbmObj->userCardId = $cardId;
                }
                $pbmObj->tsCreated = time();
                $pbmObj->needAmount = $amount;
                $pbmObj->status = PayBooking::STATUS_NEW;
                $pbmObj->payForBookingIds = @serialize($bookingIds);
                $pbmObj = $pbm->save($pbmObj);
                
                $descText = ($this->lang == 'en') ? "Payment for reservation" : "Оплата бронирования";

                if ($mode != "alfa") {
                    include_once APPLICATION_DIR . "/alba-client/alba.php";
                    $service_id = Configurator::get("rfi:key");
                    $key = Configurator::get("rfi:key");
                    $service = new AlbaService($service_id, Configurator::get("rfi:secretKey"));
                    try {
                        $result = $service->showPaymentForm(
                            'spg',
                            $amount,
                            $descText . " №" . $pbmObj->id . ' - ' . $this->actor->phone,
                            $pbmObj->id . '_' . time(),
                            ($this->actor->confirmedEmail) ? $this->actor->confirmedEmail : $this->actor->email,
                            $this->actor->phone,
                            $pbmObj->id . '_B', // _U - пополнение нутреннего баланса. _B оплата брони. _P - оплата
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
                        $pbmObj->id . '_B', // _U - пополнение внутреннего баланса. _B оплата брони. _P - оплата
                        $amount*100,
                        $descText . " №" . $pbmObj->id . ' - ' . $this->actor->phone,
                        $data
                    );

                    if (array_key_exists('ErrorCode', $result)) {
                        echo "<b>Error code:</b> {$result['ErrorCode']}<br><b>Error description:</b> {$result['errorMessage']}<br>";
                    } else {
                        $pbmObj->monetaOperationId = $result['orderId'];
                        $pbmObj = $pbm->save($pbmObj);
                        Request::redirect($result['formUrl']);
                    }

                    exit;
                }

                Enviropment::redirect("basket");    // сюда не должно перейти, это "страховочный" редирект.
            }
        } else {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("You already have paid reservation", "danger");
            } else {
                Enviropment::redirectBack("Уже есть оплаченное бронирование", "danger");
            }
        }
    }
}