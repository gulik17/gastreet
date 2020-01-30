<?php
if(!empty($_POST)) {
    session_name('gss');
    session_start();
    error_reporting(E_ERROR);
    // www.e-mw.ru
    // icq: 717-0-681
    // info@e-mw.ru

    if (!isset($_SESSION['stime'])) {
        $_SESSION['stime'] = 0;
    }

    header("Content-Type: text/html; charset=utf-8");
    require_once __DIR__ . '/config.core.php';
    // требуется полный путь к файлам для запуска в режиме cli
    require_once SOLO_CORE_PATH.'/Config/framework.php';
    require_once SOLO_CORE_PATH.'/BaseApplication.php';
    require_once SOLO_CORE_PATH.'/Enviropment.php';
    
    $array = ['result'=>'','cls'=>'','time'=>'','message'=>''];

    $domain = str_replace('www.','',$_SERVER['SERVER_NAME']);
    $ip = $_SERVER['REMOTE_ADDR'];
    $limit = 6; // В секундах 600 = 1 минута
    
    $conceptFile = '';
    $menuFile = '';
    $bisplanFile = '';

    $to = "bitva@adggroup.ru";
    $from = "no-reply@".$domain;
    $time = time();

    $url = $_SERVER['HTTP_REFERER'];

    $user_agent = $_SERVER["HTTP_USER_AGENT"];
    if (strpos($user_agent, "Firefox") !== false) $browser = "Firefox";
    elseif (strpos($user_agent, "Opera") !== false) $browser = "Opera";
    elseif (strpos($user_agent, "Chrome") !== false) $browser = "Chrome";
    elseif ( (strpos($user_agent, "MSIE") !== false) || (strpos($user_agent, "Edge") !== false) ) $browser = "Internet Explorer";
    elseif (strpos($user_agent, "Safari") !== false) $browser = "Safari";
    else $browser = "Неизвестный";

    $interval = $time - $_SESSION['stime'];
    if ($interval < $limit) {
        $array['result'] = "error";
        $array['cls'] = "c_error";
        $array['time'] = $_SESSION['stime'];
        $array['message'] = "Вы слишком часто отправляете сообщения. Подождите ".($limit-$interval)." секунд";
        Enviropment::redirectBack($array['message'], "danger");
    } else {
        if (strlen($_POST['name']) < 2) {
            $array['result'] = "error";
            $array['cls'] = "c_error";
            $array['time'] = $_SESSION['stime'];
            $array['message'] .= "Поле Имя не заполнено"."<br>";
        }
        if (strlen($_POST['phone']) < 7) {
            $array['result'] = "error";
            $array['cls'] = "c_error";
            $array['time'] = $_SESSION['stime'];
            $array['message'] .= "Поле Телефон не заполнено"."<br>";
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $array['result'] = "error";
            $array['cls'] = "c_error";
            $array['time'] = $_SESSION['stime'];
            $array['message'] .= "Поле Email не заполнено"."<br>";
        }
        if (strlen($_POST['city']) < 2) {
            $array['result'] = "error";
            $array['cls'] = "c_error";
            $array['time'] = $_SESSION['stime'];
            $array['message'] .= "Поле Город не заполнено"."<br>";
        }
        $fileNameParam = 'concept'; // был ли добавлен файл Концепция и бизнес-план
        if (Request::isFile($fileNameParam)) {
            $file = new UploadedFile($fileNameParam, false, 'pdf');
            $conceptFile = "concept_" . $time . "." . $file->extension;
            $file->rename($conceptFile);
            $file->saveTo(Configurator::get("application:pdfFolder"));
            if ($file->isError) {
                $array['result'] = "error";
                $array['cls'] = "c_error";
                $array['time'] = $_SESSION['stime'];
                switch ($file->errorCode) {
                    case UPLOAD_ERR_OK: //no error; possible file attack!
                        break;
                    case UPLOAD_ERR_INI_SIZE : //uploaded file exceeds the upload_max_filesize directive in php.ini
                        $array['message'] .= "Слишком большой размер файла"."<br>";
                        break;
                    case UPLOAD_ERR_PARTIAL: //uploaded file was only partially uploaded
                        $array['message'] .= "Файл не был загружен"."<br>";
                        break;
                    case UPLOAD_ERR_NO_FILE: //no file was uploaded						
                        $array['message'] .= "Файл не был загружен"."<br>";
                        break;
                    case UPLOAD_ERR_EXTENSION: //invalid file extension
                        $array['message'] .= "Неверное расширение файла"."<br>";
                        break;
                    default: //a default error, just in case!  :)
                        $array['message'] .= "Неизвестная ошибка загрузки файла"."<br>";
                        break;
                }
            }
        } else {
            $array['result'] = "error";
            $array['cls'] = "c_error";
            $array['time'] = $_SESSION['stime'];
            $array['message'] .= "Прикрепите файл Концепции и бизнес-плана"."<br>";
        }
        if ($array['result'] === "error") {
            Enviropment::redirectBack($array['message'], "danger");
        }

        $subject = "=?UTF-8?B?".base64_encode(trim($_POST['name']))."?=";
        $headers  = "MIME-Version: 1.0"."\r\n";
        $headers .= "Content-type: text/plain; charset=utf-8\r\n";
        $headers .= "From: ".$from."\r\n";
        $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
        $mess  = "\nИмя Фамилия: ".trim($_POST['name']);
        $mess .= "\nГород: ".trim($_POST['city']);
        $mess .= "\nEmail: ".trim($_POST['email']);
        $mess .= "\nТелефон: ".trim($_POST['phone']);
        $mess .= "\nКонцепция и бизнес-план: https://gastreet.com/pdf/battle/".$conceptFile;
        $mess .= "\nСсылки на соцсети: ".trim($_POST['sociallink']);
        $mess .= "\nСсылки на ваши проекты: ".trim($_POST['projectlink']);

        $mess .= "\n\n--\nОтправлено со страницы:\n".$url;
        $mess .= "\nIP: ".$ip;
        $mess .= "\nБраузер: ".$browser;

        if ( mail($to, $subject, $mess, $headers) ) {
            $_SESSION['stime'] = time();
            $array['result'] = "success";
            $array['cls'] = "c_success";
            $array['message'] = "Спасибо, сообщение отправлено.";
            Enviropment::redirectBack($array['message'], "success");
        } else {
            $array['result'] = "error";
            $array['cls'] = "c_error";
            $array['message'] = "Ошибка отправки сообщения. Просим связаться с нами по телефону.";
            Enviropment::redirectBack($array['message'], "danger");
        }
        //print_r($array);
    }
}