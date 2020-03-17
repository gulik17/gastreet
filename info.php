<?php
require_once __DIR__ . '/config.core.php';

//set_time_limit(0);
// требуется полный путь к файлам для запуска в режиме cli
require_once SOLO_CORE_PATH . '/Config/framework.php';
require_once SOLO_CORE_PATH . '/BaseApplication.php';
require_once SOLO_CORE_PATH . '/Enviropment.php';
require_once SOLO_CORE_PATH . '/Lib/Mutex/Mutex.php';
require_once APPLICATION_DIR .'/Lib/Swift/Mail.php';

$res = Mail::listUnsubscribe("2019-01-01");
print_r($res);