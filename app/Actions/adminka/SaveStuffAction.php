<?php
/**
 */
class SaveStuffAction extends AdminkaAction
{
    public function execute() {
        $id = FilterInput::add(new IntFilter("id", false, "id"));

        $phone    = FilterInput::add(new StringFilter("phone", true, "Телефон"));
        $email    = FilterInput::add(new StringFilter("email", false, "E-Mail"));
        $lastname = FilterInput::add(new StringFilter("lastname", true, "Фамилия"));
        $name     = FilterInput::add(new StringFilter("name", true, "Имя"));

        if (!FilterInput::isValid()) {
            $this->goBack(FilterInput::getMessages());
        }

        $um = new UserManager();
        $doAct = "Изменен ";
        if ($id) {
            $user = $um->getById($id);
            if (!$user) {
                Adminka::redirect("managestuff", "Член команды не найден");
            }
        } else {
            $user = new User();
            $doAct = "Добавлен ";
        }

        // проверить уникальность введенных данных
        $checkUser = $um->getByPhone($phone);
        if ($checkUser && $checkUser->id != $user->id) {
            $this->goBack("Введенный номер телефона не уникален");
        }

        $checkUser = $um->getByEmail($email);
        if ($checkUser && $checkUser->id != $user->id) {
            $this->goBack("Введенный E-Mail не уникален");
        }

        $user->phone      = $phone;
        $user->email      = $email;
        $user->lastname   = $lastname;
        $user->name       = $name;
        $user->status     = User::STATUS_REGISTERED;
        $user->type       = User::TYPE_STAFF;
        $user->tsCreated  = time();
        $user->tsRegister = time();
        $user = $um->save($user);
        $user->disableBroadcastKey = md5($user->id.$user->tsCreated);
        $user = $um->save($user);
        Adminka::redirect("managestuff", $doAct . "член команды");
    }

    private function goBack($message = ''){
        FormRestore::add("form");
        Adminka::redirectBack($message);
    }
}