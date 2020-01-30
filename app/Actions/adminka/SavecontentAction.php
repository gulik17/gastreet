<?php

/**
 * Действие БО для сохранения страницы CMS
 * 
 */
class SavecontentAction extends AdminkaAction {
    public function execute() {
        $id = Request::getInt("id");
        $alias = FilterInput::add(new StringFilter("alias", true, "Псевдоним"));
        $title = FilterInput::add(new StringFilter("title", true, "Заголовок"));
        $pageTitle = Request::getVar("pageTitle");
        $pageDesc = Request::getVar("pageDesc");
        $pageKeys = Request::getVar("pageKeys");
        $text = Request::getVar("text");
        $text_en = Request::getVar("text_en");
        $status = Request::getVar("status", Content::STATUS_DISABLED);
        $menu = Request::getVar("menu", Content::MENU_NONE);

        if (mb_strlen($text) > 10000000 || mb_strlen($text_en) > 10000000 || mb_strlen($pageTitle) > 10000000 || mb_strlen($pageDesc) > 10000000 || mb_strlen($pageKeys) > 10000000) {
            FilterInput::addMessage("Слишком большой текст");
        }
        $cm = new ContentManager();
        $tmp = $cm->isExists($alias);
        if ($tmp != null && $tmp->id != $id) {
            FilterInput::addMessage("Страница с таким псевдонимом уже существует");
        }
        if (!FilterInput::isValid()) {
            FormRestore::add("edit-content");
            Adminka::redirectBack(FilterInput::getMessages());
        }

        $content = null;
        if ($id) {
            $content = $cm->getById($id);
        }
        if (!$content) {
            $content = new Content();
        }
        $content->alias = $alias;
        $content->title = $title;
        $content->pageTitle = $pageTitle;
        $content->pageDesc = $pageDesc;
        $content->pageKeys = $pageKeys;
        $content->text = $text;
        $content->text_en = $text_en;
        $content->status = $status;
        $content->menu = $menu;
        $cm->save($content);

        Adminka::redirect("managecontent", "Страница успешно сохранена");
    }
}