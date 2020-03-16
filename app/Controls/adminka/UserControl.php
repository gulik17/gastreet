<?php

/**
 * Контрол для представления данные пользователя
 */
class UserControl extends BaseAdminkaControl {
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

        $this->addData("country", $this->country);

        if ($user->parentUserId) {
            $parentObj = $um->getById($user->parentUserId);
            $this->addData("parentObj", $parentObj);
        }
        if ($user->email) {
            require_once APPLICATION_DIR .'/Lib/Swift/Mail.php';
            $checkResult = Mail::checkUnsubscribe($user->email);
            $user->checkUnsubscribe = ($checkResult->is_unsubscribed) ? ' <i class="fa fa-times-circle" aria-hidden="true"></i>' : ' <i class="fa fa-check-circle" aria-hidden="true"></i>';
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
        //deb($qrm->getHost());
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

        // оплаченные покупки
        $bm = new BasketManager();
        $bpm = new BasketProductManager();

        // определим пару userId, childId
        $userId = $user->id;
        $childId = null;
        if ($user->parentUserId) {
            $userId = $user->parentUserId;
            $childId = $user->id;
        }

        // оплаты, сделанные пользователем
        $pm = new PayManager();
        $pbm = new PayBalanceManager();

        if (!$childId) {
            $tickets = $bm->getAllTicketsByUserIdNoChildren($userId);
            $products = $bpm->getAllProductsByUserIdNoChildren($userId);
            $payments = $pm->getByUserIdAndStatus($userId);
            $paymentsBalance = $pbm->getByUserIdAndStatus($userId);
        } else {
            $tickets = $bm->getAllTicketsByChildId($childId);
            $products = $bpm->getAllProductsByChildId($childId);
            $payments = $pm->getByUserIdAndStatus($childId);
            $paymentsBalance = $pbm->getByUserIdAndStatus($childId);
        }

        //deb($paymentsBalance);
        if ($paymentsBalance && $payments) {
            $payments = array_merge($payments, $paymentsBalance);
        } else if ($paymentsBalance) {
            $payments = $paymentsBalance;
        }

        $this->addData("tickets", $tickets);
        $this->addData("products", $products);

        // статусы в корзине
        $this->addData("basketStatuses", Basket::getStatusDesc());
        $this->addData("basketProductStatuses", BasketProduct::getStatusDesc());

        // типы оплаты
        $this->addData("paymentTypes", Pay::getTypeDesc());

        // примененные купоны на скидку приделаем к оплатам
        $dm = new DiscountManager();
        $paymentsArray = array();
        if (is_array($payments) && count($payments)) {
            foreach ($payments AS $payment) {
                $discountId = null;
                $discountCode = null;
                $discountPercent = null;
                $discountType = null;
                $discountStatus = null;
                if ($payment->entityTable != 'payBalance' ) {
                    if ($payment->discountId) {
                        $discount = $dm->getById($payment->discountId);
                        if ($discount) {
                            $discountId = $discount->id;
                            $discountCode = $discount->code;
                            $discountPercent = $discount->percent;
                            $discountType = $discount->type;
                            $discountStatus = $discount->status;
                        }
                    }
                } else {
                    $payment->type = Pay::TYPE_BALANCE;
                }
                $payment->discountId = $discountId;
                $payment->discountCode = $discountCode;
                $payment->discountPercent = $discountPercent;
                $payment->discountType = $discountType;
                $payment->discountStatus = $discountStatus;

                $paymentsArray[] = $payment;
            }
            //deb($paymentsArray);
            $this->addData("payments", $paymentsArray);
        }

        // статусы и типы скидок
        $this->addData("discountStatuses", Discount::getStatusDesc());
        $this->addData("discountTypes", Discount::getTypeDesc());

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