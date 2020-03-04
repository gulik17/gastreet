<?php
/**
 * Менеджер
 */
class PaymentCardManager extends BaseEntityManager
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

}
