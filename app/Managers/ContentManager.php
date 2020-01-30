<?php

/**
 * cp project
 * Менеджер управления CMS
 */
class ContentManager extends BaseEntityManager {

    /**
     * Возвращает страницу по псевдониму
     *
     * @param string $alias
     * @return Content
     */
    public function getByAlias($alias) {
        $status = Content::STATUS_ENABLED;
        $sql = new SQLCondition("alias = '{$alias}' AND status = '{$status}'");
        $page = $this->getOne($sql);
        return $page;
    }

    /**
     * Возвращает страницу по типу меню
     *
     * @param string $menu
     * @return Array
     */
    public function getByMenu($menu) {
        $status = Content::STATUS_ENABLED;
        $sql = new SQLCondition("menu = '{$menu}' AND status = '{$status}'");
        return $this->get($sql);
    }

    /**
     * Проверяет существование страницы с таким именем
     *
     * @param string $alias
     * @return Content
     */
    public function isExists($alias) {
        $sql = new SQLCondition("alias = '{$alias}'");
        $page = $this->getOne($sql);
        return $page;
    }

    // контент списком
    public function getList($status = null) {
        $list = null;
        if ($status != null) {
            $sql = new SQLCondition("status = '{$status}'");
            $list = $this->get($sql);
        } else {
            $sql = new SQLCondition();
            $sql->orderBy = "menu='MENU_TOP' DESC, menu='MENU_BOTTOM' DESC, menu='MENU_NONE' DESC";
            $list = $this->get($sql);
        }
        return $list;
    }

    /**
     * Возвращает данные для постоения меню
     * страниц CMS, в зависимости от типа меню
     *
     * @param string $menu
     * @return array
     */
    public function getMenu($menu = null) {
        $status = Content::STATUS_ENABLED;
        if ($menu != null) {
            $sql = "SELECT alias, title FROM content WHERE menu='{$menu}' AND status = '{$status}' ORDER BY id DESC";
        } else {
            $sql = "SELECT alias, title FROM content WHERE (menu='MENU_TOP' OR menu='MENU_BOTTOM') AND status = '{$status}' ORDER BY id DESC";
        }
        $res = $this->getByAnySQL($sql);
        return $res;
    }

    /**
     * Возвращает массив с описаниями статусов CMS страниц
     *
     * @return array
     */
    public static function getStatusText() {
        return array(
            Content::STATUS_DISABLED => "Не опубликовано",
            Content::STATUS_ENABLED => "Опубликовано"
        );
    }

    /**
     * Возвращает массив с описаниями типов меню
     *
     * @return array
     */
    public static function getMenuText() {
        return array(
            Content::MENU_NONE => "-",
            Content::MENU_TOP => "Верхнее меню",
            Content::MENU_BOTTOM => "Нижнее меню"
        );
    }
}