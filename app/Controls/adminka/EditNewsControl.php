<?php 
/**
* Контрол для  создания/редактирования новости
*/
class EditNewsControl extends BaseAdminkaControl
{
	public $pageTitle = "Редактирование новости";
	
	public function render()
	{
		$newsId = Request::getInt("newsid");
		if (!$newsId)
			$this->pageTitle = "Создание новости";
		
		if ($newsId)
		{
			$nm = new NewsManager();
			$newsObj = $nm->getById($newsId);
			if (!$newsObj)
				Adminka::redirect("managenews", "Новость не найдена");

			$this->addData("news", $newsObj);
		}




	}
}