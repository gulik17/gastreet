<?php

/**
 * Менеджер
 */
class FolkPhonesManager extends BaseEntityManager {

    public function getByIds($inpIds) {
        if ( (!$inpIds) || (count($inpIds) == 0) ) {
            return null;
        }
        $ids = implode(",", $inpIds);
        $res = $this->get(new SQLCondition("id IN ($ids)", null, "id"));
        return Utility::sort($inpIds, $res);
    }

    public function getAll($sortType = "id") {
        $sql = new SQLCondition();
        $sql->orderBy = $sortType;
        return $this->get($sql);
    }

    public function getByPhone($phone) {
        $condition = "phone = {$phone}";
        $sql = new SQLCondition($condition);
        return $this->get($sql);
    }
}
