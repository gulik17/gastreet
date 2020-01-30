<?php

if (!empty($_POST)) {
    session_start();
    // www.e-mw.ru
    // icq: 717-0-681
    // info@e-mw.ru

    header("Content-Type: text/html; charset=utf-8");

    $domain = str_replace('www.', '', $_SERVER['SERVER_NAME']);
    $ip = $_SERVER['REMOTE_ADDR'];
    $limit = 60; // В секундах 60 = 1 минута

    $toPartner = "partner@gastreet.com";
    $toSMI = "producer@gastreet.com";
    $toAll = "ticket@gastreet.com";
    //ccc = "info@e-mw.ru";
    $from = "no-reply@" . $domain;

    $url = $_SERVER['HTTP_REFERER'];
    $subject = "=?UTF-8?B?" . base64_encode(trim($_POST['subject'])) . "?=";

    $user_agent = $_SERVER["HTTP_USER_AGENT"];
    if (strpos($user_agent, "Firefox") !== false)
        $browser = "Firefox";
    elseif (strpos($user_agent, "Opera") !== false)
        $browser = "Opera";
    elseif (strpos($user_agent, "Chrome") !== false)
        $browser = "Chrome";
    elseif ((strpos($user_agent, "MSIE") !== false) || (strpos($user_agent, "Edge") !== false))
        $browser = "Internet Explorer";
    elseif (strpos($user_agent, "Safari") !== false)
        $browser = "Safari";
    else
        $browser = "Неизвестный";

    $time = time();
    $interval = $time - $_SESSION['stime'];
    if ($interval < $limit) {
        $result = "error";
        $cls = "c_error";
        $time = $_SESSION['stime'];
        $message = "Вы слишком часто отправляете сообщения. Подождите " . ($limit - $interval) . " секунд";
    } else {
        $arrayEr = [];
        $error = false;
        if (strlen($_POST['name']) < 2) {
            $arrayEr[] = 'Незаполнено поле Имя';
            $error = true;
        }
        if (strlen($_POST['lastname']) < 2) {
            $arrayEr[] = 'Незаполнено поле Фамилия';
            $error = true;
        }
        if (strlen($_POST['countryName']) < 2) {
            $arrayEr[] = 'Незаполнено поле Страна';
            $error = true;
        }
        if (strlen($_POST['cityName']) < 2) {
            $arrayEr[] = 'Незаполнено поле Город';
            $error = true;
        }
        if (strlen($_POST['usertype']) < 2) {
            $arrayEr[] = 'Незаполнено поле Тип учетки';
            $error = true;
        }
        if (strlen($_POST['position']) < 2) {
            $arrayEr[] = 'Незаполнено поле Должность';
            $error = true;
        }
        if (strlen($_POST['phone']) < 6) {
            $arrayEr[] = 'Незаполнено поле Телефон';
            $error = true;
        }
        if (strlen($_POST['company']) < 2) {
            $arrayEr[] = 'Незаполнено поле Компания';
            $error = true;
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $arrayEr[] = 'Незаполнено поле E-Mail';
            $error = true;
        }

        if (!$error) {
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
            $headers .= "From: " . $from . "\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
            $mess = "<p>Привет!</p>";
            $mess .= "<p>Данным письмом мы подтверждаем Вашу регистрацию на Gastreet Show, который пройдет с 27 по 31 мая 2019 на всесезонном и горном курорте Горки Город (Сочи, Красная Поляна).</p>";
            $mess .= "<p>Совсем скоро мы откроем продажу билетов и ты узнаешь об этом раньше всех! А те, кто поторопится, смогут приобрести их по специальной цене:)</p>";
            $mess .= "<p>Следите за обновлениями на сайте и в наших группах!</p>";
            $mess .= "<p>Всем GASTREET!!!</p>";
            $mess .= "<p><br></p>";
            $mess .= "<p><span style='color:#f00;'>Дмитрий Истенко</span><br>";
            $mess .= "Центр управления полётами<br>";
            $mess .= "Gastreet Team</p>";
            $mess .= "<p>8 800 700 93 20 - звонок по РФ бесплатный<br>";
            $mess .= "+ 7967 696 99 20 - <span style='color:#008000;'>whats app</span>, <span style='color:#800080;'>viber</span>, <span style='color:#0000ff;'>iMessage></span><br>";

            $mess .= "<p><a href='mailo:ticket@gastreet.com'>ticket@gastreet.com</a><br>";
            $mess .= "<a href='https://gastreet.com'>gastreet.com</a><br>";
            $mess .= "<a href='https://instagram.com/gastreetshow'>instagram.com/gastreetshow</a><br>";
            $mess .= "<a href='https://facebook.com/gastreetshow'>facebook.com/gastreeshow</p>";

            $mailOK = false;
            //$mailOK = mail(trim($_POST['email']), $subject, $mess, $headers);

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/plain; charset=utf-8\r\n";
            $headers .= "From: " . $from . "\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
            $mess = "\nФамилия: " . trim($_POST['lastname']);
            $mess .= "\nИмя: " . trim($_POST['name']);
            $mess .= "\nСтрана: " . trim($_POST['countryName']);
            $mess .= "\nГород: " . trim($_POST['cityName']);
            $mess .= "\nКомпания: " . trim($_POST['company']);
            $mess .= "\nТелефон: " . trim($_POST['phone']);
            $mess .= "\nEmail: " . trim($_POST['email']);
            $mess .= "\nТип учетки: " . trim($_POST['usertype']);
            $mess .= "\nДолжность: " . trim($_POST['position']);
            $mess .= "\nПол: " . trim($_POST['gender']);
            $mess .= "\nID профиля FB: " . trim($_POST['fb_id']);
            $mailOK = ($mailOK) ? "Отправлено" : "Не отправлено";
            $mess .= "\nУведомление: " . $mailOK;

            $mess .= "\n\n--\nОтправлено со страницы:\n" . $url;
            $mess .= "\nIP: " . $ip;
            $mess .= "\nБраузер: " . $browser;

            if (trim($_POST['usertype']) == 'СМИ') {
                $to = $toSMI;
            } elseif (trim($_POST['usertype']) == 'ПОСТАВЩИК') {
                $to = $toPartner;
            } else {
                $to = $toAll;
            }

            if (mail($to, $subject, $mess, $headers)) {
                $_SESSION['stime'] = time();
                $result = "success";
                $cls = "c_success";
                $message = "Спасибо, сообщение отправлено.";
            } else {
                $result = "error";
                $cls = "c_error";
                $message = "Ошибка отправки сообщения. Просим связаться с нами по телефону.";
            }
        } else {
            $result = "error";
            $cls = "c_error";
            $time = $_SESSION['stime'];
            $message = "Заполните все поля.";
        }
    }
    $result = "{\"result\": \"$result\",\"cls\": \"$cls\",\"time\": \"$time\",\"message\": \"$message\"}";
    echo $result;
}