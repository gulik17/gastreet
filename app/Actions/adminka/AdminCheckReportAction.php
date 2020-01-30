<?php

/**
 */
class AdminCheckReportAction extends AdminkaAction {

    public function execute() {
        $id = Request::getInt("id");
        if (!$id) {
            $this->generateAnswer("noid");
        }

        $urpm = new UserReportManager();
        $report = $urpm->getById($id);
        if (!$report) {
            $this->generateAnswer("noreport");
        }

        if ($report->status == 'STATUS_GENERATED') {
            $this->generateAnswer("generated");
        }

        $percent = 0;
        if ($report->totalUsersCount > 0) {
            $percent = round($report->currentUsersProcessed / $report->totalUsersCount * 100);
            $this->generateAnswer($percent);
        }

        $this->generateAnswer("noaction");
    }

    private function generateAnswer($message) {
        echo $message;
        exit;
    }

}