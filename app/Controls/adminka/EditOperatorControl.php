<?php

/**
 *
 */
class EditOperatorControl extends BaseAdminkaControl {
    public $pageTitle = "Редактирование оператора";

    public function render() {
        $id = Request::getInt("id");
        if (!$id) {
            $this->pageTitle = "Создание оператора";
        } else {
            $om = new OperatorManager();
            $omObj = $om->getById($id);
            if (!$omObj) {
                Adminka::redirect("manageoperators", "Оператор не найден");
            } else {
                $settings = unserialize($omObj->role);
                $permissions = Adminka::getAllPermissions();
                foreach ($permissions as $key => $perm) {
                    if ($key <= count($settings)) {
                        $permissions[$key]['perm'] = $settings[$perm['name']];
                    }
                }

                $this->addData("permissions", $permissions);
                $this->addData("operator", $omObj);
            }
        }

        $this->addData("statusList", Operator::getStatusDesc());
    }
}