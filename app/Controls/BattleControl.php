<?php
/**
 *
*/
class BattleControl extends IndexControl {
    public $pageTitle = "Битва за Корнер — GASTREET 2021";
    public $pageTitle_en = "The Battle for Corner — GASTREET 2021";

    public function render() {
        $this->layout = 'battle.html';
        $this->controlName = "Battle";
    }
}