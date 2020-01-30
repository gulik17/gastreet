<?php

class SaveAreaTypeAction extends AdminkaAction {
    public function execute() {
        $doAct = 'Тип программы добавлен';
        $id = Request::getInt('id');
        $name = Request::getVar('name');
        $am = new AreaTypeManager();
        $amObj = null;
        if ($id) {
            $amObj = $am->getById($id);
        }
        if (!$amObj) {
            $amObj = new AreaType();
        } else {
            $doAct = 'Тип программы изменен';
        }
        $amObj->name = $name;
        $amObj = $am->save($amObj);
        Adminka::redirect("manageareatype", $doAct);
    }
}