<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 13.02.17
 * Time: 13:16
 */
class DelContactAction extends AdminkaAction {

    public function execute() {
        $id = Request::getInt("id");

        $cm = new ContactManager();
        if ($id) {
            $cmObj = $cm->getById($id);
        }
        if (!$cmObj) {
            Adminka::redirectBack("Контакт не найден");
        }

        $cm->delContact($id);

        Adminka::redirect("managecontacts", "Контакт удален");
    }

}
