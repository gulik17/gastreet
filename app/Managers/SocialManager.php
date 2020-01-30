<?php
/**
 * Менеджер
 */
class SocialManager extends BaseEntityManager
{
	// поиск по uid и type
	public function getByUid($uid, $network)
	{
		$uid = intval($uid);
		if ($uid > 0 && $network && $network != '') {
            return $this->getOne(new SQLCondition("uid = {$uid} AND network = '{$network}'"));
        }
	}

	// по userId
	public function getByUserId($userId)
	{
		$userId = intval($userId);
		if ($userId > 0) {
			return $this->getOne(new SQLCondition("userId = {$userId}"));
		}
	}

}
