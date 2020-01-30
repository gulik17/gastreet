<?php

/**
 * cp project
 * Менеджер управления основными настройками системы
 */
class SettingsManager extends BaseEntityManager {

    /**
     * Функция возвращает список настроек, их расшифровок и значений
     *
     * @return array [name => array(description, value) ]
     */
    public function getSettingsList() {
        $stopArray = $this->getKeyStopArray();

        $sql = "SELECT * FROM settings";
        $res = $this->getByAnySQL($sql);
        $out = null;

        foreach ($res as $item) {
            if (in_array($item['name'], $stopArray))
                continue;

            $out[$item['name']] = $item;
        }

        return $out;
    }

    /**
     * @var array в этот массив сохраним настройки которые запрашивали чтобы не делать лишних запросов
     */
    private static $cache = array();

    /**
     * Функция возвращает значение настройки системы по её имени
     * 
     * @param string $name имя настройки
     * @return object
     */
    public static function getValue($name) {
        if (array_key_exists($name, self::$cache)) {
            return self::$cache[$name];
        } else {
            $sql = "SELECT * FROM settings WHERE name = '{$name}'";
            $sm = new self();
            $value = $sm->getOneByAnySQL($sql);

            self::$cache[$name] = $sm->convertType($value['value']);
            return self::$cache[$name];
        }
    }

    /**
     * Функция обновление значения параметра
     *
     * @param name имя параметра настройки
     * @param newValue новое значение
     */
    public function updateValue($name, $newValue = '') {
        if ($name && $name != '') {
            $sql = "UPDATE settings SET value='{$newValue}' WHERE name = '{$name}'";
            $this->executeNonQuery($sql);
        }
    }

    /**
     * Функция преобразует строковые значения в типы находящихся в строке данных
     * 
     * @param string $value значение настройки
     * @return string
     */
    protected function convertType($value) {
        // bool
        if (preg_match("/^true$/i", $value))
            return true;
        if (preg_match("/^false$/i", $value))
            return false;

        // int
        if (preg_match("/^[0-9]+$/i", $value))
            return (int) $value;

        // float
        if (preg_match("/^[0-9]+(\.[0-9]{2})?$/i", $value))
            return (float) $value;

        // array
        if (strstr($value, ":")) {
            $values = explode(";", $value);
            $newValue = array();
            foreach ($values as $val) {
                $params = explode(":", $val);
                $key = $params[0];
                unset($params[0]);
                $newValue[$key] = implode(":", $params);
            }
            return $newValue;
        }

        // string
        return $value;
    }

    // значения, которые не надо править
    private function getKeyStopArray() {
        return array('master');
    }

}
