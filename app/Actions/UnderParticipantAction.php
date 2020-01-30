<?php

/**
 *
 */
class UnderParticipantAction extends AuthorizedUserAction implements IPublicAction {
    public function execute() {
        // проверить заполнен ли профайл данного пользователя
        UserManager::redirectIfNoProfile($this->actor);
        $id = Request::getInt("id");
        if (!$id) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("No participant ID entered", "danger");
            } else {
                Enviropment::redirectBack("Не указан ID участника", "danger");
            }
        }
        // надо разлогиниться доп.участником, если залогинен
        $child = Context::getObject("__child");
        if ($child) {
            Context::clearObject("__child");
        }
        $um = new UserManager();
        $child = $um->getByUserIdAndChildId($this->actor->id, $id);
        if (!$child) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("No participant found", "danger");
            } else {
                Enviropment::redirectBack("Не найден участник", "danger");
            }
        }
        // всё готово, записываем участника в сессию
        Context::setObject("__child", $child);
        if ($this->lang == 'en') {
            Enviropment::redirectBack("Please shop for participant: <nobr>" . Utility::mobilephone($child->phone) . "</nobr> " . $child->lastname . " " . $child->name, "info");
        } else {
            Enviropment::redirectBack("Вы совершаете покупки для участника: <nobr>" . Utility::mobilephone($child->phone) . "</nobr> " . $child->lastname . " " . $child->name, "info");
        }
    }
}