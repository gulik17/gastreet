<?php
/**
 * Менеджер
 */
class RefundRequestManager extends BaseEntityManager
{
	public function getByIds($inpIds)
	{
		if (!$inpIds)
			return null;

		if (count($inpIds) == 0)
			return null;

		$ids = implode(",", $inpIds);
		$res = $this->get(new SQLCondition("id IN ($ids)", null, "id"));
		return Utility::sort($inpIds, $res);
	}

	// получить список оплат пользователя
	public function getByUserId($userId)
	{
		$condition = "userId = {$userId}";
		$sql = new SQLCondition($condition);
		$sql->orderBy = "tsCreated DESC";
		return $this->get($sql);
	}

    public function getOneByUserIdAndBasketId($userId, $basketId)
    {
        $condition = "userId = {$userId} AND basketId = {$basketId}";
        $sql = new SQLCondition($condition);
        $sql->orderBy = "tsCreated DESC";
        return $this->getOne($sql);
    }

    public function getOneByUserIdAndBasketProductId($userId, $basketProductId)
    {
        $condition = "userId = {$userId} AND basketProductId = {$basketProductId}";
        $sql = new SQLCondition($condition);
        $sql->orderBy = "tsCreated DESC";
        return $this->getOne($sql);
    }

    public function getFilteredPayIds($filterArray)
    {
        // не выбран ни один фильтр
        if ($filterArray['basicfilter'] == 1)
        {
            $sql = "SELECT id FROM refundRequest AS r ORDER BY r.id DESC";
            $res = $this->getColumn($sql);
            return $res;
        }

        $res = null;
        $allConditions = array();
        if ($filterArray["basicfilter"] == 2)
        {
            if ($filterArray["id"]) {
                $allConditions[] = "r.id = {$filterArray["id"]}";
            }
            if (count($allConditions) > 0) {
                $allConditions = " WHERE " . implode(" AND ", $allConditions);
            }

            $sql = "SELECT id FROM refundRequest AS r {$allConditions} ORDER BY r.id DESC";
            $res = $this->getColumn($sql);
        }

        return $res;
    }


}
