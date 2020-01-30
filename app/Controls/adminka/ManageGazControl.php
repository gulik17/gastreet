<?php

/**
 *
 */
class ManageGazControl extends BaseAdminkaControl {
    public function render() {
        $ggm = new GazGameManager();
        $gaz_users = $ggm->getDataAll();
       // deb($olimpic_users);
        $this->addData("gaz_users", $gaz_users);
    }
}