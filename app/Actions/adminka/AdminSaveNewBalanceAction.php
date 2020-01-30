<?php
/**
 */
class AdminSaveNewBalanceAction extends AdminkaAction
{
	public function execute()
	{
		$id = Request::getInt("id");
        $balance = Request::getInt("balance");

		if (!$id) {
            Adminka::redirectBack("Не задан ID пользователя");
        }

        $um   = new UserManager();
		$user = $um->getById($id);
		if (!$user) {
            Adminka::redirectBack("Пользователь не найден");
        }

        $user->ulBalance = $balance;
        $user = $um->save($user);

        Adminka::redirectBack("Баланс установлен в значение: " . $balance);

	}

}
