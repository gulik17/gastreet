<?php /*
  echo "Отключено админом";
  die(); */ ?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>GASTREET 2018 - International Restaurant Show</title>
        <base href="https://gastreet.com/"/>
        <meta property="og:title" content="GASTREET 2018 - International Restaurant Show"/>
        <meta property="og:description" content=""/>
        <meta property="og:image" content="https://gastreet.com/images/fb_share_6.jpg">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="shortcut icon" href="/app/landing/favicon.ico"/>
        <link rel="apple-touch-icon" href="/app/landing/images/touch-icon-iphone.png"/>
        <link rel="apple-touch-icon" sizes="152x152" href="/app/landing/images/touch-icon-ipad.png"/>
        <link rel="apple-touch-icon" sizes="180x180" href="/app/landing/images/touch-icon-iphone-retina.png"/>
        <link rel="apple-touch-icon" sizes="167x167" href="/app/landing/images/touch-icon-ipad-retina.png"/>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>
        <link rel="stylesheet" type="text/css" href="/app/landing/css/owl.carousel.min.css"/>
        <link rel="stylesheet" type="text/css" href="/app/landing/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="/app/landing/css/style.css"/>
        <script>
            function statusChangeCallback(response) {
                if (response.status === 'connected') {
                    dataAPI();
                } else {
                    document.getElementById('status').innerHTML = 'Please log into this app.';
                }
            }
            function checkLoginState() {
                FB.getLoginStatus(function (response) {
                    statusChangeCallback(response);
                });
            }
            function dataAPI() {
                FB.api("/me", {fields: 'last_name,name,first_name,email,gender'}, function (response) {
                    console.log(response);
                    $('#af_name').val(response.first_name);
                    $('#af_lastname').val(response.last_name);
                    $('#af_email').val(response.email);
                    $('#af_gender').val(response.gender);
                    $('#af__fb_id').val(response.id);
                    document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + '!';
                });
            }
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {
                    return;
                }
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
            window.fbAsyncInit = function () {
                FB.init({
                    appId: '120553418618554',
                    cookie: true,
                    xfbml: true,
                    version: 'v2.10'
                });
                FB.AppEvents.logPageView();
            }
        </script>
    </head>
    <body class="page">
        <div class="modal fade" id="video-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="videoModalLabel">Видео: Gastreet</h4>
                    </div>
                    <div class="modal-body">
                        <iframe allowfullscreen="" height="400" src="" width="100%"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg"></div>
        <div class="form_panel">
            <a class="close">×</a>
            <div class="form_panel__inner">
                <div class="form_panel__form">
                    <h1>Заполните Заявку</h1>
                    <div style="margin-bottom:15px;margin-top:-10px" class="fb-login-button" onlogin="checkLoginState();" scope="public_profile,email" data-max-rows="1" data-size="medium" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>

                    <div id="status"></div>
                    <form action="" method="post" class="ajax_form">
                        <div class="form-group">
                            <div class="controls">
                                <input type="text" id="af_name" name="name" placeholder="Имя" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <input type="text" id="af_lastname" name="lastname" placeholder="Фамилия" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <select id="af_country" name="country" placeholder="Страна" class="form-control" style="color:#999" onchange="this.style.color = 'black'"></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <select style="display:none" id="af__ru_city" name="city" placeholder="Город" class="form-control" style="color:#999" onchange="this.style.color = 'black'"></select>
                                <input style="display:none" type="text" id="af__in_city" name="in_city" placeholder="Город" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <input type="text" id="af_company" name="company" placeholder="Компания" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <input type="text" id="af_phone" name="phone" placeholder="Телефон" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <input type="text" id="af_email" name="email" placeholder="E-MAIL" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <select style="display:none;color:#999" id="af__usertype" name="usertype" placeholder="Тип учетной записи" class="form-control" onchange="this.style.color = 'black'">
                                    <option disabled selected style='display:none' id="alltype">Тип учётной записи</option>
                                    <option>я из бара</option>
                                    <option>я из ресторана</option>
                                    <option>я с кухни</option>
                                    <option>я даю деньги</option>
                                </select>
                                <input style="display:none" type="text" id="af__in_usertype" value="" name="in_usertype" class="form-control">
                            </div>
                        </div>
                        <input style="display:none" type="text" value="" name="subject">
                        <input style="display:none" id="af_gender" type="text" value="" name="gender">
                        <input style="display:none" id="af__fb_id" type="text" value="" name="fb_id">
                        <div class="form-group">
                            <div class="controls">
                                <button type="submit" class="btn btn-black ajax-submit">Отправить запрос</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="form_panel__msg" style="display:none;">
                    <div>
                        <h4>Информация!</h4>
                        <p>Информация.</p>
                    </div>
                    <a href="#" class="btn btn-black back_form">Назад</a>
                </div>
            </div>
        </div>

        <section class="header">
            <div class="main_screen">
                <div class="main-bg"></div>
                <nav class="navbar" id="navbar">
                    <div class="container">
                        <div class="navbar-header">
                            <div class="gastreet">
                                <div>
                                    <img src="/app/landing/images/gastreet_logo.png"/>
                                </div>
                                <div class="place">
                                    <p>Сочи, Красная Поляна,<br />Горки Город, +540/+960</p>
                                </div>
                            </div>
                        </div>
                        <div class="navbar-header navbar-right">
                            <div class="con-block">
                                <div class="icon-block">
                                    <a href="https://www.instagram.com/gastreetshow" class="icon instagram"></a>
                                    <a href="https://www.facebook.com/gastreeshow" class="icon facebook"></a>
                                </div>
                                <p class="phone">8 800 700-93-20<br />+7 967 696-99-20</p>
                            </div>
                        </div>
                    </div>
                </nav>
                <div class="header_title">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7">
                                <h1 class="title">Билеты</h1>
                                <p class="subtitle">Сейчас мы разрабатывает для Вас самую крутую программу, поэтому&nbsp;в&nbsp;данный момент доступен для покупки только билет «Базовый»</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page_body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-20 ticket clearfix">
                                <h2 class="ticket_header">Как король</h2>
                                <p class="ticket_cost">150 000 ₽</p>
                                <p class="icollapse_more" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">Подробнее <span class="caret"></span></p>
                                <div class="collapse" id="collapse1">
                                    <p class="ticket_desc">В билет входит:</p>
                                    <ul class="ticket_item">
                                        <li>Все выступления спикеров</li>
                                        <li>Бизнес-Школа Gastreet</li>
                                        <li>Шефстрит</li>
                                        <li>Барстрит</li>
                                        <li>Кулинарная школа</li>
                                        <li>Музыкальный фестиваль под открытым небом</li>
                                        <li>Pop-up-ужины</li>
                                        <li>Первая профессиональная ресторанная премия</li>
                                        <li>Уличный маркет еды</li>
                                        <li>Лучшие поставщики</li>
                                        <li>Выделенная телефонная VIP-линия поддержки</li>
                                        <li>И что-то еще</li>
                                    </ul>
                                </div>
                                <a href="#" class="btn btn-black btn-line">Купить</a>
                            </div>
                            <div class="col-md-20 ticket clearfix">
                                <h2 class="ticket_header"><span class="title_blue">Профи</span></h2>
                                <p class="ticket_cost">20 000 ₽</p>
                                <p class="icollapse_more" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">Подробнее <span class="caret"></span></p>
                                <div class="collapse" id="collapse2">
                                    <p class="ticket_desc">В билет входит:</p>
                                    <ul class="ticket_item">
                                        <li>Все выступления спикеров</li>
                                        <li class="disabled">Бизнес-Школа Gastreet</li>
                                        <li>Шефстрит</li>
                                        <li>Барстрит</li>
                                        <li class="disabled">Кулинарная школа</li>
                                        <li>Музыкальный фестиваль под открытым небом</li>
                                        <li class="disabled">Pop-up-ужины</li>
                                        <li class="disabled">Первая профессиональная ресторанная премия</li>
                                        <li>Уличный маркет еды</li>
                                        <li>Лучшие поставщики</li>
                                    </ul>
                                </div>
                                <a href="#" class="btn btn-black btn-line">Купить</a>
                            </div>
                            <div class="col-md-20 ticket clearfix">
                                <h2 class="ticket_header"><span class="title_green">Шефский</span></h2>
                                <p class="ticket_cost">10 000 ₽</p>
                                <p class="icollapse_more" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">Подробнее <span class="caret"></span></p>
                                <div class="collapse" id="collapse3">
                                    <p class="ticket_desc">В билет входит:</p>
                                    <ul class="ticket_item">
                                        <li>Выступления спикеров (Только главная сцена)</li>
                                        <li class="disabled">Бизнес-Школа Gastreet</li>
                                        <li>Шефстрит</li>
                                        <li class="disabled">Барстрит</li>
                                        <li class="disabled">Кулинарная школа</li>
                                        <li>Музыкальный фестиваль под открытым небом</li>
                                        <li class="disabled">Pop-up-ужины</li>
                                        <li class="disabled">Первая профессиональная ресторанная премия</li>
                                        <li>Уличный маркет еды</li>
                                        <li>Лучшие поставщики</li>
                                    </ul>
                                </div>
                                <a href="#" class="btn btn-black btn-line">Купить</a>
                            </div>
                            <div class="col-md-20 ticket clearfix">
                                <h2 class="ticket_header"><span class="title_red">Барстрит</span></h2>
                                <p class="ticket_cost">9 000 ₽</p>
                                <p class="icollapse_more" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">Подробнее <span class="caret"></span></p>
                                <div class="collapse" id="collapse4">
                                    <p class="ticket_desc">В билет входит:</p>
                                    <ul class="ticket_item">
                                        <li>Выступления спикеров (Только главная сцена)</li>
                                        <li class="disabled">Бизнес-Школа Gastreet</li>
                                        <li class="disabled">Шефстрит</li>
                                        <li>Барстрит</li>
                                        <li class="disabled">Кулинарная школа</li>
                                        <li>Музыкальный фестиваль под открытым небом</li>
                                        <li class="disabled">Pop-up-ужины</li>
                                        <li class="disabled">Первая профессиональная ресторанная премия</li>
                                        <li>Уличный маркет еды</li>
                                        <li>Лучшие поставщики</li>
                                    </ul>
                                </div>
                                <a href="#" class="btn btn-black btn-line">Купить</a>
                            </div>
                            <div class="col-md-20 ticket clearfix">
                                <h2 class="ticket_header"><span class="title_gay">Базовый</span></h2>
                                <p class="ticket_cost">5 000 ₽</p>
                                <p class="icollapse_more" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">Подробнее <span class="caret"></span></p>
                                <div class="collapse" id="collapse5">
                                    <p class="ticket_desc">В билет входит:</p>
                                    <ul class="ticket_item">
                                        <li>Выступления спикеров (Только главная сцена)</li>
                                        <li class="disabled">Бизнес-Школа Gastreet</li>
                                        <li class="disabled">Шефстрит</li>
                                        <li class="disabled">Барстрит</li>
                                        <li class="disabled">Кулинарная школа</li>
                                        <li>Музыкальный фестиваль под открытым небом</li>
                                        <li class="disabled">Pop-up-ужины</li>
                                        <li class="disabled">Первая профессиональная ресторанная премия</li>
                                        <li>Уличный маркет еды</li>
                                        <li>Лучшие поставщики</li>
                                    </ul>
                                </div>
                                <a href="#" class="btn btn-black btn-line">Купить</a>
                            </div>
                        </div>
                        <div class="row ticket_description">
                            <div class="col-md-12">
                                <h4>К билетам Профи, Шефский, Barstreet, и&nbsp;Базовый можно отдельно докупить:</h4>
                                <p>Выступления спикеров –<br> 1&nbsp;500₽/выступление</p>
                                <p>Бизнес – Школа Gastreet –<br> 4&nbsp;000₽/мастер-класс</p>
                                <p>Кулинарная школа – стоимость уточняется</p>
                                <p>Первая профессиональная ресторанная премия – стоимость уточняется</p>
                            </div>
                        </div>
                        <div class="row schedule">
                            <div class="col-md-12">
                                <h3>Примерное расписание 1&nbsp;дня Gastreet Show 2018</h3>
                                <div class="row odd">
                                    <div class="col-md-2">
                                        <p><b>10:00 - 12:30</b></p>
                                    </div>
                                    <div class="col-md-10">
                                        <p>Выступление на <b>ГЛАВНОЙ СЦЕНЕ</b> (встречаются все!) <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="На ГЛАВНОЙ СЦЕНЕ нашего мероприятия состоятся самые яркие выступления Gastreet'18. Успешные рестораторы (и не только!) из разных стран поделятся секретами своего успеха. Здесь же пройдет официальное открытие и закрытие Gastreet'18. А если останутся деньги, то будет даже салют:)"></span></p>
                                    </div>
                                </div>
                                <div class="row even">
                                    <div class="col-md-2">
                                        <p><b>13:00 - 18:30</b></p>
                                    </div>
                                    <div class="col-md-10">
                                        <p>Мастер классы и семинары. <span style="color: #da3046">Внимание! Все площадки работают одновременно!</span></p>
                                        <div class="row area">
                                            <div class="col-md-20">
                                                <h4><span class="title_green">Шеф-Street <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="Площадка гастрономического безумия. Шеф-повора из разных ресторанов, разных городов и разных стран зарядят здесь свои мастер-классы."></span></span></h4>
                                                <p>1 площадка</p>
                                                <p>5 МК в день</p>
                                            </div>
                                            <div class="col-md-20">
                                                <h4><span class="title_red">Barstreet <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="Это три одновременно работающие площадки, на которых владельцы успешных баров, пабов и&nbsp;ночных клубов со всей страны делятся опытом."></span></span></h4>
                                                <p>3 площадки</p>
                                                <p>12 МК в день</p>
                                            </div>
                                            <div class="col-md-20">
                                                <h4><span class="title_orange">Бизнес-школа Gastreet <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="Бизнес-Школа Gastreet - это серия полноценных 3-х часовых семинаров от самых успешных и&nbsp;известных консультантов отрасли. Все они, естественно, выходцы из ресторанного бизнеса."></span></span></h4>
                                                <p>1 площадка</p>
                                                <p>3 семинара в день</p>
                                            </div>
                                            <div class="col-md-20">
                                                <h4><span class="title_gay">Кулинарная школа <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title=""></span></span></h4>
                                                <p>1 площадка</p>
                                                <p>4 МК в день</p>
                                            </div>
                                            <div class="col-md-20">
                                                <h4><span class="title_blue">Business-Street <span class="itooltip" data-toggle="tooltip" data-placement="left" data-html="true" title="Это часовые выступления ресторанных практиков со всей страны и&nbsp;за её пределами, которые будут проходить одновременно на 5&nbsp;площадках. Управление персоналом и&nbsp;налоговое планирование, главные правила дизайна ресторана и&nbsp;грамотный PR, юридические вопросы и многое чего еще. 20&nbsp;мастер-классов в&nbsp;день дадут вам возможность поскрипеть мозгами и&nbsp;увезти с&nbsp;собой не только эмоции, но и&nbsp;увесистый багаж знаний."></span></span></h4>
                                                <p>5 площадок</p>
                                                <p>20 МК в день</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row odd">
                                    <div class="col-md-2">
                                        <p><b>19:00 - 20:00</b></p>
                                    </div>
                                    <div class="col-md-10">
                                        <p>Выступление на <b>ГЛАВНОЙ СЦЕНЕ</b> (встречаются все!)</p>
                                    </div>
                                </div>
                                <div class="row even">
                                    <div class="col-md-2">
                                        <p><b>20:00 - 22:00</b></p>
                                    </div>
                                    <div class="col-md-10">
                                        <p>Pop-up ужины <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="Каждый вечер звёздные команды поваров из разных городов будут готовить ужины! Гости ужина смогут не только вкусно поесть, но и посмотреть на свою кухню под другим углом, подсмотреть интересные сочетания и подачу блюд."></span></p>
                                    </div>
                                </div>
                                <div class="row odd">
                                    <div class="col-md-2">
                                        <p><b>21:00</b></p>
                                    </div>
                                    <div class="col-md-10">
                                        <p>Музыкальный фестиваль под открытым небом <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="Ежедневные рок-концерты на главной площади Gastreet City. Запасайся удобной обувью, будем уходить в отрыв!"></span></p>
                                    </div>
                                </div>
                                <div class="row even">
                                    <div class="col-md-2">
                                        <p><b>23:00</b></p>
                                    </div>
                                    <div class="col-md-10">
                                        <p>Партнерские вечеринки <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title=""></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <footer>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <div class="copyright">
                                    <p class="gastreet">Gastreet — International Restaurant Show<br />Услуги оказывает ООО «Номер Один»</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="/app/landing/js/jquery.inputmask.min.js"></script>
        <script src="/app/landing/js/inputmask/phone-codes/phone.min.js"></script>
        <script src="/app/landing/js/owl.carousel.min.js"></script>
        <script src="/js/jquery.cookie.js"></script>
        <script src="/app/landing/js/bootstrap.js"></script>
        <script src="/app/landing/js/main.js"></script>
    </body>
</html>