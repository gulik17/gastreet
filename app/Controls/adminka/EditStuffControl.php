<?php 
/**
*/
class EditStuffControl extends BaseAdminkaControl
{
	public $pageTitle = "Редактирование члена команды";
	
	public function render()
	{
		$id = Request::getInt("id");
		if (!$id) {
            $this->pageTitle = "Создание члена команды";
        }
		
		if ($id)
		{
			$um = new UserManager();
			$umObj = $um->getById($id);
			if (!$umObj) {
                Adminka::redirect("managestuff", "Член команды не найден");
            }

			$this->addData("umObj", $umObj);
		}
	}
}