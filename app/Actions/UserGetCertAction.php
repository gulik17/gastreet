<?php
/**
*
*/
class UserGetCertAction extends AuthorizedUserAction implements IPublicAction {
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

        $bm = new BasketManager();
        if ($user->parentUserId) {
            $purchasedTickets = $bm->getTicketsByChildId($user->id);
        } else {
            $purchasedTickets = $bm->getTicketsByUserIdNoChildren($user->id);
        }

        // проверить есть ли у пользователя QR код
        $qrm = new UserQrCodeManager();
        $qrmObj = $qrm->getOneActiveByUserId($user->id);
        if ( (!$qrmObj) || ($purchasedTickets[0]['status'] != 'STATUS_PAID') ) {
            if ($this->lang == 'en') {
                Enviropment::redirect("basket", "You have no unpaid items", "danger");
            } else {
                Enviropment::redirect("basket", "У Вас ещё нет оплаченных билетов", "danger");
            }
        }

        $message = $um->generateCertHtmlMessage($user->id);

        // можно теперь отдать pdf
        $qrLibFileName = APPLICATION_DIR . "/html2pdf/vendor/autoload.php";
        require_once($qrLibFileName);

        try {
            $html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8');
            // $html2pdf->setModeDebug();
            $html2pdf->setDefaultFont('GastreetFont','TrueTypeUnicode');
            //$fontName = TCPDF_FONTS::addTTFfont('/usr/share/fonts/truetype/liberation/LiberationSans-Regular.ttf', 'TrueTypeUnicode');
            $fontName = 'liberationsans';
            $html2pdf->addFont('LiberationSans','',$fontName);
            $html2pdf->addFont('GastreetFont');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($message);
            $html2pdf->Output('cert_' . time() . '.pdf', 'D');
        }
        catch(HTML2PDF_exception $e) {
            Logger::error("UserGetCertAction pdf error:");
            Logger::error($e);
            echo "pdf gererate Error!";
        }
        exit;
    }
}