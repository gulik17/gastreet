<?php

/**
 * Ахуенный скрипт. Грузит ранее записанные CSS файлы
 * По типу функции на YII2
 */

function smarty_function_loadCSS($params, &$smarty) {
    $res = BaseApplication::loadCSS();
    if ($res === false) {
        return "";
    } else {
        return $res;
    }
}