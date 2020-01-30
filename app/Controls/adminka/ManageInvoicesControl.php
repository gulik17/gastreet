<?php
/**
 *
 */
class ManageInvoicesControl extends BaseAdminkaControl {
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
            FormRestore::add("invoices-filter");
        }
        // получим список id счетов по фильтру
        $pm = new PayManager();
        $payIds = $pm->getFilteredPayIds($sendArray);
        
        // Пагинация
        $perPage = FrontPagerControl::getLimit();
        $this->addData("perPage", $perPage);
        $this->addData("total", count($payIds));
        $this->addData("page", Request::getInt("page"));
        $payIds = FrontPagerControl::limit($payIds, $perPage, "page");
        if ($payIds) {
            $payItems = $pm->getByIds($payIds);
            if (is_array($payItems) && count($payItems)) {
                $userIds = array();
                foreach ($payItems AS $payItem) {
                    $userIds[$payItem->userId] = $payItem->userId;
                }
                // реквизиты
                $userDetailsArray = array();
                $udm = new UserDetailsManager();
                $userDetails = $udm->getByUserIds($userIds);
                if (is_array($userDetails) && count($userDetails)) {
                    foreach ($userDetails AS $userDetail) {
                        $userDetailsArray[$userDetail->userId] = $userDetail;
                    }
                    $this->addData("userDetails", $userDetailsArray);
                }
                // данные пользователя
                $usersArray = array();
                $um = new UserManager();
                $users = $um->getByIds($userIds);
                if (is_array($users) && count($users)) {
                    foreach ($users AS $user) {
                        $usersArray[$user->id] = $user;
                    }
                    $this->addData("users", $usersArray);
                }
            }
            $this->addData("payList", $payItems);
        }
        $this->addData("payStatuses", Pay::getStatusDesc());
    }
}