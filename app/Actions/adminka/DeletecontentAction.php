<?php
/**
 * Действие БО для удаления страницы CMS
 */
class DeletecontentAction extends AdminkaAction
{
	public function execute()
	{
		$id = Request::getInt("id");
		if (!$id)
			Adminka::redirect("managecontent", "Не указан ID страницы");
			
		$cm = new ContentManager();
		$content = $cm->getById($id);
		if (!$content)
			Adminka::redirect("managecontent", "Страница не найдена");

        // возможно это билет или договор или счёт - их удалять нельзя
        if (in_array($content->alias, array('dogovor', 'bilet', 'schet'))) {
            Adminka::redirect("managecontent", "Выбранный контент нельзя удалить");
        }

		$cm->remove($id);

		Adminka::redirect("managecontent", "Страница успешно удалена");

	}

}
