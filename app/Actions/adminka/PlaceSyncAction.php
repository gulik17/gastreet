<?php

/**
 *
 */
class PlaceSyncAction extends AdminkaAction {

    public function execute() {
        $eventicious = new Eventicious();
        $eventicious->setHost(Configurator::get("eventicious:host"));
        $eventicious->setCode(Configurator::get("eventicious:code"));
        
        $doAct = '';
        
        // перезагрузка наименований
        $pm = new PlaceManager();

        $places = $pm->getAll();
        if (is_array($places) && count($places)) {
            foreach ($places AS $place) {
                // Т.к. инфу о наличии записи получить нет возможности, пробуем отредактировать
                $result = $eventicious->locationsUpdate($place->id, $place->id, $place->name);
                // Проверяем код ответа сервера на запрос редактирования записи
                if ($result['result_code'] == 200) {
                    $mes = "Eventicious: ID $place->id Отредактирован";
                }
                // Если редактируемая запись не была найдена, сервер приложения вернет код 404
                if ($result['result_code'] == 404) {
                    // Создаем запись
                    $result = $eventicious->locationsCreate($place->id, $place->id, $place->name);
                    $mes = "Eventicious: ID $place->id Создан";
                }
                // Пишем НЕизвестную ошибку в логи
                if ( ($result['result_code'] != 404) && ($result['result_code'] != 200) ) {
                    Logger::error($mes);
                    Logger::error($result);
                }
                $doAct .= $mes . "<br>";
            }
        }

        Adminka::redirect("manageplaces", $doAct);
    }
}