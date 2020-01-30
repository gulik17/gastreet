<?php

/**
 * Менеджер
 */
class ChefOlimpicManager extends BaseEntityManager {
    public function getByIds($inpIds) {
        if (!$inpIds) {
            return null;
        }
        if (count($inpIds) == 0) {
            return null;
        }
        $ids = implode(",", $inpIds);
        $res = $this->get(new SQLCondition("user_id IN ($ids)", null, "id"));
        return Utility::sort($inpIds, $res);
    }

    public function getByUserId($user_id) {
        if (!$user_id) {
            return null;
        }
        return $this->get(new SQLCondition("user_id = $user_id", null, "id"));
    }

    public function getAll() {
        $sql = new SQLCondition();
        $sql->orderBy = "id";
        return $this->get($sql);
    }

    public function getDataAll() {
        $sql = "SELECT `chefOlimpic`.*, `user`.`phone`, `user`.`email`, `user`.`name`, `user`.`lastname`, `user`.`cityName`, `user`.`countryName`, `user`.`company`, `user`.`position`, `baseTicket`.`name` AS baseTicketName FROM `chefOlimpic` LEFT JOIN `user` ON `user`.`id` = `chefOlimpic`.`user_id` LEFT JOIN `baseTicket` ON `baseTicket`.`id` = `user`.`baseTicketId`";
        $res = $this->getByAnySQL($sql);
        return $res;
    }

    public function getActive() {
        $sql = new SQLCondition("status <> '" . Speaker::STATUS_DISABLED . "'");
        $sql->orderBy = "id";
        return $this->get($sql);
    }
}