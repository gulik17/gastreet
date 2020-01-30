<?php
/**
 * Контрол для представления формы управления пользователями
 * 
 */
class ManageOperatorsControl extends BaseAdminkaControl {
    public function render() {
	$om = new OperatorManager();
	$operatorIds = $om->getOperatorIds();

	// пейджер
        $perPage = FrontPagerControl::getLimit();
        $this->addData("perPage", $perPage);
        $this->addData("total", count($operatorIds));
        $this->addData("page", Request::getInt("page"));
        $operatorIds = FrontPagerControl::limit($operatorIds, $perPage, "page");

	if ($operatorIds) {
            $operatorList = $om->getByIds($operatorIds);
            $this->addData("operatorList", $operatorList);
        }
        $this->addData("operatorStatuses", Operator::getStatusDesc());
    }
}