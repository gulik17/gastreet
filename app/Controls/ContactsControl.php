<?php

/**
 *
 */
class ContactsControl extends IndexControl {
    public $pageTitle = "Контакты — GASTREET 2021";
    public $pageTitle_en = "Contacts — GASTREET 2021";

    public function render() {
        $this->controlName = "Контакты";
        $this->layout = "contacts.html";
        $cm = new ContactManager();
        $cmList = $cm->getAll();
        $cType = Contact::getTypeDesc(null, $this->lang);
        $this->addData("cType", $cType);
        $this->addData("cmList", $cmList);
        $this->includedJS .= Enviropment::loadScript('/js/pages/contacts.js', 'js');

        $this->addData("browser", $this->browser);

        $bm = new BasketManager();
        $removeBasketTicketsList = $bm->getOldBaskets(6);
    }
}