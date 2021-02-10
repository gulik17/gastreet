<?php
/**
 *
*/
class QuickAdminControl extends IndexControl {
    public $pageTitle = "QuickAdmin — GASTREET 2021";
    public $pageTitle_en = "QuickAdmin — GASTREET 2021";

    public function render() {
        $this->layout = 'index.html';
        $this->controlName = "QuickAdmin";

        if (isset($_POST['phone'])) {
            $phone = Request::getVar("phone");
            $this->addData("phone", $phone);
            $um = new UserManager();
            $result = null;
            $phone = Phone::phoneVerification($phone);
            if (!$phone["isError"]) {
                $user = $um->getByPhone($phone["number"]);
                if ($user) {
                    $qrm = new UserQrCodeManager();
                    $qrmObj = $qrm->getOneActiveByUserId($user->id);
                    $this->addData("qrmObj", $qrmObj);
                    
                    $bm = new BasketManager();
                    $bpm = new BasketProductManager();
                    $result = (array) $user;
                    $this->addData("result", $result);
                    if ($user->parentUserId) {
                        // значит это доп участник
                        $tickets = $bm->getTicketsByChildId($user->id);
                        $products = $bpm->getProductsByChildId($user->id);
                    } else {
                        // значит это основной
                        $tickets = $bm->getTicketByUserId($user->id);
                        $products = $bpm->getProductsByUserIdNoChildren($user->id);
                    }
                    if ($tickets) {
                        $tickets = $tickets[0];
                        $this->addData("tickets", $tickets);
                    }
                    if ($products) {
                        //$products = $products[0];
                        //deb($products);
                        $this->addData("products", $products);
                    }
                }
            }
            //deb($result);
        }
    }
}