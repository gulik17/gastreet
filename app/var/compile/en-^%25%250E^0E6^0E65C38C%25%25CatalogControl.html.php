<?php /* Smarty version 2.6.13, created on 2020-01-20 16:41:27
         compiled from /home/c484884/gastreet.com/www/app/Templates/CatalogControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl.html', 61, false),array('function', 'component', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl.html', 76, false),array('modifier', 'getticket', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl.html', 86, false),array('modifier', 'numberprice', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl.html', 89, false),array('modifier', 'tagtocssclass', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl.html', 195, false),array('modifier', 'inticket', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl.html', 195, false),array('modifier', 'dateformat', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl.html', 195, false),array('modifier', 'getproductpic', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl.html', 221, false),array('modifier', 'isspeakerpicpic', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl.html', 223, false),array('modifier', 'tagformat', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl.html', 226, false),array('modifier', 'escape', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl.html', 285, false),array('modifier', 'tag2desc', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl.html', 289, false),array('modifier', 'ispartnerpic', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl.html', 297, false),array('modifier', 'dbtexttohtml', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl.html', 302, false),array('modifier', 'strip_tags', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl.html', 307, false),array('modifier', 'round0', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl.html', 341, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['CatalogControl']); ?>

<?php $this->assign('canShowButton', 1); ?>
<?php if ($this->_tpl_vars['this']['userBasketTickets']): ?>
<?php $this->assign('canShowButton', 0); ?>
<?php endif; ?>
<?php if (! $this->_tpl_vars['app']): ?>
    <div class="jumbotron-blank">
        <div class="container">
            <div class="content">
                <ul class="breadcrumbs">
                    <li><a href="/">Home</a></li>
                    <li><span>Tickets</span></li>
                </ul>
            </div>
        </div>
    </div> 
<?php endif; ?>
<div class="page_body">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-5">
                        <h1 class="page-headline"><?php if ($this->_tpl_vars['this']['gastreetspecial']): ?>И снова здравствуй!<?php else: ?>Билеты<?php endif; ?></h1>
                        <?php if ($this->_tpl_vars['this']['gastreetspecial']): ?>
                            <p class="subtitle">
                                Ты оказался на этой странице, потому что<br>
                                перешел по секретной ссылке.<br>
                                Да-да, ты — избранный (почти как Нео в Матрице).<br>
                                И только тебе и таким же избранным<br>
                                доступны специальные цены. До 31 декабря.</p>
                            <p class="subtitle">Всё как ты любишь! Там, где ты любишь.</p>
                        <?php else: ?>
                            <p class="subtitle">Всё как ты любишь! Там, где ты любишь.<br>
                                С&nbsp;1&nbsp;по&nbsp;5&nbsp;июня 2020&nbsp;года ты станешь частью самого огненного и&nbsp;полезного ивента года. Остался один шаг. Погнали!</p>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-7">
                        <?php if ($this->_tpl_vars['this']['gastreetspecial']): ?>
                        <div class="neo-bg">
                            <div class="bable_1"></div>
                            <div class="bable_2"></div>
                            <img src="/images/page-neo_bg.jpg" alt="Фон">
                        </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="g-emoji-content">
                                    <div class="g-emoji-icon">
                                        <img src="/images/emoji/4.png" class="img-fluid" alt="">
                                    </div>
                                    <div class="g-emoji-balun">
                                        Помни! Ты не сможешь отдельно докупить участие в&nbsp;мастер-классах.<br> Тебе доступны только те события, которые входят в&nbsp;выбранный билет.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="g-emoji-content">
                                    <div class="g-emoji-balun">
                                        Хочешь узнать о способах оплаты? <a href="<?php echo smarty_function_link(array('show' => 'payment'), $this);?>
">Жми сюда!</a>
                                    </div>
                                    <div class="g-emoji-icon">
                                        <img src="/images/emoji/5.png" class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row row-nowrap">
            <?php echo smarty_function_component(array('name' => 'Userticket'), $this);?>

        </div>
    </div>
    <div class="container">
        <div class="row row-condensed row-options">
            <div class="col-md-12">
                <p class="subtitle">+ Дополнительные опции</p>
            </div>
            <div class="col-md-3">
                <?php $this->assign('ticketId', 1); ?> <!-- УКАЗАТЬ ID БИЛЕТА «ТУРИСТ» -->
                <?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
                <div class="ticket" data-ri="t1">
                    <h2 class="ticket_header"><span class="title_tourist"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></span></h2>
                    <p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
                    <p class="ticket_new_cost" style="color:#f00;">Этот билет можно купить только для дополнительных участников.</p>
                    <div class="ticket-footer">
                        <a href="#" class="ticket_desc">Что входит в билет?</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="ticket cat_business" data-ri="d2">
                    <h2 class="ticket_header"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>BUSINESS SCHOOL<?php else: ?>БИЗНЕС-ШКОЛА<?php endif; ?></h2>
                    <p class="ticket_cost">5 000 ₽</p>
                    <p class="ticket_new_cost"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>for one seminar<?php else: ?>за один семинар<?php endif; ?><br>&nbsp;<br>&nbsp;</p>
                    <div class="ticket-footer">
                        <a href="#" class="ticket_desc d-none">Подробнее</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-none">
                <div class="ticket cat_fuckup" data-ri="d3">
                    <h2 class="ticket_header">FUCKUP NIGHT</h2>
                    <p class="ticket_cost">5 000 ₽</p>
                    <p class="ticket_new_cost"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>for one night<?php else: ?>за один вечер<?php endif; ?><br>&nbsp;<br>&nbsp;</p>
                    <div class="ticket-footer">
                        <a href="#" class="ticket_desc">Подробнее</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-none">
                <div class="ticket cat_popup" data-ri="d4">
                    <h2 class="ticket_header"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>POP-UP SHOW<?php else: ?>POP-UP SHOW<?php endif; ?></h2>
                    <p class="ticket_cost">от 7 000 ₽</p>
                    <p class="ticket_new_cost"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>for one dinner<?php else: ?>за один ужин<?php endif; ?><br>&nbsp;<br>&nbsp;</p>
                    <div class="ticket-footer">
                        <a href="#" class="ticket_desc">Подробнее</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12 irc_land irc_bg t1">
                <div class="ticket_desc">
                    <a href="#" class="close" title="Закрыть"></a>
                    <div class="irc-pc" style="top: -10px; bottom: auto; left: 140px;"></div>
                    <div class="row">
                        <div class="col-md-4">
                            <ul class="ticket_item">
                                <li>Обучение</li>
                                <li class="c_rebro disabled">#REBRO</li>
                                <li class="c_mainstreet disabled">#MAINSTREET</li>
                                <li class="c_businessschool disabled">#БИЗНЕСШКОЛА</li>
                                <li class="c_chefstreet disabled">#CHEFSTREET</li>
                                <li class="c_barstreet disabled">#BARSTREET</li>
                                <li class="c_hoststreet disabled">#HOSTSTREET</li>
                                <li>#ЦЕНТРАЛЬНАЯПЛОЩАДЬ</li>
                                <li class="c_fuckup">#FUCKUP</li>
                                <li class="c_baristastreet">#BARISTASTREET</li>
                                <li class="c_winedome">#ITТЕХНОЛОГИИ</li>
                                <li class="c_franchisestreet">#FRANCHISESTREET</li>
                                <li>#ШКОЛАСОМЕЛЬЕ</li>
                                <li>#ЗОЖ</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="ticket_item">
                                <li>Общение</li>
                                <li class="c_foodmarket">#FOODMARKET</li>
                                <li class="c_drinkzone">#DRINKZONE</li>
                                <li class="c_bbqstreet">#BBQBEERSTREET</li>
                                <li class="c_zozh">#ЗОЖ</li>
                                <li class="c_bbqstreet">#НОЧНОЕBBQ</li>
                                <li class="disabled">#POP-UPSHOW</li>
                                <li><i class="fa fa-check-ok"></i> #КОНЦЕРТЫ</li>
                                <li><i class="fa fa-check-ok"></i> #ВЕЧЕРИНКИ</li>
                                <li><i class="fa fa-check-ok"></i> Лучшие поставщики</li>
                                <li class="disabled"><i class="fa fa-check-ok"></i> <?php if ($this->_tpl_vars['lang'] == 'en'): ?>Accommodation in hotel 5 *<?php else: ?>Проживание в отеле 5* (5&nbsp;ночей)<?php endif; ?></li>
                                <li class="disabled"><i class="fa fa-check-ok"></i> Выделенная телефонная VIP-линия поддержки</li>
                                <li class="disabled"><i class="fa fa-check-ok"></i> Собственный ресторан</li>
                                <li class="disabled"><i class="fa fa-check-ok"></i> Собственный бар</li>
                                <li class="disabled"><i class="fa fa-check-ok"></i> Закрытые тусовки со спикерами</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 irc_land irc_bg d2">
                <div class="ticket_desc">
                    <a href="#" class="close" title="Закрыть"></a>
                    <div class="irc-pc" style="top: -10px; bottom: auto; left: 10rem;"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="container schedule-table">
                                <?php $_from = $this->_tpl_vars['this']['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['productloop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['productloop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['productloop']['iteration']++;
?>
                                    <?php if ($this->_tpl_vars['product']->areaId == 6): ?>
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
 <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 1) : smarty_modifier_inticket($_tmp, 1))): ?>t_tourist<?php endif; ?> <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 2) : smarty_modifier_inticket($_tmp, 2))): ?>t_chefs<?php endif; ?> <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 3) : smarty_modifier_inticket($_tmp, 3))): ?>t_profi<?php endif; ?> <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 4) : smarty_modifier_inticket($_tmp, 4))): ?>t_barstreet<?php endif; ?> <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 5) : smarty_modifier_inticket($_tmp, 5))): ?>t_king<?php endif; ?> <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 8) : smarty_modifier_inticket($_tmp, 8))): ?>t_rebro<?php endif; ?> <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 10) : smarty_modifier_inticket($_tmp, 10))): ?>t_hoststreet<?php endif; ?> row-date-<?php echo ((is_array($_tmp=$this->_tpl_vars['product']->eventTsStart)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd') : smarty_modifier_dateformat($_tmp, 'd')); ?>
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
.png?v=1554463230');background-position:bottom center;background-size:80%;"></div>
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
.png?v=1554463230" alt="<?php echo $this->_tpl_vars['product']->secondName; ?>
" class="img-fluid">
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
" title="Buy"><?php if ($this->_tpl_vars['product']->price): ?><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?php echo ((is_array($_tmp=$this->_tpl_vars['product']->price)) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 irc_land irc_bg d3">
                <div class="ticket_desc">
                    <a href="#" class="close" title="Закрыть"></a>
                    <div class="irc-pc" style="top: -10px; bottom: auto; left: 10rem;"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="container schedule-table">
                                <?php $_from = $this->_tpl_vars['this']['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['productloop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['productloop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['productloop']['iteration']++;
?>
                                    <?php if ($this->_tpl_vars['product']->areaId == 14): ?>
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
 <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 1) : smarty_modifier_inticket($_tmp, 1))): ?>t_tourist<?php endif; ?> <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 2) : smarty_modifier_inticket($_tmp, 2))): ?>t_chefs<?php endif; ?> <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 3) : smarty_modifier_inticket($_tmp, 3))): ?>t_profi<?php endif; ?> <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 4) : smarty_modifier_inticket($_tmp, 4))): ?>t_barstreet<?php endif; ?> <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 5) : smarty_modifier_inticket($_tmp, 5))): ?>t_king<?php endif; ?> <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 8) : smarty_modifier_inticket($_tmp, 8))): ?>t_rebro<?php endif; ?> <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 10) : smarty_modifier_inticket($_tmp, 10))): ?>t_hoststreet<?php endif; ?> row-date-<?php echo ((is_array($_tmp=$this->_tpl_vars['product']->eventTsStart)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd') : smarty_modifier_dateformat($_tmp, 'd')); ?>
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
.png?v=1554463230');background-position:bottom center;background-size:80%;"></div>
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
" title="Buy"><?php if ($this->_tpl_vars['product']->price): ?><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?php echo ((is_array($_tmp=$this->_tpl_vars['product']->price)) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 irc_land irc_bg d4">
                <div class="ticket_desc">
                    <a href="#" class="close" title="Закрыть"></a>
                    <div class="irc-pc" style="top: -10px; bottom: auto; left: 10rem;"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="container schedule-table">
                                <?php $_from = $this->_tpl_vars['this']['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['productloop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['productloop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['productloop']['iteration']++;
?>
                                    <?php if ($this->_tpl_vars['product']->areaId == 4): ?>
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
 <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 1) : smarty_modifier_inticket($_tmp, 1))): ?>t_tourist<?php endif; ?> <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 2) : smarty_modifier_inticket($_tmp, 2))): ?>t_chefs<?php endif; ?> <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 3) : smarty_modifier_inticket($_tmp, 3))): ?>t_profi<?php endif; ?> <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 4) : smarty_modifier_inticket($_tmp, 4))): ?>t_barstreet<?php endif; ?> <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 5) : smarty_modifier_inticket($_tmp, 5))): ?>t_king<?php endif; ?> <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 8) : smarty_modifier_inticket($_tmp, 8))): ?>t_rebro<?php endif; ?> <?php if (((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('inticket', true, $_tmp, 10) : smarty_modifier_inticket($_tmp, 10))): ?>t_hoststreet<?php endif; ?> row-date-<?php echo ((is_array($_tmp=$this->_tpl_vars['product']->eventTsStart)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd') : smarty_modifier_dateformat($_tmp, 'd')); ?>
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
.png?v=1554463230');background-position:bottom center;background-size:80%;"></div>
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
.png?v=1554463230" alt="<?php echo $this->_tpl_vars['product']->secondName; ?>
" class="img-fluid">
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
" title="Buy"><?php if ($this->_tpl_vars['product']->price): ?><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?php echo ((is_array($_tmp=$this->_tpl_vars['product']->price)) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mk-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content popover-win">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>