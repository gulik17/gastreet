<?php
/**
*
*/
class UserDetailsControl extends AuthorizedUserControl {
    public $pageTitle    = "Редактирование реквизитов — GASTREET 2021";
    public $pageTitle_en = "Edit Details — GASTREET 2021";

    public function render() {
        UserManager::redirectIfNoProfile($this->actor);

        $this->addData("actor", $this->actor);
        $udm = new UserDetailsManager();
        $udmObj = $udm->getByUserId($this->actor->id);
        $this->addData("udmObj", $udmObj);
        $total = floatval(Request::getVar('total'));
        $this->addData("total", $total);
    }
}