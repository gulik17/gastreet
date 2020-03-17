<?php

/**
 * Уведомление о том, что заканчивается срок резервирования
 * 
 * 
 */
require_once __DIR__ . '/../config.core.php';

//set_time_limit(0);
// требуется полный путь к файлам для запуска в режиме cli
require_once SOLO_CORE_PATH . '/Config/framework.php';
require_once SOLO_CORE_PATH . '/BaseApplication.php';
require_once SOLO_CORE_PATH . '/Enviropment.php';
require_once SOLO_CORE_PATH . '/Lib/Mutex/Mutex.php';

Logger::init(Configurator::getSection("logger"));

$tmp = SOLO_CORE_PATH . '/..' . Configurator::get("application:tempDir");
$mutex = new Mutex("daysdeletereserved", $tmp, false);

// скрипт уже выполняется
if ($mutex->isAcquired()) {
    // проверим как давно был создан lock-файл
    $filetime = filectime($mutex->getLockFile());
    $time = time();
    $endtime = $time - $filetime;
    echo "Файл создан $endtime секунд назад" . "<br>";
    // если файл создан более часа назад,
    // то была оошибка при выполнени скрипта,
    // необходимо удалить lock-файл и перезапустить скрипт
    if ($endtime > (60 * 60)) {
        // отправить уведомление на админскую почту
        $msg = "Было прекращено выполнение скрипта CRON" . "\r\n";
        $msg .= "Необходимо проверить скрипт" . "\r\n";
        $msg .= $mutex->getLockFile() . "\r\n";
        $msg .= "Файл создан $endtime секунд назад" . "\r\n";
        Mail::sendAdminNotify(Configurator::get('mail:admin'), $msg, "Gastreet Info");
        // Освободим lock-файл
        $mutex->release();
    }
    echo "Lock\n";
    exit();
}

// если не выполняется, лочим для других потоков
$mutex->lock();

// будем удалять не оплаченные резервы
$bpm = new BasketProductManager();

$daysRemove = floatval(SettingsManager::getValue('days_delete'));
if (!$daysRemove) {
    $daysRemove = 7;
}

// тех, у кого есть оплаченое и действующее бронирование надо исключить из удаления
$bookedUserIds = array();
$bookbman = new BookingManager();
$bookbmanList = $bookbman->getAllActive();
if (is_array($bookbmanList) && count($bookbmanList)) {
    foreach ($bookbmanList AS $bookbmanItem) {
        if ($bookbmanItem->userId && !$bookbmanItem->childId) {
            $bookedUserIds[$bookbmanItem->userId] = $bookbmanItem->userId;
        }
        if ($bookbmanItem->childId) {
            $bookedUserIds[$bookbmanItem->childId] = $bookbmanItem->childId;
        }
    }
}

// собрать массив тех, у кого есть реквизиты, типа это юр. лица
$udm = new UserDetailsManager();
$detailedUserIds = $udm->getAllUserIds();

// удаление резерва и рассылка уведомления
$um = new UserManager();

// корзина, на основании которой будет отправлено уведомление
$basketUserIds = array();

// по частникам ...
$removeUserIds = array();
$bm = new BasketManager();
$removeBasketTicketsList = $bm->getOldBaskets($daysRemove);
if (is_array($removeBasketTicketsList) && count($removeBasketTicketsList)) {
    foreach ($removeBasketTicketsList AS $productBasket) {
        $canDelBookigUser = ($productBasket->childId) ? in_array($productBasket->childId, $bookedUserIds) : in_array($productBasket->userId, $bookedUserIds);
        if (!$canDelBookigUser && !in_array($productBasket->userId, $detailedUserIds)) {
            $removeUserIds[$productBasket->userId] = $productBasket->userId;
            $basketUserIds[$productBasket->userId] = $productBasket;
            // удалить старую корзину
            // запишив в лог
            Logger::info("CRON DEL BASKET: " . $productBasket->id . ", userId: " . $productBasket->userId . ", childId: " . $productBasket->childId);
            Logger::info($productBasket);
            // собственно удаление
            $bm->remove($productBasket->id);
            // у пользователя очистить данные по билету
            if ($productBasket->childId) {
                $userObj = $um->getById($productBasket->childId);
            } else {
                $userObj = $um->getById($productBasket->userId);
            }
            $userObj->baseTicketId = null;
            $userObj->tsTicketAdd = null;
            $userObj = $um->save($userObj);
        }
    }
}

$bpm = new BasketProductManager();
$removeBasketList = $bpm->getOldBaskets($daysRemove);
if (is_array($removeBasketList) && count($removeBasketList)) {
    foreach ($removeBasketList AS $productBasket) {
        if (!in_array($productBasket->userId, $detailedUserIds)) {
            $removeUserIds[$productBasket->userId] = $productBasket->userId;
            $basketUserIds[$productBasket->userId] = $productBasket;
            // удалить старую корзину
            // запишив в лог
            Logger::info("CRON DEL PRODUCT BASKET: " . $productBasket->id . ", userId: " . $productBasket->userId . ", childId: " . $productBasket->childId);
            Logger::info($productBasket);
            // собственно удаление
            $bpm->remove($productBasket->id);
            echo "$productBasket->id<br>";
        }
    }
}

// по юр. лицам ..
$daysRemove_ul = floatval(SettingsManager::getValue('days_delete_ul'));
if (!$daysRemove_ul) {
    $daysRemove_ul = 7;
}

//$removeUserIds = array();
$bm = new BasketManager();
$removeBasketTicketsList = $bm->getOldBaskets($daysRemove_ul);
if (is_array($removeBasketTicketsList) && count($removeBasketTicketsList)) {
    foreach ($removeBasketTicketsList AS $productBasket) {
        $canDelBookigUser = ($productBasket->childId) ? in_array($productBasket->childId, $bookedUserIds) : in_array($productBasket->userId, $bookedUserIds);
        if (!$canDelBookigUser) {
            $removeUserIds[$productBasket->userId] = $productBasket->userId;
            $basketUserIds[$productBasket->userId] = $productBasket;
            // запишив в лог
            Logger::info("CRON DEL BASKET: " . $productBasket->id . ", userId: " . $productBasket->userId . ", childId: " . $productBasket->childId);
            Logger::info($productBasket);
            // удалить старую корзину
            $bm->remove($productBasket->id);
            // у пользователя очистить данные по билету
            if ($productBasket->childId) {
                $userObj = $um->getById($productBasket->childId);
            } else {
                $userObj = $um->getById($productBasket->userId);
            }
            $userObj->baseTicketId = null;
            $userObj->tsTicketAdd = null;
            $userObj = $um->save($userObj);
        }
    }
}

$bpm = new BasketProductManager();
$removeBasketList = $bpm->getOldBaskets($daysRemove_ul);
if (is_array($removeBasketList) && count($removeBasketList)) {
    foreach ($removeBasketList AS $productBasket) {
        $removeUserIds[$productBasket->userId] = $productBasket->userId;
        $basketUserIds[$productBasket->userId] = $productBasket;
        // запишим в лог
        Logger::info("CRON DEL PRODUCT BASKET: " . $productBasket->id . ", userId: " . $productBasket->userId . ", childId: " . $productBasket->childId);
        Logger::info($productBasket);
        // удалить старую корзину
        $bpm->remove($productBasket->id);
    }
}

$checkRemindPerion = max($daysRemove, $daysRemove_ul);

// непосредственно рассылка сообщений
if (is_array($removeUserIds) && count($removeUserIds)) {
    $um = new UserManager();
    $notifyUsers = $um->getByIds($removeUserIds);
    $mlm = new MessageLogManager();
    $btm = new BroadcastTemplateManager();
    foreach ($notifyUsers AS $notifyUser) {
        // сообщение надо отправлять только один раз
        $template = $btm->getBySendAndTriggerType(BroadcastTemplate::SEND_TYPE_EMAIL, BroadcastTemplate::TRIGGER_TYPE_REMOVE_OLD_BASKET);
        if ($template) {
            $sentMessages = $mlm->getByUserIdAndTemplateId($notifyUser->id, $template->id, $checkRemindPerion);
            if ($sentMessages) {
                continue;
            }
        }

        if (isset($basketUserIds[$notifyUser->id])) {
            Logger::info("CRON NOTIFY BASKET RESERV: User ID " . $notifyUser->id);
            Logger::info($basketUserIds[$notifyUser->id]);
        }
        $email = ($notifyUser->confirmedEmail) ? $notifyUser->confirmedEmail : $notifyUser->email;
        UserManager::sendRemoveOldBasketEmail($email, $notifyUser->id);
    }
}

// $pm = new PayManager();
// $pm->removeOldInvoices(7);
// Освобождаем ресурс
$mutex->release();