<?php
/**
  *
 */
class ManageCashBackControl extends BaseAdminkaControl {
    public function render() {
        $cbm = new CashBackManager();
        $list = $cbm->getAll("id DESC");
        if (is_array($list) && count($list)) {
            // пейджер
            $perPage = FrontPagerControl::getLimit();
            $this->addData("perPage", $perPage);
            $this->addData("total", count($list));
            $this->addData("page", Request::getInt("page"));
            $list = FrontPagerControl::limit($list, $perPage, "page");
        }
        $this->addData("list", $list);
    }
}