<?php

/**
 *
 */
class ManagePrizesControl extends BaseAdminkaControl {

    public function render() {
        $pm = new PrizeManager();
        $list = $pm->getAll();
        
        // пейджер
        $perPage = FrontPagerControl::getLimit();
        $this->addData("perPage", $perPage);
        $this->addData("total", count($list));
        $this->addData("page", Request::getInt("page"));
        $list = FrontPagerControl::limit($list, $perPage, "page");
        
        $this->addData("prizes", $list);
        $this->addData("prizeStatuses", Prize::getStatusDesc());
    }

}
