<?php

/**
 * Контрол для  создания/редактирования новости
 */
class EditDiscountControl extends BaseAdminkaControl {

    public $pageTitle = "Редактирование промо-кода на скидку";

    public function render() {
        $getUserId = Request::getInt("userId");
        $this->addData("getUserId", $getUserId);

        $am = new AreaManager();
        $btm = new BaseTicketManager();

        $areaIds = array();
        $baseTicketIds = array();

        $id = Request::getInt("id");
        if (!$id) {
            $this->pageTitle = "Создание промо-кода на скидку";
        } else {
            $dm = new DiscountManager();
            $dmObj = $dm->getById($id);
            if (!$dmObj) {
                Adminka::redirect("managediscounts", "Промо-код на скидку не найден");
            }
            $this->addData("discount", $dmObj);

            // ссылки на area
            $atdlm = new AreaToDiscountLinkManager();
            $areaIds = $atdlm->getAreaIdsByDiscountId($dmObj->id);
            if (is_array($areaIds) && count($areaIds)) {
                $areaList = $am->getByIds($areaIds);
                $areaArray = array();
                foreach ($areaList AS $areaItem) {
                    $areaArray[$areaItem->id] = $areaItem;
                }
                $this->addData("areaArray", $areaArray);
                $this->addData("discountAreasListString", implode(',', $areaIds));
            }
            // ссылки на baseTicket
            $bttdlm = new BaseTicketToDiscountLinkManager();
            $baseTicketIds = $bttdlm->getBaseTicketIdsByDiscountId($dmObj->id);
            if (is_array($baseTicketIds) && count($baseTicketIds)) {
                $baseTicketList = $btm->getByIds($baseTicketIds);
                $baseTicketArray = array();
                foreach ($baseTicketList AS $baseTicketItem) {
                    $baseTicketArray[$baseTicketItem->id] = $baseTicketItem;
                }
                $this->addData("baseTicketArray", $baseTicketArray);
                $this->addData("discountBaseTicketsListString", implode(',', $baseTicketIds));
            }
            // пользователь, к которому прикреплена данная скидка
            if ($dmObj->userId) {
                $um = new UserManager();
                $user = $um->getById($dmObj->userId);
                if ($user) {
                    $this->addData("user", $user);
                }
            }
        }

        // все area
        $this->addData("allAreas", $am->getAllNotIn($areaIds));
        // все baseTicket
        $this->addData("allBaseTickets", $btm->getAllNotIn($baseTicketIds));
        // статусы и типы
        $this->addData("statuses", Discount::getStatusDesc());
        $this->addData("types", Discount::getTypeDesc());
        // все типы пользователей
        $utm = new UserTypeManager();
        $userTypes = $utm->getAll();
        $userTypesArray = array();
        $userTypesArray[0] = "- не устанавливать -";
        if (is_array($userTypes) && count($userTypes)) {
            foreach ($userTypes AS $userType) {
                $userTypesArray[$userType->id] = $userType->name;
            }
        }
        $this->addData("userTypes", $userTypesArray);
    }
}