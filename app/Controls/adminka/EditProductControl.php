<?php

/**
 *
 */
class EditProductControl extends BaseAdminkaControl {

    public $pageTitle = "Редактирование мастер-класса, ужина";

    public function render() {
        $productId = Request::getInt("id");
        if (!$productId) {
            $this->pageTitle = "Создание мастер-класса, ужина";
        } else {
            $pm = new ProductManager();
            $pmObj = $pm->getById($productId);
            if (!$pmObj) {
                Adminka::redirect("managebaseproducts", "Мастер-класс, ужин не найден");
            } else {
                $this->addData("product", $pmObj);

                // распарсить даты, передать в шаблон по частям
                $eventTsStart = $pmObj->eventTsStart;
                $this->addData("startDay", ($eventTsStart) ? date("d", $eventTsStart) : null);
                $this->addData("startMonth", ($eventTsStart) ? date("m", $eventTsStart) : null);
                $this->addData("startYear", ($eventTsStart) ? date("Y", $eventTsStart) : null);
                $this->addData("startHours", ($eventTsStart) ? date("H", $eventTsStart) : null);
                $this->addData("startMinutes", ($eventTsStart) ? date("i", $eventTsStart) : null);

                $eventTsFinish = $pmObj->eventTsFinish;
                $this->addData("finishDay", ($eventTsFinish) ? date("d", $eventTsFinish) : null);
                $this->addData("finishMonth", ($eventTsFinish) ? date("m", $eventTsFinish) : null);
                $this->addData("finishYear", ($eventTsFinish) ? date("Y", $eventTsFinish) : null);
                $this->addData("finishHours", ($eventTsFinish) ? date("H", $eventTsFinish) : null);
                $this->addData("finishMinutes", ($eventTsFinish) ? date("i", $eventTsFinish) : null);
            }
        }

        $this->addData("statusList", Product::getStatusDesc());

        // для выбора: автор, место проведения, программа (площадка)
        $speakersArray = array();
        $sm = new SpeakerManager();
        $speakers = $sm->getAll("name");
        if (is_array($speakers) && count($speakers)) {
            foreach ($speakers AS $speaker) {
                $speakersArray[$speaker->id] = $speaker->id . " | " . $speaker->name . " " . $speaker->secondName;
            }
            $this->addData("speakers", $speakersArray);
        }

        $placesArray = array();
        $plm = new PlaceManager();
        $places = $plm->getAll();
        if (is_array($places) && count($places)) {
            foreach ($places AS $place) {
                $placesArray[$place->id] = $place->name;
            }
            $this->addData("places", $placesArray);
        }

        $areasArray = array();
        $am = new AreaManager();
        $areas = $am->getActive();
        if (is_array($areas) && count($areas)) {
            foreach ($areas AS $area) {
                $areasArray[$area->id] = $area->name;
            }
            $this->addData("areas", $areasArray);
        }
        
        $partnersArray = array();
        $pm = new ParthnerManager();
        $partners = $pm->getAll();
        if (is_array($partners) && count($partners)) {
            foreach ($partners AS $partner) {
                $partnersArray[$partner->id] = $partner->name;
            }
            $this->addData("partners", $partnersArray);
        }
    }
}