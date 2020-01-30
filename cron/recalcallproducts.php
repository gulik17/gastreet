<?php

/**
 * Пересчёт остатков мастер-классов
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
$mutex = new Mutex("recalcallproducts", $tmp, false);

// скрипт уже выполняется
if ($mutex->isAcquired()) {
    echo "Выполение заблокировано другим процессом\n";
    exit();
}

// если не выполняется, лочим для других потоков
$mutex->lock();

// выполняем действия
$bm = new BasketManager();
$bm->rebuildBasket();

// Освобождаем ресурс
$mutex->release();