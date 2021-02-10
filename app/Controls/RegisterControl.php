<?php

/**
 * Контрол для визуального представления формы для
 * регистрации участника
 */
class RegisterControl extends AuthorizedUserControl {
    public $pageTitle = "Регистрация участника — GASTREET 2021";

    public function render() {
        parent::preRender();

        if (($step = Request::getInt('step')) && ($step > 1)) {
            $this->template = "Register{$step}Control.html";
        }

        require_once (APPLICATION_DIR.'/../../applepay_includes/apple_pay_conf.php');

        $this->addData("DEBUG", DEBUG);
        $this->addData("PRODUCTION_MERCHANTIDENTIFIER", PRODUCTION_MERCHANTIDENTIFIER);
        $this->addData("PRODUCTION_CURRENCYCODE", PRODUCTION_CURRENCYCODE);
        $this->addData("PRODUCTION_COUNTRYCODE", PRODUCTION_COUNTRYCODE);
        $this->addData("PRODUCTION_DISPLAYNAME", PRODUCTION_DISPLAYNAME);
        
        $isItOldUser = UserManager::isItOldUser($this->actor);
        $this->addData("isItOldUser", $isItOldUser);

        $um = new UserManager();
        $sql = "SELECT * FROM `oldusers` WHERE `phone` LIKE '{$this->actor->phone}%'";
        $oldUser = $um->getByAnySQL($sql);
        $this->addData("oldUser", $oldUser[0]);

        if ($step == 4) {
            $this->includedJS .= Enviropment::loadScript('/js/pages/catalog.js', 'js');
        }
        
        if ($step == 3) {
            //Enviropment::redirect("/register?step=4");
            $this->controlName = "Аватар";
            $touch = Request::getInt('touch');
            $this->addData("touch", $touch);

            $this->includedJS .= Enviropment::loadScript('/js/jquery.form.js', 'js');
            $this->includedJS .= Enviropment::loadScript('/js/cropper.js', 'js');
            $this->includedJS .= Enviropment::loadScript('/app/avatar/js/share.js', 'js');

            if ($touch) {
                //$this->template = "AvatarMobileControl.html";
                $this->includedJS .= Enviropment::loadScript('/app/avatar/js/mainmobile.js', 'js');
            } else {
                $this->includedJS .= Enviropment::loadScript('/app/avatar/js/main.js', 'js');
            }
        }

        $daysBron = floatval(SettingsManager::getValue('days_bron'));

        $this->addData("daysBron", $daysBron);

        $parentObj = null;
        $um = new UserManager();
        if ($this->actor && $this->actor->parentUserId) {
            $parentObj = $um->getById($this->actor->parentUserId);
        }
        //ИП 12 //ЮЛ 10
        // авторизован ли под участником
        $user = null;
        $child = Context::getObject("__child");
        if ($child) {
            $user = $child;
            $this->addData("child", $child);
        } else if ($parentObj) {
            $child = $this->actor;
            $user = $child;
            $this->addData("child", $child);
        } else if ($this->actor) {
            $user = $this->actor;
        }

        // Выводим сформированные ранее списки стран
        $this->addData("country", $this->country);
        $this->addData("city", $this->city);
        
        $this->addData("position", $this->position);
        $this->addData("userSize", User::getUserSize());

        $user = $um->getById($user->id);

        if ($user->tsBorn) {
            $user->tsBorn = date("d-m-Y", $user->tsBorn);
        }

        $this->addData("wantRebro", $user->wantRebro);
        $this->addData("user", $user);
        
        $bm = new BasketManager();
        $children = $um->getByParentId($this->actor->id);
        if (is_array($children) && count($children)) {
            // участники
            $this->addData("children", $children);
            
            foreach ($children as &$child) {
                $purchasedChildTickets[$child->id] = $bm->getTicketsByChildId($child->id);
            }

            if (count($purchasedChildTickets)) {
                //deb($purchasedChildTickets);
                $this->addData("purchasedChildTickets", $purchasedChildTickets);
            }
        }

        $purchasedTickets = $bm->getTicketsByUserIdNoChildren($this->actor->id);
        if (count($purchasedTickets)) {
            $this->addData("purchasedTickets", $purchasedTickets);
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

        if ( ($step > 1) && (!$this->actor->email) ) {
            Enviropment::redirect("register", "Профиль не заполнен, вы не можете перейти к следующему шагу");
        }
        if ( ($step > 2) && (!$this->actor->baseTicketId) ) {
            Enviropment::redirect("register?step=2", "Не выбран основной билет, вы не можете перейти к следующему шагу");
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

        $this->includedJS .= Enviropment::loadScript('/js/pages/register.js', 'js');
    }
}