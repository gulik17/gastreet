<?php
/**
 *
 */
class AdminDelUserAction extends AdminkaAction
{
	public function execute()
	{
        $doAct = "Пользователь удален";
		$id        = Request::getInt("id");
        if (!$id) {
            Adminka::redirectBack("Не задан ID пользователя");
        }

        $um = new UserManager();
        $umObj = $um->getById($id);
        if (!$umObj) {
            Adminka::redirectBack("Пользователь не найден");
        }

        // проверить нет ли данного пользователя товаров в корзинах, если есть, то удалить его нельзя
        $bm = new BasketManager();
        $basketUserTickets  = $bm->getTicketsByUserId($id);
        $basketChilfTickets = $bm->getTicketsByChildId($id);

        $bpm = new BasketProductManager();
        $basketUserProducts  = $bpm->getByUserId($id);
        $basketChilfProducts = $bpm->getByChildId($id);

        if ($basketUserTickets || $basketChilfTickets || $basketUserProducts || $basketChilfProducts) {
            Adminka::redirectBack("Нельзя удалить пользователя, т.к. у него есть покупки");
        }

        $um->remove($id);

		Adminka::redirect("manageusers", $doAct);

	}

}