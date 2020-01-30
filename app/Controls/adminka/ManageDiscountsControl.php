<?php
/**
  *
 */
class ManageDiscountsControl extends BaseAdminkaControl {
    public function render() {
        $dm = new DiscountManager();
        $list = $dm->getAll("id DESC");
        if (is_array($list) && count($list)) {
            $userIds = array();
            foreach ($list AS $discount) {
                if ($discount->userId) {
                    $userIds[$discount->userId] = $discount->userId;
                }
            }

            // пейджер
            $perPage = FrontPagerControl::getLimit();
            $this->addData("perPage", $perPage);
            $this->addData("total", count($list));
            $this->addData("page", Request::getInt("page"));
            $list = FrontPagerControl::limit($list, $perPage, "page");

            if (is_array($userIds) && count($userIds)) {
                $um = new UserManager();
                $users = $um->getByIds($userIds);
                if (is_array($users) && count($users)) {
                    $usersArray = array();
                    foreach ($users AS $user) {
                        $usersArray[$user->id] = $user;
                    }
                    $this->addData("users", $usersArray);
                }
            }
        }

        $this->addData("discounts", $list);
        $this->addData("statuses", Discount::getStatusDesc());
        $this->addData("types", Discount::getTypeDesc());
    }
}