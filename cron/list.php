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

$um = new UserManager();

$users = $um->get();

$badEmail = null;

foreach ($users AS $user) {
    if ($user->email != null) {
        if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            $badEmail .= $user->id . " | " . $user->email."<br>";
        }
    }
}

echo $badEmail;