<?php
/**
 *
*/
class PriceUpControl extends IndexControl {
    public $pageTitle = "Повышение цены — GASTREET 2020";

    public function render() {
        $this->controlName = "Pricing";

        $this->gcode = "price-increase";
    }
}