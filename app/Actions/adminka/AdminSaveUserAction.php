<?php
/**
 *
 */
class AdminSaveUserAction extends AdminkaAction {
    public function execute() {
        $id = Request::getInt("id");
        $umObj = null;
        $um = new UserManager();
        if ($id) {
            //Adminka::redirectBack("Не указан ID пользователя");
            $umObj = $um->getById($id);
        } else {
            $umObj = new User();
            //Adminka::redirectBack("Пользователь не найден");
        }

        // принятые данные
        $phone          = Phone::phoneVerification(Request::getVar("phone"));
        $email          = Request::getVar("email");
        $confirmedEmail = Request::getVar("confirmedEmail");
        $lastname       = Request::getVar("lastname");
        $name           = Request::getVar("name");
        $code           = Request::getVar("code");
        $countryName    = Request::getVar("countryName");
        $cityName       = Request::getVar("cityName");
        $company        = preg_replace('/\&quot;([^\"]*)\&quot;/ismU', "«$1»", Request::getVar("company"));
        $position       = Request::getVar("position");
        $type           = Request::getInt("type");
        $hasEdit        = Request::getInt("hasEdit");
        $parentUserId   = Request::getInt("parentUserId");
        $userInfo       = Request::getVar("userInfo");

        $parentUserId = ($parentUserId === 0) ? null : $parentUserId;

        if ($phone["isError"]) {
            FormRestore::add("form");
            Adminka::redirectBack("Не верный формат номера");
        } else {
            $phone = $phone["number"];
        }
        if (!$phone || !$email) {
            FormRestore::add("form");
            Adminka::redirectBack("Введены не все обязательные поля");
        }

        // проверить не повторяется ли введенный phone
        $userByPhone = $um->getByPhone($phone);
        if ($userByPhone && $userByPhone->id != $id) {
            FormRestore::add("form");
            Adminka::redirectBack("Указанный Вами номер телефона уже указан у другого пользователя ID {$userByPhone->id}");
        }

        // проверить не повторяется ли введенный е-майл
        $userByEmail = $um->getByEmail($email);
        if ($userByEmail && $userByEmail->id != $id) {
            FormRestore::add("form");
            Adminka::redirectBack("Указанный Вами e-mail уже указан у другого пользователя ID {$userByEmail->id}");
        }

        // проверить не повторяется ли введенный подтвержденный е-майл
        $userByConfirmedEmail = $um->getByConfirmedEmail($confirmedEmail);
        if ($userByConfirmedEmail && $userByConfirmedEmail->id != $id) {
            FormRestore::add("form");
            Adminka::redirectBack("Указанный Вами <b>подтвержденный</b> e-mail уже указан у другого пользователя ID {$userByConfirmedEmail->id}");
        }
        
        // Если нет ID значит добавляется новый пользователь и ему необходимо добавить Статус и Время регистрации
        if (!$id) {
            $umObj->status = User::STATUS_REGISTERED;
            $umObj->tsRegister = time();
            $umObj->tsCreated = time();
        }

        // всё ок, можно сохранять
        $umObj->phone          = $phone;
        $umObj->email          = $email;
        $umObj->confirmedEmail = $confirmedEmail;
        $umObj->lastname       = $lastname;
        $umObj->name           = $name;
        $umObj->code           = $code;
        $umObj->countryName    = $countryName;
        $umObj->cityName       = $cityName;
        $umObj->company        = $company;
        $umObj->position       = $position;
        $umObj->typeId         = $type;
        $umObj->hasEdit        = $hasEdit;
        $umObj->parentUserId   = $parentUserId;
        $umObj->userInfo       = $userInfo;
        $umObj = $um->save($umObj);
        // обновить QR код
        $qrmObj = UserManager::createQrCode($umObj->id);
        
        $mes = UserManager::updateUser4App($umObj);
        
        usleep(1500);
        Adminka::redirect("user&id=" . $umObj->id, "Данные были записаны<br>$mes");
    }
}