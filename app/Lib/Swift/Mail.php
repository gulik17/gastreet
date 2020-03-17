<?php

class Mail {

    // отправка сообщения
    public static function send($subject, $body, $to, $fromEmail = null, $fromName = null, $attachArray = null) {
        $isEnabled = Configurator::get('mail:enabled');
        if (!$isEnabled) {
            return true;
        }

        require_once APPLICATION_DIR . '/Lib/Swift/swift_required.php';
        // кол-во отправленных сообщений
        try {
            // Choose transport
            // TODO: поменять на параметры из настроек
            $transport = Swift_SmtpTransport::newInstance(Configurator::get('smtp:server'), Configurator::get('smtp:port'), 'ssl');
            $transport->setUsername(Configurator::get('smtp:login'));
            $transport->setPassword(Configurator::get('smtp:password'));

            // Create the Mailer using your created Transport
            $mailer = Swift_Mailer::newInstance($transport);

            // Create the message
            $message = Swift_Message::newInstance();
            $message->setSubject($subject);
            $message->setBody($body, 'text/html', 'utf-8');
            // Addressed to
            if (!is_array($to)) {
                $to = explode(',', $to);
            }
            $message->setTo($to);

            // From
            $fromEmail = $fromEmail ? $fromEmail : Configurator::get('mail:from');
            $fromName = $fromName ? $fromName : Configurator::get('mail:fromName');
            $message->setFrom(array($fromEmail => $fromName));

            if ($attachArray) {
                if (is_array($attachArray) && is_array($attachArray)) {
                    foreach ($attachArray AS $key => $attachItem) {
                        $message->attach(
                                Swift_Attachment::fromPath($attachItem[$key]['content'])->setFilename($attachItem[$key]['name'])
                        );
                    }
                } else {
                    $message->attach(Swift_Attachment::fromPath($attachArray[1]['content'])->setFilename($attachArray[0]['name']));
                }
            }
            $numSent = $mailer->send($message);
        } catch (Exception $e) {
            $numSent = false;
            echo "ERROR:<br/>";
            echo $e->getMessage();
            exit;
        }
        spl_autoload_register(array("Configurator", "autoload"));
        return $numSent;
    }

    public static function sendUniMail($subject, $email, $message, $fromEmail, $fromName, $attachArray = null) {
        $message = [
            "body"=>[
                "html"=>$message,
            ],
            "subject"=>$subject,
            "from_email"=>$fromEmail,
            "from_name"=>$fromName,
            "recipients"=> [
                [
                    "email"=> $email,
                ],
            ],
        ];

        if ($attachArray) {
            if (is_array($attachArray) && is_array($attachArray)) {
                foreach ($attachArray AS $key => &$attachItem) {
                    $attachItem['content'] = base64_encode(file_get_contents($attachItem['content']));
                }
                $message['attachments'] = $attachArray;
            }
        }

        $result = Mail::sendUniOne($message);
        return $result->status;
    }

    public static function sendAdminNotify($subject, $email, $message) {
        $message = [
            "body"=>[
                "html"=>$message,
            ],
            "subject"=>$subject,
            "from_email"=>"info@gastreet.com",
            "from_name"=>"GASTREET Script",
            "recipients"=> [
                [
                    "email"=> $email,
                ],
            ],
        ];

        $result = Mail::sendUniOne($message);
        return $result->status;
    }

    private static function sendUniOne($message) {
        $params = json_encode(['api_key'=>'6gim3bwxw9p13k5xtogmpfgkcfruxo1a3kz5u96o', 'username'=>'info@gastreet.com', "message"=>$message]);
        $defaults = [
            CURLOPT_URL => 'https://api.unisender.com/ru/transactional/api/v1/email/send.json',
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $params,
        ];
        $ch = curl_init();
        curl_setopt_array($ch, $defaults);
        $result = json_decode(curl_exec($ch));
        curl_close($ch);
        return $result;
    }

    public static function checkUnsubscribe($email) {
        $params = json_encode(['api_key'=>'6gim3bwxw9p13k5xtogmpfgkcfruxo1a3kz5u96o', 'username'=>'info@gastreet.com', "address"=>$email]);
        $defaults = [
            CURLOPT_URL => 'https://api.unisender.com/ru/transactional/api/v1/unsubscribed/check.json',
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $params,
        ];
        $ch = curl_init();
        curl_setopt_array($ch, $defaults);
        $result = json_decode(curl_exec($ch));
        curl_close($ch);
        return $result;
    }

    public static function listUnsubscribe($date) {
        $params = json_encode(['api_key'=>'6gim3bwxw9p13k5xtogmpfgkcfruxo1a3kz5u96o', 'username'=>'info@gastreet.com', "date_from"=>$date]);
        $defaults = [
            CURLOPT_URL => 'https://api.unisender.com/ru/transactional/api/v1/unsubscribed/list.json',
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $params,
        ];
        $ch = curl_init();
        curl_setopt_array($ch, $defaults);
        $result = json_decode(curl_exec($ch));
        curl_close($ch);
        return $result;
    }

}