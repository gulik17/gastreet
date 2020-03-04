<?php
/**
*/
class UserReportManager extends BaseEntityManager
{
	public function getByIds($newsIds)
	{
		if (!$newsIds)
			return null;
		
		$ids = implode(",", $newsIds);
		$res = $this->get(new SQLCondition("id in ($ids)"));
		return $res;
	}

	public function getAll($sortOrder = "id")
	{
		$sql = new SQLCondition();
        $sql->orderBy = $sortOrder;
		return $this->get($sql);
	}

    public function getReportByPerion($tsStart, $tsFinish)
    {
        $tsStart = intval($tsStart);
        $tsFinish = intval($tsFinish);
        return $this->get(new SQLCondition("tsStart = $tsStart AND tsFinish = $tsFinish"));
    }

    public function getSomeProcessingReports($limit = 5)
    {
        $sql = new SQLCondition("tsGenerateFinish IS NULL");
        $sql->offset = 0;
        $sql->rows = $limit;
        return $this->get($sql);
    }


}
