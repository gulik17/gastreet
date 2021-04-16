<?php

/**
 *
 */
class AppSyncAction extends AdminkaAction {

    public function execute() {
        $task = Request::getVar("task");
        $eventicious = new Eventicious();
        $eventicious->setHost(Configurator::get("eventicious:host"));
        $eventicious->setCode(Configurator::get("eventicious:code"));
        $mes = '';

        // Синхронизируем Локации (Отели)
        if ($task == "places") {
            // перезагрузка наименований
            $pm = new PlaceManager();
            $places = $pm->getAll();
            if (is_array($places) && count($places)) {
                foreach ($places AS $place) {
                    // Т.к. инфу о наличии записи получить нет возможности, пробуем отредактировать
                    $result = $eventicious->locationsUpdate($place->id, $place->id, $place->name);
                    // Проверяем код ответа сервера на запрос редактирования записи
                    if ($result['result_code'] == 200) {
                        $mes .= "Eventicious: ID $place->id Отредактирован<br>";
                    }
                    // Если редактируемая запись не была найдена, сервер приложения вернет код 404
                    if ($result['result_code'] == 404) {
                        // Создаем запись
                        $result = $eventicious->locationsCreate($place->id, $place->id, $place->name);
                        if ($result['result_code'] == 200) {
                            $mes .= "Eventicious: ID $place->id Создан<br>";
                        }
                    }
                    // Пишем НЕизвестную ошибку в логи
                    if (($result['result_code'] != 404) && ($result['result_code'] != 200)) {
                        $mes .= "Eventicious: ID $place->id Ошибка " . $result['result_code'] . "<br>";
                        Logger::error($mes);
                        Logger::error($result);
                    }
                }
                Logger::info("Eventicious: Выгрузка Локаций " . date("d-m-Y"));
                Logger::info(str_replace("<br>", "\r\n", $mes));
            }
            Adminka::redirectBack($mes);
        }

        // Удаляем Локации (Отели)
        if ($task == "delPlaces") {
            // перезагрузка наименований
            $pm = new PlaceManager();
            $places = $pm->getAll();
            if (is_array($places) && count($places)) {
                foreach ($places AS $place) {
                    // Т.к. инфу о наличии записи получить нет возможности, пробуем отредактировать
                    $result = $eventicious->locationsDelete($place->id);
                    // Проверяем код ответа сервера на запрос редактирования записи
                    if ($result['result_code'] == 200) {
                        $mes .= "Eventicious: ID $place->id Удален<br>";
                    }
                }
                Logger::info("Eventicious: Удаление Локаций " . date("d-m-Y"));
                Logger::info(str_replace("<br>", "\r\n", $mes));
            }
            Adminka::redirectBack($mes);
        }

        // Синхронизируем спикеров
        if ($task == "speakers") {
            // перезагрузка наименований
            $sm = new SpeakerManager();
            $speakers = $sm->getActiveByTag("2021");

            if (is_array($speakers) && count($speakers)) {
                foreach ($speakers AS $speaker) {
                    // Т.к. инфу о наличии записи получить нет возможности, пробуем отредактировать
                    $result = $eventicious->speakersUpdate(
                            $speaker['id'] + 1000000, // т.к. спикеры и участники находятся в обной таблице, чтобы их ID не переселись при редактировании, нужно ID спикеров накрутить на 1 000 000
                            $speaker['name'], $speaker['secondName'], htmlspecialchars_decode($speaker['company'], ENT_NOQUOTES), $speaker['position'], $speaker['cityName'], $speaker['vk'], $speaker['twitter'], $speaker['facebook'], htmlspecialchars_decode($speaker['description'], ENT_NOQUOTES));
                    // Проверяем код ответа сервера на запрос редактирования записи
                    if ($result['result_code'] == 200) {
                        $mes .= "ID ".$speaker['id']." Отредактирован<br>";
                    }

                    // Если редактируемая запись не была найдена, сервер приложения вернет код 404 (НО ЭТОТ ПИДР КАКОГО ТО ХУЯ ВОРАЧИВАЕТ 400)
                    if ($result['result_code'] == 400) {
                        // Создаем запись
                        $result = $eventicious->speakersCreate(
                                $speaker['id'] + 1000000, $speaker['name'], $speaker['secondName'], htmlspecialchars_decode($speaker['company'], ENT_NOQUOTES), $speaker['position'], $speaker['cityName'], $speaker['vk'], $speaker['twitter'], $speaker['facebook'], "", "", htmlspecialchars_decode($speaker['description'], ENT_NOQUOTES), true, "https://gastreet.com/images/speackers/resized/" . $speaker['pic1'] . "?v=" . $speaker['tsUpdated']);
                        if ($result['result_code'] == 200) {
                            $mes .= "ID " . $speaker['id'] . " Создан<br>";
                        }
                    }

                    // Пишем НЕизвестную ошибку в логи
                    if (($result['result_code'] != 400) && ($result['result_code'] != 200)) {
                        $mes .= "Eventicious: ID ".$speaker['id']." Ошибка " . $result['result_code'] . " См. логи";
                        Logger::error("Eventicious: ID ".$speaker['id']." Ошибка " . $result['result_code'] . " См. логи");
                        Logger::error($result);
                    }
                }
                Logger::info("Eventicious: Выгрузка Спикеров " . date("d-m-Y"));
                Logger::info(str_replace("<br>", "\r\n", $mes));
            }
            Adminka::redirectBack($mes);
        }

        // Синхронизируем МК (Мастер-классы)
        if ($task == "products") {
            // перезагрузка наименований
            $pm = new ProductManager();
            $products = $pm->getAllActive(null,false,0);
            if (is_array($products) && count($products)) {
                foreach ($products AS $product) {
                    $speakersIds = array();
                    $locationsIds = null;
                    if ($product->speakerId > 0) {
                        $speakersIds[] = $product->speakerId + 1000000;
                    }
                    if ($product->speaker2Id > 0) {
                        $speakersIds[] = $product->speaker2Id + 1000000;
                    }
                    if ($product->speaker3Id > 0) {
                        $speakersIds[] = $product->speaker3Id + 1000000;
                    }
                    if ($product->speaker4Id > 0) {
                        $speakersIds[] = $product->speaker4Id + 1000000;
                    }
                    if ($product->speaker5Id > 0) {
                        $speakersIds[] = $product->speaker5Id + 1000000;
                    }
                    if ($product->speaker6Id > 0) {
                        $speakersIds[] = $product->speaker6Id + 1000000;
                    }
                    $locationsIds[] = $product->placeId;
                    // "2014-07-24T18:00"
                    $startTime = date('Y-m-d\TH:i', $product->eventTsStart);
                    $endTime = date('Y-m-d\TH:i', $product->eventTsFinish);
                    // Т.к. инфу о наличии записи получить нет возможности, пробуем отредактировать
                    // $id, $title, $description, $startTime, $endTime, $trackId, $speakersIds, $locationsIds, $style, $language = "ru-RU"
                    $result = $eventicious->sessionsUpdate(
                            $product->id,
                            strip_tags(htmlspecialchars_decode($product->name, ENT_NOQUOTES)),
                            htmlspecialchars_decode($product->description, ENT_NOQUOTES),
                            $startTime,
                            $endTime, 
                            $product->areaId,
                            $speakersIds,
                            $locationsIds,
                            0);
                    // Проверяем код ответа сервера на запрос редактирования записи
                    if ($result['result_code'] == 200) {
                        $mes .= "Eventicious: ID $product->id Отредактирован"."<br>";
                    }
                    // Если редактируемая запись не была найдена, сервер приложения вернет код 404
                    if ($result['result_code'] == 400) {
                        // Создаем запись
                        $result = $eventicious->sessionsCreate(
                                $product->id,
                                strip_tags(htmlspecialchars_decode($product->name, ENT_NOQUOTES)),
                                htmlspecialchars_decode($product->description, ENT_NOQUOTES),
                                $startTime,
                                $endTime,
                                $product->areaId,
                                $speakersIds,
                                $locationsIds,
                                0);
                        if ($result['result_code'] == 200) {
                            $mes .= "Eventicious: ID $product->id Создан"."<br>";
                        }
                        //deb();
                    }
                    // Пишем НЕизвестную ошибку в логи
                    if (($result['result_code'] != 400) && ($result['result_code'] != 200)) {
                        $mes .= "Eventicious: ID $product->id Ошибка " . $result['result_code'] . " См. логи"."<br>";
                        Logger::error("Eventicious: ID $product->id Ошибка " . $result['result_code'] . " См. логи");
                        Logger::error($result);
                    }
                    // Создадим ссылку на этот МК
                    if ($result['result_code'] == 200) {
                        $result = $eventicious->sessionsAttachmentsUpdate($product->id, 'Купить', 'https://gastreet.com/index.php?do=add&product='.$product->id, $product->id);
                        if ($result['result_code'] == 200) {
                            $mes .= "Eventicious: ID $product->id Ссылка отредактированна"."<br>";
                        }
                        if ($result['result_code'] == 400) {
                            $result = $eventicious->sessionsAttachmentsCreate($product->id, 'Купить', 'https://gastreet.com/index.php?do=add&product='.$product->id, $product->id);
                            if ($result['result_code'] == 200) {
                                $mes .= "Eventicious: ID $product->id Сссылка добавлена"."<br>";
                            }
                        }
                    }
                }
                Logger::info("Eventicious: Выгрузка МК " . date("d-m-Y"));
                Logger::info(str_replace("<br>", "\r\n", $mes));
            }
            Adminka::redirectBack($mes);
        }
        
        // Удаляем МК (Мастер-классы)
        if ($task == "delProducts") {
            // перезагрузка наименований
            $pm = new ProductManager();
            $products = $pm->getAllActive();
            if (is_array($products) && count($products)) {
                foreach ($products AS $product) {
                    $result = $eventicious->sessionsDelete($product->id);
                    // Проверяем код ответа сервера на запрос редактирования записи
                    if ($result['result_code'] == 200) {
                        $mes .= "Eventicious: ID $product->id Удален<br>";
                        $result = $eventicious->sessionsAttachmentsDelete($product->id, $product->id);
                        if ($result['result_code'] == 200) {
                            $mes .= "Eventicious: ID $product->id Ссылка удалена"."<br>";
                        }
                    }
                    
                }
                Logger::info("Eventicious: Удаление МК " . date("d-m-Y"));
                Logger::info(str_replace("<br>", "\r\n", $mes));
            }
            Adminka::redirectBack($mes);
        }

        // Синхронизируем Программы
        if ($task == "areas") {
            $am = new AreaManager();
            $areas = $am->getActive();
            if (is_array($areas) && count($areas)) {
                foreach ($areas AS $area) {
                    // Т.к. инфу о наличии записи получить нет возможности, пробуем отредактировать
                    $result = $eventicious->tracksUpdate($area->id, 0, $area->name, $area->color);
                    // Проверяем код ответа сервера на запрос редактирования записи
                    if ($result['result_code'] == 200) {
                        $mes .= "Eventicious: ID $area->id Отредактирован<br>";
                    }

                    // Если редактируемая запись не была найдена, сервер приложения вернет код 404
                    if ($result['result_code'] == 400) {
                        // Создаем запись
                        $result = $eventicious->tracksCreate($area->id, 0, $area->name, $area->color);
                        $mes .= "Eventicious: ID $area->id Создан<br>";
                    }

                    // Пишем НЕизвестную ошибку в логи
                    if (($result['result_code'] != 400) && ($result['result_code'] != 200)) {
                        $mes .= "Eventicious: ID $area->id Ошибка " . $result['result_code'] . " См. логи<br>";
                        Logger::error($mes);
                        Logger::error($result);
                    }
                }
            }
            Adminka::redirectBack($mes);
        }

        // Удаляем Программы
        if ($task == "delAreas") {
            $am = new AreaManager();
            $areas = $am->getActive();
            if (is_array($areas) && count($areas)) {
                foreach ($areas AS $area) {
                    // Т.к. инфу о наличии записи получить нет возможности, пробуем отредактировать
                    $result = $eventicious->tracksDelete($area->id);
                    // Проверяем код ответа сервера на запрос редактирования записи
                    if ($result['result_code'] == 200) {
                        $mes .= "Eventicious: ID $area->id удален<br>";
                    }
                    if ($result['result_code'] == 404) {
                        $mes .= "Eventicious: ID $area->id не найден<br>";
                    }

                    // Пишем НЕизвестную ошибку в логи
                    if (($result['result_code'] != 404) && ($result['result_code'] != 200)) {
                        $mes .= "Eventicious: ID $area->id Ошибка " . $result['result_code'] . " См. логи<br>";
                        Logger::error($mes);
                        Logger::error($result);
                    }
                }
            }
            Adminka::redirectBack($mes);
        }
        
        // Синхронизируем Группы (они же Билеты у нас)
        if ($task == "groups") {
            $btm = new BaseTicketManager();
            $baseTickets = $btm->getAllActive();
            if (is_array($baseTickets) && count($baseTickets)) {
                foreach ($baseTickets AS $baseTicket) {
                    // Т.к. инфу о наличии записи получить нет возможности, пробуем отредактировать
                    $result = $eventicious->ACLGroupsUpdate($baseTicket->id, $baseTicket->name);
                    // Проверяем код ответа сервера на запрос редактирования записи
                    if ($result['result_code'] == 200) {
                        $mes .= "Eventicious: ID $baseTicket->id Отредактирован<br>";
                    }
                    // Если редактируемая запись не была найдена, сервер приложения вернет код 404
                    if ($result['result_code'] == 404) {
                        // Создаем запись
                        $result = $eventicious->ACLGroupsCreate($baseTicket->id, $baseTicket->name);
                        $mes .= "Eventicious: ID $baseTicket->id Создан<br>";
                    }
                    // Пишем НЕизвестную ошибку в логи
                    if (($result['result_code'] != 404) && ($result['result_code'] != 200)) {
                        $mes .= "Eventicious: ID $baseTicket->id Ошибка " . $result['result_code'] . " См. логи<br>";
                        Logger::error($mes);
                        Logger::error($result);
                    }
                }
            }
            Adminka::redirectBack($mes);
        }
        
        // Синхронизируем юзеров
        if ($task == "users") {
            // перезагрузка наименований
            $um = new UserManager();
            $users =  $um->getAllRegistered();
            if (is_array($users) && count($users)) {
                foreach ($users AS $user) {
                    $user = (object) $user;
                    $baseTicketId = [];
                    if ($user->baseTicketId !== null) {
                        $baseTicketId[] = $user->baseTicketId;
                    }
                    // Т.к. инфу о наличии записи получить нет возможности, пробуем отредактировать
                    $result = $eventicious->speakersUpdate(
                            $user->id,
                            $user->name,
                            $user->lastname,
                            htmlspecialchars_decode($user->company, ENT_NOQUOTES),
                            $user->position,
                            $user->cityName,
                            '', // ВК
                            '', // Твиттер
                            '', // ФБ
                            '',
                            'ru-RU',
                            $baseTicketId);
                    // Проверяем код ответа сервера на запрос редактирования записи
                    if ($result['result_code'] == 200) {
                        $mes .= "ID $user->id Отредактирован<br>";
                    }

                    // Если редактируемая запись не была найдена, сервер приложения вернет код 404 (НО ЭТОТ ПИДР КАКОГО ТО ХУЯ ВОРАЧИВАЕТ 400)
                    if ($result['result_code'] == 400) {
                        // Создаем запись
                        $result = $eventicious->speakersCreate(
                                $user->id, // Идентификатор докладчика/участника в вашей системе (externalID в Eventicious)
                                $user->name, // Имя
                                $user->lastname,// Фамилия
                                htmlspecialchars_decode($user->company, ENT_NOQUOTES), // Название компании
                                $user->position, //Должность
                                $user->cityName, // Город
                                '', // ВК
                                '', // Твиттер
                                '', // ФБ
                                $user->email, // E-mail
                                $user->phone, // Телефон
                                '',
                                false,
                                '',
                                $baseTicketId);
                        if ($result['result_code'] == 200) {
                            $mes .= "ID $user->id Создан<br>";
                        }
                    }

                    // Пишем НЕизвестную ошибку в логи
                    if (($result['result_code'] != 400) && ($result['result_code'] != 200)) {
                        $mes .= "Eventicious: ID $user->id Ошибка " . $result['result_code'] . " См. логи";
                        Logger::error("Eventicious: ID $user->id Ошибка " . $result['result_code'] . " См. логи");
                        Logger::error($result);
                    }
                }
                Logger::info("Eventicious: Выгрузка Участников " . date("d-m-Y"));
                Logger::info(str_replace("<br>", "\r\n", $mes));
            }
            Adminka::redirectBack($mes);
        }
        
        
        // Синхронизируем ссылки на МК (Мастер-классы)
        if ($task == "productLinks") {
            // перезагрузка наименований
            $pm = new ProductManager();
            $products = $pm->getAllActive();
            if (is_array($products) && count($products)) {
                foreach ($products AS $product) {
                    $product = (object) $product;
                    if ( ($product->leftCount > 0) && ($product->price > 0) ) {
                        // Создадим ссылку на этот МК
                        $result = $eventicious->sessionsAttachmentsUpdate($product->id, 'Купить', 'https://gastreet.com/index.php?do=add&product='.$product->id, $product->id);
                        if ($result['result_code'] == 200) {
                            $mes .= "Eventicious: ID $product->id Ссылка отредактированна"."<br>";
                        }
                        if ($result['result_code'] == 400) {
                            $result = $eventicious->sessionsAttachmentsCreate($product->id, 'Купить', 'https://gastreet.com/index.php?do=add&product='.$product->id, $product->id);
                            if ($result['result_code'] == 200) {
                                $mes .= "Eventicious: ID $product->id Сссылка добавлена"."<br>";
                            }
                        }
                    } else {
                        $result = $eventicious->sessionsAttachmentsDelete($product->id, $product->id);
                        // Проверяем код ответа сервера на запрос редактирования записи
                        if ($result['result_code'] == 200) {
                            $mes .= "Eventicious: ID $product->id Удален"."<br>";
                        } else if ($result['result_code'] == 400) {
                            $mes .= "Eventicious: ID $product->id Ненайден"."<br>";
                        } else {
                            $mes .= "Eventicious: ID $product->id Ошибка: " . $result['result_code']."<br>";
                        }
                    }
                }
            }
            Adminka::redirectBack($mes);
        }
    }
}