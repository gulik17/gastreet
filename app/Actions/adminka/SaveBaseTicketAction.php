<?php

/**
 *
 */
class SaveBaseTicketAction extends AdminkaAction {

    public function execute() {
        $doAct = "Билет добавлен";

        $id = Request::getInt("id");
        $status = Request::getVar("status");
        $name = Request::getVar("name");
        $name_en = Request::getVar("name_en");
        $price = Request::getVar("price");
        $maxCount = Request::getInt("maxCount");
        $plan = Request::getInt("plan");

        $startDay = Request::getInt("startDay");
        $startMonth = Request::getInt("startMonth");
        $startYear = Request::getInt("startYear");
        $startHours = Request::getInt("startHours");
        $startMinutes = Request::getInt("startMinutes");

        $finishDay = Request::getInt("finishDay");
        $finishMonth = Request::getInt("finishMonth");
        $finishYear = Request::getInt("finishYear");
        $finishHours = Request::getInt("finishHours");
        $finishMinutes = Request::getInt("finishMinutes");

        $productIdsStr = Request::getVar("productIds");

        $annotation = Request::getVar("annotation");
        //$description = Request::getVar("description");

        $price = floatval(str_replace(',', '.', $price));

        $eventTsStart = null;
        if ($startDay && $startMonth && $startYear) {
            $eventTsStart = strtotime($startMonth . '/' . $startDay . '/' . $startYear . ' ' . $startHours . ':' . $startMinutes . ':00');
        }

        $eventTsFinish = null;
        if ($finishDay && $finishMonth && $finishYear) {
            $eventTsFinish = strtotime($finishMonth . '/' . $finishDay . '/' . $finishYear . ' ' . $finishHours . ':' . $finishMinutes . ':00');
        }

        $btm = new BaseTicketManager();
        $btmObj = null;
        if ($id) {
            $btmObj = $btm->getById($id);
        }
        if (!$btmObj) {
            $btmObj = new BaseTicket();
        } else {
            $doAct = "Билет отредактирован";
        }

        if ($btmObj->price && $price != $btmObj->oldPrice && $price != $btmObj->price) {
            $btmObj->oldPrice = $btmObj->price;
        }

        $btmObj->status = $status;
        $btmObj->name = $name;
        $btmObj->name_en = $name_en;
        $btmObj->price = $price;
        $btmObj->maxCount = $maxCount;
        $btmObj->plan = $plan;
        $btmObj->annotation = $annotation;
        //$btmObj->description = $description;
        $btmObj->eventTsStart = $eventTsStart;
        $btmObj->eventTsFinish = $eventTsFinish;

        $btmObj = $btm->save($btmObj);

        // link products to the ticket
        $productIds = array();
        $productIdsDraft = explode(',', $productIdsStr);
        if (is_array($productIdsDraft) && count($productIdsDraft)) {
            foreach ($productIdsDraft AS $productId) {
                if ($productId) {
                    $productIds[] = $productId;
                }
            }
        }

        // unlink ticket from all products
        $tplm = new TicketToProductLinkManager();
        $tplm->removeLinksForTicket($btmObj->id);
        if (count($productIds)) {
            $tplm->bulkInsertForTicket($btmObj->id, $productIds);
        }
        Adminka::redirect("managebasetickets", $doAct);
    }
}
