<?php

/**
 */
class UserReportLineManager extends BaseEntityManager {

    public function getByIds($newsIds) {
        if (!$newsIds)
            return null;

        $ids = implode(",", $newsIds);
        $res = $this->get(new SQLCondition("id in ($ids)"));
        return $res;
    }

    public function getAll() {
        $sql = new SQLCondition();
        return $this->get($sql);
    }

    public function getReportLines($reportId) {
        $reportId = intval($reportId);
        $sql = new SQLCondition("`reportId` = {$reportId}");
        return $this->get($sql);
    }
}