<?php

function smarty_modifier_ispartnerpic($value, $postfix = "") {
    $file = $value . $postfix . ".jpg";
    $fullFileName = Configurator::get("application:parthnersFolder") . "resized/" . $file;
    if (file_exists($fullFileName)) {
        return str_replace(DOCUMENT_ROOT, "", $fullFileName);
    } else {
        return false;
    }
}
