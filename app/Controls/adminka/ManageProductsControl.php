<?php

/**
 *
 */
class ManageProductsControl extends BaseAdminkaControl {

    public function render() {
        $isalive = Request::getInt("isalive");
        $mode = Request::getVar("mode");

        $id = Request::getInt("id");
        $prog = Request::getVar("prog");
        $place = Request::getVar("place");
        $status = Request::getVar("status");

        if (!isset($prog)) {
            $prog = Context::getObject("prog");
        } else {
            Context::setObject("prog", $prog);
        }
        
        if (!isset($place)) {
            $place = Context::getObject("place");
        } else {
            Context::setObject("place", $place);
        }
        
        $this->addData("prog", $prog);
        $this->addData("place", $place);

        // если не заполнили основные поля формы
        // 1 - выключен, 2 - включен
        if (!$id && !$prog&& !$place && !$status) {
            $basicfilter = 1;
        } else {
            $basicfilter = 2;
        }
        // свернем переменные фильтра в массив
        $sendArray = compact("mode", "id", "basicfilter", "prog", "place", "status");
        
       // deb($sendArray);

        if ($isalive == 1) {
            FormRestore::add("products-filter");
        }

        $pm = new ProductManager();
        $prodIds = $pm->getFilteredProductsIds($sendArray);

        // пейджер
        $perPage = 30;
        $this->addData("perPage", $perPage);
        $this->addData("total", count($prodIds));
        $this->addData("page", Request::getInt("page"));
        if ($prodIds) {
            $productList = $pm->getByIds($prodIds);
            
            // пейджер
            $perPage = FrontPagerControl::getLimit();
            $this->addData("perPage", $perPage);
            $this->addData("total", count($productList));
            $this->addData("page", Request::getInt("page"));
            $productList = FrontPagerControl::limit($productList, $perPage, "page");
            
            $this->addData("productsList", $productList);
        }

        $this->addData("statusDesc", Product::getStatusDesc());

        // программы
        $amArray = array();
        $am = new AreaManager();
        $amList = $am->getAll();
        if (is_array($amList) && count($amList)) {
            foreach ($amList AS $amObj) {
                $amArray[$amObj->id] = $amObj->name;
            }
            $this->addData("amArray", $amArray);
        }
        
        // Локации
        $placeArray = array();
        $placem = new PlaceManager();
        $placeList = $placem->getAll();
        if (is_array($placeList) && count($placeList)) {
            foreach ($placeList AS $placeObj) {
                $placeArray[$placeObj->id] = $placeObj->name;
            }
            $this->addData("placeArray", $placeArray);
        }

        // спикеры
        $smArray = array();
        $sm = new SpeakerManager();
        $smList = $sm->getAll();
        if (is_array($smList) && count($smList)) {
            foreach ($smList AS $smObj) {
                $smArray[$smObj->id] = $smObj->name . ' ' . $smObj->secondName;
            }
            $this->addData("smArray", $smArray);
        }
    }
}
