<?php

/**
 *
 */
class ManageOlimpicControl extends BaseAdminkaControl {
    public function render() {
        $com = new ChefOlimpicManager();
        $olimpic_users = $com->getDataAll();
       // deb($olimpic_users);
        $this->addData("olimpic_users", $olimpic_users);
        $this->addData("statusDesc", ChefOlimpic::getStatusDesc());
    }
}