<?php
/**
 */
class ManageParthnerTypeControl extends BaseAdminkaControl
{
	public function render()
	{
		$pm = new ParthnerTypeManager();
		$parthnerTypes = $pm->getAll();
		$this->addData("parthnertypelist", $parthnerTypes);
	}
}