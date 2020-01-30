<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 11.02.17
 * Time: 9:46
 */
class FaqManager extends BaseEntityManager {
	public function getAll($sort = null) {
		$sql = new SQLCondition();
        $sql->orderBy = ($sort) ? $sort : "id";
		return $this->get($sql);
	}
}