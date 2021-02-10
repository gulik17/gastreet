<?php
/**
 *
 */
class MemoryControl extends IndexControl {
    public $pageTitle = "Воспоминания — GASTREET 2021";
    public $pageTitle_en = "Memory — GASTREET 2021";

    public function render() {
        $this->layout = 'memory.html';
        $this->controlName = "Memory";

        $mm = new MemoryManager();
        $memories = $mm->getAllActive();
        $this->addData("memories", $memories);
    }
}