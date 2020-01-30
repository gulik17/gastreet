<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 12.02.17
 * Time: 9:49
 */
class ManageContactsControl extends BaseAdminkaControl
{
	public function render()
	{
		$cm = new ContactManager();
		$contacts = $cm->getAll();
		$this->addData("contactsList", $contacts);
	}
}