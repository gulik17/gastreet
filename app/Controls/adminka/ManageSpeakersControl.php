<?php

/**
 *
 */
class ManageSpeakersControl extends BaseAdminkaControl {

    public function render() {
        $isalive = Request::getInt("isalive");
        $mode = Request::getVar("mode");
        $tags = Request::getVar("tags");

        // если не заполнили основные поля формы
        // 1 - выключен, 2 - включен
        if (!$tags) {
            $basicfilter = 1;
        } else {
            $basicfilter = 2;
        }

        if ($isalive == 1) {
            FormRestore::add("speaker-filter");
        }

        $sm = new SpeakerManager();
        if ($basicfilter == 2) {
            $speakers = $sm->getByTag($tags);
        } else {
            $speakers = $sm->getAll();
        }
        
        // пейджер
        $perPage = FrontPagerControl::getLimit();
        $this->addData("perPage", $perPage);
        $this->addData("total", count($speakers));
        $this->addData("page", Request::getInt("page"));
        $speakers = FrontPagerControl::limit($speakers, $perPage, "page");
        
        $this->addData("speakersList", $speakers);
        $this->addData("statusDesc", Speaker::getStatusDesc());
    }
}