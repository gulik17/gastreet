<?php
/**
*
*/
class UserEditDetailsAction extends AuthorizedUserAction implements IPublicAction {
    public function execute() {
        /**
         * Полное наименование, ИНН(10 цифр для юр.лиц или 12 цифр для ИП),
         * КПП только для юрлиц(9 цифр), БИК (9 цифр), Корреспондентский счет (К/сч) (20 цифр),
         * Расчетный счет (Р/сч) (20 цифр). Все ячейки обязательны к заполнению! */

        if ($this->lang == 'en') {
            $id          = FilterInput::add(new StringFilter("id", false, "User ID"));
            $detailsId   = FilterInput::add(new StringFilter("detailsId", false, "Requisites ID"));
            $countryName = FilterInput::add(new StringFilter("countryName", false, "Country"));
            $cityName    = FilterInput::add(new StringFilter("cityName", false, "City"));

            // надо, остальное не надо
            $company     = FilterInput::add(new StringFilter("company", true, "Company"));
            $company_type    = (int) FilterInput::add(new StringFilter("company_type", true, "Legal status"));
            if ($company_type == 2) { // юр.лицо
                if ($countryName == 'kz') {
                    $inn     = FilterInput::add(new StringFilter("inn", true, "INN", 12, 12));
                } else {
                    $inn     = FilterInput::add(new StringFilter("inn", true, "INN", 10, 10));
                }
                $kpp     = FilterInput::add(new StringFilter("kpp", true, "KPP", 9, 9));
            } elseif ($company_type == 3) { // ИП
                $inn     = FilterInput::add(new StringFilter("inn", true, "INN", 12, 12));
                $kpp     = FilterInput::add(new StringFilter("kpp", false, "KPP"));
            }
            $rs          = FilterInput::add(new StringFilter("rs", true, "Account", 20, 20));
            $bank        = FilterInput::add(new StringFilter("bank", true, "Bank"));
            $corr        = FilterInput::add(new StringFilter("corr", true, "Corr. account", 20, 20));
            $bik         = FilterInput::add(new StringFilter("bik", true, "BIK", 9, 9));
            $director    = FilterInput::add(new StringFilter("director", false, "Director of the company"));
            $buh         = FilterInput::add(new StringFilter("buh", false, "Chief Accountant"));
            $address     = FilterInput::add(new StringFilter("address", true, "Address"));
            $total       = FilterInput::add(new StringFilter("total", false, "Amount"));
        } else {
            $id          = FilterInput::add(new StringFilter("id", false, "ID пользователя"));
            $detailsId   = FilterInput::add(new StringFilter("detailsId", false, "ID реквизитов"));
            $countryName = FilterInput::add(new StringFilter("countryName", false, "Страна"));
            $cityName    = FilterInput::add(new StringFilter("cityName", false, "Город"));

            // надо, остальное не надо
            $company     = FilterInput::add(new StringFilter("company", true, "Компания"));
            $company_type    = (int) FilterInput::add(new StringFilter("company_type", true, "Юридический статус"));
            if ($company_type == 2) { // юр.лицо
                if ($countryName == 'kz') {
                    $inn     = FilterInput::add(new StringFilter("inn", true, "ИНН", 12, 12));
                } else {
                    $inn     = FilterInput::add(new StringFilter("inn", true, "ИНН", 10, 10));
                }
                $kpp     = FilterInput::add(new StringFilter("kpp", true, "КПП", 9, 9));
            } elseif ($company_type == 3) { // ИП
                $inn     = FilterInput::add(new StringFilter("inn", true, "ИНН", 12, 12));
                $kpp     = FilterInput::add(new StringFilter("kpp", false, "КПП"));
            }
            $rs          = FilterInput::add(new StringFilter("rs", true, "р/с", 20, 20));
            $bank        = FilterInput::add(new StringFilter("bank", true, "Банк"));
            $corr        = FilterInput::add(new StringFilter("corr", true, "к/с", 20, 20));
            $bik         = FilterInput::add(new StringFilter("bik", true, "БИК", 9, 9));
            $director    = FilterInput::add(new StringFilter("director", false, "Директор компании"));
            $buh         = FilterInput::add(new StringFilter("buh", false, "Гл. бухгалтер"));
            $address     = FilterInput::add(new StringFilter("address", true, "Адрес"));
            $total       = FilterInput::add(new StringFilter("total", false, "Сумма счёта"));
        }
        if (!FilterInput::isValid()) {
            FormRestore::add("user-details");
            Enviropment::redirectBack(FilterInput::getMessages());
        }

        $udmObj = null;
        $udm = new UserDetailsManager();
        if ($detailsId) {
            $udmObj = $udm->getById($detailsId);
            
            if (!$udmObj) {
                if ($this->lang == 'en') {
                    Enviropment::redirect("userdetails&total={$total}", "No details found", "danger");
                } else {
                    Enviropment::redirect("userdetails&total={$total}", "Не найдены реквизиты", "danger");
                }
            } else {
                $udmObj->tsUpdated = time();
            }
        }
        if (!$udmObj) {
            $udmObj = $udm->getByUserId($this->actor->id);
        } else {
            $udmObj->tsUpdated = time();
        }
        if (!$udmObj) {
            $udmObj = new UserDetails();
            $udmObj->userId = $this->actor->id;
            $udmObj->tsCreated = time();
            $udmObj->status = UserDetails::STATUS_NEW;
        }
        $udmObj->company     = $company;
        $udmObj->cityName    = $cityName;
        $udmObj->countryName = $countryName;
        $udmObj->company_type= $company_type;
        $udmObj->inn         = $inn;
        $udmObj->kpp         = $kpp;
        $udmObj->rs          = $rs;
        $udmObj->bank        = $bank;
        $udmObj->corr        = $corr;
        $udmObj->bik         = $bik;
        $udmObj->director    = $director;
        $udmObj->buh         = $buh;
        $udmObj->address     = $address;
        $udmObj              = $udm->save($udmObj);

        // уходим на генерацию счёта на оплату если указана сумма
        if ($total) {
            Enviropment::redirect("invoice?total={$total}");
        } else {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("Details recorded", "success");
            } else {
                Enviropment::redirectBack("Реквизиты записаны", "success");
            }
        }
    }
}