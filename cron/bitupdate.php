<?php

/**
 * Крон для синхронизации с битом
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
$mutex = new Mutex("bitupdate", $tmp, false);

// скрипт уже выполняется
if ($mutex->isAcquired()) {
    echo "Выполение заблокировано другим процессом\n";
    exit();
}

// если не выполняется, лочим для других потоков
$mutex->lock();
/*
try {
// перезагрузка наименований
    $um = new UserManager();
    $users =  $um->getLimitRegistered(10);
    //deb($users);
    if (is_array($users) && count($users)) {
        foreach ($users AS $user) {
            $user = (object) $user;
            $id = $user->id;
            $result = UserManager::createQrCode($id);
            $sql = "UPDATE `user` SET `bitUpdate` = 1 WHERE `user`.`id` = $id";
            $um->executeNonQuery($sql);
            echo "$user->id - Билет: $user->baseTicketId<br>";
        }
    }
} catch (Exception $e) {
    //Logger::error($e->getMessage() . " " . $e->getTraceAsString() . "\n");
    echo $e->getMessage() . " " . $e->getTraceAsString() . "\n";
}
*/
echo "done\n";
// Освобождаем ресурс
$mutex->release();
