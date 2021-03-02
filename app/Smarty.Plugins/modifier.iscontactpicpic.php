<?php
function smarty_modifier_iscontactpicpic($value)
{
    $file = $value . ".jpg";
    $fullFileName = Configurator::get("application:contactsFolder") . "resized/" . $file;
    if (file_exists($fullFileName)) {
        return true;
    }
    else {
        return false;
    }
}
