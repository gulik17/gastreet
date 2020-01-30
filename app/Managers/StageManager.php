<?php

class StageManager extends BaseEntityManager
{
	/**
	* Функция возвращает список id
	* 
	* @return array int
	*/
	public function getIds($limit = null)
	{
		$sql = "SELECT id FROM stage ORDER BY showDate DESC";

		if ($limit != null)
			$sql .= " LIMIT ".$limit;

		return $this->getColumn($sql);
	}
	
	/**
	* Функция возвращает список сущностей по заданным id
	*
	* @param array int $ids список id новостей
	* @return array News
	*/
	public function getByIds($newsIds)
	{
		if (!$newsIds)
			return null;
		
		$ids = implode(",", $newsIds);
		$res = $this->get(new SQLCondition("id in ($ids)", null, "showDate DESC"));
		return Utility::sort($newsIds, $res);
	}


	public function getAll()
	{
		$sql = new SQLCondition();
		return $this->get($sql);
	}


	public function getAllActive()
	{
		$condition = "status = '" . Stage::STATUS_ACTIVE . "'";
		$sql = new SQLCondition($condition);
		$sql->orderBy = "tsCreate DESC";
		return $this->get($sql);
	}


    public function getAllFinished()
    {
        $condition = "status = '" . Stage::STATUS_FINISHED . "'";
        $sql = new SQLCondition($condition);
        $sql->orderBy = "tsCreate DESC";
        return $this->get($sql);
    }

}
