<?php

/**
 * 
 */

class ShareControl extends IndexControl {
    public $pageTitle = "GASTREET 2021 — International Restaurant Show";
    public $pageTitle_en = "GASTREET 2021 — International Restaurant Show";

    public function render() {
        $this->layout = 'empty.html';
        $this->controlName = "Share";
    }
}