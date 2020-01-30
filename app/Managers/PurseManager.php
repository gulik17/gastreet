<?php
/**
 * Менеджер
 */
class PurseManager extends BaseEntityManager
{
	// поиск по merchantId (string)
	public function getByMerchantId($merchantId)
	{
		return $this->getOne(new SQLCondition("merchantId = '{$merchantId}' AND status = 1"));
	}

	// по id владельца
	public function getByOwnerId($ownerId)
	{
		return $this->getOne(new SQLCondition("userId = {$ownerId} AND status = 1"));
	}

}
