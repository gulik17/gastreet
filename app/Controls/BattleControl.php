<?php
/**
 *
*/
class BattleControl extends IndexControl {
    public $pageTitle = "Битва за Корнер — GASTREET 2020";
    public $pageTitle_en = "The Battle for Corner — GASTREET 2020";

    public function render() {
        $this->layout = 'battle.html';
        $this->controlName = "Battle";
    }
}