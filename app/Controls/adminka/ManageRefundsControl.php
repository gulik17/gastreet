<?php
/**
 * Класс для вывода списка требований на возврат
 */
class ManageRefundsControl extends BaseAdminkaControl {
    public function render() {
        $isalive = Request::getInt("isalive");
        $mode = Request::getVar("mode");
        $id = Request::getInt("id");
        // если не заполнили основные поля формы
        // 1 - выключен, 2 - включен
        if (!$id) {
            $basicfilter = 1;
        } else {
            $basicfilter = 2;
        }
        // свернем переменные фильтра в массив
        $sendArray = compact("mode", "id", "basicfilter");
        if ($isalive == 1) {
            FormRestore::add("refunds-filter");
        }
        // получим список id счетов по фильтру
        $rrm = new RefundRequestManager();
        $rrIds = $rrm->getFilteredPayIds($sendArray);
        // пейджер
        $perPage = 30;
        $this->addData("perPage", $perPage);
        $this->addData("total", count($rrIds));
        $this->addData("page", Request::getInt("page"));
        $rrIds = FrontPagerControl::limit($rrIds, $perPage, "page");
        if ($rrIds) {
            $rrItems = $rrm->getByIds($rrIds);
            if (is_array($rrItems) && count($rrItems)) {
                $userIds = array();
                foreach ($rrItems AS $rrItem) {
                    $userIds[$rrItem->userId] = $rrItem->userId;
                }
                $userDetailsArray = array();
                $udm = new UserDetailsManager();
                $userDetails = $udm->getByUserIds($userIds);
                if (is_array($userDetails) && count($userDetails)) {
                    foreach ($userDetails AS $userDetail) {
                        $userDetailsArray[$userDetail->userId] = $userDetail;
                    }
                    $this->addData("userDetails", $userDetailsArray);
                }
            }
            $this->addData("rrList", $rrItems);
        }
        $this->addData("rrStatuses", RefundRequest::getStatusDesc());
    }
}