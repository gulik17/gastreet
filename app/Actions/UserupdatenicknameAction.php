<?php

/**
 * Действие для сохранения ника пользователя
 *
 */
class UserupdatenicknameAction extends AuthorizedUserAction implements IPublicAction {

    public function execute() {
        $ts = time();

        $nickName = Request::getVar("nickName");
        if (!$nickName)
            Enviropment::redirect("userarea", "Не указан ник");

        $um = new UserManager();
        if ($um->getByNickName($nickName))
            Enviropment::redirect("userarea", "Выбранный ник уже занят, выберите другой");

        $currentUser = $this->actor;
        // подтвердил, меняем статус
        $currentUser->nickName = $nickName;
        $currentUser = $um->save($currentUser);
        // данные все готовим, в том числе и nickName
        $login = $currentUser->login;
        $password = $currentUser->password;
        $salt = $currentUser->id . "" . substr(Utils::getGUID(), 0, rand(15, 20));

        /*
          $confSection = "vbforum";
          // перед редиректом засунем инфу в базу форума
          $extDBConnData = Configurator::getSection($confSection);
          $vbConn = null;
          $vbConn = @mysql_connect($extDBConnData['host'] . ":" . $extDBConnData['port'], $extDBConnData['user'], $extDBConnData['password']);
          if ($vbConn)
          {
          mysql_select_db($extDBConnData['database']);
          mysql_query("SET NAMES utf8", $vbConn);
          $sql = "INSERT INTO " . $extDBConnData['prefix'] . "users (group_id, username, password, salt, email, timezone, dst, registered) VALUES (3, '{$nickName}', '{$password}', '{$salt}', '{$login}', 2, 1, {$ts})";
          mysql_query($sql, $vbConn);
          mysql_close($vbConn);
          }
         */

        Enviropment::redirect("userarea", "Ваш ник сохранен");
    }

}
