<?php

/**
 * Менеджер волонтеров
 */
class VolunteerManager extends BaseEntityManager {
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

    public function getAll($sortType = "years, name") {
        $sql = new SQLCondition();
        $sql->orderBy = $sortType;
        return $this->get($sql);
    }

    public function getActive($limit = 0, $sortType = "years, name") {
        $sql = "SELECT * FROM `volunteer` WHERE `status` = '" . Volunteer::STATUS_ACTIVE . "' ORDER BY {$sortType} DESC";
        if ($limit) {
            $sql .= " LIMIT 0, $limit";
        }
        return $this->getByAnySQL($sql);
    }
    
    public function getActiveByYear($year, $limit = 0, $sortType = "years, name") {
        if ($year != null) {
            $sql = "SELECT `v`.* FROM `volunteer` AS v WHERE `v`.`status` = '" . Volunteer::STATUS_ACTIVE . "' AND `years` LIKE '%{$year}%' ORDER BY $sortType DESC";
            //$sql = new SQLCondition("status = '" . Speaker::STATUS_ENABLED . "' AND tags LIKE '%#{$tag}'");
        } else {
            $sql = "SELECT `v`.* FROM `volunteer` AS v WHERE `v`.`status` = '" . Volunteer::STATUS_ACTIVE . "' ORDER BY $sortType DESC";
        }

        if ($limit) {
            $sql .= " LIMIT 0, $limit";
        }

        return $this->getByAnySQL($sql);
    }
    
    public function getActiveCity($limit = 0) {
        $sql = "SELECT `v`.`cityName` FROM `volunteer` AS v WHERE `v`.`status` = '" . Volunteer::STATUS_ACTIVE . "' GROUP BY `v`.`cityName` ORDER BY `v`.`cityName` DESC ";

        if ($limit) {
            $sql .= " LIMIT 0, $limit";
        }
        return $this->getByAnySQL($sql);
    }
    
    public function getActivePosition($limit = 0) {
        $sql = "SELECT `v`.`position` FROM `volunteer` AS v WHERE `v`.`status` = '" . Volunteer::STATUS_ACTIVE . "' GROUP BY `v`.`position` ORDER BY `v`.`position` DESC ";

        if ($limit) {
            $sql .= " LIMIT 0, $limit";
        }
        return $this->getByAnySQL($sql);
    }
    
    public function getFilteredVolunteerIds($filterArray) {
        $res = null;
        // не выбран ни один фильтр
        if ($filterArray['basicfilter'] == 1) {
            $sql = "SELECT `id` FROM `volunteer` ";
            $sql .= " ORDER BY id DESC";
            $res = $this->getColumn($sql);
        } else {
            $allConditions = array();
            if ($filterArray["basicfilter"] == 2) {
                if ($filterArray["id"]) {
                    $allConditions[] = "id = {$filterArray["id"]}";
                }
                if ($filterArray["lastname"]) {
                    $allConditions[] = "lastname like '%{$filterArray['lastname']}%'";
                }
                if ($filterArray["name"]) {
                    $allConditions[] = "name like '%{$filterArray['name']}%'";
                }
                if ($filterArray["phone"]) {
                    $allConditions[] = "phone like '%{$filterArray['phone']}%'";
                }
                if ($filterArray["email"]) {
                    $allConditions[] = "email like '%{$filterArray['email']}%'";
                }
                if (count($allConditions) > 0) {
                    $allConditions = " WHERE " . implode(" AND ", $allConditions);
                }
                $sql = "SELECT `id` FROM `volunteer` {$allConditions} ORDER BY `id` DESC";
                $res = $this->getByAnySQL($sql);
            }
        }

        return $res;
    }
    
    public function getFilteredVolunteerList($filter) {
        $res = null;
        $allConditions = [];
        if ($filter["city"]) {
            $allConditions[] = "`cityName` = '{$filter['city']}'";
        }
        if ($filter["year"]) {
            $allConditions[] = "`years` like '%{$filter['year']}%'";
        }
        if ($filter["position"]) {
            $allConditions[] = "`position` = '{$filter['position']}'";
        }
        if (count($allConditions) > 0) {
            $allConditions = " WHERE " . implode(" AND ", $allConditions);
        }
        
        ///deb($allConditions);
        $sql = "SELECT * FROM `volunteer` {$allConditions} ORDER BY `id` DESC";
        $res = $this->getByAnySQL($sql);

        return $res;
    }
}