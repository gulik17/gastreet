<?php

/**
 * Менеджер очереди задач
 */
class QueueMysqlManager extends BaseEntityManager {

    // получить N записей в порядке естественного возрастания id
    public function getSomeNewTasks($limit = 5) {
        $sql = new SQLCondition("`dateStart` IS NULL AND `isError` = '0'");
        $sql->offset = 0;
        $sql->rows = $limit;
        return $this->get($sql);
    }

    // быстрая установка даты старта задачи
    public function setStartDate($id) {
        $sql = "UPDATE `queueMysql` SET `dateStart` = " . time() . " WHERE `id` = $id";
        $this->executeNonQuery($sql);
        return true;
    }

    // быстрая установка даты окончания задачи
    public function setFinishDate($id, $boolRez) {
        // сразу удаляем эти записи, т.к. у нас есть уникальность по ним
        // а сообщение об ощибке лучше отправлять на почту (мониторинг)
        if ($boolRez) {
            $sql = "DELETE FROM `queueMysql` WHERE `id` = " . $id;
            $this->executeNonQuery($sql);
        } else {
            $sql = "UPDATE `queueMysql` SET `dateFinish` = ".time().", `isError` = 1, `isFinish` = '1' WHERE `id` = $id"; 
        }
        $this->executeNonQuery($sql);
        return true;
    }

    // безопасная постановка задачи в очередь INSERT IGNORE
    public function savePlaceTask($taskName, $fromUserId, $otherData = null, $dateCreate = null) {
        if (!$dateCreate) {
            $dateCreate = time();
        }
        if (!$fromUserId) {
            $fromUserId = "NULL";
        }
        if (!$otherData) {
            $otherData = "NULL";
        } else {
            $otherData = "'{$otherData}'";
        }
        $sql = "INSERT IGNORE INTO queueMysql (taskName, fromUserId, otherData, dateCreate) VALUES ('{$taskName}', {$fromUserId}, {$otherData}, {$dateCreate})";
        $this->executeNonQuery($sql);

        return true;
    }

    public function notifyProductCancel($fromUserId, $otherData, $dateCreate) {
        $otherData = @unserialize($otherData);
        if (!is_array($otherData)) {
            return false;
        }

        $productId = $otherData['productId'];
        $productStatus = $otherData['productStatus'];
        $productName = base64_decode($otherData['productName']);

        return UserManager::notifyProductCancel($productId, $productStatus, $productName);
    }

    public function sendTicketViaEmail($fromUserId, $otherData, $dateCreate) {
        $otherData = @unserialize($otherData);
        if (!is_array($otherData)) {
            return false;
        }
        $userId = $otherData['userId'];
        return UserManager::realSendTicketViaEmail($userId);
    }

}
