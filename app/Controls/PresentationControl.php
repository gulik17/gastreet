<?php
/**
 *
 */
class PresentationControl extends AuthorizedUserControl {
    public $pageTitle = "Презентации — GASTREET 2021";
    public $pageTitle_en = "Presentations — GASTREET 2021";

    public function render() {
        $this->controlName = "Presentation";
        
        $actor = Context::getActor();
        $this->addData("actor", $actor);
        $this->addData("ticketId", $actor->baseTicketId);
        $bpm = new BasketProductManager();
        if ($actor->parentUserId) {
            $products = $bpm->getByChildId($actor->id);
        } else {
            $products = $bpm->getByUserIdNoChildren($actor->id);
        }
        $this->addData("products", $products);
       // deb($products);
    }
}