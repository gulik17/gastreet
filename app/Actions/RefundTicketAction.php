<?php

/**
 *
 */
class RefundTicketAction extends AuthorizedUserAction implements IPublicAction {

    public function execute() {
        // проверить заполнен ли профайл пользователя
        UserManager::redirectIfNoProfile($this->actor);

        $id = Request::getInt("id");
        if (!$id) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("No item selected!", "danger");
            } else {
                Enviropment::redirectBack("Не выбран товар!", "danger");
            }
        }

        $bm = new BasketManager();
        $bmObj = $bm->getById($id);
        if (!$bmObj) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("No item selected!", "danger");
            } else {
                Enviropment::redirectBack("Не выбран товар!", "danger");
            }
        }

        if ($bmObj->userId == $this->actor->id && $bmObj->status == Basket::STATUS_PAID) {
            $rrm = new RefundRequestManager();
            $rrmObj = new RefundRequest();
            $rrmObj->userId = $this->actor->id;
            if ($bmObj->payId) {
                $rrmObj->payId = $bmObj->payId;
            }
            $rrmObj->basketId = $bmObj->id;
            $rrmObj->requestAmount = $bmObj->payAmount + $bmObj->ulAmount - $bmObj->returnedAmount;
            $rrmObj->needAmount = $bmObj->needAmount;
            $rrmObj->status = RefundRequest::STATUS_NEW;
            $rrmObj->tsCreated = time();
            $rrmObj = $rrm->save($rrmObj);

            if ($this->lang == 'en') {
                Enviropment::redirectBack("Refund query made", "success");
            } else {
                Enviropment::redirectBack("Требование на возврат было выставлено", "success");
            }
        } else {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("Failed to request refund for this item", "danger");
            } else {
                Enviropment::redirectBack("Не удалось затребовать возврат по данному товару", "danger");
            }
        }
    }

}
