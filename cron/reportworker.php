<?php

/**
 * Крон для выполнения задач, поставленных в очередь
 * Тяжёлый крон, требующий много ресурсов
 *
 */
require_once __DIR__ . '/../config.core.php';

//set_time_limit(0);
// требуется полный путь к файлам для запуска в режиме cli
require_once SOLO_CORE_PATH . '/Config/framework.php';
require_once SOLO_CORE_PATH . '/BaseApplication.php';
require_once SOLO_CORE_PATH . '/Enviropment.php';
require_once SOLO_CORE_PATH . '/Lib/Mutex/Mutex.php';

Logger::init(Configurator::getSection("logger"));

$tmp = Configurator::get("application:tempDir");
$mutex = new Mutex("reportworker", $tmp, false);

// скрипт уже выполняется
if ($mutex->isAcquired()) {
    echo "Выполение заблокировано другим процессом\n";
    exit();
}

// если не выполняется, лочим для других потоков
$mutex->lock();

try {
    // все менеджеры будут созданы вверху
    $um = new UserManager();
    $utm = new UserTypeManager();
    $urplinem = new UserReportLineManager();
    $bookm = new BookingManager();
    $basm = new BasketManager();
    $basprodm = new BasketProductManager();
    $paym = new PayManager();
    $udm = new UserDetailsManager();

    // берём один незавершённый отчет
    $urpm = new UserReportManager();
    $reports = $urpm->getSomeProcessingReports(1);
    if (is_array($reports) && count($reports)) {
        foreach ($reports AS $report) {
            $currentUserId = $report->currentUserId;
            // получить 500 пользователей от $currentUserId
            $users = $um->getNextNUsers(500, $currentUserId, $report->tsStart, $report->tsFinish);
            if (!$users) {
                // отчёт сформирован
                $tsGenerateFinish = time();
                $report->tsGenerateFinish = $tsGenerateFinish;
                $report->status = UserReport::STATUS_GENERATED;
                $report = $urpm->save($report);
            } else {
                // формируем отчёт
                
                foreach ($users AS $user) {
                    // формируем данные по данному пользователю, записываем их в строку UserReportLine
                    // бронирования пользователя
                    if ($user->parentUserId) {
                        // это доп. пользователь, все данные надо брать по childId
                        $bookings = $bookm->getByChildId($user->id, $report->tsStart, $report->tsFinish);
                        $basket = $basm->getTicketsByChildId($user->id, $report->tsStart, $report->tsFinish);
                        $basketProducts = $basprodm->getProductsByChildId($user->id, $report->tsStart, $report->tsFinish);
                    } else {
                        // это основной пользователь, данные надо брать по userId + childId = NULL
                        $bookings = $bookm->getByUserIdNoChildren($user->id, $report->tsStart, $report->tsFinish);
                        $basket = $basm->getTicketsByUserIdNoChildren($user->id, $report->tsStart, $report->tsFinish);
                        $basketProducts = $basprodm->getProductsByUserIdNoChildren($user->id, $report->tsStart, $report->tsFinish);
                    }

                    // оплаты могут быть обощенными, сразу за нескольких участников
                    // их надо растаскивать на корзины ...
                    // так-то в корзинах уже есть tsPay и сумма оплаты и есть информация о возвратах
                    $payments = $paym->getByUserId($user->id, $report->tsStart, $report->tsFinish);

                    // подготовим собранные данные в текстовый вид
                    // резервирования
                    $bookingsArray = array();
                    $bookingsTextArray = array();
                    if (is_array($bookings) && count($bookings)) {
                        foreach ($bookings AS $booking) {
                            $bookingsArray[] = array(
                                "createDate" => $booking->tsCreate ? date("d.m.Y", $booking->tsCreate) : null,
                                "createTime" => $booking->tsCreate ? date("H:i", $booking->tsCreate) : null,
                                "payDate" => $booking->tsPay ? date("d.m.Y", $booking->tsPay) : null,
                                "payTime" => $booking->tsPay ? date("H:i", $booking->tsPay) : null,
                                "finishDate" => $booking->tsFinish ? date("d.m.Y", $booking->tsFinish) : null,
                                "finishTime" => $booking->tsFinish ? date("H:i", $booking->tsFinish) : null,
                                "payAmount" => $booking->payAmount,
                                "status" => $booking->status,
                                "monetaOperationId" => $booking->monetaOperationId,
                            );

                            // в строчку
                            if (round($booking->payAmount) > 0) {
                                $preparedString = "сформировано: " . date("d.m.Y, в H:i", $booking->tsCreate);
                                $preparedString .= ", сумма: " . round($booking->payAmount);
                                if ($booking->status == 'STATUS_PAID') {
                                    $preparedString .= ", статус: оплачено";
                                    $preparedString .= ", оплачено: " . date("d.m.Y, в H:i", $booking->tsPay);
                                } else {
                                    $preparedString .= ", статус: новый";
                                }
                                if ($booking->tsFinish) {
                                    $preparedString .= ", срок до: " . date("d.m.Y, в H:i", $booking->tsFinish);
                                }

                                $bookingsTextArray[] = $preparedString;
                            }
                        }
                    }

                    // покупки
                    $basketArray = array();
                    $basketTextArray = array();
                    if (is_array($basket) && count($basket)) {
                        foreach ($basket AS $basketItem) {
                            $basketItem = (object) $basketItem;
                            $basketArray[] = array(
                                "createdDate" => $basketItem->tsCreated ? date("d.m.Y", $basketItem->tsCreated) : null,
                                "createdTime" => $basketItem->tsCreated ? date("H:i", $basketItem->tsCreated) : null,
                                "payDate" => $basketItem->tsPay ? date("d.m.Y", $basketItem->tsPay) : null,
                                "payTime" => $basketItem->tsPay ? date("H:i", $basketItem->tsPay) : null,
                                "baseTicketId" => $basketItem->baseTicketId,
                                "baseTicketName" => $basketItem->baseTicketName,
                                "baseTicketStatus" => $basketItem->baseTicketStatus,
                                "needAmount" => $basketItem->needAmount,
                                "payAmount" => $basketItem->payAmount,
                                "discountAmount" => $basketItem->discountAmount,
                                "returnedAmount" => $basketItem->returnedAmount,
                                "ulAmount" => $basketItem->ulAmount,
                                "discountId" => $basketItem->discountId,
                                "discountCode" => $basketItem->discountCode,
                                "discountPercent" => $basketItem->discountPercent,
                                "discountType" => $basketItem->discountType,
                                "discountUserTypeId" => $basketItem->discountUserTypeId,
                                "monetaOperationId" => $basketItem->monetaOperationId,
                                "status" => $basketItem->status
                            );

                            // в строчку
                            $preparedString = "добавлено: " . date("d.m.Y, в H:i", $basketItem->tsCreated);
                            if ($basketItem->tsPay) {
                                $preparedString .= ", оплачено: " . date("d.m.Y, в H:i", $basketItem->tsPay);
                            }
                            $preparedString .= ", билет: " . $basketItem->baseTicketName;
                            $preparedString .= ", цена: " . $basketItem->needAmount;
                            if ($basketItem->discountAmount) {
                                $preparedString .= ", скидка: " . $basketItem->discountAmount;
                            }
                            if ($basketItem->returnedAmount) {
                                $preparedString .= ", возврат: " . $basketItem->returnedAmount;
                            }
                            if ($basketItem->payAmount) {
                                $preparedString .= ", оплата: " . $basketItem->payAmount;
                            }
                            if ($basketItem->ulAmount) {
                                $preparedString .= ", оплата авансом: " . $basketItem->ulAmount;
                            }
                            $preparedString .= ", статус: " . Basket::getStatusDesc($basketItem->status);
                            $basketTextArray[] = $preparedString;
                        }
                    }

                    $basketProductsArray = array();
                    $basketProductsTextArray = array();
                    if (is_array($basketProducts) && count($basketProducts)) {
                        foreach ($basketProducts AS $basketItem) {
                            $basketItem = (object) $basketItem;
                            $basketProductsArray[] = array(
                                "createdDate" => $basketItem->tsCreated ? date("d.m.Y", $basketItem->tsCreated) : null,
                                "createdTime" => $basketItem->tsCreated ? date("H:i", $basketItem->tsCreated) : null,
                                "payDate" => $basketItem->tsPay ? date("d.m.Y", $basketItem->tsPay) : null,
                                "payTime" => $basketItem->tsPay ? date("H:i", $basketItem->tsPay) : null,
                                "productId" => $basketItem->productId,
                                "productName" => $basketItem->productName,
                                "productStatus" => $basketItem->productStatus,
                                "needAmount" => $basketItem->needAmount,
                                "payAmount" => $basketItem->payAmount,
                                "discountAmount" => $basketItem->discountAmount,
                                "returnedAmount" => $basketItem->returnedAmount,
                                "ulAmount" => $basketItem->ulAmount,
                                "discountId" => $basketItem->discountId,
                                "discountCode" => $basketItem->discountCode,
                                "discountPercent" => $basketItem->discountPercent,
                                "discountType" => $basketItem->discountType,
                                "discountUserTypeId" => $basketItem->discountUserTypeId,
                                "monetaOperationId" => $basketItem->monetaOperationId,
                                "status" => $basketItem->status
                            );

                            // в строчку
                            $preparedString = "добавлено: " . date("d.m.Y, в H:i", $basketItem->tsCreated);
                            if ($basketItem->tsPay) {
                                $preparedString .= ", оплачено: " . date("d.m.Y, в H:i", $basketItem->tsPay);
                            }
                            $preparedString .= ", билет: " . $basketItem->productName;
                            $preparedString .= ", цена: " . $basketItem->needAmount;
                            if ($basketItem->discountAmount) {
                                $preparedString .= ", скидка: " . $basketItem->discountAmount;
                            }
                            if ($basketItem->returnedAmount) {
                                $preparedString .= ", возврат: " . $basketItem->returnedAmount;
                            }
                            if ($basketItem->payAmount) {
                                $preparedString .= ", оплата: " . $basketItem->payAmount;
                            }
                            if ($basketItem->ulAmount) {
                                $preparedString .= ", оплата авансом: " . $basketItem->ulAmount;
                            }
                            $preparedString .= ", статус: " . BasketProduct::getStatusDesc($basketItem->status);
                            $basketProductsTextArray[] = $preparedString;
                        }
                    }

                    // оплаты
                    // ... пока оставим их, но в БД соберём
                    $paymentsArray = array();
                    $paymentsTextArray = array();
                    if (is_array($payments) && count($payments)) {
                        foreach ($payments AS $payment) {
                            $paymentsArray[] = array("needAmount" => $payment->needAmount, "discountId" => $payment->discountId, "payAmount" => $payment->payAmount,
                                "status" => $payment->status, "type" => $payment->type, "monetaOperationId" => $payment->monetaOperationId, "payForTicketIds" => $payment->payForTicketIds,
                                "payForProductIds" => $payment->payForProductIds, "createdDate" => date("d.m.Y", $payment->tsCreated), "createdTime" => date("H:i", $payment->tsCreated),
                                "userCardId" => $payment->userCardId);

                            $preparedString = "";
                            $paymentsTextArray[] = $preparedString;
                        }
                    }


                    // добавляем строку
                    $reportLine = new UserReportLine();
                    $reportLine->reportId = $report->id;
                    $reportLine->userId = $user->id;
					
                    if ($user->parentUserId) {
                        $reportLine->parentUserId = $user->parentUserId;
                        $parent = $um->getById($user->parentUserId);
						if ($parent) {
							$parentString = $parent->phone;
							if ($parent->lastname) {
								$parentString .= ", Фамилия: " . $parent->lastname;
							}
							if ($parent->name) {
								$parentString .= ", Имя: " . $parent->name;
							}
							if ($parent->confirmedEmail || $parent->email) {
								$parentString .= $parent->confirmedEmail ? ", e-mail: " . $parent->confirmedEmail : ", e-mail: " . $parent->email;
							}
							$reportLine->parentUserInfo = $parentString;
						} else {
							$reportLine->parentUserInfo = '';
						}
                    }

                    $reportLine->userCreated = $user->tsCreated ? date("d M Y, в H:i", $user->tsCreated) : null;
                    $reportLine->userRegister = $user->tsRegister ? date("d M Y, в H:i", $user->tsRegister) : null;
                    $reportLine->userOnline = $user->tsOnline ? date("d M Y, в H:i", $user->tsOnline) : null;

                    // сериализованные данные
                    $reportLine->bookingSerialized = @serialize($bookings);
                    $reportLine->basketSerialized = @serialize($basket);
                    $reportLine->basketProductSerialized = @serialize($basketProducts);
                    $reportLine->paySerialized = @serialize($payments);

                    // подготовленные данные
                    $reportLine->bookingSerializedData = @serialize($bookingsArray);
                    $reportLine->basketSerializedData = @serialize($basketArray);
                    $reportLine->basketProductSerializedData = @serialize($basketProductsArray);
                    $reportLine->paySerializedData = @serialize($paymentsArray);

                    // подготовленные строковые данные
                    $reportLine->bookingInfo = $bookingsTextArray ? implode(";\n\r ", $bookingsTextArray) : null;
                    $reportLine->basketInfo = $basketTextArray ? implode(";\n\r ", $basketTextArray) : null;
                    $reportLine->basketProductInfo = $basketProductsTextArray ? implode(";\n\r ", $basketProductsTextArray) : null;
                    $reportLine->payInfo = $paymentsTextArray ? implode(";\n\r ", $paymentsTextArray) : null;

                    // данные о пользователе
                    $reportLine->userStatus = User::getStatusDesc($user->status);
                    $reportLine->phone = $user->phone;
                    $reportLine->email = $user->confirmedEmail ? $user->confirmedEmail : $user->email;
                    $reportLine->utm = $user->utm;
					
                    if ($user->typeId) {
                        $userType = $utm->getById($user->typeId);
                        if ($userType) {
                            $reportLine->typeUser = $userType->name;
                        } else {
                            $reportLine->typeUser = '';
                        }
                    } else {
                        $reportLine->typeUser = '';
                    }
                    
                    $reportLine->lastname = $user->lastname;
                    $reportLine->name = $user->name;
                    $reportLine->cityName = $user->cityName;
                    $reportLine->countryName = $user->countryName;
                    $reportLine->company = $user->company;
                    $reportLine->position = $user->position;
                    $reportLine->ulBalance = $user->ulBalance;
                    $reportLine->youAboutUs = $user->youAboutUs;

                    // реквизиты
                    $details = $udm->getByUserId($user->id);
                    if ($details) {
                        $reportLine->inn = $details->inn ? $details->inn : null;

                        $detailsString = "добавлено: " . date("d M Y, в H:i", $details->tsCreated);
                        if ($details->company) {
                            $detailsString .= ", компания: " . $details->company;
                        }
                        if ($details->cityName) {
                            $detailsString .= ", город: " . $details->cityName;
                        }
                        if ($details->countryName) {
                            $detailsString .= ", страна: " . $details->countryName;
                        }
                        if ($details->inn) {
                            $detailsString .= ", ИНН: " . $details->inn;
                        }
                        if ($details->kpp) {
                            $detailsString .= ", КПП: " . $details->kpp;
                        }
                        if ($details->rs) {
                            $detailsString .= ", р/с: " . $details->rs;
                        }
                        if ($details->bank) {
                            $detailsString .= ", банк: " . $details->bank;
                        }
                        if ($details->corr) {
                            $detailsString .= ", к/с: " . $details->corr;
                        }
                        if ($details->bik) {
                            $detailsString .= ", БИК: " . $details->bik;
                        }
                        if ($details->director) {
                            $detailsString .= ", директор: " . $details->director;
                        }
                        if ($details->buh) {
                            $detailsString .= ", бухгалтер: " . $details->buh;
                        }

                        $reportLine->details = $detailsString;
                    }

                    $reportLine = $urplinem->save($reportLine);

                    // продвинем $report на шаг
                    $report->currentUserId = $user->id;
                    $report->currentUsersProcessed = $report->currentUsersProcessed + 1;
                    $report = $urpm->save($report);
                }
            }
        }
    }
} catch (Exception $e) {
    echo $e->getMessage() . " " . $e->getTraceAsString() . "\n";
}

//echo "done\n";
// Освобождаем ресурс
$mutex->release();