<?php

/**
 */
class SaveParthnerTypeAction extends AdminkaAction
{
	public function execute()
	{
		$doAct = 'Тип партнера добавлен';

		$id   = Request::getInt('id');
		$name = Request::getVar('name');

		$pm = new ParthnerTypeManager();
		$pmObj = null;

		if ($id)
		{
			$pmObj = $pm->getById($id);
		}

		if (!$pmObj)
		{
			$pmObj = new ParthnerType();
		}
		else
		{
			$doAct = 'Тип партнера изменен';
		}

		$pmObj->name = $name;

		$pmObj = $pm->save($pmObj);

		Adminka::redirect("manageparthnertype", $doAct);
	}
}