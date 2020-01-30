<?php /* Smarty version 2.6.13, created on 2020-01-13 17:27:49
         compiled from /home/c484884/gastreet.com/www/app/Templates/ScheduleControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/ScheduleControl.html', 20, false),array('modifier', 'tagtocssclass', '/home/c484884/gastreet.com/www/app/Templates/ScheduleControl.html', 154, false),array('modifier', 'inticket', '/home/c484884/gastreet.com/www/app/Templates/ScheduleControl.html', 154, false),array('modifier', 'dateformat', '/home/c484884/gastreet.com/www/app/Templates/ScheduleControl.html', 154, false),array('modifier', 'getproductpic', '/home/c484884/gastreet.com/www/app/Templates/ScheduleControl.html', 180, false),array('modifier', 'isspeakerpicpic', '/home/c484884/gastreet.com/www/app/Templates/ScheduleControl.html', 182, false),array('modifier', 'tagformat', '/home/c484884/gastreet.com/www/app/Templates/ScheduleControl.html', 185, false),array('modifier', 'escape', '/home/c484884/gastreet.com/www/app/Templates/ScheduleControl.html', 244, false),array('modifier', 'tag2desc', '/home/c484884/gastreet.com/www/app/Templates/ScheduleControl.html', 248, false),array('modifier', 'ispartnerpic', '/home/c484884/gastreet.com/www/app/Templates/ScheduleControl.html', 256, false),array('modifier', 'dbtexttohtml', '/home/c484884/gastreet.com/www/app/Templates/ScheduleControl.html', 261, false),array('modifier', 'strip_tags', '/home/c484884/gastreet.com/www/app/Templates/ScheduleControl.html', 266, false),array('modifier', 'round0', '/home/c484884/gastreet.com/www/app/Templates/ScheduleControl.html', 300, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ScheduleControl']); ?>

<?php if (! $this->_tpl_vars['app']): ?>
    <div class="jumbotron-blank">
        <div class="container">
            <div class="content">
                <ul class="breadcrumbs">
                    <li><a href="/">Главная</a></li>
                    <li><span>Программа</span></li>
                </ul>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="page_body">
    <div class="container">
        <div class="row">
            <?php if ($this->_tpl_vars['this']['products']): ?>
                <?php if ($this->_tpl_vars['this']['productId']): ?>
                <form action="<?php echo smarty_function_link(array('do' => 'add'), $this);?>
" method="post">
                    <input type="hidden" name="productId" value="<?php echo $this->_tpl_vars['this']['productId']; ?>
" />
                <?php endif; ?>
                    <div class="container schedule">
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="page-headline gss-speakers-title">Программа</h1>
                            </div>
                            <div class="col-md-6">
<!--                                <div class="g-emoji-content">-->
<!--                                    <div class="g-emoji-icon">-->
<!--                                        <img src="/images/emoji/8.png" class="img-fluid" alt="">-->
<!--                                    </div>-->
<!--                                    <div class="g-emoji-balun">-->
<!--                                        Чтобы не путаться, мы придумали удобные фильтры. Используй их для поиска-->
<!--                                    </div>-->
<!--                                </div>-->
                            </div>
                        </div>
                        <div class="row align-items-center" style="margin-bottom: 2rem;">
                            <div class="col-md-8">
                                <p style="font-size:16px;margin-bottom:1rem">Скоро здесь появится подробная информация о&nbsp;программе GASTREET&nbsp;2020. Мы прокачали любимые прошлогодние площадки и&nbsp;подготовили несколько новых. Как всегда, бесконечные возможности для общения и&nbsp;обучения в&nbsp;самом крутом закрытом лагере для шефов и&nbsp;рестораторов.</p>
                                <p style="font-size:16px;">Хочешь посмотреть, как мощно и&nbsp;круто это было в&nbsp;прошлом году, тогда велкам в&nbsp;<a href="http://2019.gastreet.com/schedule" target="_blank">программу прошлого года</a></p>
                            </div>
                            <div class="col-md-4">
                                <div class="alert alert-light alert-schedule alert-dismissible fade show" role="alert" style="position:relative;top:auto;left:auto;margin:0;">
                                    <p>Помни, что ты не сможешь отдельно докупить участие в&nbsp;мастер-классах.</p>
                                    <p>Тебе доступны только те события, которые входят в&nbsp;твой билет.</p>
                                    <a href="#" class="close" data-dismiss="alert" aria-label="Close">&times;</a>
                                </div>
                            </div>
                        </div>
                        <p class="note schedule-filter d-none">ФИЛЬТР <a href="javascript:void(0);" class="active" data-target=".schedule-filter-area">ПО ПЛОЩАДКЕ</a> <a href="javascript:void(0);" class="" data-target=".schedule-filter-ticket">ПО БИЛЕТУ</a> <a href="javascript:void(0);"  data-target=".schedule-filter-theme">ПО ТЕМЕ</a></p>
                    </div>
                    <div class="container">
                        <div class="tags-list tags-list-speakers schedule-filter-ticket" style="display: none;">
                            <ul>
                                <li class="gss-tag-li active"><a class="gss-tag-link" data-tag="all" title="" href="#"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>#All<?php else: ?>#Все<?php endif; ?></a></li>
                                <li class="gss-tag-li tag_king"><a class="gss-tag-link" data-tag="t_king" href="#">КАК КОРОЛЬ</a></li>
                                <li class="gss-tag-li tag_rebro"><a class="gss-tag-link" data-tag="t_rebro" href="#">REBRO</a></li>
                                <li class="gss-tag-li tag_mainstreet"><a class="gss-tag-link" data-tag="t_profi" href="#">ПРОФИ</a></li>
                                <li class="gss-tag-li tag_chefstreet"><a class="gss-tag-link" data-tag="t_chefs" href="#">ШЕФСКИЙ</a></li>
                                <li class="gss-tag-li tag_barstreet"><a class="gss-tag-link" data-tag="t_barstreet" href="#">BARSTREET</a></li>
                                <li class="gss-tag-li tag_pizzastreet"><a class="gss-tag-link" data-tag="t_pizzastreet" href="#">PIZZASTREET</a></li>
                                <li class="gss-tag-li tag_fun"><a class="gss-tag-link" data-tag="t_fun" href="#">FUN</a></li>
                                <li class="gss-tag-li tag_tourist"><a class="gss-tag-link" data-tag="t_tourist" href="#">ТУРИСТ</a></li>
                                <li class="gss-tag-li tag_buy"><a class="gss-tag-link" data-tag="t_buy" href="#">КУПИТЬ К БИЛЕТУ</a></li>
                            </ul>
                        </div>
                        <div class="tags-list tags-list-speakers schedule-filter-area d-none" style="position: relative;right: auto;top: auto;margin: 0;">
                            <ul>
                                <li class="gss-tag-li active"><a class="gss-tag-link" data-tag="all" title="" href="#"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>#All<?php else: ?>#Все<?php endif; ?></a></li>
                                <li class="gss-tag-li tag_centralnayaploshchad"><a class="gss-tag-link" data-tag="tag_centralnayaploshchad" title="#центральнаяплощадь" href="#">#центральнаяплощадь</a></li>
                                <li class="gss-tag-li tag_rebro"><a class="gss-tag-link" data-tag="tag_rebro" title="#rebro" href="#">#rebro</a></li>
                                <li class="gss-tag-li tag_mainstreet"><a class="gss-tag-link" data-tag="tag_mainstreet" title="#mainstreet" href="#">#mainstreet</a></li>
                                <li class="gss-tag-li tag_chefstreet"><a class="gss-tag-link" data-tag="tag_chefstreet" title="#chefstreet" href="#">#chefstreet</a></li>
                                <li class="gss-tag-li tag_barstreet"><a class="gss-tag-link" data-tag="tag_barstreet" title="#barstreet" href="#">#barstreet</a></li>
                                <li class="gss-tag-li tag_pizzastreet"><a class="gss-tag-link" data-tag="tag_pizzastreet" title="#pizzastreet" href="#">#pizzastreet</a></li>
                                <li class="gss-tag-li tag_businessschool"><a class="gss-tag-link" data-tag="tag_biznesshkola" title="#бизнесшкола" href="#">#бизнесшкола</a></li>
                                <li class="gss-tag-li tag_popupujiny"><a class="gss-tag-link" data-tag="tag_popupujiny" title="#бизнесшкола" href="#">#popup</a></li>
                                <li class="gss-tag-li tag_fuckup"><a class="gss-tag-link" data-tag="tag_fuckup" title="#fuckup" href="#">#fuckup</a></li>
                            </ul>
                        </div>
                        <div class="tags-list tags-list-speakers schedule-filter-theme" style="display: none;">
                            <ul>
                                <li class="gss-tag-li active"><a class="gss-tag-link" data-tag="all" title="" href="javascript:void(0);"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>#All<?php else: ?>#Все<?php endif; ?></a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_menedjment" title="#МЕНЕДЖМЕНТ" href="javascript:void(0);">#МЕНЕДЖМЕНТ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_marketing" title="#МАРКЕТИНГ" href="javascript:void(0);">#МАРКЕТИНГ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_personal" title="#ПЕРСОНАЛ" href="javascript:void(0);">#ПЕРСОНАЛ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_uvelicheniepribyli" title="#УВЕЛИЧЕНИЕПРИБЫЛИ" href="javascript:void(0);">#УВЕЛИЧЕНИЕПРИБЫЛИ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_otkrytierestorana" title="#ОТКРЫТИЕРЕСТОРАНА" href="javascript:void(0);">#ОТКРЫТИЕРЕСТОРАНА</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_krizisnoeupravlenie" title="#КРИЗИСНОЕУПРАВЛЕНИЕ" href="javascript:void(0);">#КРИЗИСНОЕУПРАВЛЕНИЕ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_zakony" title="#ЗАКОНЫ" href="javascript:void(0);">#ЗАКОНЫ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_nalogi" title="#НАЛОГИ" href="javascript:void(0);">#НАЛОГИ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_keytering" title="#КЕЙТЕРИНГ" href="javascript:void(0);">#КЕЙТЕРИНГ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_dostavka" title="#ДОСТАВКА" href="javascript:void(0);">#ДОСТАВКА</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_bezopasnost" title="#БЕЗОПАСНОСТЬ" href="javascript:void(0);">#БЕЗОПАСНОСТЬ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_sanitariya" title="#САНИТАРИЯ" href="javascript:void(0);">#САНИТАРИЯ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_proverki" title="#ПРОВЕРКИ" href="javascript:void(0);">#ПРОВЕРКИ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_haccp" title="#HACCP" href="javascript:void(0);">#HACCP</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_motivaciya" title="#МОТИВАЦИЯ" href="javascript:void(0);">#МОТИВАЦИЯ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_komanda" title="#КОМАНДА" href="javascript:void(0);">#КОМАНДА</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_finansy" title="#ФИНАНСЫ" href="javascript:void(0);">#ФИНАНСЫ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_rekruting" title="#РЕКРУТИНГ" href="javascript:void(0);">#РЕКРУТИНГ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_smm" title="#SMM" href="javascript:void(0);">#SMM</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_zakupki" title="#ЗАКУПКИ" href="javascript:void(0);">#ЗАКУПКИ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_postavshchiki" title="#ПОСТАВЩИКИ" href="javascript:void(0);">#ПОСТАВЩИКИ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_dokumentooborot" title="#ДОКУМЕНТООБОРОТ" href="javascript:void(0);">#ДОКУМЕНТООБОРОТ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_oborudovanie" title="#ОБОРУДОВАНИЕ" href="javascript:void(0);">#ОБОРУДОВАНИЕ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_startap" title="#СТАРТАП" href="javascript:void(0);">#СТАРТАП</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_sebestoimost" title="#СЕБЕСТОИМОСТЬ" href="javascript:void(0);">#СЕБЕСТОИМОСТЬ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_menyu" title="#МЕНЮ" href="javascript:void(0);">#МЕНЮ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_dizayn" title="#ДИЗАЙН" href="javascript:void(0);">#ДИЗАЙН</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_pr" title="#PR" href="javascript:void(0);">#PR</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_loyalnostgostey" title="#ЛОЯЛЬНОСТЬГОСТЕЙ" href="javascript:void(0);">#ЛОЯЛЬНОСТЬГОСТЕЙ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_koncepciyarestorana" title="#КОНЦЕПЦИЯРЕСТОРАНА" href="javascript:void(0);">#КОНЦЕПЦИЯРЕСТОРАНА</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_franchayzing" title="#ФРАНЧАЙЗИНГ" href="javascript:void(0);">#ФРАНЧАЙЗИНГ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_patent" title="#ПАТЕНТ" href="javascript:void(0);">#ПАТЕНТ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_upravlyayushchayakompaniya" title="#УПРАВЛЯЮЩАЯКОМПАНИЯ" href="javascript:void(0);">#УПРАВЛЯЮЩАЯКОМПАНИЯ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_fudmarket" title="#ФУДМАРКЕТ" href="javascript:void(0);">#ФУДМАРКЕТ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_digital" title="#DIGITAL" href="javascript:void(0);">#DIGITAL</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_investitsii" title="#ИНВЕСТИЦИИ" href="javascript:void(0);">#ИНВЕСТИЦИИ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_tovarnyyznak" title="#ТОВАРНЫЙЗНАК" href="javascript:void(0);">#ТОВАРНЫЙЗНАК</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_sanpin" title="#САНПИН" href="javascript:void(0);">#САНПИН</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_strategiya" title="#СТРАТЕГИЯ" href="javascript:void(0);">#СТРАТЕГИЯ</a></li>
                                <li class="gss-tag-li"><a class="gss-tag-link" data-tag="tag_razvitie" title="#РАЗВИТИЕ" href="javascript:void(0);">#РАЗВИТИЕ</a></li>
                            </ul>
                        </div>
                        <div class="tab-dates">
                            <a href="#" data-date="all" class="active">Все дни</a>
                            <a href="#" data-date="01" class=""><?php if ($this->_tpl_vars['lang'] == 'en'): ?>June 01st<?php else: ?>01 июня<?php endif; ?></a>
                            <a href="#" data-date="02" class=""><?php if ($this->_tpl_vars['lang'] == 'en'): ?>June 02st<?php else: ?>02 июня<?php endif; ?></a>
                            <a href="#" data-date="03" class=""><?php if ($this->_tpl_vars['lang'] == 'en'): ?>June 03st<?php else: ?>03 июня<?php endif; ?></a>
                            <a href="#" data-date="04" class=""><?php if ($this->_tpl_vars['lang'] == 'en'): ?>June 04st<?php else: ?>04 июня<?php endif; ?></a>
                            <a href="#" data-date="05" class=""><?php if ($this->_tpl_vars['lang'] == 'en'): ?>June 05st<?php else: ?>05 июня<?php endif; ?></a>
                        </div>
                    </div>
                    <div class="container schedule-table">
                    <?php $_from = $this->_tpl_vars['this']['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['productloop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['productloop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['productloop']['iteration']++;
?>
                        <?php if ($this->_tpl_vars['product']->areaId != 1 && $this->_tpl_vars['product']->areaId != 17 && $this->_tpl_vars['product']->areaId != 10 && $this->_tpl_vars['product']->areaId != 15 && $this->_tpl_vars['product']->areaId != 18): ?>
                            <?php $this->assign('placeid', $this->_tpl_vars['product']->placeId); ?>
                            <?php $this->assign('speakerid', $this->_tpl_vars['product']->speakerId); ?>
                            <?php $this->assign('speaker', $this->_tpl_vars['this']['speakers'][$this->_tpl_vars['speakerid']]); ?>
                            <?php $this->assign('speaker2id', $this->_tpl_vars['product']->speaker2Id); ?>
                            <?php $this->assign('speaker2', $this->_tpl_vars['this']['speakers'][$this->_tpl_vars['speaker2id']]); ?>
                            <?php $this->assign('speaker3id', $this->_tpl_vars['product']->speaker3Id); ?>
                            <?php $this->assign('speaker3', $this->_tpl_vars['this']['speakers'][$this->_tpl_vars['speaker3id']]); ?>
                            <?php $this->assign('speaker4id', $this->_tpl_vars['product']->speaker4Id); ?>
                            <?php $this->assign('speaker4', $this->_tpl_vars['this']['speakers'][$this->_tpl_vars['speaker4id']]); ?>
                            <?php $this->assign('speaker5id', $this->_tpl_vars['product']->speaker5Id); ?>
                            <?php $this->assign('speaker5', $this->_tpl_vars['this']['speakers'][$this->_tpl_vars['speaker5id']]); ?>
                            <?php $this->assign('speaker6id', $this->_tpl_vars['product']->speaker6Id); ?>
                            <?php $this->assign('speaker6', $this->_tpl_vars['this']['speakers'][$this->_tpl_vars['speaker6id']]); ?>

                            <div class="row block-body<?php echo ((is_array($_tmp=$this->_tpl_vars['product']->tags)) ? $this->_run_mod_handler('tagtocssclass', true, $_tmp) : smarty_modifier_tagtocssclass($_tmp)); ?>
<?php if ($this->_tpl_vars['product']->price > 0): ?> t_buy<?php endif; ?><?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 1) : smarty_modifier_inticket($_tmp, 1))): ?> t_tourist<?php endif; ?><?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 2) : smarty_modifier_inticket($_tmp, 2))): ?> t_chefs<?php endif; ?><?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 3) : smarty_modifier_inticket($_tmp, 3))): ?> t_profi<?php endif; ?><?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 4) : smarty_modifier_inticket($_tmp, 4))): ?> t_barstreet<?php endif; ?><?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 5) : smarty_modifier_inticket($_tmp, 5))): ?> t_king<?php endif; ?><?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 8) : smarty_modifier_inticket($_tmp, 8))): ?> t_rebro<?php endif; ?><?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 10) : smarty_modifier_inticket($_tmp, 10))): ?> t_pizzastreet<?php endif; ?><?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 14) : smarty_modifier_inticket($_tmp, 14))): ?> t_fun<?php endif; ?> row-date-<?php echo ((is_array($_tmp=$this->_tpl_vars['product']->eventTsStart)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd') : smarty_modifier_dateformat($_tmp, 'd')); ?>
">
                                <div class="col-md-12">
                                    <div id="gss-tag-id-<?php echo $this->_tpl_vars['product']->id; ?>
" class="row gss-tag-tr">
                                        <div class="col-md-2 td c-time d-none d-md-block d-lg-block d-xl-block">
                                            <?php if (((is_array($_tmp=$this->_tpl_vars['product']->eventTsStart)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'H') : smarty_modifier_dateformat($_tmp, 'H')) == '00' && ((is_array($_tmp=$this->_tpl_vars['product']->eventTsFinish)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'H') : smarty_modifier_dateformat($_tmp, 'H')) == '00'): ?>
                                                <?php if ($this->_tpl_vars['lang'] == 'en'): ?>Time to be confirmed<?php else: ?>Время уточняется<?php endif; ?>
                                            <?php else: ?>
                                                <b><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->eventTsStart)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd F') : smarty_modifier_dateformat($_tmp, 'd F')); ?>
</b>
                                                <div><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->eventTsStart)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'H:i') : smarty_modifier_dateformat($_tmp, 'H:i')); ?>
&nbsp;—&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['product']->eventTsFinish)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'H:i') : smarty_modifier_dateformat($_tmp, 'H:i')); ?>
</div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-8 col-md-3 td c-title  br-none">
                                            <div class="schedule-icon">
                                                <?php if ($this->_tpl_vars['this']['showcal']): ?>
                                                <a href="/calendar.php?id=<?php echo $this->_tpl_vars['product']->id; ?>
" title="Добавить в календарь">
                                                    <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                                                </a>
                                                <?php endif; ?>
                                                <a href="#" class="d-none" title="Добавить в избранное">
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <?php if ($this->_tpl_vars['product']->youtube): ?>
                                                <?php $this->assign('modalLink', $this->_tpl_vars['product']->youtube); ?>
                                            <?php else: ?>
                                                <?php if ($this->_tpl_vars['product']->pic1): ?>
                                                    <?php $this->assign('modalLink', ((is_array($_tmp=$this->_tpl_vars['product']->pic1)) ? $this->_run_mod_handler('getproductpic', true, $_tmp) : smarty_modifier_getproductpic($_tmp))); ?>
                                                <?php else: ?>
                                                    <?php $this->assign('modalLink', ((is_array($_tmp=$this->_tpl_vars['product']->speakerId)) ? $this->_run_mod_handler('isspeakerpicpic', true, $_tmp) : smarty_modifier_isspeakerpicpic($_tmp))); ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <div class="street-label"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->tags)) ? $this->_run_mod_handler('tagformat', true, $_tmp) : smarty_modifier_tagformat($_tmp)); ?>
</div>
                                            <div class="speaker">
                                                <?php if ($this->_tpl_vars['speaker']): ?>
                                                    <div class="desc">
                                                        <span><a href="#" data-speaker-id="<?php echo $this->_tpl_vars['speakerid']; ?>
"><?php echo $this->_tpl_vars['speaker']['name']; ?>
 <?php echo $this->_tpl_vars['speaker']['secondName']; ?>
</a></span>
                                                        <div><?php if ($this->_tpl_vars['speaker']['company']): ?><?php echo $this->_tpl_vars['speaker']['company']; ?>
,<br> <?php endif; ?><?php echo $this->_tpl_vars['speaker']['cityName']; ?>
</div>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="desc">
                                                        <span><a href="#" onclick="return false"><?php echo $this->_tpl_vars['product']->firstName; ?>
 <?php echo $this->_tpl_vars['product']->secondName; ?>
</a></span>
                                                        <div><?php if ($this->_tpl_vars['product']->company): ?><?php echo $this->_tpl_vars['product']->company; ?>
,<br> <?php endif; ?><?php echo $this->_tpl_vars['product']->cityName; ?>
</div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($this->_tpl_vars['speaker2']): ?>
                                                    <div class="gss-margintop5 desc">
                                                        <span><a href="#" data-speaker-id="<?php echo $this->_tpl_vars['speaker2id']; ?>
"><?php echo $this->_tpl_vars['speaker2']['name']; ?>
 <?php echo $this->_tpl_vars['speaker2']['secondName']; ?>
</a></span>
                                                        <div><?php echo $this->_tpl_vars['speaker2']['company']; ?>
<?php if ($this->_tpl_vars['speaker2']['company']): ?>,<br> <?php endif; ?><?php if ($this->_tpl_vars['speaker2']['cityName']): ?><?php echo $this->_tpl_vars['speaker2']['cityName']; ?>
<?php endif; ?></div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($this->_tpl_vars['speaker3']): ?>
                                                    <div class="gss-margintop5 desc">
                                                        <span><a href="#" data-speaker-id="<?php echo $this->_tpl_vars['speaker3id']; ?>
"><?php echo $this->_tpl_vars['speaker3']['name']; ?>
 <?php echo $this->_tpl_vars['speaker3']['secondName']; ?>
</a></span>
                                                        <div><?php echo $this->_tpl_vars['speaker3']['company']; ?>
<?php if ($this->_tpl_vars['speaker3']['company']): ?>,<br> <?php endif; ?><?php if ($this->_tpl_vars['speaker3']['cityName']): ?><?php echo $this->_tpl_vars['speaker3']['cityName']; ?>
<?php endif; ?></div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($this->_tpl_vars['speaker4']): ?>
                                                    <div class="gss-margintop5 desc">
                                                        <span><a href="#" data-speaker-id="<?php echo $this->_tpl_vars['speaker4id']; ?>
"><?php echo $this->_tpl_vars['speaker4']['name']; ?>
 <?php echo $this->_tpl_vars['speaker4']['secondName']; ?>
</a></span>
                                                        <div><?php echo $this->_tpl_vars['speaker4']['company']; ?>
<?php if ($this->_tpl_vars['speaker4']['company']): ?>,<br> <?php endif; ?><?php if ($this->_tpl_vars['speaker4']['cityName']): ?><?php echo $this->_tpl_vars['speaker4']['cityName']; ?>
<?php endif; ?></div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($this->_tpl_vars['speaker5']): ?>
                                                    <div class="gss-margintop5 desc">
                                                        <span><a href="#" data-speaker-id="<?php echo $this->_tpl_vars['speaker5id']; ?>
"><?php echo $this->_tpl_vars['speaker5']['name']; ?>
 <?php echo $this->_tpl_vars['speaker5']['secondName']; ?>
</a></span>
                                                        <div><?php echo $this->_tpl_vars['speaker5']['company']; ?>
<?php if ($this->_tpl_vars['speaker5']['company']): ?>,<br> <?php endif; ?><?php if ($this->_tpl_vars['speaker5']['cityName']): ?><?php echo $this->_tpl_vars['speaker5']['cityName']; ?>
<?php endif; ?></div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($this->_tpl_vars['speaker6']): ?>
                                                    <div class="gss-margintop5 desc">
                                                        <span><a href="#" data-speaker-id="<?php echo $this->_tpl_vars['speaker6id']; ?>
"><?php echo $this->_tpl_vars['speaker6']['name']; ?>
 <?php echo $this->_tpl_vars['speaker6']['secondName']; ?>
</a></span>
                                                        <div><?php echo $this->_tpl_vars['speaker6']['company']; ?>
<?php if ($this->_tpl_vars['speaker6']['company']): ?>,<br> <?php endif; ?><?php if ($this->_tpl_vars['speaker6']['cityName']): ?><?php echo $this->_tpl_vars['speaker6']['cityName']; ?>
<?php endif; ?></div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <?php if ($this->_tpl_vars['speaker']['partner_id'] && $this->_tpl_vars['product']->areaId != 4 && $this->_tpl_vars['product']->areaId != 14): ?>
                                            <div class="speaker-img d-none d-lg-block d-md-block d-sm-block" style="background-image:url('/images/parthners/resized/<?php echo $this->_tpl_vars['speaker']['partner_id']; ?>
.png?v=1554463230');background-position:bottom 5px right 0;background-size:80%;"></div>
                                            <?php endif; ?>
                                            <div class="speaker-img d-lg-none d-md-none d-sm-none" style="background-image: url('<?php echo $this->_tpl_vars['modalLink']; ?>
');"></div>
                                        </div>
                                        <div class="col-md-1 td c-title d-none d-lg-block d-md-block d-sm-block">
                                            <div class="speaker-img" style="background-image: url('<?php echo $this->_tpl_vars['modalLink']; ?>
');"></div>
                                        </div>
                                        <div class="col-4 td c-place d-lg-none d-md-none d-sm-none">
                                            <?php if (((is_array($_tmp=$this->_tpl_vars['product']->eventTsStart)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'H') : smarty_modifier_dateformat($_tmp, 'H')) == '00' && ((is_array($_tmp=$this->_tpl_vars['product']->eventTsFinish)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'H') : smarty_modifier_dateformat($_tmp, 'H')) == '00'): ?>
                                                <?php if ($this->_tpl_vars['lang'] == 'en'): ?>Time to be confirmed<?php else: ?>Время уточняется<?php endif; ?>
                                            <?php else: ?>
                                                <b><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->eventTsStart)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd F') : smarty_modifier_dateformat($_tmp, 'd F')); ?>
</b>
                                                <div><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->eventTsStart)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'H:i') : smarty_modifier_dateformat($_tmp, 'H:i')); ?>
&nbsp;—&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['product']->eventTsFinish)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'H:i') : smarty_modifier_dateformat($_tmp, 'H:i')); ?>
</div>
                                            <?php endif; ?>
                                            <div class="street-logo<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['product']->tags)) ? $this->_run_mod_handler('tagtocssclass', true, $_tmp) : smarty_modifier_tagtocssclass($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"></div>
                                            <div><?php echo $this->_tpl_vars['this']['plmArray'][$this->_tpl_vars['placeid']]; ?>
</div>
                                        </div>
                                        <div class="col-8 col-md-3 td c-title">
                                            <div class="mk-format"><span><?php if ($this->_tpl_vars['product']->tag_desc): ?><?php echo $this->_tpl_vars['product']->tag_desc; ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->tags)) ? $this->_run_mod_handler('tag2desc', true, $_tmp) : smarty_modifier_tag2desc($_tmp)); ?>
<?php endif; ?></span></div>
                                            <div class="row m-0">
                                            <div class="col-9 col-md-12 p-0 pr-2 title">
                                                <?php if ($this->_tpl_vars['product']->description): ?>
                                                <a href="#"
                                                   data-toggle="modal"
                                                   data-target="#mk-modal"
                                                   data-type="<?php if ($this->_tpl_vars['product']->youtube): ?>video<?php else: ?>image<?php endif; ?>"
                                                   data-partner="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']->partner_id)) ? $this->_run_mod_handler('ispartnerpic', true, $_tmp, '_b') : smarty_modifier_ispartnerpic($_tmp, '_b')); ?>
"
                                                   data-name="<?php echo $this->_tpl_vars['product']->firstName; ?>
"
                                                   data-second-name="<?php echo $this->_tpl_vars['product']->secondName; ?>
"
                                                   data-company="<?php echo $this->_tpl_vars['product']->company; ?>
"
                                                   data-city-name="<?php echo $this->_tpl_vars['product']->cityName; ?>
"
                                                   data-desc="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['product']->description)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"
                                                   data-flag="<?php echo $this->_tpl_vars['speaker']->country; ?>
"
                                                   data-format="<?php if ($this->_tpl_vars['product']->tag_desc): ?><?php echo $this->_tpl_vars['product']->tag_desc; ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->tags)) ? $this->_run_mod_handler('tag2desc', true, $_tmp) : smarty_modifier_tag2desc($_tmp)); ?>
<?php endif; ?>"
                                                   data-tags="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['product']->tags)) ? $this->_run_mod_handler('tagtocssclass', true, $_tmp) : smarty_modifier_tagtocssclass($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"
                                                   data-link="<?php echo $this->_tpl_vars['modalLink']; ?>
"
                                                   data-title="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['product']->name)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)))) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
"> <?php echo ((is_array($_tmp=$this->_tpl_vars['product']->name)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
</a>
                                                <?php else: ?>
                                                <span> <?php echo ((is_array($_tmp=$this->_tpl_vars['product']->name)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
</span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-3 p-0 td c-title d-lg-none d-md-none d-sm-none">
                                                <?php if ($this->_tpl_vars['speaker']['partner_id'] && $this->_tpl_vars['product']->areaId != 4 && $this->_tpl_vars['product']->areaId != 14): ?>
                                                <img src="/images/parthners/resized/<?php echo $this->_tpl_vars['speaker']['partner_id']; ?>
.png?v=1554463230" class="img-fluid">
                                                <?php endif; ?>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-xs-12 td c-place d-none d-lg-block d-md-block d-sm-block">
                                            <div class="street-logo<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['product']->tags)) ? $this->_run_mod_handler('tagtocssclass', true, $_tmp) : smarty_modifier_tagtocssclass($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"></div>
                                            <div><?php echo $this->_tpl_vars['this']['plmArray'][$this->_tpl_vars['placeid']]; ?>
</div>
                                        </div>
                                        <div class="col-4 col-md-2 col-xs-12 td td-cart">
                                            <div class="badge-ticket <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 3) : smarty_modifier_inticket($_tmp, 3))): ?>active<?php endif; ?>">ПРОФИ</div>
                                            <div class="badge-ticket <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 2) : smarty_modifier_inticket($_tmp, 2))): ?>active<?php endif; ?>">ШЕФСКИЙ</div>
                                            <div class="badge-ticket <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 1) : smarty_modifier_inticket($_tmp, 1))): ?>active<?php endif; ?>">СПУТНИК</div>
                                            <div class="badge-ticket <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 10) : smarty_modifier_inticket($_tmp, 10))): ?>active<?php endif; ?>">HOST STREET</div>
                                            <div class="badge-ticket <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 4) : smarty_modifier_inticket($_tmp, 4))): ?>active<?php endif; ?>">BARSTREET</div>
                                            <div class="badge-ticket <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 5) : smarty_modifier_inticket($_tmp, 5))): ?>active<?php endif; ?>">КАК КОРОЛЬ</div>
                                            <div class="badge-ticket <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 8) : smarty_modifier_inticket($_tmp, 8))): ?>active<?php endif; ?>">REBRO</div>
                                            <?php $this->assign('canShowButton', 1); ?>
                                            <?php if ($this->_tpl_vars['this']['includedProductIds']): ?>
                                                <?php $_from = $this->_tpl_vars['this']['includedProductIds']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['includedProductId']):
?>
                                                    <?php if ($this->_tpl_vars['includedProductId'] == $this->_tpl_vars['product']->id): ?>
                                                        <?php $this->assign('canShowButton', 0); ?>
                                                    <?php endif; ?>
                                                <?php endforeach; endif; unset($_from); ?>
                                            <?php endif; ?>
                                            <?php if ($this->_tpl_vars['this']['ts'] < $this->_tpl_vars['product']->eventTsFinish && $this->_tpl_vars['product']->leftCount > 0 && ! $this->_tpl_vars['this']['productId']): ?>
                                            <div class="mt-2">
                                                <a href="#" class="buy-product-click-pc btn-cart" data-id="<?php echo $this->_tpl_vars['product']->id; ?>
" data-night="false" id="buy-product-pc-<?php echo $this->_tpl_vars['product']->id; ?>
" title="Купить"><?php if ($this->_tpl_vars['product']->price): ?><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?php echo ((is_array($_tmp=$this->_tpl_vars['product']->price)) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
 ₽<?php endif; ?></a>
                                                <div class="cart-count"><?php if ($this->_tpl_vars['product']->maxCount == '-'): ?>—<?php else: ?>Осталось <?php echo $this->_tpl_vars['product']->leftCount; ?>
 мест<?php endif; ?></div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>
                    </div>

                <?php if ($this->_tpl_vars['this']['productId']): ?>
                    <div class="container padding-top-bottom-10">
                        <input type="submit" value="Заменить"/>
                    </div>
                </form>
                <?php endif; ?>
                <div class="modal fade" id="mk-modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content popover-win">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="mk-teaser"></div>
                                <div class="mk-format"><span></span></div>
                                <p class="title"></p>
                                <div class="desc"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="speaker-modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content popover-win">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>