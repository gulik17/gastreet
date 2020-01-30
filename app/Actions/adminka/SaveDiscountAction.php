<?php

/**
 */
class SaveDiscountAction extends AdminkaAction {
    public function execute() {
        $id = FilterInput::add(new IntFilter("id", false, "ID"));
        $userId = FilterInput::add(new IntFilter("userId", false, "ID пользователя"));
        $code = FilterInput::add(new StringFilter("code", true, "Промо-код"));
        $percent = FilterInput::add(new FloatFilter("percent", true, "Процент скидки"));
        $type = FilterInput::add(new StringFilter("type", true, "Тип"));
        $status = FilterInput::add(new StringFilter("status", true, "Статус"));
        $userTypeId = FilterInput::add(new IntFilter("userTypeId", false, "Тип пользователя"));

        // сколько сделать повторов
        $repeate = FilterInput::add(new IntFilter("repeate", false, "Повторов"));

        $areaIdsStr = Request::getVar("areaIds");
        $baseTicketIdsStr = Request::getVar("baseTicketIds");

        if (!FilterInput::isValid()) {
            $this->goBack(FilterInput::getMessages());
        }
        if ($percent < 1 || $percent > 100) {
            $this->goBack("Не верно указан процент скидки");
        }
        $um = new UserManager();
        if ($userId) {
            $umObj = $um->getById($userId);
            if (!$umObj) {
                $this->goBack("Не найден пользователь с заданным ID");
            }
        }

        $dm = new DiscountManager();
        $discount = $dm->getByCode($code);
        if ($discount && $id && $discount->id != $id) {
            $this->goBack("Не уникальный промо-код");
        }

        $doAct = "Изменен ";
        if ($id) {
            $discount = $dm->getById($id);
            if (!$discount) {
                Adminka::redirect("managediscounts", "Промо-код не найден");
            }
        }

        if ($repeate > 1) {
            $j = $repeate;
        } else {
            $j = 1;
        }
        
        $msgCode = '';

        for ($i = 1; $i <= $j; $i++) {
            if (!$id) {
                $discount = new Discount();
                $doAct = "Добавлен ";
            }
            $useCode = $code;
            if ($repeate > 1) {
                $useCode .= '_' . rand(1000, 9999);
                $msgCode .= $useCode.'<br>';
            }
            $discount->code = $useCode;
            $discount->percent = $percent;
            if ($userId) {
                $discount->userId = $userId;
            }
            $discount->type = $type;
            $discount->status = $status;
            $discount->userTypeId = $userTypeId;

            // записать
            $discount = $dm->save($discount);

            // link areas to the discount
            $areaIds = array();
            $areaIdsDraft = explode(',', $areaIdsStr);
            if (is_array($areaIdsDraft) && count($areaIdsDraft)) {
                foreach ($areaIdsDraft AS $areaId) {
                    if ($areaId) {
                        $areaIds[] = $areaId;
                    }
                }
            }
            // unlink areas from all discount
            $aplm = new AreaToDiscountLinkManager();
            $aplm->removeLinksForDiscount($discount->id);
            if (count($areaIds)) {
                $aplm->bulkInsertForDiscount($discount->id, $areaIds);
            }

            // link baseTickets to the discount
            $baseTicketIds = array();
            $baseTicketIdsDraft = explode(',', $baseTicketIdsStr);
            if (is_array($baseTicketIdsDraft) && count($baseTicketIdsDraft)) {
                foreach ($baseTicketIdsDraft AS $baseTicketId) {
                    if ($baseTicketId) {
                        $baseTicketIds[] = $baseTicketId;
                    }
                }
            }
            // unlink baseTickets from all discount
            $bttdlm = new BaseTicketToDiscountLinkManager();
            $bttdlm->removeLinksForDiscount($discount->id);
            if (count($baseTicketIds)) {
                $bttdlm->bulkInsertForDiscount($discount->id, $baseTicketIds);
            }
        }

        Adminka::redirect("managediscounts", "$doAct промо-код на скидку<br> $msgCode");
    }

    private function goBack($message = '') {
        FormRestore::add("form");
        Adminka::redirectBack($message);
    }

}
