<?php

/**
 * Действие для подтверждения e-mail пользователя
 *
 */
class UserconfirmAction extends BaseAction implements IPublicAction {
    public function execute() {
        Context::logOff();
        $confirmCode = Request::getVar("code");
        if (!$confirmCode) {
            if ($this->lang == 'en') {
                Enviropment::redirect("/", "No E-Mail confirmation code entered", "danger");
            } else {
                Enviropment::redirect("/", "Не указан код подтверждения E-Mail", "danger");
            }
        }

        $ecam = new EmailConfirmAttemptManager();
        $confirmAttempt = $ecam->getByCode($confirmCode);
        if (!$confirmAttempt) {
            if ($this->lang == 'en') {
                Enviropment::redirect("/", "Incorrect E-Mail confirmation code", "danger");
            } else {
                Enviropment::redirect("/", "Указан не верный код подтверждения E-Mail", "danger");
            }
        } else if ($confirmAttempt->status != EmailConfirmAttempt::STATUS_NEW) {
            if ($this->lang == 'en') {
                Enviropment::redirect("/", "Confirmation code entered expired or used", "danger");
            } else {
                Enviropment::redirect("/", "Указанный код подтверждения истек или уже использован", "danger");
            }
        } else {
            $confirmAttempt->status = EmailConfirmAttempt::STATUS_CONFIRMED;
            $confirmAttempt->ipConfirm = Utility::getClientIp();
            $confirmAttempt->tsConfirm = time();
            $confirmAttempt = $ecam->save($confirmAttempt);

            $um = new UserManager();
            $userObj = $um->getById($confirmAttempt->userId);
            if ($userObj) {
                $userObj->confirmedEmail = $confirmAttempt->email;
                $userObj = $um->save($userObj);
                UserManager::sendConfirmDoneEmail($confirmAttempt->email, $confirmAttempt->userId);
                // авторизуем на сайте пользователя
                Context::setActor($userObj);
                if ($this->lang == 'en') {
                    Enviropment::redirect("catalog", "Thank you, your E-Mail confirmed!", "success");
                } else {
                    Enviropment::redirect("catalog", "Спасибо, Ваш e-mail подтвержден!", "success");
                }
            } else {
                if ($this->lang == 'en') {
                    Enviropment::redirect("/", "No user found by the confirmation code", "danger");
                } else {
                    Enviropment::redirect("/", "Не найден пользователь по коду подтверждения", "danger");
                }
            }
        }
    }
}