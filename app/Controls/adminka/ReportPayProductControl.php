<?php

/**
 * Формирует список купленных МК
 */
class ReportPayProductControl extends BaseAdminkaControl {
    public function render() {
        $pm = new ProductManager();
        $productsList = $pm->getAllActive();
        foreach ($productsList AS $productKey => $productVal) {
            if ($productVal->price > 0) {
                $products[$productVal->id] = $productVal->name;
            }
        }
        $this->addData("products", $products);
    }
}