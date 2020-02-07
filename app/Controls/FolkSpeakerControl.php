<?php

class FolkSpeakerControl extends IndexControl {

    public function render() {
        $fm = new FolkSpeakerManager();
        $speakers = $fm->getActive();

        $this->addData("speakers", $speakers);
    }

}