<?php
/**
 *
 */
class ReportPurchasesControl extends BaseAdminkaControl
{
	public function render()
	{
        // получить данные, сформировать json и передать в шаблон

        $startDay     = Request::getInt("startDay");
        $startMonth   = Request::getInt("startMonth");
        $startYear    = Request::getInt("startYear");
        $finishDay    = Request::getInt("finishDay");
        $finishMonth  = Request::getInt("finishMonth");
        $finishYear   = Request::getInt("finishYear");
        $isalive      = Request::getInt("isalive");

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
            $summNewBaskets = 0;
            $summPaidBaskets = 0;
            $newBaskets = array();
            $paidBaskets = array();
            $summaryBaskets = array();
            $bm = new BasketManager();
            $bpm = new BasketProductManager();
            // по дням за период кол-во ддобавленного в корзину
            // берём начальную дату прибавлям сутки (86400 секунд), делаем цикл, внутри куча запросов
            for ($t = $eventTsStart; $t <= $eventTsFinish; $t = $t + 86400) {
                // определить кол-во добавленного
                $countNewBaskets = $bm->getCountAdded($t, $t + 86400);
                $countNewBaskets = $countNewBaskets + $bpm->getCountAdded($t, $t + 86400);
                $dateNewBaskets  = date("Y-m-d", $t);
                $newBaskets[] = array("day" => $dateNewBaskets, "value" => $countNewBaskets);
                // по дням за период кол-во оплаченного
                $countPaidBaskets = $bm->getCountPaid($t, $t + 86400);
                $datePaidBaskets = date("Y-m-d", $t);
                $paidBaskets[] = array("day" => $datePaidBaskets, "value" => $countPaidBaskets);
                // суммарно: http://jsbin.com/uqawig/441/embed?js,output
                $summaryBaskets[] = array("day" => $datePaidBaskets, "a" => $countNewBaskets, "b" => $countPaidBaskets);
                $summNewBaskets = $summNewBaskets + $countNewBaskets;
                $summPaidBaskets = $summPaidBaskets + $countPaidBaskets;
            }
            if (count($newBaskets)) {
                $this->addData("newBaskets", json_encode($newBaskets));
            }
            if (count($paidBaskets)) {
                $this->addData("paidBaskets", json_encode($paidBaskets));
            }
            if (count($summaryBaskets)) {
                $this->addData("summaryBaskets", json_encode($summaryBaskets));
            }

            // итоговая конверсия за период
            $this->addData("summNewBaskets", $summNewBaskets);
            $this->addData("summPaidBaskets", $summPaidBaskets);
            if ($summNewBaskets) {
                $this->addData("conversion", round($summPaidBaskets / $summNewBaskets, 2));
            }

        }

	}

}
