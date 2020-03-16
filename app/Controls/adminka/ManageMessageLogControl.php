<?php

/**
 *
 */
class ManageMessageLogControl extends BaseAdminkaControl {

    public function render() {
        $isalive = Request::getInt("isalive");
        $mode = Request::getVar("mode");

        $phone = Request::getVar("phone");
        $email = Request::getVar("email");

        // если не заполнили основные поля формы
        // 1 - выключен, 2 - включен
        $basicfilter = (!$phone && !$email) ? 1 : 2;
        // свернем переменные фильтра в массив
        $sendArray = compact("mode", "basicfilter", "phone", "email");

        if ($isalive == 1) {
            FormRestore::add("log-filter");
        }

        $mlm = new MessageLogManager();
        $logIds = $mlm->getFilteredLogIds($sendArray);

        // пейджер
        $perPage = FrontPagerControl::getLimit();
        $this->addData("perPage", $perPage);
        $this->addData("total", count($logIds));
        $this->addData("page", Request::getInt("page"));
        $logIds = FrontPagerControl::limit($logIds, $perPage, "page");

        if ($logIds) {
            $list = $mlm->getByIds($logIds);
            $this->addData("logList", $list);
        }
    }

}
