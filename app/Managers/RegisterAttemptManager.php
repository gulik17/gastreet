<?php

/**
 * Класс для управления пользовательсткими данными
 * 
 */
class RegisterAttemptManager extends BaseEntityManager {

    /**
     * Функция добавления нового пользователя по телефону и коду из смс
     * 
     * @param string $phone Телефон юзера
     * @param integer $code Код из смс
     * 
     * @return void
     * 
     */
    public static function add($phone, $code) {
        $ram = new RegisterAttemptManager();
        $ramObject = new RegisterAttempt();
        $ramObject->phone = $phone;
        $ramObject->code = $code;
        $ramObject->ip = Utility::getClientIp();
        $ramObject->ts = time();
        $ramObject->client = (isset($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : null;
        $ramObject = $ram->save($ramObject);
        return $ramObject;
    }

    /**
     * Проверяет как давно был зарегистрирован пользователь
     * 
     * @param string $phone Телефон юзера
     * 
     * @return boolean
     * 
     */
    public static function hasAttemptLast2Minutes($phone) {
        $ts = time() - 60 * 2;
        $ram = new RegisterAttemptManager();
        $sql = "SELECT id FROM registerAttempt WHERE phone = '{$phone}' AND ts >= {$ts} LIMIT 1";
        $rez = $ram->getColumn($sql);
        if (count($rez) > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Функция возвращает массив ID пользователей по фильтру
     * 
     * @param array $filterArray Массив фильтров
     * 
     * @return mixed
     * 
     */
    public function getFilteredAttemptIds($filterArray) {
        // не выбран ни один фильтр
        if ($filterArray['basicfilter'] == 1) {
            $sql = "SELECT id FROM registerAttempt ORDER BY id DESC";
            $res = $this->getColumn($sql);
            return $res;
        }
        $res = null;
        $allConditions = array();
        if ($filterArray["basicfilter"] == 2) {
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

    /**
     * Функция возвращает массив пользователей по ID
     * 
     * @param array $attemptIds Массив ID для выборки
     * 
     * @return mixed
     * 
     */
    public function getByIds($attemptIds) {
        if (!$attemptIds)
            return null;
        if (count($attemptIds) == 0)
            return null;
        $ids = implode(",", $attemptIds);
        $res = $this->get(new SQLCondition("id IN ($ids)", null, "id"));
        return Utility::sort($attemptIds, $res);
    }
}