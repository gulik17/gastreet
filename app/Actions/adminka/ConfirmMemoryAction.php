<?php

/**
 *
 */
class ConfirmMemoryAction extends AdminkaAction {
    public function execute() {
        $id = Request::getInt("id");
        $mm = new MemoryManager();
        $mmObj = null;
        if ($id) {
            $mmObj = $mm->getById($id);
        }

        $mmObj->status = Memory::STATUS_OK;
        $mmObj = $mm->save($mmObj);

        Adminka::redirectBack("Отзыв опубликован");
    }
}