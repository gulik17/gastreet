<?php

/**
 * Менеджер
 */
class AmoConfigManager extends BaseEntityManager {

    public function getConfig() {
        $ent = self::newEntity($this->defineClass());
        $sql = "SELECT * FROM `{$ent->entityTable}` WHERE {$ent->primaryKey} = 1";
        $result = $this->getReadConnection()->getOneRow($sql);
        if (!$result) {
            return null;
        }
        $ent = $this->fillEntity($ent, $result);
        return $ent;
    }
}
