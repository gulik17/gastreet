<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 12.02.17
 * Time: 9:53
 */
class SaveContactAction extends AdminkaAction {

    public function execute() {
        $doAct = 'Контакт добавлен';

        $id = Request::getInt('id');
        $sortOrder = Request::getInt('sortOrder');
        $title = Request::getVar('title');
        $title_en = Request::getVar('title_en');
        $type = Request::getVar('type');
        $name = Request::getVar('name');
        $name_en = Request::getVar('name_en');
        // $info = Request::getVar("info");
        $email = Request::getVar('email');
        $phone = Request::getVar('phone');
        $whatsapp = Request::getVar('whatsapp');
        $viber = Request::getVar('viber');
        $telegram = Request::getVar('telegram');
        $phone2 = Request::getVar('phone2');
        $facebookurl = Request::getVar('facebookurl');

        $cm = new ContactManager();
        $cmObj = null;
        if ($id) {
            $cmObj = $cm->getById($id);
        }
        if (!$cmObj) {
            $cmObj = new Contact();
        } else {
            $doAct = 'Контактная информация изменена';
        }

        $cmObj->sortOrder = $sortOrder;
        $cmObj->title = $title;
        $cmObj->title_en = $title_en;
        $cmObj->type = $type;
        $cmObj->name = $name;
        $cmObj->name_en = $name_en;
        // $cmObj->info = $info;
        $cmObj->email = $email;
        $cmObj->phone = $phone;
        $cmObj->viber = $viber;
        $cmObj->telegram = $telegram;
        $cmObj->whatsapp = $whatsapp;
        $cmObj->phone2 = $phone2;
        $cmObj->facebookurl = $facebookurl;

        $cmObj = $cm->save($cmObj);

        // был ли добавлен файл
        $fileNameParam = 'file1';
        if (Request::isFile($fileNameParam)) {
            require_once APPLICATION_DIR . '/Lib/resize.class.php';

            $file = $cmObj->id . '.jpg';
            $image = new UploadedFile($fileNameParam);
            $image->rename($file);
            $image->saveTo(Configurator::get('application:contactsFolder') . 'uploaded/');

            // сделаем копию
            $w = 500;
            $h = 500;
            $fullFileName = Configurator::get('application:contactsFolder') . 'uploaded/' . $file;
            if (file_exists($fullFileName)) {
                @unlink(Configurator::get('application:contactsFolder') . 'resized/' . $file);
                $newFileName = Configurator::get('application:contactsFolder') . 'resized/' . $file;
                try {
                    $obj = new Resize($fullFileName);
                    $obj->setNewImage($newFileName);
                    $obj->setProportionalFlag('A');
                    $obj->setProportional(1);
                    $obj->setNewSize($h, $w);
                    $obj->make();
                } catch (Exception $e) {
                    Logger::error($e);
                }
            }
        }
        Adminka::redirect("managecontacts", $doAct);
    }
}