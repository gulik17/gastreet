<?php

/**
 *
 */
class EditBroadcastTemplateControl extends BaseAdminkaControl {
    public $pageTitle = "Редактирование уведомления";

    public function render() {
        $id = Request::getInt("id");
        if (!$id) {
            $this->pageTitle = "Создание уведомления";
        } else {
            $BTM = new BroadcastTemplateManager();
            $btmObj = $BTM->getById($id);
            if (!$btmObj) {
                Adminka::redirect("managebroadcast", "Уведомление не найдено");
            } else {
                $this->addData("broadcastTemplate", $btmObj);
            }
        }

        $this->addData("statusList", BroadcastTemplate::getStatusDesc());
        $this->addData('editType', BroadcastTemplate::getEditTypeDesc());
        $this->addData('sendType', BroadcastTemplate::getSendTypeDesc());
        $this->addData('triggerType', BroadcastTemplate::getTriggerTypeDesc());
    }
}