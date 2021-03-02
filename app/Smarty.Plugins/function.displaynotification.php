<?php

/**
 * Show notification from session
 */
function smarty_function_displaynotification($params, &$smarty) {
    $arr = Context::getNotification();
    $message = $arr['message'];
    $flag = $arr['flag'];
    //$flag = Context::getNotifFlag();
    if ($flag) {
        if ($flag == 'success') {
            $ht_start = '<div class="modal-content success"><div class="modal-header"><span class="close" data-dismiss="modal" aria-label="Close">&times;</span></div><div class="modal-body"><div class="notification notification-success"><ul class="ul-success">';
            $ht_end = '</ul></div></div></div></div>';
        } else if ($flag == 'info') {
            $ht_start = '<div class="modal-content info"><div class="modal-header"><span class="close" data-dismiss="modal" aria-label="Close">&times;</span></div><div class="modal-body"><div class="notification notification-info"><ul class="ul-info">';
            $ht_end = '</ul></div></div></div></div>';
        } else if ($flag == 'warning') {
            $ht_start = '<div class="modal-content warning"><div class="modal-header"><span class="close" data-dismiss="modal" aria-label="Close">&times;</span></div><div class="modal-body"><div class="notification notification-warning"><ul class="ul-warning">';
            $ht_end = '</ul></div></div></div></div>';
        } else if ($flag == 'danger') {
            $ht_start = '<div class="modal-content danger"><div class="modal-header"><span class="close" data-dismiss="modal" aria-label="Close">&times;</span></div><div class="modal-body"><div class="notification notification-danger"><ul class="ul-danger">';
            $ht_end = '</ul></div></div></div></div>';
        } else if (strripos($flag, 'emoji') !== false) {
            $ht_start = '<div class="modal-content emoji '.$flag.'"><div class="modal-header"><span class="close" data-dismiss="modal" aria-label="Close">&times;</span></div><div class="modal-body"><div class="notification notification-'.$flag.'"><ul class="ul-emoji">';
            $ht_end = '</ul></div></div></div></div>';
        }
    } else {
        $ht_start = '<div class="modal-content"><div class="modal-header"><span class="close" data-dismiss="modal" aria-label="Close">&times;</span></div><div class="modal-body"><div class="notification notification-info"><ul class="ul-info">';
        $ht_end = '</ul></div></div></div></div>';
    }

    if ($message == null) {
        return false;
    }
    $res = "";
    $text = "";
    if (is_array($message)) {
        for ($i = 0; $i < count($message); $i++) {
            $res .= "<li>";
            $res .= smarty_function_displaynotification_replace($message[$i]);
            $res .= "</li>";
        }
    } else {
        $res .= "<li>";
        $res .= smarty_function_displaynotification_replace($message);
        $res .= "</li>";
    }
    return $ht_start . $res . $ht_end;
}

function smarty_function_displaynotification_replace($string) {
    $res = str_replace("%%VALIDATOR_REQUIRED_FIELD%%", " обязательное поле", $string);
    $res = str_replace("%%VALIDATOR_INCORRECT_VALUE%%", " некорректное значение", $res);
    $res = str_replace("%%VALIDATOR_MUSTBE_LESS_THEN%%", " значение должно быть меньше, чем", $res);
    $res = str_replace("%%SYMBOLS%%", "символов", $res);
    return $res;
}