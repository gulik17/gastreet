<?php
/**
 * Для валидации строковых данных
 */
class StringFilter extends BaseFilter {
    /**
     * Класс для валидации строковых переменных
     * 
     * @param string $name имя параметра $_REQUEST
     * @param boolean $isRequired флаг определяющий обязательное поле
     * @param string $description описание поля
     * @param integer $maxLen максимальное количество символов
     * @param integer $minLen минимальное количество символов
     * @return boolean возвращаем false в случае ошибки
     */
    public function __construct($name, $isRequired, $description, $maxLen = 255, $minLen = 0) {
        $value = Request::getVar($name);
        // обязательно вызывать
        $this->setValue($value);
        if($isRequired && $value == null) {
            $this->message = "Обязательное поле $description";
            return false;
        }
        if ( ($value != null) && (mb_strlen($value) > $maxLen) ) {
            $this->message = "$description превышает допустимую длину";
            //$this->message = "Поле $description заполнено некорректно";
            return false;
        }
        if ( ($value != null) && (mb_strlen($value) < $minLen) ) {
            //$this->message = "$description превышает допустимую длину";
            $this->message = "Поле $description заполнено некорректно";
            return false;
        }
    }
}