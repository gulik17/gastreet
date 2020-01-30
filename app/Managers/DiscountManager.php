<?php

/**
 */
class DiscountManager extends BaseEntityManager {

    public function getByIds($newsIds) {
        if (!$newsIds) {
            return null;
        }
        $ids = implode(",", $newsIds);
        $res = $this->get(new SQLCondition("id in ($ids)", null, "showDate DESC"));
        return Utility::sort($newsIds, $res);
    }

    public function getAll($sort = null) {
        $sql = ($sort) ? new SQLCondition(null,null,$sort):new SQLCondition();
        return $this->get($sql);
    }

    public function getByCode($code, $status = Discount::STATUS_ENABLED) {
        return $this->getOne(new SQLCondition("code = '{$code}' AND status = '{$status}'"));
    }

    public function getByUserId($userId) {
        $userId = intval($userId);
        return $this->get(new SQLCondition("userId = {$userId}"));
    }
}