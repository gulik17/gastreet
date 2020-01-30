<?php

/**
 *
 */
class DelMemoryAction extends AdminkaAction {
    public function execute() {
        $id = Request::getInt("id");
        $mm = new MemoryManager();
        $mmObj = null;
        if ($id) {
            $mmObj = $mm->getById($id);
        }
        if (!$mmObj) {
            Adminka::redirectBack("Запись не найдена");
        }
        $mm->remove($id);

        Adminka::redirectBack("Отзыв удален");
    }
}