<?php
/**
 *
 */
class SpeakersPrevControl extends IndexControl {
    public $pageTitle = "Спикеры — GASTREET 2021";
    public $pageTitle_en = "Speakers — GASTREET 2021";

    public function render() {
        $this->controlName = "Спикеры";
        $spm = new SpeakerManager();

        $ids[] = 399;
        $ids[] = 374;
        $ids[] = 355;
        $ids[] = 429;
        $ids[] = 507;
        $ids[] = 64;
        $ids[] = 553;
        $ids[] = 365;
        $ids[] = 512;
        $ids[] = 360;

        $spmList = $spm->getByIds($ids);
        
        $this->addData("spmList", $spmList);
        $this->includedJS .= Enviropment::loadScript('/js/pages/speakers.js', 'js');
    }
}