<?php

/**
 */
class DelParthnerTypeAction extends AdminkaAction
{
	public function execute()
	{
		$id          = Request::getInt("id");

		$ptm = new ParthnerTypeManager();
		if ($id) {
			$ptmObj = $ptm->getById($id);
		}
		if (!$ptmObj) {
			Adminka::redirectBack("Тип партнера не найден");
		}

		$ptm->remove($id);

		Adminka::redirect("manageparthnertype", "Тип партнера удален");
	}
}