<?php

/**
 * Действие БО - удаление новости
 */
class DeleteNewsAction extends AdminkaAction {

    public function execute() {
        $newsId = Request::getInt("newsid");
        if (!$newsId)
            Adminka::redirect("managenews", "Новость не задана");

        $nm = new NewsManager();
        $news = $nm->getById($newsId);
        if (!$news)
            Adminka::redirect("managenews", "Новость не найдена");

        $delId = $news->id;
        $nm->remove($delId);

        Adminka::redirect("managenews", "Новость удалена");
    }

}
