<?php
/**
*/
class StuffProductAction extends AdminkaAction
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

        // есть ли данный продукт у пользователя
        $bpm = new BasketProductManager();
        $bpmObj = $bpm->getLinkByUserIdAndProductId($userId, $productId);
        if ($bpmObj) {
            Adminka::redirectBack("Данный товар уже есть у данного члена команды");
        }

        $ts = time();

        // добавить в корзину basketProduct
        $bpm = new BasketProductManager();
        $bpmObj = new BasketProduct();
        $bpmObj->userId = $userId;

        $bpmObj->tsCreated = $ts;
        $bpmObj->tsUpdated = $ts;
        $bpmObj->tsPay     = $ts;
        $bpmObj->productId     = $productId;
        $bpmObj->productName   = $product->name;
        $bpmObj->productStatus = $product->status;
        $bpmObj->needAmount       = $product->price;
        $bpmObj->payAmount        = $product->price;
        $bpmObj->status           = BasketProduct::STATUS_PAID;
        $bmObj = $bpm->save($bpmObj);

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

        Adminka::redirectBack("Товар добавлен");

	}

}
