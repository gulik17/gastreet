<?php

/**
 * Сохранение реквизитов пользователя
 */
class SaveUserDetailsAction extends AdminkaAction {

    public function execute() {
        $doAct = 'Реквизиты пользователя сохранены';

        $id = FilterInput::add(new StringFilter("id", true, "ID реквизитов"));

        // надо, остальное не надо
        $company = FilterInput::add(new StringFilter("company", true, "Компания"));
        $company_type = (int) FilterInput::add(new StringFilter("company_type", true, "Юридический статус"));
        if ($company_type == 2) { // юр.лицо
            $inn = FilterInput::add(new StringFilter("inn", true, "ИНН"));
            $kpp = FilterInput::add(new StringFilter("kpp", true, "КПП"));
        } elseif ($company_type == 3) { // ИП
            $inn = FilterInput::add(new StringFilter("inn", true, "ИНН"));
            $kpp = FilterInput::add(new StringFilter("kpp", false, "КПП"));
        }
        $rs = FilterInput::add(new StringFilter("rs", true, "р/с"));
        $bank = FilterInput::add(new StringFilter("bank", true, "Банк"));
        $corr = FilterInput::add(new StringFilter("corr", true, "к/с"));
        $bik = FilterInput::add(new StringFilter("bik", true, "БИК"));
        $address = FilterInput::add(new StringFilter("address", true, "Адрес"));

        if (!FilterInput::isValid()) {
            FormRestore::add("user-details");
            Adminka::redirectBack(FilterInput::getMessages());
        }


        $udmObj = null;
        $udm = new UserDetailsManager();
        
        if ($id) {
            $udmObj = $udm->getById($id);
            $udmObj->tsUpdated = time();
            $udmObj->company     = $company;
            $udmObj->company_type= $company_type;
            $udmObj->inn         = $inn;
            $udmObj->kpp         = $kpp;
            $udmObj->rs          = $rs;
            $udmObj->bank        = $bank;
            $udmObj->corr        = $corr;
            $udmObj->bik         = $bik;
            $udmObj->address     = $address;
            $udmObj              = $udm->save($udmObj);
            Adminka::redirect("user&id=" . $udmObj->userId, "Данные были записаны");
        } else {
            Adminka::redirectBack("ID не найден");
        }
    }
}