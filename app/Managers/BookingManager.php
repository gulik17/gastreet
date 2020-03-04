<?php

/**
 */
class BookingManager extends BaseEntityManager {

    public function getAll() {
        $sql = new SQLCondition();
        return $this->get($sql);
    }

    public function getByUserId($userId) {
        $condition = "userId = {$userId}";
        $sql = new SQLCondition($condition);
        $sql->orderBy = "tsCreate DESC";
        return $this->get($sql);
    }

    public function getByChildId($childId, $tsStart = 0, $tsFinish = 0) {
        $condition = "childId = {$childId}";
        if ($tsStart) {
            $condition .= " AND tsCreate >= {$tsStart} ";
        }
        if ($tsFinish) {
            $condition .= " AND tsCreate <= {$tsFinish} ";
        }
        $sql = new SQLCondition($condition);
        $sql->orderBy = "tsCreate DESC";
        return $this->get($sql);
    }

    public function getByUserIdNoChildren($userId, $tsStart = 0, $tsFinish = 0) {
        $condition = "userId = {$userId} AND childId IS NULL";
        if ($tsStart) {
            $condition .= " AND tsCreate >= {$tsStart} ";
        }
        if ($tsFinish) {
            $condition .= " AND tsCreate <= {$tsFinish} ";
        }
        $sql = new SQLCondition($condition);
        $sql->orderBy = "tsCreate DESC";
        return $this->get($sql);
    }

    public function getActiveByUserId($userId) {
        $ts = time();
        $condition = "userId = {$userId} AND tsFinish IS NOT NULL AND tsFinish >= {$ts} AND status = '" . Booking::STATUS_PAID . "'";
        $sql = new SQLCondition($condition);
        return $this->get($sql);
    }

    public function getActiveByUserIdNoChildren($userId) {
        $ts = time();
        $condition = "userId = {$userId} AND childId IS NULL AND tsFinish IS NOT NULL AND tsFinish >= {$ts} AND status = '" . Booking::STATUS_PAID . "'";
        $sql = new SQLCondition($condition);
        return $this->get($sql);
    }

    // установить дату tsFinish текущим моментом
    public function setAsFinishedAllActiveByUserId($userId) {
        $ts = time();
        $cleanSql = "UPDATE booking SET tsFinish = {$ts} WHERE userId = {$userId} AND tsFinish IS NOT NULL AND tsFinish >= {$ts} AND status = '" . Booking::STATUS_PAID . "'";
        $this->executeNonQuery($cleanSql);
    }

    public function getActiveByChildId($childId) {
        $ts = time();
        $condition = "childId = {$childId} AND tsFinish IS NOT NULL AND tsFinish >= {$ts} AND status = '" . Booking::STATUS_PAID . "'";
        $sql = new SQLCondition($condition);
        return $this->get($sql);
    }

    // установить дату tsFinish текущим моментом
    public function setAsFinishedAllActiveByChildId($childId) {
        $ts = time();
        $cleanSql = "UPDATE booking SET tsFinish = {$ts} WHERE childId = {$childId} AND tsFinish IS NOT NULL AND tsFinish >= {$ts} AND status = '" . Booking::STATUS_PAID . "'";
        $this->executeNonQuery($cleanSql);
    }

    public function getAllActive() {
        $ts = time();
        $condition = "tsFinish IS NOT NULL AND tsFinish >= {$ts} AND status = '" . Booking::STATUS_PAID . "'";
        $sql = new SQLCondition($condition);
        return $this->get($sql);
    }

    public function getAllBooked() {
        $ts = time();
        $condition = "tsFinish IS NOT NULL AND tsFinish >= {$ts} AND status = '" . Booking::STATUS_PAID . "'";
        $sql = new SQLCondition($condition);
        return $this->get($sql);
    }

    public function getOldBookings($daysBron) {
        $ts = time();
        $daysReserveInSeconds = $daysBron * 60 * 60 * 24;    // convert to days
        $sql = new SQLCondition("tsCreate+{$daysReserveInSeconds} < {$ts} AND status = '" . Booking::STATUS_PAID . "'");
        $sql->orderBy = "tsCreate"; // сначала старые
        return $this->get($sql);
    }

    public function getByUserIdAndIds($userId, $inpIds) {
        $userId = intval($userId);
        if (!is_array($inpIds) || !count($inpIds))
            return null;

        $ids = implode(",", $inpIds);
        $res = $this->get(new SQLCondition("userId = {$userId} AND id IN ($ids)", null, "id"));
        return $res;
    }
}