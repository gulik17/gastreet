<?php

/**
 * Крон для выполнения задач, поставленных в очередь
 * Тяжёлый крон, требующий много ресурсов
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
$mutex = new Mutex("notifybuyticket", $tmp, false);

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

try {
    // 86400 - сутки
    $last_day = strtotime(date("Y-m-d", strtotime("-3 day")));

    $sql = "SELECT * FROM `user` WHERE `confirmedEmail` IS NOT NULL AND `baseTicketId` IS NULL AND `tsCreated` BETWEEN ".($last_day - 86400)." AND $last_day";
    $um = new UserManager();
    $users = $um->getByAnySQL($sql);

    if (count($users)) {
        foreach ($users AS $user) {
            UserManager::sendWithoutTicketUserEmail($user['email'], $user['id']);
        }
    }
} catch (Exception $e) {
    echo $e->getMessage() . "<br> " . $e->getTraceAsString() . "\n";
    Logger::error($e->getMessage() . " " . $e->getTraceAsString());
}

// echo "done\n";
// Освобождаем ресурс
$mutex->release();