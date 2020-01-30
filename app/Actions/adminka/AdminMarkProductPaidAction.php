<?php
/**
 *
 */
class AdminMarkProductPaidAction extends AdminkaAction
{
	public function execute()
	{
		$basketProductId = Request::getInt("basketProductId");
        if (!$basketProductId) {
            Adminka::redirect("manageinvoices", "Не указан ID позиции");
        }

        $bpm = new BasketProductManager();
        $bpmObj = $bpm->getById($basketProductId);
        if (!$bpmObj) {
            Adminka::redirect("manageinvoices", "Позиция не найдена");
        }

        if ($bpmObj->status == BasketProduct::STATUS_PAID) {
            Adminka::redirectBack("Позиция уже была оплачена");
        }

        $bpmObj->status = Basket::STATUS_PAID;
        $bpmObj->tsPay = time();
        $bpmObj->payAmount = ($bpmObj->needAmount - $bpmObj->discountAmount > 0) ? ($bpmObj->needAmount - $bpmObj->discountAmount) : 0;
        $bpmObj->ulAmount = 0;
        $bpmObj->returnedAmount = 0;
        $bpmObj = $bpm->save($bpmObj);

        // сгенерить QR код
        if ($bpmObj->childId) {
            UserManager::createQrCode($bpmObj->childId);
        }
        else {
            UserManager::createQrCode($bpmObj->userId);
        }

        Adminka::redirectBack("Позиция отмечена оплаченной");

	}

}