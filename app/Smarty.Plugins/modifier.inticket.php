<?php
    function smarty_modifier_inticket($value, $ticket) {
        $sql = "SELECT * FROM `ticketToProductLink` WHERE `baseTicketId` = $ticket AND `productId` = $value";
        $ttp = new TicketToProductLinkManager();
        $result = $ttp->getByAnySQL($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }