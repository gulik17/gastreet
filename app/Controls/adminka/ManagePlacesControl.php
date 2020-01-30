<?php

/**
 *
 */
class ManagePlacesControl extends BaseAdminkaControl {

    public function render() {
        $plm = new PlaceManager();
        $places = $plm->getAll();
        $this->addData("placesList", $places);
        $this->addData("statusDesc", Place::getStatusDesc());
    }
}