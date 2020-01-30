
<?php

/**
 * Отправить сообщене в личку другому пользователю
 *
 */
class SendpvtmessageAction extends AuthorizedUserAction implements IPublicAction {

    public function execute() {
        // кому отправляем сообщение
        $userId = Request::getInt("userId");
        if (!$userId) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("No recipient selected", "danger");
            } else {
                Enviropment::redirectBack("Не выбран получатель", "danger");
            }
        }

        $actor = $this->actor;
        // автор сообщения
        $actorId = $actor->id;
        if ($userId == $actorId) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("You cannot send a message to yourself", "danger");
            } else {
                Enviropment::redirectBack("Нельзя отправить сообщение самому себе", "danger");
            }
        }

        $um = new UserManager();
        $userObj = $um->getById($userId);
        if (!$userObj) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("Addressee not found", "danger");
            } else {
                Enviropment::redirectBack("Не найден адресат", "danger");
            }
        }

        // само сообщение
        $message = Request::getVar("message");
        if (!$message || $message == '') {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("Message cannot be empty", "danger");
            } else {
                Enviropment::redirectBack("Сообщение не должно быть пустым", "danger");
            }
        }

        if (mb_strlen($message) > 10000000) {
            if ($this->lang == 'en') {
                Enviropment::redirectBack("Too many characters", "danger");
            } else {
                Enviropment::redirectBack("Слишком длинное сообщение", "danger");
            }
        }

        $dlgId = Request::getInt("dlgId");

        $mdm = new MessageDialogueManager();
        $mdm->addMessage($actorId, $userId, $message);

        if ($dlgId) {
            if ($this->lang == 'en') {
                Enviropment::redirect("messages/userid/{$userId}/dlgid/{$dlgId}", "Message sent", "success");
            } else {
                Enviropment::redirect("messages/userid/{$userId}/dlgid/{$dlgId}", "Сообщение отправлено", "success");
            }
        } else {
            if ($this->lang == 'en') {
                Enviropment::redirect("messages", "Message sent", "success");
            } else {
                Enviropment::redirect("messages", "Сообщение отправлено", "success");
            }
        }
    }
}