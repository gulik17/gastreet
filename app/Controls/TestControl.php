<?php

/**
 * Тестовый контрол
 */
class TestControl extends BaseControl {

    public function render() {
        require_once APPLICATION_DIR . '/Lib/Swift/Mail.php';
        $result = Mail::sendUniMail("TEST", "gulik.v@bk.ru", "TEST Hello", "noreply@gastreet.com", "GASTREET");
        echo "<pre>";
        print_r($result);
        exit;
    }
}