<?php

/**
 * Компонент отображает меню
 */
class AdminkamenuControl extends AuthorizedAdminkaControl implements IComponent {
    public function render() {
        // текущие права актора
        //$this->addData("permissions", Adminka::getCurrentPermissions());

        $om = new OperatorManager();
        $omObj = $om->getById($this->actor->id);
        if (!$omObj) {
            Adminka::redirect("manageoperators", "Оператор не найден");
        } else {
            $settings = unserialize($omObj->role);
            $permissions = Adminka::getAllPermissions();
            foreach ($permissions as $key => $perm) {
                $permissions[$key]['perm'] = $settings[$perm['name']];
            }
            
            $this->addData("permissions", $permissions);
            $this->addData("operator", $omObj);
        }
    }

}
