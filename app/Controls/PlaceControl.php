<?php
/**
 *
*/
class PlaceControl extends IndexControl {
    public $pageTitle = "Где жить — GASTREET 2021";
    public $pageTitle_en = "Where to live — GASTREET 2021";

    public function render() {
        //Enviropment::redirect("catalog");
        $this->layout = 'place.html';
        $this->controlName = "Place";
        $this->gcode = "hotels";
        $fm = new FaqManager();
        $fmList = $fm->getForPlace('sortOrder');
        $pm = new PlaceManager();
        $pmList = $pm->getActive();
        //deb($pmList);
        $pm960 = [];
        $pm540 = [];
        $pm560 = [];
        $pm540_plus = [];
        foreach ($pmList as $key => $place) {
            $place->inclusive = unserialize($place->inclusive);
            $place->notinclusive = unserialize($place->notinclusive);
            if ($place->level == '+960') {
                $pm960[] = $place;
            } else if ($place->level == '+540') {
                $pm540[] = $place;
            } else if ($place->level == '++540') {
                $pm540_plus[] = $place;
            } else if ($place->level == '+560') {
                $pm560[] = $place;
            }
        }

        $this->addData("fmList", $fmList);
        $this->addData("pmList", $pmList);
        $this->addData("pm960", $pm960);
        $this->addData("pm540", $pm540);
        $this->addData("pm560", $pm560);
        $this->addData("pm540_plus", $pm540_plus);
    }
}