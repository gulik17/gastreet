<?php

/**
 * Добавить участника
 *
 */
class AddParticipantAction extends AuthorizedUserAction implements IPublicAction {
    public function execute() {
        // проверить заполнен ли профайл данного пользователя
        UserManager::redirectIfNoProfile($this->actor);

        if ($this->lang == 'en') {
            $id = FilterInput::add(new StringFilter("id", false, "User ID"));   // актор
            $phone = FilterInput::add(new StringFilter("phone", true, "Phone"));
            $email = FilterInput::add(new StringFilter("email", true, "E-Mail"));
            $name = FilterInput::add(new StringFilter("name", true, "Name"));
            $lastname = FilterInput::add(new StringFilter("lastname", true, "Last Name"));
            $countryName = FilterInput::add(new StringFilter("countryName", true, "Country"));
            $cityName = FilterInput::add(new StringFilter("cityName", true, "City"));
            $company = FilterInput::add(new StringFilter("company", true, "Company"));
            $position = FilterInput::add(new StringFilter("position", true, "Position"));
        } else {
            $id = FilterInput::add(new StringFilter("id", false, "ID пользователя"));   // актор
            $phone = FilterInput::add(new StringFilter("phone", true, "Номер мобильного"));
            $email = FilterInput::add(new StringFilter("email", true, "E-Mail"));
            $name = FilterInput::add(new StringFilter("name", true, "Имя"));
            $lastname = FilterInput::add(new StringFilter("lastname", true, "Фамилия"));
            $countryName = FilterInput::add(new StringFilter("countryName", true, "Страна"));
            $cityName = FilterInput::add(new StringFilter("cityName", true, "Город"));
            $company = FilterInput::add(new StringFilter("company", true, "Компания"));
            $position = FilterInput::add(new StringFilter("position", true, "Должность"));
        }

        $phone = Phone::phoneVerification($phone);

        if (!FilterInput::isValid()) {
            FormRestore::add("user-new");
            Enviropment::redirectBack(FilterInput::getMessages(), "danger");
        }

        if ($phone["isError"]) {
            FormRestore::add("user-new");
            if ($this->lang == 'en') {
                Enviropment::redirectBack("Incorrect number format", "danger");
            } else {
                Enviropment::redirectBack("Не верный формат номера", "danger");
            }
        } else {
            $phone = $phone["number"];
        }

        // проверка уникальности $phone и $email
        $um = new UserManager();
        if ($um->getByPhone($phone)) {
            FormRestore::add("user-new");
            if ($this->lang == 'en') {
                Enviropment::redirectBack("Mobile number entered not unique", "danger");
            } else {
                Enviropment::redirectBack("Указанный номер мобильного не уникален", "danger");
            }
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            FormRestore::add("user-new");
            if ($this->lang == 'en') {
                Enviropment::redirectBack("Invalid E-Mail Format", "danger");
            } else {
                Enviropment::redirectBack("Неверный формат E-Mail", "danger");
            }
        }
        
        if (($um->getByEmail($email)) || ($um->getByConfirmedEmail($email))) {
            FormRestore::add("user-new");
            if ($this->lang == 'en') {
                Enviropment::redirectBack("E-mail entered not unique", "danger");
            } else {
                Enviropment::redirectBack("Указанный E-mail не уникален", "danger");
            }
        }

        // всё в норме, добавим нового пользователя
        $user = new User();
        $user->parentUserId = $this->actor->id;
        $user->phone = $phone;
        $user->email = $email;
        $user->name = $name;
        $user->lastname = $lastname;
        $user->countryName = $countryName;
        $user->cityName = $cityName;
        $user->company = $company;
        $user->position = $position;
        $user->tsCreated = time();
        $user->tsRegister = time();
        $user->status = User::STATUS_REGISTERED;
        $user->type = User::TYPE_USER;
        $user->lang = $this->lang;
        $user = $um->save($user);
        $user->disableBroadcastKey = md5($user->id . $user->tsCreated);
        $user = $um->save($user);

        // отправим СМС уведомление участнику
        UserManager::notifyRegisterParticipantSms($phone, $user->id);
        if ($this->lang == 'en') {
            Enviropment::redirectBack("Participant added", "success");
        } else {
            Enviropment::redirectBack("Участник добавлен", "success");
        }
    }
}