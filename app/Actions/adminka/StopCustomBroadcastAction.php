<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 15.02.17
 * Time: 15:49
 */
class StopCustomBroadcastAction extends AdminkaAction
{
	public function execute()
	{
		$doAct = "Невозможно остановить рссылку";
		$id = Request::getInt('id');

		$cbm = new CustomBroadcastManager();
		/** @var CustomBroadcast $cbmObj */
		$cbmObj = null;
		if ($id) {
			$cbmObj = $cbm->getById($id);
			if ($cbmObj)
			{
				$cbmObj->status = CustomBroadcast::STATUS_COMPLETED;
				$cbm->save($cbmObj);
				$doAct = "Рассылка остановлена";
			}
		}

		Adminka::redirect("managecustombroadcast", $doAct);
	}
}