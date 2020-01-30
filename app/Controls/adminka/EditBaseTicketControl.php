<?php

/**
 *
 */
class EditBaseTicketControl extends BaseAdminkaControl {

    public $pageTitle = "Редактирование билета";

    public function render() {
        $ticketId = Request::getInt("id");
        if (!$ticketId) {
            $this->pageTitle = "Создание билета";
        } else {
            $btm = new BaseTicketManager();
            $btmObj = $btm->getById($ticketId);
            if (!$btmObj) {
                Adminka::redirect("managebasetickets", "Билет не найден");
            } else {
                $this->addData("ticket", $btmObj);
                // распарсить даты, передать в шаблон по частям
                $eventTsStart = $btmObj->eventTsStart;
                $this->addData("startDay", ($eventTsStart) ? date("d", $eventTsStart) : null);
                $this->addData("startMonth", ($eventTsStart) ? date("m", $eventTsStart) : null);
                $this->addData("startYear", ($eventTsStart) ? date("Y", $eventTsStart) : null);
                $this->addData("startHours", ($eventTsStart) ? date("H", $eventTsStart) : null);
                $this->addData("startMinutes", ($eventTsStart) ? date("i", $eventTsStart) : null);
                $eventTsFinish = $btmObj->eventTsFinish;
                $this->addData("finishDay", ($eventTsFinish) ? date("d", $eventTsFinish) : null);
                $this->addData("finishMonth", ($eventTsFinish) ? date("m", $eventTsFinish) : null);
                $this->addData("finishYear", ($eventTsFinish) ? date("Y", $eventTsFinish) : null);
                $this->addData("finishHours", ($eventTsFinish) ? date("H", $eventTsFinish) : null);
                $this->addData("finishMinutes", ($eventTsFinish) ? date("i", $eventTsFinish) : null);
            }
            // какие продукты входят в состав билета
            $tplm = new TicketToProductLinkManager();
            $ticketProductIds = $tplm->getProductIdsByBaseTicketId($btmObj->id);
            $pm = new ProductManager();
            if (is_array($ticketProductIds) && count($ticketProductIds)) {
                $ticketProductsList = $pm->getByIds($ticketProductIds);
                $this->addData("ticketProductsList", $ticketProductsList);
                $this->addData("ticketProductsListString", implode(',', $ticketProductIds));
            }
            // что ещё можно выбрать
            $allProductsList = $pm->getAll("eventTsStart");
            if ($allProductsList) {
            $leftProductsList = array();
            if (!count($ticketProductIds)) {
                $leftProductsList = $allProductsList;
            } else {
                foreach ($allProductsList AS $productKey => $productVal) {
                    if (!in_array($productVal->id, $ticketProductIds)) {
                        $leftProductsList[$productKey] = $productVal;
                    }
                }
            }
            $this->addData("leftProductsList", $leftProductsList);
            }
        }
        $sm = new SpeakerManager();
        $smList = $sm->getAll();
        if (is_array($smList) && count($smList)) {
            $smArray = array();
            foreach ($smList AS $smItem) {
                $smArray[$smItem->id] = $smItem->name . ' ' . $smItem->secondName;
            }
            $this->addData("smArray", $smArray);
        }
        $this->addData("statusList", BaseTicket::getStatusDesc());
    }

}
