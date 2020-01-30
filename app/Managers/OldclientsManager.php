<?php

/**
 */
class OldclientsManager extends BaseEntityManager {

    public function getAll() {
        $sql = new SQLCondition();
        return $this->get($sql);
    }

}
