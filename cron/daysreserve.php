<?php

/**
 * Уведомление о том, что заканчивается срок резервирования
 */
require_once __DIR__ . '/../config.core.php';

//set_time_limit(0);
// требуется полный путь к файлам для запуска в режиме cli
require_once SOLO_CORE_PATH . '/Config/framework.php';
require_once SOLO_CORE_PATH . '/BaseApplication.php';
require_once SOLO_CORE_PATH . '/Enviropment.php';
require_once SOLO_CORE_PATH . '/Lib/Mutex/Mutex.php';
require_once APPLICATION_DIR .'/Lib/Swift/Mail.php';

Logger::init(Configurator::getSection("logger"));

$tmp = SOLO_CORE_PATH . '/..' . Configurator::get("application:tempDir");
$mutex = new Mutex("daysreserve", $tmp, false);

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
    if ($endtime > (60*60)) {
        // отправить уведомление на админскую почту
        $msg  = "Было прекращено выполнение скрипта CRON" . "<br>";
        $msg .= "Необходимо проверить скрипт" . "<br>";
        $msg .= $mutex->getLockFile() . "<br>";
        $msg .= "Файл создан $endtime секунд назад" . "<br>";
        Mail::sendAdminNotify(Configurator::get('mail:admin'), $msg, "Gastreet Info");
        // Освободим lock-файл
        $mutex->release();
    }
    echo "Lock\n";
    exit();
}

// если не выполняется, лочим для других потоков
$mutex->lock();

$um = new UserManager();

// будем отправлять уведомления, поэтому без транзакции
$daysReserve = floatval(SettingsManager::getValue('days_reserve'));
if (!$daysReserve) {
    $daysReserve = 3;
}

// тех, у кого есть оплаченое резервирование надо исключить из рассылки
$bookedUserIds = array();
$bookbman = new BookingManager();
$bookbmanList = $bookbman->getAllBooked();
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

// уведомления
$notifyUserIds = array();
// корзина, на основании которой будет отправлено уведомление
$basketUserIds = array();

$bm = new BasketManager();
$notifyBasketTicketsList = $bm->getOldBaskets($daysReserve);
if (is_array($notifyBasketTicketsList) && count($notifyBasketTicketsList)) {
    foreach ($notifyBasketTicketsList AS $productBasket) {
        $canDelBookigUser = ($productBasket->childId) ? in_array($productBasket->childId, $bookedUserIds) : in_array($productBasket->userId, $bookedUserIds);
        if (!$canDelBookigUser && !in_array($productBasket->userId, $detailedUserIds)) {
            $notifyUserIds[$productBasket->userId] = $productBasket->userId;
            $basketUserIds[$productBasket->userId] = $productBasket;
        }
    }
}

$bpm = new BasketProductManager();
$notifyBasketList = $bpm->getOldBaskets($daysReserve);
if (is_array($notifyBasketList) && count($notifyBasketList)) {
    foreach ($notifyBasketList AS $productBasket) {
        if (!in_array($productBasket->userId, $detailedUserIds)) {
            $notifyUserIds[$productBasket->userId] = $productBasket->userId;
            $basketUserIds[$productBasket->userId] = $productBasket;
        }
    }
}

// а теперь по юр.лицам
$daysReserve_ul = floatval(SettingsManager::getValue('days_reserve_ul'));
if (!$daysReserve_ul) {
    $daysReserve_ul = 7;
}

$notifyBasketTicketsList = $bm->getOldBaskets($daysReserve_ul);
if (is_array($notifyBasketTicketsList) && count($notifyBasketTicketsList)) {
    foreach ($notifyBasketTicketsList AS $productBasket) {
        $canDelBookigUser = ($productBasket->childId) ? in_array($productBasket->childId, $bookedUserIds) : in_array($productBasket->userId, $bookedUserIds);
        if (!$canDelBookigUser) {
            $notifyUserIds[$productBasket->userId] = $productBasket->userId;
            $basketUserIds[$productBasket->userId] = $productBasket;
        }
    }
}

$notifyBasketList = $bpm->getOldBaskets($daysReserve_ul);
if (is_array($notifyBasketList) && count($notifyBasketList)) {
    foreach ($notifyBasketList AS $productBasket) {
        $notifyUserIds[$productBasket->userId] = $productBasket->userId;
        $basketUserIds[$productBasket->userId] = $productBasket;
    }
}

$checkRemindPerion = max($daysReserve, $daysReserve_ul);

// непосредственно отправка писем
if (is_array($notifyUserIds) && count($notifyUserIds)) {
    $notifyUsers = $um->getByIds($notifyUserIds);
    $mlm = new MessageLogManager();
    $btm = new BroadcastTemplateManager();
    foreach ($notifyUsers AS $notifyUserKey => $notifyUser) {
        // сообщение надо отправлять только один раз
        $template = $btm->getBySendAndTriggerType(BroadcastTemplate::SEND_TYPE_EMAIL, BroadcastTemplate::TRIGGER_TYPE_NOTIFY_OLD_BASKET);
        if ($template) {
            $sentMessages = $mlm->getByUserIdAndTemplateId($notifyUser->id, $template->id, $checkRemindPerion);
            if ($sentMessages) {
                continue;
            }
        }
        //Logger::info("CRON NOTIFY BASKET 1:");
        //Logger::info($basketUserIds[$notifyUserKey]);
        $email = ($notifyUser->confirmedEmail) ? $notifyUser->confirmedEmail : $notifyUser->email;
        $isSent = UserManager::sendNotifyOldBasketEmail($email, $notifyUser->id);
    }
}

// надо разосласть уведомление тем, у кого скоро закончится бронирование (но ещё не закончилось)
// за день заранее
$notifyBookingsUserIds = array();
$daysBron = floatval(SettingsManager::getValue('days_bron'));
$daysBron = $daysBron - 1;
if ($daysBron < 0) {
    $daysBron = 0;
}

$oldBookings = $bookbman->getOldBookings($daysBron);
if (is_array($oldBookings) && count($oldBookings)) {
    foreach ($oldBookings AS $oldBookingItem) {
        if ($oldBookingItem->userId && !$oldBookingItem->childId) {
            $notifyBookingsUserIds[$oldBookingItem->userId] = $oldBookingItem->userId;
        }
        if ($oldBookingItem->childId) {
            $notifyBookingsUserIds[$oldBookingItem->childId] = $oldBookingItem->childId;
        }
    }
}

$checkRemindPerion = max($daysReserve, $daysReserve_ul, $daysBron);

// непосредственно отправка писем
if (is_array($notifyBookingsUserIds) && count($notifyBookingsUserIds)) {
    $notifyUsers = $um->getByIds($notifyBookingsUserIds);
    $mlm = new MessageLogManager();
    $btm = new BroadcastTemplateManager();
    foreach ($notifyUsers AS $notifyUser) {
        // сообщение надо отправлять только один раз
        $template = $btm->getBySendAndTriggerType(BroadcastTemplate::SEND_TYPE_EMAIL, BroadcastTemplate::TRIGGER_TYPE_NOTIFY_OLD_BOOKING);
        if ($template) {
            $sentMessages = $mlm->getByUserIdAndTemplateId($notifyUser->id, $template->id, $checkRemindPerion);
            if ($sentMessages) {
                continue;
            }
        }

        // только если есть корзина
        if (isset($basketUserIds[$notifyUser->id])) {
            //Logger::info("CRON NOTIFY BASKET 2:");
            //Logger::info($basketUserIds[$notifyUser->id]);
            $email = ($notifyUser->confirmedEmail) ? $notifyUser->confirmedEmail : $notifyUser->email;
            UserManager::sendNotifyOldBookingEmail($email, $notifyUser->id);
        }
    }
}

// Освобождаем ресурс
$mutex->release();