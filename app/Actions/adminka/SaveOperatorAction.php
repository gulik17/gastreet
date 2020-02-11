<?php

/**
 *
 */
class SaveOperatorAction extends AdminkaAction {
    public function execute() {
        $doAct = "Оператор добавлен";

        $id     = Request::getInt("id");
        $status = Request::getVar("status");
        $login  = Request::getVar("login");
        $name   = Request::getVar("name");
        $phone  = Request::getVar("phone");
        $password = Request::getVar("password");

        $settings['settingsmanager']        = Request::getVar("settingsmanager");
        $settings['manageusertype']         = Request::getVar("manageusertype");
        $settings['manageusers']            = Request::getVar("manageusers");
        $settings['managebuyers']           = Request::getVar("managebuyers");
        $settings['managediscounts']        = Request::getVar("managediscounts");
        $settings['manageinvoices']         = Request::getVar("manageinvoices");
        $settings['managerefunds']          = Request::getVar("managerefunds");
        $settings['manageregisterattempts'] = Request::getVar("manageregisterattempts");
        $settings['managestuff']            = Request::getVar("managestuff");
        $settings['manageolimpic']          = Request::getVar("manageolimpic");
        $settings['managenews']             = Request::getVar("managenews");
        $settings['manageprizes']           = Request::getVar("manageprizes");
        $settings['managevideo']            = Request::getVar("managevideo");
        $settings['manageparthnertype']     = Request::getVar("manageparthnertype");
        $settings['manageparthners']        = Request::getVar("manageparthners");
        $settings['managefaq']              = Request::getVar("managefaq");
        $settings['manageplaces']           = Request::getVar("manageplaces");
        $settings['managecontacts']         = Request::getVar("managecontacts");
        $settings['managecontent']          = Request::getVar("managecontent");
        $settings['managebroadcast']        = Request::getVar("managebroadcast");
        $settings['managereports']          = Request::getVar("managereports");
        $settings['managemessagelog']       = Request::getVar("managemessagelog");
        $settings['managebasetickets']      = Request::getVar("managebasetickets");
        $settings['manageareatype']         = Request::getVar("manageareatype");
        $settings['manageareas']            = Request::getVar("manageareas");
        $settings['managespeakers']         = Request::getVar("managespeakers");
        $settings['manageproducts']         = Request::getVar("manageproducts");
        $settings['managecustombroadcast']  = Request::getVar("managecustombroadcast");
        $settings['managesync']             = Request::getVar("managesync");
        $settings['managerealemail']        = Request::getVar("managerealemail");
        $settings['managecashback']         = Request::getVar("managecashback");
        $settings['managegaz']              = Request::getVar("managegaz");
        $settings['managememory']           = Request::getVar("managememory");
        $settings['managevolunteer']        = Request::getVar("managevolunteer");
        $settings['managefolkspeakers']     = Request::getVar("managefolkspeakers");

        $om = new OperatorManager();
        $omObj = null;
        if ($id) {
            $omObj = $om->getById($id);
        }
        if (!$omObj) {
            $omObj = new Operator();
            $omObj->dateCreate = time();
        } else {
            $doAct = "Оператор отредактирован";
        }

        $omObj->status   = $status;
        $omObj->login    = $login;
        $omObj->name     = $name;
        $omObj->phone    = $phone;
        if ($password) {
            $omObj->password = md5(md5($password).md5($password));
        }
        $omObj->role     = serialize($settings);
        $omObj = $om->save($omObj);

        Adminka::redirect("manageoperators", $doAct);
    }
}