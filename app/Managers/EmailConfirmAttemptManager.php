<?php
/**
 */
class EmailConfirmAttemptManager extends BaseEntityManager
{
    public static function add($email, $confirmCode, $userId)
    {
        $ecam = new EmailConfirmAttemptManager();
        $ecamObj = new EmailConfirmAttempt();
        $ecamObj->userId = $userId;
        $ecamObj->email = $email;
        $ecamObj->confirmCode = $confirmCode;
        $ecamObj->status = EmailConfirmAttempt::STATUS_NEW;
        $ecamObj->ipGenerate = Utility::getClientIp();
        $ecamObj->tsGenerate = time();
        $ecamObj = $ecam->save($ecamObj);
        return $ecamObj;
    }

    public static function hasAttemptLast2Minutes($email)
    {
        $ts = time() - 60 * 2;
        $ram = new RegisterAttemptManager();
        $sql = "SELECT id FROM emailConfirmAttempt WHERE email = '{$email}' AND tsGenerate >= {$ts} LIMIT 1";
        $rez = $ram->getColumn($sql);
        if (count($rez) > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    public function getFilteredAttemptIds($filterArray)
    {
        // не выбран ни один фильтр
        if ($filterArray['basicfilter'] == 1)
        {
            $sql = "SELECT id FROM registerAttempt ORDER BY id DESC";
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
            if ($filterArray["ip"]) {
                $allConditions[] = "ip like '%{$filterArray['ip']}%'";
            }
            if (count($allConditions) > 0) {
                $allConditions = " WHERE " . implode(" AND ", $allConditions);
            }

            $sql = "SELECT id FROM registerAttempt {$allConditions} ORDER BY id DESC";
            $res = $this->getColumn($sql);
        }

        return $res;
    }

    public function getByIds($attemptIds)
    {
        if (!$attemptIds)
            return null;

        if (count($attemptIds) == 0)
            return null;

        $ids = implode(",", $attemptIds);
        $res = $this->get(new SQLCondition("id IN ($ids)", null, "id"));

        return Utility::sort($attemptIds, $res);
    }

    public function getByCode($confirmCode)
    {
        return $this->getOne(new SQLCondition("confirmCode = '{$confirmCode}'"));
    }

}

