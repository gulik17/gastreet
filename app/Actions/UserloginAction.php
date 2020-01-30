<?php
/**
* Действие, которое обрабатывает вход пользователя на сайт
*
*/
class UserloginAction extends BaseAction implements IPublicAction {
    public function execute() {
        Context::logOff();
        Context::clearObject("__child");
        Context::clearObject("__user");
        Context::clearObject("__master");

        if ($this->lang == 'en') {
            $phone  = FilterInput::add(new StringFilter("phone", true, "Phone"));
            $code   = FilterInput::add(new StringFilter("code", true, "Code"));
        } else {
            $phone  = FilterInput::add(new StringFilter("phone", true, "Номер мобильного"));
            $code   = FilterInput::add(new StringFilter("code", true, "Код"));
        }
        
        $json = (int) FilterInput::add(new StringFilter("json", false, "JSON"));

        // Перепроверяем переменную $json она должна быть либо 0 либо 1
        // Если даже переменная не получена, далее она будет содержать 0
        $json = ($json === 1) ? 1 : 0;
        
        $redirMessage = "";
        $goto = Request::getVar("goto");

        $phone = Phone::phoneVerification($phone);
        if (!FilterInput::isValid()) {
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
                FormRestore::add("user-login");
                Enviropment::redirect("userlogin", FilterInput::getMessages());
            }
        }

        if ($phone["isError"]) {
            if ($json === 1) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = 'Incorrect number format';
                } else {
                    $array['msg'] = 'Не верный формат номера';
                }
                echo json_encode($array);
                exit;
            } else {
                FormRestore::add("user-login");
                if ($this->lang == 'en') {
                    Enviropment::redirect("userlogin", "Incorrect number format", "danger");
                } else {
                    Enviropment::redirect("userlogin", "Не верный формат номера", "danger");
                }
            }
        } else {
            $phone = $phone["number"];
        }

        $userMaster = null;
        $email = Request::getVar("email");
	$um = new UserManager();
    	$user = $um->getByPhoneAndCode($phone, $code);
        if (!$user) {
            // вход c мастер-паролем
            $userMaster = $um->getByPhone($phone);
            if ($userMaster && $code == SettingsManager::getValue("master")) {
                $user = $userMaster;
                Context::setObject("__master", SettingsManager::getValue("master"));
            }
            // вход из приложения
            $userApp = $um->getByPhone($phone);
            if ($userApp && $code == 'appEventicious') { //  && $userApp->email == $email
                if (!$this->actor) {
                    $user = $userApp;
                    // запишем в сессию логинутого пользователя
                    Context::setActor($user);
                    $um->updateVisitTime($user->id);
                     // Это был не брутфорс, а нормальный вход
                    SecurityLogManager::clearPasswordBrutforce();
                    $go = Context::getObject('QUERY_STRING');
                    if ($go) {
                        Context::clearObject('QUERY_STRING');
                        Enviropment::redirect($go);
                    }
                    Enviropment::redirect('register');
                }
            }
        }

        if ($user) {
            $user = $um->checkRegistered($user);
            $um->updateVisitTime($user->id);
            $checkResult = false;
            if ($user->email) {
                $cbm = new CashBackManager();
                $checkResult = $cbm->checkAndSetBalance($user);
                if ($checkResult) {
                    $user = $checkResult;
                }
            }
            
            // запишем в сессию логинутого пользователя
            Context::setActor($user);
            // Это был не брутфорс, а нормальный вход
            SecurityLogManager::clearPasswordBrutforce();

            if (base64_decode($goto) == 'index.php') $goto = null;
            if (base64_decode($goto) == 'index.php?show=userregister') $goto = null;

            if ($user->parentUserId) {
                $parentObj = $um->getById($user->parentUserId);
                // $redirMessage = $redirMessage . " Ваш аккаунт был добавлен пользователем: <i>" . $parentObj->phone . " " . $parentObj->lastname . " " . $parentObj->name . "</i>";
            }

            if ($json === 1) {
                $array['error'] = 0;
                $array['msg'] = 'doneLogin';
                echo json_encode($array);
                exit;
            } else {
                if ($checkResult) {
                    Enviropment::redirect("basket", 'Поздравляем! На Ваш баланс зачислен Кэшбэк!');
                }
                if (!$goto) {
                    if ( ($user->baseTicketId) || ($user->ulBalance > 0) ) {
                        Enviropment::redirect("basket", trim($redirMessage));
                    } else {
                        Enviropment::redirect("register", trim($redirMessage));
                    }
                } else {
                    Enviropment::redirect(base64_decode($goto), $redirMessage);
                }
            }
        } else {
            // пытаемся задетектить брутфорс
            SecurityLogManager::detectPasswordBrutforce();
            if ($json === 1) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = 'Logging in failed';
                } else {
                    $array['msg'] = 'Неудачная попытка входа';
                }
                echo json_encode($array);
                exit;
            } else {
                if ($this->lang == 'en') {
                    Enviropment::redirect("userlogin", "Logging in failed");
                } else {
                    Enviropment::redirect("userlogin", "Неудачная попытка входа");
                }
            }
        }
    }
}