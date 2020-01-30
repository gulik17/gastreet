<?php

function smarty_modifier_tagtocssclass($value) {
    $arr = explode(" ", $value);
    $tmp = '';
    $str = '';

    foreach ($arr as $v) {
        $tmp = str_replace("#", "", mb_strtolower($v));
        $tmp = Enviropment::translit($tmp);
        $str .= " tag_".$tmp;
    }
    
    return $str;
}