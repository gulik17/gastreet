<?php
/**
 *
 */
class RefundPayAction extends AdminkaAction
{
	public function execute()
	{
        $id = Request::getVar("id");
        $paytype = Request::getVar("paytype");
        $amount = Request::getVar("amount");

        if (!$id || !$paytype || !$amount) {
            Adminka::redirect("managerefunds", "Не указаны исходные данные для возврата");
        }

        $rrm = new RefundRequestManager();
        $rrmObj = $rrm->getById($id);
        if (!$rrmObj) {
            Adminka::redirect("managerefunds", "Требование не найдено");
        }

        // оптата была сделана с р/с юр.лица
        if ($paytype == Pay::TYPE_INVOICE) {
            // формальный возврат офф-лайн через платежное поручние
            $rrmObj->returnedAmount = $amount;
            $rrmObj->tsUpdated = time();
            $rrmObj->status = RefundRequest::STATUS_PAID;
            $rrmObj = $rrm->save($rrmObj);

            // корзина билеты
            if ($rrmObj->basketId) {
                $bm = new BasketManager();
                $bmObj = $bm->getById($rrmObj->basketId);
                if ($bmObj) {
                    $bmObj->returnedAmount = $bmObj->returnedAmount + $amount + $bmObj->discountAmount;
                    $bmObj->status = Basket::STATUS_NEW;
                    $bmObj->payAmount = ($bmObj->payAmount + $bmObj->discountAmount > 0) ? ($bmObj->payAmount + $bmObj->discountAmount) : 0;
                    $bmObj->discountAmount = 0;
                    $bmObj = $bm->save($bmObj);
                }
            }

            // корзина товары
            if ($rrmObj->basketProductId) {
                $bpm = new BasketProductManager();
                $bpmObj = $bpm->getById($rrmObj->basketProductId);
                if ($bpmObj) {
                    $bpmObj->returnedAmount = $bpmObj->returnedAmount + $amount + $bpmObj->discountAmount;
                    $bpmObj->status = BasketProduct::STATUS_NEW;
                    $bpmObj->payAmount = ($bpmObj->payAmount + $bpmObj->discountAmount > 0) ? ($bpmObj->payAmount + $bpmObj->discountAmount) : 0;
                    $bpmObj->discountAmount = 0;
                    $bpmObj = $bpm->save($bpmObj);
                }
            }

            UserManager::createQrCode($rrmObj->userId);

            Adminka::redirect("managerefunds", "Сделана отметка о возврате на р/с юр.лица по его требованию");
        }

        // возврат через монету (refund)
        if ($paytype == Pay::TYPE_CARD || $paytype == Pay::TYPE_CARD_RECURRENT) {
            // поднимем оплату с operationId
            $paym = new PayManager();
            $paymObj = $paym->getById($rrmObj->payId);
            $monetaOperationId = $paymObj->monetaOperationId;

            // делаем refund операции $monetaOperationId на сумму $amount
            $sdkAppFileName = APPLICATION_DIR . "/moneta-sdk-lib/autoload.php";
            include_once($sdkAppFileName);
            $monetaSDK = new \Moneta\MonetaSdk();
            $monetaSDK->checkMonetaServiceConnection();

            $refundRequest = new \Moneta\Types\RefundRequest();
            $refundRequest->transactionId = $monetaOperationId;
            $refundRequest->amount = $amount;
            $refundRequest->clientTransaction = "R-{$id}";
            $refundRequest->description = "Возврат по требованию R-{$id} оплаты ID: {$rrmObj->payId}";
            $result = $monetaSDK->monetaService->Refund($refundRequest);

            // всё сделано, восстановим автолоадер
            spl_autoload_register(array("Configurator", "autoload"));

            Logger::info("RefundPay:");
            Logger::info($result);

            UserManager::createQrCode($rrmObj->userId);

            // TODO: поменять статус в корзине, поменять статус требования
            // если не было ошибок
            /*
                14-03-2017 13:23:56 [0.823] INFO: array (
                  'Envelope' =>
                  array (
                    'Body' =>
                    array (
                      'fault' =>
                      array (
                        'detail' =>
                        array (
                          'faultDetail' => '500.3.1.1',
                        ),
                        'faultcode' => 'Client',
                        'faultstring' => 'Неверный платежный пароль',
                      ),
                    ),
                  ),
                )
             */


            Adminka::redirect("managerefunds", "Сделан возврат денег по требованию");
        }

        Adminka::redirect("managerefunds", "Действие не было выполнено");

    }

}