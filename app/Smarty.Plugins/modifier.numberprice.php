<?php
    /**
     * Преобразовывает Float в Integer и приводит к денежному формату (10000 -> 10 000)
     * @param string $value Сумма которую будет форматировать
     * @return string
     */

function smarty_modifier_numberprice($value) {
    return number_format($value, 0, '.', '&nbsp;');
}