<?php
/**
 * Контрол для представления формы управления пользователями
 * 
 */
class ManageVolunteerControl extends BaseAdminkaControl {
    public function render() {
        $isalive = Request::getInt("isalive");
        $mode = Request::getVar("mode");

	$id       = Request::getInt("volunteerid");
	$lastname = Request::getVar("lastname");
        $name     = Request::getVar("name");
        $phone    = Request::getVar("phone");
	$email    = Request::getVar("email");

	// если не заполнили основные поля формы
	// 1 - выключен, 2 - включен
	if (!$id && !$lastname && !$name && !$phone && !$email) {
            $basicfilter = 1;
        } else {
            $basicfilter = 2;
        }

	// свернем переменные фильтра в массив
	$sendArray = compact("mode", "id", "basicfilter", "lastname", "name", "phone", "email");

	if ($isalive == 1) {
            FormRestore::add("volunteer-filter");
        }

	// получим список id пользовалтелей по фильтру
	$vm = new VolunteerManager();
	$volunteerIds = $vm->getFilteredVolunteerIds($sendArray);

	// пейджер
        if (!$isalive) {
            $perPage = FrontPagerControl::getLimit();
            $this->addData("perPage", $perPage);
            $this->addData("total", count($volunteerIds));
            $this->addData("page", Request::getInt("page"));
            $volunteerIds = FrontPagerControl::limit($volunteerIds, $perPage, "page");
        }

	if ($volunteerIds) {
            //deb($volunteerIds);
            $volunteerList = $vm->getByIds($volunteerIds);
            $this->addData("volunteerList", $volunteerList);
        }
        $this->addData("volunteerStatuses", Volunteer::getStatusDesc());
    }
}