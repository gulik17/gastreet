<?php

/**
 * Контрол для отображения первой страницы и формы для входа в фдминку
 * 
 */
class AdminkaindexControl extends BaseControl {
    public $pageTitle = "Gastreet Admin Panel";
    public $folder = "adminka";

    public function preRender() {
        parent::preRender();
        $this->layout = "adminkaindex.html";
        if (isset($this->actor->entityTable) && ($this->actor->entityTable == 'operator')) {
            Request::redirect('?show=mainpage');
        }
    }

    public function render() {}
}