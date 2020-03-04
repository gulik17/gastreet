<?php
/**
 */
class MessageLogManager extends BaseEntityManager
{
    public function getFilteredLogIds($filterArray)
    {
        // не выбран ни один фильтр
        if ($filterArray['basicfilter'] == 1)
        {
            $sql = "SELECT id FROM messageLog ORDER BY id DESC";
            $res = $this->getColumn($sql);
            return $res;
        }

        $res = null;
        $allConditions = array();
        if ($filterArray["basicfilter"] == 2)
        {
            if ($filterArray["phone"]) {
                $allConditions[] = "phone like '%{$filterArray['phone']}%'";
            }
            if ($filterArray["email"]) {
                $allConditions[] = "email like '%{$filterArray['email']}%'";
            }
            if (count($allConditions) > 0) {
                $allConditions = " WHERE " . implode(" AND ", $allConditions);
            }

            $sql = "SELECT id FROM messageLog {$allConditions} ORDER BY id DESC";
            $res = $this->getColumn($sql);
        }

        return $res;
    }

    public function getByIds($logIds)
    {
        if (!$logIds)
            return null;

        if (count($logIds) == 0)
            return null;

        $ids = implode(",", $logIds);
        $res = $this->get(new SQLCondition("id IN ($ids)", null, "id"));

        return Utility::sort($logIds, $res);
    }


    public function getByUserIdAndTemplateId($userId, $templateId, $checkRemindPerion = 0) {
        $userId = intval($userId);
        $templateId = intval($templateId);
        $condition = "userId = {$userId} AND broadcastTemplateId = {$templateId}";
        if ($checkRemindPerion) {
            $ts = time();
            // выражаем дни в секундах
            $checkRemindPerion = $checkRemindPerion * 60 * 60 * 24;
            $condition .= " AND tsCreate + {$checkRemindPerion} > {$ts}";
        }
        return $this->get(new SQLCondition($condition));
    }
}