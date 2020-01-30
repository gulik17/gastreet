<?php

require_once __DIR__ . '/config.core.php';

// требуется полный путь к файлам для запуска в режиме cli
require_once SOLO_CORE_PATH.'/Config/framework.php';
require_once SOLO_CORE_PATH.'/BaseApplication.php';
require_once SOLO_CORE_PATH.'/Enviropment.php';

$id = intval($_GET['id']);
if (!$id) {
    return false;
}

$pm = new ProductManager();
$product = $pm->getById($id);
if (!$product) {
    echo "МК не найден";
    return false;
}

$placem = new PlaceManager();
$place = $placem->getById($product->placeId);

$description = str_replace('&nbsp;', ' ',strip_tags(htmlspecialchars_decode($product->description)));
if ($product) {
    header('Content-disposition: attachment; filename=calendar.ics');
    header('Content-type: text/calendar');
    // далее записываем в файл текст
    echo "BEGIN:VCALENDAR"."\r";
    echo "PRODID:CalendarApp"."\r";
    echo "VERSION:2.0"."\r";
    echo "BEGIN:VEVENT"."\r";
    echo "UID:".md5($product->id)."\r";
    echo "CLASS:PUBLIC"."\r";
    echo "DESCRIPTION:".trim(mb_substr($description, 0, 62))."\r";
    echo " ".trim(mb_substr($description, 62, 74))."\r";
    echo "  ".trim(mb_substr($description, 136, 73))."\r";
    echo "DTSTAMP;VALUE=DATE-TIME:".date('Ymd\THis', $product->eventTsStart)."\r";
    echo "DTSTART;VALUE=DATE-TIME:".date('Ymd\THis', $product->eventTsStart)."\r";
    echo "DTEND;VALUE=DATE-TIME:".date('Ymd\THis', $product->eventTsFinish)."\r";
    echo "LOCATION:".$place->name."\r";
    echo "SUMMARY;LANGUAGE=ru:".$product->firstName." ".$product->secondName.". ".$product->name."\r";
    echo "TRANSP:TRANSPARENT"."\r";
    echo "END:VEVENT"."\r";
    echo "END:VCALENDAR"."\r";
}