<?php

/**
 */
class DiscountEmailManager extends BaseEntityManager {
    public function getAll($sort = null) {
        $sql = ($sort) ? new SQLCondition(null,null,$sort):new SQLCondition();
        return $this->get($sql);
    }
}