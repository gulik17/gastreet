<?php 
/**
*/
class BuyerControl extends BaseAdminkaControl {
    public $pageTitle = "Работа с пользователем";

    public function render() {
        $userId = Request::getInt("id");
        if (!$userId) {
            Adminka::redirect("manageusers", "Не указан ID пользователя");
        }
        $um = new UserManager();
        $user = $um->getById($userId);
        if (!$user) {
            Adminka::redirect("manageusers", "Пользователь не найден");
        }
        if ($user->parentUserId) {
            $parentObj = $um->getById($user->parentUserId);
            $this->addData("parentObj", $parentObj);
        }
        $this->addData("user", $user);
        $this->addData("userStatuses", User::getStatusDesc());
        // реквизиты для выставления счетов
        $udm = new UserDetailsManager();
        $udmObj = $udm->getByUserId($userId);
        $this->addData("udmObj", $udmObj);
        // реквизиты родителя
        if ($user->parentUserId) {
            $parentDetailsObj = $udm->getByUserId($user->parentUserId);
            $this->addData("parentDetailsObj", $parentDetailsObj);
        }
        // qr код
        $qrm = new UserQrCodeManager();
        $qrmObj = $qrm->getOneActiveByUserId($userId);
        if ($qrmObj) {
            $this->addData("qrmObj", $qrmObj);
        }
        // купоны на скидку
        $dm = new DiscountManager();
        $dmList = $dm->getByUserId($userId);
        $this->addData("dmList", $dmList);
        // места проведения (для отображения скидок)
        $am = new AreaManager();
        $amList = $am->getAll();
        if (is_array($amList) && count($amList)) {
            $amArray = array();
            foreach ($amList AS $amItem) {
                $amArray[$amItem->id] = $amItem;
            }
            $this->addData("amArray", $amArray);
        }
        // статусы и типы скидок
        $this->addData("discountStatuses", Discount::getStatusDesc());
        $this->addData("discountTypes", Discount::getTypeDesc());
        // оплаченные покупки
        $bm = new BasketManager();
        $bpm = new BasketProductManager();
        // определим пару userId, childId
        $userId = $user->id;
        $childId = null;
        if ($user->parentUserId) {
            $userId  = $user->parentUserId;
            $childId = $user->id;
        }
        // оплаты, сделанные пользователем
        $pm = new PayManager();
        if (!$childId) {
            $tickets  = $bm->getPaidTicketsByUserIdNoChildren($userId);
            $products = $bpm->getPaidProductsByUserIdNoChildren($userId);
            $payments = $pm->getByUserIdAndStatus($userId);
        } else {
            $tickets  = $bm->getPaidTicketsByChildId($childId);
            $products = $bpm->getPaidProductsByChildId($childId);
            $payments = $pm->getByUserIdAndStatus($childId);
        }
        $this->addData("tickets", $tickets);
        $this->addData("products", $products);
        // типы оплаты
        $this->addData("paymentTypes", Pay::getTypeDesc());
        // примененные купоны на скидку приделаем к оплатам
        $dm = new DiscountManager();
        $paymentsArray = array();
        if (is_array($payments) && count($payments)) {
            foreach ($payments AS $payment) {
                $discountId      = null;
                $discountCode    = null;
                $discountPercent = null;
                $discountType    = null;
                $discountStatus  = null;
                if ($payment->discountId) {
                    $discount = $dm->getById($payment->discountId);
                    if ($discount) {
                        $discountId      = $discount->id;
                        $discountCode    = $discount->code;
                        $discountPercent = $discount->percent;
                        $discountType    = $discount->type;
                        $discountStatus  = $discount->status;
                    }
                }
                $payment->discountId      = $discountId;
                $payment->discountCode    = $discountCode;
                $payment->discountPercent = $discountPercent;
                $payment->discountType    = $discountType;
                $payment->discountStatus  = $discountStatus;
                $paymentsArray[] = $payment;
            }
            $this->addData("payments", $paymentsArray);
        }
        // статусы и типы купонов
        $this->addData("discountTypes", Discount::getTypeDesc());
        $this->addData("discountStatuses", Discount::getStatusDesc());
        // типы пользователей
        $utm = new UserTypeManager();
        $utmList = $utm->getAll();
        if (is_array($utmList) && count($utmList)) {
            $userTypes = array();
            foreach ($utmList AS $utmItem) {
                $userTypes[$utmItem->id] = $utmItem->name;
            }
            $this->addData("userTypes", $userTypes);
        }
        // бронирования пользователя
        $ts = time();
        $this->addData("ts", $ts);
        $bookman = new BookingManager();
        if ($user->parentUserId) {
            // это доп. участник
            $bookings = $bookman->getByChildId($user->id);
        } else {
            // основной
            $bookings = $bookman->getByUserIdNoChildren($user->id);
        }
        $this->addData("bookings", $bookings);
    }
}