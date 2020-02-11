<?php

/**
 *
 */
class ManageFolkSpeakersControl extends BaseAdminkaControl {
    public function render() {
        $fsm = new FolkSpeakerManager();
        $speakers = $fsm->getAll();

        // пейджер
        $perPage = FrontPagerControl::getLimit();
        $this->addData("perPage", $perPage);
        $this->addData("total", count($speakers));
        $this->addData("page", Request::getInt("page"));
        $speakers = FrontPagerControl::limit($speakers, $perPage, "page");
        
        $this->addData("speakersList", $speakers);
        $this->addData("statusDesc", FolkSpeaker::getStatusDesc());
    }
}