<?php
/**
 * Компонент отображает верхнее меню
 */
class MenuPagesBottomControl extends BaseControl implements IComponent {
    // рендер
    public function render() {
        $cm = new ContentManager();
        $menu = $cm->getMenu(Content::MENU_BOTTOM);
        if (count($menu)) {
            $menuNew = array();
            $mappingArray = Request::getMappingArray();
            foreach ($menu AS $item) {
                $item['link'] = (array_key_exists($item['alias'], $mappingArray)) ? $item['alias'] : 'page/name/' . $item['alias'];
                $menuNew[] = $item;
            }
            $this->addData("menu", $menuNew);
        }
    }
}