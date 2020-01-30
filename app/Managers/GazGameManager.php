<?php

/**
 * Менеджер
 */
class GazGameManager extends BaseEntityManager {
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
        $sql = "SELECT `gazGame`.*, `user`.`phone`, `user`.`email`, `user`.`name`, `user`.`lastname`, `user`.`cityName`, `user`.`countryName`, `user`.`company`, `user`.`position`, `baseTicket`.`name` AS baseTicketName FROM `gazGame` LEFT JOIN `user` ON `user`.`id` = `gazGame`.`user_id` LEFT JOIN `baseTicket` ON `baseTicket`.`id` = `user`.`baseTicketId`";
        $res = $this->getByAnySQL($sql);
        return $res;
    }
    
    public function getLastTeamId() {
        $sql = "SELECT * FROM `gazGame` ORDER BY `gazGame`.`id` DESC LIMIT 0, 1";
        $res = $this->getByAnySQL($sql);
        return $res;
    }
}