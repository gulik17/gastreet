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

    public function getAll($sortType = "`sort_order`, `last_name`") {
        $sql = new SQLCondition();
        $sql->orderBy = $sortType;
        return $this->get($sql);
    }

    public function getActive($limit = 0, $sortType = "`sort_order`, `last_name`") {
        $sql = "SELECT `fs`.* FROM `folkSpeaker` AS fs WHERE `fs`.`status` = '" . folkSpeaker::STATUS_ENABLED . "' ORDER BY $sortType DESC";
        if ($limit) {
            $sql .= " LIMIT 0, $limit";
        }
        $result = $this->getByAnySQL($sql);
        foreach ($result AS &$item) {
            $sql = "SELECT COUNT(id) as scount FROM `folkPhones` WHERE `status` = 'STATUS_CONFIRM' AND `speaker_id` = '{$item["id"]}'";
            $r = $this->getByAnySQL($sql);
            $item['fp_count'] = $r[0]['scount'];
           // deb($sql);
        }
        return $result;
    }

    public function delSpeaker($id) {
        $id = intval($id);
        $this->remove($id);
    }
}
