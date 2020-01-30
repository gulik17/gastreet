<?php /* Smarty version 2.6.13, created on 2019-12-28 03:39:00
         compiled from /home/c484884/gastreet.com/www/app/Templates/LandingControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'control', '/home/c484884/gastreet.com/www/app/Templates/LandingControl.html', 17, false),array('function', 'html_options', '/home/c484884/gastreet.com/www/app/Templates/LandingControl.html', 102, false),array('modifier', 'mobilephone', '/home/c484884/gastreet.com/www/app/Templates/LandingControl.html', 52, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['LandingControl']); ?>
<div class="bg"></div>
<div class="modal fade" id="video-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="videoModalLabel">Видео: Gastreet</h4>
            </div>
            <div class="modal-body">
                <iframe allowfullscreen="" height="400" src="" style="width:100%"></iframe>
            </div>
        </div>
    </div>
</div>

<?php echo smarty_function_control(array('name' => 'Age'), $this);?>


<div class="form_panel">
    <a class="close">×</a>
    <div class="form_panel__inner">
        <div class="form_panel__form">
            <?php if (! $this->_tpl_vars['this']['actor']): ?>
            <h1>Регистрация</h1>
            <form action="" method="post" class="ajax_form" autocomplete="off">
                <div class="form-group">
                    <div class="controls">
                        <input type="text" name="phone" autocomplete="off" placeholder="Телефон" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <input type="text" autocomplete="off" name="youAboutUs" placeholder="Как вы узнали о Gastreet?" class="form-control">
                    </div>
                </div>
                <div class="form-group" id="reg_hide_code">
                    <div class="controls">
                        <input type="password" maxlength="10" autocomplete="off" name="code" placeholder="Код из СМС" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <button type="submit" id="reg_get_phone" class="reg_get_phone btn btn-black">Получить код</button>
                        <div class="login">
                            <a href="#">Уже зарегистрирован?</a>
                        </div>
                    </div>
                </div>
            </form>
            <?php else: ?>
            <h1>Вы авторизованы</h1>
            <p><?php echo ((is_array($_tmp=$this->_tpl_vars['this']['actor']->phone)) ? $this->_run_mod_handler('mobilephone', true, $_tmp) : smarty_modifier_mobilephone($_tmp)); ?>
</p>
            <a href="/index.php?show=catalog" class="btn btn-black">Билеты</a>
            <a href="/index.php?do=logout" class="btn btn-white">Выйти</a>
            <?php endif; ?>
        </div>

        <div class="form_panel__login" style="left: -1000px;">
            <h1>Авторизация</h1>
            <form action="" method="post" class="ajax_form" autocomplete="off">
                <div class="form-group">
                    <div class="controls">
                        <input type="text" name="phone" autocomplete="off" placeholder="Телефон" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <input type="password" maxlength="10" name="code" autocomplete="off" placeholder="Код из СМС" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <button type="submit" id="login_btn" class="login_btn btn btn-black">Авторизация</button>
                        <div class="register">
                            <a href="#">Регистрация</a>
                        </div>
                        <div style="display: none" class="changepass">
                            <a href="#">Забыли пароль?</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="form_panel__reg" style="left: -1000px;">
            <h1>Расскажи о себе</h1>
            <form action="" method="post" class="ajax_form" autocomplete="off">
                <div class="form-group">
                    <div class="controls">
                        <input type="text" id="lastname" name="lastname" placeholder="Фамилия" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <input type="text" id="name" name="name" placeholder="Имя" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <select id="countryName" name="countryName" class="form-control" style="color:#999" onchange="this.style.color = 'black'">
                            <option value="">-- Страна --</option>
                            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['country'],'selected' => $this->_tpl_vars['this']['user']->countryName), $this);?>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <select style="display:none;color:#999" id="secondCityName" class="form-control" onchange="this.style.color = 'black'">
                            <option value="">-- Город --</option>
                            <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['this']['city'],'output' => $this->_tpl_vars['this']['city'],'selected' => $this->_tpl_vars['this']['user']->cityName), $this);?>

                        </select>
                        <input style="display:none" type="text" id="cityName" name="cityName" placeholder="Город" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <input type="text" id="af_company" name="company" placeholder="Компания" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <input type="text" id="af_email" name="email" placeholder="E-MAIL" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <select style="display:none;color:#999" id="af__usertype" name="usertype" class="form-control" onchange="this.style.color = 'black'">
                            <option disabled selected style='display:none' id="alltype">Тип учётной записи</option>
                            <option value="8">Я из бара</option>
                            <option value="9">Я из ресторана</option>
                            <option value="10">Я с кухни</option>
                            <option value="11">Я даю деньги</option>
                        </select>
                        <input style="display:none" type="text" id="af__in_usertype" value="" name="in_usertype">
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <input type="text" id="af_position" name="position" placeholder="Должность" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <button type="submit" id="submitForm" class="btn btn-black">Отправить</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="form_panel__send" style="left: -1000px;">
            <h1>Регистрация</h1>
            <form action="" method="post" class="ajax_form" autocomplete="off">
                <div class="form-group">
                    <div class="controls">
                        <input type="text" id="send_lastname" name="lastname" placeholder="Фамилия" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <input type="text" id="send_name" name="name" placeholder="Имя" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <select id="send_countryName" name="countryName" class="form-control" style="color:#999" onchange="this.style.color = 'black'">
                            <option value="">-- Страна --</option>
                            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['country'],'selected' => $this->_tpl_vars['this']['user']->countryName), $this);?>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <select style="display:none;color:#999" id="send_secondCityName" class="form-control" onchange="this.style.color = 'black'">
                            <option value="">-- Город --</option>
                            <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['this']['city'],'output' => $this->_tpl_vars['this']['city'],'selected' => $this->_tpl_vars['this']['user']->cityName), $this);?>

                        </select>
                        <input style="display:none" type="text" id="send_cityName" name="cityName" placeholder="Город" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <input type="text" id="send_company" name="company" placeholder="Компания" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <input type="text" name="phone" autocomplete="off" placeholder="Телефон" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <input type="text" id="send_email" name="email" placeholder="E-MAIL" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <input type="text" id="send_position" name="position" placeholder="Должность" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <button type="submit" id="sendForm" class="ajax-submit btn btn-black">Отправить</button>
                    </div>
                </div>
                <input style="display:none" type="text" id="send_usertype" value="" name="usertype">
                <input style="display:none" type="text" value="" name="subject">
            </form>
        </div>

        <div class="form_panel__msg" style="left: -1000px;">
            <div></div>
            <a href="#" class="btn btn-black back_form">Назад</a>
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
                            <a href="/"><img src="/app/landing/images/gastreet_logo.png"/></a>
                        </div>
                        <div class="place">
                            <p>Сочи, Красная Поляна,<br />Горки Город, +960</p>
                        </div>
                    </div>
                </div>
                <div class="navbar-header navbar-right">
                    <div class="con-block">
                        <?php if ($this->_tpl_vars['lang'] == 'ru'): ?>
                          <a class="lang" href="?lang=en">ENG</a>
                        <?php else: ?>
                          <a class="lang" href="?lang=ru">RUS</a>
                        <?php endif; ?>
                        <div class="icon-block">
                            <a href="https://www.instagram.com/gastreetshow" target="_blank" class="icon instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="https://www.facebook.com/gastreetshow" target="_blank" class="icon facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </div>
                        <p class="phone">8 800 700-93-20</p>
                    </div>
                </div>
            </div>
        </nav>
        <div class="fix_left">
            <div>
                <div class="play_block" data-target="#video-modal" data-toggle="modal" data-link="kskRSIyWJ-0" data-title="Как это было?">
                    <div class="play_btn"></div>
                    <p>Как это было?</p>
                </div>
                <div class="video_block">
                    <div class="video v3" data-target="#video-modal" data-toggle="modal" data-link="OBwVnGCIgIo" data-title="Как это было в 2017">
                        <div>
                            <span>
                                <b class="title">2017</b>
                            </span>
                        </div>
                    </div>
                    <div class="video v1" data-target="#video-modal" data-toggle="modal" data-link="B8L_3yvoL_Y" data-title="Как это было в 2016">
                        <div>
                            <span>
                                <b class="title">2016</b>
                            </span>
                        </div>
                    </div>
                    <div class="video v2" data-target="#video-modal" data-toggle="modal" data-link="80HISWnKeCg" data-title="Как это было в 2015">
                        <div>
                            <span>
                                <b class="title">2015</b>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="fix_right">
            <div>
                <div class="form_block">
                    <p class="date"></p>
                    <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                    <h1>See you<br> at Gastreet 2019</h1>
                    <p>On May 22 - 25, 2018, with the participation of more than 5,000 people, the grandiose event Gastreet'18. It was flying.</p>
                    <?php else: ?>
                    <h1>Увидимся <br>на Gastreet 2019</h1>
                    <p>22 - 25 мая 2018 года с участием более 5000 человек прошло грандиозное мероприятие Gastreet'18. Это было улётно.</p>
                    <?php endif; ?>
                    <div class="btn-block">
                        <div><a href="https://www.facebook.com/pg/gastreetshow/photos/?tab=albums" class="btn btn-black">Смотреть фотоотчёт</a></div>
                        <a href="/userlogin" class="btn btn-white"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;&nbsp;Войти в личный кабинет</a>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-6">
                        <div class="copyright">
                            <p class="gastreet">Gastreet — International Restaurant Show<br />Услуги оказывает ООО «НОМЕР ОДИН»<br />ИНН 2319056763, ОГРН 1442367009916<br>и ООО «СИРОККО» ИНН 2320238493,<br />ОГРН 1162366052705</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</section>