<?php

/**
 *
 */
class CopyProductAction extends AdminkaAction {
    public function execute() {
        $doAct = "Продукт скопирован";
        $id = Request::getInt("id");

        $pm = new ProductManager();
        $pmObj = null;
        if ($id) {
            $pmObj = $pm->getById($id);
            if ($pmObj) {
                
            } else {
                Adminka::redirect("manageproducts", 'Ошибка копирования, не найден копируемый продукт');
            }
        }

        $product = new Product();
        $product->placeId        = $pmObj->placeId;
        $product->areaId         = $pmObj->areaId;
        $product->speakerId      = $pmObj->speakerId;
        $product->speaker2Id     = $pmObj->speaker2Id;
        $product->speaker3Id     = $pmObj->speaker3Id;
        $product->speaker4Id     = $pmObj->speaker4Id;
        $product->speaker5Id     = $pmObj->speaker5Id;
        $product->speaker6Id     = $pmObj->speaker6Id;
        $product->partner_id     = $pmObj->partner_id;
        $product->status         = $pmObj->status;
        $product->showInSchedule = $pmObj->showInSchedule;
        $product->name           = $pmObj->name;
        $product->description    = $pmObj->description;
        $product->firstName      = $pmObj->firstName;
        $product->secondName     = $pmObj->secondName;
        $product->cityName       = $pmObj->cityName;
        $product->company        = $pmObj->company;
        $product->position       = $pmObj->position;
        $product->youtube        = $pmObj->youtube;
        $product->tags           = $pmObj->tags;
        $product->tag_desc       = $pmObj->tag_desc;
        $product->plan           = $pmObj->plan;
        $product->price          = $pmObj->price;
        $product->pic1           = $pmObj->pic1;
        $product->pic2           = $pmObj->pic2;
        $product->oldPrice       = $pmObj->oldPrice;
        $product->maxCount       = $pmObj->maxCount;
        $product->eventTsStart   = $pmObj->eventTsStart;
        $product->eventTsFinish  = $pmObj->eventTsFinish;
        $product->tsUpdate       = time();
        $product = $pm->save($product);

        Adminka::redirect("editproduct&id={$product->id}", $doAct);
    }
}