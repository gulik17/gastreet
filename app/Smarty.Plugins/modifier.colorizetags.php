<?php
function smarty_modifier_colorizetags($value)
{
    $value = mb_strtolower($value);
    $value = str_replace(array('#шеф', '#Шеф'), '<span class="gss-tag-green">#шеф</span>', $value);
    $value = str_replace(array('#бизнес-школаgastreet', '#бизнес-школа gastreet', '#бизнес-школа Gastreet', '#Бизнес-школа Gastreet'), '<span class="gss-tag-red">#бизнес-школаgastreet</span>', $value);

	return $value;
}
