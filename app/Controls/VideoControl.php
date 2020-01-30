<?php

class VideoControl extends IndexControl {
    public function render() {
        $vm = new VideoManager();
        $vmList = $vm->getActive();
        $this->addData("vmList", $vmList);
    }
}