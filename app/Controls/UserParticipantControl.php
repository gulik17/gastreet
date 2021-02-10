<?php

/**
 *
 */
class UserParticipantControl extends AuthorizedUserControl {
    public $pageTitle    = "Участники — GASTREET 2021";
    public $pageTitle_en = "Participants — GASTREET 2021";

    public function render() {
        UserManager::redirectIfNoProfile($this->actor);

        if ($this->actor->parentUserId) {
            if ($this->lang == 'en') {
                Enviropment::redirect("userarea", "No rights to this action", "danger");
            } else {
                Enviropment::redirect("userarea", "Нет прав на данное действие", "danger");
            }
        }

        $ts = time();
        $this->addData("ts", $ts);
        $this->addData("host", $this->host);
        $this->addData("actor", $this->actor);

        $um = new UserManager();
        $children = $um->getByParentId($this->actor->id);
        if (is_array($children) && count($children)) {
            $this->addData("children", $children);
        }
        
        // Выводим сформированные ранее списки стран
        $this->addData("country", $this->country);
        $this->addData("city", $this->city);
        $this->includedJS .= Enviropment::loadScript('/js/jquery.inputmask.min.js', 'js');
        $this->includedJS .= Enviropment::loadScript('/js/inputmask/phone-codes/phone.min.js', 'js');
        $this->includedJS .= Enviropment::loadScript('/js/pages/userparticipant.js', 'js');
    }
}