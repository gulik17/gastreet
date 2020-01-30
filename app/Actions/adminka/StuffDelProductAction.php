<?php
/**
*/
class StuffDelProductAction extends AdminkaAction
{
	public function execute()
	{
		$userId = Request::getInt("userId");
		if (!$userId) {
            Adminka::redirect("managestuff", "Не задан ID пользователя");
        }
	
		$um = new UserManager();
		$user = $um->getById($userId);
		if (!$user) {
            Adminka::redirect("managestuff", "Пользователь не найден");
        }
        if ($user->type != User::TYPE_STAFF) {
            Adminka::redirect("managestuff", "Пользователь не является членом команды");
        }

        $productId = Request::getInt("productId");
        if (!$productId) {
            Adminka::redirect("managestuff", "Не задан ID товара");
        }

        $pm = new ProductManager();
        $product = $pm->getById($productId);
        if (!$product) {
            Adminka::redirect("managestuff", "Не найден товар");
        }

        // удалить из корзины
        $bpm = new BasketProductManager();
        $bpmObj = $bpm->getLinkByUserIdAndProductId($userId, $productId);
        if ($bpmObj) {
            $bpm->remove($bpmObj->id);
        }

        // пересчёт корзины
        $bm = new BasketManager();
        $bm->startTransaction();
        try {
            $bm->rebuildBasket($userId);
        } catch (Exception $e) {
            $bm->rollbackTransaction();
            Logger::error($e);
            Enviropment::redirectBack(Enviropment::ERROR_MSG);
        }
        $bm->commitTransaction();

        // запрос не переформирование Qr кода
        UserManager::createQrCode($userId);

        Adminka::redirectBack("Товар удален");

	}

}
