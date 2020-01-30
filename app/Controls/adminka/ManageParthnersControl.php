<?php

/**
 *
 */
class ManageParthnersControl extends BaseAdminkaControl {

    public function render() {
        $pm = new ParthnerManager();
        $parthners = $pm->getAll();

        // пейджер
        $perPage = FrontPagerControl::getLimit();
        $this->addData("perPage", $perPage);
        $this->addData("total", count($parthners));
        $this->addData("page", Request::getInt("page"));
        $parthners = FrontPagerControl::limit($parthners, $perPage, "page");

        $this->addData("parthnerList", $parthners);
        $this->addData("statusDesc", Parthner::getStatusDesc());

        $ptm = new ParthnerTypeManager();
        $parthnerTypes = $ptm->getAll();
        if (is_array($parthnerTypes) && count($parthnerTypes)) {
            $parthnerTypesArray = array();
            foreach ($parthnerTypes AS $parthnerType) {
                $parthnerTypesArray[$parthnerType->id] = $parthnerType->name;
            }
            $this->addData('parthnerTypes', $parthnerTypesArray);
        }
    }

}
