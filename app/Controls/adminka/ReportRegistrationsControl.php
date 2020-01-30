<?php
/**
 *
 */
class ReportRegistrationsControl extends BaseAdminkaControl
{
	public function render()
	{
        // получить данные, сформировать json и передать в шаблон

        $startDay     = Request::getInt("startDay");
        $startMonth   = Request::getInt("startMonth");
        $startYear    = Request::getInt("startYear");
        $finishDay     = Request::getInt("finishDay");
        $finishMonth   = Request::getInt("finishMonth");
        $finishYear    = Request::getInt("finishYear");
        $isalive       = Request::getInt("isalive");

        // всё это передадим в шаблон
        if ($startDay) $this->addData("startDay", $startDay);
        if ($startMonth) $this->addData("startMonth", $startMonth);
        if ($startYear) $this->addData("startYear", $startYear);
        if ($finishDay) $this->addData("finishDay", $finishDay);
        if ($finishMonth) $this->addData("finishMonth", $finishMonth);
        if ($finishYear) $this->addData("finishYear", $finishYear);

        $eventTsStart = null;
        if ($startDay && $startMonth && $startYear) {
            $eventTsStart = strtotime($startMonth . '/' . $startDay . '/' . $startYear . ' 00:00:01');
        }
        $eventTsFinish = null;
        if ($finishDay && $finishMonth && $finishYear) {
            $eventTsFinish = strtotime($finishMonth . '/' . $finishDay . '/' . $finishYear . ' 23:59:59');
        }
        if ($isalive && ((!$eventTsStart || !$eventTsFinish || $eventTsFinish <= $eventTsStart))) {
            Adminka::redirect("managereports", "Указан не верный диапазон дат");
        }

        if ($isalive) {
            $summNewUsers = 0;
            $summRegisterUsers = 0;
            $newUsers = array();
            $registerUsers = array();
            $summaryUsers = array();
            $um = new UserManager();
            // по дням за период кол-во новых регистраций (tsCreated)
            // берём начальную дату прибавлям сутки (86400 секунд), делаем цикл, внутри куча запросов
            for ($t = $eventTsStart; $t <= $eventTsFinish; $t = $t + 86400) {
                // определить кол-во регистраций
                $countNewUsers = $um->getNewUsers($t, $t + 86400);
                $dateNewUsers = date("Y-m-d", $t);
                $newUsers[] = array("day" => $dateNewUsers, "value" => $countNewUsers);
                // по дням за период кол-во активированных пользователей (tsRegister)
                // аналогично
                $countRegisterUsers = $um->getRegistered($t, $t + 86400);
                $dateRegisterUsers = date("Y-m-d", $t);
                $registerUsers[] = array("day" => $dateRegisterUsers, "value" => $countRegisterUsers);
                // суммарно: http://jsbin.com/uqawig/441/embed?js,output
                $summaryUsers[] = array("day" => $dateRegisterUsers, "a" => $countNewUsers, "b" => $countRegisterUsers);
                $summNewUsers = $summNewUsers + $countNewUsers;
                $summRegisterUsers = $summRegisterUsers + $countRegisterUsers;
            }
            if (count($newUsers)) {
                $this->addData("newUsers", json_encode($newUsers));
            }
            if (count($registerUsers)) {
                $this->addData("registerUsers", json_encode($registerUsers));
            }
            if (count($summaryUsers)) {
                $this->addData("summaryUsers", json_encode($summaryUsers));
            }

            $this->addData("summNewUsers", $summNewUsers);
            $this->addData("summRegisterUsers", $summRegisterUsers);
            if ($summNewUsers) {
                $this->addData("conversion", round($summRegisterUsers / $summNewUsers, 2));
            }

        }

	}

}
