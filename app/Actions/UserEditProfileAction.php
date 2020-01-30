<?php
/**
* Действие для редактирования пользователя
*
*/
class UserEditProfileAction extends AuthorizedUserAction implements IPublicAction{
    public function execute() {
        if ($this->actor->hasEdit) {
            Enviropment::redirectBack("Данный профиль запрещено редактирвать", 'danger');
        }

        if ($this->lang == 'en') {
            $email       = FilterInput::add(new StringFilter("email", true, "E-Mail"));
            $lastname    = FilterInput::add(new StringFilter("lastname", true, "Last Name"));
            $name        = FilterInput::add(new StringFilter("name", true, "Name"));
            $countryName = FilterInput::add(new StringFilter("countryName", true, "Country"));
            $cityName    = FilterInput::add(new StringFilter("cityName", true, "City"));
            $company     = FilterInput::add(new StringFilter("company", true, "Company"));
            $position    = FilterInput::add(new StringFilter("position", true, "Position"));
            $usertype    = (int) FilterInput::add(new StringFilter("usertype", false, "Account Type"));
            $json        = (int) FilterInput::add(new StringFilter("json", false, "JSON"));
        } else {
            $email       = FilterInput::add(new StringFilter("email", true, "E-Mail"));
            $lastname    = FilterInput::add(new StringFilter("lastname", true, "Фамилия"));
            $name        = FilterInput::add(new StringFilter("name", true, "Имя"));
            $countryName = FilterInput::add(new StringFilter("countryName", true, "Страна"));
            $cityName    = FilterInput::add(new StringFilter("cityName", true, "Город"));
            $company     = FilterInput::add(new StringFilter("company", true, "Компания"));
            $position    = FilterInput::add(new StringFilter("position", true, "Должность"));
            $usertype    = (int) FilterInput::add(new StringFilter("usertype", false, "Тип учетной записи"));
            $json        = (int) FilterInput::add(new StringFilter("json", false, "JSON"));
        }
        
        // Приведем полученый ящик к нижнему регистру
        $email = mb_strtolower($email);
        if (!FilterInput::isValid()) {
            FormRestore::add("user-register");
            if ($json === 1) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = 'The following mandatory fields not filled in:'."\r".implode("\r", FilterInput::getMessages());
                } else {
                    $array['msg'] = 'Не заполнены обязательные поля:'."\r".implode("\r", FilterInput::getMessages());
                }
                echo json_encode($array);
                exit;
            } else {
                Enviropment::redirectBack(FilterInput::getMessages());
            }
        }

        $parentObj = null;
        $um = new UserManager();
        if ($this->actor && $this->actor->parentUserId) {
            $parentObj = $um->getById($this->actor->parentUserId);
        }

        // авторизован ли под участником
        $user = null;
        $child = Context::getObject("__child");
        if ($child) {
            $user = $child;
        } else if ($parentObj) {
            $child = $this->actor;
            $user = $child;
        } else if ($this->actor) {
            $user = $this->actor;
        }

        $userObj = $um->getById($user->id);

        $emailIsNotUnique = false;
        $emailsUsers = $um->getUsersByEmail($email);
        $confirmEmailsUsers = $um->getUsersByConfirmedEmail($email);
        if (is_array($emailsUsers) && count($emailsUsers)) {
            foreach ($emailsUsers AS $emailsUser) {
                if ($emailsUser->id != $userObj->id && strtolower($email) == strtolower($emailsUser->email)) {
                    $emailIsNotUnique = true;
                    break;
                }
            }
        }

        if (is_array($confirmEmailsUsers) && count($confirmEmailsUsers)) {
            foreach ($confirmEmailsUsers AS $emailsUser) {
                if ($emailsUser->id != $userObj->id && strtolower($email) == strtolower($emailsUser->email)) {
                    $emailIsNotUnique = true;
                    break;
                }
            }
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if ($json === 1) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = 'Invalid E-Mail Format';
                } else {
                    $array['msg'] = 'Неверный формат E-Mail';
                }
                echo json_encode($array);
                exit;
            } else {
                FormRestore::add("user-register");
                if ($this->lang == 'en') {
                    Enviropment::redirectBack("Invalid E-Mail Format", "danger");
                } else {
                    Enviropment::redirectBack("Неверный формат E-Mail", "danger");
                }
            }
        }

        if ($emailIsNotUnique) {
            if ($json === 1) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = 'E-Mail entered was specified by another participant';
                } else {
                    $array['msg'] = 'Указанный E-Mail занят другим участником';
                }
                echo json_encode($array);
                exit;
            } else {
                FormRestore::add("user-register");
                if ($this->lang == 'en') {
                    Enviropment::redirectBack("E-Mail entered was specified by another participant", "danger");
                } else {
                    Enviropment::redirectBack("Указанный E-Mail занят другим участником", "danger");
                }
            }
        }

        if (!$userObj || $user->id != $userObj->id) {
            if ($json === 1) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = 'No user found';
                } else {
                    $array['msg'] = 'Не найден пользователь';
                }
                echo json_encode($array);
                exit;
            } else {
                if ($this->lang == 'en') {
                    Enviropment::redirectBack("No user found", "danger");
                } else {
                    Enviropment::redirectBack("Не найден пользователь", "danger");
                }
            }
        } else {
            $userObj->lastname    = $lastname;
            $userObj->name        = $name;
            $userObj->countryName = $countryName;
            $userObj->cityName    = $cityName;
            $userObj->company     = preg_replace('/\&quot;([^\"]*)\&quot;/ismU', "«$1»", $company);
            $userObj->position    = $position;
            //$userObj->typeId      = $usertype;

            if ( ($email != $userObj->confirmedEmail) && ($email != $userObj->email) && (!EmailConfirmAttemptManager::hasAttemptLast2Minutes($email)) ) {
                $confirmCode = substr(Utils::getGUID(), 0, 10);
                // записать попытку в лог
                EmailConfirmAttemptManager::add($email, $confirmCode, $userObj->id);
                usleep(5000);
                // отправить письмо на подтверждение мыла
                UserManager::sendConfirmCodeEmail($email, $confirmCode, $userObj->id);
                usleep(5000);
            }

            $userObj->email = $email;
            $userObj = $um->save($userObj);

            // обновить QR код
            UserManager::createQrCode($userObj->id); //$qrmObj = 
            UserManager::updateUser4App($userObj);
            usleep(1500);
        }
        if ($json === 1) {
            $array['error'] = 0;
            if ($this->lang == 'en') {
                $array['msg'] = 'Your data has been saved, now you can proceed to shopping!';
            } else {
                $array['msg'] = 'Данные сохранены, теперь вы можете совершать покупки!';
            }
            echo json_encode($array);
            exit;
        } else {
            if ($this->lang == 'en') {
                Enviropment::redirect("basket", "Your data has been saved, now you can proceed to shopping!", "info");
            } else {
                Enviropment::redirect("basket", "Данные сохранены, теперь вы можете совершать покупки!", "info");
            }
        }
    }
}