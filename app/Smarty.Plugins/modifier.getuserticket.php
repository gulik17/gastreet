<?php
    // Получает ID билета в корзине
    function smarty_modifier_getuserticket($user_id) {
        $um = new UserManager();
        $user = $um->getById($user_id);
        $bm = new BasketManager();
        if ($user->parentUserId) {
            $basket = $bm->getTicketsByChildId($user_id);
        } else {
            $basket = $bm->getTicketByUserId($user_id);
        }
        return $basket[0]['id'];
    }