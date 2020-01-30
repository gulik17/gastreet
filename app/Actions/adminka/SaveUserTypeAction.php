<?php
/**
 *
 */
class SaveUserTypeAction extends AdminkaAction {
    public function execute(){
        $doAct   = 'Тип пользователей добавлен';
        $id      = Request::getInt('id');
        $name    = Request::getVar('name');
        $name_en = Request::getVar('name_en');
        $utm = new UserTypeManager();
        $utmObj = null;
        if ($id) {
            $utmObj = $utm->getById($id);
        }
        if (!$utmObj) {
            $utmObj = new UserType();
        } else {
            $doAct = 'Тип пользователей изменен';
        }
        $utmObj->name = $name;
        $utmObj->name_en = $name_en;
        $utmObj = $utm->save($utmObj);
        Adminka::redirect("manageusertype", $doAct);
    }
}