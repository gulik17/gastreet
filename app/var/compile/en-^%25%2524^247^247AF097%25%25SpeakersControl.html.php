<?php /* Smarty version 2.6.13, created on 2020-01-15 00:06:24
         compiled from /home/c484884/gastreet.com/www/app/Templates/SpeakersControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/SpeakersControl.html', 62, false),array('function', 'getmkbyspeaker', '/home/c484884/gastreet.com/www/app/Templates/SpeakersControl.html', 259, false),array('modifier', 'tagtocssclass', '/home/c484884/gastreet.com/www/app/Templates/SpeakersControl.html', 171, false),array('modifier', 'isspeakerpicpic', '/home/c484884/gastreet.com/www/app/Templates/SpeakersControl.html', 172, false),array('modifier', 'tagformat', '/home/c484884/gastreet.com/www/app/Templates/SpeakersControl.html', 174, false),array('modifier', 'yeartomedal', '/home/c484884/gastreet.com/www/app/Templates/SpeakersControl.html', 182, false),array('modifier', 'dbtexttohtml', '/home/c484884/gastreet.com/www/app/Templates/SpeakersControl.html', 234, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['SpeakersControl']); ?>

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
                <li><span>Speakers</span></li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <h1 class="page-headline gss-speakers-title">Speakers</h1>
        </div>
        <div class="col-md-7">
            <div class="row">
                <div class="col-6 pr-0">
                    <div class="g-emoji-content">
                        <div class="g-emoji-icon">
                            <img src="/images/emoji/6.png" class="img-fluid" alt="">
                        </div>
                        <div class="g-emoji-balun">
                            А&nbsp;почему у&nbsp;всех спикеров разный фон?
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="g-emoji-content">
                        <div class="g-emoji-balun">
                            Все просто! Цвет фона - это цвет площадки
                        </div>
                        <div class="g-emoji-icon">
                            <img src="/images/emoji/7.png" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row d-none">
        <div class="col-md-12 tags-list-speakers">
            <ul>
                <li class="gss-tag-li tag_ambassador <?php if ($this->_tpl_vars['this']['tag'] == 'амбассадор'): ?>active<?php endif; ?> ">
                    <a title="#амбассадор" href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => "амбассадор"), $this);?>
"><i class="fa fa-ambassador" aria-hidden="true"></i> АМБАССАДОРЫ</a>
                </li>
                <li class="gss-tag-li <?php if ($this->_tpl_vars['this']['tag'] == ''): ?>active<?php endif; ?> ">
                    <a title="#2020" href="<?php echo smarty_function_link(array('show' => 'speakers'), $this);?>
">#2020</a>
                </li>
                <li class="gss-tag-li <?php if ($this->_tpl_vars['this']['tag'] == '2019'): ?>active<?php endif; ?> ">
                    <a title="#2019" href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => 2019), $this);?>
">#2019</a>
                </li>
                <li class="gss-tag-li <?php if ($this->_tpl_vars['this']['tag'] == '2018'): ?>active<?php endif; ?> ">
                    <a title="#2018" href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => 2018), $this);?>
">#2018</a>
                </li>
                <li class="gss-tag-li <?php if ($this->_tpl_vars['this']['tag'] == '2017'): ?>active<?php endif; ?> ">
                    <a title="#2017" href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => 2017), $this);?>
">#2017</a>
                </li>
                <li class="gss-tag-li <?php if ($this->_tpl_vars['this']['tag'] == '2016'): ?>active<?php endif; ?> ">
                    <a title="#2016" href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => 2016), $this);?>
">#2016</a>
                </li>
                <li class="gss-tag-li <?php if ($this->_tpl_vars['this']['tag'] == '2015'): ?>active<?php endif; ?> ">
                    <a title="#2015" href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => 2015), $this);?>
">#2015</a>
                </li>
                <li class="gss-tag-li <?php if ($this->_tpl_vars['this']['tag'] == 'barstreet'): ?>active<?php endif; ?> ">
                    <a title="#barstreet" href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => 'barstreet2016'), $this);?>
">#barstreet</a>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12 tags-list-speakers">
            <p class="note"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>SELECT TAG<?php else: ?>ВЫБЕРИТЕ ТЕГ<?php endif; ?>:</p>
        </div>
        <div class="col-md-12 tags-list-speakers">
            <ul class="m-0">
                <li class="gss-tag-li <?php if ($this->_tpl_vars['this']['tag'] == ''): ?>active<?php endif; ?> ">
                    <a title="#ВСЕ" href="<?php echo smarty_function_link(array('show' => 'speakers'), $this);?>
">#ВСЕ</a>
                </li>
                <li class="gss-tag-li tag_mainstreet <?php if ($this->_tpl_vars['this']['tag'] == 'mainstreet'): ?>active<?php endif; ?> ">
                    <a title="#mainstreet" href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => 'mainstreet','y' => 2020), $this);?>
">#MAINSTREET</a>
                </li>
                <li class="gss-tag-li tag_businessschool <?php if ($this->_tpl_vars['this']['tag'] == 'бизнесшкола'): ?>active<?php endif; ?> ">
                    <a title="#бизнесшкола" href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => "бизнесшкола",'y' => 2020), $this);?>
">#БИЗНЕСШКОЛА</a>
                </li>
                <li class="gss-tag-li tag_chefstreet <?php if ($this->_tpl_vars['this']['tag'] == 'chefstreet'): ?>active<?php endif; ?> ">
                    <a title="#chefstreet" href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => 'chefstreet','y' => 2020), $this);?>
">#CHEFSTREET</a>
                </li>
                <li class="gss-tag-li tag_barstreet <?php if ($this->_tpl_vars['this']['tag'] == 'barstreet'): ?>active<?php endif; ?> ">
                    <a title="#barstreet" href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => 'barstreet','y' => 2020), $this);?>
" onclick="return false">#BARSTREET</a>
                </li>
                <li class="gss-tag-li tag_hoststreet <?php if ($this->_tpl_vars['this']['tag'] == 'hoststreet'): ?>active<?php endif; ?> ">
                    <a title="#hoststreet" href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => 'hoststreet','y' => 2020), $this);?>
" onclick="return false">#HOSTSTREET</a>
                </li>
                <li class="gss-tag-li tag_rebro <?php if ($this->_tpl_vars['this']['tag'] == 'rebro'): ?>active<?php endif; ?> ">
                    <a title="#rebro" href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => 'rebro','y' => 2020), $this);?>
" onclick="return false">#REBRO</a>
                </li>
                <li class="gss-tag-li tag_fuckup <?php if ($this->_tpl_vars['this']['tag'] == 'fuckup'): ?>active<?php endif; ?> ">
                    <a title="#fuckup" href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => 'fuckup','y' => 2020), $this);?>
" onclick="return false">#FUCKUP</a>
                </li>
<!--                <li class="gss-tag-li tag_partnerstreet <?php if ($this->_tpl_vars['this']['tag'] == 'partnerstreet'): ?>active<?php endif; ?> ">-->
<!--                    <a title="#partnerstreet" href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => 'partnerstreet','y' => 2020), $this);?>
">#PARTNERSTREET</a>-->
<!--                </li>-->
<!--                <li class="gss-tag-li tag_winedome <?php if ($this->_tpl_vars['this']['tag'] == 'winedome'): ?>active<?php endif; ?> ">-->
<!--                    <a title="#winedome" href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => 'winedome','y' => 2020), $this);?>
">#WINEDOME</a>-->
<!--                </li>-->
<!--                <li class="gss-tag-li tag_baristastreet <?php if ($this->_tpl_vars['this']['tag'] == 'baristastreet'): ?>active<?php endif; ?> ">-->
<!--                    <a title="#baristastreet" href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => 'baristastreet','y' => 2020), $this);?>
">#BARISTASTREET</a>-->
<!--                </li>-->
<!--                <li class="gss-tag-li tag_centralnayaploshchad <?php if ($this->_tpl_vars['this']['tag'] == 'центральнаяплощадь'): ?>active<?php endif; ?> ">-->
<!--                    <a title="#центральнаяплощадь" href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => "центральнаяплощадь",'y' => 2020), $this);?>
">#центральнаяплощадь</a>-->
<!--                </li>-->
<!--                <li class="gss-tag-li tag_franchisestreet <?php if ($this->_tpl_vars['this']['tag'] == 'franchisestreet'): ?>active<?php endif; ?> ">-->
<!--                    <a title="#franchisestreet" href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => 'franchisestreet','y' => 2020), $this);?>
">#franchisestreet</a>-->
<!--                </li>-->
                <li class="gss-tag-li tag_ambassador <?php if ($this->_tpl_vars['this']['tag'] == 'амбассадор'): ?>active<?php endif; ?> ">
                    <a title="#амбассадор" href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => "амбассадор"), $this);?>
"><i class="fa fa-ambassador" aria-hidden="true"></i> АМБАССАДОРЫ</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="speakers-grid js-speakers-grid <?php if ($this->_tpl_vars['this']['tag'] != '2018' && $this->_tpl_vars['this']['tag'] != '2017' && $this->_tpl_vars['this']['tag'] != '2016' && $this->_tpl_vars['this']['tag'] != '2015' && $this->_tpl_vars['this']['tag'] != 'barstreet2016'): ?>speakers_2019<?php endif; ?>">
        <div class="row">
            <div class="col-md-12">
                <?php if ($this->_tpl_vars['this']['tag'] == '2018'): ?>
                    <div class="speakers-video-bg" data-target="#video-modal" data-toggle="modal" data-link="lzh8QITXavI" data-title="Как это было в 2018 году" style="background-image: url(/images/v-2017.jpg);">
                        <p><span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Watch how it was in 2018<?php else: ?>Смотреть как это было в 2018 году<?php endif; ?></span></p>
                    </div>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['this']['tag'] == '2017'): ?>
                    <div class="speakers-video-bg" data-target="#video-modal" data-toggle="modal" data-link="OBwVnGCIgIo" data-title="Как это было в 2017 году" style="background-image: url(/images/v-2017.jpg);">
                        <p><span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Watch how it was in 2017<?php else: ?>Смотреть как это было в 2017 году<?php endif; ?></span></p>
                    </div>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['this']['tag'] == '2016'): ?>
                    <div class="speakers-video-bg" data-target="#video-modal" data-toggle="modal" data-link="B8L_3yvoL_Y" data-title="Как это было в 2016 году" style="background-image: url(/images/v-2016.jpg);">
                        <p><span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Watch how it was in 2016<?php else: ?>Смотреть как это было в 2016 году<?php endif; ?></span></p>
                    </div>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['this']['tag'] == '2015'): ?>
                    <div class="speakers-video-bg" data-target="#video-modal" data-toggle="modal" data-link="80HISWnKeCg" data-title="Как это было в 2015 году" style="background-image: url(/images/v-2015.jpg);">
                        <p><span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Watch how it was in 2015<?php else: ?>Смотреть как это было в 2015 году<?php endif; ?></span></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row grid js-grid">
            <?php if ($this->_tpl_vars['this']['spmList']): ?>
                <!-- loop start -->
                <?php $_from = $this->_tpl_vars['this']['spmList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['speaker']):
?>
                <div class="col-6 col-md-3 grid-entry">
                    <a class="person-teaser js-popover <?php echo ((is_array($_tmp=$this->_tpl_vars['speaker']['tags'])) ? $this->_run_mod_handler('tagtocssclass', true, $_tmp) : smarty_modifier_tagtocssclass($_tmp)); ?>
" href="#popover-win-<?php echo $this->_tpl_vars['speaker']['id']; ?>
" data-popover="#popover-win-<?php echo $this->_tpl_vars['speaker']['id']; ?>
" data-timer="on">
                        <?php $this->assign('isSpeackerImg2', ((is_array($_tmp=$this->_tpl_vars['speaker']['id'])) ? $this->_run_mod_handler('isspeakerpicpic', true, $_tmp, '_b') : smarty_modifier_isspeakerpicpic($_tmp, '_b'))); ?>
                        <div class="img-tags">
                            <?php echo ((is_array($_tmp=$this->_tpl_vars['speaker']['tags'])) ? $this->_run_mod_handler('tagformat', true, $_tmp) : smarty_modifier_tagformat($_tmp)); ?>

                            <?php if ($this->_tpl_vars['speaker']['partner_id'] > 0): ?>
                                <img class="foreground" src="/images/parthners/resized/<?php echo $this->_tpl_vars['speaker']['p_pic']; ?>
?v=<?php echo $this->_tpl_vars['speaker']['tsUpdated']; ?>
" data-ratio="1">
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
" data-ratio="1">
                        <?php else: ?>
                            <img src="/images/gss/speaker.jpg" data-ratio="1">
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
                </div>
                <?php endforeach; endif; unset($_from); ?>
                <!-- loop end -->
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $_from = $this->_tpl_vars['this']['spmList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['speaker']):
?>
<?php $this->assign('isSpeackerImg2', ((is_array($_tmp=$this->_tpl_vars['speaker']['id'])) ? $this->_run_mod_handler('isspeakerpicpic', true, $_tmp, '_b') : smarty_modifier_isspeakerpicpic($_tmp, '_b'))); ?>
<div class="modal fade" id="popover-win-<?php echo $this->_tpl_vars['speaker']['id']; ?>
" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <a href="#" class="nav-btn prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        <a href="#" class="nav-btn next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
        <div class="modal-content popover-win <?php echo ((is_array($_tmp=$this->_tpl_vars['speaker']['tags'])) ? $this->_run_mod_handler('tagtocssclass', true, $_tmp) : smarty_modifier_tagtocssclass($_tmp)); ?>
">
            <div class="modal-header">
                <span class="close" data-dismiss="modal">&times;</span>
            </div>
            <div class="modal-body p-0">
                <figure class="thumb fg-container">
                    <div class="img-tags">
                        <?php echo ((is_array($_tmp=$this->_tpl_vars['speaker']['tags'])) ? $this->_run_mod_handler('tagformat', true, $_tmp) : smarty_modifier_tagformat($_tmp)); ?>

                        <?php if ($this->_tpl_vars['speaker']['partner_id'] > 0): ?>
                            <img class="foreground" src="/images/parthners/resized/<?php echo $this->_tpl_vars['speaker']['p_pic']; ?>
?v=<?php echo $this->_tpl_vars['speaker']['tsUpdated']; ?>
" data-ratio="1">
                        <?php endif; ?>
                    </div>
                    <div class="icon-country <?php echo $this->_tpl_vars['speaker']['country']; ?>
"></div>
                    <?php if ($this->_tpl_vars['speaker']['pic1']): ?>
                        <img src="/images/speackers/resized/<?php echo $this->_tpl_vars['speaker']['pic1']; ?>
?v=<?php echo $this->_tpl_vars['speaker']['tsUpdated']; ?>
" data-ratio="1">
                    <?php else: ?>
                        <img src="/images/gss/speaker.jpg" data-ratio="1">
                    <?php endif; ?>
                </figure>
                <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                    <p class="title"><?php echo $this->_tpl_vars['speaker']['name_en']; ?>
<br/><?php echo $this->_tpl_vars['speaker']['secondName_en']; ?>
</p>
                    <div class="desc">
                        <p><?php echo $this->_tpl_vars['speaker']['company_en']; ?>
<?php if ($this->_tpl_vars['speaker']['cityName_en']): ?><br/><?php echo $this->_tpl_vars['speaker']['cityName_en']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['speaker']['position_en']): ?><br/><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['speaker']['position_en'])) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
<?php endif; ?></p>
                        <p><?php echo ((is_array($_tmp=$this->_tpl_vars['speaker']['description_en'])) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
</p>
                        <div class="speaker-icon">
                        <?php if ($this->_tpl_vars['speaker']['facebook']): ?><a href="<?php echo $this->_tpl_vars['speaker']['facebook']; ?>
" class="fa fa-facebook" target="_blank"></a><?php endif; ?>
                        <?php if ($this->_tpl_vars['speaker']['vk']): ?><a href="<?php echo $this->_tpl_vars['speaker']['vk']; ?>
" class="fa fa-vk" target="_blank"></a><?php endif; ?>
                        <?php if ($this->_tpl_vars['speaker']['instagram']): ?><a href="<?php echo $this->_tpl_vars['speaker']['instagram']; ?>
" class="fa fa-instagram" target="_blank"></a><?php endif; ?>
                        <?php if ($this->_tpl_vars['speaker']['twitter']): ?><a href="<?php echo $this->_tpl_vars['speaker']['twitter']; ?>
" class="fa fa-twitter" target="_blank"></a><?php endif; ?>
                        <?php if ($this->_tpl_vars['speaker']['site']): ?><a href="<?php echo $this->_tpl_vars['speaker']['site']; ?>
" class="fa fa-globe" target="_blank"></a><?php endif; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="title"><?php echo $this->_tpl_vars['speaker']['name']; ?>
<br/><?php echo $this->_tpl_vars['speaker']['secondName']; ?>
</p>
                    <div class="desc">
                        <p><?php echo $this->_tpl_vars['speaker']['company']; ?>
<?php if ($this->_tpl_vars['speaker']['cityName']): ?><br/><?php echo $this->_tpl_vars['speaker']['cityName']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['speaker']['position']): ?><br/><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['speaker']['position'])) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
<?php endif; ?></p>
                        <p><?php echo ((is_array($_tmp=$this->_tpl_vars['speaker']['description'])) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
</p>
                        <div class="speaker-icon">
                        <?php if ($this->_tpl_vars['speaker']['facebook']): ?><a href="<?php echo $this->_tpl_vars['speaker']['facebook']; ?>
" class="fa fa-facebook" target="_blank"></a><?php endif; ?>
                        <?php if ($this->_tpl_vars['speaker']['vk']): ?><a href="<?php echo $this->_tpl_vars['speaker']['vk']; ?>
" class="fa fa-vk" target="_blank"></a><?php endif; ?>
                        <?php if ($this->_tpl_vars['speaker']['instagram']): ?><a href="<?php echo $this->_tpl_vars['speaker']['instagram']; ?>
" class="fa fa-instagram" target="_blank"></a><?php endif; ?>
                        <?php if ($this->_tpl_vars['speaker']['twitter']): ?><a href="<?php echo $this->_tpl_vars['speaker']['twitter']; ?>
" class="fa fa-twitter" target="_blank"></a><?php endif; ?>
                        <?php if ($this->_tpl_vars['speaker']['site']): ?><a href="<?php echo $this->_tpl_vars['speaker']['site']; ?>
" class="fa fa-globe" target="_blank"></a><?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="speaker-mk">
                    <?php echo smarty_function_getmkbyspeaker(array('id' => $this->_tpl_vars['speaker']['id']), $this);?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; endif; unset($_from); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5 mb-3 tags-list-oldspeakers text-center">
            <ul class="nav navbar-nav navbar-right">
                <li id="fat-menu" class="dropdown">
                    <a href="#" class="dropdown-toggle" id="drop3" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Спикеры прошлых лет <span class="caret"></span> </a>
                    <ul class="dropdown-menu" aria-labelledby="drop3">
                        <li><a href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => 2019), $this);?>
">#2019</a></li>
                        <li><a href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => 2018), $this);?>
">#2018</a></li>
                        <li><a href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => 2017), $this);?>
">#2017</a></li>
                        <li><a href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => 2016), $this);?>
">#2016</a></li>
                        <li><a href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => 2015), $this);?>
">#2015</a></li>
                        <li><a href="<?php echo smarty_function_link(array('show' => 'speakers','tag' => 'barstreet2016'), $this);?>
">#barstreet</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>