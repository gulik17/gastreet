<?php

function smarty_modifier_tagformat($value) {
    $arr = explode(" ", $value);
    $str = '';
    foreach ($arr as $v) {
        $tmp = str_replace("#", "", mb_strtolower($v));
        $tmp = Enviropment::translit($tmp);
        $str .= "<span class=\"tag_".$tmp."\">".$v."</span>";
    }
    
    return $str;
}