<?php

/**
 * Менеджер
 */
class SpeakerManager extends BaseEntityManager {
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

    public function getAll($sortType = "sortOrder, name") {
        $sql = new SQLCondition();
        $sql->orderBy = $sortType;
        return $this->get($sql);
    }

    public function getActive($limit = 0, $sortType = "sortOrder, name") {
        $sql = "SELECT `s`.*, `p`.`pic` AS p_pic FROM `speaker` AS s LEFT JOIN `parthner` AS p ON `p`.`id` = `s`.`partner_id` WHERE `s`.`status` = '" . Speaker::STATUS_ENABLED . "' ORDER BY $sortType DESC";
        if ($limit) {
            $sql .= " LIMIT 0, $limit";
        }
        return $this->getByAnySQL($sql);
    }

    public function getActiveByTag($tag, $tag2 = null, $limit = 0, $sortType = "sortOrder, name") {
        if ($tag2 != null) {
            $sql = "SELECT `s`.*, `p`.`pic` AS p_pic FROM `speaker` AS s LEFT JOIN `parthner` AS p ON `p`.`id` = `s`.`partner_id` WHERE `s`.`status` = '" . Speaker::STATUS_ENABLED . "' AND `tags` LIKE '%#{$tag}%' AND tags LIKE '%#{$tag2}%' ORDER BY $sortType DESC";
            //$sql = new SQLCondition("status = '" . Speaker::STATUS_ENABLED . "' AND tags LIKE '%#{$tag}'");
        } else {
            $sql = "SELECT `s`.*, `p`.`pic` AS p_pic FROM `speaker` AS s LEFT JOIN `parthner` AS p ON `p`.`id` = `s`.`partner_id` WHERE `s`.`status` = '" . Speaker::STATUS_ENABLED . "' AND `tags` LIKE '%#{$tag}%' ORDER BY $sortType DESC";
        }

        if ($limit) {
            $sql .= " LIMIT 0, $limit";
        }

        return $this->getByAnySQL($sql);
    }
    
    public function getByTag($tag, $limit = 0, $sortType = "sortOrder, name") {
        $sql = new SQLCondition("tags LIKE '%#{$tag}%'");
        $sql->orderBy = $sortType;

        if ($limit) {
            $sql->offset = 0;
            $sql->rows = $limit;
        }
        return $this->get($sql);
    }

    public function delSpeaker($id) {
        $id = intval($id);
        $this->remove($id);
        // удалить ссылки на спикера
        $sql = "UPDATE `product` SET speakerId = NULL WHERE speakerId = {$id}";
        $this->executeNonQuery($sql);
    }
}