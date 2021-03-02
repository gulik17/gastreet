<?php

function smarty_modifier_isspeakerpicpic($value, $postfix = "") {
    $fullFileNameJPG = Configurator::get("application:speackersFolder") . "resized/" . $value . $postfix . ".jpg";
    $fullFileNamePNG = Configurator::get("application:speackersFolder") . "resized/" . $value . $postfix . ".png";
    if (file_exists($fullFileNamePNG)) {
        return str_replace(DOCUMENT_ROOT, "", $fullFileNamePNG);
    } if (file_exists($fullFileNameJPG)) {
        return str_replace(DOCUMENT_ROOT, "", $fullFileNameJPG);
    } else {
        return false;
    }
}