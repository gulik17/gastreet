<?php

/**
 *
 */
class RefundProductAction extends AuthorizedUserAction implements IPublicAction {

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

        $bpm = new BasketProductManager();
        $bpmObj = $bpm->getById($id);
        if (!$bpmObj) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("No item selected!", "danger");
            } else {
                Enviropment::redirectBack("Не выбран товар!", "danger");
            }
        }

        if ($bpmObj->userId == $this->actor->id && $bpmObj->status == BasketProduct::STATUS_PAID) {

            $rrm = new RefundRequestManager();
            $rrmObj = new RefundRequest();
            $rrmObj->userId = $this->actor->id;
            if ($bpmObj->payId) {
                $rrmObj->payId = $bpmObj->payId;
            }
            $rrmObj->basketProductId = $bpmObj->id;
            $rrmObj->requestAmount = $bpmObj->payAmount + $bpmObj->ulAmount - $bpmObj->returnedAmount;
            $rrmObj->needAmount = $bpmObj->needAmount;
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