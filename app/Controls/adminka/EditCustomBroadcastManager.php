<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 15.02.17
 * Time: 12:36
 */
class EditCustomBroadcastManager extends BaseAdminkaControl
{
	public $pageTitle = "Редактирование рассылки";

	public function render()
	{
		$id = Request::getInt("id");
		if ($id === 0) {
			$this->pageTitle = "Создание рассылки";
		}
		else
		{
			$cbm = new CustomBroadcastManager();
			$cbmObj = $cbm->getById($id);
			if (!$cbmObj) {
				Adminka::redirect("managecustombroadcast", "Рассылка не найдена");
			}
			else
			{
				$this->addData("custombroadcast", $cbmObj);
			}
		}

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