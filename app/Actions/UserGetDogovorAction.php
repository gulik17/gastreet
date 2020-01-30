<?php
/**
*
*/
class UserGetDogovorAction extends AuthorizedUserAction implements IPublicAction
{
	public function execute()
    {
        // проверить заполнен ли профайл пользователя
        UserManager::redirectIfNoProfile($this->actor);

        // проверить есть ли у пользователя QR код
        $qrm = new UserQrCodeManager();
        $qrmObj = $qrm->getOneActiveByUserId($this->actor->id);
        if (!$qrmObj) {
            Enviropment::redirect("basket", "У Вас ещё нет оплаченных товаров");
        }

        // сформировать билет
        $cm = new ContentManager();
        $contentObj = $cm->getByAlias('dogovor');
        if (!$contentObj) {
            Enviropment::redirectBack("Ошибка формирования договора");
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
        $amount     = null;

        // по пользователю
        $um = new UserManager();
        $umObj    = $um->getById($this->actor->id);
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
            "id"         => $id,
            "lastname"   => $lastname,
            "name"       => $name,
            "email"      => $email,
            "phone"      => $phone,
            "country"    => $country,
            "city"       => $city,
            "company"    => $company,
            "position"   => $position,
            "ulcompany"  => $ulcompany,
            "ulcountry"  => $ulcountry,
            "ulcity"     => $ulcity,
            "ulinn"      => $ulinn,
            "ulkpp"      => $ulkpp,
            "ulrs"       => $ulrs,
            "ulbank"     => $ulbank,
            "ulcorr"     => $ulcorr,
            "ulbik"      => $ulbik,
            "uldirector" => $uldirector,
            "ulbuh"      => $ulbuh,
            "amount"     => $amount,
        );

        $message = Enviropment::prepareForMail(MailTextHelper::parseContent($html, $vars));

        // можно теперь отдать pdf
        /*
        $qrLibFileName = APPLICATION_DIR . "/dompdf/dompdf_config.inc.php";
        require_once($qrLibFileName);

        $dompdf = new DOMPDF();// Создаем обьект
        $dompdf->load_html('<html><meta http-equiv="content-type" content="text/html; charset=utf-8" /><body>' . $message . '</body></html>'); // Загружаем в него наш html код
        $dompdf->render(); // Создаем из HTML PDF
        $dompdf->stream('dogovor_' . time() . '.pdf'); // Выводим результат (скачивание)
        */

        // способ #2
        $qrLibFileName = APPLICATION_DIR . "/html2pdf/vendor/autoload.php";
        require_once($qrLibFileName);

        try
        {
            $html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8');
            // $html2pdf->setModeDebug();
            $html2pdf->setDefaultFont('freeserif');
            $html2pdf->writeHTML($message);
            $html2pdf->Output('dogovor_' . time() . '.pdf', 'D');
        }
        catch(HTML2PDF_exception $e) {
            Logger::error("UserGetBiletAction pdf error:");
            Logger::error($e);
            echo "pdf gererate Error!";
        }

        exit;

    }

}
