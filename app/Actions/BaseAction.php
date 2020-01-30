<?php

/**
 * Базовый класс для всех действий
 * 
 */
class BaseAction extends Action {
    public $host;
    public $lang = null;
    public $actor;
    public $app;

    /**
     * Выполняется первым при обработке действия.
     * Здесь проверяется, включены ли куки у клиента.
     * 
     * @return void
     */
    public function preExecute() {
        $this->actor = Context::getActor();
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'webview') !== false) {
            $this->app = 1;
            if (!$this->actor) {
                //deb($_SERVER);
                if (isset($_SERVER['QUERY_STRING'])) {
                    if (strpos($_SERVER['QUERY_STRING'], 'product') !== false) {
                        Context::setObject('QUERY_STRING', $_SERVER['QUERY_STRING']);
                        unset($_SERVER['QUERY_STRING']);
                    }
                }
            }
        }
        if (isset($_SERVER['HTTP_HOST'])) {
            $this->host = str_replace('www.', '', strtolower($_SERVER['HTTP_HOST']));
        } else {
            Request::send404();
        }
        
        if (isset($this->actor->entityTable) && ($this->actor->entityTable != 'operator')) {
            // Устанавливаем язык пользователя
            $this->lang = UIGenerator::getLang();
            if ($this->actor) {
                if (Request::getVar("lang")) {
                    $um = new UserManager();
                    $userObj = $um->getById($this->actor->id);
                    $userObj->lang = $this->lang;
                    $userObj = $um->save($userObj);
                } else {
                    //deb($this->actor);
                    if ($this->actor->lang) {
                        $this->lang = $this->actor->lang;
                    } else { // страховка на случай пустого поля `users`.`lang` в БД
                        $this->actor->lang = $this->lang;
                        $um = new UserManager();
                        $userObj = $um->getById($this->actor->id);
                        $userObj->lang = $this->lang;
                        $userObj = $um->save($userObj);
                    }
                }
            }
        }
        return true;
    }

    /**
     * Не отрабатываем этот Action
     * @return void
     */
    public function execute() {
        Request::redirect("/");
    }
}