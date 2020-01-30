<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 13.02.17
 * Time: 11:18
 */
class ManageVideoControl extends BaseAdminkaControl
{
	public function render()
	{
		$vm = new VideoManager();
		$video = $vm->getAll();
		$this->addData("videoList", $video);
		$this->addData("statusDesc", Video::getStatusDesc());
	}

}