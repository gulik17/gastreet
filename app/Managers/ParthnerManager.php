<?php

/**
 * Менеджер
 */
class ParthnerManager extends BaseEntityManager {

    public function getByIds($inpIds) {
        if (!$inpIds) {
            return null;
        }
        if (count($inpIds) == 0) {
            return null;
        }
        $ids = implode(",", $inpIds);
        $res = $this->get(new SQLCondition("id IN ($ids)", null, "id"));
        return Utility::sort($inpIds, $res);
    }

    public function getAll() {
        $sql = new SQLCondition();
        $sql->orderBy = "sortOrder, id";
        return $this->get($sql);
    }

    public function getActive() {
        $sql = new SQLCondition("status = '" . Speaker::STATUS_ENABLED . "'");
        $sql->orderBy = "sortOrder, id";
        return $this->get($sql);
    }
}