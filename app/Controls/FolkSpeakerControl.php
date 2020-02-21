<?php

class FolkSpeakerControl extends IndexControl {
    public $pageTitle = "Народный спикер — GASTREET 2020";

    public function render() {
        $fsm = new FolkSpeakerManager();
        $speakers = $fsm->getActive();
        $this->addData("speakers", $speakers);
        if ($s = Request::getInt('s')) {
            $speaker_og = $fsm->getById($s);
            $this->pageUri = "https://gastreet.com/folkspeaker?s=" . $speaker_og->id;
            $this->pageTitle = "Голосуй за меня в проекте «Народный спикер» by GASTREET";
            $this->pageImg = "https://gastreet.com/images/folkspeaker/resized/" . $speaker_og->photo . "?ts_update=" . $speaker_og->ts_update;
        }
    }
}
