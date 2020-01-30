<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 13.02.17
 * Time: 17:05
 */
class AreaTypeManager extends BaseEntityManager
{

	public function getAll()
	{
		$sql = new SQLCondition();
		$sql->orderBy = "id";
		return $this->get($sql);
	}

}