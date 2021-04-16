<?php

/**
 */
class EditPrizesControl extends BaseAdminkaControl
{
    public $pageTitle = "Редактирование бонусного задания";

    public function render()
    {
        $id = Request::getInt("id");
        if (!$id) {
            $this->pageTitle = "Создание новости/ништяка";
        }
        if ($id) {
            $pm = new PrizeManager();
            $prizeObj = $pm->getById($id);
            if (!$prizeObj) {
                Adminka::redirect("manageprizes", "Новости/ништяка задание не найдено");
            }
            $this->addData("prize", $prizeObj);
            // image
            $file = $prizeObj->id . ".jpg";
            $fullFileName = Configurator::get("application:prizesFolder") . "resized/" . $file;
            if (file_exists($fullFileName)) {
                $this->addData("prizeImg", $file);
            }
        }
        $this->addData("prizeStatuses", Prize::getStatusDesc());
        $this->addData("typeList", Prize::getType());
    }
}
