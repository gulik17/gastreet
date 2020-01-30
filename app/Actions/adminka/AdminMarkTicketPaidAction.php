<?php
/**
 *
 */
class AdminMarkTicketPaidAction extends AdminkaAction
{
	public function execute()
	{
		$basketId = Request::getInt("basketId");
        if (!$basketId) {
            Adminka::redirect("manageinvoices", "Не указан ID позиции");
        }

        $bm = new BasketManager();
        $bmObj = $bm->getById($basketId);
        if (!$bmObj) {
            Adminka::redirect("manageinvoices", "Позиция не найдена");
        }

        if ($bmObj->status == Basket::STATUS_PAID) {
            Adminka::redirectBack("Позиция уже была оплачена");
        }

        $bmObj->status = Basket::STATUS_PAID;
        $bmObj->tsPay = time();
        $bmObj->payAmount = ($bmObj->needAmount - $bmObj->discountAmount > 0) ? ($bmObj->needAmount - $bmObj->discountAmount) : 0;
        $bmObj->ulAmount = 0;
        $bmObj->returnedAmount = 0;
        $bmObj = $bm->save($bmObj);

        // сгенерить QR код
        if ($bmObj->childId) {
            UserManager::createQrCode($bmObj->childId);
        }
        else {
            UserManager::createQrCode($bmObj->userId);
        }

        Adminka::redirectBack("Позиция отмечена оплаченной");

	}

}