<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 12.02.17
 * Time: 9:51
 */
class EditContactControl extends BaseAdminkaControl {

    public $pageTitle = "Редактирование контактной информации";

    public function render() {
        $id = Request::getInt("id");
        if ($id === 0) {
            $this->pageTitle = "Создание контакта";
        } else {
            $cm = new ContactManager();
            $cmObj = $cm->getById($id);
            if (!$cmObj) {
                Adminka::redirect("managecontacts", "Контакт не найден");
            } else {
                $cType = Contact::getTypeDesc();
                $this->addData("cType", $cType);
                $this->addData("contact", $cmObj);
                // image
                $file = $cmObj->id . ".jpg";
                $fullFileName = Configurator::get("application:contactsFolder") . "resized/" . $file;
                if (file_exists($fullFileName)) {
                    $this->addData("contactImg", $file);
                }
            }
        }
    }

}
