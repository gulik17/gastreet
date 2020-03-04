<?php

/**
 * Менеджер
 */
class CashBackManager extends BaseEntityManager {
    public function getAll() {
        $sql = new SQLCondition();
        $sql->orderBy = "id";
        return $this->get($sql);
    }

    public function getByPhone($lastname, $phone) {
        $sql = new SQLCondition("`lastname` = '{$lastname}' AND `phone` = '{$phone}'");
        $sql->orderBy = "lastname";
        return $this->getOne($sql);
    }

    public function getByEmail($lastname, $email) {
        $sql = new SQLCondition("`lastname` = '{$lastname}' AND `email` = '{$email}'");
        $sql->orderBy = "lastname";
        return $this->getOne($sql);
    }
    
    public function checkAndSetBalance($user) {
        $sql = new SQLCondition("`lastname` = '{$user->lastname}' AND `name` = '{$user->name}' AND `city` = '{$user->cityName}' AND `email` = '{$user->email}' AND `tsUsed` IS NULL");
        $sql->orderBy = "lastname";
        $result = $this->getOne($sql);
        if ($result) {
            $result->tsUsed = time();
            $result = $this->save($result);
            $um = new UserManager();
            $user->ulBalance = $user->ulBalance + $result->balance;
            $user = $um->save($user);
            return $user;
        } else {
            return false;
        }
    }
}