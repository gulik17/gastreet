<?php
/**
 *
*/
class GazControl extends IndexControl {
    public $pageTitle = "ГАЗ — GASTREET 2020";
    public $pageTitle_en = "GAZ — GASTREET 2020";

    public function render() {
        $this->layout = 'gaz.html';
        $this->controlName = "Gaz";
    }
}