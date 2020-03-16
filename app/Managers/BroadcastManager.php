<?php

/**
 * Менеджер
 */
class BroadcastManager extends BaseEntityManager {
    /*
     * Функция отдает список по массиву id
     *
     * @param array $ids
     * @return array
     */

    public function getByIds($inpIds) {
        if (!$inpIds) {
            return null;
        }
        if (count($inpIds) == 0) {
            return null;
        }
        $idsStr = implode(",", $inpIds);
        $res = $this->get(new SQLCondition("id IN ($idsStr)", null, "id"));
        return Utility::sort($inpIds, $res);
    }

    // получить все категории
    public function getAll() {
        $sql = new SQLCondition();
        return $this->get($sql);
    }

    // получить новые объявления (статус NEW)
    public function getByStatus($status = null) {
        if (!$status) {
            $status = Broadcast::STATUS_NEW;
        }
        $sql = new SQLCondition("status = '{$status}'");
        $sql->orderBy = "dateCreate DESC";
        $rez = $this->get($sql);
        return $rez;
    }

    // массовая рассылка того что одобрил администратор
    public static function send() {
        require_once APPLICATION_DIR . "/Lib/Swift/Mail.php";

        $sql1 = "SELECT * FROM broadcast WHERE status = 'STATUS_APPROVED' LIMIT 1";
        $bcm = new BroadcastManager();
        $bcArray = $bcm->getOneByAnySQL($sql1);
        if (!$bcArray) {
            return false;
        }
        $sql3 = "UPDATE broadcast SET status = 'STATUS_SENT' WHERE id = " . $bcArray['id'];
        $bcm->executeNonQuery($sql3);

        // получить мыло и ФИО всех пользователей
        $sql2 = "SELECT login, nickName, firstName, lastName, secondName FROM user WHERE entityStatus = 1";
        $um = new UserManager();
        $list = $um->getByAnySQL($sql2);

        $totalSent = 0;
        $usleep = Configurator::get("mail:usleep");
        $usend = Configurator::get("mail:usend");

        $host = Configurator::get('application:baseHost');
        $fromEmail = SettingsManager::getValue('mail_from');
        $fromName = SettingsManager::getValue('mail_fromName');
        $signMessage = SettingsManager::getValue('mail_sign');

        // отправляет типа как "голимый спам" пока что
        // TODO: надо это поправить чтобы было обращение по ФИО

        if (count($list) > 0) {
            foreach ($list as $item) {
                $body = Utility::prepareStringForMail($bcArray['message']);
                $res = Mail::sendUniMail($fromName . " новости", $item['login'], $body, $fromEmail, $fromName);

                $totalSent++;
                if ($totalSent % $usend == 0) {
                    usleep($usleep * 1000);
                }
            }
        }
        return $totalSent > 0 ? self::STATUS_SENT : self::STATUS_NOTHING;
    }
}