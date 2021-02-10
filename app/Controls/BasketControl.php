<?php
/**
 * Контроллер корзины
 */
class BasketControl extends AuthorizedUserControl {
    public $pageTitle    = "Корзина — GASTREET 2021";
    public $pageTitle_en = "Basket — GASTREET 2021";

    public function render() {
        UserManager::redirectIfNoProfile($this->actor);

        require_once (APPLICATION_DIR.'/../../applepay_includes/apple_pay_conf.php');

        $this->addData("DEBUG", DEBUG);
        $this->addData("PRODUCTION_MERCHANTIDENTIFIER", PRODUCTION_MERCHANTIDENTIFIER);
        $this->addData("PRODUCTION_CURRENCYCODE", PRODUCTION_CURRENCYCODE);
        $this->addData("PRODUCTION_COUNTRYCODE", PRODUCTION_COUNTRYCODE);
        $this->addData("PRODUCTION_DISPLAYNAME", PRODUCTION_DISPLAYNAME);

        //deb($this);

        $this->addData("position", $this->position);

        $this->addData("userSize", User::getUserSize());

        // Выводим сформированные ранее списки стран
        $this->addData("country", $this->country);
        $this->addData("city", $this->city);

        if (($step = Request::getInt('q')) && ($step >= 1)) {
            $this->template = "Basket{$step}Control.html";
        }

        $daysBron = floatval(SettingsManager::getValue('days_bron'));
        $this->addData("daysBron", $daysBron);

        //$offPayBtn = false;
        $ts = time();
        $this->addData("ts", $ts);
        $this->addData("host", $this->host);
        $this->addData("actor", $this->actor);
        // проверить в списке oldusers
        // вывести приветствие если был
        $isItOldUser = UserManager::isItOldUser($this->actor);
        $this->addData("isItOldUser", $isItOldUser);
        // что в корзине по основному билету
        $bm = new BasketManager();
        if ($this->actor->parentUserId) {
            $purchasedTickets = $bm->getTicketsByChildId($this->actor->id);
        } else {
            $purchasedTickets = $bm->getTicketsByUserIdNoChildren($this->actor->id);
        }

        // Проверяем шефский билет, и если он есть в корзине и оплачен
        $olimpicBtn = 'not_show'; // Непоказывать кнопку «На Олимпиаду»
        // Проверим не под допом ли это зашли
        $child = Context::getObject("__child");
        if ($child) {
           //deb($this->actor);
           if ( ($child->baseTicketId == 2) || ($child->baseTicketId == 6) ) {
               $purchasedTickets = $bm->getTicketsByChildId($child->id);
                if ($purchasedTickets[0]['status'] == Basket::STATUS_PAID) {
                    $olimpicBtn = 'show'; // Показывать кнопку «На Олимпиаду»
                    // Проверим сколько участников уже приняли участие в Олимпиаде
                    $com = new ChefOlimpicManager();
                    $comActive = $com->getActive();
                    if (count($comActive) >= 30 ) {
                        $olimpicBtn = 'no_seats'; // Показывать кнопку «Мест нет! Подать заявку на всякий случай»
                    }
                    $comActor = $com->getByUserId($child->id);
                    if (count($comActor) > 0 ) {
                        $olimpicBtn = 'registered'; // Показывать кнопку «Зарегистрированы»
                    }
                }
            }
        } else {
            if ( ($this->actor->baseTicketId == 2) || ($this->actor->baseTicketId == 6) ) {
                //deb($purchasedTickets[0]['tsPay']);
                if ($purchasedTickets[0]['status'] == Basket::STATUS_PAID) {
                    $olimpicBtn = 'show'; // Показывать кнопку «На Олимпиаду»
                    // Проверим сколько участников уже приняли участие в Олимпиаде
                    $com = new ChefOlimpicManager();
                    $comActive = $com->getActive();
                    if (count($comActive) >= 30 ) {
                        $olimpicBtn = 'no_seats'; // Показывать кнопку «Мест нет! Подать заявку на всякий случай»
                    }
                    $comActor = $com->getByUserId($this->actor->id);
                    if (count($comActor) > 0 ) {
                        $olimpicBtn = 'registered'; // Показывать кнопку «Зарегистрированы»
                    }
                }
            }
        }
        //$this->addData("olimpicBtn", $olimpicBtn);
        // подробности по билетам
        if (count($purchasedTickets)) {
            $this->addData("purchasedTickets", $purchasedTickets);
            //deb($purchasedTickets);
            // какие продукты входят в основной билет
            $includedProductIds = array();
            $ttplm = new TicketToProductLinkManager();
            foreach ($purchasedTickets AS $oneTicket) {
                $productIdArray = $ttplm->getProductIdsByBaseTicketId($oneTicket['baseTicketId']);
                if (count($productIdArray)) {
                    $includedProductIds = $productIdArray;
                }
            }
            if (count($includedProductIds)) {
                $pm = new ProductManager();
                $includedProducts = $pm->getByIds($includedProductIds, Product::STATUS_ENABLED);
                $this->addData("includedProducts", $includedProducts);
            }
        }

        // что в корзине по мастер-классам
        $bpm = new BasketProductManager();
        if ($this->actor->parentUserId) {
            $purchasedProducts = $bpm->getProductsByChildId($this->actor->id);
        } else {
            $purchasedProducts = $bpm->getProductsByUserIdNoChildren($this->actor->id);
        }
        if (count($purchasedProducts)) {
            $this->addData("purchasedProducts", $purchasedProducts);
        }
        
        //deb($purchasedProducts);
        // Статусы
        $this->addData("ticketStatuses", BaseTicket::getStatusDesc(null,$this->lang));
        $this->addData("productStatuses", Product::getStatusDesc(null,$this->lang));
        $this->addData("basketStatuses", Basket::getStatusDesc(null,$this->lang));
        $this->addData("basketProductStatuses", BasketProduct::getStatusDesc(null,$this->lang));
        // требования на возврат + разбор по id basket и basketProduct
        $rrm = new RefundRequestManager();
        $rrmList = $rrm->getByUserId($this->actor->id);
        if (is_array($rrmList) && count($rrmList)) {
            $refundBasketIds = array();
            $refundBasketProductIds = array();
            foreach ($rrmList AS $refund) {
                if ($refund->basketId) {
                    $refundBasketIds[$refund->basketId] = $refund->status;
                }
                if ($refund->basketProductId) {
                    $refundBasketProductIds[$refund->basketProductId] = $refund->status;
                }
            }
            $this->addData("refundBasketIds", $refundBasketIds);
            $this->addData("refundBasketProductIds", $refundBasketProductIds);
        }
        // подопечные пользователи текущего юзера
        $um = new UserManager();
        $children = $um->getByParentId($this->actor->id);
        if (is_array($children) && count($children)) {
            $childrenArray = array();
            $childrenBalanceArray = array();
            $purchasedChildTicketsArray = array();
            $includedProductsChildArray = array();
            $purchasedChildProductsArray = array();

            foreach ($children AS $key => $child) {
                $childrenArray[$child->id] = '<h4>'.$child->lastname.' '.$child->name.'</h4><div class="phone">'.Utility::mobilephone($child->phone).'</div>';
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
                        
                        $children[$key]->baseTicketName = $oneTicket['baseTicketName'];
                        $children[$key]->baseTicketStatus = $oneTicket['status'];
                        $children[$key]->baseTicketDiscount = $oneTicket['discountId'];
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
            
            $this->addData("children", $children);
            $this->addData("childrenArray", $childrenArray);
            // баланс участников
            $this->addData("childrenBalance", $childrenBalanceArray);
            // их билеты и мастер-классы
            
            $this->addData("purchasedChildTickets", $purchasedChildTicketsArray);
            $this->addData("includedChildProducts", $includedProductsChildArray);
            $this->addData("purchasedChildProducts", $purchasedChildProductsArray);
        }
        // что забронировано
        $parentObj = null;
        if ($this->actor->parentUserId) {
            $parentObj = $um->getById($this->actor->parentUserId);
        }
        $childId = null;
        if ($parentObj) {
            $mainUser = $parentObj;
            $childId = $this->actor->id;
        } else {
            $mainUser = $this->actor;
        }
        $allBookedUserIds = array();
        $bm = new BookingManager();
        $bmList = $bm->getActiveByUserId($mainUser->id);
        if (is_array($bmList) && count($bmList)) {
            foreach ($bmList AS $bmItem) {
                $allBookedUserIds[$bmItem->userId . '_' . $bmItem->childId] = $bmItem->tsFinish;
            }
        }
        if (is_array($allBookedUserIds) && count($allBookedUserIds)) {
            $this->addData("allBookedUserIds", $allBookedUserIds);
        }

        $user = $um->getById($this->actor->id);
        
        //deb($purchasedTickets);
        if ( is_array($purchasedTickets) ) {
            $user->baseTicketName = $purchasedTickets[0]['baseTicketName'];
            $user->baseTicketStatus = $purchasedTickets[0]['status'];
            $user->baseTicketDiscount = $purchasedTickets[0]['discountId'];
        }

        if ($user->tsBorn) {
            $user->tsBorn = date("d-m-Y", $user->tsBorn);
        }

        $this->addData("user", $user);
        
        if (!$user->parentUserId) {
            // активные бронирования (его самого и его доп. участников)
            $bmList = $bm->getActiveByUserId($user->id);
        } else {
            $bmList = $bm->getActiveByChildId($user->id);
        }
        $bookingAmoount = 0;
        if (is_array($bmList) && count($bmList)) {
            foreach ($bmList AS $bmItem) {
                $bookingAmoount = $bookingAmoount + $bmItem->payAmount;
            }
        }
        $this->addData("bookingAmoount", $bookingAmoount);
        //$this->addData("offPayBtn", $offPayBtn);
        // если зашли под master паролем
        $masterPassword = Context::getObject("__master");
        if ($masterPassword == SettingsManager::getValue("master")) {
            $this->addData("showRefundButtons", true);
        }
        
        $udm = new UserDetailsManager();
        $udmObj = $udm->getByUserId($this->actor->id);
        $this->addData("udmObj", $udmObj);

        $qrm = new UserQrCodeManager();
        $qrmObj = $qrm->getOneActiveByUserId($this->actor->id);
        $this->addData("qrmObj", $qrmObj);

        // QR коды подопечных
        // id подопечных
        $childrenIds = array();
        $um = new UserManager();
        $children = $um->getByParentId($this->actor->id);
        if (is_array($children) && count($children)) {
            foreach ($children AS $child) {
                $childrenIds[$child->id] = $child->id;
            }
        }

        $qrcm = new UserQrCodeManager();
        $qrList = $qrcm->getByUserIds($childrenIds);
        if (is_array($qrList) && count($qrList)) {
            $qrListArray = array();
            foreach ($qrList AS $oneQr) {
                $qrListArray[$oneQr->userId] = $oneQr->code;
            }
            $this->addData("qrList", $qrListArray);
        }

        if ($step == 4) {
            $this->includedJS .= Enviropment::loadScript('/js/pages/catalog.js', 'js');
        }

        // спикеры
        $speakersArray = array();
        $spm = new SpeakerManager();
        $speakers = $spm->getActive();
        if (is_array($speakers) && count($speakers)) {
            foreach ($speakers AS $speaker) {
                $speakersArray[$speaker['id']] = $speaker;
            }
        }
        $this->addData("speakers", $speakersArray);
        $this->addData("ts", time());

        $udm = new UserDetailsManager();
        $udmObj = $udm->getByUserId($this->actor->id);
        $this->addData("udmObj", $udmObj);

        // продукты
        $pm = new ProductManager();
        $products = $pm->getAllActive();
        $this->addData("products", $products);
        
        $com = new ChefOlimpicManager();
        $comItem = $com->getByUserId($this->actor->id);
        if ($comItem) {
            $comItem = $comItem[0]->status;
        }
        $this->addData("comItem", $comItem);

        $this->includedJS .= Enviropment::loadScript('/js/pages/register.js', 'js');
        $this->includedJS .= Enviropment::loadScript('/js/pages/basket.js', 'js');
        $this->includedJS .= Enviropment::loadScript('/js/pages/basket_ga1.js', 'js');
    }
}