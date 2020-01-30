<?php
require_once __DIR__ . '/../config.core.php';

// требуется полный путь к файлам для запуска в режиме cli
require_once SOLO_CORE_PATH.'/Config/framework.php';
require_once SOLO_CORE_PATH.'/BaseApplication.php';
require_once SOLO_CORE_PATH.'/Enviropment.php';

Logger::init(Configurator::getSection("logger"));

$tmp = Configurator::get("application:tempDir");

$code = Request::getVar('code');
if ($code) {
    $qrm = new UserQrCodeManager();
    $qrmCode = $qrm->getOneActiveByCode($code);
    if ($qrmCode) {
        $qrLibFileName = APPLICATION_DIR . "/phpqrcode/qrlib.php";
        include_once($qrLibFileName);
        QRcode::png($qrmCode->code, 'codes/' . $qrmCode->code . '.png'); // creates file
        QRcode::png($qrmCode->code);
        exit;
    } else {
        echo "no code";
        exit;
    }
}