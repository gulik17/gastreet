<?php

/**
 * Контрол для представления формы управления новостями
 * 
 */
class ManageNewsControl extends BaseAdminkaControl {

    public function render() {
        $nm = new NewsManager();
        $list = $nm->getAll();
        
        // пейджер
        $perPage = FrontPagerControl::getLimit();
        $this->addData("perPage", $perPage);
        $this->addData("total", count($list));
        $this->addData("page", Request::getInt("page"));
        $list = FrontPagerControl::limit($list, $perPage, "page");
        
        $this->addData("news", $list);
    }

}
