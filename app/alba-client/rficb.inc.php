<?php

class RfiLib {
    const STATUS_NEW = 'STATUS_NEW';
    const STATUS_FINISHED = 'STATUS_FINISHED';
    const STATUS_CANCELED = 'STATUS_CANCELED';

    /**
     * Функция формирующая форму оплаты РФИ
     * @param integer $order_id - номер заказа
     * @param type $phone - телефон
     * @param type $email - ящик
     * @param type $amount - сумма
     * @return string HTML форма оплаты
     * @throws Exception
     */
    public function showPaymentFrom($order_id, $phone, $email, $amount) {
        if (!$order_id) {
            return "Заказ не найден.";
        }
        $strDescription = 'Оплата заказа №'.$order_id;
        $arrFields = array(
            'key'       => Configurator::get("rfi:key"),
            'order_id'  => $order_id,
            'cost'      => number_format($amount, 2, '.', ''),
            'name'      => $strDescription,
        );
        if(!empty($email)) {
            $arrFields['default_email'] = $email;
        }
        $output  = "<form name='paymentform' action='https://partner.rficb.ru/a1lite/input/' method='POST'>";
        foreach($arrFields as $strName => $strKey) {
            $output .= "<input type='hidden' name='" . $strName . "' value='" . $strKey . "'>";
        }
        if (Configurator::get("rfi:redirect") == 0) {
            $output .= "<input type='submit' value='Оплатить сейчас'></form>";
        } else {
            $output .= "<script type='text/javascript'>document.paymentform.submit();</script>";
        }
        return $output;
    }
}