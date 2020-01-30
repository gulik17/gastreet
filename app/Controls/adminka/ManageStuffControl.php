<?php

/**
 *
 */
class ManageStuffControl extends BaseAdminkaControl {

    public function render() {
        $isalive = Request::getInt("isalive");
        $mode = Request::getVar("mode");

        $id = Request::getInt("userid");
        $phone = Request::getVar("phone");
        $email = Request::getVar("email");

        // если не заполнили основные поля формы
        // 1 - выключен, 2 - включен
        if (!$id && !$phone && !$email) {
            $basicfilter = 1;
        } else {
            $basicfilter = 2;
        }

        // свернем переменные фильтра в массив
        $sendArray = compact("mode", "id", "basicfilter", "phone", "email");

        if ($isalive == 1) {
            FormRestore::add("users-filter");
        }

        // получим список id пользовалтелей по фильтру
        $um = new UserManager();
        $userIds = $um->getFilteredUserIds($sendArray, null, User::TYPE_STAFF);

        // пейджер
        if (!$isalive) {
            $perPage = FrontPagerControl::getLimit();
            $this->addData("perPage", $perPage);
            $this->addData("total", count($userIds));
            $this->addData("page", Request::getInt("page"));
            $userIds = FrontPagerControl::limit($userIds, $perPage, "page");
        }

        if ($userIds) {
            $userList = $um->getByIds($userIds);
            $this->addData("userList", $userList);
        }

        $this->addData("userStatuses", User::getStatusDesc());
    }

}
