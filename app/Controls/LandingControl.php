<?php
/**
 * cp project
 * Компонент для отображения страниц, созданных админом
 */
class LandingControl extends IndexControl {
    public $pageTitle    = "GASTREET 2020 - International Restaurant Show";
    public $pageTitle_en = "GASTREET 2020 - International Restaurant Show";
    public $pageDesc = "Самое ожидаемое отраслевое образовательное событие в стране, 5000 участников со всего мира";
    public $pageDesc_en = "The largest educational industry-specific event in the country, 5,000 participants from all over the world";

    public function render() {
        $this->layout = '/landingindex.html';
        $um = new UserManager();

        $parentObj = null;
        if ($this->actor && $this->actor->parentUserId) {
            $parentObj = $um->getById($this->actor->parentUserId);
        }
        
        // авторизован ли под участником
        $child = Context::getObject("__child");
        if ($child) {
            $this->addData("child", $child);
        } else if ($parentObj) {
            $child = $this->actor;
            $this->addData("child", $child);
        }
        
        // Выводим сформированные ранее списки стран
        $this->addData("country", $this->country);
        $this->addData("city", $this->city);
        
        if (Request::getVar("dev")) {
            $this->addData("dev", true);
        }
    }
}