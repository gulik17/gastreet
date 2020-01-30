<?php

/**
 *
 */
class DelTicketAction extends AuthorizedUserAction implements IPublicAction {
    public function execute() {
        // проверить заполнен ли профайл пользователя
        UserManager::redirectIfNoProfile($this->actor);

        $parentObj = null;
        $um = new UserManager();
        if ($this->actor->parentUserId) {
            $parentObj = $um->getById($this->actor->parentUserId);
        }

        $child = Context::getObject("__child");
        if ($child) {
            $user = $child;
        } else if ($parentObj) {
            $user = $parentObj;
        } else {
            $user = $this->actor;
        }

        $id = Request::getInt("id");
        $isAjax = Request::getInt("isAjax");
        if (!$id) {
            if ($isAjax) {
                $array['error'] = 2;
                if ($this->lang == 'en') {
                    $array['msg'] = 'No ticket selected!';
                } else {
                    $array['msg'] = 'Не выбран билет!';
                }
                echo json_encode($array);
                exit;
            }
            if ($this->lang == 'en') {
                Enviropment::redirectBack("No ticket selected!", "danger");
            } else {
                Enviropment::redirectBack("Не выбран билет!", "danger");
            }
        }

        $bm = new BasketManager();
        $bmObj = $bm->getById($id);
        if (!$bmObj) {
            if ($isAjax) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = 'No ticket found!';
                } else {
                    $array['msg'] = 'Не найдет билет!'.$id;
                }
                echo json_encode($array);
                exit;
            }
            if ($this->lang == 'en') {
                Enviropment::redirectBack("No ticket selected!", "danger");
            } else {
                Enviropment::redirectBack("Не выбран билет!", "danger");
            }
        }

        $checkProductsUserId = $bmObj->userId;
        $checkProductsChildId = $bmObj->childId;

        $newbpmList = null;
        $newbpm = new BasketProductManager();
        if ($checkProductsUserId && $checkProductsChildId) {
            $newbpmList = $newbpm->getByUserIdAndChildId($checkProductsUserId, $checkProductsChildId);
        } else if ($checkProductsUserId) {
            $newbpmList = $newbpm->getByUserIdNoChildren($checkProductsUserId);
        }

        if (is_array($newbpmList) && count($newbpmList)) {
            if ($isAjax) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = 'Ticket deletion impossible, please first delete all items for this user!';
                } else {
                    $array['msg'] = 'Нельзя удалить билет, сначала нужно удалить все товары по данному пользователю!';
                }
                echo json_encode($array);
                exit;
            }
            if ($this->lang == 'en') {
                Enviropment::redirectBack("Ticket deletion impossible, please first delete all items for this user!", "danger");
            } else {
                Enviropment::redirectBack("Нельзя удалить билет, сначала нужно удалить все товары по данному пользователю!", "danger");
            }
        }

        /*
        if ($child) {
          echo "child<br/>";
        } else {
          echo "NO child<br/>";
        }

        print_r($bmObj);
        print_r($user); */

        $isActorReady = false;
        if (($child && $bmObj->userId == $user->parentUserId) || (!$child && $bmObj->userId == $user->id)) {
            // echo "isActorReady<br/>";
            $isActorReady = true;
        }

        if ($isActorReady && $bmObj->status == Basket::STATUS_NEW) {
            // запишив в лог, что пользователь удалил билет
            Logger::info("USER DEL BASKET: " . $bmObj->id . ", userId: " . $bmObj->userId . ", childId: " . $bmObj->childId);
            Logger::info($bmObj);

            $bm->remove($bmObj->id);
            $um = new UserManager();
            if ($child) {
                if ($bmObj->childId == $user->id) {
                    $userObj = $um->getById($user->id);
                    $userObj->baseTicketId = null;
                    $userObj->tsTicketAdd = null;
                    $userObj = $um->save($userObj);
                    // обновим сессию
                    Context::clearObject("__child");
                    Context::setObject("__child", $userObj);
                } else {
                    if ($bmObj->childId) {
                        $userObj = $um->getById($bmObj->childId);
                        $userObj->baseTicketId = null;
                        $userObj->tsTicketAdd = null;
                        $userObj = $um->save($userObj);
                    } else {
                        $userObj = $um->getById($bmObj->userId);
                        $userObj->baseTicketId = null;
                        $userObj->tsTicketAdd = null;
                        $userObj = $um->save($userObj);
                    }
                }
            } else {
                if ($bmObj->childId) {
                    $userObj = $um->getById($bmObj->childId);
                    $userObj->baseTicketId = null;
                    $userObj->tsTicketAdd = null;
                    $userObj = $um->save($userObj);
                } else {
                    $userObj = $um->getById($user->id);
                    $userObj->baseTicketId = null;
                    $userObj->tsTicketAdd = null;
                    $userObj = $um->save($userObj);
                }
                // обновим сессию
                //if ($user->id == $this->actor->id) {
                 //   Context::clearObject("__user");
                 //   Context::setObject("__user", $userObj);
                //}
            }
            UserManager::updateUser4App($userObj);

            $bm->startTransaction();
            try {
                $bm->rebuildBasket($user->id);
            } catch (Exception $e) {
                $bm->rollbackTransaction();
                Logger::error($e);
                if ($isAjax) {
                    $array['error'] = 1;
                    if ($this->lang == 'en') {
                        $array['msg'] = Enviropment::ERROR_MSG_EN . "(3)";
                    } else {
                        $array['msg'] = Enviropment::ERROR_MSG . "(3)";
                    }
                    echo json_encode($array);
                    exit;
                }
                if ($this->lang == 'en') {
                    Enviropment::redirectBack(Enviropment::ERROR_MSG_EN . "(3)");
                } else {
                    Enviropment::redirectBack(Enviropment::ERROR_MSG . "(3)");
                }
            }
            $bm->commitTransaction();

            if ($isAjax) {
                $array['error'] = 0;
                if ($this->lang == 'en') {
                    $array['msg'] = 'Ticket removed';
                } else {
                    $array['msg'] = 'Билет был удален';
                }
                echo json_encode($array);
                exit;
            }
            
            if ($this->lang == 'en') {
                Enviropment::redirectBack("Ticket removed", "success");
            } else {
                Enviropment::redirectBack("Билет был удален", "success");
            }
        } else {
            if ($isAjax) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = 'You cannot delete this ticket';
                } else {
                    $array['msg'] = 'Данный билет нельзя удалить';
                }
                echo json_encode($array);
                exit;
            }
            if ($this->lang == 'en') {
                Enviropment::redirectBack("You cannot delete this ticket", "danger");
            } else {
                Enviropment::redirectBack("Данный билет нельзя удалить", "danger");
            }
        }
    }
}