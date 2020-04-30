<?php

class Phone {
    /* проверка номера телефона */
    public static function phoneVerification($phone) {
        $phone = strval($phone);
        // 1) убедимся, что номер корректен, т.е. содержит только
        //    а) цифры от «0» до «9»
        //    б) знак «+»
        //    в) спецсимволы: «(», «)», «-», « »
        $pattern = "/[^0-9\+\(\)\-\s]/i";
        if (preg_match($pattern, $phone)) {
            return self::resultDecorPhoneVerification(true, "41", "номер содержит недопустимые символы", "", $phone);
        }
        // 2) уберем из номера знак «+» и все спецсимволы
        $pattern = "/[^0-9]/i";
        $raw = preg_replace($pattern, "", $phone);
        if (!$raw) {
            return self::resultDecorPhoneVerification(true, "42", "номер не указан", "", $phone);
        }
        // 3) попытаемся определить страну,
        //    для определения верного количества цифр в номере
        // код страны - 380: Украина
        if (preg_match("/^380/i", $raw)) {
            if (strlen($raw) == 12) {
                return self::resultDecorPhoneVerification(false, "", "", "UA", $raw);
            } else {
                return self::resultDecorPhoneVerification(true, "43", "неверное количество цифр в номере", "UA", $raw);
            }
        }
        // код страны - 375: Белоруссия
        if (preg_match("/^375/i", $raw)) {
            if (strlen($raw) == 12) {
                return self::resultDecorPhoneVerification(false, "", "", "BY", $raw);
            } else {
                return self::resultDecorPhoneVerification(true, "43", "неверное количество цифр в номере", "BY", $raw);
            }
        }
        // код страны - 7: Россия
        if (preg_match("/^[78]9/i", $raw)) {
            $raw = preg_replace("/^8/i", "7", $raw);  // если первая цифра номера «8», то заменим ее на «7»

            if (strlen($raw) == 11) {
                return self::resultDecorPhoneVerification(false, "", "", "RU", $raw);
            } else {
                return self::resultDecorPhoneVerification(true, "43", "неверное количество цифр в номере", "RU", $raw);
            }
        }
        // код страны - 7: Казахстан
        if (preg_match("/^77/i", $raw)) {
            if (strlen($raw) == 11) {
                return self::resultDecorPhoneVerification(false, "", "", "KZ", $raw);
            } else {
                return self::resultDecorPhoneVerification(true, "43", "неверное количество цифр в номере", "KZ", $raw);
            }
        }
        // предположительно, номер был указан без кода страны (страна по умолчанию - Россия)
        // +996777777772 - выбивается
        if (preg_match("/^9/i", $raw) && strlen($raw) == 10) {
            $raw = "7" . $raw;
            if (strlen($raw) == 11) {
                return self::resultDecorPhoneVerification(false, "", "", "RU", $raw);
            } else {
                return self::resultDecorPhoneVerification(true, "43", "неверное количество цифр в номере", "RU", $raw);
            }
        }
        // неизвестная страна
        if ((11 <= strlen($raw)) && (strlen($raw) <= 19)) {
            return self::resultDecorPhoneVerification(false, "", "", "UNKNOWN", $raw);
        } else {
            return self::resultDecorPhoneVerification(true, "43", "неверное количество цифр в номере", "UNKNOWN", $raw);
        }
    }


    public static function phoneDadataVerification($phone) {
        $token = "130f8f12a29f4f7ca990ad4be6fe1f1e5bc497c1";
        $secret = "a38db9106d09f2cfef9644087f883bbbcd2d805c";
        $dadata = new Dadata($token, $secret);
        $dadata->init();
        // Стандартизовать одно значение
        $result = $dadata->clean("phone", $phone);
        $dadata->close();
        if ( ($result[0]['qc'] === 1) || ($result[0]['qc'] === 3) || ($result[0]['qc'] === 2) ) { //Телефон распознан с допущениями или не распознан
            return false;
        }
        return true;
    }

    /* оформление результата проверки номера телефона */
    private static function resultDecorPhoneVerification($isError, $code, $description, $country, $number) {
        $array = array(
            "isError"       => $isError,
            "code"          => $code,
            "description"   => $description,
            "country"       => $country,
            "number"        => $number);
        return $array;
    }

    /*
     * коды ошибок:
     *     41 - номер содержит недопустимые символы
     *     42 - номер не указан
     *     43 - неверное количество цифр в номере
     */
    public static function isPhoneValid($phone) {
        $phone = self::phoneVerification($phone);
        if ($phone["isError"]) {
            return false;
        } else {
            return true;
        }
    }
}