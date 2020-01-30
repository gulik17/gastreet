<?php

/**
 *
 */
class DeRefundProductAction extends AuthorizedUserAction implements IPublicAction {

    public function execute() {
        // проверить заполнен ли профайл пользователя
        UserManager::redirectIfNoProfile($this->actor);

        $id = Request::getInt("id");
        if (!$id) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("No item selected!");
            } else {
                Enviropment::redirectBack("Не выбран товар!");
            }
        }

        $bpm = new BasketProductManager();
        $bpmObj = $bpm->getById($id);
        if (!$bpmObj) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("No item selected!");
            } else {
                Enviropment::redirectBack("Не выбран товар!");
            }
        }

        if ($bpmObj->userId == $this->actor->id && $bpmObj->status == BasketProduct::STATUS_PAID) {
            $rrm = new RefundRequestManager();
            $rrmObj = $rrm->getOneByUserIdAndBasketProductId($this->actor->id, $id);
            if (!$rrmObj) {
                if ($this->lang == 'en') {
                    Enviropment::redirectBack("No query for refund was made");
                } else {
                    Enviropment::redirectBack("Не было запроса на возврат");
                }
            }
            if ($rrmObj->status != RefundRequest::STATUS_NEW) {
                if ($this->lang == 'en') {
                    Enviropment::redirectBack("Refund is being processed, it cannot be cancelled");
                } else {
                    Enviropment::redirectBack("Возврат обрабатывается, его уже нельзя отозвать");
                }
            }

            $rrm->remove($rrmObj->id);

            if ($this->lang == 'en') {
                Enviropment::redirectBack("Refund query cancelled");
            } else {
                Enviropment::redirectBack("Требование на возврат было отозвано");
            }
        } else {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("Failed to cancel refund for this item");
            } else {
                Enviropment::redirectBack("Не удалось отозвать возврат по данному товару");
            }
        }
    }
}