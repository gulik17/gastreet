<?php
/**
* Менеджер для управления новостями
*/
class NewsManager extends BaseEntityManager 
{
	/**
	* Функция возвращает список id новостей
	* 
	* @return array int
	*/
	public function getNewsIds($limit = null)
	{
		$sql = "SELECT id FROM news ORDER BY showDate DESC";

		if ($limit != null)
			$sql .= " LIMIT ".$limit;

		return $this->getColumn($sql);
	}
	
	/**
	* Функция возвращает список новостей по заданным id
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

}
