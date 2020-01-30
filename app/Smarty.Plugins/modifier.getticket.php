<?php
function smarty_modifier_getticket($value){
    $btm = new BaseTicketManager();
    return $btm->getById($value);
}