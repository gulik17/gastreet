<?php

class EditFaqControl extends BaseAdminkaControl {
	public $pageTitle = "Редактирование вопроса";

	public function render() {
		$id = Request::getInt("id");
		if ($id === 0) {
			$this->pageTitle = "Создание вопроса";
		} else {
			$fm = new FaqManager();
			$fmObj = $fm->getById($id);
			if (!$fmObj) {
				Adminka::redirect("managefaq", "Вопрос не найден");
			} else {
				$this->addData("faq", $fmObj);
			}
		}
	}
}