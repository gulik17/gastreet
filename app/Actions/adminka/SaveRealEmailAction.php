<?php

/**
 */
class SaveRealEmailAction extends AdminkaAction {
    public function execute() {
        $id = Request::getInt('id');
        $email = Request::getVar('email');
        $name = Request::getVar('name');
        $description = Request::getVar('description');

        $rem = new RealEmailManager();
        $discount = $rem->getByEmail($email);
        if ($discount && !$id) {
            $this->goBack("Такой ящик уже есть");
        }
        $doAct = 'Ящик добавлен';
        $remObj = null;
        if ($id) {
            $remObj = $rem->getById($id);
        }
        if (!$remObj) {
            $remObj = new RealEmail();
        } else {
            $doAct = 'Ящик изменен';
        }
        $remObj->email = $email;
        $remObj->name = $name;
        $remObj->description = $description;
        $remObj = $rem->save($remObj);
        Adminka::redirect("managerealemail", $doAct);
    }

    private function goBack($message = '') {
        FormRestore::add("form");
        Adminka::redirectBack($message);
    }

}
