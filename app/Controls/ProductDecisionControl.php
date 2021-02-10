<?php

/**
 */
class ProductDecisionControl extends AuthorizedUserControl {
    public $pageTitle = "Покупка — GASTREET 2021";

    public function render() {
        $ts = time();
        $this->addData("ts", $ts);
        $this->addData("host", $this->host);
        $this->addData("actor", $this->actor);

        $productId = Request::getInt("product");
        if (!$productId) {
            Enviropment::redirectBack("Не выбран товар!");
        }

        $pm = new ProductManager();
        $productObj = $pm->getById($productId);
        if (!$productObj) {
            Enviropment::redirectBack("Не найден товар!");
        }

        $this->addData("productObj", $productObj);

        // поднять уже купленные продукты в статусе Активен
/*        $bpm = new BasketProductManager();
        $userBasketProducts = $bpm->getByUserId($this->actor->id);

        $userIsReadyToGo = true;
        $userProductIds = array();
        if (is_array($userBasketProducts) && count($userBasketProducts)) {
            foreach ($userBasketProducts AS $userBasketProduct) {
                $userProductIds[] = $userBasketProduct->productId;
            }
        }

        $userProducts = null;
        if (is_array($userProductIds) && count($userProductIds)) {
            $userProducts = $pm->getByIds($userProductIds);
        }

        if (is_array($userProducts) && count($userProducts)) {
            foreach ($userProducts AS $userProduct) {
                if (( ($userProduct->eventTsStart - $productObj->eventTsFinish)*($productObj->eventTsStart - $userProduct->eventTsFinish)>0 ) && $userProduct->id != $productId) {
                    $userIsReadyToGo = false;
                }
            }
        }
        if (!$userIsReadyToGo) {
            $message = Context::getError();
            if (!$message) {
                $message = "У Вас уже есть запланированное событие на то же самое время";
            }
            Context::setError($message);
        } else {
            Enviropment::redirect("catalog", "Выберите товар из каталога");
        }
*/
        // типы билетов (основные билеты)
        $btm = new BaseTicketManager();
        $baseTickets = $btm->getAllActive();
        if (is_array($baseTickets) && count($baseTickets)) {
            $baseTicketsArray = array();
            foreach ($baseTickets AS $baseTicket) {
                $baseTicketsArray[$baseTicket->id] = $baseTicket->name;
            }
            $this->addData("tickets", $baseTicketsArray);
        }

        // подопечные пользователи
        $um = new UserManager();
        $children = $um->getByParentId($this->actor->id);
        if (is_array($children) && count($children)) {
            $childrenArray = array();
            $childrenBaseTicketArray = array();
            foreach ($children AS $child) {
                $childrenArray[$child->id] = $child->phone . ' ' . $child->lastname . ' ' . $child->name;
                $childrenBaseTicketArray[$child->id] = $child->baseTicketId;
            }
            $this->addData("children", $childrenArray);
            $this->addData("childrenbaseticket", $childrenBaseTicketArray);
        }
    }
}