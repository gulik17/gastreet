<?php
/**
 * cp project
 * Компонент для отображения страниц, созданных админом
 */
class PageControl extends IndexControl {
    /** Это глобальные переменные шаблона */
    public $pageTitle = "GASTREET 2020 - International Restaurant Show - Отраслевая площадка для рестораторов: выступления спикеров, мастер-классы лучших в отрасли, информация, общение.";
    public $pageTitle_en = "GASTREET 2020 - International Restaurant Show - Branch platform for restaurateurs: speakers' speeches, master classes of the best in the industry, information, communication.";
    public $pageDesc = "";
    public $pageKeys = "";
    public $controlName = "";
    public $page = null;
    public $actor = null;
    public $host = null;
    public $slr1 = 1;
    public $slr2 = 1;
    public $slr3 = 1;
    public $spmList = null;
    public $parthners = null;
    public $fmList = null;
    public $prizes = null;
    public $vmList = null;
    public $leftDays = 0;
    public $purchasedTickets = 0;

    function __construct($page = null) {
        $this->page = $page;
    }

    public function postRender() {
        BaseApplication::writeSqlLog();
    }

    public function render() {
        $this->layout = '/index.html';

        // посмотрим нет ли в сессии параметров для маппинга ссылок
        $mappingParams = Context::getArray();
        if ($mappingParams) {
            if (isset($mappingParams['control']) && $mappingParams['control'] == 'page' && isset($mappingParams['param']) && $mappingParams['param'] == 'name' && isset($mappingParams['value'])) {
                $this->page = $mappingParams['value'];
            }
            Context::setArray(0);
        }

        // какую страницу cms запросили
        if (!$this->page) {
            $this->page = Request::getVar("name", "start");

            $givedControlName = mb_strtolower($this->page, 'utf8');
            $mappingArray = Request::getMappingArray();
            if (array_key_exists($givedControlName, $mappingArray)) {
                // ответить 301, если страница переадресована на красивый URL
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: /{$givedControlName}");
                exit();
            }
        }

        // первая страница будет сильно отличаться
        // от других страниц CMS
        // поэтому меняем макет динамически
        if ($this->page == "start") {
            // определим URL, где хостится приложение
            $mainHost = Configurator::get('application:baseHost');
            // с какого сайта пришел запрос
            $host = $_SERVER['HTTP_HOST'];
            $this->host = $host;

            // сюда данные для главной
            $this->layout = '/pageindex.html';

            //if ($this->dev == 1) {
                $this->layout = '/pageindexdev.html';
                $fm = new FaqManager();
                $this->fmList = $fm->getByGroup(2,'sortOrder');
                //$this->addData("fmList", $fmList);
            //}

            // рандомы для 3-х слайдов
            $this->slr1 = rand(1, 3);
            $this->slr2 = rand(1, 3);
            $this->slr3 = rand(1, 3);

            // спикеры
            $spm = new SpeakerManager();
            $this->spmList = $spm->getActiveByTag('2020', null, 8);

            $vm = new VideoManager();
            $this->vmList = $vm->getActive();

            //deb($vmList);

            // партнеры
            $pm = new ParthnerManager();
            $this->parthners = $pm->getActive();

            // бонусы
            $przm = new PrizeManager();
            $this->prizes = $przm->getActive();

            // сколько осталось дней
            $leftSeconds = 1590969600 - time();
            $this->leftDays = round($leftSeconds / 86400); // (60 * 60 * 24) = 86400 секунд в сутках

            $um = new UserManager();
            $this->purchasedTickets = $um->getRegistered() + 300;
            //$this->purchasedTickets = 3358;
        } else {
            // сюда можно насувать всяких данных
            // для страниц вида /page/name/la-la-la
            $cm = new ContentManager();
            $content = $cm->getByAlias($this->page);
            if (!$content) {
                Request::send404();
            }
            if ($content->menu != Content::MENU_TOP) {
                $this->pageTitle = $content->pageTitle;
                $this->pageDesc = $content->pageDesc;
                $this->pageKeys = $content->pageKeys;
            } else {
                $this->pageTitle = $content->title;
            }
            $this->addData("content", $content);
            $this->addData("text", str_replace("&quot;", '"', htmlspecialchars_decode($content->text, ENT_NOQUOTES)));
        }
        // пользователь
        $this->actor = Context::getActor();
        if ($this->actor) {
            $this->addData("actor", $this->actor);
            if (time() - $this->actor->tsOnline > 60 * 3) {
                $um = new UserManager();
                $this->actor = $um->checkRegistered($this->actor);
                $um->updateVisitTime($this->actor->id);
            }
        }
    }
}