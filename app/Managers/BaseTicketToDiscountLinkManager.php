<?php
/**
 * Менеджер
 */
class BaseTicketToDiscountLinkManager extends BaseEntityManager
{
    public function getAll()
    {
        return $this->get();
    }

    public function getBaseTicketIdsByDiscountId($discountId)
    {
        $discountId = intval($discountId);
        $sql = "SELECT baseTicketId FROM baseTicketToDiscountLink WHERE discountId = {$discountId}";
        $res = $this->getColumn($sql);
        return $res;
    }

    public function getBaseTicketByDiscountIdBaseTicketId($discountId, $baseTicketId)
    {
        $discountId = intval($discountId);
        $baseTicketId = intval($baseTicketId);
        return $this->getOne(new SQLCondition("discountId = {$discountId} AND baseTicketId = {$baseTicketId}"));
    }

    public function removeLinksForDiscount($discountId)
    {
        $query = "DELETE FROM baseTicketToDiscountLink WHERE discountId = {$discountId}";
        $this->executeNonQuery($query);
    }

    public function bulkInsertForDiscount($discountId, $baseTicketIds)
    {
        if (!count($baseTicketIds)) {
            return false;
        }

        $sql = "INSERT INTO baseTicketToDiscountLink (discountId, baseTicketId) VALUES ";
        $insertValueParts = array();
        foreach ($baseTicketIds AS $baseTicketId) {
            $baseTicketId = intval($baseTicketId);
            $discountId = intval($discountId);
            if ($baseTicketId && $discountId) {
                $insertValueParts[] = "({$discountId}, {$baseTicketId})";
            }
        }
        if (count($insertValueParts)) {
            $sql = $sql . implode(',', $insertValueParts);
            $this->executeNonQuery($sql);
        }

    }

}
