<?php
/**
*
*/
class UserProfileControl extends AuthorizedUserControl {
    public $pageTitle    = "Учетная запись — GASTREET 2020";
    public $pageTitle_en = "User Profile — GASTREET 2020";

    public function render() {
        UserManager::redirectIfNoProfile($this->actor);
        if ($this->actor->tsBorn) {
            $this->actor->tsBorn = date("d-m-Y", $this->actor->tsBorn);
        }
        $this->addData("actor", $this->actor);
        $this->addData("position", $this->position);
        $this->addData("userSize", User::getUserSize());

        $udm = new UserDetailsManager();
        $detail = $udm->getByUserId($this->actor->id);
        $this->addData("detail", $detail);
        $this->includedJS .= Enviropment::loadScript('/js/pages/register.js', 'js');
        $this->includedJS .= Enviropment::loadScript('/js/app/ApplePaySession.js', 'js');
    }
}