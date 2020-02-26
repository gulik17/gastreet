<?php

/**
 * Основной контрол БО показывается сразу после входа
 * 
 */
class MainpageControl extends BaseAdminkaControl {
    public function render() {
        $this_day = strtotime('midnight 3:00');
        $this_mon = strtotime('Monday this week');
        $prev_mon = $this_mon-604800; // от текущего понедельника отнимаем неделю, получим понедельник прошлой нелели

        $um = new UserManager();
        $registeredUsers = $um->getRegistered();
        $this->addData("registeredUsers", $registeredUsers);

        $registeredToday = $um->getRegistered($this_day, time());
        $this->addData("registeredToday", $registeredToday);

        $registeredWeek = $um->getRegistered($this_mon, time());
        $this->addData("registeredWeek", $registeredWeek);
        
        $sql = "SELECT `description` AS count FROM `baseTicket` WHERE `id` = 8;";
        $requestRebro = $um->getByAnySQL($sql);
        $this->addData("requestRebro", $requestRebro[0]['count']);

        $sql = "SELECT count(id) AS count FROM basket";
        $basketCount = $um->getByAnySQL($sql);
        $this->addData("basketCount", $basketCount[0]['count']);

        $sql = "SELECT count(id) AS count FROM `basket` WHERE `status` = 'STATUS_PAID' AND `discountId` = 0";
        $basketPayCount = $um->getByAnySQL($sql);
        $this->addData("basketPayCount", $basketPayCount[0]['count']);
        
        $sql = "SELECT count(id) AS count FROM `basket` WHERE `status` = 'STATUS_PAID' AND `discountPercent` = 100";
        $basketWDiscountCount = $um->getByAnySQL($sql);
        $this->addData("basketWDiscountCount", $basketWDiscountCount[0]['count']);
        
        $sql = "SELECT count(id) AS count FROM `basket` WHERE `status` = 'STATUS_PAID' AND `discountPercent` > 0 AND `discountPercent` < 100";
        $basketPayWDiscountCount = $um->getByAnySQL($sql);
        $this->addData("basketPayWDiscountCount", $basketPayWDiscountCount[0]['count']);
        
        $sql = "SELECT SUM(plan) AS sum FROM `baseTicket`";
        $baseTicketPlan = $um->getByAnySQL($sql);
        if ( ($basketPayCount[0]['count']) || ($basketPayWDiscountCount[0]['count']) ) {
            $baseTicketPlan = round( ( ($basketPayCount[0]['count'] + $basketPayWDiscountCount[0]['count']) / $baseTicketPlan[0]['sum'] ) * 100 , 2);
        } else {
            $baseTicketPlan = '—';
        }



        $this->addData("baseTicketPlan", $baseTicketPlan);

        $btm = new BaseTicketManager();
        $tickets = $btm->getAllActive();
        $planTotal = 0;

        if ($tickets) {
        foreach ($tickets as $ticket) {
            $sql = "SELECT count(id) AS count FROM `basket` WHERE `baseTicketId` = " . $ticket->id;
            $basketCount = $um->getByAnySQL($sql);
            $sql = "SELECT count(id) AS count FROM `basket` WHERE `baseTicketId` = " . $ticket->id . " AND `status` = 'STATUS_PAID' AND `discountId` = 0";
            $basketPayCount = $um->getByAnySQL($sql);
            $sql = "SELECT count(id) AS count FROM `basket` WHERE `baseTicketId` = " . $ticket->id . " AND `status` = 'STATUS_PAID' AND `discountPercent` = 100";
            $basketWDiscountCount = $um->getByAnySQL($sql);
            $sql = "SELECT count(id) AS count FROM `basket` WHERE `baseTicketId` = " . $ticket->id . " AND `status` = 'STATUS_PAID' AND `discountPercent` > 0 AND `discountPercent` < 100";
            $basketPayWDiscountCount = $um->getByAnySQL($sql);
            $ticketTotal[$ticket->id]['name'] = $ticket->name;
            $ticketTotal[$ticket->id]['plan'] = $ticket->plan;
            $ticketTotal[$ticket->id]['all']  = $basketCount[0]['count'];
            $ticketTotal[$ticket->id]['pay']  = $basketPayCount[0]['count'];
            $ticketTotal[$ticket->id]['discount']  = $basketWDiscountCount[0]['count'];
            $ticketTotal[$ticket->id]['payDiscount']  = $basketPayWDiscountCount[0]['count'];
            $planTotal = $planTotal + $ticket->plan;
            if ( ( ($basketPayCount[0]['count']) || ($basketPayWDiscountCount[0]['count']) ) && ($ticket->plan) ) {
                $ticketTotal[$ticket->id]['percent'] = round( ( ($basketPayCount[0]['count'] + $basketPayWDiscountCount[0]['count']) / $ticket->plan ) * 100 , 2);
            } else {
                $ticketTotal[$ticket->id]['percent'] = '—';
            }
        }
        }

        if ($ticketTotal) {
            $this->addData("ticketTotal", $ticketTotal);
            $this->addData("planTotal", $planTotal);
        }

        $pm = new ProductManager();
        $products = $pm->getAllActive(null,false,null,'areaId');
        $planProductTotal = 0;

        $productTotal = [];
        if ($products) {
            foreach ($products as $product) {
                if ($product->price > 0) {
                    $sql = "SELECT count(id) AS count FROM `basketProduct` WHERE `productId` = " . $product->id;
                    $basketProductCount = $um->getByAnySQL($sql);

                    $sql = "SELECT count(id) AS count FROM `basketProduct` WHERE `productId` = " . $product->id . " AND `status` = 'STATUS_PAID'";
                    $basketProductPayCount = $um->getByAnySQL($sql);

                    $productTotal[$product->id]['name'] = $product->name;
                    $productTotal[$product->id]['plan'] = $product->plan;
                    $productTotal[$product->id]['areaId'] = $product->areaId;
                    $productTotal[$product->id]['eventTsStart'] = $product->eventTsStart;
                    $productTotal[$product->id]['all']  = $basketProductCount[0]['count'];
                    $productTotal[$product->id]['pay']  = $basketProductPayCount[0]['count'];
                    $planProductTotal = $planProductTotal + $product->plan;

                    $productTotal[$product->id]['percent'] = ( $product->plan ) ? round( ( $basketProductPayCount[0]['count'] / $product->plan ) * 100 , 2) : '—';
                }
            }
        }

        if ($productTotal) {
            $this->addData("productTotal", $productTotal);
            $this->addData("planProductTotal", $planProductTotal);
        }

        $sql = "SELECT count(id) AS count FROM `basketProduct`";
        $productCount = $um->getByAnySQL($sql);
        $this->addData("productCount", $productCount[0]['count']);

        $sql = "SELECT count(id) AS count FROM `basketProduct` WHERE `status` = 'STATUS_PAID'";
        $productPayCount = $um->getByAnySQL($sql);
        $this->addData("productPayCount", $productPayCount[0]['count']);

        if ($planProductTotal) {
            $productPlan = round( ( $productPayCount[0]['count'] / $planProductTotal ) * 100 , 2);
        } else {
            $productPlan = 0;
        }
        $this->addData("productPlan", $productPlan);

        $sql = "SELECT SUM(payAmount + ulAmount) AS count FROM `basket` WHERE `status` = 'STATUS_PAID'";
        $basketPayAmount = $um->getByAnySQL($sql);
        $this->addData("basketPayAmount", $basketPayAmount[0]['count']);

        $sql = "SELECT SUM(discountAmount) AS count FROM `basket` WHERE `status` = 'STATUS_PAID' AND `discountId` = 0";
        $basketBronAmount = $um->getByAnySQL($sql);
        $this->addData("basketBronAmount", $basketBronAmount[0]['count']);

        $sql = "SELECT SUM(payAmount+ulAmount) AS count FROM `basketProduct` WHERE `status` = 'STATUS_PAID'";
        $productPayAmount = $um->getByAnySQL($sql);
        $this->addData("productPayAmount", $productPayAmount[0]['count']);

        $sql = "SELECT SUM(ulBalance) AS count FROM `user` WHERE `ulBalance` <> 0";
        $balanceAmount = $um->getByAnySQL($sql);
        $this->addData("balanceAmount", $balanceAmount[0]['count']);

        $sql = "SELECT SUM(payAmount) AS count FROM `pay` WHERE `status` = 'STATUS_PAID'";
        $payAmount = $um->getByAnySQL($sql);
        $sql = "SELECT SUM(payAmount) AS count FROM `payBalance` WHERE `status` = 'STATUS_PAID'";
        $payBalance = $um->getByAnySQL($sql);
        $sql = "SELECT SUM(payAmount) AS count FROM `payBooking` WHERE `status` = 'STATUS_PAID'";
        $payBooking = $um->getByAnySQL($sql);
        $this->addData("payAmount", $payAmount[0]['count']+$payBalance[0]['count']+$payBooking[0]['count']);

        $sql = "SELECT SUM(payAmount) AS count FROM `pay` WHERE `status` = 'STATUS_PAID' AND `tsUpdated` >= $this_mon";
        $weekPayAmount = $um->getByAnySQL($sql);
        $this->addData("weekPayAmount", $weekPayAmount[0]['count']);

        $sql = "SELECT SUM(payAmount) AS count FROM `pay` WHERE `status` = 'STATUS_PAID' AND `tsUpdated` > $prev_mon AND `tsUpdated` < $this_mon";
        $prevWeekPayAmount = $um->getByAnySQL($sql);
        $this->addData("prevWeekPayAmount", $prevWeekPayAmount[0]['count']);
    }
}