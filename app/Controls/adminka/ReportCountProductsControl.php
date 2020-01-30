<?php

/**
 *
 */
class ReportCountProductsControl extends BaseAdminkaControl {
    public function render() {
        // что касается билетов - выводим всегда
        $btm = new BaseTicketManager();
        $btmList = $btm->getAll();
        $this->addData("btmList", $btmList);
        $this->addData("btmStatuses", BaseTicket::getStatusDesc());
        // products
        $pm = new ProductManager();
        $pmList = $pm->getAll();
        $this->addData("pmList", $pmList);
        $this->addData("pmStatuses", Product::getStatusDesc());
    }
}