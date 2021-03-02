<?php

function smarty_modifier_isprizepic($value, $postfix = "")
{
    $file = $value . $postfix . ".jpg";
    $fullFileName = Configurator::get("application:prizesFolder") . "resized/" . $file;

    if (file_exists($fullFileName)) {
        return true;
    }
    else {
        return false;
    }
}
