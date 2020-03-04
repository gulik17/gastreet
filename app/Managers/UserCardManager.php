<?php

/**
 * Менеджер
 */
class UserCardManager extends BaseEntityManager {

    public function getByUserId($userId) {
        $userId = intval($userId);
        return $this->get(new SQLCondition("userId = {$userId}"));
    }

    public function getByToken($paymenttoken) {
        return $this->getOne(new SQLCondition("paymenttoken = '{$paymenttoken}'"));
    }

    public function getByUserIdAndCardNumber($userId, $cardnumber) {
        $userId = intval($userId);
        return $this->getOne(new SQLCondition("userId = {$userId} AND cardnumber = '{$cardnumber}'"));
    }

}
