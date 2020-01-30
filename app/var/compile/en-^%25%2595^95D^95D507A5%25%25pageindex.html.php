<?php /* Smarty version 2.6.13, created on 2020-01-20 13:10:22
         compiled from /home/c484884/gastreet.com/www/app/Templates/layouts//pageindex.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/layouts//pageindex.html', 17, false),array('function', 'displaynotification', '/home/c484884/gastreet.com/www/app/Templates/layouts//pageindex.html', 31, false),array('function', 'component', '/home/c484884/gastreet.com/www/app/Templates/layouts//pageindex.html', 45, false),array('function', 'declension', '/home/c484884/gastreet.com/www/app/Templates/layouts//pageindex.html', 157, false),array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/layouts//pageindex.html', 297, false),array('function', 'control', '/home/c484884/gastreet.com/www/app/Templates/layouts//pageindex.html', 884, false),array('modifier', 'tagtocssclass', '/home/c484884/gastreet.com/www/app/Templates/layouts//pageindex.html', 309, false),array('modifier', 'tagformat', '/home/c484884/gastreet.com/www/app/Templates/layouts//pageindex.html', 311, false),array('modifier', 'yeartomedal', '/home/c484884/gastreet.com/www/app/Templates/layouts//pageindex.html', 319, false),array('modifier', 'getticket', '/home/c484884/gastreet.com/www/app/Templates/layouts//pageindex.html', 378, false),array('modifier', 'numberprice', '/home/c484884/gastreet.com/www/app/Templates/layouts//pageindex.html', 389, false),array('modifier', 'isprizepic', '/home/c484884/gastreet.com/www/app/Templates/layouts//pageindex.html', 601, false),array('modifier', 'getidyoutubevideo', '/home/c484884/gastreet.com/www/app/Templates/layouts//pageindex.html', 627, false),array('modifier', 'dbtexttohtml', '/home/c484884/gastreet.com/www/app/Templates/layouts//pageindex.html', 650, false),)), $this); ?>
<!DOCTYPE html>
<html class="no-js" lang="<?php echo $this->_tpl_vars['lang']; ?>
">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <title><?php if ($this->_tpl_vars['pageTitle']): ?><?php echo $this->_tpl_vars['pageTitle']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['p'] > 1): ?> - Page <?php echo $this->_tpl_vars['p']; ?>
<?php endif; ?></title>
        <meta name="description" content="<?php echo $this->_tpl_vars['pageDesc']; ?>
"/>
        <meta name="keywords" content=""/>
        <meta name="robots" content="index,follow,noodp,noydir"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <link rel="icon" href="/images/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
        <meta name="yandex-verification" content="41ad686aace54a72" />
        <meta property="og:image" content="https://gastreet.com/images/fb_share_6.jpg">

        <?php echo smarty_function_loadscript(array('file' => '/css/modal-window.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/owl.carousel/assets/owl.carousel.min.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/lightgallery/css/lightgallery.min.css','type' => 'css'), $this);?>


        <?php echo smarty_function_loadscript(array('file' => '/css/bootstrap4/css/bootstrap.min.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/css/docs.min.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/css/half-slider.css','type' => 'css'), $this);?>


        <?php echo smarty_function_loadscript(array('file' => '/css/gss/styles-new.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/css/style.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/css/style-gss.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/css/font-awesome.min.css','type' => 'css'), $this);?>


        <script>
            let message = '<?php echo smarty_function_displaynotification(array(), $this);?>
';
        </script>
        <link rel="manifest" href="/manifest.json">
        <script src="https://cdn.viapush.com/cdn/v1/sdks/viapush.js" async="" charset="UTF-8"></script>
        <?php echo '
        <script>
            var ViaPush = window.ViaPush || [];
            ViaPush.push(["init", { appId: "b58fa8ab-cf0e-8196-4952-9be21bc2b1f6" }]);
        </script>
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-869423439"></script>
        <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag(\'js\', new Date()); gtag(\'config\', \'AW-869423439\'); </script>
        '; ?>

    </head>
    <body class="d-flex flex-column h-100 main-page">
        <?php echo smarty_function_component(array('name' => 'Topmenu'), $this);?>

		
        <main role="main" class="flex-shrink-0 pb-4">
            <div class="modal fade" id="video-modal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="videoModalLabel">Video: Gastreet</h4>
                        </div>
                        <div class="modal-body">
                            <iframe allowfullscreen="" height="400" src="" style="width:100%"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="l-site">
                <div class="jumbotron-slider animated-background js-jumbotron-slider">
                    <div class="owl-carousel slider js-slider">
                        <div class="slide js-slide main_1">
                            <div class="container">
                                <div class="row align-items-center maininfo js-maininfo">
                                    <div class="col-md-12">
                                        <div class="row align-items-center">
                                            <div class="col-md-12">
                                                <p class="date">1<span class="minus"></span>5 июня</p>
                                                <p class="subdate">Сочи, <span>Курорт «Красная Поляна»</span></p>
                                                <br><br>
                                                <p class="title">Всё как ты любишь,<br> там где ты любишь</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slide js-slide main_2">
                            <div class="container">
                                <div class="row align-items-center maininfo js-maininfo">
                                    <div class="col-md-12">
                                        <div class="row align-items-center">
                                            <div class="col-md-12">
                                                <p class="date">1<span class="minus"></span>5 июня</p>
                                                <p class="subdate">Сочи, <span>Курорт «Красная Поляна»</span></p>
                                                <br><br>
                                                <p class="title">Город, где рестораторы<br> учатся у&nbsp;рестораторов</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slide js-slide main_3">
                            <div class="container">
                                <div class="row align-items-center maininfo js-maininfo">
                                    <div class="col-md-12">
                                        <div class="row align-items-center">
                                            <div class="col-md-12">
                                                <p class="date">1<span class="minus"></span>5 июня</p>
                                                <p class="subdate">Сочи, <span>Курорт «Красная Поляна»</span></p>
                                                <br><br>
                                                <p class="title">Лучшие шефы обучают<br> и обучаются здесь</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slide js-slide main_4">
                            <div class="container">
                                <div class="row align-items-center maininfo js-maininfo">
                                    <div class="col-md-12">
                                        <div class="row align-items-center">
                                            <div class="col-md-12">
                                                <p class="date">1<span class="minus"></span>5 июня</p>
                                                <p class="subdate">Сочи, <span>Курорт «Красная Поляна»</span></p>
                                                <br><br>
                                                <p class="title">Общение с&nbsp;коллегами 24/7</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slide js-slide main_5">
                            <div class="container">
                                <div class="row align-items-center maininfo js-maininfo">
                                    <div class="col-md-12">
                                        <div class="row align-items-center">
                                            <div class="col-md-12">
                                                <p class="date">1<span class="minus"></span>5 июня</p>
                                                <p class="subdate">Сочи, <span>Курорт «Красная Поляна»</span></p>
                                                <br><br>
                                                <p class="title">Та самая атмосфера</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-footer">
                        <div class="container">
                            <div class="row content js-content">
                                <div class="content-footer">
                                    <div class="row">
                                        <div class="gss-mainpage-statistics">
                                            <div class="gss-mainpage-statistics-col1">
                                                <span class="gss-mainpage-statistics-text"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>DAYS LEFT&nbsp;&nbsp;&nbsp;<?php else: ?>ДО GASTREET&nbsp;&nbsp;&nbsp;<?php endif; ?></span>
                                                <span class="gss-mainpage-statistics-digits">
                                                    <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                                                        <?php echo $this->_tpl_vars['leftDays']; ?>

                                                    <?php else: ?>
                                                        <?php echo smarty_function_declension(array('count' => $this->_tpl_vars['leftDays'],'form1' => "день",'form2' => "дня",'form5' => "дней"), $this);?>

                                                    <?php endif; ?>
                                                </span>
                                            </div>
                                            <div class="gss-mainpage-statistics-col1">
                                                <span class="gss-mainpage-statistics-text"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>ALREADY REGISTERED&nbsp;&nbsp;&nbsp;<?php else: ?>С НАМИ УЖЕ&nbsp;&nbsp;&nbsp;<?php endif; ?></span>
                                                <span class="gss-mainpage-statistics-digits">
                                                    <?php echo $this->_tpl_vars['purchasedTickets']; ?>

                                                    <?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php else: ?>
                                                        <?php echo smarty_function_declension(array('count' => $this->_tpl_vars['purchasedTickets'],'form1' => "человек",'form2' => "человека",'form5' => "человек",'merge' => false), $this);?>

                                                    <?php endif; ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="<?php if ($this->_tpl_vars['dev'] != 1): ?>d-none<?php endif; ?>">

                                        </div>
                                    </div>
                                </div>
                                <div class="dots js-dots">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                </div>
<!--                <div class="main-img">-->
<!--                    <div class="main-img__text">-->
<!--                        <div class="row align-items-center">-->
<!--                            <div class="col-md-6">-->
<!--                                <p class="main-img__text-date">1<span class="minus"></span>5 июня</p>-->
<!--                            </div>-->
<!--                            <div class="col-md-6">-->
<!--                                <p class="main-img__text-location">Курорт «Красная Поляна» <span>Локация та же</span></p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <p class="main-img__text-decs">Всё как ты любишь<br> там, где ты любишь</p>-->
<!--                    </div>-->
<!--                </div>-->

                <div class="gss-mainpage-statistics-mobile">
                    <div class="social-icons">

                    </div>
                </div>

                <section class="page-section">
                    <div class="container">
                        <div class="about-event">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <h2 class="section-headline mb-md-5">Как это будет?</h2>
                                        </div>
                                        <div class="col-6">
                                            <div class="entry">
                                                <p class="num">5000</p>
                                                <p class="text">участников</p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="entry">
                                                <p class="num">200+</p>
                                                <p class="text">спикеров и&nbsp;шефов</p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="entry">
                                                <p class="num">200+</p>
                                                <p class="text">мастер классов и&nbsp;семинаров</p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="entry">
                                                <p class="num">20+</p>
                                                <p class="text">образовательных площадок</p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="entry">
                                                <p class="num">4</p>
                                                <p class="text">дня в&nbsp;закрытом лагере для взрослых</p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="entry">
                                                <p class="num">∞</p>
                                                <p class="text">возможностей для общения и&nbsp;новых знакомств</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="instagram-header-gallery">
                                        <div class="gallery-col">
                                            <img src="/images/collages/kollag_1.jpg" alt="">
                                            <div class="gallery-row">
                                                <div class="gallery-col-1of2">
                                                    <img src="/images/collages/kollag_2.jpg" alt="">
                                                </div>
                                                <div class="gallery-col-1of2">
                                                    <img src="/images/collages/kollag_3.jpg" alt="">
                                                </div>
                                            </div>
                                            <img src="/images/collages/kollag_4.jpg" alt="">
                                        </div>
                                        <div class="gallery-col">
                                            <img src="/images/collages/kollag_5.jpg" alt="">
                                            <div class="gallery-row">
                                                <div class="gallery-col-1of2">
                                                    <img src="/images/collages/kollag_6.jpg" alt="">
                                                </div>
                                                <div class="gallery-col-1of2">
                                                    <img src="/images/collages/kollag_7.jpg" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ef_tagss_wrapper d-none">
                        <div class="ef_tags_01"></div>
                        <div class="ef_tags_02"></div>
                        <div class="ef_tags_03"></div>
                    </div>
                </section>

                <!-- блок СПИКЕРЫ -->
                <?php if ($this->_tpl_vars['spmList']): ?>
                <section class="page-section mt-4">
                    <div class="container">
                        <section class="page-section">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2 class="section-headline"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Speakers<?php else: ?>Спикеры<?php endif; ?></h2>
                                </div>
                                <div class="col-md-6 text-right">
                                    <div class="more">
                                        <a class="more-link" href="<?php echo smarty_function_link(array('show' => 'speakers'), $this);?>
">
                                            <span class="gss-all-speackers-link-mobile"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>All Speakers<?php else: ?>Все спикеры<?php endif; ?> <i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                            <span class="gss-all-speackers-link-pc"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>View all Speakers<?php else: ?>Посмотреть всех спикеров<?php endif; ?> <i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="speakers-carousel js-speakers-carousel">
                                <ul class="owl-carousel carousel js-carousel speakers_2019">
                                    <!-- loop start -->
                                    <?php $_from = $this->_tpl_vars['spmList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['speaker']):
?>
                                    <li>
                                        <a class="person-teaser js-popover <?php echo ((is_array($_tmp=$this->_tpl_vars['speaker']['tags'])) ? $this->_run_mod_handler('tagtocssclass', true, $_tmp) : smarty_modifier_tagtocssclass($_tmp)); ?>
" href="#" data-speaker-id="<?php echo $this->_tpl_vars['speaker']['id']; ?>
" data-timer="on">
                                            <div class="img-tags">
                                                <?php echo ((is_array($_tmp=$this->_tpl_vars['speaker']['tags'])) ? $this->_run_mod_handler('tagformat', true, $_tmp) : smarty_modifier_tagformat($_tmp)); ?>

                                                <?php if ($this->_tpl_vars['speaker']['partner_id'] > 0): ?>
                                                    <img class="foreground" src="/images/parthners/resized/<?php echo $this->_tpl_vars['speaker']['p_pic']; ?>
?v=<?php echo $this->_tpl_vars['speaker']['tsUpdated']; ?>
" data-ratio="1" alt="">
                                                <?php endif; ?>
                                            </div>
                                            <?php if ($this->_tpl_vars['speaker']['country'] != 'ru'): ?>
                                            <div class="icon-country <?php echo $this->_tpl_vars['speaker']['country']; ?>
"></div>
                                            <?php endif; ?>
                                            <div class="volunteer_medal_main speaker_medal_main"><?php echo ((is_array($_tmp=$this->_tpl_vars['speaker']['years'])) ? $this->_run_mod_handler('yeartomedal', true, $_tmp) : smarty_modifier_yeartomedal($_tmp)); ?>
</div>
                                            <?php if ($this->_tpl_vars['speaker']['pic1']): ?>
                                                <img src="/images/speackers/resized/<?php echo $this->_tpl_vars['speaker']['pic1']; ?>
?v=<?php echo $this->_tpl_vars['speaker']['tsUpdated']; ?>
" data-ratio="1" alt="">
                                            <?php else: ?>
                                                <img src="/images/gss/speaker.jpg" data-ratio="1" alt="">
                                            <?php endif; ?>

                                            <div class="about">
                                                <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                                                    <p class="name"><?php echo $this->_tpl_vars['speaker']['name_en']; ?>
<?php if ($this->_tpl_vars['speaker']['michelin']): ?> <span class="michelin michelin_<?php echo $this->_tpl_vars['speaker']['michelin']; ?>
"></span><?php endif; ?><br/><?php echo $this->_tpl_vars['speaker']['secondName_en']; ?>
</p>
                                                    <p class="job"><?php echo $this->_tpl_vars['speaker']['company_en']; ?>
<?php if ($this->_tpl_vars['speaker']['cityName_en']): ?><br/><?php echo $this->_tpl_vars['speaker']['cityName_en']; ?>
<?php endif; ?></p>
                                                <?php else: ?>
                                                    <p class="name"><?php echo $this->_tpl_vars['speaker']['name']; ?>
<?php if ($this->_tpl_vars['speaker']['michelin']): ?> <span class="michelin michelin_<?php echo $this->_tpl_vars['speaker']['michelin']; ?>
"></span><?php endif; ?><br/><?php echo $this->_tpl_vars['speaker']['secondName']; ?>
</p>
                                                    <p class="job"><?php echo $this->_tpl_vars['speaker']['company']; ?>
<?php if ($this->_tpl_vars['speaker']['cityName']): ?><br/><?php echo $this->_tpl_vars['speaker']['cityName']; ?>
<?php endif; ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </a>
                                    </li>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <!-- loop end -->
                                </ul>
                                <div class="controls">
                                    <div class="dots js-dots-speakers">&nbsp;</div>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>
                <div class="modal fade" id="speaker-modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content popover-win">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body"></div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <section class="page-section page_body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <h2 class="section-headline"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Tickets<?php else: ?>Билеты<?php endif; ?></h2>
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="more">
                                    <a class="more-link" href="/catalog">
                                        <span class="gss-all-speackers-link-mobile">Подробнее о билетах <i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                        <span class="gss-all-speackers-link-pc">Подробнее о билетах <i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="ticket main-ticket ticket-king">
                                    <?php $this->assign('ticketId', 5); ?> <!-- УКАЗАТЬ ID БИЛЕТА «Как король» -->
                                    <?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
                                    <div>
                                        <a href="/catalog">
                                            <h2 class="ticket_header"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></h2>
                                            <p>Могу себе позволить</p>
                                        </a>
                                        <div class="tinkoff-credit">
                                            <a href="#" data-toggle="modal" data-target="#tinkoffModal">Купить в рассрочку</a>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
                                        <p class="ticket_new_cost">190&nbsp;000&nbsp;₽ с&nbsp;01.03.2020<br>
                                                                    200&nbsp;000&nbsp;₽ с&nbsp;01.05.2020</p>
                                        <?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
                                        <div>
                                            <a href="#" class="btn btn-white btn-line buy-ticket-click" <?php if ($this->_tpl_vars['this']['child']->id > 0): ?>data-extuser="<?php echo $this->_tpl_vars['this']['child']->id; ?>
"<?php endif; ?> data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
">
                                                Buy
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="ticket main-ticket ticket-rebro">
                                    <?php $this->assign('ticketId', 8); ?> <!-- УКАЗАТЬ ID БИЛЕТА «Ребро» -->
                                    <?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
                                    <div>
                                        <a href="/catalog">
                                            <h2 class="ticket_header"><img src="/images/rebro_green-logo.png" alt="ReBro"></h2>
                                            <p>Для владельцев<br>
                                                бизнеса ONLY</p>
                                        </a>
                                        <div class="tinkoff-credit">
                                            <a href="#" data-toggle="modal" data-target="#tinkoffModal">Купить в рассрочку</a>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
                                        <p class="ticket_new_cost">65&nbsp;000&nbsp;₽ с&nbsp;01.03.2020<br>
                                                                    70&nbsp;000&nbsp;₽ с&nbsp;01.05.2020</p>
                                        <?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
                                        <?php if ($this->_tpl_vars['this']['child']->wantRebro == 1 || $this->_tpl_vars['ticket']->wantRebro == 1): ?>
                                        <div class="capacity"><span>Мы приняли вашу заявку!</span></div>
                                        <?php else: ?>
                                        <div>
                                            <a href="<?php echo smarty_function_link(array('do' => 'add','ticket' => 'rebro'), $this);?>
" class="btn btn-white btn-line">
                                                <?php if ($this->_tpl_vars['lang'] == 'en'): ?>Submit your application<?php else: ?>Подать заявку<?php endif; ?>
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="ticket main-ticket ticket-profi">
                                    <?php $this->assign('ticketId', 3); ?> <!-- УКАЗАТЬ ID БИЛЕТА «Профи» -->
                                    <?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
                                    <div>
                                        <div class="ticket-hit">Хит продаж</div>
                                        <a href="/catalog">
                                            <h2 class="ticket_header"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></h2>
                                            <p>Оптимальный<br>
                                                вариант, роднуль</p>
                                        </a>
                                        <div class="tinkoff-credit">
                                            <a href="#" data-toggle="modal" data-target="#tinkoffModal">Купить в рассрочку</a>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
                                        <p class="ticket_new_cost">40&nbsp;000&nbsp;₽ с&nbsp;01.03.2020<br>
                                                                    45&nbsp;000&nbsp;₽ с&nbsp;01.05.2020</p>
                                        <?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
                                        <div>
                                            <a href="#" class="btn btn-white btn-line buy-ticket-click" <?php if ($this->_tpl_vars['this']['child']->id > 0): ?>data-extuser="<?php echo $this->_tpl_vars['this']['child']->id; ?>
"<?php endif; ?> data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
">
                                                Buy
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="ticket main-ticket ticket-chef">
                                    <?php $this->assign('ticketId', 2); ?> <!-- УКАЗАТЬ ID БИЛЕТА «Шефский» -->
                                    <?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
                                    <div>
                                        <a href="/catalog">
                                            <h2 class="ticket_header"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></h2>
                                            <p>Для будущих<br>
                                                и настоящих шефов</p>
                                        </a>
                                        <div class="tinkoff-credit">
                                            <a href="#" data-toggle="modal" data-target="#tinkoffModal">Купить в рассрочку</a>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
                                        <p class="ticket_new_cost">35&nbsp;000&nbsp;₽ с&nbsp;01.03.2020<br>
                                                                    40&nbsp;000&nbsp;₽ с&nbsp;01.05.2020</p>
                                        <?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
                                        <div>
                                            <a href="#" class="btn btn-white btn-line buy-ticket-click" <?php if ($this->_tpl_vars['this']['child']->id > 0): ?>data-extuser="<?php echo $this->_tpl_vars['this']['child']->id; ?>
"<?php endif; ?> data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
">
                                                Buy
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="ticket main-ticket ticket-barstreet">
                                    <?php $this->assign('ticketId', 4); ?> <!-- УКАЗАТЬ ID БИЛЕТА «Barstreet» -->
                                    <?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
                                    <div>
                                        <a href="/catalog">
                                            <h2 class="ticket_header"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></h2>
                                            <p>Для тех, кто<br>
                                                с баром и за баром</p>
                                        </a>
                                        <div class="tinkoff-credit">
                                            <a href="#" data-toggle="modal" data-target="#tinkoffModal">Купить в рассрочку</a>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
                                        <p class="ticket_new_cost">25&nbsp;000&nbsp;₽ с&nbsp;01.03.2020<br>
                                                                    30&nbsp;000&nbsp;₽ с&nbsp;01.05.2020</p>
                                        <?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
                                        <div>
                                            <a href="#" class="btn btn-white btn-line buy-ticket-click" <?php if ($this->_tpl_vars['this']['child']->id > 0): ?>data-extuser="<?php echo $this->_tpl_vars['this']['child']->id; ?>
"<?php endif; ?> data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
">
                                                Buy
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="ticket main-ticket ticket-host">
                                    <?php $this->assign('ticketId', 10); ?> <!-- УКАЗАТЬ ID БИЛЕТА «Host street» -->
                                    <?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
                                    <div>
                                        <a href="/catalog">
                                            <h2 class="ticket_header"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></h2>
                                            <p>Отельерам<br>
                                                будет полезно</p>
                                        </a>
                                        <div class="tinkoff-credit">
                                            <a href="#" data-toggle="modal" data-target="#tinkoffModal">Купить в рассрочку</a>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
                                        <p class="ticket_new_cost">25&nbsp;000&nbsp;₽ с&nbsp;01.03.2020<br>
                                                                    30&nbsp;000&nbsp;₽ с&nbsp;01.05.2020</p>
                                        <?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
                                        <div>
                                            <a href="#" class="btn btn-white btn-line buy-ticket-click" <?php if ($this->_tpl_vars['this']['child']->id > 0): ?>data-extuser="<?php echo $this->_tpl_vars['this']['child']->id; ?>
"<?php endif; ?> data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
">
                                                Buy
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Modal -->
                <div class="modal fade" id="tinkoffModal" tabindex="-1" role="dialog" aria-labelledby="tinkoffModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body tinkoff-body">
                                <img src="/images/tinkoff-logo.png" alt="Тинькофф" class="img-fluid">
                                <div class="h5 mb-3">Билеты в рассрочку</div>
                                <p>Теперь билеты на GASTREET можно купить в&nbsp;рассрочку на 4&nbsp;месяца. Просто в&nbsp;корзине выбери способ оплаты купить в&nbsp;рассрочку, заполни заявку на странице «Тинькофф банка», дождись ее одобрения и&nbsp;билет твой!</p>
                                <p>Дополнительной наценки и&nbsp;процентов нет. Ты платишь только за билет равными платежами, а&nbsp;услуги банка мы берем на себя.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- блок НОВОСТИ -->
                <?php if ($this->_tpl_vars['prizes']): ?>
                <section class="page-section">
                    <div class="container">
                        <section class="page-section">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2 class="section-headline"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>News<?php else: ?>Новости и ништяки<?php endif; ?></h2>
                                </div>
                                <div class="col-md-6 text-right">
                                    <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                                    <div class="more">
                                        <a class="more-link" href="<?php echo smarty_function_link(array('show' => 'prizes'), $this);?>
">
                                            <span class="gss-all-speackers-link-mobile">All goodies <i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                            <span class="gss-all-speackers-link-pc">See all news and goodies <i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                        </a>
                                    </div>
                                    <?php else: ?>
                                    <div class="more">
                                        <a class="more-link" href="<?php echo smarty_function_link(array('show' => 'prizes'), $this);?>
">
                                            <span class="gss-all-speackers-link-mobile">Bсе ништяки <i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                            <span class="gss-all-speackers-link-pc">Посмотреть все новости и ништяки <i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="speakers-carousel js-prizes-carousel">
                                <ul class="owl-carousel carousel js-carousel">
                                    <!-- loop start -->
                                    <?php $_from = $this->_tpl_vars['prizes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prize']):
?>
                                    <?php $this->assign('isPrizeImg1', ((is_array($_tmp=$this->_tpl_vars['prize']->id)) ? $this->_run_mod_handler('isprizepic', true, $_tmp) : smarty_modifier_isprizepic($_tmp))); ?>
                                    <li>
                                        <a class="person-teaser js-popover" href="#popover-win-prize-<?php echo $this->_tpl_vars['prize']->id; ?>
" data-popover="#popover-win-prize-<?php echo $this->_tpl_vars['prize']->id; ?>
" data-idyoutubevideo="<?php echo $this->_tpl_vars['idYoutubeVideo']; ?>
" data-timer="on">
                                            <?php if ($this->_tpl_vars['isPrizeImg1']): ?>
                                            <img src="/images/prizes/resized/<?php echo $this->_tpl_vars['prize']->id; ?>
.jpg?v=<?php echo $this->_tpl_vars['prize']->tsUpdate; ?>
" data-ratio="1" alt="">
                                            <?php else: ?>
                                            <img src="/images/gss/speaker.jpg" data-ratio="1" alt="">
                                            <?php endif; ?>
                                            <div class="prizes-about">
                                                <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                                                <p class="prizes-name"><?php echo $this->_tpl_vars['prize']->name_en; ?>
</p>
                                                <p class="prizes-job"><?php echo $this->_tpl_vars['prize']->annotation_en; ?>
</p>
                                                <?php else: ?>
                                                <p class="prizes-name"><?php echo $this->_tpl_vars['prize']->name; ?>
</p>
                                                <p class="prizes-job"><?php echo $this->_tpl_vars['prize']->annotation; ?>
</p>
                                                <?php endif; ?>
                                            </div>
                                        </a>
                                    </li>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <!-- loop end -->
                                </ul>
                                <div class="controls">
                                    <div class="dots js-dots-prizes">&nbsp;</div>
                                </div>
                                <?php $_from = $this->_tpl_vars['prizes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prize']):
?>
                                <?php $this->assign('idYoutubeVideo', ((is_array($_tmp=$this->_tpl_vars['prize']->youtube)) ? $this->_run_mod_handler('getidyoutubevideo', true, $_tmp) : smarty_modifier_getidyoutubevideo($_tmp))); ?>
                                <?php $this->assign('isPrizeImg1', ((is_array($_tmp=$this->_tpl_vars['prize']->id)) ? $this->_run_mod_handler('isprizepic', true, $_tmp) : smarty_modifier_isprizepic($_tmp))); ?>
                                <div class="modal fade" id="popover-win-prize-<?php echo $this->_tpl_vars['prize']->id; ?>
" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="popover-win">
                                                <span class="close" data-dismiss="modal">&times;</span>
                                                <?php if ($this->_tpl_vars['prize']->youtube): ?>
                                                <div class="thumb">
                                                    <iframe width="100%" height="350" src="https://www.youtube.com/embed/<?php echo $this->_tpl_vars['prize']->youtube; ?>
" frameborder="0" allowfullscreen></iframe>
                                                </div>
                                                <?php else: ?>
                                                <figure class="thumb fg-container">
                                                    <?php if ($this->_tpl_vars['isPrizeImg1']): ?>
                                                    <img src="/images/prizes/resized/<?php echo $this->_tpl_vars['prize']->id; ?>
.jpg?v=<?php echo $this->_tpl_vars['prize']->tsUpdate; ?>
" alt="">
                                                    <?php else: ?>
                                                    <img src="/images/gss/speaker.jpg" alt="">
                                                    <?php endif; ?>
                                                </figure>
                                                <?php endif; ?>
                                                <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                                                <p class="title"><?php echo $this->_tpl_vars['prize']->name_en; ?>
</p>
                                                <div class="desc">
                                                    <p><?php echo ((is_array($_tmp=$this->_tpl_vars['prize']->description_en)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
</p>
                                                </div>
                                                <?php else: ?>
                                                <p class="title"><?php echo $this->_tpl_vars['prize']->name; ?>
</p>
                                                <div class="desc">
                                                    <p><?php echo ((is_array($_tmp=$this->_tpl_vars['prize']->description)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
</p>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; endif; unset($_from); ?>
                            </div>
                        </section>
                    </div>
                </section>
                <?php endif; ?>

                <section class="page-section mt-5 pt-4">
                    <div class="container subscribtion_form">
                        <div class="row justify-content-md-center">
                            <div class="col-md-8">
                                <div class="h3">Хочешь быть в&nbsp;курсе всех ништяков?</div>
                                <p class="mb-4">Напиши свой e-mail, чтобы первым узнавать о&nbsp;новостях, акциях и&nbsp;прочих фишках от GASTREET TEAM.</p>
                            </div>
                            <div class="col-md-12">
                                <form method="POST" action="https://cp.unisender.com/ru/subscribe?hash=6k91tzjpra6o7hirwfz8ses16cm9539ercrt3sckxydoj1gttnsey" name="subscribtion_form">
                                    <div class="form-group row justify-content-md-center align-items-center">
                                        <div class="col-7 col-md-4">
                                            <input class="form-control" type="text" name="email" value="" placeholder="E-mail">
                                        </div>
                                        <div class="col-5 col-md-3">
                                            <input class="btn btn-subscript m-0" type="submit" value="Подписаться">
                                        </div>
                                    </div>

                                    <input type="hidden" name="charset" value="UTF-8">
                                    <input type="hidden" name="default_list_id" value="19466253">
                                    <input type="hidden" name="overwrite" value="2">
                                    <input type="hidden" name="is_v5" value="1">
                                </form>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- VIDEO CAROUSEL -->
                <section class="page-section">
                    <div class="jumbotron-video" style="background-image: url(https://i.ytimg.com/vi/vVgdeq1AX1M/maxresdefault.jpg);">
                        <h2 class="title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>How was it last year?<?php else: ?>Как это было в 2019 году?<?php endif; ?><br/><span class="gss-video-watch"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Watch the video<?php else: ?>Смотрите видео<?php endif; ?></span></h2><br/><br/><br/>
                        <div class="js-videos-gallery">
                            <div class=""><a class="video-teaser js-video-item"  data-target="#video-modal" data-toggle="modal" data-link="vVgdeq1AX1M" data-title="<?php if ($this->_tpl_vars['lang'] == 'en'): ?>How was it last year?<?php else: ?>Как это было в 2019 году?<?php endif; ?>" href="https://youtu.be/vVgdeq1AX1M"></a></div>
                        </div>
                    </div>
                    <?php if ($this->_tpl_vars['vmList']): ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <h2 class="section-headline"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Final Video<?php else: ?>Итоговое видео<?php endif; ?></h2>
                            </div>
                            <div class="col-md-6 text-right">
                                <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                                <div class="more">
                                    <a class="more-link" href="<?php echo smarty_function_link(array('show' => 'video'), $this);?>
">
                                        <span class="gss-all-speackers-link-mobile">All video <i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                        <span class="gss-all-speackers-link-pc">See all video <i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                    </a>
                                </div>
                                <?php else: ?>
                                <div class="more">
                                    <a class="more-link" href="<?php echo smarty_function_link(array('show' => 'video'), $this);?>
">
                                        <span class="gss-all-speackers-link-mobile">Bсе видео <i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                        <span class="gss-all-speackers-link-pc">Посмотреть все видео <i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="videos-carousel js-videos-gallery">
                            <ul class="owl-carousel carousel js-carousel">
                                <?php $_from = $this->_tpl_vars['vmList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['video']):
?>
                                <?php if ($this->_tpl_vars['video']->v_group == 1): ?>
                                <li>
                                    <div class="l-as-row">
                                        <a class="video-teaser js-video-item" data-target="#video-modal" data-toggle="modal" data-link="<?php echo $this->_tpl_vars['video']->url; ?>
" data-title="<?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['video']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['video']->name; ?>
<?php endif; ?>" href="https://youtu.be/<?php echo $this->_tpl_vars['video']->url; ?>
">
                                            <img src="https://i.ytimg.com/vi/<?php echo $this->_tpl_vars['video']->url; ?>
/hqdefault.jpg" alt="">
                                            <p class="title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['video']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['video']->name; ?>
<?php endif; ?></p>
                                        </a>
                                    </div>
                                </li>
                                <?php endif; ?>
                                <?php endforeach; endif; unset($_from); ?>
                            </ul>
                            <div class="controls">
                                <div class="dots js-dots-videos">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </section>
                <!-- END OF VIDEO CAROUSEL -->

<!--                <section class="page-section">-->
<!--                    <div class="container">-->
<!--                        <div class="instagram-gallery">-->
<!--                            <div class="gallery-col">-->
<!--                                <h2 class="section-headline" style="margin-top:3.63rem;margin-bottom:3.4rem;">Gastreet<br> History</h2>-->
<!--                                <img src="/images/collages/mainpage1.jpg">-->
<!--                            </div>-->
<!--                            <div class="gallery-col">-->
<!--                                <img src="/images/collages/mainpage2.jpg?v=1">-->
<!--                                <div class="gallery-row">-->
<!--                                    <div class="gallery-col-1of2"><img src="/images/collages/mainpage3.jpg"></div>-->
<!--                                    <div class="gallery-col-1of2"><img src="/images/collages/mainpage4.jpg"></div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="gallery-col">-->
<!--                                <img src="/images/collages/mainpage5.jpg">-->
<!--                                <div class="gallery-row">-->
<!--                                    <div class="gallery-col-1of2"><img src="/images/collages/mainpage6.jpg?v=1"></div>-->
<!--                                    <div class="gallery-col-1of2"><img src="/images/collages/mainpage7.jpg?v=1"></div>-->
<!--                                </div>-->
<!--                                <img src="/images/collages/mainpage8.jpg">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </section>-->

                <?php if ($this->_tpl_vars['parthners']): ?>
                <?php $this->assign('pkey', 0); ?>
                <section class="page-section d-none">
                    <div class="container">
                        <h2 class="section-headline has-align-center has-size-sm"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The organizers<?php else: ?>Организаторы<?php endif; ?></h2>
                        <div class="partners-list">
                            <ul>
                                <?php $_from = $this->_tpl_vars['parthners']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['parthner']):
?>
                                    <?php if ($this->_tpl_vars['parthner']->parthnerTypeId == 2): ?>
                                        <li class="gss-parthner-show-one gss-parthner-one-li-<?php echo $this->_tpl_vars['pkey']; ?>
" <?php if ($this->_tpl_vars['pkey'] > 12): ?> style="display: none;" class="hidden-parthner-one"<?php endif; ?>>
                                            <div class="gss-parthner-text">&nbsp;<?php echo $this->_tpl_vars['parthner']->title; ?>
&nbsp;</div>
                                            <figure><?php if ($this->_tpl_vars['parthner']->url): ?><a href="<?php echo $this->_tpl_vars['parthner']->url; ?>
" title="<?php echo $this->_tpl_vars['parthner']->name; ?>
" target="_blank" rel="nofollow"><?php endif; ?><img src="/images/parthners/resized/<?php echo $this->_tpl_vars['parthner']->pic; ?>
?v=<?php echo $this->_tpl_vars['parthner']->tsUpdate; ?>
" alt=""><?php if ($this->_tpl_vars['parthner']->url): ?></a><?php endif; ?></figure>
                                        </li>
                                        <?php $this->assign('pkey', $this->_tpl_vars['pkey']+1); ?>
                                    <?php endif; ?>
                                <?php endforeach; endif; unset($_from); ?>
                            </ul>
                            <?php if ($this->_tpl_vars['pkey'] > 13): ?><div class="more" id="show-all-parthners-one"><a id="show-all-parthners-button-one" class="more-link has-icon-down" href="#"><span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>View all partners<?php else: ?>Посмотреть всех партнеров<?php endif; ?></span></a></div><?php endif; ?>
                        </div>
                    </div>
                </section>

                <?php $this->assign('pkey', 0); ?>
                <section class="page-section">
                    <div class="container">
                        <h2 class="section-headline has-align-center has-size-sm"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Event partners<?php else: ?>Партнеры мероприятия<?php endif; ?></h2>
                        <div class="partners-list">
                            <ul>
                                <?php $_from = $this->_tpl_vars['parthners']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['parthner']):
?>
                                    <?php if ($this->_tpl_vars['parthner']->parthnerTypeId == 1): ?>
                                        <li class="gss-parthner-show-one gss-parthner-one-li-<?php echo $this->_tpl_vars['pkey']; ?>
"<?php if ($this->_tpl_vars['pkey'] > 13): ?> style="display: none;" class="hidden-parthner-one"<?php endif; ?>>
                                            <div class="gss-parthner-text">&nbsp;<?php echo $this->_tpl_vars['parthner']->title; ?>
&nbsp;</div>
                                            <figure><?php if ($this->_tpl_vars['parthner']->url): ?><a href="<?php echo $this->_tpl_vars['parthner']->url; ?>
" title="<?php echo $this->_tpl_vars['parthner']->name; ?>
" target="_blank" rel="nofollow"><?php endif; ?><img src="/images/parthners/resized/<?php echo $this->_tpl_vars['parthner']->pic; ?>
?v=<?php echo $this->_tpl_vars['parthner']->tsUpdate; ?>
" alt=""><?php if ($this->_tpl_vars['parthner']->url): ?></a><?php endif; ?></figure>
                                        </li>
                                        <?php $this->assign('pkey', $this->_tpl_vars['pkey']+1); ?>
                                    <?php endif; ?>
                                <?php endforeach; endif; unset($_from); ?>
                            </ul>
                        </div>
                    </div>
                </section>

                <?php $this->assign('pkey', 0); ?>
                <section class="page-section">
                    <div class="container">
                        <h2 class="section-headline has-align-center has-size-sm">Партнеры по организации</h2>
                        <div class="partners-list">
                            <ul>
                                <?php $_from = $this->_tpl_vars['parthners']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['parthner']):
?>
                                    <?php if ($this->_tpl_vars['parthner']->parthnerTypeId == 5): ?>
                                        <li class="gss-parthner-show-one gss-parthner-one-li-<?php echo $this->_tpl_vars['pkey']; ?>
"<?php if ($this->_tpl_vars['pkey'] > 5): ?> style="display: none;" class="hidden-parthner-one"<?php endif; ?>>
                                            <div class="gss-parthner-text">&nbsp;<?php echo $this->_tpl_vars['parthner']->title; ?>
&nbsp;</div>
                                            <figure><?php if ($this->_tpl_vars['parthner']->url): ?><a href="<?php echo $this->_tpl_vars['parthner']->url; ?>
" title="<?php echo $this->_tpl_vars['parthner']->name; ?>
" target="_blank" rel="nofollow"><?php endif; ?><img src="/images/parthners/resized/<?php echo $this->_tpl_vars['parthner']->pic; ?>
?v=<?php echo $this->_tpl_vars['parthner']->tsUpdate; ?>
" alt=""><?php if ($this->_tpl_vars['parthner']->url): ?></a><?php endif; ?></figure>
                                        </li>
                                        <?php $this->assign('pkey', $this->_tpl_vars['pkey']+1); ?>
                                    <?php endif; ?>
                                <?php endforeach; endif; unset($_from); ?>
                            </ul>
                            <?php if ($this->_tpl_vars['pkey'] > 6): ?><div class="more" id="show-all-parthners-one"><a id="show-all-parthners-button-one" class="more-link has-icon-down" href="#"><span>Посмотреть всех партнеров</span></a></div><?php endif; ?>
                        </div>
                    </div>
                </section>

                <?php $this->assign('pkey', 0); ?>
                <section class="page-section d-none">
                    <div class="container">
                        <h2 class="section-headline has-align-center has-size-sm"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Barstreet partners<?php else: ?>Партнеры Барстрит<?php endif; ?></h2>
                        <div class="partners-list">
                            <ul>
                                <?php $_from = $this->_tpl_vars['parthners']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['parthner']):
?>
                                    <?php if ($this->_tpl_vars['parthner']->parthnerTypeId == 4): ?>
                                        <li class="gss-parthner-show-one gss-parthner-one-li-<?php echo $this->_tpl_vars['pkey']; ?>
"<?php if ($this->_tpl_vars['pkey'] > 12): ?> style="display: none;" class="hidden-parthner-one"<?php endif; ?>>
                                            <div class="gss-parthner-text">&nbsp;<?php echo $this->_tpl_vars['parthner']->title; ?>
&nbsp;</div>
                                            <figure><?php if ($this->_tpl_vars['parthner']->url): ?><a href="<?php echo $this->_tpl_vars['parthner']->url; ?>
" title="<?php echo $this->_tpl_vars['parthner']->name; ?>
" target="_blank" rel="nofollow"><?php endif; ?><img src="/images/parthners/resized/<?php echo $this->_tpl_vars['parthner']->pic; ?>
?v=<?php echo $this->_tpl_vars['parthner']->tsUpdate; ?>
" alt=""><?php if ($this->_tpl_vars['parthner']->url): ?></a><?php endif; ?></figure>
                                        </li>
                                        <?php $this->assign('pkey', $this->_tpl_vars['pkey']+1); ?>
                                    <?php endif; ?>
                                <?php endforeach; endif; unset($_from); ?>
                            </ul>
                            <?php if ($this->_tpl_vars['pkey'] > 6): ?><div class="more" id="show-all-parthners-one"><a id="show-all-parthners-button-one" class="more-link has-icon-down" href="#"><span>Посмотреть всех партнеров</span></a></div><?php endif; ?>
                        </div>
                    </div>
                </section>

                <?php $this->assign('pkey', 0); ?>
                <section class="page-section d-none">
                    <div class="container">
                        <h2 class="section-headline has-align-center has-size-sm" style="font-size: 1.7rem;margin: 0;"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Information partners<?php else: ?>Информационные партнеры<?php endif; ?></h2>
                        <div class="partners-list">
                            <ul>
                                <?php $_from = $this->_tpl_vars['parthners']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['parthner']):
?>
                                    <?php if ($this->_tpl_vars['parthner']->parthnerTypeId == 3): ?>
                                        <li class="gss-parthner-show-three gss-parthner-three-li-<?php echo $this->_tpl_vars['pkey']; ?>
"<?php if ($this->_tpl_vars['pkey'] > 6): ?> style="display: none;" class="hidden-parthner-three"<?php endif; ?>>
                                            <div class="gss-parthner-text">&nbsp;<?php echo $this->_tpl_vars['parthner']->title; ?>
&nbsp;</div>
                                            <figure><?php if ($this->_tpl_vars['parthner']->url): ?><a href="<?php echo $this->_tpl_vars['parthner']->url; ?>
" title="<?php echo $this->_tpl_vars['parthner']->name; ?>
" target="_blank" rel="nofollow"><?php endif; ?><img src="/images/parthners/resized/<?php echo $this->_tpl_vars['parthner']->pic; ?>
?v=<?php echo $this->_tpl_vars['parthner']->tsUpdate; ?>
" alt=""><?php if ($this->_tpl_vars['parthner']->url): ?></a><?php endif; ?></figure>
                                        </li>
                                        <?php $this->assign('pkey', $this->_tpl_vars['pkey']+1); ?>
                                    <?php endif; ?>
                                <?php endforeach; endif; unset($_from); ?>
                            </ul>
                            <?php if ($this->_tpl_vars['pkey'] > 6): ?><div class="more" id="show-all-parthners-three"><a id="show-all-parthners-button-three" class="more-link has-icon-down" href="#"><span>Посмотреть всех партнеров</span></a></div><?php endif; ?>
                        </div>
                    </div>
                </section>
                <?php endif; ?>
                <?php echo smarty_function_control(array('name' => 'Age'), $this);?>

            </div>
            <section class="page-section d-none">
                <div class="container text-center">
                    <a class="more-link" target="_blank" href="/pdf/gastreet19_partners.pdf"><span>Каталог партнеров</span></a>
                </div>
            </section>
        </main>
        <?php echo smarty_function_control(array('name' => 'Footer'), $this);?>

        <?php echo smarty_function_control(array('name' => 'Webstat'), $this);?>

        <?php echo smarty_function_control(array('name' => 'Avatarlink'), $this);?>


        <?php if ($this->_tpl_vars['jivoSite'] == 1): ?>
            <?php echo smarty_function_loadscript(array('file' => '/js/jivosite.js','type' => 'js'), $this);?>

        <?php endif; ?>
        <?php echo smarty_function_loadscript(array('file' => '/js/jquery.min.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/modernizr/modernizr.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/viewport-size/viewportSize-min.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/css/bootstrap4/js/popper.min.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/css/bootstrap4/js/bootstrap.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/owl.carousel/owl.carousel.min.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/lightgallery/js/lightgallery.min.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/lightgallery/js/lg-video.min.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/isotope/isotope.pkgd.min.js','type' => 'js'), $this);?>


        <?php echo smarty_function_loadscript(array('file' => '/js/jquery.cookie.js','type' => 'js'), $this);?>


        <?php echo smarty_function_loadscript(array('file' => '/js/jquery.capSlide.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/app/layout.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/app/app.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/pages/catalog.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/vkpixel.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/fbpixel.js','type' => 'js'), $this);?>


        <?php echo $this->_tpl_vars['includedJS']; ?>

        <?php echo smarty_function_control(array('name' => 'Webbot'), $this);?>

    </body>
</html>