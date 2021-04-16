<?php

/**
 */
class AdminSaveReportXlsAction extends AdminkaAction {
    const FIELD_DELIMETER = "\t";
    const LINE_DELIMETER = "\n\r";
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
        // выдать в виде csv
        $urplinem = new UserReportLineManager();
        $lines = $urplinem->getReportLines($id);
        if (is_array($lines) && count($lines)) {
            $fileName = "report-{$id}.xlsx";
            $fileNameCsv = "report-{$id}.csv";
            require_once APPLICATION_DIR . "/phpexcel/Classes/PHPExcel.php";
            // генерируем xls файл
            $objPHPExcel = new PHPExcel();
            $out_sheet = $objPHPExcel->getActiveSheet();

            // $column_index - колонка
            // $row_index - строка
            // $value - значение

            $column_index = 0;
            $row_index = 1;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "ID пользователя");
            $column_index++;                      // повтор
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Статус пользователя");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Номер телефона");
            $column_index++;                      // повтор
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "E-Mail");
            $column_index++;                                 // повтор
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Тип пользователя");
            $column_index++;                              // повтор
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "ФИО");
            $column_index++;                                 // повтор
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "UTM");
            $column_index++;                                 // повтор
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Город");
            $column_index++;                               // повтор
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Страна");
            $column_index++;                              // повтор
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Компания");
            $column_index++;                            // повтор
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Должность");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Внутренний баланс");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "ИНН");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Реквизиты");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Родитель");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Дата создания пользователя");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Дата регистрации пользователя");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Пользователь был онлайн");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Как узнал");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Карта METRO");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Дата начала бронирования");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Статус бронирования");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Сумма за бронирование");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Дата оплаты бронирования");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Дата годности бронирования");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "ID оплаты бронирования");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Дата добавления билета в корзину");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Тип билета");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Цена билета на момент добавления");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Предоставленная скидка на билет");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Сумма возврата по билету");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Сумма оплаты по билету");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Оплачено внутренним балансом за билет");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Статус билета");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Промо-код");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Процент скидки");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "ID оплаты билета");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Дата добавления МК в корзину");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Название МК");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Цена МК на момент добавления");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Предоставленная скидка на МК");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Сумма возврата по МК");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Сумма оплаты по МК");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Оплачено внутренним балансом за МК");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Статус МК");
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "ID оплаты МК");

            $column_index = 0;
            $row_index++;

            foreach ($lines AS $line) {
                // подготовка десериализованных данных
                $bookingSerializedData = @unserialize($line->bookingSerializedData);
                $basketSerializedData = @unserialize($line->basketSerializedData);
                $basketProductSerializedData = @unserialize($line->basketProductSerializedData);
                $paySerializedData = @unserialize($line->paySerializedData);
                // базовые данные
                $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->userId));
                $column_index++;
                $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->userStatus));
                $column_index++;
                $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->phone));
                $column_index++;
                $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->email));
                $column_index++;
                $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->typeUser));
                $column_index++;
                $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->lastname) . " " . self::removeDelimiters($line->name));
                $column_index++;
                $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->utm));
                $column_index++;
                $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->cityName));
                $column_index++;
                $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->countryName));
                $column_index++;
                $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->company));
                $column_index++;
                $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->position));
                $column_index++;
                $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::amountChange(self::removeDelimiters($line->ulBalance)));
                $column_index++;
                $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->inn));
                $column_index++;
                $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->details));
                $column_index++;
                $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->parentUserInfo));
                $column_index++;
                $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->userCreated));
                $column_index++;
                $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->userRegister));
                $column_index++;
                $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->userOnline));
                $column_index++;
                $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->youAboutUs));
                $column_index++;
                $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->metroCard));
                $column_index++;

                // бронирования
                if (isset($bookingSerializedData[0]) && is_array($bookingSerializedData[0]) && count($bookingSerializedData[0])) {
                    $bookingSerializedDataShow = $bookingSerializedData[0];
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($bookingSerializedDataShow['createDate']));
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters(($bookingSerializedDataShow['status'] == 'STATUS_NEW') ? 'Не оплачено' : 'Оплачено'));
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::amountChange(self::removeDelimiters($bookingSerializedDataShow['payAmount'])));
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($bookingSerializedDataShow['payDate']));
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($bookingSerializedDataShow['finishDate']));
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($bookingSerializedDataShow['monetaOperationId']));
                    $column_index++;
                } else {
                    $bookingSerializedDataShow = null;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                    $column_index++;
                }

                // основной билет
                if (isset($basketSerializedData[0]) && is_array($basketSerializedData[0]) && count($basketSerializedData[0])) {
                    $basketSerializedDataShow = $basketSerializedData[0];
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($basketSerializedDataShow['createdDate']));
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($basketSerializedDataShow['baseTicketName']));
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::amountChange(self::removeDelimiters($basketSerializedDataShow['needAmount'])));
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::amountChange(self::removeDelimiters($basketSerializedDataShow['discountAmount'])));
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::amountChange(self::removeDelimiters($basketSerializedDataShow['returnedAmount'])));
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::amountChange(self::removeDelimiters($basketSerializedDataShow['payAmount'])));
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::amountChange(self::removeDelimiters($basketSerializedDataShow['ulAmount'])));
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters(Basket::getStatusDesc($basketSerializedDataShow['status'])));
                    $column_index++;
                } else {
                    $basketSerializedDataShow = null;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                    $column_index++;
                }

                // промо-код и % скидки
                if (isset($basketSerializedDataShow['discountCode']) && $basketSerializedDataShow['discountCode']) {
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($basketSerializedDataShow['discountCode']));
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($basketSerializedDataShow['discountPercent']));
                    $column_index++;
                } else {
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                    $column_index++;
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                    $column_index++;
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

                // ставим оплаты сюдаы
                if (is_array($monetaIdsArray) && count($monetaIdsArray)) {
                    $monetaIds = implode(',', $monetaIdsArray);
                }
                if (isset($basketSerializedDataShow['monetaOperationId']) && $basketSerializedDataShow['monetaOperationId']) {
                    // новый вариант: monetaId в каждой строке корзины
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($basketSerializedDataShow['monetaOperationId']));
                } else {
                    $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($monetaIds));
                }

                // по МК выгрузить тоже
                if (is_array($basketProductSerializedData) && count($basketProductSerializedData)) {
                    foreach ($basketProductSerializedData AS $basketProductSerializedItem) {
                        $column_index = 0;
                        $row_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->userId));
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->phone));
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->email));
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->typeUser));
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->lastname) . " " . self::removeDelimiters($line->name));
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->utm));
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->cityName));
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->countryName));
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line->company));
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;

                        if (isset($basketProductSerializedItem['discountCode']) && $basketProductSerializedItem['discountCode']) {
                            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($basketProductSerializedItem['discountCode']));
                            $column_index++;
                            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($basketProductSerializedItem['discountPercent']));
                            $column_index++;
                        } else {
                            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                            $column_index++;
                            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                            $column_index++;
                        }

                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        $column_index++;

                        // по МК
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($basketProductSerializedItem['createdDate']));
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($basketProductSerializedItem['productName']));
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::amountChange(self::removeDelimiters($basketProductSerializedItem['needAmount'])));
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::amountChange(self::removeDelimiters($basketProductSerializedItem['discountAmount'])));
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::amountChange(self::removeDelimiters($basketProductSerializedItem['returnedAmount'])));
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::amountChange(self::removeDelimiters($basketProductSerializedItem['payAmount'])));
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::amountChange(self::removeDelimiters($basketProductSerializedItem['ulAmount'])));
                        $column_index++;
                        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters(BasketProduct::getStatusDesc($basketProductSerializedItem['status'])));
                        $column_index++;
                        if ($basketProductSerializedItem['monetaOperationId']) {
                            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($basketProductSerializedItem['monetaOperationId']));
                        } else {
                            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, '');
                        }
                        $column_index++;
                    }
                }
                $column_index = 0;
                $row_index++;
            }
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            // We'll be outputting an excel file
            header('Content-type: application/vnd.ms-excel');
            // It will be called file.xls
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            // Write file to the browser
            $objWriter->save('php://output');
            exit;
        } else {
            Adminka::redirect("managereport", "Отчет пуст");
        }
    }

    private static function removeDelimiters($string) {
        $string = str_replace(array(self::FIELD_DELIMETER, self::LINE_DELIMETER), '', $string);
        return html_entity_decode($string);
    }

    private static function amountChange($string) {
        $string = str_replace('.', ',', $string);
        return $string;
    }
}