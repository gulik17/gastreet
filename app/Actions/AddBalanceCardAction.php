<?php

/**
 *
 */
class AddBalanceCardAction extends AuthorizedUserAction implements IPublicAction {
    public function execute() {
        
        if (!Configurator::get("rfi:rfi_enable")) {
            Enviropment::redirectBack("Оплата отключена, обратитесь в администрацию сайта", "danger");
            exit;
        }
        
        if ($this->lang == 'en') {
            Enviropment::redirectBack("This function is disabled", "danger");
        } else {
            Enviropment::redirectBack("Эта функция отключена", "danger");
        }
        exit;
        // сколько покупатель видел в корзине
        $amount = floatval(Request::getVar('amount'));
        $cardId = Request::getInt('cardId');
        if (!$cardId) {
            header("Location: /index.php?show=addbalance&mode=paynewcard&isAlive=1&amount={$amount}");
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

        // создаем новую запись в таблице Pay
        $payb = new PayBalanceManager();
        $paybObj = new PayBalance();
        $paybObj->userId = $this->actor->id;
        $paybObj->needAmount = $amount;
        $paybObj->status = Pay::STATUS_NEW;
        $paybObj->tsCreated = time();
        $paybObj = $payb->save($paybObj);

        // отправим платить за paybooking
        include_once APPLICATION_DIR . "/alba-client/alba.php";

        if ($this->lang == 'en') {
            $service_id = Configurator::get("rfi:service_id_en");
            $key = Configurator::get("rfi:key_en");
        } else {
            $service_id = Configurator::get("rfi:key");
            $key = Configurator::get("rfi:key");
        }

        $descText = ($this->lang == 'en') ? "Top-up of balance" : "Пополнение баланса";

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
        exit;

        // автолоадер обратно
        spl_autoload_register(array("Configurator", "autoload"));

        if (!$result || $result->error) {
            $infoData = "AddBalance user: " . print_r($this->actor, true) . " PayBalance obj: " . print_r($paybObj, true);
            if ($result) {
                $infoData .= " Payment result: " . print_r($result, true);
            }
            Logger::info($infoData);
            $payb->remove($paybObj->id);
            if ($this->lang == 'en') {
                Enviropment::redirect("basket", "Balance top-up error", "danger");
            } else {
                Enviropment::redirect("basket", "Произошла ошибка при пополнении баланса", "danger");
            }
        }
    }
}