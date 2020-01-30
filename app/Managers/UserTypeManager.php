<?php

/**
 *
 */
class UserTypeManager extends BaseEntityManager {
    public function getAll() {
        $sql = new SQLCondition();
        return $this->get($sql);
    }
}