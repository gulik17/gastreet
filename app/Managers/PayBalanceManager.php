<?php

/**
 * Менеджер
 */
class PayBalanceManager extends BaseEntityManager {

    public function getByIds($inpIds) {
        if (!$inpIds)
            return null;

        if (count($inpIds) == 0)
            return null;

        $ids = implode(",", $inpIds);
        $res = $this->get(new SQLCondition("`id` IN ($ids)", null, "id"));
        return Utility::sort($inpIds, $res);
    }

    public function getByUserId($userId) {
        $condition = "`userId` = {$userId}";
        $sql = new SQLCondition($condition);
        $sql->orderBy = "`tsCreated` DESC";
        return $this->get($sql);
    }
    
    public function getByUserIdAndStatus($userId, $status = 'STATUS_PAID') {
        $condition = "`userId` = {$userId} AND `status` = '{$status}'";
        $sql = new SQLCondition($condition);
        $sql->orderBy = "`tsCreated` DESC";
        return $this->get($sql);
    }

    public function getFilteredPayIds($filterArray) {
        // не выбран ни один фильтр
        if ($filterArray['basicfilter'] == 1) {
            $sql = "SELECT `id` FROM `payBalance` AS p ORDER BY `p`.`id` DESC";
            $res = $this->getColumn($sql);
            return $res;
        }

        $res = null;
        $allConditions = array();
        if ($filterArray["basicfilter"] == 2) {
            if ($filterArray["id"]) {
                $allConditions[] = "`p`.`id` = {$filterArray["id"]}";
            }
            if (count($allConditions) > 0) {
                $allConditions = " WHERE " . implode(" AND ", $allConditions);
            }

            $sql = "SELECT `id` FROM `payBalance` AS p {$allConditions} ORDER BY `p`.`id` DESC";
            $res = $this->getColumn($sql);
        }

        return $res;
    }

    public function PayBalance($ORDER_ID, $SYSTEM_INCOME, $TRANSACTION_ID) {
        // это пополнение внутреннего баланса
        $orderIdArray = explode('_', $ORDER_ID);
        $payId = $orderIdArray[0];

        $payb = new PayBalanceManager();
        $paybObj = $payb->getById($payId);
        if ($paybObj) {
            $userId = $paybObj->userId;
            // обновляем статус операции
            $paybObj->payAmount = $SYSTEM_INCOME;
            $paybObj->monetaOperationId = $TRANSACTION_ID;
            $paybObj->status = PayBooking::STATUS_PAID;
            $paybObj->tsUpdated = time();
            $paybObj = $payb->save($paybObj);
            // обновляем баланс пользователя
            $um = new UserManager();
            $um->increaseUlBalance($userId, $SYSTEM_INCOME);
        }

        // result меняем на success
        $result = 'SUCCESS';
    }

}
