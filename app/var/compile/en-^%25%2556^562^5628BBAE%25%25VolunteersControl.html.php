<?php /* Smarty version 2.6.13, created on 2020-01-14 01:39:02
         compiled from /home/c484884/gastreet.com/www/app/Templates/VolunteersControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tagtocssclass', '/home/c484884/gastreet.com/www/app/Templates/VolunteersControl.html', 119, false),array('modifier', 'yeartomedal', '/home/c484884/gastreet.com/www/app/Templates/VolunteersControl.html', 125, false),array('modifier', 'dbtexttohtml', '/home/c484884/gastreet.com/www/app/Templates/VolunteersControl.html', 160, false),array('modifier', 'mobilephone', '/home/c484884/gastreet.com/www/app/Templates/VolunteersControl.html', 165, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['VolunteersControl']); ?>

<div class="modal fade" id="video-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
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

<div class="jumbotron-blank">
    <div class="container">
        <div class="content">
            <ul class="breadcrumbs">
                <li><a href="/">Home</a></li>
                <li><span>Volunteers</span></li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <h1 class="page-headline gss-volunteers-title mb-2">Volunteers</h1>
        </div>
        <div class="col-md-3">
            <div class="g-emoji-content">
                <div class="g-emoji-icon">
                    <img src="/images/emoji/12.png" class="img-fluid" alt="">
                </div>
                <div class="g-emoji-balun">Любимки чо</div>
            </div>
        </div>
        <div class="col-md-8">
            <p class="subtitle mt-1 mb-5" style="сtext-transform:inherit;color:#10093b;">ОНИ ПРОШЛИ ШКОЛУ GASTREET.<br>
                Если вы ищите проверенных людей к&nbsp;себе в&nbsp;команду, то вы в&nbsp;нужном месте! На этой странице — волонтеры GASTREET всех лет. Их адекватность, самоотверженность и&nbsp;профессионализм подтверждены GASTREET&nbsp;TEAM. Не единожды</p>
        </div>
        <div class="col-md-4">
            <div class="tickects-video-catalog-page tickects-video-catalog-none gss-video-watch-catalog-page">
                <div>
                    <a data-target="#video-modal" data-toggle="modal" data-link="HyFhn4EoVKU" data-title="ПРО ВОЛОНТЕРОВ" href="#">
                        <div class="video-img" style="background-image: url('https://i.ytimg.com/vi/HyFhn4EoVKU/hq720.jpg')"></div>
                        <span>Посмотрите ролик<br>про ВОЛОНТЕРОВ</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="gss-volunteers-container row mb-4">
        <div class="col-md-3 d-none">
            <div class="dropdown dropdown-year">
                <a class="btn btn-white dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php if ($this->_tpl_vars['this']['year']): ?><?php echo $this->_tpl_vars['this']['year']; ?>
<?php else: ?>Год работы на&nbsp;GASTREET<?php endif; ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">2015</a>
                    <a class="dropdown-item" href="#">2016</a>
                    <a class="dropdown-item" href="#">2017</a>
                    <a class="dropdown-item" href="#">2018</a>
                    <a class="dropdown-item" href="#">2019</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dropdown dropdown-city">
                <a class="btn btn-white dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php if ($this->_tpl_vars['this']['city']): ?><?php echo $this->_tpl_vars['this']['city']; ?>
<?php else: ?>Город<?php endif; ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php $_from = $this->_tpl_vars['this']['vmCityList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['city']):
?>
                        <a class="dropdown-item" href="#"><?php echo $this->_tpl_vars['city']['cityName']; ?>
</a>
                    <?php endforeach; endif; unset($_from); ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dropdown dropdown-position">
                <a class="btn btn-white dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php if ($this->_tpl_vars['this']['position']): ?><?php echo $this->_tpl_vars['this']['position']; ?>
<?php else: ?>Профессия<?php endif; ?> 
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php $_from = $this->_tpl_vars['this']['vmPositionList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['position']):
?>
                        <a class="dropdown-item" href="#"><?php echo $this->_tpl_vars['position']['position']; ?>
</a>
                    <?php endforeach; endif; unset($_from); ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <a class="btn btn-white" href="/volunteers">Сбросить фильтр</a>
        </div>
        <div class="col-md-3">
            <a class="btn btn-red" target="_blank" href="https://forms.gle/EzsYjuuyk3ZJNVYt9">Хочу в&nbsp;семью волонтеров GASTREET</a>
        </div>
        <form class="volunteer-filter" action="" method="POST">
            <input type="hidden" name="city" value="<?php echo $this->_tpl_vars['this']['city']; ?>
">
            <input type="hidden" name="year" value="<?php echo $this->_tpl_vars['this']['year']; ?>
">
            <input type="hidden" name="position" value="<?php echo $this->_tpl_vars['this']['position']; ?>
">
        </form>
    </div>

    <div class="volunteers-grid js-volunteers-grid">
        <div class="row grid js-grid">
            <div class="col-6 col-md-3 grid-entry mb-3">
                <a class="person-teaser" href="https://docs.google.com/forms/d/e/1FAIpQLSdjZtuCpyK1JNr2ReLVM7OFvfayzSW6Fsaz2pZ0g6QrMUbFzA/viewform?usp=sf_link" target="_blank">
                    <img src="/images/btn-volunteers.png" alt="" class="img-fluid">
                </a>
            </div>
            <?php if ($this->_tpl_vars['this']['vmList']): ?>
                <!-- loop start -->
                <?php $_from = $this->_tpl_vars['this']['vmList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['volunteer']):
?>
                <div class="col-6 col-md-3 grid-entry mb-3">
                    <a class="person-teaser js-popover <?php echo ((is_array($_tmp=$this->_tpl_vars['volunteer']['tags'])) ? $this->_run_mod_handler('tagtocssclass', true, $_tmp) : smarty_modifier_tagtocssclass($_tmp)); ?>
" href="#popover-win-<?php echo $this->_tpl_vars['volunteer']['id']; ?>
" data-popover="#popover-win-<?php echo $this->_tpl_vars['volunteer']['id']; ?>
" data-timer="on">
                        <?php if ($this->_tpl_vars['volunteer']['img']): ?>
                            <img src="/images/volunteers/resized/<?php echo $this->_tpl_vars['volunteer']['img']; ?>
?v=<?php echo $this->_tpl_vars['volunteer']['ts_updated']; ?>
" data-ratio="1">
                        <?php else: ?>
                            <img src="/images/gss/speacker.jpg" data-ratio="1">
                        <?php endif; ?>
                        <div class="volunteer_medal_main"><?php echo ((is_array($_tmp=$this->_tpl_vars['volunteer']['years'])) ? $this->_run_mod_handler('yeartomedal', true, $_tmp) : smarty_modifier_yeartomedal($_tmp)); ?>
</div>
                        <div class="about">
                            <p class="name"><?php echo $this->_tpl_vars['volunteer']['name']; ?>
<br/><?php echo $this->_tpl_vars['volunteer']['lastname']; ?>
</p>
                            <p class="job"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $this->_tpl_vars['volunteer']['cityName']; ?>
</p>
                        </div>
                    </a>
                </div>
                <?php endforeach; endif; unset($_from); ?>
                <!-- loop end -->
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $_from = $this->_tpl_vars['this']['vmList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['volunteer']):
?>
<div class="modal fade" id="popover-win-<?php echo $this->_tpl_vars['volunteer']['id']; ?>
" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content popover-win <?php echo ((is_array($_tmp=$this->_tpl_vars['volunteer']['years'])) ? $this->_run_mod_handler('tagtocssclass', true, $_tmp) : smarty_modifier_tagtocssclass($_tmp)); ?>
">
            <div class="modal-header">
                <span class="close" data-dismiss="modal">&times;</span>
            </div>
            <div class="modal-body p-0 row">
                <div class="col-md-6">
                    <figure class="thumb fg-container">
                        <?php if ($this->_tpl_vars['volunteer']['img']): ?>
                            <img src="/images/volunteers/resized/<?php echo $this->_tpl_vars['volunteer']['img']; ?>
?v=<?php echo $this->_tpl_vars['volunteer']['ts_updated']; ?>
" data-ratio="1">
                        <?php else: ?>
                            <img src="/images/gss/speacker.jpg" data-ratio="1">
                        <?php endif; ?>
                        <p class="volunteer_medal"><?php echo ((is_array($_tmp=$this->_tpl_vars['volunteer']['years'])) ? $this->_run_mod_handler('yeartomedal', true, $_tmp) : smarty_modifier_yeartomedal($_tmp)); ?>
</p>
                    </figure>
                </div>
                <div class="col-md-6">
                    <p class="title"><?php echo $this->_tpl_vars['volunteer']['name']; ?>
<br/><?php echo $this->_tpl_vars['volunteer']['lastname']; ?>
</p>
                    <div class="desc">
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $this->_tpl_vars['volunteer']['cityName']; ?>
<?php if ($this->_tpl_vars['volunteer']['position']): ?><br/><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['volunteer']['position'])) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
<?php endif; ?></p>
                        <p><?php echo ((is_array($_tmp=$this->_tpl_vars['volunteer']['description'])) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
</p>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <?php if ($this->_tpl_vars['this']['actor']): ?>
                                <p class="mb-2"><?php echo ((is_array($_tmp=$this->_tpl_vars['volunteer']['phone'])) ? $this->_run_mod_handler('mobilephone', true, $_tmp) : smarty_modifier_mobilephone($_tmp)); ?>
</p>
                                <?php else: ?>
                                <p class="badge badge-primary mb-2" data-toggle="tooltip" data-html="true" title="Чтобы увидеть телефон, необходимо авторизоваться на сайте">Телефон скрыт</p>
                                <?php endif; ?>
                                <p class="m-0"><?php echo $this->_tpl_vars['volunteer']['email']; ?>
</p>
                            </div>
                            <div class="col-md-6">
                                <div class="speaker-icon">
                                <?php if ($this->_tpl_vars['volunteer']['facebook']): ?><a href="<?php echo $this->_tpl_vars['volunteer']['facebook']; ?>
" class="fa fa-facebook" target="_blank"></a><?php endif; ?>
                                <?php if ($this->_tpl_vars['volunteer']['vk']): ?><a href="<?php echo $this->_tpl_vars['volunteer']['vk']; ?>
" class="fa fa-vk" target="_blank"></a><?php endif; ?>
                                <?php if ($this->_tpl_vars['volunteer']['instagram']): ?><a href="<?php echo $this->_tpl_vars['volunteer']['instagram']; ?>
" class="fa fa-instagram" target="_blank"></a><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; endif; unset($_from); ?>