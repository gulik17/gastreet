<?php

/**
 *
 */
class ManageUserTypeControl extends BaseAdminkaControl
{
	public function render()
	{
		$utm = new UserTypeManager();
		$userTypes = $utm->getAll();
		$this->addData("userTypeList", $userTypes);
	}
}