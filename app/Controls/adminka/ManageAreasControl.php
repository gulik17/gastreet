<?php
/**
 *
 */
class ManageAreasControl extends BaseAdminkaControl
{
	public function render()
	{
        $am = new AreaManager();
        $areas = $am->getAll();
        $this->addData("areasList", $areas);
        $this->addData("statusDesc", Area::getStatusDesc());

		$atm = new AreaTypeManager();
		$areaTypes = $atm->getAll();
		if (is_array($areaTypes) && count($areaTypes)) {
			$areaTypesArray = array();
			foreach ($areaTypes AS $areaType) {
				$areaTypesArray[$areaType->id] = $areaType->name;
			}
			$this->addData('areaTypes', $areaTypesArray);
		}

	}

}
