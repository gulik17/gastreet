<?php

/**
 *
 */
class UserQrControl extends AuthorizedUserControl {
    public $pageTitle = "Файлы для скачивания — GASTREET 2021";
    public $pageTitle_en = " Print Ticket — GASTREET 2021";
    public $lang = "ru";

    public function render() {
        UserManager::redirectIfNoProfile($this->actor);
        $ts = time();
        $this->addData("ts", $ts);
        $this->addData("host", $this->host);
        $this->addData("actor", $this->actor);

        $qrm = new UserQrCodeManager();
        $qrmObj = $qrm->getOneActiveByUserId($this->actor->id);
        //deb($qrmObj);
        if (!$qrmObj) {
            // здесь проверим у кого не хватает QR кодов
            $um = new UserManager();
            $sql = "SELECT DISTINCT(u.id) AS userId FROM `user` AS u
                LEFT JOIN `userQrCode` AS q
                ON q.userId = u.id
                LEFT JOIN `basket` AS b
                ON b.userId = u.id OR b.childId = u.id
                WHERE q.code IS NULL AND (b.needAmount - b.discountAmount) <= (b.payAmount + b.ulAmount - b.returnedAmount) AND b.status = 'STATUS_PAID'";
            $userIds = $um->getColumn($sql);

            if (count($userIds)) {
                foreach ($userIds AS $userId) {
                    UserManager::createQrCode($userId);
                }
            }
        }

        $qrmObj = $qrm->getOneActiveByUserId($this->actor->id);
        if (!$qrmObj) {
            Enviropment::redirect("basket", "У Вас ещё нет оплаченных товаров");
        }

        $this->addData("qrmObj", $qrmObj);

        // отправка письма с билетом
        if ($this->actor->id == 14) {
            // UserManager::realSendTicketViaEmail($_GET['sid']);
            //UserManager::realSendTicketViaEmail(14);
        }

        // QR коды подопечных
        // id подопечных
        $childrenIds = array();
        $um = new UserManager();
        $children = $um->getByParentId($this->actor->id);
        if (is_array($children) && count($children)) {
            foreach ($children AS $child) {
                $childrenIds[$child->id] = $child->id;
            }
        }

        $qrcm = new UserQrCodeManager();
        $qrList = $qrcm->getByUserIds($childrenIds);
        if (is_array($qrList) && count($qrList)) {
            $qrListArray = array();
            foreach ($qrList AS $oneQr) {
                $qrListArray[$oneQr->userId] = $oneQr->code;
            }
            $this->addData("qrList", $qrListArray);
        }

        $childIds = array();
        $um = new UserManager();
        $children = $um->getByParentId($this->actor->id);
        if (count($children)) {
            $childrenList = array();
            foreach ($children AS $child) {
                $childIds[$child->id] = $child->id;
                $childrenList[$child->id] = $child;
            }
            $this->addData("childrenList", $childrenList);
        }

        $id = Request::getInt("id");
        if ($id == $this->actor->id || in_array($id, $childIds)) {
            $this->addData("id", $id);
        }
    }
}