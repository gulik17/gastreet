<?php

/**
 * Менеджер
 */
class CustomBroadcastManager extends BaseEntityManager {

    public function getAll() {
        $sql = new SQLCondition();
        $sql->orderBy = 'tsCreated desc';
        return $this->get($sql);
    }

    /**
     * @param $broadcast CustomBroadcast
     */
    public function runBroadcast($cbmObj) {
        $timeStamp = time();
        // надо набрать те userId, которые подпадают под выбранные условия
        $um = new UserManager();
        if ($cbmObj->userType == 1001) {
            // зарегистрировались
            $sql = "SELECT id FROM user WHERE disableBroadcast WHERE (disableBroadcast = 0 OR disableBroadcast IS NULL) AND status = 'STATUS_REGISTERED'";
            $registeredUserIds = $um->getColumn($sql);

            // но ничего не купили
            // получить список покупателей
            $bm = new BasketManager();
            $allPaidTickets = $bm->getAllPaidTickets();
            $allPaidTicketIds = array();
            if (is_array($allPaidTickets) && count($allPaidTickets)) {
                foreach ($allPaidTickets AS $onePaidTicket) {
                    if ($onePaidTicket->childId) {
                        $allPaidTicketIds[$onePaidTicket->childId] = $onePaidTicket->childId;
                    } else {
                        $allPaidTicketIds[$onePaidTicket->userId] = $onePaidTicket->userId;
                    }
                }
            }

            // сделать инсерты
            foreach ($registeredUserIds AS $oneRegisteredUserId) {
                if (!in_array($oneRegisteredUserId, $allPaidTicketIds)) {
                    $sql = "INSERT IGNORE INTO broadcastQueue (broadcastId, userId, tsCreated, tsUpdated) VALUES ({$cbmObj->id}, {$oneRegisteredUserId}, {$timeStamp}, {$timeStamp})";
                    $this->executeNonQuery($sql);
                }
            }
        } else if ($cbmObj->userType == 1002) {
            // купил заданный основной билет
            $ticketId = $cbmObj->ticketId;
            $bm = new BasketManager();
            $paidTickets = $bm->getPaidTicketsByTicketId($ticketId);
            if (is_array($paidTickets) && count($paidTickets)) {
                foreach ($paidTickets AS $onePaidTicket) {
                    if ($onePaidTicket->childId) {
                        $setUserId = $onePaidTicket->childId;
                    } else {
                        $setUserId = $onePaidTicket->userId;
                    }
                    $sql = "INSERT IGNORE INTO broadcastQueue (broadcastId, userId, tsCreated, tsUpdated) VALUES ({$cbmObj->id}, {$setUserId}, {$timeStamp}, {$timeStamp})";
                    $this->executeNonQuery($sql);
                }
            }
        } else if ($cbmObj->userType == 1003) {
            // купил заданный мастер-класс
            $productId = $cbmObj->productId;
            $bmp = new BasketProductManager();
            $paidProducts = $bmp->getPaidProductsByProductId($productId);
            if (is_array($paidProducts) && count($paidProducts)) {
                foreach ($paidProducts AS $onePaidProduct) {
                    if ($onePaidProduct->childId) {
                        $setUserId = $onePaidProduct->childId;
                    } else {
                        $setUserId = $onePaidProduct->userId;
                    }
                    $sql = "INSERT IGNORE INTO broadcastQueue (broadcastId, userId, tsCreated, tsUpdated) VALUES ({$cbmObj->id}, {$setUserId}, {$timeStamp}, {$timeStamp})";
                    $this->executeNonQuery($sql);
                }
            }
        } else if ($cbmObj->userType > 0) {
            $sql = 'INSERT INTO `broadcastQueue` (`id`, `broadcastId`, `userId`, `status`, `tsCreated`, `tsUpdated`) ' .
                    'SELECT NULL, ' . $cbmObj->id . ', `id`, NULL, ' . $timeStamp . ', ' . $timeStamp .
                    ' FROM `user` WHERE (`disableBroadcast` = 0 OR `disableBroadcast` IS NULL) AND `typeId` = ' . $cbmObj->userType;

            $this->executeNonQuery($sql);
        } else {
            $sql = 'INSERT INTO `broadcastQueue` (`id`, `broadcastId`, `userId`, `status`, `tsCreated`, `tsUpdated`) ' .
                    'SELECT NULL, ' . $cbmObj->id . ', `id`, NULL, ' . $timeStamp . ', ' . $timeStamp .
                    ' FROM `user` WHERE (`disableBroadcast` = 0 OR `disableBroadcast` IS NULL)';

            $this->executeNonQuery($sql);
        }
    }

    /**
     * @param $broadcast CustomBroadcast
     * @return array
     */
    public function getQueueSize($broadcast) {
        $sql = 'SELECT COUNT(*) from `broadcastQueue` WHERE `broadcastId`=\'' . $broadcast->id . '\'';
        return $this->getByAnySQL($sql)[0]['COUNT(*)'];
    }

    /**
     * @param $broadcast CustomBroadcast
     * @return array
     */
    public function getSendCount($broadcast) {
        $sql = 'SELECT COUNT(*) from `broadcastQueue` WHERE `broadcastId`=\'' . $broadcast->id . '\' AND `status`=1';
        return $this->getByAnySQL($sql)[0]['COUNT(*)'];
    }

    /**
     * @param $broadcast CustomBroadcast
     * @return array
     */
    public function getNotSendCount($broadcast) {
        $sql = 'SELECT COUNT(*) from `broadcastQueue` WHERE `broadcastId`=\'' . $broadcast->id . '\' AND `status`=0';
        return $this->getByAnySQL($sql)[0]['COUNT(*)'];
    }

    /**
     * @param $broadcast CustomBroadcast
     * @return array
     */
    public function getNewCount($broadcast) {
        $sql = 'SELECT COUNT(*) from `broadcastQueue` WHERE `broadcastId`=\'' . $broadcast->id . '\' AND `status` IS NULL';
        return $this->getByAnySQL($sql)[0]['COUNT(*)'];
    }

    public function getBroadcastPortion($type, $numberOfMessages = 20) {
        $timeStamp = time();
        if ($type == CustomBroadcast::TYPE_EMAIL) {
            $sql = 'SELECT `broadcastQueue`.`id`,`user`.`email`,`user`.`disableBroadcastKey`,`customBroadcast`.`message`,`customBroadcast`.`subject` FROM `broadcastQueue` ' .
                    'JOIN `customBroadcast` ON `customBroadcast`.`type`=\'' . CustomBroadcast::TYPE_EMAIL . '\' AND `customBroadcast`.`id`=`broadcastQueue`.`broadcastId` ' .
                    'JOIN `user` ON `broadcastQueue`.`userId` = `user`.`id` WHERE `broadcastQueue`.`status` IS NULL LIMIT ' . intval($numberOfMessages);

            return $this->getByAnySQL($sql);
        }
        if ($type == CustomBroadcast::TYPE_SMS) {
            $sql = 'SELECT `broadcastQueue`.`id`,`user`.`phone`,`customBroadcast`.`sms` FROM `broadcastQueue` ' .
                    'JOIN `customBroadcast` ON `customBroadcast`.`type`=\'' . CustomBroadcast::TYPE_SMS . '\' AND `customBroadcast`.`id`=`broadcastQueue`.`broadcastId` ' .
                    'JOIN `user` ON `broadcastQueue`.`userId` = `user`.`id` WHERE `broadcastQueue`.`status` IS NULL LIMIT ' . intval($numberOfMessages);

            return $this->getByAnySQL($sql);
        }
    }
}