<?php
/**
 * Менеджер
 */
class PayBookingManager extends BaseEntityManager {
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
		$condition = "`userId` = {$userId}";
		$sql = new SQLCondition($condition);
		$sql->orderBy = "`tsCreated` DESC";
		return $this->get($sql);
	}

    public function getFilteredPayIds($filterArray) {
        // не выбран ни один фильтр
        if ($filterArray['basicfilter'] == 1) {
            $sql = "SELECT `id` FROM `payBooking` AS p ORDER BY `p`.`id` DESC";
            $res = $this->getColumn($sql);
            return $res;
        }

        $res = null;
        $allConditions = [];
        if ($filterArray["basicfilter"] == 2) {
            if ($filterArray["id"]) {
                $allConditions[] = "p.id = {$filterArray["id"]}";
            }
            if (count($allConditions) > 0) {
                $allConditions = " WHERE " . implode(" AND ", $allConditions);
            }
            $sql = "SELECT `id` FROM `payBooking` AS p {$allConditions} ORDER BY `p`.`id` DESC";
            $res = $this->getColumn($sql);
        }
        return $res;
    }
}