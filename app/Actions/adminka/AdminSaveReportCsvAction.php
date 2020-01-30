<?php

/**
 */
class AdminSaveReportCsvAction extends AdminkaAction {

    const FIELD_DELIMETER = ";";
    const LINE_DELIMETER = "\n";

    public function execute() {
        $id = Request::getInt("id");
        if (!$id) {
            Adminka::redirect("managereport", "Не задан ID отчета");
        }
        $urpm = new UserReportManager();
        $report = $urpm->getById($id);
        if (!$report) {
            Adminka::redirect("managereport", "Отчет не найден");
        }
        
        $pm = new ProductManager;

        // выдать в виде csv
        $urplinem = new UserReportLineManager();
        $lines = $urplinem->getReportLines($id);
        if (is_array($lines) && count($lines)) {
            $fileName = "report-{$id}.xls";
            $fileNameCsv = "report-{$id}.csv";
            $header = "ID пользователя" . self::FIELD_DELIMETER . "Статус пользователя" . self::FIELD_DELIMETER . "Номер телефона" .
                    self::FIELD_DELIMETER . "E-Mail" . self::FIELD_DELIMETER . "ФИО" . self::FIELD_DELIMETER . "Город" .
                    self::FIELD_DELIMETER . "Страна" . self::FIELD_DELIMETER . "Компания" . self::FIELD_DELIMETER . "Должность" .
                    self::FIELD_DELIMETER . "Внутренний баланс" . self::FIELD_DELIMETER . "ИНН" . self::FIELD_DELIMETER . "Реквизиты" .
                    self::FIELD_DELIMETER . "Родитель" . self::FIELD_DELIMETER . "Дата создания пользователя" . self::FIELD_DELIMETER . "Дата регистрации пользователя" .
                    self::FIELD_DELIMETER . "Пользователь был онлайн" . self::FIELD_DELIMETER . "Как узнал" . self::FIELD_DELIMETER . "Дата начала бронирования" .
                    self::FIELD_DELIMETER . "Статус бронирования" . self::FIELD_DELIMETER . "Сумма за бронирование" . self::FIELD_DELIMETER . "Дата оплаты бронирования" .
                    self::FIELD_DELIMETER . "Дата годности бронирования" . self::FIELD_DELIMETER . "ID оплаты бронирования в монете" .
                    self::FIELD_DELIMETER . "Дата добавления билета в корзину" . self::FIELD_DELIMETER . "Тип билета" . self::FIELD_DELIMETER . "Цена билета на момент добавления" .
                    self::FIELD_DELIMETER . "Предоставленная скидка на билет" . self::FIELD_DELIMETER . "Сумма возврата по билету" .
                    self::FIELD_DELIMETER . "Сумма оплаты по билету" . self::FIELD_DELIMETER . "Оплачено внутренним балансом за билет" .
                    self::FIELD_DELIMETER . "Статус билета" . self::FIELD_DELIMETER . "Промо-код" . self::FIELD_DELIMETER . "Процент скидки" .
                    self::FIELD_DELIMETER . "ID оплаты билета в монете" . self::FIELD_DELIMETER . "Дата добавления МК в корзину" .
                    self::FIELD_DELIMETER . "Название МК" . self::FIELD_DELIMETER . "Тег МК" . self::FIELD_DELIMETER . "Цена МК на момент добавления" . self::FIELD_DELIMETER . "Предоставленная скидка на МК" .
                    self::FIELD_DELIMETER . "Сумма возврата по МК" . self::FIELD_DELIMETER . "Сумма оплаты по МК" . self::FIELD_DELIMETER . "Оплачено внутренним балансом за МК" .
                    self::FIELD_DELIMETER . "Статус МК" . self::FIELD_DELIMETER . "ID оплаты МК в монете" . self::FIELD_DELIMETER . self::LINE_DELIMETER;
            $data = "";
            foreach ($lines AS $line) {
                // подготовка десериализованных данных
                $bookingSerializedData = @unserialize($line->bookingSerializedData);
                $basketSerializedData = @unserialize($line->basketSerializedData);
                $basketProductSerializedData = @unserialize($line->basketProductSerializedData);
                $paySerializedData = @unserialize($line->paySerializedData);
                // базовые данные
                $data .= self::removeDelimiters($line->userId) . self::FIELD_DELIMETER . self::removeDelimiters($line->userStatus) .
                        self::FIELD_DELIMETER . self::removeDelimiters($line->phone) . self::FIELD_DELIMETER . self::removeDelimiters($line->email) .
                        self::FIELD_DELIMETER . self::removeDelimiters($line->lastname) . " " . self::removeDelimiters($line->name) . self::FIELD_DELIMETER . self::removeDelimiters($line->cityName) .
                        self::FIELD_DELIMETER . self::removeDelimiters($line->countryName) . self::FIELD_DELIMETER . self::removeDelimiters($line->company) .
                        self::FIELD_DELIMETER . self::removeDelimiters($line->position) . self::FIELD_DELIMETER . self::amountChange(self::removeDelimiters($line->ulBalance)) .
                        self::FIELD_DELIMETER . self::removeDelimiters($line->inn) . self::FIELD_DELIMETER . self::removeDelimiters($line->details) .
                        self::FIELD_DELIMETER . self::removeDelimiters($line->parentUserInfo) . self::FIELD_DELIMETER . self::removeDelimiters($line->userCreated) .
                        self::FIELD_DELIMETER . self::removeDelimiters($line->userRegister) . self::FIELD_DELIMETER . self::removeDelimiters($line->userOnline) .
                        self::FIELD_DELIMETER . self::removeDelimiters($line->youAboutUs) . self::FIELD_DELIMETER;

                // бронирования
                if (isset($bookingSerializedData[0]) && is_array($bookingSerializedData[0]) && count($bookingSerializedData[0])) {
                    $bookingSerializedDataShow = $bookingSerializedData[0];
                    $data .= self::removeDelimiters($bookingSerializedDataShow['createDate']) . self::FIELD_DELIMETER . self::removeDelimiters(($bookingSerializedDataShow['status'] == 'STATUS_NEW') ? 'Не оплачено' : 'Оплачено') .
                            self::FIELD_DELIMETER . self::amountChange(self::removeDelimiters($bookingSerializedDataShow['payAmount'])) . self::FIELD_DELIMETER . self::removeDelimiters($bookingSerializedDataShow['payDate']) .
                            self::FIELD_DELIMETER . self::removeDelimiters($bookingSerializedDataShow['finishDate']) . self::FIELD_DELIMETER . self::removeDelimiters($bookingSerializedDataShow['monetaOperationId']) . self::FIELD_DELIMETER;
                } else {
                    $bookingSerializedDataShow = null;
                    $data .= '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER;
                }

                // основной билет
                if (isset($basketSerializedData[0]) && is_array($basketSerializedData[0]) && count($basketSerializedData[0])) {
                    $basketSerializedDataShow = $basketSerializedData[0];
                    $data .= self::removeDelimiters($basketSerializedDataShow['createdDate']) . self::FIELD_DELIMETER . self::removeDelimiters($basketSerializedDataShow['baseTicketName']) .
                            self::FIELD_DELIMETER . self::amountChange(self::removeDelimiters($basketSerializedDataShow['needAmount'])) . self::FIELD_DELIMETER . self::amountChange(self::removeDelimiters($basketSerializedDataShow['discountAmount'])) .
                            self::FIELD_DELIMETER . self::amountChange(self::removeDelimiters($basketSerializedDataShow['returnedAmount'])) . self::FIELD_DELIMETER . self::amountChange(self::removeDelimiters($basketSerializedDataShow['payAmount'])) .
                            self::FIELD_DELIMETER . self::amountChange(self::removeDelimiters($basketSerializedDataShow['ulAmount'])) . self::FIELD_DELIMETER . self::removeDelimiters(Basket::getStatusDesc($basketSerializedDataShow['status'])) . self::FIELD_DELIMETER;
                } else {
                    $basketSerializedDataShow = null;
                    $data .= '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' .
                            self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER;
                }

                // промо-код и % скидки
                if (isset($basketSerializedDataShow['discountCode']) && $basketSerializedDataShow['discountCode']) {
                    $data .= self::removeDelimiters($basketSerializedDataShow['discountCode']) . self::FIELD_DELIMETER . self::removeDelimiters($basketSerializedDataShow['discountPercent']) . self::FIELD_DELIMETER;
                } else {
                    $data .= '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER;
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

                // ставим оплаты сюда
                if (is_array($monetaIdsArray) && count($monetaIdsArray)) {
                    $monetaIds = implode(',', $monetaIdsArray);
                }
                if (isset($basketSerializedDataShow['monetaOperationId']) && $basketSerializedDataShow['monetaOperationId']) {
                    // новый вариант: monetaId в каждой строке корзины
                    $data .= self::removeDelimiters($basketSerializedDataShow['monetaOperationId']) . self::FIELD_DELIMETER;
                } else {
                    $data .= self::removeDelimiters($monetaIds) . self::FIELD_DELIMETER;
                }

                // по МК выгрузить тоже
                if (is_array($basketProductSerializedData) && count($basketProductSerializedData)) {
                    foreach ($basketProductSerializedData AS $basketProductSerializedItem) {
                        $data .= self::LINE_DELIMETER;
                        $data .= self::removeDelimiters($line->userId) . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . self::removeDelimiters($line->phone) .
                                self::FIELD_DELIMETER . self::removeDelimiters($line->email) . self::FIELD_DELIMETER . self::removeDelimiters($line->lastname) . " " . self::removeDelimiters($line->name) .
                                self::FIELD_DELIMETER . self::removeDelimiters($line->cityName) . self::FIELD_DELIMETER . self::removeDelimiters($line->countryName) .
                                self::FIELD_DELIMETER . self::removeDelimiters($line->company) . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' .
                                self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' .
                                self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' .
                                self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' .
                                self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER;
                        if (isset($basketProductSerializedItem['discountCode']) && $basketProductSerializedItem['discountCode']) {
                            $data .= self::removeDelimiters($basketProductSerializedItem['discountCode']) . self::FIELD_DELIMETER . self::removeDelimiters($basketProductSerializedItem['discountPercent']) . self::FIELD_DELIMETER;
                        } else {
                            $data .= '' . self::FIELD_DELIMETER . '' . self::FIELD_DELIMETER;
                        }
                        
                        $product = $pm->getById($basketProductSerializedItem['productId']);
                        
                        $tags = explode(" ", $product->tags);
                        
                        $data .= '' . self::FIELD_DELIMETER . self::removeDelimiters($basketProductSerializedItem['createdDate']) . self::FIELD_DELIMETER . self::removeDelimiters($basketProductSerializedItem['productName']) . self::FIELD_DELIMETER . self::removeDelimiters($tags[0]) .
                                self::FIELD_DELIMETER . self::amountChange(self::removeDelimiters($basketProductSerializedItem['needAmount'])) . self::FIELD_DELIMETER . self::amountChange(self::removeDelimiters($basketProductSerializedItem['discountAmount'])) .
                                self::FIELD_DELIMETER . self::amountChange(self::removeDelimiters($basketProductSerializedItem['returnedAmount'])) . self::FIELD_DELIMETER . self::amountChange(self::removeDelimiters($basketProductSerializedItem['payAmount'])) .
                                self::FIELD_DELIMETER . self::amountChange(self::removeDelimiters($basketProductSerializedItem['ulAmount'])) . self::FIELD_DELIMETER . self::removeDelimiters(BasketProduct::getStatusDesc($basketProductSerializedItem['status'])) . self::FIELD_DELIMETER;
                        if ($basketProductSerializedItem['monetaOperationId']) {
                            $data .= self::removeDelimiters($basketProductSerializedItem['monetaOperationId']);
                        } else {
                            $data .= '';
                        }
                        $data .= self::FIELD_DELIMETER;
                    }
                }
                $data .= self::LINE_DELIMETER;
            }
            header('Content-Encoding: UTF-8');
            header('Content-type: text/csv; charset=UTF-8');
            header('Content-Disposition: attachment; filename=' . $fileNameCsv);
            header('Expires: 0');
            echo "\xEF\xBB\xBF"; // UTF-8 BOM
            echo "{$header}\n{$data}";
            exit;
        } else {
            Adminka::redirect("managereport", "Отчет пуст");
        }
    }
    private static function removeDelimiters($string) {
        $string = str_replace(array(self::FIELD_DELIMETER, self::LINE_DELIMETER, '&quot;', '\'', ';'), '', $string);
        return html_entity_decode($string);
    }
    private static function amountChange($string) {
        $string = str_replace('.', ',', $string);
        return $string;
    }
}