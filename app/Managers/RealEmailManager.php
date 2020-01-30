<?php

/**
 * Менеджер
 */

class RealEmailManager extends BaseEntityManager {
    public function getAll() {
        $sql = new SQLCondition();
        $sql->orderBy = "id";
        return $this->get($sql);
    }

    public function getByEmail($email) {
        $sql = new SQLCondition("email = '$email'");
        return $this->get($sql);
    }
}