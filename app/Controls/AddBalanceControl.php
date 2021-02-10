<?php

/**
 *
 */
class AddBalanceControl extends AuthorizedUserControl {
    public $pageTitle    = "Пополнить баланс — GASTREET 2021";
    public $pageTitle_en = "Add Balance — GASTREET 2021";
    public $lang = "ru";
    public $jivoSite = 0;
    public $ticketsCount = 0;

    public function render() {
        $ts = time();
        $this->addData("ts", $ts);
        $this->addData("host", $this->host);
        $this->addData("actor", $this->actor);

        if (!Configurator::get("rfi:rfi_enable")) {
            Enviropment::redirectBack("Оплата отключена, обратитесь в администрацию сайта", "danger");
            exit;
        }

        $isAlive = Request::getInt('isAlive');
        $amount = Request::getInt('amount');
        $mode = Request::getVar('mode');

        if ($isAlive) {
            if ($amount < 10) {
                if ($this->lang == 'en') {
                    Enviropment::redirectBack("The refill amount should be from 10 rubles", "danger");
                } else {
                    Enviropment::redirectBack("Сумма пополнения должна быть от 10 руб", "danger");
                }
            } else {
                // сумма ОК, формируем форму оплаты
                // есть ли у человека сохраненные карты, то пусть выбирает
                $ucm = new UserCardManager();
                $ucmObj = $ucm->getByUserId($this->actor->id);
                if ($ucmObj && $mode != 'paynewcard') {
                    // переход на выбор карты оплаты
                    Enviropment::redirect("balancecardselect&amount={$amount}");
                }

                // создаем новую запись в таблице Pay
                $payb = new PayBalanceManager();
                $paybObj = new PayBalance();
                $paybObj->userId = $this->actor->id;
                $paybObj->needAmount = $amount;
                $paybObj->status = Pay::STATUS_NEW;
                $paybObj->tsCreated = time();
                $paybObj = $payb->save($paybObj);

                $descText = ($this->lang == 'en') ? "Deposit of balance" : "Пополнение баланса";
                if ($mode != "alfa") {
                    include_once APPLICATION_DIR . "/alba-client/alba.php";

                    if ($this->lang == 'en') {
                        $service_id = Configurator::get("rfi:service_id_en");
                        $key = Configurator::get("rfi:key_en");
                    } else {
                        $service_id = Configurator::get("rfi:key");
                        $key = Configurator::get("rfi:key");
                    }


                    $service = new AlbaService($service_id, Configurator::get("rfi:secretKey"));
                    try {
                        $result = $service->showPaymentForm(
                            'spg',
                            $amount,
                            $descText . " №" . $paybObj->id . ' - ' . $this->actor->phone,
                            $paybObj->id . '_' . time(),
                            ($this->actor->confirmedEmail) ? $this->actor->confirmedEmail : $this->actor->email,
                            $this->actor->phone,
                            $paybObj->id . '_U', // _U - пополнение нутреннего баланса. _B оплата брони. _P - оплата 
                            $key
                        );
                    } catch (AlbaException $e) {
                        echo $e->getMessage();
                    }
                    echo $result;
                } else {
                    include_once APPLICATION_DIR . "/alfa-client/alfa.class.php";
                    $service = new AlfaService();
                    $data = [
                        'email' => ($this->actor->confirmedEmail) ? $this->actor->confirmedEmail : $this->actor->email,
                        'phone' => $this->actor->phone,
                    ];

                    $result = $service->getPaymentData(
                        $paybObj->id . '_U', // _U - пополнение внутреннего баланса. _B оплата брони. _P - оплата
                        $amount*100,
                        $descText . " №" . $paybObj->id . ' - ' . $this->actor->phone,
                        $data
                    );

                    if (array_key_exists('ErrorCode', $result)) {
                        echo "<b>Error code:</b> {$result['ErrorCode']}<br><b>Error description:</b> {$result['errorMessage']}<br>";
                    } else {
                        $paybObj->monetaOperationId = $result['orderId'];
                        $paybObj = $payb->save($paybObj);
                        Request::redirect($result['formUrl']);
                    }
                }

                exit;
            }
        }
    }
}