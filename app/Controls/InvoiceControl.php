<?php
/**
 *
 */
class InvoiceControl extends AuthorizedUserControl {
    public $pageTitle = "Выписать счёт";

    public function render() {
        $ts = time();
        $this->addData("ts", $ts);
        $this->addData("host", $this->host);
        $this->addData("actor", $this->actor);
        // по пользователю
        $um    = new UserManager();
        $umObj = $um->getById($this->actor->id);
        // сколько покупатель видел в корзине
        $total = floatval(Request::getVar('total'));
        // сколько по рассчетам
        $needAmount = 0;
        // проверить заполнен ли профайл пользователя
        UserManager::redirectIfNoProfile($this->actor);
        // надо найти сумму по действующему бронированию
        // на эту сумму надо уменьшить стоимость, включить данное число в скидку
        // уменьшать надо после скидки
        $bookbman = new BookingManager();
        // что в корзине по основному билету
        $bm = new BasketManager();
        $purchasedTicketIds = array();

        $purchasedTickets = ($umObj->parentUserId) ? $bm->getTicketsByChildId($this->actor->id) : $bm->getTicketsByUserId($this->actor->id);

        // далее покупка
        if (count($purchasedTickets)) {
            foreach ($purchasedTickets AS $purchasedTicket) {
                if ($purchasedTicket['needAmount'] - $purchasedTicket['payAmount'] - $purchasedTicket['ulAmount'] + $purchasedTicket['returnedAmount'] - $purchasedTicket['discountAmount'] > 0) {
                    $purchasedTicketIds[] = $purchasedTicket['id'];
                    $needTicketAmount = $purchasedTicket['needAmount'] - $purchasedTicket['payAmount'] - $purchasedTicket['ulAmount'] + $purchasedTicket['returnedAmount'] - $purchasedTicket['discountAmount'];

                    // если было бронирование
                    $basket = $bm->getById($purchasedTicket['id']);
                    if ($basket) {
                        $bookings = ($basket->childId) ? $bookbman->getActiveByChildId($basket->childId) : $bookbman->getActiveByUserIdNoChildren($basket->userId);
                        $booking = null;
                        if (isset($bookings[0])) {
                            $booking = $bookings[0];
                            // уменьшим сумму долга
                            $needTicketAmount = $needTicketAmount - $booking->payAmount;
                        }
                        $needTicketAmount = ($needTicketAmount > 0) ? $needTicketAmount : 0;
                    }
                    $needAmount = $needAmount + $needTicketAmount;
                }
            }
        }

        // менеджеры для проверки категории по поводу скидки
        $pm = new ProductManager();
        // что в корзине по мастер-классам
        $bpm = new BasketProductManager();
        $purchasedProductIds = array();
        $purchasedProducts = ($umObj->parentUserId) ? $bpm->getProductsByChildId($this->actor->id) : $bpm->getProductsByUserId($this->actor->id);
        if (count($purchasedProducts)) {
            foreach ($purchasedProducts AS $purchasedProduct) {
                if ($purchasedProduct['needAmount'] - $purchasedProduct['payAmount'] - $purchasedProduct['ulAmount'] + $purchasedProduct['returnedAmount'] - $purchasedProduct['discountAmount'] > 0) {
                    $purchasedProductIds[] = $purchasedProduct['id'];
                    $needProductAmount = $purchasedProduct['needAmount'] - $purchasedProduct['payAmount'] - $purchasedProduct['ulAmount'] + $purchasedProduct['returnedAmount'] - $purchasedProduct['discountAmount'];

                    $basketProduct = $bpm->getById($purchasedProduct['id']);
                    if ($basketProduct) {
                        // если было бронирование
                        $bookings = ($basketProduct->childId) ? $bookbman->getActiveByChildId($basketProduct->childId) : $bookbman->getActiveByUserIdNoChildren($basketProduct->userId);
                        $booking = null;
                        // TODO: если попросят, надо предоставить скидку но только один раз!
                        if (isset($bookings[0])) {
                            $booking = $bookings[0];
                            // уменьшим сумму долга
                            // $needProductAmount = $needProductAmount - $booking->payAmount;
                        }
                        $needProductAmount = ($needProductAmount > 0) ? $needProductAmount : 0;
                    }
                    $needAmount = $needAmount + $needProductAmount;
                }
            }
        }

        // проверить внесены ли данные пользователя для выставления счёта
        $udm = new UserDetailsManager();
        $udmObj = $udm->getByUserId($this->actor->id);
        if (!$udmObj) {
            Enviropment::redirect("userdetails?total={$total}", "Уточните Ваши реквизиты, затем повторите выписку счёта");
        }
        if ($udmObj->company_type == 2) { // Это Юр.лицо
            if ( (!$udmObj->company) || (!$udmObj->inn) ) {
                Enviropment::redirect("userdetails?total={$total}", "Уточните Ваши реквизиты, затем повторите выписку счёта");
            }
        } else if ($udmObj->company_type == 3) { // Это ИП
            if ( (!$udmObj->company) || (!$udmObj->inn) ) {
                Enviropment::redirect("userdetails?total={$total}", "Уточните Ваши реквизиты, затем повторите выписку счёта");
            }
        }

        // это реквизиты плательщика
        $this->addData("udmObj", $udmObj);

        // создаем новую запись в таблице Pay
        $paymObj = null;
        $paym = new PayManager();

        // поиск счёта с такими же параметрами
        $invoices = $paym->getByUserId($this->actor->id);
        if (is_array($invoices) && count($invoices)) {
            foreach ($invoices AS $invoice) {
                if ($invoice->userId == $this->actor->id && $invoice->needAmount == $needAmount && $invoice->status == Pay::STATUS_NEW && $invoice->type == Pay::TYPE_INVOICE && $invoice->payForTicketIds == serialize($purchasedTicketIds) && $invoice->payForProductIds == serialize($purchasedProductIds)) {
                    $paymObj = $invoice;
                    break;
                }
            }
        }

        // не нашли счёт, создадим его
        if (!$paymObj) {
            $paymObj = new Pay();
            $paymObj->userId = $this->actor->id;
            $paymObj->needAmount = $needAmount;
            $paymObj->status = Pay::STATUS_NEW;
            $paymObj->type = Pay::TYPE_INVOICE;
            $paymObj->tsCreated = time();
            $paymObj->payForTicketIds = serialize($purchasedTicketIds);
            $paymObj->payForProductIds = serialize($purchasedProductIds);
            $paymObj = $paym->save($paymObj);

            // Нужно обновить дату добавления продукта (МК) на текущую
            $user_products = $bpm->getByIds($purchasedProductIds);
            if (count($user_products)) {
                foreach ($user_products AS $user_product) {
                    $user_product->tsCreated = time();
                    $bpm->save($user_product);
                }
            }
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
        $company_type   = null;
        $amount     = $needAmount;

        // параметры
        $id       = $umObj->id;
        $lastname = $umObj->lastname;
        $name     = $umObj->name;
        $email    =($umObj->confirmedEmail) ? $umObj->confirmedEmail : $umObj->email;
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
            $ulinn      = 'ИНН: '.$udmObj->inn;
            if ($udmObj->company_type == 2) {
                $ulkpp = 'КПП: '.$udmObj->kpp;
            } else {
                $ulkpp = '';
            }
            //$company_type = ($udmObj->company_type == 2) ? "Юридическое лицо" : "Индивидуальный предприниматель";
            $ulrs       = 'Расчетный счет: '.$udmObj->rs;
            $ulbank     = 'банк: '.$udmObj->bank;
            $ulcorr     = 'кор. счет: '.$udmObj->corr;
            $ulbik      = 'БИК: '.$udmObj->bik;
            $uldirector = $udmObj->director;
            $ulbuh      = $udmObj->buh;
        }

        $html = str_replace("&quot;", '"', htmlspecialchars_decode($contentObj->text, ENT_NOQUOTES));
        $html = str_replace("&#123;", "{", $html);
        $html = str_replace("&#125;", "}", $html);

        // заменить параметры в шаблоне
        $vars = [
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
            "company_type"  => $company_type,
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
            "site"          => Configurator::get('application:url'),
        ];
        //$message = MailTextHelper::parseContent($html, $vars);

        $message = Enviropment::prepareForMail(MailTextHelper::parseContent($html, $vars));

        // Формируем PDF и отдаем
        $qrLibFileName = APPLICATION_DIR . "/html2pdf/vendor/autoload.php";
        require_once($qrLibFileName);

        try {
            $html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8');
            $html2pdf->setDefaultFont('freeserif');
            $html2pdf->writeHTML($message);
            $html2pdf->Output('schet_' . time() . '.pdf', 'D');
            //Enviropment::redirect("basket", "Счет успешно сформирован!");
        }
        catch(HTML2PDF_exception $e) {
            Logger::error("UserGetBiletAction pdf error:");
            Logger::error($e);
            echo "pdf gererate Error!";
        }
    }
}