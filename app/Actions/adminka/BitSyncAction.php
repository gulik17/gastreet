<?php

/**
 *
 */
require_once __DIR__ . '/../../../config.core.php';
require_once SOLO_CORE_PATH . '/Enviropment.php';

class BitSyncAction extends AdminkaAction {

    public function execute() {
        $task = Request::getVar("task");
        $eventicious = new Eventicious();
        $eventicious->setHost(Configurator::get("eventicious:host"));
        $eventicious->setCode(Configurator::get("eventicious:code"));
        $mes = '';

        // Синхронизируем МК (Мастер-классы)
        if (($task == "products") && (Configurator::get("application:bitSync") == 1)) {
            // перезагрузка наименований
            $bpm = new BasketProductManager();
            // перезалить список доступа в систему 1С Бит
            $pm = new ProductManager();
            // подлючем класс для синхронизации включенных МК
            $ucm = new UserQrCodeManager();
            $products = $pm->getAll();
            if (is_array($products) && count($products)) {
                foreach ($products AS $product) {
                    if ($product->status == Product::STATUS_ENABLED) {
                        $showDate = date("Y-m-d H:i:s", $product->eventTsStart);
                        $control = ($product->price > 0) ? true : false;
                        $masterclass_id = 0;
                        $masterclass_id = $ucm->bitUpdateEvent($product->ext_id, $product->name, $showDate, $control);
                        $mes .= "UpdateEvent: ProductID: $product->id | ExternalID: $masterclass_id <br>";
                        if ($product->ext_id != $masterclass_id) {
                            $pm->updateExtID($product->id, $masterclass_id);
                        }
                    } elseif ($product->status == Product::STATUS_DISABLED) {
                        if ($product->ext_id > 0) {
                            $ucm->bitDeleteEvent($product->ext_id);
                            $mes .= "DeleteEvent: ProductID: $product->id | ExternalID: $product->ext_id <br>";
                        }
                    }
                }
            }
            Adminka::redirectBack($mes);
        }

        // Удаляем МК (Мастер-классы)
        if (($task == "delProducts") && (Configurator::get("application:bitSync") == 1)) {
            // перезагрузка наименований
            $pm = new ProductManager();
            $products = $pm->getAllActive();
            if (is_array($products) && count($products)) {
                foreach ($products AS $product) {
                    $ucm->bitDeleteEvent($product->ext_id);
                    $mes .= "DeleteEvent: ProductID: $product->id | ExternalID: $product->ext_id <br>";
                }
            }
            Adminka::redirectBack($mes);
        }

        // Синхронизируем юзеров
        if ($task == "users") {
            // перезагрузка наименований
            $um = new UserManager();
            $count = $um->getBitStatus();
           // UserManager::realSendTicketViaEmail(7924);
            Adminka::redirectBack($count);
        }

        // Всякое разное
        if ($task == "rfiFix") {
            // перезагрузка наименований

            $bpm = new BasketProductManager();
            $errorPaidProducts = $bpm->getAllErrorPaidProducts();
            if (is_array($errorPaidProducts) && count($errorPaidProducts)) {
                foreach ($errorPaidProducts AS $errorPaidProduct) {
                    $errorPaidProduct = (object) $errorPaidProduct;
                    $query = "UPDATE basketProduct SET payAmount = '{$errorPaidProduct->needAmount}' WHERE id = $errorPaidProduct->id";
                    $bpm->executeNonQuery($query);
                    
                $mes .= "User ID: {$errorPaidProduct->userId} payAmount: {$errorPaidProduct->needAmount}<br>";
                }
            }

            /*
            $um = new UserManager();

            $bm = new BasketManager();
            $paidTickets = $bm->getAllPaidTickets();
            if (is_array($paidTickets) && count($paidTickets)) {
                foreach ($paidTickets AS $paidTicket) {
                    $paidTicket = (object) $paidTicket;
                    if ( ($paidTicket->discountCode != 'спикер2018') &&
                            ($paidTicket->discountCode != 'шеф2018') &&
                            ($paidTicket->discountCode != 'S_REBRO') &&
                            ($paidTicket->baseTicketId != 5) ) {
                        if ($paidTicket->childId == null) {
                            $um->setQueueTicketViaEmail($paidTicket->userId);
                            $mes .= $paidTicket->userId."<br>";
                        } else {
                            $um->setQueueTicketViaEmail($paidTicket->childId);
                            $mes .= $paidTicket->childId."<br>";
                        }
                    }
                }
            }*/
            Adminka::redirectBack($mes);
        }
    }
}