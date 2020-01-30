<?php
/**
 *
 */
class ManageMemoryControl extends BaseAdminkaControl {
    public function render() {
        $mm = new MemoryManager();
        $memories = $mm->getAll();
        $this->addData("memories", $memories);
        $this->addData("statusDesc", Memory::getStatusDesc());
    }
}