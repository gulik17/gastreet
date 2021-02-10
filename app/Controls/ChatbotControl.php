<?php

class ChatbotControl extends IndexControl {
    public $pageTitle = "Чатбот — GASTREET 2021";

    public function render() {

        $this->layout = "blank.html";
        $this->gcode = "chat-bot-landing";

    }
}
