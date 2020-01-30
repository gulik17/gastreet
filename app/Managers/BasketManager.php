<?php

/**
 * Менеджер
 */
class BasketManager extends BaseEntityManager {

    // пересчитать какие остатки по билетам и какие остатки по products,
    // с учётом их входимости в состав билетов
    public function rebuildBasket($userId = null) {
        // основные билеты
        $bm = new BasketManager();
        $cleanSql = "UPDATE baseTicket SET leftCount=maxCount";
        $this->executeNonQuery($cleanSql);
        $ticketCounts = $bm->getTicketCounts();
        if (is_array($ticketCounts) && count($ticketCounts)) {
            foreach ($ticketCounts AS $ticketCount) {
                $ts = time();
                $baseTicketId = intval($ticketCount['baseTicketId']);
                $soldCount = intval($ticketCount['cnt']);
                $updSql = "UPDATE baseTicket SET leftCount=maxCount-{$soldCount}, leftCountTs = {$ts} WHERE id = {$baseTicketId}";
                $this->executeNonQuery($updSql);
            }
        }
        // мастер-классы
        $bpm = new BasketProductManager();
        $cleanSql = "UPDATE `product` SET `leftCount` = `maxCount`";
        $this->executeNonQuery($cleanSql);
        $productCounts = $bpm->getProductCounts();
        // productId
        if (is_array($productCounts) && count($productCounts)) {
            foreach ($productCounts AS $productCount) {
                $ts = time();
                $productId = intval($productCount['productId']);
                $soldCount = intval($productCount['cnt']);
                $updSql = "UPDATE `product` SET `leftCount` = maxCount-{$soldCount}, `leftCountTs` = {$ts} WHERE `id` = {$productId}";
                $this->executeNonQuery($updSql);
            }
        }
    }

    public function getByDiscountId($discountId) {
        $discountId = intval($discountId);
        $res = $this->get(new SQLCondition("`discountId` = {$discountId} AND `status` = '" . Basket::STATUS_PAID . "'"));
        return $res;
    }

    public function getTicketsByChildId($childId, $tsStart = 0, $tsFinish = 0) {
        $childId = intval($childId);
        $sql = "SELECT * FROM `basket` WHERE `childId` = {$childId}";
        if ($tsStart) {
            $sql .= " AND `tsCreated` >= {$tsStart} ";
        }
        if ($tsFinish) {
            $sql .= " AND `tsCreated` <= {$tsFinish} ";
        }
        $res = $this->getByAnySQL($sql);
        return $res;
    }
    
    public function getTicketByUserId($userId) {
        $userId = intval($userId);
        $sql = "SELECT * FROM `basket` WHERE `userId` = {$userId} AND `childId` IS NULL";
        $res = $this->getByAnySQL($sql);
        return $res;
    }

    public function getTicketsByUserId($userId) {
        $userId = intval($userId);
        $sql = "SELECT * FROM `basket` WHERE `userId` = {$userId}";
        $res = $this->getByAnySQL($sql);
        return $res;
    }
    
    public function getTicketsByUserIdNoPay($userId) {
        $userId = intval($userId);
        $sql = "SELECT * FROM `basket` WHERE `userId` = {$userId} AND `status` = 'STATUS_NEW'";
        $res = $this->getByAnySQL($sql);
        return $res;
    }
    
    public function getTicketsByChildIdNoPay($childId) {
        $childId = intval($childId);
        $sql = "SELECT * FROM `basket` WHERE `childId` = {$childId} AND `status` = 'STATUS_NEW'";
        $res = $this->getByAnySQL($sql);
        return $res;
    }

    public function getTicketsByUserIdNoChildren($userId, $tsStart = 0, $tsFinish = 0) {
        $userId = intval($userId);
        $sql = "SELECT * FROM basket WHERE userId = {$userId} AND childId IS NULL";
        if ($tsStart) {
            $sql .= " AND tsCreated >= {$tsStart} ";
        }
        if ($tsFinish) {
            $sql .= " AND tsCreated <= {$tsFinish} ";
        }
        $res = $this->getByAnySQL($sql);
        return $res;
    }

    public function getAllPaidTickets() {
        $sql = "SELECT * FROM basket WHERE payAmount + ulAmount >= needAmount + returnedAmount - discountAmount";
        $res = $this->getByAnySQL($sql);
        return $res;
    }
    
    public function getAllErrorPaidTickets() {
        $sql = "SELECT * FROM `basketProduct` WHERE `status` =  'STATUS_PAID' AND `payAmount` = 0 AND `discountAmount` = 0 AND `ulAmount` = 0";
        $res = $this->getByAnySQL($sql);
        return $res;
    }

    public function getPaidTicketsByTicketId($ticketId) {
        $ticketId = intval($ticketId);
        $sql = "SELECT * FROM basket WHERE baseTicketId = {$ticketId} AND payAmount + ulAmount >= needAmount + returnedAmount - discountAmount";
        $res = $this->getByAnySQL($sql);
        return $res;
    }

    public function getPaidTicketsByChildId($childId) {
        $childId = intval($childId);
        $sql = "SELECT * FROM basket WHERE childId = {$childId} AND payAmount + ulAmount >= needAmount + returnedAmount - discountAmount";
        $res = $this->getByAnySQL($sql);
        return $res;
    }

    public function getAllTicketsByChildId($childId) {
        $childId = intval($childId);
        $sql = "SELECT * FROM basket WHERE childId = {$childId}";
        $res = $this->getByAnySQL($sql);
        return $res;
    }

    public function getPaidTicketsByUserId($userId) {
        $userId = intval($userId);
        $sql = "SELECT * FROM basket WHERE userId = {$userId} AND payAmount + ulAmount >= needAmount + returnedAmount - discountAmount";
        $res = $this->getByAnySQL($sql);
        return $res;
    }

    public function getPaidTicketsByUserIdNoChildren($userId) {
        $userId = intval($userId);
        $sql = "SELECT * FROM basket WHERE userId = {$userId} AND childId IS NULL AND payAmount + ulAmount >= needAmount + returnedAmount - discountAmount";
        $res = $this->getByAnySQL($sql);
        return $res;
    }

    public function getAllTicketsByUserIdNoChildren($userId) {
        $userId = intval($userId);
        $sql = "SELECT * FROM basket WHERE userId = {$userId} AND childId IS NULL";
        $res = $this->getByAnySQL($sql);
        return $res;
    }

    public function getByIds($inpIds) {
        if (!$inpIds)
            return null;

        if (count($inpIds) == 0)
            return null;

        $ids = implode(",", $inpIds);
        $res = $this->get(new SQLCondition("id IN ($ids)", null, "id"));
        return Utility::sort($inpIds, $res);
    }

    public function getByUserIdAndTicketIds($userId, $inpIds) {
        $userId = intval($userId);
        if (!is_array($inpIds) || !count($inpIds))
            return null;

        $ids = implode(",", $inpIds);
        $res = $this->get(new SQLCondition("userId = {$userId} AND baseTicketId IN ($ids)", null, "id"));
        return $res;
    }

    public function getByUserIdsWithChildren($inpIds) {
        if (!is_array($inpIds) || !count($inpIds))
            return null;

        $ids = implode(",", $inpIds);
        $res = $this->get(new SQLCondition("userId IN ($ids) OR childId IN ($ids)"));
        return $res;
    }

    public function getByUserIdAndIds($userId, $inpIds) {
        $userId = intval($userId);
        if (!is_array($inpIds) || !count($inpIds))
            return null;

        $ids = implode(",", $inpIds);
        $res = $this->get(new SQLCondition("userId = {$userId} AND id IN ($ids)", null, "id"));
        return $res;
    }

    public function getTicketCounts() {
        $sql = "SELECT baseTicketId, COUNT(id) AS cnt FROM basket GROUP BY baseTicketId";
        $res = $this->getByAnySQL($sql);
        return $res;
    }

    public function getOldBaskets($daysReserve) {
        $ts = time();
        $daysReserveInSeconds = $daysReserve * 60 * 60 * 24;    // convert to days
        $sql = new SQLCondition("tsCreated+{$daysReserveInSeconds} < {$ts} AND status = '" . Basket::STATUS_NEW . "'");
        $sql->orderBy = "tsCreated"; // сначала старые
        return $this->get($sql);
    }

    public function getCountAdded($eventTsStart, $eventTsFinish) {
        // определить кол-во добавленного в корзину
        $eventTsStart = intval($eventTsStart);
        $eventTsFinish = intval($eventTsFinish);
        $сount = 0;
        $sql = "SELECT COUNT(*) AS cnt FROM basket WHERE tsCreated >= {$eventTsStart} AND tsCreated <= {$eventTsFinish}";
        $res = $this->getOneByAnySQL($sql);
        if ($res) {
            $сount = $сount + intval($res['cnt']);
        }
        return $сount;
    }

    public function getCountPaid($eventTsStart = 0, $eventTsFinish = 0) {
        // определить кол-во добавленного в корзину
        $eventTsStart = intval($eventTsStart);
        $eventTsFinish = intval($eventTsFinish);
        $сount = 0;
        $sql = "SELECT COUNT(*) AS cnt FROM basket WHERE status = '" . Basket::STATUS_PAID . "' ";
        if ($eventTsStart && $eventTsFinish) {
            $sql .= " AND tsPay >= {$eventTsStart} AND tsPay <= {$eventTsFinish} ";
        }
        $res = $this->getOneByAnySQL($sql);
        if ($res) {
            $сount = $сount + intval($res['cnt']);
        }
        return $сount;
    }
}