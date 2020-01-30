<?php

/**
 */
class EditParthnerTypeControl extends BaseAdminkaControl
{
	public $pageTitle = "Редактирование типа партнера";

	public function render()
	{
		$id = Request::getInt("id");
		if (!$id) {
			$this->pageTitle = "Создание типа партнера";
		}
		else
		{
			$ptm = new ParthnerTypeManager();
			$ptmObj = $ptm->getById($id);
			if (!$ptmObj) {
				Adminka::redirect("manageparthnertype", "Тип партнера не найден");
			}
			else
			{
				$this->addData("parthnertype", $ptmObj);
			}
		}
	}
}