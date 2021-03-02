<?php

/**
 * Выполняет контроль загрузки JS и CSS файлов
 * с тем, чтобы одинаковые файлы не подгружались несколько раз
 * 
 * Проверяет дату изменения файла и добавляет ее в качестве параметра к файлу.
 * Тем самым обеспечивая контроль изменения файлов на сервере и своевременное
 * обновление кеша браузеров пользователей
 *
 * @example 
 * {loadscript file='js/example.js' type='js'}
 * {loadscript file='js/example.css' type='css'}
 */

function smarty_function_loadscript($params, &$smarty) {
    $res = BaseApplication::loadScript($params['file'], $params['type']);
    if ($res === false) {
        return "";
    }
    $type = $params['type'];
    $fileName = $params['file'];
    $fileName = Application::normalizePath($fileName);
    $fullName = Application::fullPath($fileName);
    $media = $params['media'] ? "media=\"" . $params['media'] . "\" " : "";
    if (file_exists($fullName)) {
        $revision = filectime($fullName);
        if ($type == "js") {
            return "<script language=\"javascript\" type=\"text/javascript\" src=\"{$fileName}?v={$revision}\"></script>";
        }
        if ($type == "css") {
            return "<link type=\"text/css\" href=\"{$fileName}?v={$revision}\" rel=\"stylesheet\" {$media}/>";
        }
        if ($type == "swf") {
            return "{$fileName}?v={$revision}";
        }
    }
}