<?php
/**
 *
*/
class PriceUpControl extends IndexControl {
    public $pageTitle = "Повышение цены — GASTREET 2021";

    public function render() {
        $this->controlName = "Pricing";

        $this->gcode = "price-increase";
    }
}