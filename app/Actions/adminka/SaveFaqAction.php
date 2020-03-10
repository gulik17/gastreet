<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 11.02.17
 * Time: 10:23
 */
class SaveFaqAction extends AdminkaAction {
	public function execute() {
		$doAct = "Вопрос добавлен";
		$id          = Request::getInt("id");
		$sortOrder   = Request::getInt("sortOrder");
		$ggroup      = Request::getInt("ggroup");
		$question    = Request::getVar("question");
		$answer      = Request::getVar("answer");
		$question_en = Request::getVar("question_en");
		$answer_en   = Request::getVar("answer_en");

		$fm = new FaqManager();
		$fmObj = null;
		if ($id) {
			$fmObj = $fm->getById($id);
		}
		if (!$fmObj) {
			$fmObj = new Faq();
		} else {
			$doAct = "Вопрос отредактирован";
		}
		$fmObj->sortOrder   = $sortOrder;
		$fmObj->ggroup      = $ggroup;
		$fmObj->question    = $question;
		$fmObj->answer      = $answer;
		$fmObj->question_en = $question_en;
		$fmObj->answer_en   = $answer_en;
		$fmObj = $fm->save($fmObj);
		Adminka::redirect("managefaq", $doAct);
	}
}