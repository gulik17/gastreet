<?php

/**
 * получение ID записи из URL-адреса Youtube
 * (например, из "https://youtu.be/XilOAy35n7Y" получим "XilOAy35n7Y")
 * @param $value
 * @return string
 */
function smarty_modifier_getidyoutubevideo($value) {
    $pattern = "/\/(\w+$)/i";

    $result = preg_match($pattern, $value, $matches);

    if ($result) {
        return $result;
    }

    return "";
}
