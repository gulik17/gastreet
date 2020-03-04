<?php

/**
 * Менеджер
 */
class BaseTicketManager extends BaseEntityManager {

    public function getAll() {
        return $this->get();
    }

    public function getAllActive() {
        $status = BaseTicket::STATUS_ENABLED;
        $sql = new SQLCondition("status = '{$status}'");
        $sql->orderBy = "price DESC";
        //$sql->orderBy = "id";
        return $this->get($sql);
    }

    public function getFewTickets($quantity) {
        $quantity = intval($quantity);
        $sql = new SQLCondition("leftCount < {$quantity}");
        $sql->orderBy = "leftCount";
        return $this->get($sql);
    }

    public function getLotsTickets($quantity) {
        $quantity = intval($quantity);
        $sql = new SQLCondition("leftCount > {$quantity}");
        $sql->orderBy = "leftCount DESC";
        return $this->get($sql);
    }

    public function getByIds($ticketIds) {
        if (!$ticketIds)
            return null;

        if (count($ticketIds) == 0)
            return null;

        $ids = implode(",", $ticketIds);
        $res = $this->get(new SQLCondition("id IN ($ids)", null, "id"));

        return Utility::sort($ticketIds, $res);
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

}
