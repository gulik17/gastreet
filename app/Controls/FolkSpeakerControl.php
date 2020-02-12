<?php

class FolkSpeakerControl extends IndexControl {
    public $pageTitle = "Народный спикер — GASTREET 2020";

    public function render() {
        $fsm = new FolkSpeakerManager();
        $speakers = $fsm->getActive();

        //deb($speakers);

        $this->addData("speakers", $speakers);


        if ($s = Request::getInt('s')) {
            $speaker_og = $fsm->getById($s);
            $this->pageUri = "https://gastreet.com/folkspeaker?s=" . $speaker_og->id;
            $this->pageTitle = "Голосуй за меня в проекте «Народный спикер» by GASTREET";
            $this->pageImg = "https://gastreet.com/images/folkspeaker/resized/" . $speaker_og->photo . "?ts_update=" . $speaker_og->ts_update;
        }
        //deb($speaker_og);
       // $('meta[property="og:url"]').attr("content", "https://gastreet.com/folkspeaker?s=$speaker_id");
       // $('meta[property="og:title"]').attr("content", "Голосуй за народного спикера "+answer.first_name+" "+answer.last_name);
       // $('meta[property="og:image"]').attr("content", "https://gastreet.com/images/folkspeaker/resize/"+answer.photo+"?ts_update="+answer.ts_update);
    }

}