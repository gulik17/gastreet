<?php
/**
 *
 */
class ReportFewProductsControl extends BaseAdminkaControl
{
	public function render()
	{
		$isalive = Request::getInt("isalive");
		$quantity = Request::getInt("quantity");

		// если не заполнили основные поля формы
		// 1 - выключен, 2 - включен
		if (!$quantity)
			$basicfilter = 1;
		else
			$basicfilter = 2;

		if ($isalive == 1) {
            FormRestore::add("fewproducts-filter");
        }

        if ($quantity) {
            // что касается билетов - выводим всегда
            $btm = new BaseTicketManager();
            $btmList = $btm->getFewTickets($quantity);
            $this->addData("btmList", $btmList);
            $this->addData("btmStatuses", BaseTicket::getStatusDesc());
            // products
            $pm = new ProductManager();
            $pmList = $pm->getFewProducts($quantity);
            $this->addData("pmList", $pmList);
            $this->addData("pmStatuses", Product::getStatusDesc());
        }

	}

}
