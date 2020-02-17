<?php

/**
 *
 */
class UserGetHotelKuponAction extends AuthorizedUserAction implements IPublicAction {

    public function execute() {
        // проверить заполнен ли профайл пользователя
        UserManager::redirectIfNoProfile($this->actor);

        $um = new UserManager();
        $user = $this->actor;
        // билет на child
        $id = Request::getInt("id");
        if ($id) {
            $userObj = $um->getById($id);
            if ($userObj && $userObj->parentUserId == $user->id) {
                $user = $userObj;
            }
        }

        // проверить есть ли у пользователя QR код
        $qrm = new UserQrCodeManager();
        $qrmObj = $qrm->getOneActiveByUserId($user->id);
        if (!$qrmObj) {
            if ($this->lang == 'en') {
                Enviropment::redirect("basket", "You have no unpaid items", "danger");
            } else {
                Enviropment::redirect("basket", "У Вас ещё нет оплаченных товаров", "danger");
            }
        }

        // сформировать
        $cm = new ContentManager();
        $contentObj = $cm->getByAlias('hotelkupon');
        if (!$contentObj) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("Coupon issuance error", "danger");
            } else {
                Enviropment::redirectBack("Ошибка формирования купона", "danger");
            }
        }

        // отдать pdf
        // подготовка параметров для шаблона
        // по реквизитам для выставления счёта
        $ulcompany = null;
        $ulcountry = null;
        $ulcity = null;
        $ulinn = null;
        $ulkpp = null;
        $ulrs = null;
        $ulbank = null;
        $ulcorr = null;
        $ulbik = null;
        $uldirector = null;
        $ulbuh = null;
        $amount = null;
        $site = Configurator::get("application:url");

        // по пользователю
        $um = new UserManager();
        $umObj = $um->getById($user->id);
        // параметры
        $id = $umObj->id;
        $lastname = $umObj->lastname;
        $name = $umObj->name;
        $email = ($umObj->confirmedEmail) ? $umObj->confirmedEmail : $umObj->email;
        $phone = $umObj->phone;
        $country = $umObj->countryName;
        $city = $umObj->cityName;
        $company = $umObj->company;
        $position = $umObj->position;

        // данные по реквизитам
        $udm = new UserDetailsManager();
        $udmObj = $udm->getByUserId($user->id);
        if ($udmObj) {
            $ulcompany = $udmObj->company;
            $ulcountry = $udmObj->countryName;
            $ulcity = $udmObj->cityName;
            $ulinn = $udmObj->inn;
            $ulkpp = $udmObj->kpp;
            $ulrs = $udmObj->rs;
            $ulbank = $udmObj->bank;
            $ulcorr = $udmObj->corr;
            $ulbik = $udmObj->bik;
            $uldirector = $udmObj->director;
            $ulbuh = $udmObj->buh;
        }

        if ($this->lang == 'en') {
            $html = str_replace("&quot;", '"', htmlspecialchars_decode($contentObj->text_en, ENT_NOQUOTES));
        } else {
            $html = str_replace("&quot;", '"', htmlspecialchars_decode($contentObj->text, ENT_NOQUOTES));
        }
        $html = str_replace("&#123;", "{", $html);
        $html = str_replace("&#125;", "}", $html);

        // сумма, оплаченная за билеты
        $amount = 0;
        // что в корзине по основному билету
        $bm = new BasketManager();
        if ($user->parentUserId) {
            $purchasedTickets = $bm->getTicketsByChildId($user->id);
        } else {
            $purchasedTickets = $bm->getTicketsByUserIdNoChildren($user->id);
        }
        if (is_array($purchasedTickets) && count($purchasedTickets)) {
            foreach ($purchasedTickets AS $oneTicket) {
                $amount = $amount + ($oneTicket['payAmount'] + $oneTicket['ulAmount'] + $oneTicket['discountAmount'] - $oneTicket['returnedAmount']);
            }
        }
        // что в корзине по мастер-классам
        $bpm = new BasketProductManager();
        if ($user->parentUserId) {
            $purchasedProducts = $bpm->getProductsByChildId($user->id);
        } else {
            $purchasedProducts = $bpm->getProductsByUserIdNoChildren($user->id);
        }
        if (is_array($purchasedProducts) && count($purchasedProducts)) {
            foreach ($purchasedProducts AS $oneProduct) {
                $amount = $amount + ($oneProduct['payAmount'] + $oneProduct['ulAmount'] + $oneProduct['discountAmount'] - $oneProduct['returnedAmount']);
            }
        }

        // можно ли печатать купон
        if ( (!$amount) || ($purchasedTickets[0]['status'] != 'STATUS_PAID') ) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("Please pay for your ticket", "danger");
            } else {
                Enviropment::redirectBack("Оплатите билет", "danger");
            }
        }

        if ( ($purchasedTickets[0]['baseTicketId'] == 1) || ($purchasedTickets[0]['baseTicketId'] == 14) ) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("Your ticket does not include a voucher", "danger");
            } else {
                Enviropment::redirectBack("В ваш билет не входит купон на проживание", "danger");
            }
        }

        // заменить параметры в шаблоне
        $vars = array(
            "id" => $id,
            "lastname" => $lastname,
            "name" => $name,
            "email" => $email,
            "phone" => $phone,
            "country" => $country,
            "city" => $city,
            "company" => $company,
            "position" => $position,
            "ulcompany" => $ulcompany,
            "ulcountry" => $ulcountry,
            "ulcity" => $ulcity,
            "ulinn" => $ulinn,
            "ulkpp" => $ulkpp,
            "ulrs" => $ulrs,
            "ulbank" => $ulbank,
            "ulcorr" => $ulcorr,
            "ulbik" => $ulbik,
            "uldirector" => $uldirector,
            "ulbuh" => $ulbuh,
            "amount" => $amount,
            "site" => $site,
            "ticket" => $purchasedTickets[0]['baseTicketName'],
        );

        $message = Enviropment::prepareForMail(MailTextHelper::parseContent($html, $vars));

       // echo $message;
        //die();
        // можно теперь отдать pdf
        $qrLibFileName = APPLICATION_DIR . "/html2pdf/vendor/autoload.php";
        require_once($qrLibFileName);

        try {
            $html2pdf = new HTML2PDF('P', 'A4', 'en', true);
            //$html2pdf->addFont('arial', '', 'arial');
            $html2pdf->setDefaultFont('dejavusans');
            $html2pdf->writeHTML($message);
            $html2pdf->Output('kupon_' . time() . '.pdf', 'D');
        } catch (HTML2PDF_exception $e) {
            Logger::error("UserGetBiletAction pdf error:");
            Logger::error($e);
            echo "pdf gererate Error!";
        }
        exit;
    }
}