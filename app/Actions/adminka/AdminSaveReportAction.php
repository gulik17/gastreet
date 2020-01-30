<?php
/**
 */
class AdminSaveReportAction extends AdminkaAction
{
    const FIELD_DELIMETER = "\t";
    const LINE_DELIMETER  = "\n\r";

    public function execute()
	{
		$id = Request::getInt("id");
		if (!$id) {
            Adminka::redirect("managereport", "Не задан ID отчета");
        }

        $urpm   = new UserReportManager();
		$report = $urpm->getById($id);
		if (!$report) {
            Adminka::redirect("managereport", "Отчет не найден");
        }

        // выдать в виде csv
        $urplinem    = new UserReportLineManager();
        $lines = $urplinem->getReportLines($id);
        if (is_array($lines) && count($lines)) {
            $fileName = "report-{$id}.xls";
            $fileNameCsv = "report-{$id}.csv";

            $header = "userId" . self::FIELD_DELIMETER . "userStatus" . self::FIELD_DELIMETER . "phone" . self::FIELD_DELIMETER . "email" . self::FIELD_DELIMETER . "lastname" . self::FIELD_DELIMETER . "name" . self::FIELD_DELIMETER
                . "cityName" . self::FIELD_DELIMETER . "countryName" . self::FIELD_DELIMETER . "company" . self::FIELD_DELIMETER . "position" . self::FIELD_DELIMETER . "ulBalance" . self::FIELD_DELIMETER
                . "inn" . self::FIELD_DELIMETER . "details" . self::FIELD_DELIMETER . "parentUserInfo" . self::FIELD_DELIMETER . "userCreated" . self::FIELD_DELIMETER
                . "userRegister" . self::FIELD_DELIMETER . "userOnline" . self::FIELD_DELIMETER
                . "bookingInfoDate" . self::FIELD_DELIMETER . "bookingInfoStatus" . self::FIELD_DELIMETER . "bookingInfoAmount" . self::FIELD_DELIMETER . "bookingInfoPayDate" . self::FIELD_DELIMETER  . "bookingInfoFinish" . self::FIELD_DELIMETER
                . "basketInfoAddDate" . self::FIELD_DELIMETER . "basketInfoTicket" . self::FIELD_DELIMETER . "basketInfoPrice" . self::FIELD_DELIMETER . "basketInfoDiscount" . self::FIELD_DELIMETER . "basketInfoReturn" . self::FIELD_DELIMETER . "basketInfoPay" . self::FIELD_DELIMETER . "basketInfoPayBalance" . self::FIELD_DELIMETER . "basketInfoStatus" . self::FIELD_DELIMETER
                . "monetaIds" . self::FIELD_DELIMETER
                . self::LINE_DELIMETER;

            $data   = "";
            foreach ($lines AS $line) {

                // подготовка десериализованных данных
                $bookingSerializedData = @unserialize($line->bookingSerializedData);
                $basketSerializedData  = @unserialize($line->basketSerializedData);
                $paySerializedData     = @unserialize($line->paySerializedData);

                // базовые данные
                $data .= self::removeDelimiters($line->userId) . self::FIELD_DELIMETER . self::removeDelimiters($line->userStatus) . self::FIELD_DELIMETER . self::removeDelimiters($line->phone) . self::FIELD_DELIMETER . self::removeDelimiters($line->email) . self::FIELD_DELIMETER . self::removeDelimiters($line->lastname) . self::FIELD_DELIMETER . self::removeDelimiters($line->name) . self::FIELD_DELIMETER
                    . self::removeDelimiters($line->cityName) . self::FIELD_DELIMETER . self::removeDelimiters($line->countryName) . self::FIELD_DELIMETER . self::removeDelimiters($line->company) . self::FIELD_DELIMETER . self::removeDelimiters($line->position) . self::FIELD_DELIMETER . self::amountChange(self::removeDelimiters($line->ulBalance)) . self::FIELD_DELIMETER
                    . self::removeDelimiters($line->inn) . self::FIELD_DELIMETER . self::removeDelimiters($line->details) . self::FIELD_DELIMETER . self::removeDelimiters($line->parentUserInfo) . self::FIELD_DELIMETER . self::removeDelimiters($line->userCreated) . self::FIELD_DELIMETER
                    . self::removeDelimiters($line->userRegister) . self::FIELD_DELIMETER . self::removeDelimiters($line->userOnline) . self::FIELD_DELIMETER;

                // бронирования
                if (isset($bookingSerializedData[0]) && is_array($bookingSerializedData[0]) && count($bookingSerializedData[0])) {
                    $bookingSerializedData = $bookingSerializedData[0];
                    $data .= self::removeDelimiters($bookingSerializedData['createDate']) . self::FIELD_DELIMETER . self::removeDelimiters(($bookingSerializedData['status'] == 'STATUS_NEW') ? 'Не оплачено' : 'Оплачено') . self::FIELD_DELIMETER . self::amountChange(self::removeDelimiters($bookingSerializedData['payAmount'])) . self::FIELD_DELIMETER . self::removeDelimiters($bookingSerializedData['payDate']) . self::FIELD_DELIMETER . self::removeDelimiters($bookingSerializedData['finishDate']) . self::FIELD_DELIMETER;
                }
                else {
                    $data .= self::FIELD_DELIMETER . self::FIELD_DELIMETER . self::FIELD_DELIMETER . self::FIELD_DELIMETER . self::FIELD_DELIMETER;
                }

                // основной билет
                if (isset($basketSerializedData[0]) && is_array($basketSerializedData[0]) && count($basketSerializedData[0])) {
                    $basketSerializedData = $basketSerializedData[0];
                    $data .= self::removeDelimiters($basketSerializedData['createdDate']) . self::FIELD_DELIMETER . self::removeDelimiters($basketSerializedData['baseTicketName']) . self::FIELD_DELIMETER . self::amountChange(self::removeDelimiters($basketSerializedData['needAmount'])) . self::FIELD_DELIMETER . self::amountChange(self::removeDelimiters($basketSerializedData['discountAmount'])) . self::FIELD_DELIMETER . self::amountChange(self::removeDelimiters($basketSerializedData['returnedAmount'])) . self::FIELD_DELIMETER . self::amountChange(self::removeDelimiters($basketSerializedData['payAmount'])) . self::FIELD_DELIMETER . self::amountChange(self::removeDelimiters($basketSerializedData['ulAmount'])) . self::FIELD_DELIMETER . self::removeDelimiters(Basket::getStatusDesc($basketSerializedData['status'])) . self::FIELD_DELIMETER;
                }
                else {
                    $data .= self::FIELD_DELIMETER . self::FIELD_DELIMETER . self::FIELD_DELIMETER . self::FIELD_DELIMETER . self::FIELD_DELIMETER . self::FIELD_DELIMETER . self::FIELD_DELIMETER . self::FIELD_DELIMETER;
                }

                // с оплат заберём monetaOperationId в массив и поместим через запятую в колонку
                $monetaIds = '';
                $monetaIdsArray = array();
                if (is_array($paySerializedData) && count($paySerializedData)) {
                    foreach ($paySerializedData AS $onePay) {
                        if ($onePay['monetaOperationId']) {
                            $monetaIdsArray[] = $onePay['monetaOperationId'];
                        }
                    }
                }
                if (is_array($monetaIdsArray) && count($monetaIdsArray)) {
                    $monetaIds = implode(',', $monetaIdsArray);
                }
                $data .= self::removeDelimiters($monetaIds) . self::FIELD_DELIMETER;

                // финал строки
                $data .= self::LINE_DELIMETER;
            }

            /*
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename={$fileName}");
            header("Pragma: no-cache");
            header("Expires: 0");
            print "{$header}\n{$data}";
            */

            header('Content-Encoding: UTF-8');
            header('Content-type: text/csv; charset=UTF-8');
            header('Content-Disposition: attachment; filename=' . $fileNameCsv);
            header('Expires: 0');
            echo "\xEF\xBB\xBF"; // UTF-8 BOM
            echo "{$header}\n{$data}";

            exit;

        }
        else {
            Adminka::redirect("managereport", "Отчет пуст");
        }

	}

	private static function removeDelimiters($string)
    {
        $string = str_replace(array(self::FIELD_DELIMETER, self::LINE_DELIMETER), '', $string);
        return $string;
    }

    private static function amountChange($string)
    {
        $string = str_replace('.', ',', $string);
        return $string;
    }


}
