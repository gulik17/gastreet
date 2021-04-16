<?php
/**
 */
class SavePrizesAction extends AdminkaAction
{
	public function execute()
    {
		$id = FilterInput::add(new IntFilter("id", false, "id"));
        $status = FilterInput::add(new StringFilter("status", true, "Статус"));
        $type = FilterInput::add(new StringFilter("type", true, "Тип"));
		$name = FilterInput::add(new StringFilter("name", true, "Заголовок"));
        $annotation = FilterInput::add(new StringFilter("annotation", false, "Аннотация"));
        $description = Request::getVar("description");
        $name_en = FilterInput::add(new StringFilter("name_en", true, "Заголовок (eng)"));
        $annotation_en = FilterInput::add(new StringFilter("annotation_en", false, "Аннотация (eng)"));
        $description_en = Request::getVar("description_en");
        $youtube = FilterInput::add(new StringFilter("youtube", false, "Ссылка на видео-ролик"));
		if ( (mb_strlen($description) > 10000000) || (mb_strlen($description_en) > 10000000) ) {
            FilterInput::addMessage("Слишком большой текст");
        }

		if (!FilterInput::isValid())
		{
			FormRestore::add("form");
			Adminka::redirectBack(FilterInput::getMessages());
		}

		$pm = new PrizeManager();
		$doAct = "Изменено ";
		if ($id) {
			$prize = $pm->getById($id);
			if (!$prize) {
                Adminka::redirect("manageprizes", "Бонусное задание не найдено");
            }
		} else {
            $prize = new Prize();
			$doAct = "Добавлено ";
		}

        $prize->tsUpdate = time();
        $prize->status = $status;
        $prize->type = $type;
        $prize->name = $name;
        $prize->annotation = $annotation;
        $prize->description = $description;
        $prize->name_en = $name_en;
        $prize->annotation_en = $annotation_en;
        $prize->description_en = $description_en;
        $prize->youtube = $youtube;

        $prize = $pm->save($prize);

        // был ли добавлен файл
        $fileNameParam = 'file1';
        if (Request::isFile($fileNameParam)) {
            require_once APPLICATION_DIR . "/Lib/resize.class.php";

            $file = $prize->id . ".jpg";
            $image = new UploadedFile($fileNameParam);
            $image->rename($file);
            $image->saveTo(Configurator::get("application:prizesFolder") . "uploaded/");

            // сделаем копию
            $w = 500;
            $h = 500;
            $fullFileName = Configurator::get("application:prizesFolder") . "uploaded/" . $file;
            if (file_exists($fullFileName)) {
                @unlink(Configurator::get("application:prizesFolder") . "resized/" . $file);
                $newFileName = Configurator::get("application:prizesFolder") . "resized/" . $file;
                try {
                    $obj = new Resize($fullFileName);
                    $obj->setNewImage($newFileName);
                    $obj->setProportionalFlag('A');
                    $obj->setProportional(1);
                    $obj->setNewSize($h, $w);
                    $obj->make();
                }
                catch (Exception $e) {
                    Logger::error($e);
                }
            }
        }
		Adminka::redirect("manageprizes", $doAct."бонусное задание");
	}
}