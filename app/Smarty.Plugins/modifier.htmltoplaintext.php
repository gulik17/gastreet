<?php
function smarty_modifier_htmltoplaintext($value)
{
    $value = str_ireplace(array("<br />","<br>","<br/>"), "\n", $value);
	return strip_tags($value);
}
