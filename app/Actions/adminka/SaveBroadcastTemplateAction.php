<?php

class SaveBroadcastTemplateAction extends AdminkaAction {
    public function execute() {
        $doAct          = "Сообщение добавлено";
        $id             = Request::getInt('id');
        $status         = Request::getVar('status');
        $editType       = Request::getVar('editType');
        $sendType       = Request::getVar('sendType');
        $triggerType    = Request::getVar('triggerType');
        $message        = Request::getVar('message');

        $BTM = new BroadcastTemplateManager();
        $btmObj = null;
        if ($id) {
            $btmObj = $BTM->getById($id);
        }
        if (!$btmObj) {
            $btmObj = new BroadcastTemplate();
        } else {
            $doAct = 'Сообщение отредактировано';
        }

        if ($btmObj->editType == BroadcastTemplate::EDIT_TYPE_AVAILABLE) {
            $btmObj->id         = $id;
            $btmObj->status     = $status;
            $btmObj->editType   = $editType;
            $btmObj->sendType   = $sendType;
            $btmObj->triggerType = $triggerType;
            $btmObj->message    = $message;
            $btmObj->tsUpdate   = time();
            $btmObj = $BTM->save($btmObj);
        } else {
            $doAct = 'Недопустимый статус сообщения, изменение невозможно';
        }
        Adminka::redirect("managebroadcast", $doAct);
    }
}