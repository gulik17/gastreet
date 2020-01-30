<?php 
/**
*/
class AdminInvoiceDetailsControl extends BaseAdminkaControl {
    public $pageTitle = "Счёт на оплату";
	
    public function render() {
        $id = Request::getInt("payid");
        if (!$id) {
            Adminka::redirectBack("Не указан ID счёта");
        }

        $pm = new PayManager();
        $pmObj = $pm->getById($id);
        if (!$pmObj) {
            Adminka::redirectBack("Не найден счёт");
        }

        $this->addData("pay", $pmObj);

        $bm = new BasketManager();
        $bpm = new BasketProductManager();

        // вынимаем из счёта что по нему хотел оплатить покупатель
        $payForTicketIds = unserialize($pmObj->payForTicketIds);
        if (is_array($payForTicketIds) && count($payForTicketIds)) {
            $baskets = $bm->getByIds($payForTicketIds);
            $this->addData("invoiceBaskets", $baskets);
            if (count($baskets) < count($payForTicketIds)) {
                $this->addData("wrongBasket", true);
            }
        }

        $payForProductIds = unserialize($pmObj->payForProductIds);
        if (is_array($payForProductIds) && count($payForProductIds)) {
            $basketProducts = $bpm->getByIds($payForProductIds);
            $this->addData("invoiceBasketProducts", $basketProducts);
            if (count($basketProducts) < count($payForProductIds)) {
                $this->addData("wrongBasketProducts", true);
            }
        }

        // а теперь корзина инициатора платежа, т.е. $pmObj->userId
        $um = new UserManager();
        $user = $um->getById($pmObj->userId);
        $this->addData("user", $user);

        // реквизиты
        $udm = new UserDetailsManager();
        $details = $udm->getByUserId($user->id);
        $this->addData("details", $details);

        // что в корзине по основному билету
        if ($user->parentUserId) {
            $purchasedTickets = $bm->getTicketsByChildId($user->id);
        } else {
            $purchasedTickets = $bm->getTicketsByUserIdNoChildren($user->id);
        }
        $this->addData("purchasedTickets", $purchasedTickets);

        // что в корзине по мастер-классам
        if ($user->parentUserId) {
            $purchasedProducts = $bpm->getProductsByChildId($user->id);
        } else {
            $purchasedProducts = $bpm->getProductsByUserIdNoChildren($user->id);
        }
        $this->addData("purchasedProducts", $purchasedProducts);

        // статусы
        $this->addData("ticketStatuses", BaseTicket::getStatusDesc());
        $this->addData("productStatuses", Product::getStatusDesc());
        $this->addData("basketStatuses", Basket::getStatusDesc());
        $this->addData("basketProductStatuses", BasketProduct::getStatusDesc());

        $bom = new BookingManager();

        // если он родитель
        if (!$user->parentUserId) {
            // активные бронирования (его самого и его доп. участников)
            $bomList = $bom->getActiveByUserId($user->id);
            // его доп. участники
            $children = $um->getByParentId($user->id);
            if (is_array($children) && count($children)) {
                $childrenArray = array();
                $childrenBalanceArray = array();
                $purchasedChildTicketsArray = array();
                $includedProductsChildArray = array();
                $purchasedChildProductsArray = array();
                foreach ($children AS $child) {
                    $childrenArray[$child->id] = '<h4>' . $child->lastname . ' ' . $child->name . '</h4><div class="phone">' . Utility::mobilephone($child->phone) . '</div>';
                    $childrenBalanceArray[$child->id] = $child->ulBalance;

                    // получить здесь данные по билетам
                    $purchasedChildTickets = $bm->getTicketsByChildId($child->id);
                    // подробности по билетам
                    if (count($purchasedChildTickets)) {
                        $purchasedChildTicketsArray[$child->id] = $purchasedChildTickets;
                        // какие продукты входят в основной билет
                        $includedProductChildIds = array();
                        $ttplm = new TicketToProductLinkManager();
                        foreach ($purchasedChildTickets AS $oneTicket) {
                            $productIdArray = $ttplm->getProductIdsByBaseTicketId($oneTicket['baseTicketId']);
                            if (count($productIdArray)) {
                                $includedProductChildIds = $productIdArray;
                            }
                        }
                        if (count($includedProductChildIds)) {
                            $pm = new ProductManager();
                            $includedProducts = $pm->getByIds($includedProductChildIds, Product::STATUS_ENABLED);
                            $includedProductsChildArray[$child->id] = $includedProducts;
                        }
                    }

                    // и по мастерклассам
                    $purchasedChildProducts = $bpm->getProductsByChildId($child->id);
                    if (count($purchasedChildProducts)) {
                        $purchasedChildProductsArray[$child->id] = $purchasedChildProducts;
                    }

                }

                // участники
                $this->addData("children", $childrenArray);
                // баланс участников
                $this->addData("childrenBalance", $childrenBalanceArray);

                // их билеты и мастер-классы
                $this->addData("purchasedChildTickets", $purchasedChildTicketsArray);
                $this->addData("includedChildProducts", $includedProductsChildArray);
                $this->addData("purchasedChildProducts", $purchasedChildProductsArray);
            }
        } else {
            $bomList = $bom->getActiveByChildId($user->id);
        }

        $this->addData("bomList", $bomList);

        // поставить текущую стартовую дату
        $this->addData("startDay", date('d'));
        $this->addData("startMonth", date('m'));
        $this->addData("startYear", date('Y'));
    }
}