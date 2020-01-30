<?php

/**
 */
class ParthnerTypeManager extends BaseEntityManager {
    public function getAll() {
        $sql = new SQLCondition();
        $sql->orderBy = "id";
        return $this->get($sql);
    }
}