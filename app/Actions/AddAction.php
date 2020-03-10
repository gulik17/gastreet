<?php

/**
 * Добавить в корзину
 *
 */
class AddAction extends AuthorizedUserAction implements IPublicAction {

    public function execute() {
        $isAjax = Request::getInt("isAjax");
        $bObj = null;

        // проверить заполнен ли профайл данного пользователя
        UserManager::redirectIfNoProfile($this->actor, $isAjax);

        $ticket = Request::getVar("ticket");
        $product = Request::getInt("product");

        $extuser = Request::getInt("extuser");

        $parentObj = null;
        $um = new UserManager();
        $bm = new BasketManager();

        if ($ticket === 'rebro') {
            if ($extuser) {
                $res = UserManager::sendNotifyRebro('request@gastreet.com', $extuser);
            } else {
                $res = UserManager::sendNotifyRebro('request@gastreet.com', $this->actor->id);
            }

            if ($res == 'allReadyHave') {
                if ($isAjax) {
                    if ($this->lang == 'en') {
                        $array['error'] = 'Вы уже отправляли заявку на билет ReBro!';
                    } else {
                        $array['error'] = 'Вы уже отправляли заявку на билет ReBro!';
                    }
                    echo json_encode($array);
                    exit;
                } else {
                    Enviropment::redirectBack("Вы уже отправляли заявку на билет ReBro!", "danger");
                }
            }

            if ($isAjax) {
                if ($this->lang == 'en') {
                    $array['error'] = 'The application has been sent. Our manager will contact you!';
                } else {
                    $array['error'] = 'Ваша заявка будет рассмотрена в течении 3 рабочих дней!';
                    //$array['error'] = 'Ваша заявка будет рассмотрена после 27&nbsp;января в&nbsp;течении 5&nbsp;рабочих дней!';
                }
                echo json_encode($array);
                exit;
            } else {
                Enviropment::redirectBack("Ваша заявка будет рассмотрена в течении 3 рабочих дней!", "success");
                //Enviropment::redirectBack("Ваша заявка будет рассмотрена после 27&nbsp;января в&nbsp;течении 5&nbsp;рабочих дней!", "success");
            }
        }

        if ($ticket == 1 && !$this->actor->parentUserId && !$extuser) {
            if ($isAjax) {
                if ($this->lang == 'en') {
                    $array['error'] = 'This ticket can only be bought for your additional member.';
                } else {
                    $array['error'] = 'Данный билет можно купить только для вашего дополнительного участника';
                }
                echo json_encode($array);
                exit;
            } else {
                Enviropment::redirect("basket", "Данный билет можно купить только для вашего дополнительного участника", "danger");
            }
        }

        if ($ticket == 1) {
            $tickets = $bm->getTicketsByUserId($this->actor->id);
            $t_tourist_count = 0;
            $t_all_count = count($tickets);
            foreach ($tickets as &$t) {
                if ($t['baseTicketId'] == 1) {
                    $t_tourist_count++;
                }
            }
            $t_real_count = $t_all_count - $t_tourist_count;
            $t_free_count = $t_real_count  - $t_tourist_count;
            if ($t_free_count < 1) {
                if ($isAjax) {
                    if ($this->lang == 'en') {
                        $array['error'] = 'You have the maximum number of Tourist tickets for the basket.';
                    } else {
                        $array['error'] = 'У Вас максимальное количество билетов Спутник для корзины';
                    }
                    echo json_encode($array);
                    exit;
                } else {
                    Enviropment::redirect("basket", "У Вас максимальное количество билетов Спутник для корзины", "danger");
                }
            }
        }

        if ($this->actor->parentUserId) {
            $parentObj = $um->getById($this->actor->parentUserId);
        }

        $child = Context::getObject("__child");

        if ($child) {
            $user = $child;
            $currentUser = $this->actor;
        } else if ($parentObj) {
            $child = $this->actor;
            $user = $child;
            $currentUser = $parentObj;
        } else {
            $user = $this->actor;
        }

        if (!$ticket && !$product) {
            if ($isAjax) {
                echo json_encode("no_ticketorproduct");
                exit;
            } else {
                if ($this->lang == 'en') {
                    Enviropment::redirectBack("No item selected!", "danger");
                } else {
                    Enviropment::redirectBack("Не выбран товар!", "danger");
                }
            }
        }

        $pm = new ProductManager();
        if ($product) {
            $productObj = $pm->getById($product);
            if (!$productObj || $productObj->status != Product::STATUS_ENABLED || $productObj->leftCount < 1) {
                if ($isAjax) {
                    echo json_encode("no_productorproductstatus");
                    exit;
                } else {
                    if ($this->lang == 'en') {
                        Enviropment::redirectBack("No item found!", "danger");
                    } else {
                        Enviropment::redirectBack("Не найден товар!", "danger");
                    }
                }
            }
        }

        $productId = Request::getInt("productId");
        $mode = Request::getVar("mode");
        $btm = new BaseTicketManager();
        if ($ticket) {
            $ticketObj = $btm->getById($ticket);
            if (!$ticketObj || $ticketObj->status != BaseTicket::STATUS_ENABLED || $ticketObj->leftCount < 1) {
                if ($isAjax) {
                    echo json_encode("no_ticketorticketstatus");
                    exit;
                } else {
                    if ($this->lang == 'en') {
                        Enviropment::redirectBack("No ticket found!", "danger");
                    } else {
                        Enviropment::redirectBack("Не найден билет!", "danger");
                    }
                }
            }
        }

        // покупка на нового подопечного участника
        if (!$child && $mode == "newuser") {
            // этого нет при работе через AJAX
            if ($this->lang == 'en') {
                $id = FilterInput::add(new StringFilter("id", false, "User ID"));   // актор
                $phone = FilterInput::add(new StringFilter("phone", true, "Phone"));
                $email = FilterInput::add(new StringFilter("email", true, "E-Mail"));
                $name = FilterInput::add(new StringFilter("name", true, "Name"));
                $lastname = FilterInput::add(new StringFilter("lastname", true, "Last Name"));
                $countryName = FilterInput::add(new StringFilter("countryName", true, "Country"));
                $cityName = FilterInput::add(new StringFilter("cityName", true, "City"));
                $company = FilterInput::add(new StringFilter("company", true, "Company"));
                $position = FilterInput::add(new StringFilter("position", true, "Position"));
            } else {
                $id = FilterInput::add(new StringFilter("id", false, "ID пользователя"));   // актор
                $phone = FilterInput::add(new StringFilter("phone", true, "Номер телефона"));
                $email = FilterInput::add(new StringFilter("email", true, "E-Mail"));
                $name = FilterInput::add(new StringFilter("name", true, "Имя"));
                $lastname = FilterInput::add(new StringFilter("lastname", true, "Фамилия"));
                $countryName = FilterInput::add(new StringFilter("countryName", true, "Страна"));
                $cityName = FilterInput::add(new StringFilter("cityName", true, "Город"));
                $company = FilterInput::add(new StringFilter("company", true, "Компания"));
                $position = FilterInput::add(new StringFilter("position", true, "Должность"));
            }

            $phone = Phone::phoneVerification($phone);

            if (!FilterInput::isValid()) {
                FormRestore::add("user-new");
                Enviropment::redirectBack(FilterInput::getMessages());
            }

            if ($phone["isError"]) {
                FormRestore::add("user-new");
                if ($this->lang == 'en') {
                    Enviropment::redirectBack("Incorrect number format", "danger");
                } else {
                    Enviropment::redirectBack("Неверный формат номера", "danger");
                }
            } else {
                $phone = $phone["number"];
            }

            // проверка уникальности $phone и $email
            $um = new UserManager();
            if ($um->getByPhone($phone)) {
                FormRestore::add("user-new");
                if ($this->lang == 'en') {
                    Enviropment::redirectBack("Mobile number entered not unique", "danger");
                } else {
                    Enviropment::redirectBack("Указанный номер мобильного не уникален", "danger");
                }
            }
            if ($um->getByEmail($email)) {
                FormRestore::add("user-new");
                if ($this->lang == 'en') {
                    Enviropment::redirectBack("E-mail entered not unique", "danger");
                } else {
                    Enviropment::redirectBack("Указанный E-mail не уникален", "danger");
                }
            }
            if ($um->getByConfirmedEmail($email)) {
                FormRestore::add("user-new");
                if ($this->lang == 'en') {
                    Enviropment::redirectBack("E-mail entered not unique", "danger");
                } else {
                    Enviropment::redirectBack("Указанный E-mail не уникален", "danger");
                }
            }

            // текущий актор
            $currentUser = $um->getById($user->id);
            // всё в норме, добавим нового пользователя
            $user = new User();
            $user->parentUserId = $currentUser->id;
            $user->phone = $phone;
            $user->email = $email;
            $user->name = $name;
            $user->lastname = $lastname;
            $user->countryName = $countryName;
            $user->cityName = $cityName;
            $user->company = $company;
            $user->position = $position;
            $user->tsCreated = time();
            $user->tsRegister = time();
            $user->status = User::STATUS_REGISTERED;
            $user->type = User::TYPE_USER;
            $user = $um->save($user);
            $user->disableBroadcastKey = md5($user->id . $user->tsCreated);
            $user = $um->save($user);
            UserManager::updateUser4App($user);
        }

        // покупка на подопечного уже существующего
        if (!$child && $mode == "existuser") {
            $extuser = Request::getInt("extuser");
            if (!$extuser) {
                if ($isAjax) {
                    echo json_encode("no_extuser");
                    exit;
                } else {
                    if ($this->lang == 'en') {
                        Enviropment::redirectBack("No user selected", "danger");
                    } else {
                        Enviropment::redirectBack("Не выбран пользователь", "danger");
                    }
                }
            }
            // текущий актор
            $um = new UserManager();
            $currentUser = $um->getById($user->id);
            $user = $um->getById($extuser);
            if (!$user) {
                if ($isAjax) {
                    echo json_encode("no_curuser");
                    exit;
                } else {
                    if ($this->lang == 'en') {
                        Enviropment::redirectBack("No user selected", "danger");
                    } else {
                        Enviropment::redirectBack("Не выбран пользователь", "danger");
                    }
                }
            }
        }

        // это тоже работает только без AJAX - а
        $bpToRemove = null;
        $bpm = new BasketProductManager();
        if ($productId) {
            $bpToRemove = $bpm->getLinkByUserIdAndProductId($user->id, $productId);
            if (!$bpToRemove) {
                if ($this->lang == 'en') {
                    Enviropment::redirect("basket", "No replacement item found", "danger");
                } else {
                    Enviropment::redirect("basket", "Не найден заменяемый товар", "danger");
                }
            }
        }

        // добавление в корзину билета
        if ($ticket) {
            // проверить может уже есть данный ticket у человека
            if ($user->baseTicketId) {
                // ticketdecision - страница с выбором: заменить имеющийся у меня в корзине билет на выбранный (здесь
                // два варианта: оплаченный билет и не оплаченный билет), оформить билет на другое лицо.
                if ($child) {
                    if ($isAjax) {
                        echo json_encode("go_basket_child_{$child->id}");
                        exit;
                    } else {
                        if ($this->lang == 'en') {
                            Enviropment::redirect("basket", "You already have ticket for " . Utility::mobilephone($child->phone) . " " . $child->lastname . " " . $child->name, "danger");
                        } else {
                            Enviropment::redirect("basket", "У Вас уже есть билет для " . Utility::mobilephone($child->phone) . " " . $child->lastname . " " . $child->name, "danger");
                        }
                    }
                } else {
                    if ($isAjax) {
                        echo json_encode("go_ticketdecision_{$ticket}");
                        exit;
                    } else {
                        if ($this->lang == 'en') {
                            Enviropment::redirect("ticketdecision?ticket={$ticket}", "You already have ticket", "danger");
                        } else {
                            Enviropment::redirect("ticketdecision?ticket={$ticket}", "У Вас уже есть билет", "danger");
                        }
                    }
                }
            } else {
                $user->baseTicketId = $ticket;
                $user->tsTicketAdd = time();
                $user = $um->save($user);
                UserManager::updateUser4App($user);

                // перезагрузить сессию с актором или child
                if ($child) {
                    if ($child->id == $this->actor->id) {
                        Context::clearObject("__child");
                        Context::setObject("__child", $user);
                    }
                } else {
                    if ($user->id == $this->actor->id) {
                        Context::clearObject("__user");
                        Context::setObject("__user", $user);
                    }
                }

                // в корзину добавить надо
                // основной билет
                $bObj = new Basket();
                if ($child || $mode == "newuser" || $mode == "existuser") {
                    $bObj->userId = $currentUser->id;
                    $bObj->childId = $user->id;
                } else {
                    $bObj->userId = $user->id;
                }

                $bObj->tsCreated = time();
                $bObj->baseTicketId = $ticketObj->id;
                $bObj->baseTicketName = $ticketObj->name;
                $bObj->baseTicketName_en = $ticketObj->name_en;
                $bObj->baseTicketStatus = $ticketObj->status;
                $bObj->needAmount = $ticketObj->price;

                $remObj = new RealEmailManager();
                $realUser = $remObj->getByEmail($user->email);

                if ( is_array($realUser) ) {
                    switch ($ticketObj->id) {
                        case 2: // Шефский
                            $bObj->needAmount = 25000;
                            break;
                        case 3: // Профи
                            $bObj->needAmount = 30000;
                            break;
                        case 4: // Barstreet
                            $bObj->needAmount = 15000;
                            break;
                        case 10: // Pizza Street
                            $bObj->needAmount = 15000;
                            break;
                        case 8: // Ребро
                            $bObj->needAmount = 50000;
                            break;
                        case 5: // Как король
                            $bObj->needAmount = 170000;
                            break;
                    }
                }

                $bObj->status = Basket::STATUS_NEW;
                $bObj = $bm->save($bObj);
                // пересчёт корзины
                $bm->startTransaction();
                try {
                    $bm->rebuildBasket($bObj->userId);
                } catch (Exception $e) {
                    $bm->rollbackTransaction();
                    Logger::error($e);
                    if ($isAjax) {
                        echo json_encode("err_rebuild");
                        exit;
                    } else {
                        Enviropment::redirectBack(Enviropment::ERROR_MSG . "(1)");
                    }
                }
                $bm->commitTransaction();
            }
        }

        // добавление в корзину мастер-класса
        if ($product) {
            /*if ($user->baseTicketId == 1) { // Если билет турист, то ограничим покупку все МК кроме POP-UP
                $productObj = $pm->getById($product);
                if ($productObj->areaId <> 4) {
                    if ($isAjax) {
                        $data = ["cannot_buy_product", $um->getBacketCount($this->actor)];
                        echo json_encode($data);
                        exit;
                    } else {
                        if ($this->lang == 'en') {
                            Enviropment::redirectBack("You can not buy this product");
                        } else {
                            Enviropment::redirectBack("Вы не можете купить данный билет");
                        }
                    }
                }
            }*/

            // проверить может уже есть данный product у человека, если есть, то нельзя купить его, даже на друге лицо
            if ($user->parentUserId) {
                $sameProduct = $bpm->getLinkByChildIdAndProductId($user->id, $product);
            } else {
                $sameProduct = $bpm->getLinkByUserIdAndProductIdNoChildren($user->id, $product);
            }

            $sameProductCurrent = null;
            if (isset($currentUser) && $currentUser) {
                if ($user->parentUserId) {
                    $sameProductCurrent = $bpm->getLinkByChildIdAndProductId($currentUser->id, $product);
                } else {
                    $sameProductCurrent = $bpm->getLinkByUserIdAndProductIdNoChildren($currentUser->id, $product);
                }
            }

            if (($productId != $product && $sameProduct) || (($mode == "newuser" || $mode == "existuser") && $productId != $product && $sameProductCurrent)) {
                if (!$this->app) {
                    $bpmObj = $bpm->getById($sameProduct->id);
                    if (!$bpmObj) {
                        if ($this->lang == 'en') {
                            Enviropment::redirectBack("No ticket selected!");
                        } else {
                            Enviropment::redirectBack("Не выбран билет!");
                        }
                    }

                    $isActorReady = false;
                    if (($extuser && $bpmObj->userId == $user->parentUserId) || (!$extuser && $bpmObj->userId == $user->id)) {
                        $isActorReady = true;
                    }

                    if ($isActorReady && $bpmObj->status == Basket::STATUS_NEW) {
                        // запишем в лог, что пользователь удалил МК
                        Logger::info("USER DEL PRODUCT BASKET: " . $bpmObj->id . ", userId: " . $bpmObj->userId . ", childId: " . $bpmObj->childId);
                        Logger::info($bpmObj);

                        $bpm->remove($bpmObj->id);
                        $bm = new BasketManager();
                        $bm->startTransaction();
                        try {
                            $bm->rebuildBasket($user->id);
                            if ($user->parentUserId && $user->parentUserId != $user->id) {
                                $bm->rebuildBasket($user->parentUserId);
                            }
                        } catch (Exception $e) {
                            $bm->rollbackTransaction();
                            Logger::error($e);
                            Enviropment::redirectBack(Enviropment::ERROR_MSG . "(4)");
                        }
                        $bm->commitTransaction();
                        if ($isAjax) {
                            $data = ["ticket_deleted", $um->getBacketCount($this->actor)];
                            echo json_encode($data);
                            exit;
                        } else {
                            if ($this->lang == 'en') {
                                Enviropment::redirectBack("Ticket removed");
                            } else {
                                Enviropment::redirectBack("Билет был удален");
                            }
                        }
                    } else {
                        if ($isAjax) {
                            $data = ["ticket_donot_deleted", $um->getBacketCount($this->actor)];
                            echo json_encode($data);
                            exit;
                        } else {
                            if ($this->lang == 'en') {
                                Enviropment::redirectBack("You cannot delete this ticket");
                            } else {
                                Enviropment::redirectBack("Данный билет нельзя удалить");
                            }
                        }
                    }
                }
            }

            // если нет основного билета, нельзя купить мастер-класс
            // что в корзине по основному билету
            if ($child || $mode == "newuser" || $mode == "existuser") {
                $tickets = $bm->getTicketsByChildId($user->id);
                if (!count($tickets)) {
                    if ($isAjax) {
                        echo json_encode("need_baseticket");
                        exit;
                    } else {
                        if ($this->lang == 'en') {
                            Enviropment::redirectBack("Please purchase the basic ticket first", "danger");
                        } else {
                            Enviropment::redirectBack("Сначала нужно купить основной билет", "danger");
                        }
                    }
                }
            } else {
                if ($child) {
                    $tickets = $bm->getTicketsByChildId($child->id);
                } else {
                    $tickets = $bm->getTicketsByUserId($user->id);
                }
                if (!count($tickets)) {
                    if ($isAjax) {
                        echo json_encode("need_baseticket");
                        exit;
                    } else {
                        if ($this->lang == 'en') {
                            Enviropment::redirectBack("Please purchase the basic ticket first", "danger");
                        } else {
                            Enviropment::redirectBack("Сначала нужно купить основной билет", "danger");
                        }
                    }
                }
            }

            // не входит ли выбранный product в уже купленный билет
            $productIsIncluded = false;
            $ttplm = new TicketToProductLinkManager();
            if ($user->baseTicketId) {
                $checkTtplm = $ttplm->checkByBaseTicketIdAndProductId($user->baseTicketId, $product);
                if (count($checkTtplm)) {
                    $productIsIncluded = true;
                }
            }
            if ($productIsIncluded) {
                if ($isAjax) {
                    echo json_encode("product_is_included_to_ticket");
                    exit;
                } else {
                    if ($this->lang == 'en') {
                        Enviropment::redirectBack("The selected item is included into the basic ticket", "danger");
                    } else {
                        Enviropment::redirectBack("Выбранный товар уже входит в основной билет", "danger");
                    }
                }
            }

            // Ещё проверка поднять время, которое уже занято мастер-классами,
            // проверить не попадает ли время выбранного мастер-класса в занятое время (это не сложно по ts-м).
            // если время уже занято, то перекинуть на страницу productdecision
            // там, на странице productdecision дать выбор: Отменить, Продолжить (т.е. всё равно купить) или
            // Оформить мастеркласс на другое лицо.
            // Реализация:
            // поднять уже купленные продукты в статусе Активен
            if ($user->parentUserId) {
                $userBasketProducts = $bpm->getByChildId($user->id);
            } else {
                // при добавлении ...
                $userBasketProducts = $bpm->getByUserIdNoChildren($user->id);
            }

            $userIsReadyToGo = true;
            $userProductIds = array();
            if (is_array($userBasketProducts) && count($userBasketProducts)) {
                foreach ($userBasketProducts AS $userBasketProduct) {
                    $userProductIds[] = $userBasketProduct->productId;
                }
            }

            $userProducts = null;
            if (is_array($userProductIds) && count($userProductIds)) {
                $userProducts = $pm->getByIds($userProductIds);
            }

            if (is_array($userProducts) && count($userProducts)) {
                foreach ($userProducts AS $userProduct) {
                    /*if ((   // 15-30                          15-30                         15-30                     16-30
                            ($userProduct->eventTsStart >= $productObj->eventTsStart && $userProduct->eventTsStart <= $productObj->eventTsFinish) || 
                            ($userProduct->eventTsStart <= $productObj->eventTsStart && $userProduct->eventTsFinish >= $productObj->eventTsFinish) || 
                            // 18-30                          15-30                         18-30                       16-30
                            ($userProduct->eventTsFinish >= $productObj->eventTsStart && $userProduct->eventTsFinish <= $productObj->eventTsFinish)
                        ) && $userProduct->id != $productId) {
                        $userIsReadyToGo = false;
                    }*/
                    // Признак пересечения
                    // (start1-end2)*(start2-end1)>0
                    if (( ($userProduct->eventTsStart - $productObj->eventTsFinish)*($productObj->eventTsStart - $userProduct->eventTsFinish)>0 ) && $userProduct->id != $productId) {
                        $userIsReadyToGo = false;
                    }
                }
            }
            // но если время нового товара перекрывается удаляемым, то надо опять включить в список
            if (!$userIsReadyToGo && $bpToRemove && (($bpToRemove->eventTsStart > $productObj->eventTsStart && $bpToRemove->eventTsStart <= $productObj->eventTsFinish) || ($bpToRemove->eventTsFinish > $productObj->eventTsStart && $bpToRemove->eventTsFinish <= $productObj->eventTsFinish))) {
                $userIsReadyToGo = true;
            }
            // купить несмотря ни на что
            if ($mode == "force") {
                $userIsReadyToGo = true;
            }

            // отладка
            // $userIsReadyToGo = true;

            if (!$userIsReadyToGo) {
                if ($child || $mode == "newuser" || $mode == "existuser") {
                    if ($isAjax) {
                        echo json_encode("same_time_used_child");
                        exit;
                    } else {
                        if ($this->lang == 'en') {
                            Enviropment::redirectBack("This participant has a planned event for the same time", "danger");
                        } else {
                            Enviropment::redirectBack("У данного участника уже есть запланированное событие на то же самое время", "danger");
                        }
                    }
                } else {
                    if (!$this->app) {
                        if ($isAjax) {
                            echo json_encode("same_time_used_productdecision_{$product}");
                            exit;
                        } else {
                            if ($this->lang == 'en') {
                                Enviropment::redirect("productdecision&product={$product}", "There already is a planned event for the same time", "danger");
                            } else {
                                Enviropment::redirect("productdecision&product={$product}", "Уже есть запланированное событие на то же самое время", "danger");
                            }
                        }
                    }
                }
            } else {
                // ок, можно покупать
                $bpObj = new BasketProduct();
                if ($child || $mode == "newuser" || $mode == "existuser") {
                    $bpObj->userId = $currentUser->id;
                    $bpObj->childId = $user->id;
                } else {
                    $bpObj->userId = $user->id;
                }
                $bpObj->tsCreated = time();
                $bpObj->productId = $productObj->id;
                $bpObj->productName = strip_tags(htmlspecialchars_decode($productObj->name, ENT_NOQUOTES));
                $bpObj->productStatus = $productObj->status;
                // время начала и конца
                $bpObj->eventTsStart = $productObj->eventTsStart;
                $bpObj->eventTsFinish = $productObj->eventTsFinish;
                $bpObj->needAmount = $productObj->price;

                // если указан товар на замену
                if ($bpToRemove) {
                    $bpObj->status = $bpToRemove->status;
                    $bpObj->payAmount = $bpToRemove->payAmount;
                    $bpObj->discountAmount = $bpToRemove->discountAmount;
                    $bpObj->returnedAmount = $bpToRemove->returnedAmount;
                    $bpObj->ulAmount = $bpToRemove->ulAmount;
                    $bpObj->status = $bpToRemove->status;
                } else {
                    $bpObj->status = BasketProduct::STATUS_NEW;
                }

                // сохраняем новый
                $bpObj = $bpm->save($bpObj);

                // удаляем старый
                if ($bpToRemove) {
                    $bpm->remove($bpToRemove->id);
                }

                $bm->startTransaction();
                try {
                    $bm->rebuildBasket($bpObj->userId);
                } catch (Exception $e) {
                    $bm->rollbackTransaction();
                    Logger::error($e);
                    Enviropment::redirectBack(Enviropment::ERROR_MSG . "(2)");
                }
                $bm->commitTransaction();
            }
        }

        if ($bpToRemove) {
            if ($this->lang == 'en') {
                Enviropment::redirect("basket", "Replacement has been made", "success");
            } else {
                Enviropment::redirect("basket", "Замена произведена", "success");
            }
        } else {
            if ($mode == "force" || $mode == "newuser" || $mode == "existuser") {
                if ($isAjax) {
                    if ($bObj) {
                        $data = ["go_back_ok", $um->getBacketCount($this->actor), $bObj->id, $bObj->baseTicketName];
                    } else {
                        $data = ["product_ok", $um->getBacketCount($this->actor)];
                    }
                    echo json_encode($data);
                    exit;
                } else {
                    if ($this->lang == 'en') {
                        Enviropment::redirect("basket", "Item added to the basket <nobr>" . Utility::mobilephone($user->phone) . "</nobr> " . $user->lastname . " " . $user->name, "success");
                    } else {
                        Enviropment::redirect("basket", "Товар добавлен в корзину участника <nobr>" . Utility::mobilephone($user->phone) . "</nobr> " . $user->lastname . " " . $user->name, "success");
                    }
                }
            } else {
                if ($isAjax) {
                    $um = new UserManager();
                    if ($bObj) {
                        $data = ["go_back_ok", $um->getBacketCount($this->actor), $bObj->id, $bObj->baseTicketName];
                    } else {
                        $data = ["product_ok", $um->getBacketCount($this->actor)];
                    }
                    echo json_encode($data);
                    exit;
                } else {
                    if ($this->lang == 'en') {
                        Enviropment::redirect("basket", "Item added to the basket <nobr>" . Utility::mobilephone($user->phone) . "</nobr> " . $user->lastname . " " . $user->name, "success");
                    } else {
                        Enviropment::redirect("basket", "Товар добавлен в корзину участника <nobr>" . Utility::mobilephone($user->phone) . "</nobr> " . $user->lastname . " " . $user->name, "success");
                    }
                }
            }
        }
    }
}