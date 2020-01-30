<?php
/**
 *
 */
class AdminDeluserproductAction extends AdminkaAction
{
	public function execute()
	{
		$id = Request::getInt("id");
        if (!$id) {
            Adminka::redirectBack("Не указан ID");
        }

        $bpm = new BasketProductManager();
        $basketProduct = $bpm->getById($id);
        if (!$basketProduct) {
            Adminka::redirectBack("МК не найден");
        }

        if ($basketProduct->childId) {
            $userId = $basketProduct->childId;
        }
        else {
            $userId = $basketProduct->userId;
        }

        Logger::info("AdminDeluserproduct, id: {$id}, userId: {$userId}");
        Logger::info($basketProduct);

        // удалить МК
        $bpm->remove($id);

        // ребилд QR кодов
        $qrmObj = UserManager::createQrCode($userId);

        Adminka::redirectBack("МК был удалён");

	}

}