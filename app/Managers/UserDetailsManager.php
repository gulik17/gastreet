<?php
/**
 * Менеджер
 */
class UserDetailsManager extends BaseEntityManager {
    public function getByIds($inpIds) {
        if (!$inpIds) {
            return null;
        }
        if (count($inpIds) == 0) {
            return null;
        }
        $ids = implode(",", $inpIds);
        $res = $this->get(new SQLCondition("id IN ($ids)", null, "id"));
        return Utility::sort($inpIds, $res);
    }

    public function getByUserIds($inpIds) {
        if (!$inpIds) {
            return null;
        }
        if (count($inpIds) == 0) {
            return null;
        }
        $ids = implode(",", $inpIds);
        $res = $this->get(new SQLCondition("userId IN ($ids)", null, "id"));
        return $res;
    }

    public function getByUserId($userId) {
        $userId = intval($userId);
        return $this->getOne(new SQLCondition("userId = {$userId}"));
    }

    public function getAllUserIds() {
        $sql = "SELECT DISTINCT userId FROM userDetails";
        $res = $this->getColumn($sql);
        return $res;
    }
}