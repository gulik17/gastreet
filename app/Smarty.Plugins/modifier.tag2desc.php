<?php

function smarty_modifier_tag2desc($value) {
    $str = '';
    $arr = explode(" ", $value);
    
    if ( $arr[0] == '#ЦЕНТРАЛЬНАЯПЛОЩАДЬ' ) {
        $str = "Теоретический мастер-класс";
    } else if ( $arr[0] == '#BUSINESSSTREET' ) {
        $str = "Теоретический мастер-класс";
    } else if ( $arr[0] == '#CHEFSTREET' ) {
        $str = "Кулинарный мастер-класс";
    } else if ( $arr[0] == '#GASTREETBUSINESSSCHOOL' ) {
        $str = "Трехчасовой практический семинар";
    } else if ( $arr[0] == '#BARSTREET' ) {
        $str = "Теоретический мастер-класс";
    } else if ( $arr[0] == '#PARTNERSTREET' ) {
        $str = "Теоретический мастер-класс";
    } else if ( $arr[0] == '#ГЕРОИБУДУЩЕГО' ) {
        $str = "Теоретический мастер-класс";
    } else if ( $arr[0] == '#WINEDOME' ) {
        $str = "Теоретический мастер-класс";
    } else if ( $arr[0] == '#PIZZASTREET' ) {
        $str = "Теоретический мастер-класс";
    }
    return $str;
}