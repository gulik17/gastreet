<?php
/**
 * Действие БО для сохранения пароля оператора
 * 
 */
class SaveoperpassAction extends AdminkaAction
{
	public function execute()
	{
		$newpass = FilterInput::add(new StringFilter("newpass", true, "Новый пароль"));
		if (!FilterInput::isValid()) {
            Adminka::redirectBack(FilterInput::getMessages());
        }

		$password = md5(md5($newpass).md5($newpass));
		$op = Context::getActor();
		$opm = new OperatorManager();
		$oper = $opm->getById($op->id);
		if ($oper)
		{
			$oper->password = $password;
			$opm->save($oper);
			Adminka::redirect("mainpage", "Пароль изменен");
		}
		else
		{
			Adminka::redirect("mainpage", "Не задан оператор");
		}
	}
}
