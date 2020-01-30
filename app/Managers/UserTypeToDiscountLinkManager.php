<?php
/**
 * Менеджер
 */
class UserTypeToDiscountLinkManager extends BaseEntityManager
{
    public function getAll()
    {
        return $this->get();
    }

    public function getUserTypeIdsByDiscountId($discountId)
    {
        $discountId = intval($discountId);
        $sql = "SELECT userTypeId FROM userTypeToDiscountLink WHERE discountId = {$discountId}";
        $res = $this->getColumn($sql);
        return $res;
    }

    public function getUserTypeByDiscountIdUserTypeId($discountId, $userTypeId)
    {
        $discountId = intval($discountId);
        $userTypeId = intval($userTypeId);
        return $this->getOne(new SQLCondition("discountId = {$discountId} AND userTypeId = {$userTypeId}"));
    }

    public function removeLinksForDiscount($discountId)
    {
        $query = "DELETE FROM userTypeToDiscountLink WHERE discountId = {$discountId}";
        $this->executeNonQuery($query);
    }

    public function bulkInsertForDiscount($discountId, $userTypeIds)
    {
        if (!count($userTypeIds)) {
            return false;
        }

        $sql = "INSERT INTO userTypeToDiscountLink (discountId, userTypeId) VALUES ";
        $insertValueParts = array();
        foreach ($userTypeIds AS $userTypeId) {
            $userTypeId = intval($userTypeId);
            $discountId = intval($discountId);
            if ($userTypeId && $discountId) {
                $insertValueParts[] = "({$discountId}, {$userTypeId})";
            }
        }
        if (count($insertValueParts)) {
            $sql = $sql . implode(',', $insertValueParts);
            $this->executeNonQuery($sql);
        }

    }

}
