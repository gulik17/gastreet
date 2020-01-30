<?php

/**
 *
 */
class ChangeTicketControl extends AuthorizedUserControl {
    public $pageTitle = "Замена мастер-класса — GASTREET 2020";

    public function render() {
        $this->addData("actor", $this->actor);
    }
}