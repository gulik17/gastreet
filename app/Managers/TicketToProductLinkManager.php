<?php

/**
 * Менеджер
 */
class TicketToProductLinkManager extends BaseEntityManager {

    public function getAll() {
        return $this->get();
    }

    public function getProductIdsByBaseTicketId($baseTicketId) {
        $baseTicketId = intval($baseTicketId);
        $sql = "SELECT productId FROM ticketToProductLink WHERE baseTicketId = {$baseTicketId}";
        $res = $this->getColumn($sql);
        return $res;
    }

    public function checkByBaseTicketIdAndProductId($baseTicketId, $productId) {
        $baseTicketId = intval($baseTicketId);
        $productId = intval($productId);
        $sql = "SELECT productId FROM ticketToProductLink WHERE baseTicketId = {$baseTicketId} AND productId = {$productId}";
        $res = $this->getColumn($sql);
        return $res;
    }

    public function getBaseTicketIdsByProductId($productId) {
        $productId = intval($productId);
        $sql = "SELECT baseTicketId FROM ticketToProductLink WHERE productId = {$productId}";
        $res = $this->getColumn($sql);
        return $res;
    }

    public function removeLinksForTicket($baseTicketId) {
        $query = "DELETE FROM ticketToProductLink WHERE baseTicketId = {$baseTicketId}";
        $this->executeNonQuery($query);
    }

    public function removeLinksForProduct($productId) {
        $query = "DELETE FROM ticketToProductLink WHERE productId = {$productId}";
        $this->executeNonQuery($query);
    }

    public function bulkInsertForTicket($baseTicketId, $productIds) {
        if (!count($productIds)) {
            return false;
        }

        $sql = "INSERT INTO ticketToProductLink (baseTicketId, productId) VALUES ";
        $insertValueParts = array();
        foreach ($productIds AS $productId) {
            $productId = intval($productId);
            $baseTicketId = intval($baseTicketId);
            if ($productId && $baseTicketId) {
                $insertValueParts[] = "({$baseTicketId}, {$productId})";
            }
        }
        if (count($insertValueParts)) {
            $sql = $sql . implode(',', $insertValueParts);
            $this->executeNonQuery($sql);
        }
    }

}
