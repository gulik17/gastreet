<?php

/**
 *
 */
class CountryLangManager extends BaseEntityManager {
    public function getAll() {
        $sql = new SQLCondition();
        return $this->get($sql);
    }
    
    public function getAllCountryLang($lang) {
        $sql = new SQLCondition();
        $_country_lang = array();
        $countryArr = $this->get($sql);
        if (is_array($countryArr) && count($countryArr)) {
            foreach ($countryArr AS $country) {
                $_country_lang[$country->alias] = ($lang === 'en') ? $country->name_en : $country->name;
            }
            return $_country_lang;
        }
        return null;
    }
    
    /**
     * Выбрать страны по ID
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