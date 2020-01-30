<?php

/**
 * Класс для взаимодействия с API Eventicious (Приложение iOS/Android)
 * 
 * 
 */

class Eventicious {
    protected $host;         // api host
    protected $code;         // code
    protected $last_error;   // api last error

    private function fixHost($host) {
        return rtrim($host, "/")."/";
    }

    /* SETTERS AND GETTERS */
    public function setHost($host) {
        if ($this->host != $host) {
            $this->host = $this->fixHost($host);
        }
    }

    public function getHost() {
        return $this->host;
    }

    public function setCode($code) {
        if ($this->code != $code) {
            $this->code = $code;
        }
    }

    public function getCode() {
        return $this->code;
    }

    public function getLastError() {
        return $this->last_error;
    }

    function deb($value = null, $die = 1) {
        echo 'Debug: <br><pre>';
        var_dump($value);
        echo '</pre>';
        if ($die == 1) {
            die();
        }
    }

    /*
     * РАБОТА С ЗАЛАМИ
     * 
     * Описание полей
     *  Property    Type     Comment
     *  id          int      Идентификатор зала в вашей системе
     *  name        string   Название зала
     *  position*   int      Порядковый номер зала, должен быть уникальным
     *  language**  string   Язык, на котором происходит редактирование (только для PUT запросов)
     * 
     * * система не проверяет корректность задания порядковых номеров зала. В приложении, если используется
     *   многопоточное расписание, залы отображаются в соответствии с порядковыми номерами.
     * 
     */
    
    /**
     * СОЗДАНИЕ: Позволяет создать зал (вертикальную колонку в расписании).<br>
     * <b>Метод:</b> 'POST'<br>
     * <b>URL:​</b> api/external/Locations/Create<br>
     * @param integer $id       Идентификатор зала в вашей системе
     * @param integer $position Порядковый номер зала, должен быть уникальным
     * @param string  $name     Название зала
     * 
     * @return array Массив
     */
    public function locationsCreate($id, $position, $name) {
        $data = [
                'id'       => (int) $id,
                'position' => (int) $position,
                'name'     => $name,
            ];
        return $this->CallAPI("POST", "api/external/Locations/Create", $data);
    }
    
    /**
     * РЕДАКТИРОВАНИЕ: Позволяет создать зал (вертикальную колонку в расписании).<br>
     * <b>Метод:</b> 'PUT'<br>
     * <b>URL:​</b> api/external/Locations/Update/{id}<br>
     * @param integer $id           Идентификатор зала в вашей системе
     * @param integer $position     Порядковый номер зала, должен быть уникальным
     * @param string  $name         Название зала
     * @param string  $language     Язык, на котором происходит редактирование. ru-RU / en-US (необязательно)
     * 
     * @return array Массив
     */
    public function locationsUpdate($id, $position, $name, $language = 'ru-RU') {
        $data = [
                'id'       => (int) $id,
                'position' => (int) $position,
                'name'     => $name,
                'language' => $language,
            ];
        return $this->CallAPI("PUT", "api/external/Locations/Update/$id", $data);
    }
    
    /**
     * УДАЛЕНИЕ: Позволяет создать зал (вертикальную колонку в расписании).<br>
     * <b>Метод:</b> 'DELETE'<br>
     * <b>URL:​</b> api/external/Locations/Delete/{id}<br>
     * @param integer $id       Идентификатор зала в вашей системе
     * 
     * @return array Массив
     */
    public function locationsDelete($id) {
        $id = (int) $id;
        return $this->CallAPI("DELETE", "api/external/Locations/Delete/$id");
    }
    
    /*
     * РАБОТА С ДОКЛАДЧИКАМИ/УЧАСТНИКАМИ
     * 
     * Описание полей
     *  Property            Type     Comment
     *  id                  int      Идентификатор докладчика/участника в вашей системе (externalID в Eventicious)
     *  firstName           string   Имя
     *  lastName            string   Фамилия
     *  company             string   Название компании (спикера)
     *  position            string   Должность
     *  city                string   Город
     *  vk                  string   ВК
     *  twitter             string   Твиттер
     *  facebook            string   Фейсбук
     *  email               string   E-mail
     *  phone               string   Телефон
     *  description         string   О себе
     *  isSpeaker           bool     Это спикер или участник
     *  externalImagePath*  string   Ссылка на файл с фотографией участника
     *  language            string   Язык, на котором происходит редактирование (только для PUT запросов)
     * 
     * * если это поле указано, и там находится валидная ссылка на картинку, она отобразится в профиле
     *   участника/докладчика. Это может произойти не сразу, так как фотография будет поставлена в очередь на
     *   постобработку.
     */

    /**
     * СОЗДАНИЕ: Позволяет создать докладчика/участника<br>
     * <b>Метод:</b> 'POST'<br>
     * <b>URL:​</b> api/external/Speakers/Create<br>
     * @param integer $id                   Идентификатор докладчика/участника в вашей системе (externalID в Eventicious)
     * @param string  $firstName            Имя
     * @param string  $lastName             Фамилия
     * @param string  $company              Название компании (спикера)
     * @param string  $position             Должность
     * @param string  $city                 Город
     * @param string  $vk                   ВК
     * @param string  $twitter              Твиттер
     * @param string  $facebook             Фейсбук
     * @param string  $email                E-mail
     * @param string  $phone                Телефон
     * @param string  $description          О себе
     * @param boolean $isSpeaker            Это спикер или участник
     * @param string  $externalImagePath    Ссылка на файл с фотографией участника
     * @param array   $aclGroupsIds         Группы, массив ID групп
     *
     * @return array Массив
     * 
     * Ответ:
     *  Аналогичен запросу. Содержит дополнительные поля, например networkingCode — ID-участника
     *  (персональный код доступа в приложение).
     */
    public function speakersCreate(
                        $id,
                        $firstName = "",
                        $lastName = "",
                        $company = "",
                        $position = "",
                        $city = "",
                        $vk = "",
                        $twitter = "",
                        $facebook = "",
                        $email = "",
                        $phone = "",
                        $description = "",
                        $isSpeaker = false,
                        $externalImagePath = "",
                        $aclGroupsIds = '') {
        $data = [
                'id'                => (int) $id,
                'firstName'         => $firstName,
                'lastName'          => $lastName,
                'company'           => $company,
                'position'          => $position,
                'city'              => $city,
                'vk'                => $vk,
                'twitter'           => $twitter,
                'facebook'          => $facebook,
                'email'             => $email,
                'phone'             => $phone,
                'description'       => $description,
                'isSpeaker'         => $isSpeaker,
                'externalImagePath' => $externalImagePath,
                'aclGroupsIds'      => $aclGroupsIds,
            ];
        return $this->CallAPI("POST", "api/external/Speakers/Create", $data);
    }
    
    /**
     * РЕДАКТИРОВАНИЕ: позволяет отредактировать докладчика/участника с идентификатором {id}<br>
     * <b>Метод:</b> 'PUT'<br>
     * <b>URL:​</b> api/external/Speakers/Update/{id}<br>
     * 
     * @param integer $id                   Идентификатор докладчика/участника в вашей системе (externalID в Eventicious)
     * @param string  $firstName            Имя
     * @param string  $lastName             Фамилия
     * @param string  $company              Название компании (спикера)
     * @param string  $position             Должность
     * @param string  $city                 Город
     * @param string  $vk                   ВК
     * @param string  $twitter              Твиттер
     * @param string  $facebook             Фейсбук
     * @param string  $description          О себе
     * @param string  $language             Язык, на котором происходит редактирование
     * @param array   $aclGroupsIds         Группы, массив ID групп
     *
     * @return array Массив
     */
    public function speakersUpdate(
                        $id,
                        $firstName = "",
                        $lastName = "",
                        $company = "",
                        $position = "",
                        $city = "",
                        $vk = "",
                        $twitter = "",
                        $facebook = "",
                        $description = "",
                        $language = "ru-RU",
                        $aclGroupsIds = '') {
        $data = [
                'id'                => (int) $id,
                'firstName'         => $firstName,
                'lastName'          => $lastName,
                'company'           => $company,
                'position'          => $position,
                'city'              => $city,
                'vk'                => $vk,
                'twitter'           => $twitter,
                'facebook'          => $facebook,
                'description'       => $description,
                'language'          => $language,
                'aclGroupsIds'      => $aclGroupsIds,
            ];
        return $this->CallAPI("PUT", "api/external/Speakers/Update/$id", $data);
    }
    
    /**
     * УДАЛЕНИЕ: позволяет удалить докладчика/участника с идентификатором {id}<br>
     * <b>Метод:</b> 'DELETE'<br>
     * <b>URL:​</b> api/external/Speakers/Delete/{id}<br>
     * 
     * @param integer $id   Идентификатор докладчика/участника в вашей системе (externalID в Eventicious)
     *
     * @return array Массив
     */
    public function speakersDelete($id) {
        $id = (int) $id;
        return $this->CallAPI("DELETE", "api/external/Speakers/Delete/$id");
    }
    
    /**
     * РАБОТА С ТЕМАМИ
     * 
     * Описание полей
     *  Property            Type     Comment
     *  id                  int      Идентификатор темы в вашей системе
     *  name                string   Название темы
     *  color               string   Цвет темы, строка в hex формате, например #ABCDEF
     *  visibilityFlag      string   Стиль отображение темы
     *                               «VisibilityFlagHidden» - не отображать название темы в расписании
     *                               (только в деталях доклада),
     *                               «VisibilityFlagShowEvents» - отображать название темы в расписании
     *                               на плашке доклада
     *  language            string   язык, на котором происходит редактирование (только для PUT запросов)
     */
    
    /**
     * СОЗДАНИЕ: Позволяет создать тему<br>
     * <b>Метод:</b> 'POST'<br>
     * <b>URL:​</b> api/external/Tags/Create<br>
     * 
     * @param integer $id               Идентификатор темы в вашей системе
     * @param string  $visibilityFlag   Стиль отображение темы (VisibilityFlagShowEvents/VisibilityFlagHidden)
     * @param string  $name             Название темы
     * @param string  $color            Цвет темы, строка в hex формате
     * 
     * @return array Массив
     */
    public function tracksCreate($id, $visibilityFlag, $name, $color) {
        $data = [
                'id'             => (int) $id,
                'visibilityFlag' => $visibilityFlag,
                'name'           => $name,
                'color'          => $color,
            ];
        return $this->CallAPI("POST", "api/external/Tags/Create", $data);
    }
    
    /**
     * РЕДАКТИРОВАНИЕ: позволяет отредактировать тему с идентификатором {id}<br>
     * <b>Метод:</b> 'PUT'<br>
     * <b>URL:​</b> api/external/Tags/Update/{id}<br>
     * 
     * @param integer $id               Идентификатор темы в вашей системе
     * @param integer $visibilityFlag   Отображение темы в сетке расписания, может принимать значения 0 и 1
     * @param string  $name             Название темы
     * @param string  $color            Цвет темы, строка в hex формате
     * @param string  $language         Язык, на котором происходит редактирование (только для PUT запросов)
     * 
     * @return array Массив
     */
    public function tracksUpdate($id, $visibilityFlag, $name, $color, $language = "ru-RU") {
        $data = [
                'id'             => (int) $id,
                'visibilityFlag' => $visibilityFlag,
                'name'           => $name,
                'color'          => $color,
                'language'       => $language,
            ];
        return $this->CallAPI("PUT", "api/external/Tags/Update/$id", $data);
    }
    
    /**
     * УДАЛЕНИЕ: Позволяет удалить тему с идентификатором {id}<br>
     * <b>Метод:</b> 'DELETE'<br>
     * <b>URL:​</b> api/external/Tags/Delete/{id}<br>
     * 
     * @param integer $id   Идентификатор темы в вашей системе
     * 
     * @return array Массив
     */
    public function tracksDelete($id) {
        $id = (int) $id;
        return $this->CallAPI("DELETE", "api/external/Tags/Delete/$id");
    }

    /**
     * РАБОТА С СОБЫТИЯМИ
     * 
     * Описание полей
     *  Property            Type     Comment
     *  id                  int      Идентификатор события в вашей системе
     *  title               string   Название события
     *  description         string   Описание события
     *  startTime           DateTime Время начала в формате "2014-07-24T18:00"
     *  endTime             DateTime Время окончания
     *  trackId             int      id темы
     *  speakersIds         array    Массив id спикеров
     *  locationsIds        array    Массив id залов
     *  style               int      Тип доклада
     *                               0 - доклад, выступление
     *                               1 - кофе-брейк, обед или другое общее событие
     *                               2 - филлер (небольшое объявление без указания времени)
     *                               У кофе-брейка и филлера нет описания и спикеров — только
     *                               плашка с названием в расписании.
     *                               Для филлеров так же не отображается время (используется
     *                               только для задания позиции в расписании), таким образом
     *                               можно создавать события без указания конкретного времени.
     *  language            string   Язык, на котором происходит редактирование (только для PUT запросов)
     */

    /**
     * СОЗДАНИЕ: Позволяет создать доклад/событие<br>
     * <b>Метод:</b> 'POST'<br>
     * <b>URL:​</b> api/external/Sessions/Create<br>
     * 
     * @param integer  $id               Идентификатор темы в вашей системе
     * @param string   $title            Название события
     * @param string   $description      Описание события
     * @param DateTime $startTime        Время начала в формате "2014-07-24T18:00"
     * @param DateTime $endTime          Время окончания
     * @param integer  $tagIds           Массив id темы
     * @param array    $speakersIds      Массив id спикеров
     * @param array    $locationsIds     Массив id залов
     * @param integer  $style            Тип доклада
     * 
     * @return array Массив
     */
    public function sessionsCreate($id, $title, $description, $startTime, $endTime, $trackId, $speakersIds, $locationsIds, $style) {
        $data = [
                'id'           => (int) $id,
                'title'        => $title,
                'description'  => $description,
                'startTime'    => $startTime,
                'endTime'      => $endTime,
                'tagIds'       => [$trackId],
                'speakersIds'  => $speakersIds,
                'locationsIds' => $locationsIds,
                'style'        => (int) $style,
            ];
        return $this->CallAPI("POST", "api/external/Sessions/Create", $data);
    }

    /**
     * РЕДАКТИРОВАНИЕ: Позволяет отредактировать доклад с идентификатором {id}<br>
     * <b>Метод:</b> 'PUT'<br>
     * <b>URL:​</b> ​api/external/Sessions/Update/{id}<br>
     * 
     * @param integer  $id               Идентификатор темы в вашей системе
     * @param string   $title            Название события
     * @param string   $description      Описание события
     * @param DateTime $startTime        Время начала в формате "2014-07-24T18:00"
     * @param DateTime $endTime          Время окончания
     * @param array    $tagIds           Массив id темы
     * @param array    $speakersIds      Массив id спикеров
     * @param array    $locationsIds     Массив id залов
     * @param integer  $style            Тип доклада
     * @param array    $aclGroupsIds     Массив ID групп участников
     * @param string   $language         Язык, на котором происходит редактирование (только для PUT запросов)
     * 
     * @return array Массив
     */
    public function sessionsUpdate($id, $title, $description, $startTime, $endTime, $tagIds, $speakersIds, $locationsIds, $style, $language = "ru-RU") {
        $data = [
                'id'           => (int) $id,
                'title'        => $title,
                'description'  => $description,
                'startTime'    => $startTime,
                'endTime'      => $endTime,
                'tagIds'       => [$tagIds],
                'speakersIds'  => $speakersIds,
                'locationsIds' => $locationsIds,
                'style'        => (int) $style,
                'language'     => $language,
            ];
        return $this->CallAPI("PUT", "api/external/Sessions/Update/$id", $data);
    }

    /**
     * УДАЛЕНИЕ: Позволяет удалить доклад с идентификатором {id}<br>
     * <b>Метод:</b> 'DELETE'<br>
     * <b>URL:​</b> ​api/external/Sessions/Delete/{id}<br>
     * 
     * @param integer  $id  Идентификатор темы в вашей системе
     * 
     * @return array Массив
     */
    public function sessionsDelete($id) {
        $id = (int) $id;
        return $this->CallAPI("DELETE", "api/external/Sessions/Delete/$id");
    }
    
    /**
     * РАБОТА С ВЛОЖЕНИЯМИ СОБЫТИЙ
     * 
     * Описание полей
     *  Property            Type     Comment
     *  id                  int      Идентификатор ссылки в вашей системе, значение больше 1
     *  title               string   Название ссылки (будет отображаться в мобильном приложении)
     *  url                 string   Ссылка
     *  sessionId           int      Идентификатор события
     *  language            string   Язык, на котором происходит редактирование (только для PUT запросов)
     */

    /**
     * СОЗДАНИЕ: Позволяет создать вложение<br>
     * <b>Метод:</b> 'POST'<br>
     * <b>URL:​</b> api/external/Sessions/{SessionId}/Attachments/Create<br>
     * 
     * @param integer  $id               Идентификатор ссылки в вашей системе, значение больше 1
     * @param string   $title            Название ссылки (будет отображаться в мобильном приложении)
     * @param string   $url              Ссылка
     * @param integer  $sessionId        Идентификатор события
     * 
     * @return array Массив
     */
    public function sessionsAttachmentsCreate($id, $title, $url, $sessionId) {
        $data = [
                'id'           => (int) $id,
                'title'        => $title,
                'url'          => $url,
            ];
        return $this->CallAPI("POST", "api/external/Sessions/$sessionId/Attachments/Create", $data);
    }

    /**
     * РЕДАКТИРОВАНИЕ: Позволяет отредактировать вложение с идентификатором {id}<br>
     * <b>Метод:</b> 'PUT'<br>
     * <b>URL:​</b> ​api/external/Sessions/{SessionId}/Attachments/Update{id}<br>
     * 
     * @param integer  $id               Идентификатор ссылки в вашей системе, значение больше 1
     * @param string   $title            Название ссылки (будет отображаться в мобильном приложении)
     * @param string   $url              Ссылка
     * @param integer  $sessionId        Идентификатор события
     * @param string   $language         Язык, на котором происходит редактирование (только для PUT запросов)
     * 
     * @return array Массив
     */
    public function sessionsAttachmentsUpdate($id, $title, $url, $sessionId, $language = "ru-RU") {
        $data = [
                'id'           => (int) $id,
                'title'        => $title,
                'url'          => $url,
                'language'     => $language,
            ];
        return $this->CallAPI("PUT", "api/external/Sessions/$sessionId/Attachments/Update/$id", $data);
    }
    
    /**
     * УДАЛЕНИЕ: Позволяет удалить вложение с идентификатором {id}<br>
     * <b>Метод:</b> 'DELETE'<br>
     * <b>URL:​</b> ​api/external/Sessions/{sessionId}/Attachments/Delete/{id}<br>
     * 
     * @param integer  $id         Идентификатор ссылки в вашей системе, значение больше 1
     * @param integer  $sessionId  Идентификатор события
     * 
     * @return array Массив
     */
    public function sessionsAttachmentsDelete($id, $sessionId) {
        $id = (int) $id;
        return $this->CallAPI("DELETE", "api/external/Sessions/$sessionId/Attachments/Delete/$id");
    }
    
    /**
     * РАБОТА С ГРУППАМИ
     *
     * Описание полей
     *  Property            Type     Comment
     *  id                  int      Идентификатор группы в вашей системе
     *  name                string   Название группы
     *  language            string   Язык, на котором происходит редактирование (только для PUT запросов)
     */

    /**
     * СОЗДАНИЕ: Позволяет создать группу<br>
     * <b>Метод:</b> 'POST'<br>
     * <b>URL:​</b> api/external/ACLGroups/Create<br>
     *
     * @param integer  $id               Идентификатор группы в вашей системе
     * @param string   $title            Название группы
     *
     * @return array Массив
     */
    public function ACLGroupsCreate($id, $name) {
        $data = [
                'id'           => (int) $id,
                'name'        => $name,
            ];
        return $this->CallAPI("POST", "api/external/ACLGroups/Create", $data);
    }

    /**
     * РЕДАКТИРОВАНИЕ: Позволяет отредактировать группу с идентификатором {id}<br>
     * <b>Метод:</b> 'PUT'<br>
     * <b>URL:​</b> ​api/external/ACLGroups/Update/{id}<br>
     *
     * @param integer  $id               Идентификатор группы в вашей системе
     * @param string   $title            Название группы
     * @param string   $language         Язык, на котором происходит редактирование (только для PUT запросов)
     *
     * @return array Массив
     */
    public function ACLGroupsUpdate($id, $name, $language = "ru-RU") {
        $data = [
                'id'           => (int) $id,
                'name'         => $name,
                'language'     => $language,
            ];
        return $this->CallAPI("PUT", "api/external/ACLGroups/Update/$id", $data);
    }
    
    /**
     * УДАЛЕНИЕ: Позволяет удалить группу с идентификатором {id}<br>
     * <b>Метод:</b> 'DELETE'<br>
     * <b>URL:​</b> ​api/external/ACLGroups/Delete/{id}<br>
     *
     * @param integer  $id         Идентификатор группы в вашей системе
     *
     * @return array Массив
     */
    public function ACLGroupsDelete($id, $sessionId) {
        $id = (int) $id;
        return $this->CallAPI("DELETE", "api/external/ACLGroups/Delete/$id");
    }

    /**
     * СОЗДАНИЕ РАСПИСАНИЯ: !ВНИМАНИЕ! Этот метод удаляет все расписание.<br>
     * Позволяет создать с помощью 1 запроса полное расписание с залами, темами, докладами, докладчиками.<br>
     * <b>Метод:</b> 'POST'<br>
     * <b>URL:​</b> api/external/PostConference<br>
     * Описание полей:<br>
     * Передаваемый объект должен содержать 4 поля: locations, tracks, sessions, speakers.<br>
     * В каждом поле содержится массив с соответствующими<br>
     * объектами. Форматы конкретных объектов приведены в предыдущих разделах.<br>
     * 
     * @param array $locations Массив с залами
     * @param array $tracks    Массив с темами
     * @param array $sessions  Массив событий (докладов)
     * @param array $speakers  Массив докладчиков
     * 
     * @return array Массив
     */

    public function conferenceCreate($locations, $tracks, $sessions, $speakers) {
        $data = [
                'locations' => $locations,
                'tracks'    => $tracks,
                'sessions'  => $sessions,
                'speakers'  => $speakers,
            ];
        return $this->CallAPI("POST", "api/external/PostConference", $data);
    }

    /**
     * РАБОТА С ОТЧЕТОМ ПО ИЗБРАННЫМ ДОКЛАДАМ<br>
     *
     * Описание полей:<br>
     *  Property            Type     Comment
     *  userId              int      Идентификатор участника
     *  sessionId           int      Идентификатор доклада
     *  isAttending         boolean  Добавил ли данный участник данный доклад в избранное
     */

    /**
     * СОЗДАНИЕ И РЕДАКТИРОВАНИЕ ЗАПИСЕЙ О ДОБАВЛЕНИИ ДОКЛАДОВ В ИЗБРАННОЕ<br>
     * <b>Метод:</b> 'POST'<br>
     * <b>URL:​</b> api/external/Favorites/Create
     * 
     * @param integer $userId      Идентификатор участника
     * @param integer $sessionId   Идентификатор доклада
     * @param boolean $isAttending Добавил ли данный участник данный доклад в избранное
     * 
     * @return array Массив
     */
    
    public function favoritesCreate($userId, $sessionId, $isAttending) {
        $data = [
                'userId'      => $userId,
                'sessionId'   => $sessionId,
                'isAttending' => $isAttending,
            ];
        return $this->CallAPI("POST", "api/external/Favorites/Create", $data);
    }
    
    /**
     * Получение статистики по докладам в «Избранном»<br>
     * <b>Описание:​</b> позволяет получить список докладов и статистику добавления в избранное. Для<br>
     * каждого доклада указывается название и число пользователей, у которых он в избранном.<br>
     * Пример ответа:<br>
     * [<br>
     *  { "sessionTitle": "Как создать хорошее апи", "favoritesCount": 2 },<br>
     *  { "sessionTitle": "Как создать плохое апи", "favoritesCount": 15 }<br>
     * ]<br>
     * 
     * <b>Метод:</b> 'GET'<br>
     * <b>URL:​</b> api/external/Reports/Favorites<br>
     * 
     * @return array
     */
    public function favoritesGet() {
        return $this->CallAPI("GET", "api/external/Reports/Favorites");
    }

    /**
     * ПОЛУЧЕНИЕ списка вопросов с «лайками»<br>
     * Пример ответа:<br>
     * [<br>
     *  { "sessionTitle": "Как создать хорошее API", "questionText": "По ком звонит колокол?", "questionLikes": 123 },<br>
     *  { "sessionTitle": "Как создать хорошее API", "questionText": "Где находится нофелет?", "questionLikes": 0 },<br>
     *  { "sessionTitle": "Как создать хорошее API", "questionText": "Как пройти в библиотеку?", "questionLikes": null }<br>
     * ]<br>
     * 
     * <b>Метод:</b> 'GET'<br>
     * <b>URL:​</b> api/external/Reports/Questions<br>
     * 
     * @return array
     */
    public function questionsGet() {
        return $this->CallAPI("GET", "api/external/Reports/Questions");
    }
    
    /**
     * Функция для передачи данных в API Eventicious
     * 
     * @param  string $method Метод передачи запроса
     * @param  string $url    Адрес покоторому будет передан запрос
     * @param  array  $data   Массив передаваемых полей
     * 
     * @return array
     */
    private function CallAPI($method, $url, $data = false) {
        $url = $this->host . $url;
        $this->last_error = '';
        $curl = curl_init();
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, true);
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                }
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                }
                break;
            default:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
                if ($data) {
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                }
        }
        
       // deb(json_encode($data));

        $headers = array("Content-Type: application/json","Cache-Control: no-cache","Authorization: Secret $this->code");

        // Optional Authentication:
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($curl, CURLOPT_ENCODING, "");
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_1_1");
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); // отправка заголовков
        curl_setopt($curl, CURLOPT_URL, $url);

        $result = curl_exec($curl);
        $resultStatus = curl_getinfo($curl);

        curl_close($curl);

        // check result
        $response['result_code'] = $resultStatus['http_code'];
        // parse content            
        $response['content'] = json_decode($result);
        
       // deb($data, 0);

        if ($resultStatus['http_code'] != 200) {
            $this->last_error = $resultStatus;
            
        }

        return $response;
    }
}