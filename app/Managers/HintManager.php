<?php
/**
 * Менеджер управления подсказками в хинтах
 */
class HintManager extends BaseEntityManager
{
	/**
	 * Возвращает страницу по псевдониму
	 *
	 * @param string $alias
	 * @return Content
	 */
	public function getByAlias($alias)
	{
		$sql = new SQLCondition("alias = '{$alias}'");
		$page = $this->getOne($sql);
		return $page;
	}

	/**
	 * Проверяет существование страницы с таким именем
	 *
	 * @param string $alias
	 * @return Content
	 */
	public function isExists($alias)
	{
		$sql = new SQLCondition("alias = '{$alias}'");
		$page = $this->getOne($sql);
		return $page;
	}

	// все хинты в одном
	public function getAll()
	{
		$sql = new SQLCondition();
		return $this->get($sql);
	}

}
