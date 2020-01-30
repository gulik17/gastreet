<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 13.02.17
 * Time: 17:15
 */
class ManageAreaTypeControl extends BaseAdminkaControl
{
	public function render()
	{
		$am = new AreaTypeManager();
		$areaTypes = $am->getAll();
		$this->addData("areaTypeList", $areaTypes);
	}
}