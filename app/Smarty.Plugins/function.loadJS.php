<?php

/**
 * Ахуенный скрипт. Грузит ранее записанные CSS файлы
 * По типу функции на YII2
 */

function smarty_function_loadJS($params, &$smarty) {
    $res = BaseApplication::loadJS();
    if ($res === false) {
        return "";
    } else {
        return $res;
    }
}