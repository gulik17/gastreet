<?php
/** */
class AdminSaveUserDetailsAction extends AdminkaAction {
    public function execute() {
        $id      = FilterInput::add(new IntFilter("id", true, "id"));
        $company = FilterInput::add(new StringFilter("company", true, "Компания"));
        $inn     = FilterInput::add(new StringFilter("inn", false, "ИНН"));
        $kpp     = FilterInput::add(new StringFilter("kpp", false, "КПП"));

        if (!FilterInput::isValid()) {
            FormRestore::add("form");
            $this->goBack(FilterInput::getMessages());
        }

        $udm = new UserDetailsManager();
        $udmObj = $udm->getById($id);
        if (!$udmObj) {
            FormRestore::add("form");
            $this->goBack("Не найден контрагент");
        }

        $udmObj->company = $company;
        $udmObj->inn     = $inn;
        $udmObj->kpp     = $kpp;
        $udmObj = $udm->save($udmObj);
        $this->goBack("Данные сохранены");
    }

    private function goBack($message = '') {
        FormRestore::add("form");
        Adminka::redirectBack($message);
    }
}