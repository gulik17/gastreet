<?php
function smarty_modifier_isplacepicpic($value)
{
    $file = $value . ".jpg";
    $fullFileName = Configurator::get("application:placesFolder") . "resized/" . $file;
    if (file_exists($fullFileName)) {
        return true;
    }
    else {
        return false;
    }
}
