<?php
function smarty_modifier_color2class($value){
    $value = "color_".str_replace("#", "", strtolower($value));
    return $value;
}