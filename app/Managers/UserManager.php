<?php

/**
 * Класс для управления пользователями
 * 
 */
class UserManager extends BaseEntityManager {
    const MODE_CREATE = 'MODE_CREATE';
    const MODE_UPDATE = 'MODE_UPDATE';

    public function getByParentId($parentId) {
        $parentId = intval($parentId);
        return $this->get(new SQLCondition("parentUserId = {$parentId}"));
    }

    public function getAllWithBaseTicket() {
        return $this->get(new SQLCondition("baseTicketId IS NOT NULL OR baseTicketId > 0"));
    }

    public function getNextNUsers($n = 20, $fromId = 0, $tsStart = 0, $tsFinish = 0) {
        $fromId = intval($fromId);
        $condition = "id > {$fromId}";
        if ($tsStart) {
            $condition .= " AND tsCreated >= {$tsStart} ";
        }
        if ($tsFinish) {
            $condition .= " AND tsCreated <= {$tsFinish} ";
        }
        $sql = new SQLCondition($condition);
        $sql->offset = 0;
        $sql->rows = $n;
        $sql->orderBy = "id";
        return $this->get($sql);
    }

    public function getByUserIdAndChildId($userId, $childId) {
        $userId = intval($userId);
        $childId = intval($childId);
        return $this->getOne(new SQLCondition("id = {$childId} AND parentUserId = {$userId}"));
    }

    public function getByPhone($phone) {
        return $this->getOne(new SQLCondition("phone = '{$phone}'"));
    }

    public function getByPhoneAndCode($phone, $code) {
        return $this->getOne(new SQLCondition("phone = '{$phone}' AND code = '{$code}'"));
    }

    public function getUsersByEmail($email) {
        return $this->get(new SQLCondition("email = '{$email}'"));
    }

    public function getByEmail($email) {
        $result = $this->getUsersByEmail($email);
        return (isset($result[0]) ? $result[0] : false);
    }

    public function getUsersByConfirmedEmail($confirmedEmail) {
        return $this->get(new SQLCondition("confirmedEmail = '{$confirmedEmail}'"));
    }

    public function getByConfirmedEmail($confirmedEmail) {
        $result = $this->getUsersByConfirmedEmail($confirmedEmail);
        return (isset($result[0]) ? $result[0] : false);
    }

    /**
     * Функция добавления нового пользователя
     * 
     * @param string $phone Телефон юзера
     * @param string $youAboutUs От куда узнали о нас
     * @param integer $code Код из смс
     * @param string $lang Язык пользователя
     * 
     * @return void
     * 
     */
    public static function add($phone, $youAboutUs, $code, $lang = 'ru') {
        $um = new UserManager();
        $userObj = new User();
        $userObj->status = User::STATUS_NEW;
        $userObj->type = User::TYPE_USER;
        $userObj->phone = $phone;
        $userObj->youAboutUs = $youAboutUs;
        $userObj->code = $code;
        $userObj->lang = $lang;
        $userObj->tsCreated = time();
        if (isset($_SESSION["utm"])) {
            $userObj->utm = $_SESSION["utm"];
        }
        $userObj = $um->save($userObj);
        $userObj->disableBroadcastKey = md5($userObj->id . $userObj->tsCreated);
        $userObj = $um->save($userObj);
        return $userObj;
    }

    private static function sendOneEmail($email, $userId, $shortTitle, $message, $template, $vars, $attachFullPathFileName = null, $attachFileName = null) {
        $header = Enviropment::prepareForMail(MailTextHelper::parse("header.html", $vars));
        $footer = Enviropment::prepareForMail(MailTextHelper::parse("footer.html", $vars));
        // сохранить в лог
        $mlm = new MessageLogManager();
        $mlmObj = new MessageLog();
        if ($template) {
            $mlmObj->broadcastTemplateId = $template->id;
        }
        $mlmObj->userId = $userId;
        $mlmObj->email = $email;
        $mlmObj->message = $message;
        $mlmObj->status = MessageLog::STATUS_NEW;
        $mlmObj->tsCreate = time();
        $mlmObj = $mlm->save($mlmObj);

        $fromEmail = Configurator::get("mail:from");
        $fromName = Configurator::get("mail:fromName");

        require_once APPLICATION_DIR . "/Lib/Swift/Mail.php";
        $countSent = Mail::send($shortTitle, $header . $message . $footer, $email, $fromEmail, $fromName, $attachFullPathFileName, $attachFileName);

        // отметить в логе
        if ($countSent) {
            $mlmObj->status = MessageLog::STATUS_SENT;
            $mlmObj->tsSent = time();
            $mlmObj = $mlm->save($mlmObj);
        }
        return $countSent;
    }

    private static function sendOneSms($phone, $userId, $message, $template) {
        // сохранить в лог
        $mlm = new MessageLogManager();
        $mlmObj = new MessageLog();
        $mlmObj->broadcastTemplateId = $template->id;
        $mlmObj->userId = $userId;
        $mlmObj->phone = $phone;
        $mlmObj->message = $message;
        $mlmObj->status = MessageLog::STATUS_NEW;
        $mlmObj->tsCreate = time();
        $mlmObj = $mlm->save($mlmObj);
        // отправить собранное сообщение через СМС
        $isSent = Utility::sendSms($phone, $message);
        // отметить в логе
        if ($isSent) {
            $mlmObj->status = MessageLog::STATUS_SENT;
            $mlmObj->tsSent = time();
            $mlmObj = $mlm->save($mlmObj);
        }
        return $isSent;
    }

    public static function sendNotifyOldBasketEmail($email, $userId) {
        // хэш для автологина
        $um = new UserManager();
        $user = $um->getById($userId);
        $loginHash = substr($user->disableBroadcastKey, 10, 10);

        // список неоплаченных билетов, которые лежат у пользователя в корзине
        $bm = new BasketManager();
        $unPayedTickets = array();
        $tickets = ($user->parentUserId) ? $bm->getTicketsByChildId($user->id) : $bm->getTicketsByUserIdNoChildren($user->id);
        if (count($tickets)) {
            foreach ($tickets AS $oneTicket) {
                if ($oneTicket['status'] == Basket::STATUS_NEW) {
                    $unPayedTickets[] = $oneTicket;
                }
            }
        }

        $bpm = new BasketProductManager();
        $unPayedProducts = array();
        $products = ($user->parentUserId) ? $bpm->getProductsByChildId($user->id) : $bpm->getProductsByUserIdNoChildren($user->id);
        if (count($products)) {
            foreach ($products AS $oneProduct) {
                if ($oneProduct['status'] == BasketProduct::STATUS_NEW) {
                    $unPayedProducts[] = $oneProduct;
                }
            }
        }

        $unpayedBasket = '';
        if (count($unPayedTickets) || count($unPayedProducts)) {
            $unpayedBasket = "В Вашей корзине есть не оплаченные товары:"."\r\n";
        }

        // собираем товары в строки
        if (count($unPayedTickets)) {
            foreach ($unPayedTickets AS $oneTicket) {
                $ticketPrice = $oneTicket['needAmount'] - $oneTicket['payAmount'] - $oneTicket['discountAmount'] + $oneTicket['returnedAmount'] - $oneTicket['ulAmount'];
                $unpayedBasket .= $oneTicket['baseTicketName'] . " - " . $ticketPrice . " руб."."\r\n";
            }
        }

        if (count($unPayedProducts)) {
            foreach ($unPayedProducts AS $oneProduct) {
                $productPrice = $oneProduct['needAmount'] - $oneProduct['payAmount'] - $oneProduct['discountAmount'] + $oneProduct['returnedAmount'] - $oneProduct['ulAmount'];
                $unpayedBasket .= $oneProduct['productName'] . " - " . $productPrice . " руб."."\r\n";
            }
        }

        if (count($unPayedTickets) || count($unPayedProducts)) {
            $unpayedBasket .= "\r\n";
        }

        $host = Configurator::get('application:protocol') . Utility::getSurrentHost();
        $confirmLink = $host . "/index.php?do=userbasket&code=" . $loginHash;

        // формирование письма по шаблону
        $isSent = false;
        $btm = new BroadcastTemplateManager();
        $template = $btm->getBySendAndTriggerType(BroadcastTemplate::SEND_TYPE_EMAIL, BroadcastTemplate::TRIGGER_TYPE_NOTIFY_OLD_BASKET);
        if ($template) {
            $vars = array(
                "SIGNATURE" => Configurator::get("mail:sign"),
                "LOGIN_LINK" => $confirmLink, // для автологина в корзину
                "UNPAYED_BASKET" => $unpayedBasket,
            );

            $shortTitle = BroadcastTemplate::getTriggerTypeDesc(BroadcastTemplate::TRIGGER_TYPE_NOTIFY_OLD_BASKET);
            $message = Enviropment::prepareForMail(MailTextHelper::parseContent(str_replace("&quot;", '"', htmlspecialchars_decode($template->message, ENT_NOQUOTES)), $vars));
            $isSent = self::sendOneEmail($email, $userId, $shortTitle, $message, $template, $vars);
        }
        return $isSent;
    }

    public static function sendNotifyOldBookingEmail($email, $userId) {
        $isSent = false;
        $btm = new BroadcastTemplateManager();
        $template = $btm->getBySendAndTriggerType(BroadcastTemplate::SEND_TYPE_EMAIL, BroadcastTemplate::TRIGGER_TYPE_NOTIFY_OLD_BOOKING);
        if ($template) {
            $vars = array(
                "SIGNATURE" => Configurator::get("mail:sign"),
            );

            $shortTitle = BroadcastTemplate::getTriggerTypeDesc(BroadcastTemplate::TRIGGER_TYPE_NOTIFY_OLD_BOOKING);
            $message = Enviropment::prepareForMail(MailTextHelper::parseContent(str_replace("&quot;", '"', htmlspecialchars_decode($template->message, ENT_NOQUOTES)), $vars));
            $isSent = self::sendOneEmail($email, $userId, $shortTitle, $message, $template, $vars);
        }
        return $isSent;
    }

    public static function sendRemoveOldBasketEmail($email, $userId) {
        $isSent = false;
        $btm = new BroadcastTemplateManager();
        $template = $btm->getBySendAndTriggerType(BroadcastTemplate::SEND_TYPE_EMAIL, BroadcastTemplate::TRIGGER_TYPE_REMOVE_OLD_BASKET);
        if ($template) {
            $vars = array(
                "SIGNATURE" => Configurator::get("mail:sign"),
            );

            $shortTitle = BroadcastTemplate::getTriggerTypeDesc(BroadcastTemplate::TRIGGER_TYPE_REMOVE_OLD_BASKET);
            $message = Enviropment::prepareForMail(MailTextHelper::parseContent(str_replace("&quot;", '"', htmlspecialchars_decode($template->message, ENT_NOQUOTES)), $vars));
            $isSent = self::sendOneEmail($email, $userId, $shortTitle, $message, $template, $vars);
        }
        return $isSent;
    }
    
    public static function sendWithoutTicketUserEmail($email, $userId) {
        $isSent = false;
        $btm = new BroadcastTemplateManager();
        $template = $btm->getBySendAndTriggerType(BroadcastTemplate::SEND_TYPE_EMAIL, BroadcastTemplate::TRIGGER_TYPE_WITHOUT_TICKET_USER);
        if ($template) {
            $vars = array(
                "SIGNATURE" => Configurator::get("mail:sign"),
            );

            $shortTitle = BroadcastTemplate::getTriggerTypeDesc(BroadcastTemplate::TRIGGER_TYPE_WITHOUT_TICKET_USER);
            $message = Enviropment::prepareForMail(MailTextHelper::parseContent(str_replace("&quot;", '"', htmlspecialchars_decode($template->message, ENT_NOQUOTES)), $vars));
            $isSent = self::sendOneEmail($email, $userId, $shortTitle, $message, $template, $vars);
        }
        return $isSent;
    }

    public static function sendConfirmDoneEmail($email, $userId) {
        $isSent = false;
        $btm = new BroadcastTemplateManager();
        $template = $btm->getBySendAndTriggerType(BroadcastTemplate::SEND_TYPE_EMAIL, BroadcastTemplate::TRIGGER_TYPE_EMAIL_CONFIRM_SUCCESS);
        if ($template) {
            $vars = array(
                "SIGNATURE" => Configurator::get("mail:sign"),
            );

            $shortTitle = BroadcastTemplate::getTriggerTypeDesc(BroadcastTemplate::TRIGGER_TYPE_EMAIL_CONFIRM_SUCCESS);
            $message = Enviropment::prepareForMail(MailTextHelper::parseContent(str_replace("&quot;", '"', htmlspecialchars_decode($template->message, ENT_NOQUOTES)), $vars));
            $isSent = self::sendOneEmail($email, $userId, $shortTitle, $message, $template, $vars);
        }
        return $isSent;
    }
    
    // отправить запрос на подтверждение e-mail
    public static function sendNotifyRebro($email, $userId) {
        $isSent = false;
        $um = new UserManager();
        $user = $um->getById($userId);
        if ($user->wantRebro != 1) {
            $btm = new BaseTicketManager();
            $ticket = $btm->getById(8);
            $ticket->description = $ticket->description + 1;
            $ticket = $btm->save($ticket);
            $shortTitle = "Уведомление ReBro";
            $template = "Привет!<br>"
                    . "Этот пользователь хочет билет ReBro<br>"
                    . $user->lastname." ".$user->name."<br>"
                    . "Город: ".$user->cityName."<br>"
                    . "Компания: ".$user->company."<br>"
                    . "Должность: ".$user->position."<br>"
                    . "Телефон: ".$user->phone."<br>"
                    . "Мыло: ".$user->email;

            $isSent = self::sendOneEmail($email, $userId, $shortTitle, $template, null, null);
            $isSent = self::sendOneEmail('ticket@gastreet.com', $userId, $shortTitle, $template, null, null);

            //$message = "Заявка на ReBro принята, ответ после 21 января";

            // отправить собранное сообщение через СМС
            //$isSentSMS = Utility::sendSms($user->phone, $message);

            $user->wantRebro = 1;
            $user = $um->save($user);
            return $isSent;
        } else {
            return 'allReadyHave';
        }
    }
    
    // отправить запрос на подтверждение e-mail
    public static function sendNotifyMemory($email, $userId) {
        $isSent = false;
        $um = new UserManager();
        $user = $um->getById($userId);

        $shortTitle = "Новый отзыв на сайте GASTREET";
        $template = "Привет!<br>"
                . "Этот пользователь добавил отзыв и ему нужна модерация<br>"
                . $user->lastname." ".$user->name."<br>"
                . "Город: ".$user->cityName."<br>"
                . "Компания: ".$user->company."<br>"
                . "Должность: ".$user->position."<br>"
                . "Телефон: ".$user->phone."<br>"
                . "Мыло: ".$user->email;

        $isSent = self::sendOneEmail($email, $userId, $shortTitle, $template, null, null);
        return $isSent;
    }
    
    public static function updateUser4App($user) {
        $mes = '';
        $baseTicketId = [];
        if ($user->baseTicketId !== null && $user->baseTicketId > 0) {
            $baseTicketId[] = $user->baseTicketId;
        }
        $eventicious = new Eventicious();
        $eventicious->setHost(Configurator::get("eventicious:host"));
        $eventicious->setCode(Configurator::get("eventicious:code"));

        // Т.к. инфу о наличии записи получить нет возможности, пробуем отредактировать
        $result = $eventicious->speakersUpdate(
                $user->id,
                $user->name,
                $user->lastname,
                htmlspecialchars_decode($user->company, ENT_NOQUOTES),
                $user->position,
                $user->cityName,
                '',      // ВК
                '',      // Твиттер
                '',      // ФБ
                '',      // О себе
                'ru-RU', // Язык на котором редактируется запись
                $baseTicketId); // ID билета (группа)
        // Проверяем код ответа сервера на запрос редактирования записи
        if ($result['result_code'] == 200) {
            $mes .= "Eventicious: ID $user->id Отредактирован<br>";
        }

        // Если редактируемая запись не была найдена, сервер приложения вернет код 404 (НО ЭТОТ ПИДР КАКОГО ТО ХУЯ ВОРАЧИВАЕТ 400)
        if ($result['result_code'] == 400) {
            // Создаем запись
            $result = $eventicious->speakersCreate(
                    $user->id,       // Идентификатор докладчика/участника в вашей системе (externalID в Eventicious)
                    $user->name,     // Имя
                    $user->lastname, // Фамилия
                    htmlspecialchars_decode($user->company, ENT_NOQUOTES), // Название компании
                    $user->position, // Должность
                    $user->cityName, // Город
                    '',              // ВК
                    '',              // Твиттер
                    '',              // ФБ
                    $user->email,    // E-mail
                    $user->phone,    // Телефон
                    '',              // О себе
                    false,           // Признак спикера
                    '',              // Ссылка на фото
                    $baseTicketId);  // ID билета (группа)
            if ($result['result_code'] == 200) {
                $mes .= "Eventicious: ID $user->id Создан<br>";
            }
        }

        // Пишем НЕизвестную ошибку в логи
        if (($result['result_code'] != 400) && ($result['result_code'] != 200)) {
            $mes .= "Eventicious: ID $user->id Ошибка " . $result['result_code'] . " См. логи";
            Logger::error("Eventicious: ID $user->id Ошибка " . $result['result_code'] . " См. логи");
            Logger::error($result);
        }
        return $mes;
    }

    // отправить письмо-уведомление для участника Олимпиады
    public static function sendNotifyOlimpic4User($userId) {
        $isSent = false;
        $um = new UserManager();
        $user = $um->getById($userId);
        $shortTitle = "Участие в Олимпиаде OFYR";
        $template = "Привет, шеф!<br><br>".
            "Мы приняли твою заявку на участие в Олимпиаде и дарим тебе шанс выиграть офигенный очаг! В соревнованиях участвуют только 30 участников. Теперь ты в их числе!)<br><br>".
            "Идея соревнований: приготовить максимально крутое блюдо на очаге OFYR. Смотри, что такое OFYR здесь <a href='https://www.ofyr.com.ru/'>www.ofyr.com</a><br><br>".
            "Условия будут ужесточаться в каждом этапе, поэтому ты должен быть готов ко всему!)<br><br>".
            "Напоминаем, что ты должен быть свободен:<br>".
            "22 мая 13:30 - 14:30 - BBQ Street<br>".
            "23 мая 13:30 - 14:30 - BBQ Street<br>".
            "24 мая 16:30 - 17:30 - Главная площадь<br><br>".
            "Если ты понял, что хочешь отступить и не готов участвовать в соревнованиях, то позвони 8 800 700 93 20. Не занимай место того, кто хочет признания и очаг OFYR больше чем ты.<br><br>".
            "Удачи тебе! Пусть победит сильнейший!<br><br>".
            "Gastreet TEAM";
        //$isSent = self::sendOneEmail("dev@gastreet.com", $userId, $shortTitle, $template, null, null);
        $isSent = self::sendOneEmail($user->email, $userId, $shortTitle, $template, null, null);
        return $isSent;
    }

    // отправить запрос на подтверждение e-mail
    public static function sendConfirmCodeEmail($email, $confirmCode, $userId) {
        $isSent = false;
        $btm = new BroadcastTemplateManager();
        $template = $btm->getBySendAndTriggerType(BroadcastTemplate::SEND_TYPE_EMAIL, BroadcastTemplate::TRIGGER_TYPE_EMAIL_CONFIRM_REQUEST);
        if ($template) {
            $host = Configurator::get('application:protocol') . Utility::getSurrentHost();
            $confirmLink = $host . "/index.php?do=userconfirm&code=" . $confirmCode;
            $vars = array(
                "CONFIRM_CODE" => $confirmCode,
                "CONFIRM_LINK" => $confirmLink,
                "SIGNATURE" => Configurator::get("mail:sign"),
            );

            $shortTitle = BroadcastTemplate::getTriggerTypeDesc(BroadcastTemplate::TRIGGER_TYPE_EMAIL_CONFIRM_REQUEST);
            $message = Enviropment::prepareForMail(MailTextHelper::parseContent(str_replace("&quot;", '"', htmlspecialchars_decode($template->message, ENT_NOQUOTES)), $vars));
            $isSent = self::sendOneEmail($email, $userId, $shortTitle, $message, $template, $vars);
        }
        return $isSent;
    }

    public static function sendRegisterCodeSms($phone, $code, $userId) {
        $isSent = false;
        $btm = new BroadcastTemplateManager();
        $template = $btm->getBySendAndTriggerType(BroadcastTemplate::SEND_TYPE_SMS, BroadcastTemplate::TRIGGER_TYPE_REGISTER_PHONE);
        if ($template) {
            $vars = array("USER_CODE" => $code);
            $message = Enviropment::prepareForMail(MailTextHelper::parseContent(str_replace("&quot;", '"', htmlspecialchars_decode($template->message, ENT_NOQUOTES)), $vars));
            // отладка
            // $isSent = true;
            $isSent = self::sendOneSms($phone, $userId, $message, $template);
        }
        return $isSent;
    }

    public static function sendConfirmCodeSms($phone, $code) {
        $isSent = false;
        $btm = new BroadcastTemplateManager();
        $template = $btm->getBySendAndTriggerType(BroadcastTemplate::SEND_TYPE_SMS, BroadcastTemplate::TRIGGER_TYPE_CONFIRM_PHONE);
        if ($template) {
            $vars = ["USER_CODE" => $code];
            $message = Enviropment::prepareForMail(MailTextHelper::parseContent(str_replace("&quot;", '"', htmlspecialchars_decode($template->message, ENT_NOQUOTES)), $vars));
            $isSent = self::sendOneSms($phone, null, $message, $template);
        }
        return $isSent;
    }

    public static function notifyRegisterParticipantSms($phone, $userId) {
        $isSent = false;

        $btm = new BroadcastTemplateManager();
        $template = $btm->getBySendAndTriggerType(BroadcastTemplate::SEND_TYPE_SMS, BroadcastTemplate::TRIGGER_TYPE_REGISTER_PARTICIPANT);
        if ($template) {
            $vars = array();
            $message = Enviropment::prepareForMail(MailTextHelper::parseContent(str_replace("&quot;", '"', htmlspecialchars_decode($template->message, ENT_NOQUOTES)), $vars));
            $isSent = self::sendOneSms($phone, $userId, $message, $template);
        }
        return $isSent;
    }

    // надо уведомить на e-mail и по смс всех кто это купил такой product
    // т.к. продукт Отменен
    public static function notifyProductCancel($productId, $productStatus, $productName) {
        $btm = new BroadcastTemplateManager();
        // шаблон для мыла
        $template = $btm->getBySendAndTriggerType(BroadcastTemplate::SEND_TYPE_EMAIL, BroadcastTemplate::TRIGGER_TYPE_NOTIFY_PRODUCT_CANCEL);
        if ($template) {
            $vars = array(
                "PRODUCT_NAME" => $productName,
                "PRODUCT_STATUS" => Product::getStatusDesc($productStatus),
                "SIGNATURE" => Configurator::get("mail:sign"),
            );

            $message = Enviropment::prepareForMail(MailTextHelper::parseContent(str_replace("&quot;", '"', htmlspecialchars_decode($template->message, ENT_NOQUOTES)), $vars));

            $um = new UserManager();
            // поднять userId, у которых в корзинах есть этот товар
            $bpm = new BasketProductManager();
            $userIds = $bpm->getUserIdsByProductId($productId);
            if (count($userIds)) {
                $shortTitle = BroadcastTemplate::getTriggerTypeDesc(BroadcastTemplate::TRIGGER_TYPE_NOTIFY_PRODUCT_CANCEL);
                $users = $um->getByIds($userIds);
                require_once APPLICATION_DIR . "/Lib/Swift/Mail.php";
                foreach ($users AS $user) {
                    if ($user->confirmedEmail) {
                        self::sendOneEmail($user->confirmedEmail, $user->id, $shortTitle, $message, $template, $vars);
                    }
                }
            }
        }

        // шаблон для СМС
        $template = $btm->getBySendAndTriggerType(BroadcastTemplate::SEND_TYPE_SMS, BroadcastTemplate::TRIGGER_TYPE_NOTIFY_PRODUCT_CANCEL);
        if ($template) {
            $vars = array(
                "PRODUCT_ID" => $productId,
            );

            $message = Enviropment::prepareForMail(MailTextHelper::parseContent(str_replace("&quot;", '"', htmlspecialchars_decode($template->message, ENT_NOQUOTES)), $vars));

            $um = new UserManager();
            $bpm = new BasketProductManager();
            $userIds = $bpm->getUserIdsByProductId($productId);
            if (count($userIds)) {
                $users = $um->getByIds($userIds);
                foreach ($users AS $user) {
                    if ($user->status == User::STATUS_REGISTERED) {
                        self::sendOneSms($user->phone, $user->id, $message, $template);
                    }
                }
            }
        }

        return true;
    }

    public function updateRegisterTime($userId) {
        $sql = "UPDATE user SET tsRegister = " . time() . " WHERE id = {$userId}";
        $this->executeNonQuery($sql);
        return true;
    }

    public function updateVisitTime($userId) {
        $sql = "UPDATE user SET tsOnline = " . time() . " WHERE id = {$userId}";
        $this->executeNonQuery($sql);
        return true;
    }

    public function increaseUlBalance($userId, $amount) {
        $amount = intval($amount);
        $sql = "UPDATE user SET ulBalance = ulBalance + {$amount} WHERE id = {$userId}";
        $this->executeNonQuery($sql);
        return true;
    }

    public function getFilteredUserIds($filterArray, $buyerIds = null, $type = null) {
        $res = null;
        // не выбран ни один фильтр
        if ($filterArray['basicfilter'] == 1) {
            $sql = "SELECT id FROM user ";
            if ($type) {
                $sql .= " WHERE type = '{$type}' ";
            }
            $sql .= " ORDER BY id DESC";
            $res = $this->getColumn($sql);
        } else {
            $allConditions = array();
            if ($type) {
                $allConditions[] = "type = '{$type}'";
            }
            if ($filterArray["basicfilter"] == 2) {
                if ($filterArray["id"]) {
                    $allConditions[] = "id = {$filterArray["id"]}";
                }
                if ($filterArray["lastname"]) {
                    $allConditions[] = "lastname like '%{$filterArray['lastname']}%'";
                }
                if ($filterArray["name"]) {
                    $allConditions[] = "name like '%{$filterArray['name']}%'";
                }
                if ($filterArray["phone"]) {
                    $allConditions[] = "phone like '%{$filterArray['phone']}%'";
                }
                if ($filterArray["email"]) {
                    $allConditions[] = "confirmedEmail like '%{$filterArray['email']}%'";
                }
                if (count($allConditions) > 0) {
                    $allConditions = " WHERE " . implode(" AND ", $allConditions);
                }
                $sql = "SELECT id FROM user {$allConditions} ORDER BY id DESC";
                $res = $this->getColumn($sql);
            }
        }

        if (is_array($buyerIds) && is_array($res) && count($res)) {
            $newRes = array();
            foreach ($res AS $item) {
                if (in_array($item, $buyerIds)) {
                    $newRes[] = $item;
                }
            }
            $res = $newRes;
        }
        return $res;
    }

    public function getByIds($userIds) {
        if (!$userIds)
            return null;
        if (count($userIds) == 0)
            return null;
        $ids = implode(",", $userIds);
        $res = $this->get(new SQLCondition("id IN ($ids)", null, "id"));
        return Utility::sort($userIds, $res);
    }

    public function getByPhones($phones) {
        if (!$phones) {
            return null;
        }
        if (count($phones) == 0) {
            return null;
        }
        $phonesString = implode("','", $phones);
        $conditionString = "phone IN ('{$phonesString}')";
        $res = $this->get(new SQLCondition($conditionString));
        return $res;
    }

    /**
     * Функция проверяет E-Mail или LastName или Name или Company или Position - если их нет, то отправляет редактировать профайл
     * 
     * @param array $actor Текущий юзер
     * @param integer $isAjax Параметр ответа если 1 то ответит в формате Ajax
     * 
     */
    public static function redirectIfNoProfile($actor, $isAjax = 0) {
        if (!$actor) {
            if ($isAjax) {
                echo json_encode("go_userlogin");
                exit;
            } else {
                if (UIGenerator::getLang() == 'en') {
                    Enviropment::redirect("userlogin", "To perform this action, you need to login.", "danger");
                } else {
                    Enviropment::redirect("userlogin", "Для выполнения данного действия необходимо авторизоваться", "danger");
                }
            }
        }
        if (!$actor->lastname || !$actor->name || !$actor->email || !$actor->company || !$actor->position) {
            if ($isAjax) {
                echo json_encode("go_usereditprofile");
                exit;
            } else {
                if ($actor->lang == 'en') {
                    Enviropment::redirect("register", "Before you buy, you must fill out your Profile", "danger");
                } else {
                    Enviropment::redirect("register", "Перед покупками заполните Ваш профиль", "danger");
                }
            }
        }
    }

    /**
     * Функция проверяет E-Mail или LastName или Name или Company или Position - если их нет, то отправляет редактировать профайл
     * 
     * @param array $actor Текущий юзер
     * @param integer $isAjax Параметр ответа если 1 то ответит в формате Ajax
     * 
     */
    public static function redirectIfNoLogin($actor, $url = '/') {
        if (!$actor) {
            if (UIGenerator::getLang() == 'en') {
                Enviropment::redirect($url, "You have to log in to perform this action", "danger");
            } else {
                Enviropment::redirect($url, "Для выполнения данного действия необходимо авторизоваться", "danger");
            }
            
        }
    }

    // основная версия
    public static function createQrCode($userId, $parentUserId = null) {
        $mode = null;
        $payed = Basket::STATUS_NEW;
        $qrm = new UserQrCodeManager();
        $qrmObj = $qrm->getOneActiveByUserId($userId);
        if (!$qrmObj) {
            $qrmObj = new UserQrCode();
            $qrmObj->tsCreated = time();
            $qrmObj->code = Utils::getGUID();
            $qrmObj->userId = $userId;
            if ($parentUserId) {
                $qrmObj->parenentId = $parentUserId;
            }
            $qrmObj->status = UserQrCode::STATUS_ACTIVE;
            $mode = self::MODE_CREATE;
        } else {
            $qrmObj->tsUpdated = time();
            $mode = self::MODE_UPDATE;
        }
        $qrmObj = $qrm->save($qrmObj);
        // пользователь
        $um = new UserManager();
        $user = $um->getById($userId);
        $userTypeName = 'Участник';
        if ($user->typeId) {
            $utm = new UserTypeManager();
            $utmObj = $utm->getById($user->typeId);
            $userTypeName = $utmObj->name;
        }
        if ( ($user->typeId > 7) && ($user->typeId != 14) ) {
            $userTypeName = 'Участник';
        }
        // сумма оплаченная за билеты: $amount
        // список доступных мероприятий: $accessListString
        $baseTicketName = '';
        $totalAmount = 0;
        // все названия, включая то, что внутри билетов
        $namesArray = array();
        $bm = new BasketManager();
        if ($user->parentUserId) {
            // это child
            $purchasedTickets = $bm->getPaidTicketsByChildId($userId);
        } else {
            $purchasedTickets = $bm->getPaidTicketsByUserIdNoChildren($userId);
        }

        if (count($purchasedTickets)) {
            // какие продукты входят в основной билет
            $includedProductIds = array();
            $ttplm = new TicketToProductLinkManager();
            foreach ($purchasedTickets AS $oneTicket) {
                $totalAmount = $totalAmount + $oneTicket['payAmount'] + $oneTicket['ulAmount'] - $oneTicket['returnedAmount'];
                if (!$baseTicketName) {
                    // название основного билета
                    $baseTicketName = $oneTicket['baseTicketName'];
                    // Статус основного билета
                    $payed = $oneTicket['status'];
                }
                $productIdArray = $ttplm->getProductIdsByBaseTicketId($oneTicket['baseTicketId']);
                if (count($productIdArray)) {
                    $includedProductIds = $productIdArray;
                }
            }
            if (count($includedProductIds)) {
                $pm = new ProductManager();
                $includedProducts = $pm->getByIds($includedProductIds);
                foreach ($includedProducts AS $includedProduct) {
                    $namesArray[] = $includedProduct->ext_id;
                }
            }
        }

        // билеты (мероприятия)
        $bpm = new BasketProductManager();
        if ($user->parentUserId) {
            // это child
            $purchasedProducts = $bpm->getPaidProductsByChildId($userId);
        } else {
            $purchasedProducts = $bpm->getPaidProductsByUserIdNoChildren($userId);
        }

        if (count($purchasedProducts)) {
            foreach ($purchasedProducts AS $oneProduct) {
                // все названия, включая то что внутри билетов
                $namesArray[] = $oneProduct['ext_id'];
                // общая сумма оплаты
                $totalAmount = $totalAmount + $oneProduct['payAmount'] + $oneProduct['ulAmount'] - $oneProduct['returnedAmount'];
            }
        }

        if (count($purchasedTickets) || count($purchasedProducts)) {
            $ucm = new UserQrCodeManager;
            // обновление по $qrCode
            if (Configurator::get("application:bitSync") == 1) {
                $bitRes = $ucm->bitSaveTicket($user->phone, $user->email, $user->confirmedEmail, $user->lastname, $user->name, $userTypeName, $user->type, $user->company, $user->position, $totalAmount, $baseTicketName, $payed, $namesArray, $qrmObj->code);
            }
            //Logger::info("UserManager purchasedProducts:");
           // Logger::info($purchasedProducts);
        }
        return $qrmObj;
    }

    public static function createQrCodeByCode($code, $parentUserId = null) {
        $mode = self::MODE_UPDATE;
        $qrm = new UserQrCodeManager();
        $qrmObj = $qrm->getOneByCode($code);
        $userId = $qrmObj->userId;
        // пользователь
        $um = new UserManager();
        $user = $um->getById($userId);

        $userTypeName = 'Участник';
        if ($user->typeId) {
            $utm = new UserTypeManager();
            $utmObj = $utm->getById($user->typeId);
            $userTypeName = $utmObj->name;
        }

        // сумма оплаченная за билеты: $amount
        // список доступных мероприятий: $accessListString
        $baseTicketName = '';
        $totalAmount = 0;
        $namesArray = array();
        $bm = new BasketManager();
        if ($user->parentUserId) {
            // это child
            $purchasedTickets = $bm->getPaidTicketsByChildId($userId);
        } else {
            $purchasedTickets = $bm->getPaidTicketsByUserIdNoChildren($userId);
        }

        if (count($purchasedTickets)) {
            // какие продукты входят в основной билет
            $includedProductIds = array();
            $ttplm = new TicketToProductLinkManager();
            foreach ($purchasedTickets AS $oneTicket) {
                $totalAmount = $totalAmount + $oneTicket['payAmount'] + $oneTicket['ulAmount'] - $oneTicket['returnedAmount'];
                if (!$baseTicketName) {
                    $baseTicketName = $oneTicket['baseTicketName'];
                    $payed = $oneTicket['status'];
                }
                $productIdArray = $ttplm->getProductIdsByBaseTicketId($oneTicket['baseTicketId']);
                if (count($productIdArray)) {
                    $includedProductIds = $productIdArray;
                }
            }
            if (count($includedProductIds)) {
                $pm = new ProductManager();
                $includedProducts = $pm->getByIds($includedProductIds);
                foreach ($includedProducts AS $includedProduct) {
                    $showDate = date("Y-m-d", $includedProduct->eventTsStart);
                    $namesArray[] = "[{$showDate}] " . str_replace(',', ' ', $includedProduct->name);
                }
            }
        }

        // билеты (мероприятия)
        $bpm = new BasketProductManager();
        if ($user->parentUserId) {
            // это child
            $purchasedProducts = $bpm->getPaidProductsByChildId($userId);
        } else {
            $purchasedProducts = $bpm->getPaidProductsByUserIdNoChildren($userId);
        }

        if (count($purchasedProducts)) {
            foreach ($purchasedProducts AS $oneProduct) {
                $showDate = date("Y-m-d", $oneProduct['eventTsStart']);
                $namesArray[] = $oneProduct['ext_id'];
                $totalAmount = $totalAmount + $oneProduct['payAmount'] + $oneProduct['ulAmount'] - $oneProduct['returnedAmount'];
            }
        }

        if (count($purchasedTickets) || count($purchasedProducts)) {
            // обновление по $qrCode
            if (Configurator::get("application:bitSync") == 1) {
                $ucm = new UserQrCodeManager;
                $ucm->bitSaveTicket($user->phone, $user->email, $user->confirmedEmail, $user->lastname, $user->name, $userTypeName, $user->type, $user->company, $user->position, $totalAmount, $baseTicketName, $payed, $namesArray, $code);
                Logger::info("bitSaveTicket {$code}, userId: {$user->id}");
                Logger::info("-----------------------");
            }
        } else {
            // Logger::info("NO GOODS FROR: {$code}, userId: {$user->id}");
            // Logger::info("-----------------------");
        }
        return $qrmObj;
    }

    // основная версия
    public static function removeQrCode($userId) {
        // проверим осталось ли что-то оплаченное (по разнице цена минус оплачено)
        // если ничего нет, то удалим Qr код из 1С-Бит и ещё из БД
        // оплачено за билеты
        $bmPaidAmount = 0;
        $bm = new BasketManager();
        $bmList = $bm->getTicketsByUserId($userId);
        if (is_array($bmList) && count($bmList)) {
            foreach ($bmList AS $bmItem) {
                $bmPaidAmount = $bmPaidAmount + $bmItem['payAmount'];
            }
        }
        // оплачено за продукты
        $bpmPaidAmount = 0;
        $bpm = new BasketProductManager();
        $bpmList = $bpm->getProductsByUserId($userId);
        if (is_array($bpmList) && count($bpmList)) {
            foreach ($bpmList AS $bpmItem) {
                $bpmPaidAmount = $bpmPaidAmount + $bpmItem['payAmount'];
            }
        }
        // пользователь
        $um = new UserManager();
        $user = $um->getById($userId);
        if ($bmPaidAmount + $bpmPaidAmount == 0) {
            $qrm = new UserQrCodeManager();
            $qrmObj = $qrm->getOneActiveByUserId($userId);
            if ($qrmObj && (Configurator::get("application:bitSync") == 1) ) {
                $qrm->bitDeleteTicket($qrmObj->code);
            }
        }
    }

    public static function removeQrCodeByCode($code) {
        // проверим осталось ли что-то оплаченное (по разнице цена минус оплачено)
        // если ничего нет, то удалим Qr код из 1С-Бит и ещё из БД
        $qrm = new UserQrCodeManager();
        $qrmObj = $qrm->getOneByCode($code);
        $userId = $qrmObj->userId;
        // пользователь
        $um = new UserManager();
        $user = $um->getById($userId);
        // оплачено за билеты
        $bmPaidAmount = 0;
        $bm = new BasketManager();
        $bmList = $bm->getTicketsByUserId($userId);
        if (is_array($bmList) && count($bmList)) {
            foreach ($bmList AS $bmItem) {
                $bmPaidAmount = $bmPaidAmount + $bmItem['payAmount'];
            }
        }
        // оплачено за продукты
        $bpmPaidAmount = 0;
        $bpm = new BasketProductManager();
        $bpmList = $bpm->getProductsByUserId($userId);
        if (is_array($bpmList) && count($bpmList)) {
            foreach ($bpmList AS $bpmItem) {
                $bpmPaidAmount = $bpmPaidAmount + $bpmItem['payAmount'];
            }
        }
        if ($bmPaidAmount + $bpmPaidAmount == 0) {
            if ($qrmObj && (Configurator::get("application:bitSync") == 1) ) {
                $qrm->bitDeleteTicket($code);
            }
        }
    }

    public function getNewUsers($eventTsStart, $eventTsFinish) {
        // определить кол-во регистраций в указанном окне времени
        $eventTsStart = intval($eventTsStart);
        $eventTsFinish = intval($eventTsFinish);
        $сount = 0;
        $sql = "SELECT COUNT(*) AS cnt FROM user WHERE tsCreated >= {$eventTsStart} AND tsCreated <= {$eventTsFinish}";
        $res = $this->getOneByAnySQL($sql);
        if ($res) {
            $сount = $сount + intval($res['cnt']);
        }
        return $сount;
    }

    public function getBitStatus() {
        $сount = 0;
        $sql = "SELECT COUNT(*) AS cnt FROM `user` WHERE `status` = '" . User::STATUS_REGISTERED . "' AND `bitUpdate` IS NULL AND `baseTicketId` IS NOT NULL";
        //$sql = "SELECT COUNT(*) AS cnt FROM `user` WHERE `status` = '" . User::STATUS_REGISTERED . "' AND `bitUpdate` IS NULL AND (`baseTicketId` IS NOT NULL) AND (`baseTicketId` <> 1) AND (`baseTicketId` <> 4)";
        $res = $this->getOneByAnySQL($sql);
        if ($res) {
            $сount = $сount + intval($res['cnt']);
        }
        return $сount;
    }
    
    public function getAllRegistered() {
        $sql = "SELECT * FROM `user` WHERE `status` = '" . User::STATUS_REGISTERED . "' AND `name` <> '' LIMIT 1500,100";
        return $this->getByAnySQL($sql);
    }
    
    public function getLimitRegistered($limit = 10) {
        $sql = "SELECT * FROM `user` WHERE `status` = '" . User::STATUS_REGISTERED . "' AND `bitUpdate` IS NULL AND `baseTicketId` IS NOT NULL LIMIT 0,$limit";
       // $sql = "SELECT * FROM `user` WHERE `status` = '" . User::STATUS_REGISTERED . "' AND `bitUpdate` IS NULL AND (`baseTicketId` IS NOT NULL) AND (`baseTicketId` <> 1) AND (`baseTicketId` <> 4) LIMIT 0,10";
        return $this->getByAnySQL($sql);
    }

    public function getRegistered($eventTsStart = 0, $eventTsFinish = 0) {
        // определить кол-во регистраций в указанном окне времени
        $eventTsStart = intval($eventTsStart);
        $eventTsFinish = intval($eventTsFinish);
        $сount = 0;
        $sql = "SELECT COUNT(*) AS cnt FROM user WHERE status = '" . User::STATUS_REGISTERED . "' ";
        if ($eventTsStart && $eventTsFinish) {
            $sql .= " AND tsRegister >= {$eventTsStart} AND tsRegister <= {$eventTsFinish} ";
        }
        $res = $this->getOneByAnySQL($sql);
        if ($res) {
            $сount = $сount + intval($res['cnt']);
        }
        return $сount;
    }

    public function checkRegistered($user) {
        if ($user->status == User::STATUS_NEW) {
            $user->status = User::STATUS_REGISTERED;
            $user->tsRegister = time();
            $user = $this->save($user);
        }
        return $user;
    }

    public function generateProductHtmlMessage($user) {
        $um = new UserManager();
        $pm = new ProductManager();
        $prods = null;
        // сумма, оплаченная за билеты
        $amount = 0;
        // наименования дополнительных МК
        $productsArray = array();
        // название типа покупателя
        $ustatus = 'Участник';
        if ($user->typeId) {
            $utm = new UserTypeManager();
            $utmObj = $utm->getById($user->typeId);
            $ustatus = $utmObj->name;
        }
        $alias = 'mklist';
        // все area
        $am = new AreaManager();
        $areas = $am->getAll();
        $areasArray = array();
        if (count($areas)) {
            foreach ($areas AS $onearea) {
                $areasArray[$onearea->id] = $onearea->name;
            }
        }
        // все place
        $plm = new PlaceManager();
        $places = $plm->getAll();
        $placesArray = array();
        if (count($places)) {
            foreach ($places AS $oneplace) {
                $placesArray[$oneplace->id] = $oneplace->name;
            }
        }
        // все спикеры (только ФИО)
        $spm = new SpeakerManager();
        $speakers = $spm->getAll();
        $speakersArray = array();
        if (count($speakers)) {
            foreach ($speakers AS $onespeaker) {
                $speakersArray[$onespeaker->id] = $onespeaker->name . " " . $onespeaker->secondName;
            }
        }
        // что в корзине по основному билету
        $bm = new BasketManager();
        if ($user->parentUserId) {
            $purchasedTickets = $bm->getTicketsByChildId($user->id);
        } else {
            $purchasedTickets = $bm->getTicketsByUserIdNoChildren($user->id);
        }
        if (is_array($purchasedTickets) && count($purchasedTickets)) {
            foreach ($purchasedTickets AS $oneTicket) {
                $amount = $amount + ($oneTicket['payAmount'] + $oneTicket['ulAmount'] + $oneTicket['discountAmount'] - $oneTicket['returnedAmount']);
            }
        }
        // что в корзине по мастер-классам
        $bpm = new BasketProductManager();
        if ($user->parentUserId) {
            $purchasedProducts = $bpm->getProductsByChildId($user->id);
        } else {
            $purchasedProducts = $bpm->getProductsByUserIdNoChildren($user->id);
        }
        if (is_array($purchasedProducts) && count($purchasedProducts)) {
            foreach ($purchasedProducts AS $oneProduct) {
                if ($oneProduct['status'] == BasketProduct::STATUS_PAID && $oneProduct['payAmount'] + $oneProduct['ulAmount'] >= $oneProduct['needAmount'] + $oneProduct['returnedAmount'] - $oneProduct['discountAmount']) {
                    // надо получить ещё сам MK!
                    $productObj = $pm->getById($oneProduct['productId']);
                    $speakersList = "";
                    if ($productObj->speakerId) {
                        if ($speakersList) {
                            $speakersList .= ",<br/>";
                        }
                        $speakersList .= $speakersArray[$productObj->speakerId];
                    }
                    if ($productObj->speaker2Id) {
                        if ($speakersList) {
                            $speakersList .= ",<br/>";
                        }
                        $speakersList .= $speakersArray[$productObj->speaker2Id];
                    }
                    if ($productObj->speaker3Id) {
                        if ($speakersList) {
                            $speakersList .= ",<br/>";
                        }
                        $speakersList .= $speakersArray[$productObj->speaker3Id];
                    }
                    if ($productObj->speaker4Id) {
                        if ($speakersList) {
                            $speakersList .= ",<br/>";
                        }
                        $speakersList .= $speakersArray[$productObj->speaker4Id];
                    }
                    if ($productObj->speaker5Id) {
                        if ($speakersList) {
                            $speakersList .= ",<br/>";
                        }
                        $speakersList .= $speakersArray[$productObj->speaker5Id];
                    }
                    if ($productObj->speaker6Id) {
                        if ($speakersList) {
                            $speakersList .= ",<br/>";
                        }
                        $speakersList .= $speakersArray[$productObj->speaker6Id];
                    }
                    $productsArray[] = array("eventTsStart" => $oneProduct['eventTsStart'], "eventTsFinish" => $oneProduct['eventTsFinish'], "productName" => mb_strtoupper($oneProduct['productName'], 'UTF-8'),
                        "price" => $oneProduct['needAmount'], "place" => $placesArray[$productObj->placeId], "speaker" => $speakersList);
                }
                $amount = $amount + ($oneProduct['payAmount'] + $oneProduct['ulAmount'] + $oneProduct['discountAmount'] - $oneProduct['returnedAmount']);
            }
        }

        // сформировать табличку МК
        $prods = "";
        if (count($productsArray)) {
            // бордер
            $tblBgColorTmpl = ' style="border-bottom: solid 1px #ddd; padding: 5px;"';
            $prods .= '<p style="font-family: LiberationSans; font-size:21px; color:#000; font-weight: 400;">Список оплаченных мастер-классов<br/>' . $user->lastname . ' ' . $user->name . ':</p><br/><table width=700>';
            $prods .= "<tr><td valign=middle width=150{$tblBgColorTmpl}>Время<br/>&nbsp;</td><td valign=middle width=477{$tblBgColorTmpl}>Спикер / тема<br/>&nbsp;</td><td valign=middle{$tblBgColorTmpl}>Статус<br/>оплаты<br/>&nbsp;</td></tr>";
            // фон
            // $tblBgColorTmpl = ' style="background: #ddd; padding: 5px;"';
            $tblBgColor = $tblBgColorTmpl;
            foreach ($productsArray AS $prodItem) {
                $showDateTime = date("d ", $prodItem['eventTsStart']) . " мая";
                $showDateTime .= "<br/>" . date("H:i", $prodItem['eventTsStart']);
                $showDateTime .= "-" . date("H:i", $prodItem['eventTsFinish']);
                $prods .= "<tr><td valign=top width=100{$tblBgColor}>{$showDateTime}</td><td valign=top width=400{$tblBgColor}>{$prodItem['productName']}<br/><br/>{$prodItem['speaker']}<br/>&nbsp;</td><td valign=top{$tblBgColor}>оплачено</td></tr>";
                // $tblBgColor = ($tblBgColor == $tblBgColorTmpl) ? '' : $tblBgColorTmpl;
            }
            $prods .= "</table>";
        } else {
            return false;
        }
        // сформировать
        $cm = new ContentManager();
        $contentObj = $cm->getByAlias($alias);
        if (!$contentObj) {
            if (UIGenerator::getLang() == 'en') {
                Enviropment::redirectBack("Ticket issuance error", "danger");
            } else {
                Enviropment::redirectBack("Ошибка формирования билета", "danger");
            }
        }
        $html = str_replace("&quot;", '"', htmlspecialchars_decode($contentObj->text, ENT_NOQUOTES));
        $html = str_replace("&#123;", "{", $html);
        $html = str_replace("&#125;", "}", $html);
        // заменить параметры в шаблоне
        $vars = array("prods" => $prods);
        $message = Enviropment::prepareForMail(MailTextHelper::parseContent($html, $vars));
        return $message;
    }

    /**
     * Возвращает число билетов в корзине
     * 
     * @param type $actor
     */
    public static function getBacketCount($actor) {
        if (!$actor) {
            return null;
        }
        $bm = new BasketManager();
        $bpm = new BasketProductManager();
        if ( isset($actor) && ($actor->parentUserId == null) ) {
            $userTickets = $bm->getTicketsByUserIdNoPay($actor->id);
            $userProducts = $bpm->getProductsByUserIdNoPay($actor->id);
            return count($userTickets) + count($userProducts);
        } else {
            $userTickets = $bm->getTicketsByChildIdNoPay($actor->id);
            $userProducts = $bpm->getProductsByChildIdNoPay($actor->id);
            return count($userTickets) + count($userProducts);
        }
        return 0;
    }

    public function generateTicketHtmlMessage($user, $lang = null) {
        $um = new UserManager();
        // отдать pdf
        // подготовка параметров для шаблона
        // по реквизитам для выставления счёта
        $ulcompany = null;
        $ulcountry = null;
        $ulcity = null;
        $ulinn = null;
        $ulkpp = null;
        $ulrs = null;
        $ulbank = null;
        $ulcorr = null;
        $ulbik = null;
        $uldirector = null;
        $ulbuh = null;
        $ustatus = null;
        $qrcode = null;
        $prods = null;
        $site = Configurator::get("application:url");
        // сумма, оплаченная за билеты
        $amount = 0;
        // наименования дополнительных МК
        $productsArray = array();
        // название типа покупателя
        $ustatus = ($lang == 'en') ? 'Participant':'Участник';
        if ($user->typeId) {
            if (($user->typeId >= 8) && ($user->typeId <= 11)) {
                $ustatus = ($lang == 'en') ? 'Participant' : 'Участник';
            } else {
                $utm = new UserTypeManager();
                $utmObj = $utm->getById($user->typeId);
                $ustatus = ($lang == 'en') ? $utmObj->name_en : $utmObj->name;
            }
        }
        $ticket = null;
        // что в корзине по основному билету
        $bm = new BasketManager();
        if ($user->parentUserId) {
            $purchasedTickets = $bm->getTicketsByChildId($user->id);
        } else {
            $purchasedTickets = $bm->getTicketsByUserIdNoChildren($user->id);
        }
        if (is_array($purchasedTickets) && count($purchasedTickets)) {
            foreach ($purchasedTickets AS $oneTicket) {
                //$amount = $amount + ($oneTicket['payAmount'] + $oneTicket['ulAmount'] + $oneTicket['discountAmount'] - $oneTicket['returnedAmount']);
                $amount = $amount + ($oneTicket['payAmount'] + $oneTicket['ulAmount'] - $oneTicket['returnedAmount']);
                $ticket = $oneTicket['baseTicketName'];
                
            }
        }
        // что в корзине по мастер-классам
        $bpm = new BasketProductManager();
        if ($user->parentUserId) {
            $purchasedProducts = $bpm->getProductsByChildId($user->id);
        } else {
            $purchasedProducts = $bpm->getProductsByUserIdNoChildren($user->id);
        }
        if (is_array($purchasedProducts) && count($purchasedProducts)) {
            foreach ($purchasedProducts AS $oneProduct) {
                if ($oneProduct['status'] == BasketProduct::STATUS_PAID && $oneProduct['payAmount'] + $oneProduct['ulAmount'] >= $oneProduct['needAmount'] + $oneProduct['returnedAmount'] - $oneProduct['discountAmount']) {
                    $productsArray[] = array("eventTsStart" => $oneProduct['eventTsStart'], "productName" => $oneProduct['productName'], "price" => $oneProduct['needAmount']);
                }
                //$amount = $amount + ($oneProduct['payAmount'] + $oneProduct['ulAmount'] + $oneProduct['discountAmount'] - $oneProduct['returnedAmount']);
                $amount = $amount + ($oneProduct['payAmount'] + $oneProduct['ulAmount'] - $oneProduct['returnedAmount']);
            }
        }
        
        if ( $amount > 0 ) {
            $alias = 'biletamount';
        } else {
            $alias = 'bilet';
        }
        
        
        // сформировать табличку МК
        $prods = "";
        if (count($productsArray)) {
            // не будем менять шаблон пока
            // $alias .= "prods"; // шаблон с добавлением названий МК
            if ($lang == 'en') {
                $prods .= "<b>List of additional master classes:</b><br/><br/><table width=700>";
            } else {
                $prods .= "<b>Список дополнительных мастер-классов:</b><br/><br/><table width=700>";
            }
            foreach ($productsArray AS $prodItem) {
                $showDateTime = date("Y-m-d, в H:i", $prodItem['eventTsStart']);
                $prods .= "<tr><td valign=top>[{$showDateTime}] </td><td valign=top width=500> {$prodItem['productName']}</td></tr>";
            }
            $prods .= "</table>";
        }
        // сформировать билет
        $cm = new ContentManager();
        $contentObj = $cm->getByAlias($alias);
        if (!$contentObj) {
            if ($lang == 'en') {
                Enviropment::redirectBack("Ticket issuance error", "danger");
            } else {
                Enviropment::redirectBack("Ошибка формирования билета", "danger");
            }
        }
        $qrm = new UserQrCodeManager();
        $qrmObj = $qrm->getOneActiveByUserId($user->id);
        if ($qrmObj) {
            $qrcode = $qrmObj->code;
        }
        // по пользователю
        $umObj = $um->getById($user->id);
        // параметры
        $id = $umObj->id;
        $lastname = $umObj->lastname;
        $name = $umObj->name;
        $email = ($umObj->confirmedEmail) ? $umObj->confirmedEmail : $umObj->email;
        $phone = $umObj->phone;
        $country = $umObj->countryName;
        $city = $umObj->cityName;
        $company = $umObj->company;
        $position = $umObj->position;
        // данные по реквизитам
        $udm = new UserDetailsManager();
        $udmObj = $udm->getByUserId($user->id);
        if ($udmObj) {
            $ulcompany = $udmObj->company;
            $ulcountry = $udmObj->countryName;
            $ulcity = $udmObj->cityName;
            $ulinn = $udmObj->inn;
            $ulkpp = $udmObj->kpp;
            $ulrs = $udmObj->rs;
            $ulbank = $udmObj->bank;
            $ulcorr = $udmObj->corr;
            $ulbik = $udmObj->bik;
            $uldirector = $udmObj->director;
            $ulbuh = $udmObj->buh;
        }
        if ($lang == 'en') {
            $html = str_replace("&quot;", '"', htmlspecialchars_decode($contentObj->text_en, ENT_NOQUOTES));
        } else {
            $html = str_replace("&quot;", '"', htmlspecialchars_decode($contentObj->text, ENT_NOQUOTES));
        }
        $html = str_replace("&#123;", "{", $html);
        $html = str_replace("&#125;", "}", $html);
        // заменить параметры в шаблоне
        $vars = array(
            "id" => $id,
            "site" => $site,
            "ticket" => $ticket,
            "lastname" => $lastname,
            "name" => $name,
            "email" => $email,
            "phone" => $phone,
            "country" => $country,
            "city" => $city,
            "company" => $company,
            "position" => $position,
            "ulcompany" => $ulcompany,
            "ulcountry" => $ulcountry,
            "ulcity" => $ulcity,
            "ulinn" => $ulinn,
            "ulkpp" => $ulkpp,
            "ulrs" => $ulrs,
            "ulbank" => $ulbank,
            "ulcorr" => $ulcorr,
            "ulbik" => $ulbik,
            "uldirector" => $uldirector,
            "ulbuh" => $ulbuh,
            "amount" => $amount,
            "ustatus" => $ustatus,
            "qrcode" => $qrcode,
            "prods" => $prods,
        );
        $message = Enviropment::prepareForMail(MailTextHelper::parseContent($html, $vars));
        return $message;
    }
    
    public static function generateCertHtmlMessage($userId) {
        // сформировать билет
        $um = new UserManager();
        $cm = new ContentManager();
        $site = Configurator::get("application:url");
        $contentObj = $cm->getByAlias('cert');
        
        // по пользователю
        $umObj = $um->getById($userId);
        // параметры
        $lastname = $umObj->lastname;
        $name = $umObj->name;
        $lang = $umObj->lang;
        if ($lang == 'en') {
            $html = str_replace("&quot;", '"', htmlspecialchars_decode($contentObj->text_en, ENT_NOQUOTES));
        } else {
            $html = str_replace("&quot;", '"', htmlspecialchars_decode($contentObj->text, ENT_NOQUOTES));
        }
        $html = str_replace("&#123;", "{", $html);
        $html = str_replace("&#125;", "}", $html);
        // заменить параметры в шаблоне
        $vars = array(
            "site" => $site,
            "lastname" => $lastname,
            "name" => $name,
        );

        $message = Enviropment::prepareForMail(MailTextHelper::parseContent($html, $vars));
        return $message;
    }

    public static function checkOldUserByPhone($phone) {
        $um = new UserManager();
        $sql = "SELECT `id` FROM `oldusers` WHERE `phone` LIKE '{$phone}%' AND `showmsg` = 0";
        $res = $um->getColumn($sql);
        $cleanSql = "UPDATE `oldusers` SET `showmsg` = 1 WHERE `phone` LIKE '{$phone}%' AND `showmsg` = 0";
        $um->executeNonQuery($cleanSql);
        return $res;
    }

    public function getIdByBasketHash($code) {
        $um = new UserManager();
        $sql = "SELECT `id` FROM `user` WHERE `disableBroadcastKey` LIKE '%{$code}%' LIMIT 1";
        $res = $um->getColumn($sql);
        return $res;
    }

    public static function checkOldUserByEmail($email) {
        $um = new UserManager();
        $email = strtolower($email);
        $sql = "SELECT `id` FROM `oldusers` WHERE `email` = '$email' AND `showmsg` = 0";
        $res = $um->getColumn($sql);
        $cleanSql = "UPDATE `oldusers` SET `showmsg` = 1 WHERE `email` = '$email' AND `showmsg` = 0";
        $um->executeNonQuery($cleanSql);
        return $res;
    }

    /**
     * Функция проверяет старых участников
     * @param $fio string формат поля Имя Фамилия
     * @return Array
     */
    public static function checkOldUserByFio($lastname, $name) {
        $um = new UserManager();
        $sql = "SELECT `id` FROM `oldusers` WHERE `lastname` = '$lastname' AND `name` = '$name' AND `showmsg` = 0";
        $res = $um->getColumn($sql);
        $cleanSql = "UPDATE `oldusers` SET `showmsg` = 1 WHERE `lastname` = '$lastname' AND `name` = '$name' AND `showmsg` = 0";
        $um->executeNonQuery($cleanSql);
        return $res;
    }

    public static function isItOldUser($user) {
        $result = false;
        $email = $user->confirmedEmail ? $user->confirmedEmail : $user->email;
        if ($email) {
            if (self::checkOldUserByEmail($email)) {
                $result = true;
                Context::setObject('code', 'gastreetspecial'); // Если это старый пользователь то активируем ему низкие цены
            }
        }
        if (($user->lastname) && ($user->name) && (self::checkOldUserByFio($user->lastname, $user->name))) {
            $result = true;
            Context::setObject('code', 'gastreetspecial'); // Если это старый пользователь то активируем ему низкие цены
        }
        if (self::checkOldUserByPhone($user->phone)) {
            $result = true;
            Context::setObject('code', 'gastreetspecial'); // Если это старый пользователь то активируем ему низкие цены
        }
        return $result;
    }

    public static function realSendTicketViaEmail($userId = 0) {
        $attachFullPathFileNameArray = array();
        $attachFileNameArray = array();
        if (!$userId) {
            return false;
        }
        // отправка билета на e-mail пользователю
        $um = new UserManager();
        $user = $um->getById($userId);
        if (!$user) {
            return false;
        }
        // спикерам не надо отправлять билет и список МК и памятку
        if ($user->typeId == 3) {
            return false;
        }
        $uqm = new UserQrCodeManager();
        $qrCode = $uqm->getOneActiveByUserId($userId);
        if (!$qrCode) {
            return false;
        }
        $qrLibFileName = APPLICATION_DIR . "/phpqrcode/qrlib.php";
        include_once($qrLibFileName);
        QRcode::png($qrCode->code, APPLICATION_DIR . "/../qr/codes/" . $qrCode->code . ".png"); // creates file
        // билет
        $message = $um->generateTicketHtmlMessage($user);
        // список МК
        $messageProducts = $um->generateProductHtmlMessage($user);
        $newFileName = Configurator::get("application:ticketsFolder") . $qrCode->code . ".pdf";
        $newFileNameMk = Configurator::get("application:ticketsFolder") . $qrCode->code . "_mk.pdf";
        // теперь надо собрать билет $message и сохранить его в pdf
        $qrLibFileName = APPLICATION_DIR . "/html2pdf/vendor/autoload.php";
        require_once($qrLibFileName);
        $isOk = true;
        // генерация
        try {
            $html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8');
            // $html2pdf->setModeDebug();
            $html2pdf->setDefaultFont('freeserif');
            //$fontName = TCPDF_FONTS::addTTFfont('/usr/share/fonts/truetype/liberation/LiberationSans-Regular.ttf', 'TrueTypeUnicode');
            $fontName = 'liberationsans';
            $html2pdf->addFont('LiberationSans', '', $fontName);
            $html2pdf->writeHTML($message);
            $html2pdf->Output($newFileName, 'F');
        } catch (HTML2PDF_exception $e) {
            $isOk = false;
        }
        $attachFullPathFileNameArray[1] = $newFileName;
        // $attachFileNameArray[1] = $qrCode->code . "_" . time() . ".pdf";
        $attachFileNameArray[1] = "билет.pdf";
        // надо собрать ещё один pdf файл (с данными о заказе $messageProducts)
        if ($messageProducts) {
            try {
                $html2pdf_mk = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8');
                // $html2pdf_mk->setModeDebug();
                $html2pdf_mk->setDefaultFont('freeserif');
                //$fontName = TCPDF_FONTS::addTTFfont('/usr/share/fonts/truetype/liberation/LiberationSans-Regular.ttf', 'TrueTypeUnicode');
                $fontName = 'liberationsans';
                $html2pdf_mk->addFont('LiberationSans', '', $fontName);
                $html2pdf_mk->writeHTML($messageProducts);
                $html2pdf_mk->Output($newFileNameMk, 'F');
            } catch (HTML2PDF_exception $e) {
                $isOk = false;
                print_r($e);
            }
            $attachFullPathFileNameArray[2] = $newFileNameMk;
            // $attachFileNameArray[2] = $qrCode->code . "_mk_" . time() . ".pdf";
            $attachFileNameArray[2] = "мк.pdf";
        }
        // автолоадер обратно
        spl_autoload_register(array("Configurator", "autoload"));
        if (!$isOk) {
            return false;
        }
        //$attachFullPathFileNameArray[3] = DOCUMENT_ROOT."/pdf/gastreet19_memo.pdf";
        //$attachFileNameArray[3] = "gastreet_memo.pdf";
        //$attachFileNameArray[3] = "памятка.pdf";
        // отправить E-Mail с аттачем $newFileName
        //$email = ($user->confirmedEmail) ? $user->confirmedEmail : $user->email;
        $email = $user->confirmedEmail;
        // $shortTitle = "Распечатайте билет на Gastreet " . date("d.m.Y");
        $shortTitle = "Билет на GASTREET'20";
        $vars = array(
            "SIGNATURE" => Configurator::get("mail:sign"),
        );

        //Уважаемый(-ая) ".$user->lastname . " " . $user->name."
        $emailMessage = "Всем Gastreet!<br><br>
                Наконец мы выходим на финишную прямую, до нашей грандиозной встречи остались считанные часы. Поэтому просим ОЧЕНЬ ВНИМАТЕЛЬНО ознакомиться с «памяткой гастритовца», которую мы заботливо составили и вложили в это письмо.<br><br>

                Из памятки вы узнаете:<br>
                - как будет организован трансфер из аэропорта и в аэропорт<br>
                - как и где зарегистрироваться на Gastreet<br>
                - что делать детям и женам во время шоу<br>
                - карта локации<br><br>

                Скачивайте мобильное приложение Gastreet (доступно в AppStore и GooglePlay), чтобы быть в курсе всех движух во время мероприятия!<br><br>

                Не забудьте свои билеты (они в письме) и паспорт!!!<br><br>

                А также можете распечатать и взять с собой список оплаченных мастер-классов и ужинов, если боитесь что-то забыть;)<br><br>

                Перестали спать, очень ждем.<br><br>

                С любовью, Gastreet Теам.";
        
        
        // Меняем текст
        $emailMessage = "Поздравляем! Ты едешь на Gastreet!<br>
            Мы очень рады видеть тебя в числе участников! Твой билет во вложении, также его можно скачать в личном кабинете на сайте gastreet.com.<br>
            До встречи на GASTREET 2020!";
        
        
        if ($user->baseTicketId == 1) {
        $emailMessage = "Поздравляем! Ты едешь на Gastreet!<br>
            Мы очень рады видеть тебя в числе участников! Твой билет во вложении, также его можно скачать в личном кабинете на сайте gastreet.com.<br>
            Не забывай, что с билетом «Турист» ты НЕ сможешь посещать мастер-классы и семинары. ВООБЩЕ.<br>
            Для тебя открыта только развлекательная и «поедательная» часть нашего грандиозного мероприятия:)<br>
            До встречи на GASTREET 2020!";
        }
        
        // сама отправка письма
        if ($user->confirmedEmail) {
            $isSent = self::sendOneEmail($email, $userId, $shortTitle, $emailMessage, null, $vars, $attachFullPathFileNameArray, $attachFileNameArray);
        } else {
            $isSent = false;
        }
        // удалить сохраненнный ранее билет $newFileName после отправки письма
        @unlink($newFileName);
        @unlink($newFileNameMk);
        return $isSent;
    }

    public static function setQueueTicketViaEmail($userId = 0) {
        // поставить таск в очередь для асинхронной отправки
        $qm = new QueueMysqlManager();
        $qm->savePlaceTask("sendticketviaemail", null, serialize(array("userId" => $userId)));
    }

    public static function sendTicketViaEmail($userId = 0) {
        // данная функция вызывается на проде при регенерации билета
        self::setQueueTicketViaEmail($userId);
    }
}