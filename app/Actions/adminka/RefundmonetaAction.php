<?php
/**
*/
class RefundmonetaAction extends AdminkaAction
{
	public function execute()
	{
		$monetaOperationId = Request::getInt("id");
		if (!$monetaOperationId)
			Adminka::redirect("managerefunds", "Не задан ID операции");


        $sdkAppFileName = APPLICATION_DIR . "/moneta-sdk-lib/autoload.php";
        include_once($sdkAppFileName);
        $monetaSDK = new \Moneta\MonetaSdk();
        $monetaSDK->checkMonetaServiceConnection();

        // вернуть деньги в монете



        spl_autoload_register(array("Configurator", "autoload"));



        // отметить суммы в корзине




		Adminka::redirect("managerefunds", "Возврат был совершён");

	}

}
