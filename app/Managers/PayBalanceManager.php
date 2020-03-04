<?php

/**
 * Менеджер
 */
class PayBalanceManager extends BaseEntityManager {

    public function getByIds($inpIds) {
        if (!$inpIds)
            return null;

        if (count($inpIds) == 0)
            return null;

        $ids = implode(",", $inpIds);
        $res = $this->get(new SQLCondition("id IN ($ids)", null, "id"));
        return Utility::sort($inpIds, $res);
    }

    public function getByUserId($userId) {
        $condition = "userId = {$userId}";
        $sql = new SQLCondition($condition);
        $sql->orderBy = "tsCreated DESC";
        return $this->get($sql);
    }
    
    public function getByUserIdAndStatus($userId, $status = 'STATUS_PAID') {
        $condition = "userId = {$userId} AND status = '{$status}'";
        $sql = new SQLCondition($condition);
        $sql->orderBy = "tsCreated DESC";
        return $this->get($sql);
    }

    public function getFilteredPayIds($filterArray) {
        // не выбран ни один фильтр
        if ($filterArray['basicfilter'] == 1) {
            $sql = "SELECT id FROM payBalance AS p ORDER BY p.id DESC";
            $res = $this->getColumn($sql);
            return $res;
        }

        $res = null;
        $allConditions = array();
        if ($filterArray["basicfilter"] == 2) {
            if ($filterArray["id"]) {
                $allConditions[] = "p.id = {$filterArray["id"]}";
            }
            if (count($allConditions) > 0) {
                $allConditions = " WHERE " . implode(" AND ", $allConditions);
            }

            $sql = "SELECT id FROM payBalance AS p {$allConditions} ORDER BY p.id DESC";
            $res = $this->getColumn($sql);
        }

        return $res;
    }

}
