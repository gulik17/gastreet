<?php
/**
 *
 */
class SpeakersControl extends IndexControl {
    public $pageTitle = "Спикеры — GASTREET 2020";
    public $pageTitle_en = "Speakers — GASTREET 2020";

    public function render() {
        $this->controlName = "Спикеры";
        $spm = new SpeakerManager();
        $tag = Request::getVar("tag");
        $year = (Request::getVar("y")) ? Request::getVar("y") : null;

        if ($tag) {
            $spmList = $spm->getActiveByTag($tag, $year);
        } else {
            //$spmList = $spm->getActive();
            $spmList = $spm->getActiveByTag('2020');
            
            //deb($spmList);
        }
        
        $this->addData("spmList", $spmList);
        $this->addData("tag", $tag);
        $this->includedJS .= Enviropment::loadScript('/js/pages/speakers.js', 'js');
    }
}