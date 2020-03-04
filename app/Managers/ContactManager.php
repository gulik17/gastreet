<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 12.02.17
 * Time: 9:47
 */
class ContactManager extends BaseEntityManager {

    public function getAll() {
        $sql = new SQLCondition();
        $sql->orderBy = "sortOrder, name";
        return $this->get($sql);
    }

    public function delContact($id) {
        $id = intval($id);
        $file = $id . '.jpg';
        $this->remove($id);
        @unlink(Configurator::get("application:contactsFolder") . "resized/" . $file);
        @unlink(Configurator::get("application:contactsFolder") . "uploaded/" . $file);
    }

}
