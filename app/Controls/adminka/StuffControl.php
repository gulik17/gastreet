<?php 
/**
*/
class StuffControl extends BaseAdminkaControl
{
	public $pageTitle = "Работа с членом команды";
	
	public function render()
	{
		$userId = Request::getInt("id");
		if (!$userId) {
            Adminka::redirect("managestuff", "Не указан ID члена команды");
        }
		
		$um = new UserManager();
		$user = $um->getById($userId);
		if (!$user) {
            Adminka::redirect("managestuff", "Член команды не найден");
        }
        if ($user->type != User::TYPE_STAFF) {
            Adminka::redirect("managestuff", "Пользователь не является членом команды");
        }

		$this->addData("user", $user);
        $this->addData("userStatuses", User::getStatusDesc());

        // qr код
        $qrm = new UserQrCodeManager();
        $qrmObj = $qrm->getOneActiveByUserId($userId);
        if ($qrmObj) {
            $this->addData("qrmObj", $qrmObj);
        }

        // купоны на скидку
        $dm = new DiscountManager();
        $dmList = $dm->getByUserId($userId);
        $this->addData("dmList", $dmList);
        // места проведения (для отображения скидок)
        $am = new AreaManager();
        $amList = $am->getAll();
        if (is_array($amList) && count($amList)) {
            $amArray = array();
            foreach ($amList AS $amItem) {
                $amArray[$amItem->id] = $amItem;
            }
            $this->addData("amArray", $amArray);
        }
        // статусы и типы скидок
        $this->addData("discountStatuses", Discount::getStatusDesc());
        $this->addData("discountTypes", Discount::getTypeDesc());

        // оплаченные покупки
        $bm = new BasketManager();
        $bpm = new BasketProductManager();

        // определим пару userId, childId
        $userId = $user->id;
        $childId = null;
        if ($user->parentUserId) {
            $userId  = $user->parentUserId;
            $childId = $user->id;
        }

        if (!$childId) {
            $tickets  = $bm->getPaidTicketsByUserIdNoChildren($userId);
            $products = $bpm->getPaidProductsByUserIdNoChildren($userId);
        }
        else {
            $tickets  = $bm->getPaidTicketsByChildId($childId);
            $products = $bpm->getPaidProductsByChildId($userId);
        }

        $this->addData("tickets", $tickets);
        $this->addData("products", $products);

        // основные билеты
        $btm = new BaseTicketManager();
        $ticketsList = $btm->getAllActive();
        $this->addData("ticketsList", $ticketsList);

        // мастер-классы
        $pm = new ProductManager();
        $productList = $pm->getAllActive();
        $this->addData("productsList", $productList);

        // типы пользователей
        $utm = new UserTypeManager();
        $utmList = $utm->getAll();
        if (is_array($utmList) && count($utmList)) {
            $userTypes = array();
            foreach ($utmList AS $utmItem) {
                $userTypes[$utmItem->id] = $utmItem->name;
            }
            $this->addData("userTypes", $userTypes);
        }

	}

}
