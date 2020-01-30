<?php

/**
 *
 */
class ManageRegisterAttemptsControl extends BaseAdminkaControl {

    public function render() {
        $isalive = Request::getInt("isalive");
        $mode = Request::getVar("mode");

        $phone = Request::getVar("phone");
        $ip = Request::getVar("ip");

        // если не заполнили основные поля формы
        // 1 - выключен, 2 - включен
        if (!$phone && !$ip) {
            $basicfilter = 1;
        } else {
            $basicfilter = 2;
        }

        // свернем переменные фильтра в массив
        $sendArray = compact("mode", "basicfilter", "phone", "ip");

        if ($isalive == 1) {
            FormRestore::add("attempts-filter");
        }

        $ram = new RegisterAttemptManager();
        $attemptIds = $ram->getFilteredAttemptIds($sendArray);

        // пейджер
        $perPage = FrontPagerControl::getLimit();
        $this->addData("perPage", $perPage);
        $this->addData("total", count($attemptIds));
        $this->addData("page", Request::getInt("page"));
        $attemptIds = FrontPagerControl::limit($attemptIds, $perPage, "page");

        if ($attemptIds) {
            $list = $ram->getByIds($attemptIds);
            //deb($list);
            $userPhones = array();
            if (is_array($list) && count($list)) {
                foreach ($list AS $item) {
                    $userPhones[$item->phone] = $item->phone;
                }
                $um = new UserManager();
                $usersByPhones = $um->getByPhones($userPhones);
                $usersByPhonesArray = array();
                if (is_array($usersByPhones) && count($usersByPhones)) {
                    foreach ($usersByPhones AS $userByPhone) {
                        $usersByPhonesArray[$userByPhone->phone] = $userByPhone;
                    }
                }
                $this->addData("usersByPhones", $usersByPhonesArray);
            }

            $this->addData("attemptList", $list);
        }
    }

}
