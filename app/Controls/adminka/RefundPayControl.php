<?php 
/**
*
*/
class RefundPayControl extends BaseAdminkaControl
{
	public $pageTitle = "Выплата";
	
	public function render()
	{
        $id = Request::getInt("id");
        if (!$id) {
            Adminka::redirect("managerefunds", "Требование не найдено");
        }
        // id требования
        $this->addData("id", $id);

        $rrm = new RefundRequestManager();
        $rrmObj = $rrm->getById($id);
        if (!$rrmObj) {
            Adminka::redirect("managerefunds", "Требование не найдено");
        }
        if ($rrmObj->status != RefundRequest::STATUS_NEW || !$rrmObj->payId) {
            Adminka::redirect("managerefunds", "Статус требования не позволяет сделать выплату");
        }
        // требование на возврат
        $this->addData("rrmObj", $rrmObj);
        $this->addData("rrmTypes", RefundRequest::getTypeDesc());

        // за что делается возврат
        if ($rrmObj->basketId) {
            $bm = new BasketManager();
            $bmObj = $bm->getById($rrmObj->basketId);
            // основной билет в корзине пользователя
            $this->addData("bmObj", $bmObj);
            $this->addData("bmStatuses", Basket::getStatusDesc());
        }

        if ($rrmObj->basketProductId) {
            $bpm = new BasketProductManager();
            $bpmObj = $bpm->getById($rrmObj->basketProductId);
            // мастер-классы в корзине пользователя
            $this->addData("bpmObj", $bpmObj);
            $this->addData("bpmStatuses", BasketProduct::getStatusDesc());
        }

        $this->addData("pmStatuses", Product::getStatusDesc());

        // ищем pay (оплату) определяем источник оплаты и была ли операция в монете
        $paym = new PayManager();
        $paymObj = $paym->getById($rrmObj->payId);
        // совершённая оплата
        $this->addData("paymObj", $paymObj);
        // статусы оплаты
        $this->addData("paymStatuses", Pay::getStatusDesc());
        // типы оплаты
        $this->addData("paymTypes", Pay::getTypeDesc());

        // пользователь
        $um = new UserManager();
        $this->addData("user", $um->getById($this->actor->id));
        $this->addData("userStatuses", User::getStatusDesc());

        // поднимаем реквизиты
        $udm = new UserDetailsManager();
        $udmObj = $udm->getByUserId($this->actor->id);
        $this->addData("udmObj", $udmObj);

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