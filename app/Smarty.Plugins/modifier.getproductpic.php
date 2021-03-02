<?php

function smarty_modifier_getproductpic($value, $postfix = "") {
    $file = $value;
    $fullFileName = Configurator::get("application:productsFolder")."resized/".$file;
    if (file_exists($fullFileName)) {
        return str_replace(DOCUMENT_ROOT, "", $fullFileName);
    } else {
        return false;
    }
}
