<?php
/**
 *
*/
class CashBackControl extends IndexControl {
    public $pageTitle = "Кэшбэк — GASTREET 2020";
    public $pageTitle_en = "Cashback — GASTREET 2020";

    public function render() {
        $this->layout = 'cashback.html';
        $this->controlName = "CashBack";
        Enviropment::redirect("/");

        if (isset($_POST['lastname']) && isset($_POST['value'])) { 
            $lastname = Request::getVar("lastname");
            $value = mb_strtolower(Request::getVar("value"));
            $this->addData("lastname", $lastname);
            $this->addData("value", $value);
            $cbm = new CashBackManager();
            $result = null;
            if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $result = $cbm->getByEmail($lastname, $value);
            } else {
                $value = Phone::phoneVerification($value);
                if (!$value["isError"]) {
                    $result = $cbm->getByPhone($lastname, $value["number"]);
                } else {
                    $this->addData("error", 1);
                }
            }
            //deb($result);
            if ($result) {
                $this->addData("result", $result);
            } else {
                $this->addData("error", 1);
            }
        }
    }
}

// Абдрахметов 79882388298 sochidir@zavod-pt.ru