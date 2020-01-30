<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 15.02.17
 * Time: 15:34
 */
class RunCustomBroadcastAction extends AdminkaAction
{
	public function execute()
	{
		$doAct = "Невозможно активировать рссылку";
		$id = Request::getInt('id');

		$cbm = new CustomBroadcastManager();
		/** @var CustomBroadcast $cbmObj */
		$cbmObj = null;
		if ($id) {
			$cbmObj = $cbm->getById($id);
			if ($cbmObj && $cbmObj->status == CustomBroadcast::STATUS_NEW)
			{
				$cbm->runBroadcast($cbmObj);
                $cbmObj->status = CustomBroadcast::STATUS_RUNNING;
				$cbm->save($cbmObj);
				$doAct = "Рассылка активирована";
			}
		}

		Adminka::redirect("managecustombroadcast", $doAct);
	}
}