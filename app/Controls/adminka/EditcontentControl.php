<?php

/**
 * Контрол для редактирования/созданияв страницы CMS
 */
class EditcontentControl extends BaseAdminkaControl {
    public function render() {
        $id = Request::getInt("id");
        $cm = new ContentManager();
        $content = null;
        if ($id) {
            $content = $cm->getById($id);
        }
        if ($content == null) {
            $content = new Content();
        }
        $this->addData("content", $content);
        $this->addData("statusList", $cm->getStatusText());
        $this->addData("menuList", $cm->getMenuText());
    }
}