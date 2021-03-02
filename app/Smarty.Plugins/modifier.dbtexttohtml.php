<?php

function smarty_modifier_dbtexttohtml($value) {
    $value = str_replace("&quot;", '"', htmlspecialchars_decode($value, ENT_NOQUOTES));
    $value = preg_replace('/( |&nbsp;|\(){1}([№А-Яа-я0-9]){1}(\.){0,1} /u', '$1$2$3&nbsp;', $value);
    return $value;
}
