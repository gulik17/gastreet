<?php

/**
 * Менеджер
 */
class BasketProductManager extends BaseEntityManager {

    public function getByIds($inpIds) {
        if (!$inpIds)
            return null;

        if (count($inpIds) == 0)
            return null;

        $ids = implode(",", $inpIds);
        $res = $this->get(new SQLCondition("id IN ($ids)", null, "id"));
        return Utility::sort($inpIds, $res);
    }

    public function getProductCounts() {
        $sql = "SELECT productId, COUNT(id) AS cnt FROM basketProduct GROUP BY productId";
        return $this->getByAnySQL($sql);
    }

    public function getPayedByProductId($id) {
        $sql = "SELECT `id`, `userId`, `childId`, `productName` FROM `basketProduct` WHERE `status` = 'STATUS_PAID' AND `productId` = $id";
        return $this->getByAnySQL($sql);
    }

    public function getLinkByUserIdAndProductId($userId, $productId) {
        $userId = intval($userId);
        $productId = intval($productId);
        return $this->getOne(new SQLCondition("userId = {$userId} AND productId = {$productId}"));
    }

    public function getLinkByChildIdAndProductId($childId, $productId) {
        $childId = intval($childId);
        $productId = intval($productId);
        return $this->getOne(new SQLCondition("childId = {$childId} AND productId = {$productId}"));
    }

    public function getLinkByUserIdAndProductIdNoChildren($userId, $productId) {
        $userId = intval($userId);
        $productId = intval($productId);
        return $this->getOne(new SQLCondition("userId = {$userId} AND childId IS NULL AND productId = {$productId}"));
    }

    public function getByUserId($userId) {
        $userId = intval($userId);
        $sql = new SQLCondition("userId = {$userId}");
        $sql->orderBy = "tsCreated DESC";
        return $this->get($sql);
    }

    public function getByUserIdNoChildren($userId) {
        $userId = intval($userId);
        $sql = new SQLCondition("userId = {$userId} AND childId IS NULL");
        $sql->orderBy = "tsCreated DESC";
        return $this->get($sql);
    }

    public function getByUserIdAndChildId($userId, $childId) {
        $userId = intval($userId);
        $childId = intval($childId);
        $sql = new SQLCondition("userId = {$userId} AND childId = {$childId}");
        $sql->orderBy = "tsCreated DESC";
        return $this->get($sql);
    }

    public function getByChildId($childId) {
        $childId = intval($childId);
        $sql = new SQLCondition("childId = {$childId}");
        $sql->orderBy = "tsCreated DESC";
        return $this->get($sql);
    }

    public function updateProductName($productId, $productName, $eventTsStart = null, $eventTsFinish = null) {
        $productId = intval($productId);
        $eventTsStart = intval($eventTsStart);
        $eventTsFinish = intval($eventTsFinish);
        $query = "UPDATE basketProduct SET productName = '{$productName}'";
        if ($eventTsStart) {
            $query .= ", eventTsStart = {$eventTsStart}";
        }
        if ($eventTsFinish) {
            $query .= ", eventTsFinish = {$eventTsFinish}";
        }
        $query .= " WHERE productId = {$productId}";
        $this->executeNonQuery($query);
    }

    public function updateProductStatus($productId, $productStatus) {
        $productId = intval($productId);
        $query = "UPDATE basketProduct SET productStatus = '{$productStatus}' WHERE productId = {$productId}";
        $this->executeNonQuery($query);
    }

    public function updateProductNameAndStatus($productId, $productName, $productStatus, $eventTsStart = null, $eventTsFinish = null) {
        $productId = intval($productId);
        $eventTsStart = intval($eventTsStart);
        $eventTsFinish = intval($eventTsFinish);
        $query = "UPDATE basketProduct SET productName = '{$productName}', productStatus = '{$productStatus}'";
        if ($eventTsStart) {
            $query .= ", eventTsStart = {$eventTsStart}";
        }
        if ($eventTsFinish) {
            $query .= ", eventTsFinish = {$eventTsFinish}";
        }
        $query .= " WHERE productId = {$productId}";
        $this->executeNonQuery($query);
    }

    public function getUserIdsByProductId($productId) {
        $productId = intval($productId);
        $sql = "SELECT userId FROM basketProduct WHERE productId = {$productId}";
        $res = $this->getColumn($sql);
        return $res;
    }

    public function getProductsByChildId($childId, $tsStart = 0, $tsFinish = 0) {
        $childId = intval($childId);
        $sql = "SELECT `basketProduct`.*, `product`.`ext_id` AS ext_id, `product`.`firstName` AS sp_firstName, `product`.`secondName` AS sp_secondName FROM `basketProduct` LEFT JOIN `product` ON `product`.`id` = `basketProduct`.`productId` WHERE childId = {$childId}";
        if ($tsStart) {
            $sql .= " AND tsCreated >= {$tsStart} ";
        }
        if ($tsFinish) {
            $sql .= " AND tsCreated <= {$tsFinish} ";
        }
        $sql .= " ORDER BY eventTsStart ";
        $res = $this->getByAnySQL($sql);
        return $res;
    }

    public function getProductsByUserId($userId) {
        $userId = intval($userId);
        $sql = "SELECT `basketProduct`.*, `product`.`ext_id` AS ext_id, `product`.`firstName` AS sp_firstName, `product`.`secondName` AS sp_secondName FROM `basketProduct` LEFT JOIN `product` ON `product`.`id` = `basketProduct`.`productId` WHERE userId = {$userId}";
        $res = $this->getByAnySQL($sql);
        return $res;
    }

    public function getProductsByUserIdNoChildren($userId, $tsStart = 0, $tsFinish = 0) {
        $userId = intval($userId);
        $sql = "SELECT `basketProduct`.*, `product`.`ext_id` AS ext_id, `product`.`firstName` AS sp_firstName, `product`.`secondName` AS sp_secondName FROM `basketProduct` LEFT JOIN `product` ON `product`.`id` = `basketProduct`.`productId` WHERE userId = {$userId} AND childId IS NULL";
        if ($tsStart) {
            $sql .= " AND tsCreated >= {$tsStart} ";
        }
        if ($tsFinish) {
            $sql .= " AND tsCreated <= {$tsFinish} ";
        }
        $sql .= " ORDER BY eventTsStart ";
        $res = $this->getByAnySQL($sql);
        return $res;
    }
    
    public function getProductsByUserIdNoPay($userId) {
        $userId = intval($userId);
        $sql = "SELECT * FROM `basketProduct` WHERE `userId` = {$userId} AND `status` = 'STATUS_NEW'";
        $res = $this->getByAnySQL($sql);
        return $res;
    }
    
    public function getProductsByChildIdNoPay($childId) {
        $childId = intval($childId);
        $sql = "SELECT * FROM `basketProduct` WHERE `childId` = {$childId} AND `status` = 'STATUS_NEW'";
        $res = $this->getByAnySQL($sql);
        return $res;
    }

    public function getPaidProductsByProductId($productId) {
        $productId = intval($productId);
        $sql = "SELECT `basketProduct`.*, `product`.`ext_id` AS ext_id FROM `basketProduct` LEFT JOIN `product` ON `product`.`id` = `basketProduct`.`productId` WHERE productId = {$productId} AND payAmount + ulAmount >= needAmount + returnedAmount - discountAmount";
        $res = $this->getByAnySQL($sql);
        return $res;
    }

    public function getPaidProductsByUserId($userId) {
        $userId = intval($userId);
        $sql = "SELECT `basketProduct`.*, `product`.`ext_id` AS ext_id FROM `basketProduct` LEFT JOIN `product` ON `product`.`id` = `basketProduct`.`productId` WHERE userId = {$userId} AND payAmount + ulAmount >= needAmount + returnedAmount - discountAmount";
        $res = $this->getByAnySQL($sql);
        return $res;
    }

    public function getPaidProductsByUserIdNoChildren($userId) {
        $userId = intval($userId);
        $sql = "SELECT `basketProduct`.*, `product`.`ext_id` AS ext_id FROM `basketProduct` LEFT JOIN `product` ON `product`.`id` = `basketProduct`.`productId` WHERE userId = {$userId} AND childId IS NULL AND `basketProduct`.`status` = 'STATUS_PAID'"; // payAmount + ulAmount >= needAmount + returnedAmount - discountAmount
        $res = $this->getByAnySQL($sql);
        return $res;
    }
    
    public function getAllErrorPaidProducts() {
        $sql = "SELECT * FROM `basketProduct` WHERE `status` =  'STATUS_PAID' AND `payAmount` = 0 AND `discountAmount` = 0 AND `ulAmount` = 0";
        $res = $this->getByAnySQL($sql);
        return $res;
    }

    public function getAllProductsByUserIdNoChildren($userId) {
        $userId = intval($userId);
        $sql = "SELECT `basketProduct`.*, `product`.`ext_id` AS ext_id FROM `basketProduct` LEFT JOIN `product` ON `product`.`id` = `basketProduct`.`productId` WHERE `basketProduct`.`userId` = {$userId} AND `basketProduct`.`childId` IS NULL";
        $res = $this->getByAnySQL($sql);
        return $res;
    }

    public function getPaidProductsByChildId($childId) {
        $childId = intval($childId);
        $sql = "SELECT `basketProduct`.*, `product`.`ext_id` AS ext_id FROM `basketProduct` LEFT JOIN `product` ON `product`.`id` = `basketProduct`.`productId` WHERE `basketProduct`.`childId` = {$childId} AND `basketProduct`.`status` = 'STATUS_PAID'"; // payAmount + ulAmount >= needAmount + returnedAmount - discountAmount
        $res = $this->getByAnySQL($sql);
        return $res;
    }

    public function getAllProductsByChildId($childId) {
        $childId = intval($childId);
        $sql = "SELECT `basketProduct`.*, `product`.`ext_id` AS ext_id FROM `basketProduct` LEFT JOIN `product` ON `product`.`id` = `basketProduct`.`productId` WHERE childId = {$childId}";
        $res = $this->getByAnySQL($sql);
        return $res;
    }

    public function getByUserIdAndProductIds($userId, $inpIds) {
        $userId = intval($userId);
        if (!is_array($inpIds) || !count($inpIds))
            return null;

        $ids = implode(",", $inpIds);
        $sql = "userId = {$userId} AND productId IN ($ids)";
        $res = $this->get(new SQLCondition($sql, null, "id"));
        return $res;
    }

    public function getByUserIdAndIds($userId, $inpIds) {
        $userId = intval($userId);
        if (!is_array($inpIds) || !count($inpIds))
            return null;

        $ids = implode(",", $inpIds);
        $sql = "userId = {$userId} AND id IN ($ids)";
        $res = $this->get(new SQLCondition($sql, null, "id"));
        return $res;
    }

    public function getOldBaskets($daysReserve) {
        $ts = time();
        $daysReserveInSeconds = $daysReserve * 60 * 60 * 24;
        $sql = new SQLCondition("tsCreated+$daysReserveInSeconds < $ts AND status = '" . BasketProduct::STATUS_NEW . "'");
        $sql->orderBy = "tsCreated"; // сначала старые
        return $this->get($sql);
    }

    public function getCountAdded($eventTsStart, $eventTsFinish) {
        // определить кол-во добавленного в корзину
        $eventTsStart = intval($eventTsStart);
        $eventTsFinish = intval($eventTsFinish);
        $сount = 0;
        $sql = "SELECT COUNT(*) AS cnt FROM basketProduct WHERE tsCreated >= {$eventTsStart} AND tsCreated <= {$eventTsFinish}";
        $res = $this->getOneByAnySQL($sql);
        if ($res) {
            $сount = $сount + intval($res['cnt']);
        }
        return $сount;
    }

    public function getCountPaid($eventTsStart, $eventTsFinish) {
        // определить кол-во добавленного в корзину
        $eventTsStart = intval($eventTsStart);
        $eventTsFinish = intval($eventTsFinish);
        $сount = 0;
        $sql = "SELECT COUNT(*) AS cnt FROM basketProduct WHERE tsPay >= {$eventTsStart} AND tsPay <= {$eventTsFinish}";
        $res = $this->getOneByAnySQL($sql);
        if ($res) {
            $сount = $сount + intval($res['cnt']);
        }
        return $сount;
    }
}