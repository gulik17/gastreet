<?php
function smarty_modifier_leftcount($value){
    $btm = new BaseTicketManager();
    $result = $btm->getById($value);
    return $result->leftCount;
}