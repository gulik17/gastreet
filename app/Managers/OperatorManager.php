<?php

/**
 * Менеджер управления операторами
 */
class OperatorManager extends BaseEntityManager {

    /**
     * Функция возвращает покупателя с заданным логином
     * 
     * @param string $login login пользователя
     * @return Operator
     */
    public function getByLogin($login) {
        return $this->getOne(new SQLCondition("login = '" . $login . "'"));
    }

    /**
     * Функция осуществляет регистрацию оператора
     * 
     * @param array $regData
     * @return Operator
     */
    public function registerNewOperator($regData) {
        $newOper = null;

        try {
            $oper = new User();
            $oper->dateCreate = time();
            $oper->login = $regData['email'];
            $oper->password = md5(md5($regData['password']) . md5($regData['password']));
            $oper->name = $regData['name'];
            $oper->phone = $regData['phone'];
            $oper->entityStatus = User::ENTITY_STATUS_ACTIVE;
            $newOper = $this->save($oper);
        } catch (Exception $e) {
            throw new Exception("Не удалось создать оператора: " . $e->getMessage());
        }

        return $newOper;
    }

    /**
     * Функция возвращает список операторов по заданному
     * списку идентификаторов
     * 
     * @param array $userIds Список ID пользователей
     * @param string $status Статус пользователей
     * @return array of Users
     */
    public function getList($userIds, $status = null) {
        if (count($userIds) == 0)
            return null;

        $statusSQL = "";
        if ($status != null)
            $statusSQL = " AND status = '{$status}' ";

        $ids = implode(", ", $userIds);
        $sql = new SQLCondition("id IN ({$ids})" . $statusSQL);
        $users = $this->get($sql);
        return $users;
    }

    /*
     * Функция отдает список операторов по массиву id
     *
     * @param array $ids
     * @return array пользователей users
     */

    public function getByIds($userIds) {
        if (!$userIds)
            return null;

        if (count($userIds) == 0)
            return null;

        $idsStr = implode(",", $userIds);
        $res = $this->get(new SQLCondition("id IN ($idsStr)", null, "id"));
        return Utility::sort($userIds, $res);
    }

    /*
     * Функция отдает список всех владельцев
     *
     * @return array пользователей users
     */

    public function getAll() {
        $sql = new SQLCondition();
        return $this->get($sql);
    }
    
    public function getOperatorIds($type = null) {
        $res = null;
        $sql = "SELECT id FROM operator ";
        if ($type) {
            $sql .= " WHERE type = '{$type}' ";
        }
        $sql .= " ORDER BY id DESC";
        return $this->getColumn($sql);
    }
}