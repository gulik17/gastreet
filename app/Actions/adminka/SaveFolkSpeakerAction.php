<?php

/**
 *
 */
class SaveFolkSpeakerAction extends AdminkaAction {
    public function execute() {
        $doAct = "Спикер добавлен";

        $id = Request::getInt("id");
        $status = Request::getVar("status");
        $first_name = Request::getVar("first_name");
        $last_name = Request::getVar("last_name");
        $user_type = Request::getVar("user_type");
        $speaker_desc = Request::getVar("speaker_desc");
        $phone = Request::getVar("phone");
        $email = Request::getVar("email");
        $company = preg_replace('/\&quot;([^\"]*)\&quot;/ismU', "«$1»", Request::getVar("company"));
        $position = Request::getVar("position");
        $description = Request::getVar("description");
        $video = Request::getVar("video");
        $instagram = Request::getVar("instagram");
        $facebook = Request::getVar("facebook");
        $vkontakte = Request::getVar("vkontakte");
        $ondoklassniki = Request::getVar("ondoklassniki");
        $sort_order = Request::getInt("sort_order");



        if (!$first_name) {
            Adminka::redirectBack("Незаполнено Имя спикера");
        }

        $fsm = new FolkSpeakerManager();
        $fsmObj = null;

        if ($id) {
            $fsmObj = $fsm->getById($id);
        }

        if (!$fsmObj) {
            $fsmObj = new folkSpeaker();
            $fsmObj->ts_create = time();
        } else {
            $doAct = "Спикер отредактирован";
        }

        $fsmObj->status        = $status;
        $fsmObj->first_name    = $first_name;
        $fsmObj->last_name     = $last_name;
        $fsmObj->user_type     = $user_type;
        $fsmObj->speaker_desc  = $speaker_desc;
        $fsmObj->phone         = $phone;
        $fsmObj->email         = $email;
        $fsmObj->company       = $company;
        $fsmObj->position      = $position;
        $fsmObj->description   = $description;
        $fsmObj->video         = $video;
        $fsmObj->instagram     = $instagram;
        $fsmObj->facebook      = $facebook;
        $fsmObj->vkontakte     = $vkontakte;
        $fsmObj->ondoklassniki = $ondoklassniki;
        $fsmObj->sort_order    = $sort_order;
        $fsmObj->ts_update     = time();

        $fsmObj = $fsm->save($fsmObj);

        // image (X)
        $fileNameParam = 'speakerImg';
        if (Request::isFile($fileNameParam)) {
            $image = new UploadedFile($fileNameParam);
            $file = $fsmObj->id . "." . $image->extension;
            $image->rename($file);
            $image->saveTo(Configurator::get("application:folkSpeakerFolder") . "resized/");
            $fsmObj->photo = $file;
            $fsmObj = $fsm->save($fsmObj);
        }
        Adminka::redirect("managefolkspeakers", $doAct);
    }
}
