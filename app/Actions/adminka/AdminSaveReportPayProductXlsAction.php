<?php

/**
 */
class AdminSaveReportPayProductXlsAction extends AdminkaAction {
    const FIELD_DELIMETER = "\t";
    const LINE_DELIMETER = "\n\r";
    public function execute() {
        $product_id = Request::getInt("product");
        if (!$product_id) {
            Adminka::redirect("reportpayproduct", "Не задан МК");
        }

        $um = new UserManager();
        $bpm = new BasketProductManager();
        $products = $bpm->getPayedByProductId($product_id);
        if (!$products) {
            Adminka::redirect("reportpayproduct", "Список пуст");
        }

        foreach ($products AS $key => $product) {
            if ($product['childId']) {
                $user = $um->getByUserIdAndChildId($product['userId'], $product['childId']);
            } else {
                $user = $um->getById($product['userId']);
            }
            $products[$key] = $product;
            $products[$key]['lastname'] = $user->lastname;
            $products[$key]['name'] = $user->name;
            $products[$key]['phone'] = $user->phone;
        }
        
        $productName = $products[0]['productName'];

        usort($products, function($a, $b){
            return strcmp($a["lastname"], $b["lastname"]);
        });

        $fileName = "reportPayProduct-{$product_id}.xlsx";

        require_once APPLICATION_DIR . "/phpexcel/Classes/PHPExcel.php";
        // генерируем xls файл
        $objPHPExcel = new PHPExcel();
        $out_sheet = $objPHPExcel->getActiveSheet();

        // $column_index - колонка
        // $row_index - строка
        // $value - значение

        $column_index = 0;
        $row_index = 1;
        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, $productName);
        $row_index++;
        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "#");
        $column_index++;
        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Фамилия");
        $column_index++;
        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Имя");
        $column_index++;
        $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, "Телефон");
        $column_index++;

        $column_index = 0;
        $row_index++;

        foreach ($products AS $key => $line) {
            // базовые данные
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($key+1));
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line['lastname']));
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line['name']));
            $column_index++;
            $out_sheet->setCellValueByColumnAndRow($column_index, $row_index, self::removeDelimiters($line['phone']));
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
    }

    private static function removeDelimiters($string) {
        $string = str_replace(array(self::FIELD_DELIMETER, self::LINE_DELIMETER), '', $string);
        return html_entity_decode($string);
    }
}