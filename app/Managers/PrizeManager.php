<?php

class PrizeManager extends BaseEntityManager
{
    public function getByIds($newsIds)
    {
        if (!$newsIds)
            return null;
        $ids = implode(",", $newsIds);
        $res = $this->get(new SQLCondition("id in ($ids)", null, "showDate DESC"));
        return Utility::sort($newsIds, $res);
    }

    public function getAll()
    {
        $sql = new SQLCondition();
        return $this->get($sql);
    }

    public function getActive($type = Prize::TYPE_NEWS)
    {
        $sql = new SQLCondition("status = '" . Prize::STATUS_ENABLED . "' AND type = '" . $type . "'");
        $sql->orderBy = "id DESC";
        return $this->get($sql);
    }
    
    public function delPrize($id)
    {
        $id = intval($id);
        $file = $id . '.jpg';
        $this->remove($id);
        @unlink(Configurator::get("application:prizesFolder") . "resized/" . $file);
        @unlink(Configurator::get("application:prizesFolder") . "uploaded/" . $file);
    }
}
