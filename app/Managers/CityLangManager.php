<?php

/**
 *
 */
class CityLangManager extends BaseEntityManager {
    public function getAll() {
        $sql = new SQLCondition();
        return $this->get($sql);
    }
    
    public function getAllCityLang($lang) {
        $sql = new SQLCondition();
        $_city_lang = array();
        $cityArr = $this->get($sql);
        if (is_array($cityArr) && count($cityArr)) {
            foreach ($cityArr AS $city) {
                //$_city_lang[$city->id] = ($lang === 'en') ? $city->name_en : $city->name;
                $_city_lang[$city->id] = $city->name;
            }
            return $_city_lang;
        }
        return null;
    }
    
    /**
     * Выбрать города по ID
     * @param type $ids Массив
     * @return type
     */
    public function getByIds($ids) {
        if (!$ids) {
            return null;
        }
        if (count($ids) == 0) {
            return null;
        }
        $str_ids = implode(",", $ids);
        $res = $this->get(new SQLCondition("id IN ($str_ids)", null, "id"));
        return $res;
        //deb($res);
        //return Utility::sort($ids, $res);
    }
}