<?php
/**
*
*/
class SchedulePartnerControl extends IndexControl {
    public $pageTitle = "Партнерская программа — GASTREET 2020";
    public $pageTitle_en = "Partner Schedule — GASTREET 2020";

    public function render() {
        //Enviropment::redirect("/");
        $this->controlName = "SchedulePartner";
        $this->layout = 'indexgastop.html';
        $useAjax = Request::getVar("useAjax");
        
        if ($useAjax) {
            $this->addData("useAjax", $useAjax);
        }
        $this->addData("useAjax", 0);
        $this->addData("ts", time());
        $parentObj = null;
        $um = new UserManager();
        if ($this->actor && $this->actor->parentUserId) {
            $parentObj = $um->getById($this->actor->parentUserId);
        }
        // показывать только те МК, у которых showInSchedule = 1
        $onlyAllowed = false;
        $areaId = 0;
        $this->template = 'SchedulePartnerControl.html';
        $onlyAllowed = true;

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
        // проверить в списке oldusers
        // вывести приветствие если был
        if ($user) {
            $isItOldUser = UserManager::isItOldUser($user);
            if ($isItOldUser) {
                $this->addData("isItOldUser", true);
            }
            // проверим если данный пользователь свежий (только недавно зарегался (в течении часа))
            if (!$user->parentUserId && (!$user->tsOnline || $user->tsOnline - $user->tsRegister < 60 * 60)) {
                $this->addData("isFreshUser", 1);
                if ($user->tsOnline) {
                    $user->tsRegister = $user->tsOnline - 60 * 60;
                    $user = $um->save($user);
                } else {
                    $user->tsOnline = time();
                    $user = $um->save($user);
                }
            }
        }

        // товар для замены
        $productId = Request::getInt("productId");
        $this->addData("productId", $productId);
        // билеты
        $btm = new BaseTicketManager();
        $tickets = $btm->getAllActive();
        //deb($tickets);
        $this->addData("tickets", $tickets);
        // программы (площадки)
        $areasArray = array();
        $am = new AreaManager();
        $areas = $am->getActive();
        if (is_array($areas) && count($areas)) {
            foreach ($areas as $area) {
                $areasArray[$area->id] = $area;
            }
        }
        $this->addData("areas", $areasArray);
        
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
        
        $areasBusiness = $am->getActiveByType(1);
        if (is_array($areasBusiness) && count($areasBusiness)) {
            foreach ($areasBusiness as $area) {
                $areasBusinessArray[$area->id] = $area;
            }
        }
        $this->addData("areasBusiness", $areasBusinessArray);

        // продукты
        $pm = new ProductManager();
        $products = $pm->getAllActive($areaId, $onlyAllowed);
        $this->addData("products", $products);
        // places
        $plmArray = array();
        $plm = new PlaceManager();
        $plmList = $plm->getAll();
        if (is_array($plmList) && count($plmList)) {
            foreach ($plmList AS $plmItem) {
                $plmArray[$plmItem->id] = $plmItem->name;
            }
            $this->addData("plmArray", $plmArray);
        }
        // что в корзине по основному билету
        $disableAllBecauseNoBaseTicket = false;
        $bm = new BasketManager();
        $userTickets = null;
        if ($user) {
            $userTickets = ($child) ? $bm->getTicketsByChildId($child->id) : $bm->getTicketsByUserIdNoChildren($user->id) ;
            if (!count($userTickets)) {
                $disableAllBecauseNoBaseTicket = true;
            } else {
                $this->addData("userBasketTickets", $userTickets);
            }
            $this->addData("wantRebro", $user->wantRebro);
        } else {
            $disableAllBecauseNoBaseTicket = true;
        }
        $this->addData("disableAllBecauseNoBaseTicket", $disableAllBecauseNoBaseTicket);
        $includedProductIds = array();
        if (count($userTickets)) {
            $ttplm = new TicketToProductLinkManager();
            $productIdArray = $ttplm->getProductIdsByBaseTicketId($user->baseTicketId);
            if (count($productIdArray)) {
                $includedProductIds = $productIdArray;
            }
        }
        // что в корзине по мастер-классам
        // если есть, что тоже надо убирать кнопку "Купить"
        $bpm = new BasketProductManager();
        if ($user) {
            $purchasedProducts = ($child) ? $bpm->getProductsByChildId($child->id) : $bpm->getProductsByUserIdNoChildren($user->id);
            if (count($purchasedProducts)) {
                foreach ($purchasedProducts as $purchasedProduct) {
                    $includedProductIds[] = $purchasedProduct['productId'];
                }
            }
        }
        
        $showcal = ($this->browser == "Safari") ?true:false;
        $this->addData("showcal", $showcal);

        $this->dev = Request::getVar("dev");
        $this->addData("dev", $this->dev);

        if ($productId) {
            $includedProductIds[] = $productId;
        }
        $this->addData("includedProductIds", $includedProductIds);
    }
}
