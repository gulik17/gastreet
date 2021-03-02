<?php
function smarty_modifier_strtrim($result)
{
    $result = preg_replace("/[\t\r\n]+/",' ',$result);
    $result = preg_replace('/ {2,}/',' ',$result);
    $result = str_replace(array("\r","\n","\t"), '', $result);
    $result = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $result);
    return $result;
}
