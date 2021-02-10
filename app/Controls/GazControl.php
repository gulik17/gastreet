<?php
/**
 *
*/
class GazControl extends IndexControl {
    public $pageTitle = "ГАЗ — GASTREET 2021";
    public $pageTitle_en = "GAZ — GASTREET 2021";

    public function render() {
        $this->layout = 'gaz.html';
        $this->controlName = "Gaz";
    }
}