<?php

/**
 *
 */
class EditCustomBroadcastControl extends BaseAdminkaControl {
    public $pageTitle = "Редактирование рассылки";

    public function render() {
        $id = Request::getInt("id");
        if (!$id) {
            $this->pageTitle = "Создание рассылки";
        } else {
            $cbm = new CustomBroadcastManager();
            $cbmObj = $cbm->getById($id);
            if (!$cbmObj) {
                Adminka::redirect("managecustombroadcast", "Рассылка не найдена");
            } else {
                $this->addData("customBroadcast", $cbmObj);
            }
        }

        $this->addData("statusList", CustomBroadcast::getStatusDesc());
        $this->addData('typeList', CustomBroadcast::getTypeDesc());

        // добавить типы пользователей для выбора
        $utm = new UserTypeManager();
        $userTypes = $utm->getAll();
        $userTypeArray = array();
        if (is_array($userTypes) && count($userTypes)) {
            foreach ($userTypes AS $userTypeItem) {
                $userTypeArray[$userTypeItem->id] = $userTypeItem->name;
            }
        }
        $this->addData("userTypes", $userTypeArray);

        // список билетов
        $ticketsArray = array();
        $btm = new BaseTicketManager();
        $tickets = $btm->getAll();
        if (is_array($tickets) && count($tickets)) {
            foreach ($tickets AS $ticket) {
                $ticketsArray[$ticket->id] = $ticket->name;
            }
            $this->addData("tickets", $ticketsArray);
        }

        // список мастер-классов
        $productsArray = array();
        $pm = new ProductManager();
        $products = $pm->getAll('name');
        if (is_array($products) && count($products)) {
            foreach ($products AS $product) {
                $productsArray[$product->id] = $product->name;
            }
            $this->addData("products", $productsArray);
        }
    }
}