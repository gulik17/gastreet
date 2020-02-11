<?php

/**
 *
 */
class EditFolkSpeakerControl extends BaseAdminkaControl {

    public $pageTitle = "Редактирование народного спикера";

    public function render() {
        $id = Request::getInt("id");

        if (!$id) {
            $this->pageTitle = "Создание народного спикера";
        } else {
            $fsm = new FolkSpeakerManager();
            $smObj = $fsm->getById($id);

            if (!$smObj) {
                Adminka::redirect("managefolkspeakers", "Спикер не найден");
            } else {
                $this->addData("speaker", $smObj);
                if ($smObj->photo) {
                    $file = $smObj->photo;
                    $fullFileName = Configurator::get("application:folkSpeakerFolder") . "resized/" . $file;
                    if (file_exists($fullFileName)) {
                        $this->addData("speakerImg", $file);
                    }
                }
            }
        }

        $this->addData("statusList", FolkSpeaker::getStatusDesc());
    }
}
