<?php

class SaveCustomBroadcastAction extends AdminkaAction {
    public function execute() {
        $doAct = "Рассылка добавлена";
        $id = Request::getInt('id');
        $status = Request::getInt('status');
        $type = Request::getVar('type');
        $userType = Request::getInt('userType');
        $ticketId = Request::getInt('ticketId');
        $productId = Request::getInt('productId');
        $name = Request::getVar('name');
        $subject = Request::getVar('subject');
        $message = Request::getVar('message');
        $sms = Request::getVar('sms');

        $cbm = new CustomBroadcastManager();
        /** @var CustomBroadcast $cbmObj */
        $cbmObj = null;
        if ($id) {
            $cbmObj = $cbm->getById($id);
        }
        if (!$cbmObj) {
            $cbmObj = new CustomBroadcast();
            $cbmObj->tsCreated = time();
        } else {
            $doAct = 'Рассылка отредактирована';
        }

        if ($cbmObj->status == CustomBroadcast::STATUS_NEW || is_null($cbmObj->status)) {
            $cbmObj->id = $id;
            $cbmObj->status = $status;
            $cbmObj->type = $type;
            $cbmObj->userType = $userType;
            $cbmObj->ticketId = $ticketId;
            $cbmObj->productId = $productId;
            $cbmObj->name = $name;
            $cbmObj->subject = $subject;
            $cbmObj->message = $message;
            $cbmObj->sms = $sms;
            $cbmObj->tsUpdated = time();
            $cbmObj = $cbm->save($cbmObj);
        } else {
            $doAct = 'Недопустимый статус рассылки, изменение невозможно';
            if ($cbmObj->status == CustomBroadcast::STATUS_COMPLETED)
                $doAct = 'Рассылка завершена, изменение невозможно';
            if ($cbmObj->status == CustomBroadcast::STATUS_RUNNING)
                $doAct = 'Рассылка активна, изменение невозможно';
        }
        Adminka::redirect("managecustombroadcast", $doAct);
    }
}