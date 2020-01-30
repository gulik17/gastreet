<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 13.02.17
 * Time: 9:30
 */
class VideoManager extends BaseEntityManager {

    public function getAll() {
        $sql = new SQLCondition();
        $sql->orderBy = 'sortOrder, id';
        return $this->get($sql);
    }

    public function getActive($limit = 0) {
        $sql = new SQLCondition("status = '" . Video::STATUS_ENABLED . "'");
        $sql->orderBy = "sortOrder, id";

        if ($limit) {
            $sql->offset = 0;
            $sql->rows = $limit;
        }
        return $this->get($sql);
    }

    public function delVideo($id) {
        $id = intval($id);
        $file = $id . '.jpg';
        $this->remove($id);
        @unlink(Configurator::get("application:videoFolder") . "resized/" . $file);
        @unlink(Configurator::get("application:videoFolder") . "uploaded/" . $file);
    }

}
