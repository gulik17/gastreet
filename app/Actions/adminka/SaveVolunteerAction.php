<?php
/**
 *
 */
class SaveVolunteerAction extends AdminkaAction {
    public function execute() {
        $id = Request::getInt("id");
        $vmObj = null;
        
        $vm = new VolunteerManager();
        if ($id) {
            //Adminka::redirectBack("Не указан ID пользователя");
            $vmObj = $vm->getById($id);
        } else {
            $vmObj = new Volunteer();
            //Adminka::redirectBack("Пользователь не найден");
        }

        // принятые данные
        $sort           = Request::getVar("sort");
        $status         = Request::getVar("status");
        $phone          = Phone::phoneVerification(Request::getVar("phone"));
        $email          = Request::getVar("email");
        $lastname       = Request::getVar("lastname");
        $name           = Request::getVar("name");
        $countryName    = Request::getVar("countryName");
        $cityName       = Request::getVar("cityName");
        $company        = preg_replace('/\&quot;([^\"]*)\&quot;/ismU', "«$1»", Request::getVar("company"));
        $position       = Request::getVar("position");
        $description    = Request::getVar("description");
        $years          = Request::getVar("years");
        $facebook       = Request::getVar("facebook");
        $vk             = Request::getVar("vk");
        $instagram      = Request::getVar("instagram");
        
        if ($phone["isError"]) {
            FormRestore::add("form");
            Adminka::redirectBack("Не верный формат номера");
        } else {
            $phone = $phone["number"];
        }

        // Если нет ID значит добавляется новый пользователь и ему необходимо добавить Статус и Время регистрации
        if (!$id) {
            $vmObj->status = Volunteer::STATUS_ACTIVE;
            $vmObj->ts_created = time();
        }
        
        // всё ок, можно сохранять
        $vmObj->sort           = $sort;
        $vmObj->status         = $status;
        $vmObj->phone          = $phone;
        $vmObj->email          = $email;
        $vmObj->lastname       = $lastname;
        $vmObj->name           = $name;
        $vmObj->countryName    = $countryName;
        $vmObj->cityName       = $cityName;
        $vmObj->company        = $company;
        $vmObj->position       = $position;
        $vmObj->description    = $description;
        $vmObj->years          = $years;
        $vmObj->facebook       = $facebook;
        $vmObj->vk             = $vk;
        $vmObj->instagram      = $instagram;
        $vmObj->ts_updated     = time();
        $vmObj                 = $vm->save($vmObj);

        // image (X)
        $fileNameParam = 'file1';
        if (Request::isFile($fileNameParam)) {
            $image = new UploadedFile($fileNameParam);
            $file = $vmObj->id . "." . $image->extension;
            $image->rename($file);
            $image->saveTo(Configurator::get("application:volunteersFolder") . "resized/");
            
            $vmObj->img = $file;
            $vmObj = $vm->save($vmObj);
        }

        Adminka::redirect("ManageVolunteer", "Данные были записаны");
    }
}