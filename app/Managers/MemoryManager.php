<?php

/**
 * Менеджер
 */
class MemoryManager extends BaseEntityManager {
    public function getByUserId($user_id) {
        if (!$user_id) {
            return null;
        }
        return $this->get(new SQLCondition("`user_id` = $user_id", null, "id"));
    }

    public function getAll() {
        $sql = 'SELECT m.*, u.`name`, u.`lastname` FROM `memory` AS m LEFT JOIN `user` AS u ON m.`user_id` = u.`id` ORDER BY m.`id` DESC';
        return $this->getByAnySQL($sql);
    }
    
    public function getAllActive() {
        $sql = "SELECT m.*, u.`name`, u.`lastname` FROM `memory` AS m LEFT JOIN `user` AS u ON m.`user_id` = u.`id` WHERE m.`status` = 'STATUS_OK' ORDER BY m.`id` DESC";
        return $this->getByAnySQL($sql);
    }
}