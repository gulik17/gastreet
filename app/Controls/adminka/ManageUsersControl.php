<?php
/**
 * Контрол для представления формы управления пользователями
 * 
 */
class ManageUsersControl extends BaseAdminkaControl {
    public function render() {
        $isalive = Request::getInt("isalive");
        $mode = Request::getVar("mode");

	    $id       = Request::getInt("userid");
	    $lastname = Request::getVar("lastname");
        $name     = Request::getVar("name");
        $phone    = Request::getVar("phone");
	    $email    = Request::getVar("email");

	    // если не заполнили основные поля формы
	    // 1 - выключен, 2 - включен
	    if (!$id && !$lastname && !$name && !$phone && !$email) {
            $basicfilter = 1;
        } else {
            $basicfilter = 2;
        }

	    // свернем переменные фильтра в массив
	    $sendArray = compact("mode", "id", "basicfilter", "lastname", "name", "phone", "email");

        if ($isalive == 1) {
            FormRestore::add("users-filter");
        }

        // получим список id пользовалтелей по фильтру
        $um = new UserManager();
        $userIds = $um->getFilteredUserIds($sendArray);

	    // пейджер
        if (!$isalive) {
            $perPage = FrontPagerControl::getLimit();
            $this->addData("perPage", $perPage);
            $this->addData("total", count($userIds));
            $this->addData("page", Request::getInt("page"));
            $userIds = FrontPagerControl::limit($userIds, $perPage, "page");
        }

	    if ($userIds) {
            //deb($userIds);
            $btm = new BaseTicketManager();
            $userList = $um->getByIds($userIds);
            $this->addData("userList", $userList);
            $parentIds = array();
            foreach ($userList AS &$user) {
                if ($user->parentUserId) {
                    $parentIds[$user->parentUserId] = $user->parentUserId;
                }
                if ($user->baseTicketId) {
                    $user->baseTicket = $btm->getById($user->baseTicketId)->name;
                }
            }
            if (count($parentIds)) {
                $parentList = $um->getByIds($parentIds);
                $parentListArray = array();
                foreach ($parentList AS $parent) {
                    $parentListArray[$parent->id] = $parent->phone . ' ' . $parent->lastname . ' ' . $parent->name;
                }
                $this->addData("parentList", $parentListArray);
            }
        }
        $this->addData("userStatuses", User::getStatusDesc());
    }
}