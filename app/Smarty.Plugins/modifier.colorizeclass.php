<?php
function smarty_modifier_colorizeclass($value)
{
    $value = mb_strtolower($value);
    $check = str_replace(array('#шеф', '#Шеф'), '-=SHEF=-', $value);
    $check = str_replace(array('#бизнес-школаgastreet', '#бизнес-школа gastreet', '#бизнес-школа Gastreet', '#Бизнес-школа Gastreet'), '-=SHBGSS=-', $check);

    $colorizeclass = "";
    if ( strpos($check, '-=SHEF=-') !== false ) {
        $colorizeclass = "gss-tag-green";
    }
    else if ( strpos($check, '-=SHBGSS=-') !== false ) {
        $colorizeclass = "gss-tag-red";
    }

    return $colorizeclass;
}
