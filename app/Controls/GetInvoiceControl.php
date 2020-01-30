<?php
/**
 *
 */
class GetInvoiceControl extends AuthorizedUserControl {
    public $pageTitle = "Счёт по ID";

    public function render() {
        $id = Request::getInt('id');

        // создаем новую запись в таблице Pay
        $paymObj = null;
        $paym = new PayManager();
        $paymObj = $paym->getById($id);

        $um = new UserManager();
        $umObj = $um->getById($paymObj->userId);

        // не нашли счёт, создадим его
        if (!$paymObj) {
            echo "no invoice found";
            exit;
        }

        // показать выставленный счёт на оплату
        $this->addData("paymObj", $paymObj);

        // сейчас отдадим счёт как документ pdf
        // сформировать билет
        $cm = new ContentManager();
        $contentObj = $cm->getByAlias('schet');
        if (!$contentObj) {
            Enviropment::redirectBack("Ошибка формирования счёта");
        }

        // отдать pdf
        // подготовка параметров для шаблона
        // по реквизитам для выставления счёта
        $ulcompany  = null;
        $ulcountry  = null;
        $ulcity     = null;
        $ulinn      = null;
        $ulkpp      = null;
        $ulrs       = null;
        $ulbank     = null;
        $ulcorr     = null;
        $ulbik      = null;
        $uldirector = null;
        $ulbuh      = null;
        $amount     = $paymObj->needAmount;

        // параметры
        $id       = $umObj->id;
        $lastname = $umObj->lastname;
        $name     = $umObj->name;
        $email    = ($umObj->confirmedEmail) ? $umObj->confirmedEmail : $umObj->email;
        $phone    = $umObj->phone;
        $country  = $umObj->countryName;
        $city     = $umObj->cityName;
        $company  = $umObj->company;
        $position = $umObj->position;

        // данные по реквизитам
        $udm = new UserDetailsManager();
        $udmObj = $udm->getByUserId($this->actor->id);
        if ($udmObj) {
            $ulcompany  = $udmObj->company;
            $ulcountry  = $udmObj->countryName;
            $ulcity     = $udmObj->cityName;
            $ulinn      = $udmObj->inn;
            $ulkpp      = $udmObj->kpp;
            $ulrs       = $udmObj->rs;
            $ulbank     = $udmObj->bank;
            $ulcorr     = $udmObj->corr;
            $ulbik      = $udmObj->bik;
            $uldirector = $udmObj->director;
            $ulbuh      = $udmObj->buh;
        }

        $html = str_replace("&quot;", '"', htmlspecialchars_decode($contentObj->text, ENT_NOQUOTES));
        $html = str_replace("&#123;", "{", $html);
        $html = str_replace("&#125;", "}", $html);

        // заменить параметры в шаблоне
        $vars = array(
            "id"            => $id,
            "lastname"      => $lastname,
            "name"          => $name,
            "email"         => $email,
            "phone"         => $phone,
            "country"       => $country,
            "city"          => $city,
            "company"       => $company,
            "position"      => $position,
            "ulcompany"     => $ulcompany,
            "ulcountry"     => $ulcountry,
            "ulcity"        => $ulcity,
            "ulinn"         => $ulinn,
            "ulkpp"         => $ulkpp,
            "ulrs"          => $ulrs,
            "ulbank"        => $ulbank,
            "ulcorr"        => $ulcorr,
            "ulbik"         => $ulbik,
            "uldirector"    => $uldirector,
            "ulbuh"         => $ulbuh,
            "amount"        => $amount,
            "amountinwords" => Utility::num2str($amount),
            "invoice"       => $paymObj->id,
            "invoicedate"   => Utility::dateFormat($paymObj->tsCreated, "d M Y"),
        );

        $message = Enviropment::prepareForMail(MailTextHelper::parseContent($html, $vars));
        
        

        // можно теперь отдать pdf
        $qrLibFileName = APPLICATION_DIR . "/html2pdf/vendor/autoload.php";
        require_once($qrLibFileName);

        try {
            $html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8');
            // $html2pdf->setModeDebug();
            $html2pdf->setDefaultFont('freeserif');
            $html2pdf->writeHTML($message);
            $html2pdf->Output('schet_' . time() . '.pdf', 'D');
        } catch(HTML2PDF_exception $e) {
            Logger::error("UserGetBiletAction pdf error:");
            Logger::error($e);
            echo "pdf gererate Error!";
        }
        exit;
    }
}