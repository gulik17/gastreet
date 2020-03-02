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

$tmp = Configurator::get("application:tempDir");
$mutex = new Mutex("queueworker", $tmp, false);

// скрипт уже выполняется
if ($mutex->isAcquired()) {
    // проверим как давно был создан lock-файл
    $filetime = filectime($mutex->getLockFile());
    $time = time();
    $endtime = $time - $filetime;
    echo "Файл создан $endtime секунд назад" . "<br>";
    // если файл создан более часа назад,
    // то была ошибка при выполнени скрипта,
    // необходимо удалить lock-файл и перезапустить скрипт
    if ($endtime > (60 * 60)) {
        // отправить уведомление на админскую почту
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/plain;  charset=\"utf-8\"\r\n";
        $headers .= "From: Gastreet Info <" . Configurator::get('mail:from') . ">\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        $msg = "Было прекращено выполнение скрипта CRON" . "\r\n";
        $msg .= "Необходимо проверить скрипт" . "\r\n";
        $msg .= $mutex->getLockFile() . "\r\n";
        $msg .= "Файл создан $endtime секунд назад" . "\r\n";
        mail(Configurator::get('mail:admin'), "Gastreet Info", $msg, $headers); // включить когда скрипт нужен
        // Освободим lock-файл
        $mutex->release();
    }
    echo "Lock\n";
    exit();
}

// если не выполняется, лочим для других потоков
$mutex->lock();

try {
    // получаем задачи из очереди по 10 штук
    $qsm = new QueueMysqlManager();
    $tasks = $qsm->getSomeNewTasks(10);
    if (count($tasks)) {
        foreach ($tasks AS $oneTask) {
            // отметка о старте задачи
            $qsm->setStartDate($oneTask->id);

            // начинаем работу над задачей
            $boolRez = false;

            $qsm->startTransaction();
            try {
                // перевод мастер-класса в статус "Отменен"
                if ($oneTask->taskName == "notifyproductcancel") {
                    $boolRez = $qsm->notifyProductCancel($oneTask->fromUserId, $oneTask->otherData, $oneTask->dateCreate);
                }

                if ($oneTask->taskName == "sendticketviaemail") {
                    $boolRez = $qsm->sendTicketViaEmail($oneTask->fromUserId, $oneTask->otherData, $oneTask->dateCreate);
                }

                $qsm->commitTransaction();
            } catch (Exception $e) {
                $qsm->rollbackTransaction();
                Logger::error($e->getMessage());
            }

            // отметка об окончании задачи
            $qsm->setFinishDate($oneTask->id, $boolRez);
        }
    }
} catch (Exception $e) {
    echo $e->getMessage() . "<br> " . $e->getTraceAsString() . "\n";
    Logger::error($e->getMessage() . " " . $e->getTraceAsString());
}








// echo "done\n";
// Освобождаем ресурс
$mutex->release();

$acm = new AmoConfigManager();
$conf = $acm->getConfig();
$time = time();

if ($conf->expires_in < $time + 3600) {
    echo "Нужно обновить токен<br>";
    $conf->expires_in = time() + 3600*10;
    $conf = $acm->save($conf);
}

deb($conf);