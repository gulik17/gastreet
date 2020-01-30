<?php

function smarty_modifier_yeartomedal($value) {
    $arr = explode(",", $value);
    $tmp = '';
    $str = '';

    foreach ($arr as $v) {
        $tmp = str_replace(" ", "", mb_strtolower($v));
        if ($tmp) {
            $str .= "<span class='gmedal'>G" . $tmp[2] . $tmp[3] . "</span>";
        }
    }
    return $str;
}