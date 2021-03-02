<?php
/**
* nl2br
 */

function smarty_modifier_tstocheck($ts)
{
    if ($ts) {
        $dtYear = date("Y", $ts);
        $dtMonth = date("m", $ts);
        $dtDay = date("d", $ts);
        return $dtYear . $dtMonth . $dtDay;
    }
    else {
        return '';
    }
}
