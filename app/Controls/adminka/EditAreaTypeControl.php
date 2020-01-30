<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 14.02.17
 * Time: 10:55
 */
class EditAreaTypeControl extends BaseAdminkaControl
{
	public $pageTitle = "Редактирование типа программ";

	public function render()
	{
		$id = Request::getInt("id");
		if (!$id) {
			$this->pageTitle = "Создание типа программы";
		}
		else
		{
			$atm = new AreaTypeManager();
			$atmObj = $atm->getById($id);
			if (!$atmObj) {
				Adminka::redirect("manageareatype", "Тип программы не найден");
			}
			else
			{
				$this->addData("areaType", $atmObj);
			}
		}
	}
}