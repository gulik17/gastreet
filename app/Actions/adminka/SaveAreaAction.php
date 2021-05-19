<?php

/**
 *
 */
class SaveAreaAction extends AdminkaAction {
    public function execute() {
        $doAct = "Программа добавлена";

        $id = Request::getInt("id");
        $status = Request::getVar("status");
        $name = Request::getVar("name");
        $name_en = Request::getVar("name_en");
        $color = Request::getVar("color");
        $description = Request::getVar("description");
        $description_en = Request::getVar("description_en");
        $areaTypeId = Request::getInt('areaTypeId');
        $sortOrder = Request::getInt('sortOrder');
        $photoDescription = Request::getVar('photoDescription');
        $annotation = Request::getVar('annotation');
        $url = Request::getVar('url');

        $am = new AreaManager();
        $amObj = null;
        if ($id) {
            $amObj = $am->getById($id);
        }
        if (!$amObj) {
            $amObj = new Area();
            $amObj->tsCreated = time();
        } else {
            $doAct = "Программа отредактирована";
        }

        $amObj->status = $status;
        $amObj->name = $name;
        $amObj->name_en = $name_en;
        $amObj->color = $color;
        $amObj->description = $description;
        $amObj->description_en = $description_en;
        $amObj->areaTypeId = $areaTypeId;
        $amObj->sortOrder = $sortOrder;
        $amObj->photoDescription = $photoDescription;
        $amObj->annotation = $annotation;
        $amObj->url = $url;
        $amObj->tsUpdated = time();

        $amObj = $am->save($amObj);

        // были ли добавлены файлы
        $imgFiles = array(
            'file1' => array(
                'w' => '600',
                'h' => '300',
                'namePrefix' => '01',
                'proportion' => 'H',
            ),
            'file2' => array(
                'w' => '218',
                'h' => '220',
                'namePrefix' => '02',
                'proportion' => 'A',
            ),
            'file3' => array(
                'w' => '800',
                'h' => '960',
                'namePrefix' => '03',
                'proportion' => 'A',
            )
        );
        foreach ($imgFiles as $fileNameParam => $imgFileParam) {
            if (Request::isFile($fileNameParam)) {
                require_once APPLICATION_DIR . "/Lib/resize.class.php";

                $file = $imgFileParam['namePrefix'] . $amObj->id . '.jpg';
                $image = new UploadedFile($fileNameParam);
                $image->rename($file);
                $image->saveTo(Configurator::get("application:areasFolder") . "uploaded/");

                // сделаем копию
                $w = $imgFileParam['w'];
                $h = $imgFileParam['h'];
                $fullFileName = Configurator::get("application:areasFolder") . "uploaded/" . $file;
                if (file_exists($fullFileName)) {
                    @unlink(Configurator::get("application:areasFolder") . "resized/" . $file);
                    $newFileName = Configurator::get("application:areasFolder") . "resized/" . $file;
                    try {
                        $obj = new Resize($fullFileName);
                        $obj->setNewImage($newFileName);
                        $obj->setProportionalFlag($imgFileParam['proportion']);
                        $obj->setProportional(1);
                        $obj->setNewSize($h, $w);
                        $obj->make();
                    } catch (Exception $e) {
                        Logger::error($e);
                    }
                }
            }
        }

        $eventicious = new Eventicious();
        $eventicious->setHost(Configurator::get("eventicious:host"));
        $eventicious->setCode(Configurator::get("eventicious:code"));

        // Т.к. инфу о наличии записи получить нет возможности, пробуем отредактировать
        $result = $eventicious->tracksUpdate($amObj->id, 1, $amObj->name, $amObj->color);
        // Проверяем код ответа сервера на запрос редактирования записи
        if ($result['result_code'] == 200) {
            $mes = "Eventicious: ID $amObj->id Отредактирован";
            //deb($result);
        }

        // Если редактируемая запись не была найдена, сервер приложения вернет код 404
        if ($result['result_code'] == 404) {
            // Создаем запись
            $result = $eventicious->tracksCreate($amObj->id, 'VisibilityFlagHidden', $amObj->name, $amObj->color);
            $mes = "Eventicious: ID $amObj->id Создан";
        }

        // Пишем НЕизвестную ошибку в логи
        if ( ($result['result_code'] != 404) && ($result['result_code'] != 200) ) {
            $mes = "Eventicious: ID $amObj->id Ошибка " . $result['result_code'] . " См. логи";
            Logger::error($mes);
            Logger::error($result);
        }
        Adminka::redirectBack($doAct.'<br>'.$mes);
    }
}