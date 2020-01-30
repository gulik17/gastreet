<?php
function smarty_modifier_isareapic($value)
{
    $file = $value . ".jpg";
    $fullFileName = Configurator::get("application:areasFolder") . "resized/" . $file;
    if (file_exists($fullFileName)) {
        return true;
    }
    else {
        return false;
    }
}
