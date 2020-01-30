<?php
/**
 *
 */
class ManageBuyersControl extends BaseAdminkaControl {
    public function render() {
        $isalive = Request::getInt("isalive");
        $mode = Request::getVar("mode");

        $id         = Request::getInt("userid");
        $lastname   = Request::getVar("lastname");
        $name       = Request::getVar("name");
        $phone      = Request::getVar("phone");
        $email      = Request::getVar("email");

        $isDebug = Request::getInt("isDebug");

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
            FormRestore::add("buyers-filter");
        }

	// получим список id пользовалтелей по фильтру
	$um = new UserManager();
	$userIds = $um->getFilteredUserIds($sendArray);

	if ($userIds) {
	    // только те, кто оплатил
            $userIdsNewArray = array();
            $userListNewArray = array();
            $userList = $um->getByIds($userIds);
            
            // оплаченные покупки
            $bm = new BasketManager();
            $bpm = new BasketProductManager();
            // покупки и родители
            $parentIds = array();
            $userAmountArray = array();
            foreach ($userList AS $user) {
                // определим пару userId, childId
                $userId = $user->id;
                $childId = null;
                if ($user->parentUserId) {
                    $userId  = $user->parentUserId;
                    $childId = $user->id;
                }
                if (!$childId) {
                    $tickets  = $bm->getPaidTicketsByUserIdNoChildren($userId);
                    $products = $bpm->getPaidProductsByUserIdNoChildren($userId);
                } else {
                    $tickets  = $bm->getPaidTicketsByChildId($childId);
                    $products = $bpm->getPaidProductsByChildId($childId);
                }

                $totalPrice = 0;
                $userNeedAmount = 0;
                $userPayAmount = 0;
                $userAmount = 0;
                if (is_array($tickets) && count($tickets)) {
                    foreach ($tickets AS $ticket) {
                        $userAmount = $userAmount + $ticket['payAmount'] + $ticket['ulAmount'] - $ticket['returnedAmount'];
                        $userPayAmount = $userPayAmount + $ticket['payAmount'] + $ticket['ulAmount'];
                        $userNeedAmount = $userNeedAmount + $ticket['needAmount'] - $ticket['discountAmount'] + $ticket['returnedAmount'] - $ticket['payAmount'] - $ticket['ulAmount'];
                        $totalPrice = $totalPrice + $ticket['needAmount'];
                    }
                }
                if (is_array($products) && count($products)) {
                    foreach ($products AS $product) {
                        $userAmount = $userAmount + $product['payAmount'] + $product['ulAmount'] - $product['returnedAmount'];
                        $userPayAmount = $userPayAmount + $product['payAmount'] + $product['ulAmount'];
                        $userNeedAmount = $userNeedAmount + $product['needAmount'] - $product['discountAmount'] + $product['returnedAmount'] - $product['payAmount'] - $product['ulAmount'];
                        $totalPrice = $totalPrice + $product['needAmount'];
                    }
                }
                $userAmountArray[$user->id] = $userAmount;
                if ($user->parentUserId) {
                    $parentIds[$user->parentUserId] = $user->parentUserId;
                }
                if ($userPayAmount > 0 || ($totalPrice > 0 && $userNeedAmount == 0)) {
                    $userIdsNewArray[$user->id] = $user->id;
                    $userListNewArray[$user->id] = $user;
                }
            }

            $this->addData("userAmountArray", $userAmountArray);
            if (count($parentIds)) {
                $parentList = $um->getByIds($parentIds);
                $parentListArray = array();
                foreach ($parentList AS $parent) {
                    $parentListArray[$parent->id] = $parent->phone . ' ' . $parent->lastname . ' ' . $parent->name;
                }
                $this->addData("parentList", $parentListArray);
            }
            
            if (!$isalive) {
                // пейджер
                $perPage = FrontPagerControl::getLimit();
                $this->addData("perPage", $perPage);
                $this->addData("total", count($userListNewArray));
                $this->addData("page", Request::getInt("page"));
                $userListNewArray = FrontPagerControl::limit($userListNewArray, $perPage, "page");
            }
            
            // данные
            $this->addData("userList", $userListNewArray);
        }

        $this->addData("userStatuses", User::getStatusDesc());
    }
}