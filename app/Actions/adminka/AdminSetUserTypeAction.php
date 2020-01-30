<?php
/**
 *
 */
class AdminSetUserTypeAction extends AdminkaAction
{
	public function execute()
	{
		$id = Request::getInt("id");
        if (!$id) {
            Adminka::redirectBack("Не указан ID пользователя");
        }

        $userTypeId = Request::getInt("userTypeId");

        $um = new UserManager();
        $umObj = $um->getById($id);
        if (!$umObj) {
            Adminka::redirectBack("Пользователь не найден");
        }

        $umObj->typeId = $userTypeId;
        if ($userTypeId) {
            $umObj->type = User::TYPE_STAFF;
        }
        else {
            $umObj->type = User::TYPE_USER;
        }

        $umObj = $um->save($umObj);

        // Qr код доступа
        UserManager::createQrCode($id);

        Adminka::redirectBack("Тип пользователя изменен");

	}

}