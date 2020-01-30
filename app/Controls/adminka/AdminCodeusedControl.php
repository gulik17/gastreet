<?php
/**
  *
 */
class AdminCodeusedControl extends BaseAdminkaControl
{
	public function render()
	{
        $id = Request::getInt("id");
		$dm = new DiscountManager();
        $discount = $dm->getById($id);

        // кто использовал
        $userIds = array();
        $bm = new BasketManager();
        $baskets = $bm->getByDiscountId($id);
        if (is_array($baskets) && count($baskets)) {
            foreach ($baskets AS $basket) {
                // $userIds
                if ($basket->childId) {
                    $userIds[] = $basket->childId;
                }
                else {
                    $userIds[] = $basket->userId;
                }
            }
        }

        $um = new UserManager();
        if (count($userIds)) {
            $users = $um->getByIds($userIds);
            $this->addData("users", $users);
        }

		$this->addData("discount", $discount);
        $this->addData("statuses", Discount::getStatusDesc());
        $this->addData("types", Discount::getTypeDesc());
	}

}
