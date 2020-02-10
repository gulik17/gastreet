<?php

/**
 * Менеджер
 */
class FolkSpeakerManager extends BaseEntityManager {

    public function getByIds($inpIds) {
        if ( (!$inpIds) || (count($inpIds) == 0) ) {
            return null;
        }
        $ids = implode(",", $inpIds);
        $res = $this->get(new SQLCondition("id IN ($ids)", null, "id"));
        return Utility::sort($inpIds, $res);
    }

    public function getAll($sortType = "sort_order, last_name") {
        $sql = new SQLCondition();
        $sql->orderBy = $sortType;
        return $this->get($sql);
    }

    public function getActive($limit = 0, $sortType = "sort_order, last_name") {
        $sql = "SELECT `fs`.*, count(`fp`.`id`) AS fp_count FROM `folkSpeaker` AS fs LEFT JOIN `folkPhones` AS fp ON `fp`.`speaker_id` = `fs`.`id` AND `fp`.`status` = '".FolkPhones::STATUS_CONFIRM."' WHERE `fs`.`status` = '" . FolkSpeaker::STATUS_ENABLED . "' ORDER BY $sortType DESC";
        if ($limit) {
            $sql .= " LIMIT 0, $limit";
        }
        return $this->getByAnySQL($sql);
    }

    public function delSpeaker($id) {
        $id = intval($id);
        $this->remove($id);
    }
}
