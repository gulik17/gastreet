<?php /* Smarty version 2.6.13, created on 2020-01-22 02:19:01
         compiled from /home/c484884/gastreet.com/www/app/Templates/PlaceControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'dbtexttohtml', '/home/c484884/gastreet.com/www/app/Templates/PlaceControl.html', 61, false),array('modifier', 'isplacepicpic', '/home/c484884/gastreet.com/www/app/Templates/PlaceControl.html', 382, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['PlaceControl']); ?>

<div class="jumbotron-blank">
    <div class="container">
        <div class="content">
            <ul class="breadcrumbs">
                <li><a href="/">Home</a></li>
                <li><span>Hotels</span></li>
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p class="h3 title">Бронирование будет доступно с&nbsp;15&nbsp;февраля 2020&nbsp;года</p>
            <!-- <p class="h3 title">Консультация по отелям <nobr>8 800 770-09-63</nobr></p>-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="g-emoji-content">
                <div class="g-emoji-icon">
                    <img src="/images/emoji/11.png" class="img-fluid" alt="">
                </div>
                <div class="g-emoji-balun">Роднули, бронирование возможно только после покупки основного билета на GASTREET</div>
            </div>
        </div>
        <div class="col-md-12">
            <h1 class="page-headline m-0 mb-1">ОТЕЛИ<br> В GASTREET CITY +960</h1>
<!--            <p class="page-headline-sub">на уровне +960</p>-->
        </div>

    </div>
</div>

<div class="container">
    <div class="page-container p-0" id="page-container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-container-inner" id="page-container-inner">
                    <div class="page-subsection">
                        <?php if ($this->_tpl_vars['this']['pmList']): ?>
                        <div class="row place-title d-none d-md-flex">
                            <div class="col-md-4"></div>
                            <div class="col-md-1">Мин. срок<br> проживания</div>
                            <div class="col-md-2">В стоимость<br> проживания входит</div>
                            <div class="col-md-1">Платные<br> услуги</div>
                            <div class="col-md-2"><br>Цена</div>
                            <div class="col-md-2">Отдел<br> бронирования</div>
                        </div>
                        <?php $_from = $this->_tpl_vars['this']['pm960']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['place']):
?>
                        <div class="row">
                            <div class="col-6 col-md-2 bg-gray col-title">
                                <?php if ($this->_tpl_vars['place']->videoUrl): ?>
                                    <a href="javascript:void(0)" class="place-video" data-toggle="modal" data-target="#video-modal" data-link="<?php echo $this->_tpl_vars['place']->videoUrl; ?>
" data-title="<?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['place']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['place']->name; ?>
<?php endif; ?>"><i class="fa fa-play-circle" aria-hidden="true"></i></a>
                                <?php endif; ?>
                                <div class="title">
                                    <?php if ($this->_tpl_vars['place']->suptitle): ?><div class="suptitle"><span><?php echo $this->_tpl_vars['place']->suptitle; ?>
</span></div><?php endif; ?>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#placeModal<?php echo $this->_tpl_vars['place']->id; ?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['place']->name_en)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['place']->name)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
<?php endif; ?></a>
                                    <?php if ($this->_tpl_vars['place']->subtitle): ?><div class="subtitle"><span><?php echo $this->_tpl_vars['place']->subtitle; ?>
</span></div><?php endif; ?>
                                </div>
                            </div>
                            <div class="col-6 col-md-2 bg-gray text-right stars">
                                <?php if ($this->_tpl_vars['place']->stars == 1): ?>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                <?php elseif ($this->_tpl_vars['place']->stars == 2): ?>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                <?php elseif ($this->_tpl_vars['place']->stars == 3): ?>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                <?php elseif ($this->_tpl_vars['place']->stars == 4): ?>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                <?php elseif ($this->_tpl_vars['place']->stars == 5): ?>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                <?php else: ?>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                <?php endif; ?>
                            </div>
                            <div class="d-none d-md-block col-md-1 bg-white text-center place-term"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Отель можно забронировать при условии заезда не позже 1 июня">4 ночи</a></div>
                            <div class="col-8 col-md-2 bg-gray place-icons">
                                <i class="fa fa-cutlery <?php if ($this->_tpl_vars['place']->inclusive[1]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="Завтрак" aria-hidden="true"></i> 
                                <i class="fa fa-pool <?php if ($this->_tpl_vars['place']->inclusive[2]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="Бассейн" aria-hidden="true"></i> 
                                <i class="fa fa-spa <?php if ($this->_tpl_vars['place']->inclusive[3]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="СПА" aria-hidden="true"></i> 
                                <i class="fa fa-gum <?php if ($this->_tpl_vars['place']->inclusive[4]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="Тренажерный зал" aria-hidden="true"></i> 
                                <i class="fa fa-wheelchair <?php if ($this->_tpl_vars['place']->inclusive[5]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="Номера для людей с ограниченными возможностями" aria-hidden="true"></i>
                                <i class="fa fa-baby-room <?php if ($this->_tpl_vars['place']->inclusive[6]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="Детская комната" aria-hidden="true"></i> 
                            </div>
                            <div class="col-4 col-md-1 bg-gray place-icons">
                                <i class="fa fa-baby-room <?php if ($this->_tpl_vars['place']->notinclusive[6]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="Детская комната" aria-hidden="true"></i> 
                                <i class="fa fa-paw <?php if ($this->_tpl_vars['place']->notinclusive[7]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="Возможно размещение с домашними животными" aria-hidden="true"></i>
                            </div>
                            <div class="d-md-none col-3 col-md-1 bg-white text-center place-term"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Отель можно забронировать при условии заезда не позже 1 июня">4 ночи</a></div>
                            <div class="col-3 col-md-2 bg-white text-center">
                                <?php if ($this->_tpl_vars['place']->price > 0): ?>
                                    <span class="title price" data-toggle="modal" data-target="#placePriceModal<?php echo $this->_tpl_vars['place']->id; ?>
"><?php if ($this->_tpl_vars['place']->price): ?><?php if ($this->_tpl_vars['lang'] == 'en'): ?>form <?php echo $this->_tpl_vars['place']->price; ?>
 ₽<?php else: ?>от <?php echo $this->_tpl_vars['place']->price; ?>
 ₽<?php endif; ?><?php else: ?>-<?php endif; ?></span>
                                <?php elseif ($this->_tpl_vars['place']->price == 'хз'): ?>
                                    <div class="capacity capacity-cart specified" style="position:relative;"></div>
                                <?php else: ?>
                                    <div class="capacity capacity-cart sold-out" style="position:relative;"></div>
                                <?php endif; ?>
                            </div>
                            <div class="col-6 col-md-2 bg-gray text-center">
                                <div class="place-phone"><?php echo $this->_tpl_vars['place']->phone; ?>
</div>
                                <?php if ($this->_tpl_vars['place']->email): ?>
                                <div class="place-email"><a href="mailto:<?php echo $this->_tpl_vars['place']->email; ?>
">Написать на почту</a></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-7">
            <h1 class="page-headline m-0 mb-1">ОТЕЛИ<br> КРАСНАЯ ПОЛЯНА +540</h1>
            <p class="page-headline-sub">подъемник на уровень +960 — бесплатно</p>
        </div>
    </div>
</div>

<div class="container">
    <div class="page-container p-0" id="page-container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-container-inner" id="page-container-inner">
                    <div class="page-subsection">
                        <?php if ($this->_tpl_vars['this']['pmList']): ?>
                        <div class="row place-title d-none d-md-flex">
                            <div class="col-md-4"></div>
                            <div class="col-md-1">Мин. срок<br> проживания</div>
                            <div class="col-md-2">В стоимость<br> проживания входит</div>
                            <div class="col-md-1">Платные<br> услуги</div>
                            <div class="col-md-2"><br>Цена</div>
                            <div class="col-md-2">Отдел<br> бронирования</div>
                        </div>
                        <?php $_from = $this->_tpl_vars['this']['pm540']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['place']):
?>
                        <div class="row">
                            <div class="col-6 col-md-2 bg-gray col-title">
                                <?php if ($this->_tpl_vars['place']->videoUrl): ?>
                                    <a href="javascript:void(0)" class="place-video" data-toggle="modal" data-target="#video-modal" data-link="<?php echo $this->_tpl_vars['place']->videoUrl; ?>
" data-title="<?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['place']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['place']->name; ?>
<?php endif; ?>"><i class="fa fa-play-circle" aria-hidden="true"></i></a>
                                <?php endif; ?>
                                <div class="title">
                                    <?php if ($this->_tpl_vars['place']->suptitle): ?><div class="suptitle"><span><?php echo $this->_tpl_vars['place']->suptitle; ?>
</span></div><?php endif; ?>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#placeModal<?php echo $this->_tpl_vars['place']->id; ?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['place']->name_en)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['place']->name)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
<?php endif; ?></a>
                                    <?php if ($this->_tpl_vars['place']->subtitle): ?><div class="subtitle"><span><?php echo $this->_tpl_vars['place']->subtitle; ?>
</span></div><?php endif; ?>
                                </div>
                            </div>
                            <div class="col-6 col-md-2 bg-gray text-right stars">
                                <?php if ($this->_tpl_vars['place']->stars == 1): ?>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                <?php elseif ($this->_tpl_vars['place']->stars == 2): ?>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                <?php elseif ($this->_tpl_vars['place']->stars == 3): ?>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                <?php elseif ($this->_tpl_vars['place']->stars == 4): ?>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                <?php elseif ($this->_tpl_vars['place']->stars == 5): ?>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                <?php else: ?>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                <?php endif; ?>
                            </div>
                            <div class="d-none d-md-block col-md-1 bg-white text-center place-term"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Минимальный срок проживания 2 ночи">2 ночи</a></div>
                            <div class="col-8 col-md-2 bg-gray place-icons">
                                <i class="fa fa-cutlery <?php if ($this->_tpl_vars['place']->inclusive[1]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="Завтрак" aria-hidden="true"></i> 
                                <i class="fa fa-pool <?php if ($this->_tpl_vars['place']->inclusive[2]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="Бассейн" aria-hidden="true"></i> 
                                <i class="fa fa-spa <?php if ($this->_tpl_vars['place']->inclusive[3]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="СПА" aria-hidden="true"></i> 
                                <i class="fa fa-gum <?php if ($this->_tpl_vars['place']->inclusive[4]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="Тренажерный зал" aria-hidden="true"></i> 
                                <i class="fa fa-wheelchair <?php if ($this->_tpl_vars['place']->inclusive[5]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="Номера для людей с ограниченными возможностями" aria-hidden="true"></i>
                                <i class="fa fa-baby-room <?php if ($this->_tpl_vars['place']->inclusive[6]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="Детская комната" aria-hidden="true"></i> 
                            </div>
                            <div class="col-4 col-md-1 bg-gray place-icons">
                                <i class="fa fa-baby-room <?php if ($this->_tpl_vars['place']->notinclusive[6]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="Детская комната" aria-hidden="true"></i> 
                                <i class="fa fa-paw <?php if ($this->_tpl_vars['place']->notinclusive[7]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="Возможно размещение с домашними животными" aria-hidden="true"></i>
                            </div>
                            <div class="d-md-none col-3 col-md-1 bg-white text-center place-term"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Минимальный срок проживания 2 ночи">2 ночи</a></div>
                            <div class="col-3 col-md-2 bg-white text-center">
                                <?php if ($this->_tpl_vars['place']->price > 0): ?>
                                <span class="title price" data-toggle="modal" data-target="#placePriceModal<?php echo $this->_tpl_vars['place']->id; ?>
"><?php if ($this->_tpl_vars['place']->price): ?><?php if ($this->_tpl_vars['lang'] == 'en'): ?>form <?php echo $this->_tpl_vars['place']->price; ?>
 ₽<?php else: ?>от <?php echo $this->_tpl_vars['place']->price; ?>
 ₽<?php endif; ?><?php else: ?>-<?php endif; ?></span>
                                <?php elseif ($this->_tpl_vars['place']->price == 'хз'): ?>
                                <div class="capacity capacity-cart specified" style="position:relative;"></div>
                                <?php else: ?>
                                <div class="capacity capacity-cart sold-out" style="position:relative;"></div>
                                <?php endif; ?>
                            </div>
                            <div class="col-6 col-md-2 bg-gray text-center">
                                <div class="place-phone"><?php echo $this->_tpl_vars['place']->phone; ?>
</div>
                                <?php if ($this->_tpl_vars['place']->email): ?>
                                <div class="place-email"><a href="mailto:<?php echo $this->_tpl_vars['place']->email; ?>
">Написать на почту</a></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container d-none">
    <div class="row">
        <div class="col-md-7">
            <h1 class="page-headline m-0 mb-1">ОТЕЛИ<br> Роза Хутор +560</h1>
            <p class="page-headline-sub">подъемник на уровень +960 — бесплатно</p>
        </div>
    </div>
</div>

<div class="container d-none">
    <div class="page-container p-0" id="page-container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-container-inner" id="page-container-inner">
                    <div class="page-subsection">
                        <?php if ($this->_tpl_vars['this']['pmList']): ?>
                        <div class="row place-title d-none d-md-flex">
                            <div class="col-md-4"></div>
                            <div class="col-md-1">Мин. срок<br> проживания</div>
                            <div class="col-md-2">В стоимость<br> проживания входит</div>
                            <div class="col-md-1">Платные<br> услуги</div>
                            <div class="col-md-2"><br>Цена</div>
                            <div class="col-md-2">Отдел<br> бронирования</div>
                        </div>
                        <?php $_from = $this->_tpl_vars['this']['pm560']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['place']):
?>
                        <div class="row">
                            <div class="col-6 col-md-2 bg-gray col-title">
                                <?php if ($this->_tpl_vars['place']->videoUrl): ?>
                                    <a href="javascript:void(0)" class="place-video" data-toggle="modal" data-target="#video-modal" data-link="<?php echo $this->_tpl_vars['place']->videoUrl; ?>
" data-title="<?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['place']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['place']->name; ?>
<?php endif; ?>"><i class="fa fa-play-circle" aria-hidden="true"></i></a>
                                <?php endif; ?>
                                <div class="title">
                                    <?php if ($this->_tpl_vars['place']->suptitle): ?><div class="suptitle"><span><?php echo $this->_tpl_vars['place']->suptitle; ?>
</span></div><?php endif; ?>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#placeModal<?php echo $this->_tpl_vars['place']->id; ?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['place']->name_en)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['place']->name)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
<?php endif; ?></a>
                                    <?php if ($this->_tpl_vars['place']->subtitle): ?><div class="subtitle"><span><?php echo $this->_tpl_vars['place']->subtitle; ?>
</span></div><?php endif; ?>
                                </div>
                            </div>
                            <div class="col-6 col-md-2 bg-gray text-right stars">
                                <?php if ($this->_tpl_vars['place']->stars == 1): ?>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                <?php elseif ($this->_tpl_vars['place']->stars == 2): ?>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                <?php elseif ($this->_tpl_vars['place']->stars == 3): ?>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                <?php elseif ($this->_tpl_vars['place']->stars == 4): ?>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                <?php elseif ($this->_tpl_vars['place']->stars == 5): ?>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                <?php else: ?>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                <?php endif; ?>
                            </div>
                            <div class="d-none d-md-block col-md-1 bg-white text-center place-term"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Минимальный срок проживания 2 ночи">2 ночи</a></div>
                            <div class="col-8 col-md-2 bg-gray place-icons">
                                <i class="fa fa-cutlery <?php if ($this->_tpl_vars['place']->inclusive[1]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="Завтрак" aria-hidden="true"></i> 
                                <i class="fa fa-pool <?php if ($this->_tpl_vars['place']->inclusive[2]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="Бассейн" aria-hidden="true"></i> 
                                <i class="fa fa-spa <?php if ($this->_tpl_vars['place']->inclusive[3]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="СПА" aria-hidden="true"></i> 
                                <i class="fa fa-gum <?php if ($this->_tpl_vars['place']->inclusive[4]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="Тренажерный зал" aria-hidden="true"></i> 
                                <i class="fa fa-wheelchair <?php if ($this->_tpl_vars['place']->inclusive[5]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="Номера для людей с ограниченными возможностями" aria-hidden="true"></i>
                                <i class="fa fa-baby-room <?php if ($this->_tpl_vars['place']->inclusive[6]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="Детская комната" aria-hidden="true"></i> 
                            </div>
                            <div class="col-4 col-md-1 bg-gray place-icons">
                                <i class="fa fa-baby-room <?php if ($this->_tpl_vars['place']->notinclusive[6]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="Детская комната" aria-hidden="true"></i> 
                                <i class="fa fa-paw <?php if ($this->_tpl_vars['place']->notinclusive[7]): ?>active<?php endif; ?>" data-toggle="tooltip" data-placement="top" title="Возможно размещение с домашними животными" aria-hidden="true"></i>
                            </div>
                            <div class="d-md-none col-3 col-md-1 bg-white text-center place-term"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Минимальный срок проживания 2 ночи">2 ночи</a></div>
                            <div class="col-3 col-md-2 bg-white text-center">
                                <?php if ($this->_tpl_vars['place']->price > 0): ?>
                                <span class="title price" data-toggle="modal" data-target="#placePriceModal<?php echo $this->_tpl_vars['place']->id; ?>
"><?php if ($this->_tpl_vars['place']->price): ?><?php if ($this->_tpl_vars['lang'] == 'en'): ?>form <?php echo $this->_tpl_vars['place']->price; ?>
 ₽<?php else: ?>от <?php echo $this->_tpl_vars['place']->price; ?>
 ₽<?php endif; ?><?php else: ?>-<?php endif; ?></span>
                                <?php elseif ($this->_tpl_vars['place']->price == 'хз'): ?>
                                <div class="capacity capacity-cart specified" style="position:relative;"></div>
                                <?php else: ?>
                                <div class="capacity capacity-cart sold-out" style="position:relative;"></div>
                                <?php endif; ?>
                            </div>
                            <div class="col-6 col-md-2 bg-gray text-center">
                                <div class="place-phone"><?php echo $this->_tpl_vars['place']->phone; ?>
</div>
                                <?php if ($this->_tpl_vars['place']->email): ?>
                                <div class="place-email"><a href="mailto:<?php echo $this->_tpl_vars['place']->email; ?>
">Написать на почту</a></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- loop start -->
<?php $_from = $this->_tpl_vars['this']['pmList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['place']):
?>
<div class="row">
    <div class="modal fade" id="placeModal<?php echo $this->_tpl_vars['place']->id; ?>
" tabindex="-1" role="dialog" aria-labelledby="placeModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <?php $this->assign('isimgplace', ((is_array($_tmp=$this->_tpl_vars['place']->id)) ? $this->_run_mod_handler('isplacepicpic', true, $_tmp) : smarty_modifier_isplacepicpic($_tmp))); ?>
                    <?php if ($this->_tpl_vars['isimgplace']): ?>
                        <img class="img-responsive" src="/images/places/resized/<?php echo $this->_tpl_vars['place']->id; ?>
.jpg" data-ratio="1">
                    <?php else: ?>
                        <img class="img-responsive" src="/content/hotel.jpg">
                    <?php endif; ?>
                </div>
                <?php if ($this->_tpl_vars['place']->modal_desc): ?>
                <div class="modal-footer">
                    <?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['place']->description_en)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['place']->description)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
<?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="modal fade" id="placePriceModal<?php echo $this->_tpl_vars['place']->id; ?>
" tabindex="-1" role="dialog" aria-labelledby="placePriceModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <?php $this->assign('isimgplace', ((is_array($_tmp=$this->_tpl_vars['place']->id)) ? $this->_run_mod_handler('isplacepicpic', true, $_tmp) : smarty_modifier_isplacepicpic($_tmp))); ?>
                    <?php if ($this->_tpl_vars['isimgplace']): ?>
                        <img class="img-responsive" src="/images/places/resized/<?php echo $this->_tpl_vars['place']->id; ?>
.jpg" data-ratio="1">
                    <?php else: ?>
                        <img class="img-responsive" src="/content/hotel.jpg">
                    <?php endif; ?>
                </div>
                <?php if ($this->_tpl_vars['place']->modal_desc): ?>
                <div class="modal-footer">
                    <?php if ($this->_tpl_vars['place']->price > 0): ?>
                        <p class="h3"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Cost of accommodation<?php else: ?>Стоимость размещения<?php endif; ?></p>
                        <?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['place']->modal_desc_en)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['place']->modal_desc)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
<?php endif; ?>
                    <?php else: ?>
                        <div class="capacity capacity-cart sold-out" style="position:relative;height:90px;"></div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endforeach; endif; unset($_from); ?>
<!-- loop end -->

<section class="s7-section d-none">
    <div class="container">
        <div class="row">
            <a href="https://www.s7.ru/special-offers/gastreet2019/index.dot" target="_blank">
                <img src="/images/s7-special.png" class="img-fluid">
            </a>
        </div>
    </div>
</section>

<div class="modal fade" id="video-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="videoModalLabel"></h4>
            </div>
            <div class="modal-body">
                <iframe height="400" src="" style="width:100%" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>