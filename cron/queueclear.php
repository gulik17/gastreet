<?php
require_once __DIR__ . '/../config.core.php';

// требуется полный путь к файлам для запуска в режиме cli
require_once SOLO_CORE_PATH.'/Config/framework.php';
require_once SOLO_CORE_PATH.'/BaseApplication.php';
require_once SOLO_CORE_PATH.'/Enviropment.php';

$um = new UserManager();
$sql = "UPDATE `queueMysql` SET `dateStart` = NULL, `dateFinish` = NULL, `isFinish` = '0', `isError` = '0'";
$um->executeNonQuery($sql);