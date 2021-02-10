<?php
/**
* Контрол редактирования профайла
*/
class UserEditProfileControl extends AuthorizedUserControl {
    public $pageTitle    = "Редактирование профайла — GASTREET 2021";
    public $pageTitle_en = "Edit Profile — GASTREET 2021";

    public function render() {
        UserManager::redirectIfNoLogin($this->actor, '/');
        
        $parentObj = null;
        $um = new UserManager();
        if ($this->actor && $this->actor->parentUserId) {
            $parentObj = $um->getById($this->actor->parentUserId);
        }
        //ИП 12 //ЮЛ 10
        // авторизован ли под участником
        $user = null;
        $child = Context::getObject("__child");
        if ($child) {
            $user = $child;
            $this->addData("child", $child);
        } else if ($parentObj) {
            $child = $this->actor;
            $user = $child;
            $this->addData("child", $child);
        } else if ($this->actor) {
            $user = $this->actor;
        }

        // типы пользователей
        $utm = new UserTypeManager();
        $utmList = $utm->getAll();
        if (is_array($utmList) && count($utmList)) {
            $userTypes = array();
            foreach ($utmList AS $utmItem) {
                $userTypes[$utmItem->id] = $utmItem->name;
            }
            $this->addData("userTypes", $userTypes);
        }
        
        // Выводим сформированные ранее списки стран
        $this->addData("country", $this->country);
        $this->addData("city", $this->city);
        
        //deb($this->city);

        $freshUser = $um->getById($user->id);
        $this->addData("user", $freshUser);
        $this->includedJS .= Enviropment::loadScript('/js/pages/usereditprofile.js', 'js');
    }
}