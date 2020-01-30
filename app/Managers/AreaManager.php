<?php

/**
 * Менеджер
 */
class AreaManager extends BaseEntityManager {

    public function getByIds($inpIds) {
        if (!$inpIds)
            return null;

        if (count($inpIds) == 0)
            return null;

        $ids = implode(",", $inpIds);
        $res = $this->get(new SQLCondition("id IN ($ids)", null, "id"));
        return Utility::sort($inpIds, $res);
    }

    public function getAll() {
        $sql = new SQLCondition();
        $sql->orderBy = "id";
        return $this->get($sql);
    }

    public function getAllNotIn($inpIds) {
        if (!$inpIds || count($inpIds) == 0) {
            $sql = new SQLCondition();
            $sql->orderBy = "id";
            $res = $this->get($sql);
        } else {
            $ids = implode(",", $inpIds);
            $res = $this->get(new SQLCondition("id NOT IN ($ids)", null, "id"));
        }

        return $res;
    }

    public function getActive($sortOrder = "id") {
        $sql = new SQLCondition("status = '" . Speaker::STATUS_ENABLED . "'");
        $sql->orderBy = $sortOrder;
        return $this->get($sql);
    }
    
    public function getActiveByType($type = 1, $sortOrder = "sortOrder") {
        $sql = new SQLCondition("`status` = '" . Speaker::STATUS_ENABLED . "' AND `areaTypeId` = $type");
        $sql->orderBy = $sortOrder;
        return $this->get($sql);
    }

}
