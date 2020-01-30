<?php
/**
 * Менеджер
 */
class AreaToDiscountLinkManager extends BaseEntityManager
{
    public function getAll()
    {
        return $this->get();
    }

    public function getAreaIdsByDiscountId($discountId)
    {
        $discountId = intval($discountId);
        $sql = "SELECT areaId FROM areaToDiscountLink WHERE discountId = {$discountId}";
        $res = $this->getColumn($sql);
        return $res;
    }

    public function getAreaByDiscountIdAreaId($discountId, $areaId)
    {
        $discountId = intval($discountId);
        $areaId = intval($areaId);
        return $this->getOne(new SQLCondition("discountId = {$discountId} AND areaId = {$areaId}"));
    }

    public function removeLinksForDiscount($discountId)
    {
        $query = "DELETE FROM areaToDiscountLink WHERE discountId = {$discountId}";
        $this->executeNonQuery($query);
    }

    public function bulkInsertForDiscount($discountId, $areaIds)
    {
        if (!count($areaIds)) {
            return false;
        }

        $sql = "INSERT INTO areaToDiscountLink (discountId, areaId) VALUES ";
        $insertValueParts = array();
        foreach ($areaIds AS $areaId) {
            $areaId = intval($areaId);
            $discountId = intval($discountId);
            if ($areaId && $discountId) {
                $insertValueParts[] = "({$discountId}, {$areaId})";
            }
        }
        if (count($insertValueParts)) {
            $sql = $sql . implode(',', $insertValueParts);
            $this->executeNonQuery($sql);
        }

    }

}
