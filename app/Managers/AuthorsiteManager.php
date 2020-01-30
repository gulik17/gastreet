<?php

/**
 * Менеджер для управления связями автор - сайт
 */
class AuthorsiteManager extends BaseEntityManager {

    /**
     * @param array int $ids список id
     * @return array News
     */
    public function getByIds($ids) {
        if (!$ids)
            return null;

        $idsStr = implode(",", $ids);
        $res = $this->get(new SQLCondition("id IN ($idsStr)"));
        return Utility::sort($ids, $res);
    }

    public function getAll() {
        $sql = new SQLCondition();
        return $this->get($sql);
    }

    public function getByUserId($userId, $status = null) {
        if ($status)
            $sql = new SQLCondition("userId = {$userId} AND status = '{$status}'");
        else
            $sql = new SQLCondition("userId = {$userId}");

        $sql->orderBy = "dateCreate DESC";
        return $this->get($sql);
    }

    public function getBySiteId($siteId, $status = null) {
        if ($status)
            $sql = new SQLCondition("siteId = {$siteId} AND status = '{$status}'");
        else
            $sql = new SQLCondition("siteId = {$siteId}");

        $sql->orderBy = "dateCreate DESC";
        return $this->get($sql);
    }

    public function getByUserIdAndSiteId($userId, $siteId, $status = null) {
        if ($status)
            $sql = new SQLCondition("userId = {$userId} AND siteId = {$siteId} AND status = '{$status}'");
        else
            $sql = new SQLCondition("userId = {$userId} AND siteId = {$siteId}");

        $sql->orderBy = "dateCreate DESC";
        return $this->getOne($sql);
    }

}
