<?php

/**
 *
 */
class BookingControl extends AuthorizedUserControl {
    public $pageTitle = "Забронировать — GASTREET 2020";
    public $pageTitle_en = "Reservation — GASTREET 2020";

    public function render() {
        $ts = time();
        $this->addData("ts", $ts);
        $this->addData("host", $this->host);
        $this->addData("actor", $this->actor);

        $parentObj = null;
        $um = new UserManager();
        if ($this->actor->parentUserId) {
            $parentObj = $um->getById($this->actor->parentUserId);
        }
        $childId = null;
        if ($parentObj) {
            $mainUser = $parentObj;
            $childId = $this->actor->id;
        } else {
            $mainUser = $this->actor;
        }
        // надо собрать список child для бронирований
        $childrenIds = array();
        if (!$parentObj) {
            $childrenList = $um->getByParentId($mainUser->id);
            if (is_array($childrenList) && count($childrenList)) {
                foreach ($childrenList AS $childObj) {
                    $childrenIds[$childObj->id] = $childObj->id;
                }
            }
        }
        // надо на детей или ноль
        $countNeedPersons = count($childrenIds);
        // что уже оплачено
        $childrenReservedIds = array();
        $isSelfPaid = false;
        $bm = new BookingManager();
        $bmActiveList = $bm->getActiveByUserId($mainUser->id);
        if (is_array($bmActiveList) && count($bmActiveList)) {
            foreach ($bmActiveList AS $bmObj) {
                // проверить не оплачено ли за данного child
                if ($parentObj && $bmObj->childId == $childId) {
                    if ($this->lang == 'en') {
                        Enviropment::redirectBack("You already have a paid reservation", "danger");
                    } else {
                        Enviropment::redirectBack("У Вас уже есть оплаченное бронирование", "danger");
                    }
                    break;
                }
                // проверить оплачено ли за себя
                if (!$parentObj && $bmObj->userId == $mainUser->id && !$bmObj->childId) {
                    $isSelfPaid = true;
                }
                if (!$parentObj && $bmObj->childId && in_array($bmObj->childId, $childrenIds)) {
                    $childrenReservedIds[$bmObj->childId] = $bmObj->childId;
                    $countNeedPersons--;
                }
            }
        }
        if ($countNeedPersons < 0) {
            $countNeedPersons = 0;
        }
        // надо оплатить за себя
        if (!$isSelfPaid) {
            $countNeedPersons++;
        }
        if (!$countNeedPersons) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("You already have a paid reservation", "danger");
            } else {
                Enviropment::redirectBack("У Вас уже есть оплаченное бронирование", "danger");
            }
        }

        // данные для шаблона
        $um = new UserManager();
        $children = $um->getByParentId($this->actor->id);
        $this->addData("children", $children);
        $this->addData("countchildren", count($children));

        // срок бронирования
        $daysBron = intval(SettingsManager::getValue('days_bron'));
        $this->addData("daysBron", $daysBron);

        // дата, до которой действует бронь
        $this->addData("daysBronTill", time() + $daysBron * 24 * 60 * 60);

        // стоимость
        $amountBron = intval(SettingsManager::getValue('amount_bron'));
        $this->addData("amountBron", $amountBron);

        // сохраненные карты пользователя
        $ucm = new UserCardManager();
        $ucmObjs = $ucm->getByUserId($this->actor->id);
        $this->addData("ucmObjs", $ucmObjs);
    }
}