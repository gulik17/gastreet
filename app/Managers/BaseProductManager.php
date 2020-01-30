<?php

/**
 * Менеджер
 */
class BaseProductManager extends BaseEntityManager {

    public function getAll() {
        return $this->get();
    }

}
