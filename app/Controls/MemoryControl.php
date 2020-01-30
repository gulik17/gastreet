<?php
/**
 *
 */
class MemoryControl extends IndexControl {
    public $pageTitle = "Воспоминания — GASTREET 2020: ";
    public $pageTitle_en = "Memory — GASTREET 2020";

    public function render() {
        $this->layout = 'memory.html';
        $this->controlName = "Memory";

        $mm = new MemoryManager();
        $memories = $mm->getAllActive();
        $this->addData("memories", $memories);
    }
}