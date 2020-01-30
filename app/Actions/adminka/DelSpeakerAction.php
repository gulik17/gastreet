<?php
/**
 *
 */
class DelSpeakerAction extends AdminkaAction
{
	public function execute()
	{
		$id          = Request::getInt("id");

        $sm = new SpeakerManager();
        if ($id) {
            $smObj = $sm->getById($id);
        }
        if (!$smObj) {
            Adminka::redirectBack("Спикер не найден");
        }

        $sm->delSpeaker($id);

		Adminka::redirect("managespeakers", "Спикер удален");

	}

}