<?php
/**
 * Базовый класс для всех контролов, требующих авторизацию покупателя
 *
 */
class AuthorizedUserControl extends BaseControl {
    /** Это глобальные переменные шаблона */
    public $controlName = "";
    public $page = null;
    public $actor  = null;
    public $position = null;

    public function preRender() {
        parent::preRender();

        $this->position[] = 'Администратор';
        $this->position[] = 'Аналитик';
        $this->position[] = 'Арт-директор';
        $this->position[] = 'Ассистент';
        $this->position[] = 'Бар-менеджер';
        $this->position[] = 'Бариста';
        $this->position[] = 'Бармен';
        $this->position[] = 'Бартендер';
        $this->position[] = 'Бренд-шеф';
        $this->position[] = 'Бухгалтер';
        $this->position[] = 'Видеограф';
        $this->position[] = 'Владелец';
        $this->position[] = 'Генеральный директор';
        $this->position[] = 'Главный бухгалтер';
        $this->position[] = 'Дизайнер';
        $this->position[] = 'Директор';
        $this->position[] = 'Директор по маркетингу';
        $this->position[] = 'Директор по персоналу';
        $this->position[] = 'Директор по продажам';
        $this->position[] = 'Директор по развитию';
        $this->position[] = 'Исполнительный директор';
        $this->position[] = 'Коммерческий директор';
        $this->position[] = 'Менеджер';
        $this->position[] = 'Операционный директор';
        $this->position[] = 'Официант';
        $this->position[] = 'Партнер';
        $this->position[] = 'Повар';
        $this->position[] = 'Помощник руководителя';
        $this->position[] = 'Блогер';
        $this->position[] = 'Ресторатор';
        $this->position[] = 'Руководитель';
        $this->position[] = 'Руководитель направления развития ресторанов';
        $this->position[] = 'Руководитель направления Horeca';
        $this->position[] = 'Руководитель отдела рекламы и продаж';
        $this->position[] = 'Руководитель службы питания';
        $this->position[] = 'Собственник';
        $this->position[] = 'Совладелец';
        $this->position[] = 'Сомелье';
        $this->position[] = 'Су-шеф';
        $this->position[] = 'Учредитель';
        $this->position[] = 'Финансовый директор';
        $this->position[] = 'Фотограф';
        $this->position[] = 'Хостес';
        $this->position[] = 'Шеф-повар';
        $this->position[] = 'Юрист';
        $this->position[] = 'HR';
        $this->position[] = 'Маркетолог';
        $this->position[] = 'Журналист';
        $this->position[] = 'Программист';
        $this->position[] = 'Другое';

        $this->actor = Context::getActor();
        
        // Только юзеры могут видеть эти контролы
        if(!($this->actor instanceof User)) {
            if ($this->lang == 'en') {
                Enviropment::redirect("userlogin", "Please log in", "danger");
            } else {
                Enviropment::redirect("userlogin", "Необходимо войти на сайт", "danger");
            }
        } else {
            // добавляем актора во все шаблоны где он авторизован
            $this->addData("actor", $this->actor);
            // метку присутствия на сайте обновим
            // 1 раз в 5 минут
            if (time() - $this->actor->tsOnline > 60 * 3) {
                $um = new UserManager();
                $this->actor = $um->checkRegistered($this->actor);
                $um->updateVisitTime($this->actor->id);
            }
            $this->ticketsCount = UserManager::getBacketCount($this->actor);
        }
        $this->layout = 'userhome.html';

        // Фомрирование списка стран и городов согласно текущей локализации
        $clm = new CountryLangManager();
        $this->country = $clm->getAllCountryLang($this->lang);
        unset($clm);
        $clm = new CityLangManager();
        $this->city = $clm->getAllCityLang($this->lang);
        unset($clm);
    }

    /**
     * Не рисуем его
     */
    public function render() {
        Request::send404();
    }

    public function postRender() {
        BaseApplication::writeSqlLog();
    }
}