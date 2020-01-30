<?php

function smarty_modifier_isproductpic($value, $postfix = "") {
    $file = $value . $postfix;
    $fullFileNamePNG = Configurator::get("application:productsFolder")."resized/".$file.".png";
    $fullFileNameJPG = Configurator::get("application:productsFolder")."resized/".$file.".jpg";
    if (file_exists($fullFileNamePNG)) {
        return str_replace(DOCUMENT_ROOT, "", $fullFileNamePNG);
    } else if (file_exists($fullFileNameJPG)) {
        return str_replace(DOCUMENT_ROOT, "", $fullFileNameJPG);
    } else {
        return false;
    }
}
