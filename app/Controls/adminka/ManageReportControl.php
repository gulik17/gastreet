<?php
/**
 *
 */
class ManageReportControl extends BaseAdminkaControl
{
	public function render()
	{
        $urpm    = new UserReportManager();
        $isalive = Request::getInt("isalive");

	    if ($isalive) {
            $startDay     = Request::getInt("startDay");
            $startMonth   = Request::getInt("startMonth");
            $startYear    = Request::getInt("startYear");
            $finishDay    = Request::getInt("finishDay");
            $finishMonth  = Request::getInt("finishMonth");
            $finishYear   = Request::getInt("finishYear");

            $eventTsStart = null;
            if ($startDay && $startMonth && $startYear) {
                $eventTsStart = strtotime($startMonth . '/' . $startDay . '/' . $startYear . ' 00:00:01');
            }
            $eventTsFinish = null;
            if ($finishDay && $finishMonth && $finishYear) {
                $eventTsFinish = strtotime($finishMonth . '/' . $finishDay . '/' . $finishYear . ' 23:59:59');
            }
            if ($isalive && ((!$eventTsStart || !$eventTsFinish || $eventTsFinish <= $eventTsStart))) {
                Adminka::redirect("managereport", "Указан не верный диапазон дат");
            }

            // проверить нет ли уже такого отчёта, если есть, выдать сообщение
            /*
                $urpObj = $urpm->getReportByPerion($eventTsStart, $eventTsFinish);
                if ($urpObj) {
                    Adminka::redirect("managereport", "Данный отчёт уже есть в списке");
                }
            */

            // пришёл запрос на формирование отчёта
            $um = new UserManager();
            $users = $um->get();

            // добавляем новый отчёт
            $urpObj = new UserReport();
            $urpObj->tsStart = $eventTsStart;
            $urpObj->startInfo = date("d M Y", $eventTsStart);
            $urpObj->tsFinish = $eventTsFinish;
            $urpObj->finishInfo = date("d M Y", $eventTsFinish);
            $urpObj->tsGenerateStart = time();
            $urpObj->totalUsersCount = count($users);
            $urpObj->status = UserReport::STATUS_NEW;
            $urpObj = $urpm->save($urpObj);

        }
        else {
            $tsFinish    = time();
            $tsStart     = $tsFinish - 30 * 24 * 60 * 60;
            $startDay    = date("d", $tsStart);
            $startMonth  = date("m", $tsStart);
            $startYear   = date("Y", $tsStart);
            $finishDay   = date("d", $tsFinish);
            $finishMonth = date("m", $tsFinish);
            $finishYear  = date("Y", $tsFinish);
        }

        $this->addData("startDay", $startDay);
        $this->addData("startMonth", $startMonth);
        $this->addData("startYear", $startYear);
        $this->addData("finishDay", $finishDay);
        $this->addData("finishMonth", $finishMonth);
        $this->addData("finishYear", $finishYear);

        // вывести имеющиеся UserReport в обратном порядке
        $reports = $urpm->getAll("id DESC");
        $this->addData("reports", $reports);


	}

}
