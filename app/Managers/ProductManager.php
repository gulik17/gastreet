<?php

/**
 * Менеджер
 */
class ProductManager extends BaseEntityManager {

    public function getAll($sort = "id") {
        $sql = new SQLCondition();
        $sql->orderBy = $sort;
        return $this->get($sql);
    }

    public function getAllActive($areaId = null, $onlyAllowed = false, $limit = null, $sort = null) {
        $status = BaseTicket::STATUS_ENABLED;
        $condition = "status = '{$status}'";
        if ($areaId) {
            $areaId = intval($areaId);
            $condition .= " AND areaId = {$areaId}";
        }
        if ($onlyAllowed) {
            $condition .= " AND showInSchedule = 1";
        }
        if ($limit) {
            $sql = new SQLCondition($condition, null, null, 50, $limit);
        } else {
            $sql = new SQLCondition($condition);
        }
        if ($sort) {
            $sql->orderBy = $sort;
        } else {
            $sql->orderBy = "eventTsStart";
        }
        return $this->get($sql);
    }
    
    public function getFullActive($areaId = null, $onlyAllowed = false, $limit = null) {
        $status = BaseTicket::STATUS_ENABLED;
        $sql = "SELECT "
                . "`product`.*, "
                . "`place`.`name` AS placeName, "
                . "`place`.`name_en` AS placeName_en, "
                . "`s1`.`name` AS s1_name, "
                . "`s1`.`secondName` AS s1_secondName, "
                . "`s1`.`name_en` AS s1_name_en, "
                . "`s1`.`secondName_en` AS s1_secondName_en, "
                . "`s1`.`company` AS s1_company, "
                . "`s1`.`cityName` AS s1_cityName, "
                . "`s2`.`name` AS s2_name, "
                . "`s2`.`secondName` AS s2_secondName, "
                . "`s2`.`name_en` AS s2_name_en, "
                . "`s2`.`secondName_en` AS s2_secondName_en, "
                . "`s2`.`company` AS s2_company, "
                . "`s2`.`cityName` AS s2_cityName, "
                . "`s3`.`name` AS s3_name, "
                . "`s3`.`secondName` AS s3_secondName, "
                . "`s3`.`name_en` AS s3_name_en, "
                . "`s3`.`secondName_en` AS s3_secondName_en, "
                . "`s3`.`company` AS s3_company, "
                . "`s3`.`cityName` AS s3_cityName, "
                . "`s4`.`name` AS s4_name, "
                . "`s4`.`secondName` AS s4_secondName, "
                . "`s4`.`name_en` AS s4_name_en, "
                . "`s4`.`secondName_en` AS s4_secondName_en, "
                . "`s4`.`company` AS s4_company, "
                . "`s4`.`cityName` AS s4_cityName, "
                . "`s5`.`name` AS s5_name, "
                . "`s5`.`secondName` AS s5_secondName, "
                . "`s5`.`name_en` AS s5_name_en, "
                . "`s5`.`secondName_en` AS s5_secondName_en, "
                . "`s5`.`company` AS s5_company, "
                . "`s5`.`cityName` AS s5_cityName, "
                . "`s6`.`name` AS s6_name, "
                . "`s6`.`secondName` AS s6_secondName, "
                . "`s6`.`name_en` AS s6_name_en, "
                . "`s6`.`secondName_en` AS s6_secondName_en, "
                . "`s6`.`company` AS s6_company, "
                . "`s6`.`cityName` AS s6_cityName, "
                . "`s7`.`name` AS s6_name, "
                . "`s7`.`secondName` AS s6_secondName, "
                . "`s7`.`name_en` AS s6_name_en, "
                . "`s7`.`secondName_en` AS s6_secondName_en, "
                . "`s7`.`company` AS s6_company, "
                . "`s7`.`cityName` AS s6_cityName, "
                . "`s8`.`name` AS s6_name, "
                . "`s8`.`secondName` AS s6_secondName, "
                . "`s8`.`name_en` AS s6_name_en, "
                . "`s8`.`secondName_en` AS s6_secondName_en, "
                . "`s8`.`company` AS s6_company, "
                . "`s8`.`cityName` AS s6_cityName, "
                . "`s9`.`name` AS s6_name, "
                . "`s9`.`secondName` AS s6_secondName, "
                . "`s9`.`name_en` AS s6_name_en, "
                . "`s9`.`secondName_en` AS s6_secondName_en, "
                . "`s9`.`company` AS s6_company, "
                . "`s9`.`cityName` AS s6_cityName, "
                . "`s10`.`name` AS s6_name, "
                . "`s10`.`secondName` AS s6_secondName, "
                . "`s10`.`name_en` AS s6_name_en, "
                . "`s10`.`secondName_en` AS s6_secondName_en, "
                . "`s10`.`company` AS s6_company, "
                . "`s10`.`cityName` AS s6_cityName, "
                . "`s11`.`name` AS s6_name, "
                . "`s11`.`secondName` AS s6_secondName, "
                . "`s11`.`name_en` AS s6_name_en, "
                . "`s11`.`secondName_en` AS s6_secondName_en, "
                . "`s11`.`company` AS s6_company, "
                . "`s11`.`cityName` AS s6_cityName, "
                . "`s12`.`name` AS s6_name, "
                . "`s12`.`secondName` AS s6_secondName, "
                . "`s12`.`name_en` AS s6_name_en, "
                . "`s12`.`secondName_en` AS s6_secondName_en, "
                . "`s12`.`company` AS s6_company, "
                . "`s12`.`cityName` AS s6_cityName"
                . "FROM `product` "
                . "LEFT JOIN `place` ON `place`.`id` = `product`.`placeId` "
                . "LEFT JOIN `speaker` AS s1 ON `s1`.`id` = `product`.`speakerId` "
                . "LEFT JOIN `speaker` AS s2 ON `s2`.`id` = `product`.`speaker2Id` "
                . "LEFT JOIN `speaker` AS s3 ON `s3`.`id` = `product`.`speaker3Id` "
                . "LEFT JOIN `speaker` AS s4 ON `s4`.`id` = `product`.`speaker4Id` "
                . "LEFT JOIN `speaker` AS s5 ON `s5`.`id` = `product`.`speaker5Id` "
                . "LEFT JOIN `speaker` AS s6 ON `s6`.`id` = `product`.`speaker6Id` "
                . "LEFT JOIN `speaker` AS s6 ON `s6`.`id` = `product`.`speaker7Id` "
                . "LEFT JOIN `speaker` AS s6 ON `s6`.`id` = `product`.`speaker8Id` "
                . "LEFT JOIN `speaker` AS s6 ON `s6`.`id` = `product`.`speaker9Id` "
                . "LEFT JOIN `speaker` AS s6 ON `s6`.`id` = `product`.`speaker10Id` "
                . "LEFT JOIN `speaker` AS s6 ON `s6`.`id` = `product`.`speaker11Id` "
                . "LEFT JOIN `speaker` AS s6 ON `s6`.`id` = `product`.`speaker12Id` "
                . "WHERE `product`.`status` = '{$status}'";
        if ($areaId) {
            $sql .= " AND `product`.`areaId` = ".intval($areaId);
        }
        if ($onlyAllowed) {
            $sql .= " AND `product`.`showInSchedule` = 1";
        }
        if ($limit) {
            $sql .= " LIMIT $limit, 50";
        }
        $sql .= " ORDER BY `product`.`eventTsStart`";
        return $this->getByAnySQL($sql);
    }
    
    public function getAllActiveBySpeakerId($speakerId = null, $onlyAllowed = false) {
        $status = BaseTicket::STATUS_ENABLED;
        $condition = "status = '{$status}'";
        if ($speakerId) {
            $speakerId = intval($speakerId);
            $condition .= " AND speakerId = {$speakerId}";
        }
        if ($onlyAllowed) {
            $condition .= " AND showInSchedule = 1";
        }
        $sql = new SQLCondition($condition);
        $sql->orderBy = "eventTsStart";
        return $this->get($sql);
    }

    public function getByIds($productIds, $status = null) {
        if (!$productIds)
            return null;

        if (count($productIds) == 0)
            return null;

        $statusSQL = '';
        if ($status != null)
            $statusSQL = " AND status = '{$status}' ";

        $ids = implode(",", $productIds);
        $res = $this->get(new SQLCondition("id IN ($ids)" . $statusSQL, null, "id"));

        return Utility::sort($productIds, $res);
    }

    public function getFewProducts($quantity) {
        $quantity = intval($quantity);
        $sql = new SQLCondition("leftCount < {$quantity}");
        $sql->orderBy = "leftCount";
        return $this->get($sql);
    }

    public function getLotsProducts($quantity) {
        $quantity = intval($quantity);
        $sql = new SQLCondition("leftCount > {$quantity}");
        $sql->orderBy = "leftCount DESC";
        return $this->get($sql);
    }

    public function getFilteredProductsIds($filterArray) {
        $res = null;
        // не выбран ни один фильтр
        if ($filterArray['basicfilter'] == 1) {
            $sql = "SELECT id FROM product ORDER BY eventTsStart, areaId";
            $res = $this->getColumn($sql);
        } else {
            $allConditions = array();
            if ($filterArray["basicfilter"] == 2) {
                if ($filterArray["id"]) {
                    $allConditions[] = "id = {$filterArray["id"]}";
                }
                if ($filterArray["prog"]) {
                    $allConditions[] = "areaId = {$filterArray['prog']}";
                }
                if ($filterArray["place"]) {
                    $allConditions[] = "placeId = {$filterArray['place']}";
                }
                if ($filterArray["status"]) {
                    $allConditions[] = "status = '{$filterArray['status']}'";
                }
                if (count($allConditions) > 0) {
                    $allConditions = " WHERE " . implode(" AND ", $allConditions);
                }

                $sql = "SELECT id FROM product {$allConditions} ORDER BY eventTsStart, areaId";
                $res = $this->getColumn($sql);
            }
        }
        return $res;
    }
    
    public function updateExtID($productId, $extId) {
        $productId = intval($productId);
        $query = "UPDATE product SET ext_id = '{$extId}' WHERE id = {$productId}";
        $this->executeNonQuery($query);
    }
    
    public function tagToCssClass($value) {
        $arr = explode(" ", $value);
        $str = '';
        foreach ($arr as $v) {
            if ($v == "#ЦЕНТРАЛЬНАЯПЛОЩАДЬ") {
                $str .= " tag_mainstreet";
            } elseif ($v == "#GASTREETНОЧЬЮ") {
                $str .= " tag_gastreetnight";
            } else {
                $str .= " tag_".str_replace("#", "", mb_strtolower($v));
            }
        }
        return $str;
    }
}