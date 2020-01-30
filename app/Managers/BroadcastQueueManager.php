<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 15.02.17
 * Time: 20:25
 */
class BroadcastQueueManager extends BaseEntityManager
{
	public function getAll()
	{
		$sql = new SQLCondition();
		$sql->orderBy = 'tsCreated asc';
		return $this->get($sql);
	}
}
