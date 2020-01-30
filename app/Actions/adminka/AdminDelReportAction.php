<?php
/**
 */
class AdminDelReportAction extends AdminkaAction
{
	public function execute()
	{
		$id = Request::getInt("id");
		if (!$id)
			Adminka::redirect("managereport", "Не задан ID отчета");

        $urpm   = new UserReportManager();
		$report = $urpm->getById($id);
		if (!$report)
			Adminka::redirect("managereport", "Отчет не найден");

		$delId = $report->id;
        $urpm->remove($delId);

        // удалить запросом все подчиненные данные в таблице userReportLine
        $sql = "DELETE FROM userReportLine WHERE reportId = {$delId}";
        $urpm->executeNonQuery($sql);

        Adminka::redirect("managereport", "Отчет удален");

	}

}
