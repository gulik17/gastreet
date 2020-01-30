<?php

/**
 * Компонент отображает верхнее меню
 */
class UserticketControl extends BaseControl {
    private $current;

    function __construct($current = null) {
        $this->current = $current;
    }

    // рендер
    public function render() {
        if ($this->current) {
            $um = new UserManager();
            $child = $um->getById($this->current);
            $this->addData("child", $child);
        } 
        $actor = Context::getActor();
        $this->addData("actor", $actor);
    }
}