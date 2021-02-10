<?php

/**
 * Ajax-овый контрол для запросов из html
 */
class AjaxControl extends BaseControl implements IAjaxControl {

    public function render() {
        $actor = Context::getActor();
        $job = Request::getVar("job");
        $time = time();
        
        // Получение данных о новом пользователе
        if ($job == "register") {
            $email       = FilterInput::add(new StringFilter("email", true, "E-Mail"));
            $lastname    = FilterInput::add(new StringFilter("lastname", true, "Фамилия"));
            $name        = FilterInput::add(new StringFilter("name", true, "Имя"));
            $tsBorn      = FilterInput::add(new StringFilter("tsBorn", false, "Дата рождения"));
            $countryName = FilterInput::add(new StringFilter("country", true, "Страна"));
            $cityName    = FilterInput::add(new StringFilter("city", true, "Город"));
            $company     = FilterInput::add(new StringFilter("company", false, "Компания"));
            $position    = FilterInput::add(new StringFilter("position", true, "Должность"));
            $usersize    = FilterInput::add(new StringFilter("usersize", true, "Размер одежды"));

            // Приведем полученый ящик к нижнему регистру
            $email = mb_strtolower($email);
            
            if (!FilterInput::isValid()) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = 'The following mandatory fields not filled in:'."\r".implode("\r", FilterInput::getMessages());
                } else {
                    $array['msg'] = 'Не заполнены обязательные поля:'."\r".implode("\r", FilterInput::getMessages());
                }
                echo json_encode($array);
                exit;
            }
            
            $um = new UserManager();
            $user = null;
            if ($actor->parentUserId) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = '';
                } else {
                    $array['msg'] = 'Вы не можете добавлять участников';
                }
                echo json_encode($array);
                exit;
            } else {
                $user = $actor;
            }
            
            $userObj = $um->getById($user->id);
            
            $emailIsNotUnique = false;
            $emailsUsers = $um->getUsersByEmail($email);
            $confirmEmailsUsers = $um->getUsersByConfirmedEmail($email);
            if (is_array($emailsUsers) && count($emailsUsers)) {
                foreach ($emailsUsers AS $emailsUser) {
                    if ($emailsUser->id != $userObj->id && strtolower($email) == strtolower($emailsUser->email)) {
                        $emailIsNotUnique = true;
                        break;
                    }
                }
            }

            if (is_array($confirmEmailsUsers) && count($confirmEmailsUsers)) {
                foreach ($confirmEmailsUsers AS $emailsUser) {
                    if ($emailsUser->id != $userObj->id && strtolower($email) == strtolower($emailsUser->email)) {
                        $emailIsNotUnique = true;
                        break;
                    }
                }
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = 'Invalid E-Mail Format';
                } else {
                    $array['msg'] = 'Неверный формат E-Mail';
                }
                echo json_encode($array);
                exit;
            }

            if ($emailIsNotUnique) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = 'E-Mail entered was specified by another participant';
                } else {
                    $array['msg'] = 'Указанный E-Mail занят другим участником';
                }
                echo json_encode($array);
                exit;
            }

            if (!$userObj || $user->id != $userObj->id) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = 'No user found';
                } else {
                    $array['msg'] = 'Не найден пользователь';
                }
                echo json_encode($array);
                exit;
            } else {
               // deb($tsBorn);
                $userObj->lastname    = $lastname;
                $userObj->name        = $name;
                $userObj->tsBorn      = ($tsBorn) ? strtotime($tsBorn) : "";
                $userObj->countryName = $countryName;
                $userObj->cityName    = $cityName;
                $userObj->company     = preg_replace('/\&quot;([^\"]*)\&quot;/ismU', "«$1»", $company);
                $userObj->position    = $position;
                $userObj->userSize    = $usersize;

                if ( ($email != $userObj->confirmedEmail) && ($email != $userObj->email) && (!EmailConfirmAttemptManager::hasAttemptLast2Minutes($email)) ) {
                    $confirmCode = substr(Utils::getGUID(), 0, 10);
                    // записать попытку в лог
                    EmailConfirmAttemptManager::add($email, $confirmCode, $userObj->id);
                    usleep(5000);
                    // отправить письмо на подтверждение мыла
                    UserManager::sendConfirmCodeEmail($email, $confirmCode, $userObj->id);
                    usleep(5000);
                }

                $userObj->email = $email;
                $userObj = $um->save($userObj);

                // обновить QR код
                UserManager::createQrCode($userObj->id); //$qrmObj = 
                UserManager::updateUser4App($userObj);
                usleep(1500);
            }
            $array['error'] = 0;
            if ($this->lang == 'en') {
                $array['msg'] = 'Your data has been saved, now you can proceed to shopping!';
            } else {
                $array['msg'] = 'Данные сохранены, теперь вы можете перейти к следующему этапу!';
            }
            echo json_encode($array);
            exit;
        }

        if ($job == "check_unsubscribe") {
            require_once APPLICATION_DIR . '/Lib/Swift/Mail.php';
            $email = Request::getVar("email");
            $checkResult = Mail::checkUnsubscribe($email);
            $arr['unsubscribe'] = ($checkResult->is_unsubscribed) ? 1 : 0;

            echo json_encode($arr);
            exit;
        }
		
		// Создание записи в таблице оплаты для ApplePay
		if ($job == "apple_pay") {
            $array['error'] = 0;
			// сколько покупатель видел в корзине
			//$total = floatval(Request::getVar('total'));
			//$mode  = Request::getVar('mode');
			// по пользователю
			$um    = new UserManager();
			$umObj = $um->getById($this->actor->id);
			// сколько по рассчетам
			$needAmount = 0;
			 // проверить заполнен ли профайл пользователя
			UserManager::redirectIfNoProfile($this->actor);
			
			if (!Configurator::get("rfi:rfi_enable")) {
                $array['msg'] = "Оплата отключена, обратитесь в администрацию сайта";
                echo json_encode($array);
				exit;
			}
			
			// надо найти сумму по действующему бронированию
			// на эту сумму надо уменьшить стоимость, включить данное число в скидку
			// уменьшать надо после скидки
			$bookbman = new BookingManager();
			// что в корзине по основному билету
			$bm = new BasketManager();
			$purchasedTicketIds = [];
			$purchasedTickets = ($umObj->parentUserId) ? $bm->getTicketsByChildId($this->actor->id) : $bm->getTicketsByUserId($this->actor->id);
			// далее покупка
			if (count($purchasedTickets)) {
				foreach ($purchasedTickets AS $purchasedTicket) {
					if ($purchasedTicket['needAmount'] - $purchasedTicket['payAmount'] - $purchasedTicket['ulAmount'] + $purchasedTicket['returnedAmount'] - $purchasedTicket['discountAmount'] > 0) {
						$purchasedTicketIds[] = $purchasedTicket['id'];
						$needTicketAmount = $purchasedTicket['needAmount'] - $purchasedTicket['payAmount'] - $purchasedTicket['ulAmount'] + $purchasedTicket['returnedAmount'] - $purchasedTicket['discountAmount'];
						// если было бронирование
						$basket = $bm->getById($purchasedTicket['id']);
						if ($basket) {
							$bookings = ($basket->childId) ? $bookbman->getActiveByChildId($basket->childId) : $bookbman->getActiveByUserIdNoChildren($basket->userId);
							$booking = null;
							if (isset($bookings[0])) {
								$booking = $bookings[0];
								// уменьшим сумму долга
								$needTicketAmount = $needTicketAmount - $booking->payAmount;
							}
							$needTicketAmount = ($needTicketAmount > 0) ? $needTicketAmount : 0;
						}
						$needAmount = $needAmount + $needTicketAmount;
					}
				}
			}
			
			// что в корзине по мастер-классам
			$bpm = new BasketProductManager();
			$purchasedProductIds = [];
			$purchasedProducts = ($umObj->parentUserId) ? $bpm->getProductsByChildId($this->actor->id) : $bpm->getProductsByUserId($this->actor->id);
			if (count($purchasedProducts)) {
				foreach ($purchasedProducts AS $purchasedProduct) {
					if ($purchasedProduct['needAmount'] - $purchasedProduct['payAmount'] - $purchasedProduct['ulAmount'] + $purchasedProduct['returnedAmount'] - $purchasedProduct['discountAmount'] > 0) {
						$purchasedProductIds[] = $purchasedProduct['id'];
						$needProductAmount = $purchasedProduct['needAmount'] - $purchasedProduct['payAmount'] - $purchasedProduct['ulAmount'] + $purchasedProduct['returnedAmount'] - $purchasedProduct['discountAmount'];

						$basketProduct = $bpm->getById($purchasedProduct['id']);
						if ($basketProduct) {
							// если было бронирование
							$bookings = ($basketProduct->childId) ? $bookbman->getActiveByChildId($basketProduct->childId) : $bookbman->getActiveByUserIdNoChildren($basketProduct->userId);
							$booking = null;
							// TODO: если попросят, надо предоставить скидку но только один раз!
							if (isset($bookings[0])) {
								$booking = $bookings[0];
								// уменьшим сумму долга
								// $needProductAmount = $needProductAmount - $booking->payAmount;
							}
							$needProductAmount = ($needProductAmount > 0) ? $needProductAmount : 0;
						}
						$needAmount = $needAmount + $needProductAmount;
					}
				}
			}

			//deb($needAmount);
			//if ( ($umObj->ulBalance !== 0) && ($needAmount >= $umObj->ulBalance) ) {
			 //   $needAmount = $needAmount - $umObj->ulBalance;
			//}

			$paym = new PayManager();
			if (!$needAmount) {
				$paym->markOrderPayed($purchasedTicketIds, $purchasedProductIds, $this->actor->id);
				if ($this->lang == 'en') {
                    $array['msg'] = "You've been granted 100% discount";
                    echo json_encode($array);
                    exit;
				} else {
                    $array['msg'] = "Вам была предоставлена скидка 100%";
                    echo json_encode($array);
                    exit;
				}
			} else {
				// создаем новую запись в таблице Pay
				$paymObj = new Pay();
				$paymObj->userId = $this->actor->id;
				$paymObj->needAmount = $needAmount;
				$paymObj->status = Pay::STATUS_NEW;
				$paymObj->type = Pay::TYPE_CARD;
				$paymObj->tsCreated = time();
				$paymObj->payForTicketIds = serialize($purchasedTicketIds);
				$paymObj->payForProductIds = serialize($purchasedProductIds);
				$paymObj = $paym->save($paymObj);

				$array['amount'] = $needAmount;
				$array['orderNumber'] = $paymObj->id;
				$array['msg'] = ($this->lang == 'en') ? "Order payment" : "Оплата заказа";

                echo json_encode($array);
                exit;
			}

            $array['error'] = 1;
            $array['msg'] = ($this->lang == 'en') ? "Unknown error" : "Неизвестная ошибка";
            echo json_encode($array);
            exit;
		}

        // Получить данные старого пользователя
        if ($job == "loadOldUserData") {
            $phone = $this->actor->phone;
            $array['error'] = 0;

            $um = new UserManager();
            $sql = "SELECT * FROM `oldusers` WHERE `phone` LIKE '{$phone}%'";
            $res = $um->getByAnySQL($sql);
            if ($res[0]) {
                $array['user'] = $res[0];
            } else {
                $array['error'] = 2;
            }
            echo json_encode($array);
            exit;
        }

        // Получение данных о дополнительном участнике
        if ($job == "add_user") {
            $phone       = Phone::phoneVerification(Request::getVar("phone"));
            $email       = FilterInput::add(new StringFilter("email",    true, "E-Mail"));
            $lastname    = FilterInput::add(new StringFilter("lastname", true, "Фамилия"));
            $name        = FilterInput::add(new StringFilter("name",     true, "Имя"));
            $country     = FilterInput::add(new StringFilter("country",  true, "Страна"));
            $city        = FilterInput::add(new StringFilter("city",     true, "Город"));
            $company     = FilterInput::add(new StringFilter("company",  true, "Компания"));
            $position    = FilterInput::add(new StringFilter("position", true, "Должность"));
            $usersize    = FilterInput::add(new StringFilter("usersize", true, "Размер одежды"));

            // Приведем полученый ящик к нижнему регистру
            $email = mb_strtolower($email);

            if ($phone["isError"]) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = $phone["description"];
                } else {
                    $array['msg'] = $phone["description"];
                }
                echo json_encode($array);
                exit;
            } else {
                $phone = $phone["number"];
            }

            if (!FilterInput::isValid()) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = 'The following mandatory fields not filled in:'."\r".implode("\r", FilterInput::getMessages());
                } else {
                    $array['msg'] = 'Не заполнены обязательные поля:'."\r".implode("\r", FilterInput::getMessages());
                }
                echo json_encode($array);
                exit;
            }

            // проверка уникальности $phone и $email
            $um = new UserManager();
            if ($um->getByPhone($phone)) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = "Mobile number entered not unique";
                } else {
                    $array['msg'] = "Указанный номер мобильного уже используется";
                }
                echo json_encode($array);
                exit;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = "Invalid E-Mail Format";
                } else {
                    $array['msg'] = "Неверный формат E-Mail";
                }
                echo json_encode($array);
                exit;
            }

            if (($um->getByEmail($email)) || ($um->getByConfirmedEmail($email))) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = "E-mail entered not unique";
                } else {
                    $array['msg'] = "Указанный E-mail уже используется";
                }
                echo json_encode($array);
                exit;
            }

            // всё в норме, добавим нового пользователя
            $user = new User();
            $user->parentUserId = $this->actor->id;
            $user->phone = $phone;
            $user->name = $name;
            $user->lastname = $lastname;
            $user->countryName = $country;
            $user->cityName = $city;
            $user->company = $company;
            $user->position = $position;
            $user->userSize = $usersize;
            $user->tsCreated = time();
            $user->tsRegister = time();
            $user->status = User::STATUS_REGISTERED;
            $user->type = User::TYPE_USER;
            $user->typeId = 8;
            $user->lang = $this->lang;
            $user = $um->save($user);
            $user->disableBroadcastKey = md5($user->id . $user->tsCreated);
            $user = $um->save($user);
            
            if ( ($email != $user->confirmedEmail) && ($email != $user->email) && (!EmailConfirmAttemptManager::hasAttemptLast2Minutes($email)) ) {
                $confirmCode = substr(Utils::getGUID(), 0, 10);
                // записать попытку в лог
                EmailConfirmAttemptManager::add($email, $confirmCode, $user->id);
                usleep(5000);
                // отправить письмо на подтверждение мыла
                UserManager::sendConfirmCodeEmail($email, $confirmCode, $user->id);
                usleep(5000);
            }
            
            $user->email = $email;
            $user = $um->save($user);
            
            $array['error'] = 0;
            if ($this->lang == 'en') {
                $array['msg'] = 'Participant added!';
            } else {
                $array['msg'] = 'Участник добавлен!';
            }
            echo json_encode($array);
            exit;
        }

        // Получение данных о дополнительном участнике
        if ($job == "edit_user") {
            //die();
            $id          = FilterInput::add(new StringFilter("id",       true, "ID"));
            $email       = FilterInput::add(new StringFilter("email",    true, "E-Mail"));
            $lastname    = FilterInput::add(new StringFilter("lastname", true, "Фамилия"));
            $name        = FilterInput::add(new StringFilter("name",     true, "Имя"));
            $country     = FilterInput::add(new StringFilter("country",  true, "Страна"));
            $city        = FilterInput::add(new StringFilter("city",     true, "Город"));
            $company     = FilterInput::add(new StringFilter("company",  true, "Компания"));
            $position    = FilterInput::add(new StringFilter("position", true, "Должность"));
            $usersize    = FilterInput::add(new StringFilter("usersize", true, "Размер одежды"));

            // Приведем полученый ящик к нижнему регистру
            $email = mb_strtolower($email);

            if (!FilterInput::isValid()) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = 'The following mandatory fields not filled in:'."\r".implode("\r", FilterInput::getMessages());
                } else {
                    $array['msg'] = 'Не заполнены обязательные поля:'."\r".implode("\r", FilterInput::getMessages());
                }
                echo json_encode($array);
                exit;
            }

            // проверка уникальности $phone и $email
            $um = new UserManager();

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if ($this->lang == 'en') {
                    $array['msg'] = "Invalid E-Mail Format";
                } else {
                    $array['msg'] = "Неверный формат E-Mail";
                }
                echo json_encode($array);
                exit;
            }

            $userObj = $um->getById($id);

            $emailIsNotUnique = false;
            $emailsUsers = $um->getUsersByEmail($email);
            $confirmEmailsUsers = $um->getUsersByConfirmedEmail($email);
            if (is_array($emailsUsers) && count($emailsUsers)) {
                foreach ($emailsUsers AS $emailsUser) {
                    if ($emailsUser->id != $userObj->id && strtolower($email) == strtolower($emailsUser->email)) {
                        $emailIsNotUnique = true;
                        break;
                    }
                }
            }

            if (is_array($confirmEmailsUsers) && count($confirmEmailsUsers)) {
                foreach ($confirmEmailsUsers AS $emailsUser) {
                    if ($emailsUser->id != $userObj->id && strtolower($email) == strtolower($emailsUser->email)) {
                        $emailIsNotUnique = true;
                        break;
                    }
                }
            }

            if ($emailIsNotUnique) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = 'E-Mail entered was specified by another participant';
                } else {
                    $array['msg'] = 'Указанный E-Mail уже зарегистрирован другим участником';
                }
                echo json_encode($array);
                exit;
            }

            if ( (!$userObj) || ($id != $userObj->id) || ($userObj->parentUserId != $actor->id) ) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = 'No user found';
                } else {
                    $array['msg'] = 'Не найден пользователь';
                }
                echo json_encode($array);
                exit;
            } else {
                $userObj->lastname    = $lastname;
                $userObj->name        = $name;
                $userObj->countryName = $country;
                $userObj->cityName    = $city;
                $userObj->company     = preg_replace('/\&quot;([^\"]*)\&quot;/ismU', "«$1»", $company);
                $userObj->position    = $position;
                $userObj->userSize    = $usersize;
                $userObj->typeId      = 8; // ID участника

                if ( ($email != $userObj->confirmedEmail) && ($email != $userObj->email) && (!EmailConfirmAttemptManager::hasAttemptLast2Minutes($email)) ) {
                    $confirmCode = substr(Utils::getGUID(), 0, 10);
                    // записать попытку в лог
                    EmailConfirmAttemptManager::add($email, $confirmCode, $userObj->id);
                    usleep(5000);
                    // отправить письмо на подтверждение мыла
                    UserManager::sendConfirmCodeEmail($email, $confirmCode, $userObj->id);
                    //usleep(5000);
                }

                $userObj->email = $email;
                $userObj = $um->save($userObj);

                // обновить QR код
                UserManager::createQrCode($userObj->id); //$qrmObj = 
                UserManager::updateUser4App($userObj);
                //usleep(1500);
            }
            $array['error'] = 0;
            if ($this->lang == 'en') {
                $array['msg'] = 'Your data has been saved!';
            } else {
                $array['msg'] = 'Данные сохранены!';
            }
            echo json_encode($array);
            exit;
        }

        // Сохраняем реквизиты юр лица
        if ($job == "save_details") {
            /**
             * Полное наименование, ИНН(10 цифр для юр.лиц или 12 цифр для ИП),
             * КПП только для юрлиц(9 цифр), БИК (9 цифр), Корреспондентский счет (К/сч) (20 цифр),
             * Расчетный счет (Р/сч) (20 цифр). Все ячейки обязательны к заполнению! */
            // надо, остальное не надо
            $company       = FilterInput::add(new StringFilter("company", true, "Компания"));
            $company_type  = (int) FilterInput::add(new StringFilter("company_type", true, "Юридический статус"));
            $inn           = FilterInput::add(new StringFilter("inn", true, "ИНН", 12, 10));
            $kpp           = FilterInput::add(new StringFilter("kpp", false, "КПП"));
            $address       = FilterInput::add(new StringFilter("address", false, "Адрес"));

            if (!FilterInput::isValid()) {
                $array['error'] = 1;
                $array['msg'] = FilterInput::getMessages();
                echo json_encode($array);
                exit;
            }

            $udmObj = null;
            $udm = new UserDetailsManager();
            $udmObj = $udm->getByUserId($this->actor->id);

            if (!$udmObj) {
                $udmObj = new UserDetails();
                $udmObj->userId = $this->actor->id;
                $udmObj->tsCreated = time();
                $udmObj->status = UserDetails::STATUS_NEW;
            }
            $udmObj->company       = preg_replace('/\&quot;([^\"]*)\&quot;/ismU', "«$1»", $company);
            $udmObj->company_type  = $company_type;
            $udmObj->inn           = $inn;
            $udmObj->kpp           = $kpp;
            $udmObj->address       = $address;
            $udmObj->tsUpdated     = time();
            $udmObj                = $udm->save($udmObj);

            // уходим на генерацию счёта на оплату если указана сумма
            $array['error'] = 0;
            if ($this->lang == 'en') {
                $array['msg'] = 'Details recorded';
            } else {
                $array['msg'] = 'Реквизиты записаны';
            }
            echo json_encode($array);
            exit;
        }

        // получить смс код
        if ($job == "usergetcode") {
            $phone = Phone::phoneVerification(Request::getVar("phone"));
//deb($phone);
            if ( (!$phone["isError"]) && (!Phone::phoneDadataVerification($phone["number"])) ) {
                echo json_encode('90');
                exit;
            }

            $isNew = false;
            $youAboutUs = 'empty';
            $button = Request::getVar("button");

            $code = ($button == 'reg_get_phone') ? null : (int) Request::getVar("code");

            if ($button == 'reg_get_phone' && $phone["isError"]) { // попытка получения кода; номер неверный
                echo json_encode($phone["code"]);
                exit;
            } else if ($button == 'reg_get_phone' && !$phone["isError"]) { // попытка получения кода; номер верный
                $smsCode = rand(1000, 9999); // смс код, сформировать
                $um = new UserManager();
                $userObj = $um->getByPhone($phone["number"]); // добавить code в таблицу user
                // если не было попытки регистрации минуту или менее назад, то
                // отправить сообщение с кодом по смс
                if (!RegisterAttemptManager::hasAttemptLast2Minutes($phone["number"])) {
                    if (!$userObj) {
                        $userObj = UserManager::add($phone["number"], $youAboutUs, $smsCode, UIGenerator::getLang());
                        $isNew = true;
                    } else {
                        $userObj->youAboutUs = $youAboutUs;
                        $userObj->code = $smsCode;
                        $userObj = $um->save($userObj);
                    }
                    // попытка регистрации, зафиксировать
                    RegisterAttemptManager::add($phone["number"], $smsCode);

                    // отправка
                    if (UserManager::sendRegisterCodeSms($phone["number"], $smsCode, $userObj->id)) {
                        if ($isNew) {
                            echo json_encode("donephone_new");
                        } else {
                            echo json_encode("donephone");
                        }
                    } else {
                        echo json_encode("nosmsphone");
                    }
                } else {
                    echo json_encode("toooften");
                }
                exit;
            } else if ($button == 'reg_get_code' && $phone["isError"]) { // попытка подтверждения кода; номер неверный
                echo json_encode($phone["code"]);
                exit;
            } else if ($button == 'reg_get_code' && !$phone["isError"] && !$code) { // попытка подтверждения кода; номер верный; код неуказан
                echo json_encode("nocode");
                exit;
            } else if ($button == 'reg_get_code' && !$phone["isError"] && $code) { // попытка подтверждения кода; номер верный; код указан
                // проверить верен ли код
                // поменять статус пользователя на STATUS_REGISTERED
                $um = new UserManager();
                $userObj = $um->getByPhoneAndCode($phone["number"], $code);
                if (!$userObj) {
                    echo json_encode("wrongcode");
                    exit;
                } else {
                    if ($userObj->status == User::STATUS_REGISTERED) {
                        Context::logOff();
                        Context::clearObject("__child");
                        Context::clearObject("__user");
                        Context::clearObject("__master");
                        Context::setActor($userObj);
                        if ( ($userObj->baseTicketId) || ($userObj->ulBalance > 0) ) {
                            echo json_encode("redirectToBasket");
                        } else {
                            echo json_encode("redirectToRegister");
                        }
                    } else {
                        $userObj->tsRegister = time();
                        $userObj->status = User::STATUS_REGISTERED;
                        $userObj = $um->save($userObj);
                        Context::logOff();
                        Context::clearObject("__child");
                        Context::clearObject("__user");
                        Context::clearObject("__master");
                        Context::setActor($userObj);
                        echo json_encode("redirectToTicket");
                    }
                    exit;
                }
            }
        }

        // поискать промо-код скидки и применить её, если найдена
        if ($job == "applybasketdiscount") {
            $bookbman = new BookingManager();
            if (!$actor) {
                echo json_encode("noactor");
                exit;
            }
            $code = Request::getVar("code");
            $userId = Request::getInt("user");
            if (!$code || !$userId) {
                echo json_encode("noinputdata");
                exit;
            }
            $um = new UserManager();
            $userObj = $um->getById($userId);
            // скидка
            $dm = new DiscountManager();
            $discount = $dm->getByCode($code);
            if (!$userObj || !$discount) {
                echo json_encode("noobjects");
                exit;
            }
            if ($actor->id != $userObj->id && $actor->id != $userObj->parentUserId) {
                echo json_encode("norights");
                exit;
            }

            $shouldRefreshBasket = false;
            $shouldGenerateQrCode = false;

            Logger::info("ApplyBasketDiscount before transaction");
            Logger::info("user:");
            Logger::info($userObj);
            Logger::info("discount:");
            Logger::info($discount);

            $um->startTransaction();
            try {
                // записать скидку в корзину по основному билету, если тип билета совпадает
                $bm = new BasketManager();
                if ($userObj->parentUserId) {
                    $purchasedTickets = $bm->getTicketsByChildId($userId);
                } else {
                    $purchasedTickets = $bm->getTicketsByUserIdNoChildren($userId);
                }

                Logger::info("applybasketdiscount inside transaction");
                Logger::info('AjaxControl purchasedTickets:');
                Logger::info($purchasedTickets);

                // далее покупка
                if (count($purchasedTickets)) {
                    foreach ($purchasedTickets AS $purchasedTicket) {
                        if ($purchasedTicket['needAmount'] - $purchasedTicket['payAmount'] - $purchasedTicket['ulAmount'] + $purchasedTicket['returnedAmount'] - $purchasedTicket['discountAmount'] > 0 && $purchasedTicket['status'] != Basket::STATUS_PAID) {

                            $needAmount = $purchasedTicket['needAmount'] - $purchasedTicket['payAmount'] - $purchasedTicket['ulAmount'] + $purchasedTicket['returnedAmount'];
                            // найти скидку если есть
                            if ($discount) {
                                // применимость скидки
                                $bttdlm = new BaseTicketToDiscountLinkManager();
                                // проверить есть ли у данной скидки применимость к данному билету
                                $baseTicketId = $purchasedTicket['baseTicketId'];
                                $discountToBaseTicketLink = $bttdlm->getBaseTicketByDiscountIdBaseTicketId($discount->id, $baseTicketId);
                                if ($discountToBaseTicketLink) {
                                    // запишем данные о скидке в корзину
                                    $baseTicketObj = $bm->getById($purchasedTicket['id']);
                                    if (!$baseTicketObj->discountId && $baseTicketObj->status == Basket::STATUS_NEW) {
                                        $shouldRefreshBasket = true;
                                        $discountAmount = round($needAmount * $discount->percent / 100);
                                        $needAmount = ( ($needAmount - $discountAmount) > 0) ? ($needAmount - $discountAmount) : 0;
                                        // запись данных
                                        $baseTicketObj->discountAmount = $discountAmount;
                                        $baseTicketObj->discountId = $discount->id;
                                        $baseTicketObj->discountCode = $discount->code;
                                        $baseTicketObj->discountPercent = $discount->percent;
                                        $baseTicketObj->discountType = $discount->type;
                                        $baseTicketObj->discountUserTypeId = $discount->userTypeId;
                                        if ($needAmount == 0) {
                                            $shouldGenerateQrCode = true;
                                            $baseTicketObj->tsPay = time();
                                            $baseTicketObj->status = Basket::STATUS_PAID;
                                            // надо погасить бронирование
                                            if ($baseTicketObj->childId) {
                                                $bookbman->setAsFinishedAllActiveByChildId($baseTicketObj->childId);
                                            } else {
                                                $bookbman->setAsFinishedAllActiveByUserId($baseTicketObj->userId);
                                            }
                                        }
                                        $baseTicketObj = $bm->save($baseTicketObj);
                                        // надо ли установить данному пользователю тип, который указан в скидке
                                        if ($discount->userTypeId) {
                                            $userObj->typeId = $discount->userTypeId;
                                            $userObj->type = User::TYPE_STAFF;
                                            $userObj = $um->save($userObj);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                // что в корзине по мастер-классам
                $bpm = new BasketProductManager();
                $purchasedProductIds = array();
                if ($userObj->parentUserId) {
                    $purchasedProducts = $bpm->getProductsByChildId($userId);
                } else {
                    $purchasedProducts = $bpm->getProductsByUserIdNoChildren($userId);
                }

                Logger::info('AjaxControl purchasedProducts:');
                Logger::info($purchasedProducts);

                if (count($purchasedProducts)) {
                    foreach ($purchasedProducts AS $purchasedProduct) {
                        if ($purchasedProduct['needAmount'] + $purchasedProduct['returnedAmount'] > $purchasedProduct['payAmount'] + $purchasedProduct['ulAmount']) {
                            $purchasedProductIds[] = $purchasedProduct['id'];
                            $needProductAmount = $purchasedProduct['needAmount'] - $purchasedProduct['payAmount'] - $purchasedProduct['ulAmount'] + $purchasedProduct['returnedAmount'];
                            // применение скидки
                            if ($discount) {
                                $pm = new ProductManager();
                                $atdlm = new AreaToDiscountLinkManager();
                                // проверить есть ли у данной скидки применимость к areaId данного мастер-класса
                                $productId = $purchasedProduct['productId'];
                                $productObj = $pm->getById($productId);
                                if ($productObj) {
                                    $discountToAreaLink = $atdlm->getAreaByDiscountIdAreaId($discount->id, $productObj->areaId);
                                    if ($discountToAreaLink) {
                                        // запишем данные о скидке в корзину
                                        $basketProductObj = $bpm->getById($purchasedProduct['id']);
                                        if (!$basketProductObj->discountId && $basketProductObj->status == BasketProduct::STATUS_NEW) {
                                            $shouldRefreshBasket = true;
                                            $discountAmount = round($needProductAmount * $discount->percent / 100);
                                            $needProductAmount = ($needProductAmount - $discountAmount > 0) ? ($needProductAmount - $discountAmount) : 0;
                                            // запись данных
                                            $basketProductObj->discountAmount = $discountAmount;
                                            $basketProductObj->discountId = $discount->id;
                                            $basketProductObj->discountCode = $discount->code;
                                            $basketProductObj->discountPercent = $discount->percent;
                                            $basketProductObj->discountType = $discount->type;
                                            $basketProductObj->discountUserTypeId = $discount->userTypeId;
                                            if ($needProductAmount == 0) {
                                                $shouldGenerateQrCode = true;
                                                $basketProductObj->tsPay = time();
                                                $basketProductObj->status = BasketProduct::STATUS_PAID;
                                                // надо погасить бронирование
                                                if ($basketProductObj->childId) {
                                                    $bookbman->setAsFinishedAllActiveByChildId($basketProductObj->childId);
                                                } else {
                                                    $bookbman->setAsFinishedAllActiveByUserId($basketProductObj->userId);
                                                }
                                            }
                                            $basketProductObj = $bpm->save($basketProductObj);
                                            // надо ли установить данному пользователю тип, который указан в скидке
                                            if ($discount->userTypeId) {
                                                $userObj->typeId = $discount->userTypeId;
                                                $userObj->type = User::TYPE_STAFF;
                                                $userObj = $um->save($userObj);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                // погасить скидку если одноразовая
                if ($shouldRefreshBasket && $discount->type == Discount::TYPE_DISPOSABLE) {
                    $discount->status = Discount::STATUS_USED;
                    $discount = $dm->save($discount);
                }
            } catch (Exception $e) {
                $um->rollbackTransaction();
                Logger::error($e);
                echo json_encode("transactionerror");
                exit;
            }
            $um->commitTransaction();

            if ($shouldGenerateQrCode == true) {
                UserManager::createQrCode($userObj->id);
                UserManager::sendTicketViaEmail($userObj->id);
            }
            if ($shouldRefreshBasket) {
                echo json_encode("refreshbasket");
                exit;
            }

            echo json_encode("noaction");
            exit;
        }
        
        // получить смс код
        if ($job == "booking_plus") {
            $id = Request::getInt("id");
            $day = 86400;
            $bm = new BookingManager();
            $bmList = $bm->getById($id);
            if ($bmList) {
                if ($bmList->status == Booking::STATUS_PAID) {
                    $bmList->tsFinish = $bmList->tsFinish + $day;
                    $bmList = $bm->save($bmList);
                    $array['error'] = 0;
                    $array['msg'] = date('d.m.Y, в H:i', $bmList->tsFinish);
                    echo json_encode($array);
                    exit;
                } else {
                    $array['error'] = 1;
                    $array['msg'] = 'Бронь не оплачена';
                    echo json_encode($array);
                    exit;
                }
            } else {
                $array['error'] = 1;
                $array['msg'] = 'noBooking';
                echo json_encode($array);
                exit;
            }
        }

        // получить пикера
        if ($job == "get_speaker") {
            $id = Request::getInt("id");
            $sm = new SpeakerManager();
            $speaker = $sm->getById($id);
            $parthner_pic = '';
            if ($speaker->partner_id) {
                $pm = new ParthnerManager();
                $parthner = $pm->getById($speaker->partner_id);
                $parthner_pic = $parthner->pic;
            }
            if ($speaker) {
                $arr = explode(" ", $speaker->tags);
                $str = '';
                $strcss = '';
                foreach ($arr as $v) {
                    $tmp = str_replace("#", "", mb_strtolower($v));
                    $tmp = Enviropment::translit($tmp);
                    $str .= "<span class=\"tag_".$tmp."\">".$v."</span>";
                    $strcss .= " tag_".$tmp;
                }

                $array['error'] = 0;
                $array['name'] = $speaker->name;
                $array['secondName'] = $speaker->secondName;
                $array['company'] = $speaker->company;
                $array['country'] = $speaker->country;
                $array['cityName'] = $speaker->cityName;
                $array['position'] = $speaker->position;
                $array['pic1'] = $speaker->pic1;
                $array['pic2'] = $parthner_pic;
                $array['tags'] = $str;
                $array['tagscss'] = $strcss;
                $array['description'] = htmlspecialchars_decode($speaker->description);
                $array['facebook'] = $speaker->facebook;
                $array['vk'] = $speaker->vk;
                $array['instagram'] = $speaker->instagram;
                $array['twitter'] = $speaker->twitter;
                $array['site'] = $speaker->site;
                $array['tsUpdated'] = $speaker->tsUpdated;

                echo json_encode($array);
                exit;
            } else {
                $array['error'] = 1;
                $array['msg'] = 'noSpeaker';
                echo json_encode($array);
                exit;
            }
        }

        // получить народного спикера
        if ($job == "get_folk_speaker") {
            $id = Request::getInt("id");
            $fsm = new FolkSpeakerManager();
            $speaker = $fsm->getById($id);

            if ($speaker) {
                $array['error'] = 0;
                $array['status'] = $speaker->status;
                $array['first_name'] = $speaker->first_name;
                $array['last_name'] = $speaker->last_name;
                $array['user_type'] = $speaker->user_type;
                $array['phone'] = $speaker->phone;
                $array['email'] = $speaker->email;
                $array['company'] = $speaker->company;
                $array['position'] = $speaker->position;
                $array['description'] = htmlspecialchars_decode($speaker->description);
                $array['photo'] = $speaker->photo;
                $array['video'] = $speaker->video;
                $array['instagram'] = $speaker->instagram;
                $array['facebook'] = $speaker->facebook;
                $array['vkontakte'] = $speaker->vkontakte;
                $array['ondoklassniki'] = $speaker->ondoklassniki;
                $array['sort_order'] = $speaker->sort_order;
                $array['ts_update'] = $speaker->ts_update;

                echo json_encode($array);
                exit;
            } else {
                $array['error'] = 1;
                $array['msg'] = 'noSpeaker';
                echo json_encode($array);
                exit;
            }
        }
        
        // получить смс код
        if ($job == "start_test") {
            $com = new ChefOlimpicManager();
            $comItem = $com->getByUserId($this->actor->id);
            if ($comItem) {
                $array['error'] = 1;
                $array['msg'] = 'Вы уже проходили тест';
                echo json_encode($array);
                exit;
            } else {
                $ChefOlimpic = new ChefOlimpic();
                $ChefOlimpic->user_id = $this->actor->id;
                $ChefOlimpic->tsCreated = time();
                $ChefOlimpic->status = ChefOlimpic::STATUS_DISABLED;
                $ChefOlimpic = $com->save($ChefOlimpic);
                $array['error'] = 0;
                $array['msg'] = 'OK';
                echo json_encode($array);
                exit;
            }
        }

        if ($job == "finish_test") {
            $com = new ChefOlimpicManager();
            $comItem = $com->getByUserId($this->actor->id);
            $comItem = $comItem[0];
            if ($comItem) {
                $comItem->status = ChefOlimpic::STATUS_ENABLED;
                $comItem = $com->save($comItem);
                $array['error'] = 0;
                $array['msg'] = 'OK';
                echo json_encode($array);
                exit;
            } else {
                $array['error'] = 1;
                $array['msg'] = 'Неизвестная ошибка';
                echo json_encode($array);
                exit;
            }
        }

        if ($job == "add_memory") {
            $phone = Phone::phoneVerification(Request::getVar("phone"));
            $subject = FilterInput::add(new StringFilter("subject", true, "Тема"));
            $message = FilterInput::add(new StringFilter("message", true, "Сообщение", 1000));
            if ($phone["isError"]) {
                $array['error'] = 1;
                $array['msg'] = $phone["description"];
                echo json_encode($array);
                exit;
            } else {
                $phone = $phone["number"];
            }

            if (!FilterInput::isValid()) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = 'The following mandatory fields not filled in:'."\r".implode("\r", FilterInput::getMessages());
                } else {
                    $array['msg'] = 'Не заполнены обязательные поля:'."\r".implode("\r", FilterInput::getMessages());
                }
                echo json_encode($array);
                exit;
            }

            // проверка $phone
            $um = new UserManager();
            $user = $um->getByPhone($phone);

            if ($user) {
                $mm = new MemoryManager();
                $mmItem = $mm->getByUserId($user->id);
                if ($mmItem) {
                    $array['error'] = 1;
                    $array['msg'] = 'Вы уже оставляли отзыв';
                    echo json_encode($array);
                    exit;
                }
                $basket = new BasketManager();
                if ($user->parentUserId) {
                    $basket = $basket->getTicketsByChildId($user->id);
                } else {
                    $basket = $basket->getTicketByUserId($user->id);
                }
                if (!$basket) {
                    $array['error'] = 1;
                    $array['msg'] = 'Не найден оплаченый билет';
                    echo json_encode($array);
                    exit;
                }
                if ($basket[0]['status'] != Basket::STATUS_PAID) {
                    $array['error'] = 1;
                    $array['msg'] = 'Не найден оплаченый билет';
                    echo json_encode($array);
                    exit;
                }
                $memory = new Memory();
                $memory->user_id = $user->id;
                $memory->subject = $subject;
                $memory->message = $message;
                $memory->status = Memory::STATUS_NEW;
                $memory->ts_created = time();
                $memory = $mm->save($memory);
                $array['error'] = 0;
                $array['msg'] = 'Ваш отзыв отправлен на модерацию, сроко он будет опубликован на сайте';
                UserManager::sendNotifyMemory('ticket@gastreet.com', $user->id);
                echo json_encode($array);
                exit;
            } else {
                $array['error'] = 1;
                $array['msg'] = 'Вы не зарегистрированы на сайте GASTREET';
                echo json_encode($array);
                exit;
            }
        }

        if ($job == "gaz_register") {
            $phone1       = Phone::phoneVerification(Request::getVar("phone1"));
            $phone2       = Phone::phoneVerification(Request::getVar("phone2"));
            $phone3       = Phone::phoneVerification(Request::getVar("phone3"));

            if ($phone1["isError"] || $phone2["isError"] || $phone3["isError"]) {
                $array['error'] = 1;
                $array['msg'] = $phone1["description"];
                $array['msg'] = $phone2["description"];
                $array['msg'] = $phone3["description"];
                echo json_encode($array);
                exit;
            } else {
                $phone1 = $phone1["number"];
                $phone2 = $phone2["number"];
                $phone3 = $phone3["number"];
            }

            if (!FilterInput::isValid()) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = 'The following mandatory fields not filled in:'."\r".implode("\r", FilterInput::getMessages());
                } else {
                    $array['msg'] = 'Не заполнены обязательные поля:'."\r".implode("\r", FilterInput::getMessages());
                }
                echo json_encode($array);
                exit;
            }
            
            if ( ($phone1 == $phone2) || ($phone2 == $phone3) || ($phone1 == $phone3) ) {
                $array['error'] = 1;
                if ($this->lang == 'en') {
                    $array['msg'] = 'Participant numbers must not match.';
                } else {
                    $array['msg'] = 'Номера участников не должны совпадать';
                }
                echo json_encode($array);
                exit;
            }

            // проверка $phone
            $um = new UserManager();
            $user_1 = $um->getByPhone($phone1);
            $user_2 = $um->getByPhone($phone2);
            $user_3 = $um->getByPhone($phone3);
            if ($user_1 && $user_2 && $user_3) {
                //deb('asasd');
                $ggm = new GazGameManager();
                $ggmItem1 = $ggm->getByUserId($user_1->id);
                $ggmItem2 = $ggm->getByUserId($user_2->id);
                $ggmItem3 = $ggm->getByUserId($user_3->id);
                if ($ggmItem1) {
                    $array['error'] = 1;
                    $array['msg'] = $phone1.' уже зарегистрирован на участие в чемпионате';
                    echo json_encode($array);
                    exit;
                }
                if ($ggmItem2) {
                    $array['error'] = 1;
                    $array['msg'] = $phone2.' уже зарегистрирован на участие в чемпионате';
                    echo json_encode($array);
                    exit;
                }
                if ($ggmItem3) {
                    $array['error'] = 1;
                    $array['msg'] = $phone3.' уже зарегистрирован на участие в чемпионате';
                    echo json_encode($array);
                    exit;
                }

                $basket = new BasketManager();
                if ($user_1->parentUserId) {
                    $basket_1 = $basket->getTicketsByChildId($user_1->id);
                } else {
                    $basket_1 = $basket->getTicketByUserId($user_1->id);
                }
                if ($user_2->parentUserId) {
                    $basket_2 = $basket->getTicketsByChildId($user_2->id);
                } else {
                    $basket_2 = $basket->getTicketByUserId($user_2->id);
                }
                if ($user_3->parentUserId) {
                    $basket_3 = $basket->getTicketsByChildId($user_3->id);
                } else {
                    $basket_3 = $basket->getTicketByUserId($user_3->id);
                }
                if (!$basket_1) {
                    $array['error'] = 1;
                    $array['msg'] = $phone1.' не найден оплаченый билет';
                    echo json_encode($array);
                    exit;
                }
                if (!$basket_2) {
                    $array['error'] = 1;
                    $array['msg'] = $phone2.' не найден оплаченый билет';
                    echo json_encode($array);
                    exit;
                }
                if (!$basket_3) {
                    $array['error'] = 1;
                    $array['msg'] = $phone3.' не найден оплаченый билет';
                    echo json_encode($array);
                    exit;
                }
                
                if ($basket_1[0]['status'] != Basket::STATUS_PAID) {
                    $array['error'] = 1;
                    $array['msg'] = $phone1.' не найден оплаченый билет';
                    echo json_encode($array);
                    exit;
                }
                if ($basket_2[0]['status'] != Basket::STATUS_PAID) {
                    $array['error'] = 1;
                    $array['msg'] = $phone2.' не найден оплаченый билет';
                    echo json_encode($array);
                    exit;
                }
                if ($basket_3[0]['status'] != Basket::STATUS_PAID) {
                    $array['error'] = 1;
                    $array['msg'] = $phone3.' не найден оплаченый билет';
                    echo json_encode($array);
                    exit;
                }

                $ggmLastTeam = $ggm->getLastTeamId();
                $ggmLastTeamId = $ggmLastTeam[0]['team'];

                $GazGame = new GazGame();
                $GazGame->user_id = $user_1->id;
                $GazGame->tsCreated = time();
                $GazGame->team = ($ggmLastTeamId+1);
                $GazGame = $ggm->save($GazGame);
                $GazGame = new GazGame();
                $GazGame->user_id = $user_2->id;
                $GazGame->tsCreated = time();
                $GazGame->team = ($ggmLastTeamId+1);
                $GazGame = $ggm->save($GazGame);
                $GazGame = new GazGame();
                $GazGame->user_id = $user_3->id;
                $GazGame->tsCreated = time();
                $GazGame->team = ($ggmLastTeamId+1);
                $GazGame = $ggm->save($GazGame);
                $array['error'] = 0;
                $array['msg'] = 'Ваша команда зарегистрирована на участие в чемпионате';
                echo json_encode($array);
                exit;
            } else {
                if (!$user_1) {
                    $array['error'] = 1;
                    $array['msg'] = $phone1.' не зарегистрирован на сайте GASTREET';
                    echo json_encode($array);
                    exit;
                }
                if (!$user_2) {
                    $array['error'] = 1;
                    $array['msg'] = $phone2.' не зарегистрирован на сайте GASTREET';
                    echo json_encode($array);
                    exit;
                }
                if (!$user_3) {
                    $array['error'] = 1;
                    $array['msg'] = $phone3.' не зарегистрирован на сайте GASTREET';
                    echo json_encode($array);
                    exit;
                }
            }
        }

        if ($job == 'upload') {
            $session_id = Session::getSessionId();
            if (!$session_id) {
                $json['result'] = "error_session";
                echo json_encode($json);die();
            }

            // Пути загрузки файлов
            $path = DOCUMENT_ROOT."/images/folkspeaker/user_photo/";

            // Массив допустимых значений типа файла
            $types = array('image/png', 'image/jpeg', 'application/pdf');
            // Максимальный размер файла
            $size = 8048000;
            // Обработка запроса
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $fileinfo = pathinfo($_FILES['picture']['name']);
                // Проверяем тип файла
                if (!in_array($_FILES['picture']['type'], $types)) {
                    $json['result'] = "error_file_danger";
                    echo json_encode($json);die();
                }
                // Проверяем размер файла
                if ($_FILES['picture']['size'] > $size) {
                    $json['result'] = "error_too_big";
                    echo json_encode($json);die();
                }
                $filename = $session_id.'.'.$fileinfo['extension'];

                // Загрузка файла и вывод сообщения
                if (!@copy($_FILES['picture']['tmp_name'], $path . $filename)) {
                    $json['result'] = "error_upload";
                    echo json_encode($json);die();
                } else {
                    $json['file'] = $filename;
                    $json['result'] = "success";
                    echo json_encode($json);die();
                }
            }
            $json['result'] = "error_unknown";
            echo json_encode($json);die();
        }

        if ($job == "sendAnyMsg") {
            $subject = Request::getVar("subject");
            $name = Request::getVar("name");
            $company = Request::getVar("company");
            $city = Request::getVar("pcity");
            $phone = Phone::phoneVerification(Request::getVar("phone"));
            $email = Request::getVar("email");

            $domain = str_replace('www.','',$_SERVER['SERVER_NAME']);
            $ip = $_SERVER['REMOTE_ADDR'];

            $to = "market@gastreet.com";
            $from = "no-reply@".$domain;
            $url = $_SERVER['HTTP_REFERER'];

            $user_agent = $_SERVER["HTTP_USER_AGENT"];
            if (strpos($user_agent, "Firefox") !== false) $browser = "Firefox";
            elseif (strpos($user_agent, "Opera") !== false) $browser = "Opera";
            elseif (strpos($user_agent, "Chrome") !== false) $browser = "Chrome";
            elseif ( (strpos($user_agent, "MSIE") !== false) || (strpos($user_agent, "Edge") !== false) ) $browser = "Internet Explorer";
            elseif (strpos($user_agent, "Safari") !== false) $browser = "Safari";
            else $browser = "Неизвестный";

            if ($phone["isError"]) {
                $array['result'] = "error";
                $array['message'] = $phone["description"];
                echo json_encode($array);
                exit;
            } else {
                $phone = $phone["number"];
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $array['result'] = "error";
                $array['message'] = ($this->lang == 'en') ? 'Invalid E-Mail Format':'Неверный формат E-Mail';
                echo json_encode($array);
                exit;
            }

            $subject = "=?UTF-8?B?".base64_encode(trim($subject))."?=";
            $headers  = "MIME-Version: 1.0"."\r\n";
            $headers .= "Content-type: text/plain; charset=utf-8\r\n";
            $headers .= "From: ".$from."\r\n";
            $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
            $mess  = "\nИмя Фамилия: ".trim($name);
            $mess .= "\nКомпания: ".trim($company);
            $mess .= "\nГород: ".trim($city);
            $mess .= "\nEmail: ".trim($email);
            $mess .= "\nТелефон: ".trim($phone);

            $mess .= "\n\n--\nОтправлено со страницы:\n".$url;
            $mess .= "\nIP: ".$ip;
            $mess .= "\nБраузер: ".$browser;

            if ( mail($to, $subject, $mess, $headers) ) {
                $_SESSION['stime'] = time();
                $array['result'] = "success";
                $array['cls'] = "c_success";
                $array['message'] = "Спасибо, сообщение отправлено.";
                echo json_encode($array);
                exit;
            } else {
                $array['result'] = "error";
                $array['cls'] = "c_error";
                $array['message'] = "Ошибка отправки сообщения. Просим связаться с нами по телефону.";
                echo json_encode($array);
                exit;
            }
        }

        if ($job == "sendKidsAction") {
            $subject = "Заявка на GASTREET Kids";
            $name = Request::getVar("name");
            $phone = Phone::phoneVerification(Request::getVar("phone"));
            $email = Request::getVar("email");

            $domain = str_replace('www.','',$_SERVER['SERVER_NAME']);
            $ip = $_SERVER['REMOTE_ADDR'];

            $to = "911@gastreet.com";
            $from = "no-reply@".$domain;
            $url = $_SERVER['HTTP_REFERER'];

            $user_agent = $_SERVER["HTTP_USER_AGENT"];
            if (strpos($user_agent, "Firefox") !== false) $browser = "Firefox";
            elseif (strpos($user_agent, "Opera") !== false) $browser = "Opera";
            elseif (strpos($user_agent, "Chrome") !== false) $browser = "Chrome";
            elseif ( (strpos($user_agent, "MSIE") !== false) || (strpos($user_agent, "Edge") !== false) ) $browser = "Internet Explorer";
            elseif (strpos($user_agent, "Safari") !== false) $browser = "Safari";
            else $browser = "Неизвестный";

            if ($phone["isError"]) {
                $array['result'] = "error";
                $array['message'] = $phone["description"];
                echo json_encode($array);
                exit;
            } else {
                $phone = $phone["number"];
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $array['result'] = "error";
                $array['message'] = ($this->lang == 'en') ? 'Invalid E-Mail Format':'Неверный формат E-Mail';
                echo json_encode($array);
                exit;
            }

            $subject = "=?UTF-8?B?".base64_encode(trim($subject))."?=";
            $headers  = "MIME-Version: 1.0"."\r\n";
            $headers .= "Content-type: text/plain; charset=utf-8\r\n";
            $headers .= "From: ".$from."\r\n";
            $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
            $mess  = "\nИмя Фамилия: ".trim($name);
            $mess .= "\nEmail: ".trim($email);
            $mess .= "\nТелефон: ".trim($phone);

            $mess .= "\n\n--\nОтправлено со страницы:\n".$url;
            $mess .= "\nIP: ".$ip;
            $mess .= "\nБраузер: ".$browser;

            if ( mail($to, $subject, $mess, $headers) ) {
                $_SESSION['stime'] = time();
                $array['result'] = "success";
                $array['cls'] = "c_success";
                $array['message'] = "Спасибо, сообщение отправлено.";
                echo json_encode($array);
                exit;
            } else {
                $array['result'] = "error";
                $array['cls'] = "c_error";
                $array['message'] = "Ошибка отправки сообщения. Просим связаться с нами по телефону.";
                echo json_encode($array);
                exit;
            }
        }

        if ($job == 'get_pass_for_folk_speaker') {
            $smsCode = rand(1000, 9999); // смс код, сформировать
            $speaker_id = Request::getInt("speaker_id");
            $phone = Phone::phoneVerification(Request::getVar("phone"));

            if ( ($phone["isError"]) || (!Phone::phoneDadataVerification($phone["number"])) ) {
                echo json_encode('phone_invalid');
                exit;
            }

            $fpm = new FolkPhonesManager();
            $folkPhone = $fpm->getByPhone($phone["number"]);
            $folkPhone = $folkPhone[0];

            if (!$folkPhone) {
                $folkPhone = new folkPhones();
            } else if ($folkPhone->status == folkPhones::STATUS_CONFIRM) {
                echo json_encode("already_voted");
                exit;
            }
            $folkPhone->phone = $phone["number"];
            $folkPhone->speaker_id = $speaker_id;
            $folkPhone->code = $smsCode;
            $folkPhone->ts_update = time();
            $folkPhone->status = folkPhones::STATUS_NEW;
            $folkPhone = $fpm->save($folkPhone);

            if (UserManager::sendConfirmCodeSms($phone["number"], $smsCode)) {
                echo json_encode("send_ok");
                exit;
            }
        }

        if ($job == 'input_code_for_folk_speaker') {
            $smsCode = Request::getInt("code");
            $phone = Phone::phoneVerification(Request::getVar("phone"));

            if ( ($phone["isError"]) || (!Phone::phoneDadataVerification($phone["number"])) ) {
                echo json_encode('phone_invalid');
                exit;
            }

            $fpm = new FolkPhonesManager();
            $speaker = $fpm->getByPhone($phone["number"]);
            $speaker = $speaker[0];

            if (!$speaker) {
                echo json_encode("phone_not_found");
                exit;
            }
            if ($smsCode == $speaker->code) {
                $speaker->status = folkPhones::STATUS_CONFIRM;
                $speaker = $fpm->save($speaker);
            } else {
                echo json_encode("code_error");
                exit;
            }

            echo json_encode("vote_ok");
            exit;
        }

        if ($job == "sendAnyFolkMsg") {
            $contact_text = Request::getVar("contact_text");
            $photo = Request::getVar("photo");
            $video_link = Request::getVar("video_link");
            $instagram = Request::getVar("instagram");
            $facebook = Request::getVar("facebook");
            $vk = Request::getVar("vk");
            $odnoklassniki = Request::getVar("odnoklassniki");

            $domain = str_replace('www.','',$_SERVER['SERVER_NAME']);
            $ip = $_SERVER['REMOTE_ADDR'];

            $to = "911@gastreet.com";
            $from = "no-reply@".$domain;
            $url = $_SERVER['HTTP_REFERER'];

            $user_agent = $_SERVER["HTTP_USER_AGENT"];
            if (strpos($user_agent, "Firefox") !== false) $browser = "Firefox";
            elseif (strpos($user_agent, "Opera") !== false) $browser = "Opera";
            elseif (strpos($user_agent, "Chrome") !== false) $browser = "Chrome";
            elseif ( (strpos($user_agent, "MSIE") !== false) || (strpos($user_agent, "Edge") !== false) ) $browser = "Internet Explorer";
            elseif (strpos($user_agent, "Safari") !== false) $browser = "Safari";
            else $browser = "Неизвестный";

            $subject = "=?UTF-8?B?".base64_encode("Заявка на народного спикера")."?=";
            $headers  = "MIME-Version: 1.0"."\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
            $headers .= "From: ".$from."\r\n";
            $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
            $mess  = trim(html_entity_decode($contact_text));
            $mess .= "<br>Фото: <img src=\"https://gastreet.com/images/folkspeaker/user_photo/$photo\" style=\"width:300px\">";
            $mess .= "<br>Ссылка на видео: ".trim($video_link);
            $mess .= "<br>Instagram: ".trim($instagram);
            $mess .= "<br>Facebook: ".trim($facebook);
            $mess .= "<br>ВКонтакте: ".trim($vk);
            $mess .= "<br>Одноклассники: ".trim($odnoklassniki);

            $mess .= "<br><br>--<br>Отправлено со страницы:\n".$url;
            $mess .= "<br>IP: ".$ip;
            $mess .= "<br>Браузер: ".$browser;

            if ( mail($to, $subject, $mess, $headers) ) {
                $_SESSION['stime'] = time();
                $array['result'] = "success";
                $array['cls'] = "c_success";
                $array['message'] = "Спасибо, сообщение отправлено.";
                echo json_encode($array);
                exit;
            } else {
                $array['result'] = "error";
                $array['cls'] = "c_error";
                $array['message'] = "Ошибка отправки сообщения. Просим связаться с нами по телефону.";
                echo json_encode($array);
                exit;
            }
        }

        echo json_encode("noAction");
        exit;
    }
}