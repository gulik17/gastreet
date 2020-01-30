<?php /* Smarty version 2.6.13, created on 2019-11-29 04:11:30
         compiled from /home/c484884/gastreet.com/www/app/Templates/CatalogControl7.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl7.html', 19, false),array('modifier', 'dbtexttohtml', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl7.html', 26, false),array('modifier', 'tagtocssclass', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl7.html', 40, false),array('modifier', 'isspeakerpicpic', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl7.html', 41, false),array('modifier', 'tagformat', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl7.html', 43, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['CatalogControl']); ?>

<div class="container">
    <div class="page-container" id="page-container">
        <div class="row">
            <div class="col-md-6">
                <div class="page-container-image" id="page-container-image">
                    <picture>
                        <source srcset="/images/areas/resized/03<?php echo $this->_tpl_vars['this']['amObj']->id; ?>
.jpg?v=<?php echo $this->_tpl_vars['this']['amObj']->tsUpdated; ?>
" media="(min-width: 1200px)">
                        <img src="/images/areas/resized/01<?php echo $this->_tpl_vars['this']['amObj']->id; ?>
.jpg?v=<?php echo $this->_tpl_vars['this']['amObj']->tsUpdated; ?>
">
                    </picture>
                </div>
            </div>
            <div class="col-md-6">
                <div class="page-container-inner" id="page-container-inner">
                    <?php if ($this->_tpl_vars['this']['amObj']): ?>
                        <ul class="breadcrumbs">
                            <li><a href="/">Главная</a></li>
                            <li><a href="<?php echo smarty_function_link(array('show' => 'programms'), $this);?>
">Программа</a></li>
                            <li><span><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['this']['amObj']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['this']['amObj']->name_en; ?>
<?php endif; ?></span></li>
                        </ul>
                        <h1 class="page-headline"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['this']['amObj']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['this']['amObj']->name; ?>
<?php endif; ?></h1>
                        <div class="tickects-video-catalog-page tickects-video-catalog-7 gss-video-watch-catalog-page">
                            <div><a data-target="#video-modal" data-toggle="modal" data-link="z8Nde1zaiyw" data-title="<?php if ($this->_tpl_vars['lang'] == 'en'): ?>About BARSTREET<?php else: ?>О BARSTREET<?php endif; ?>" href="#"><span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Watch the video<br>about BARSTREET<?php else: ?>Посмотрите ролик<br>о BARSTREET<?php endif; ?></span></a></div>
                        </div>
                        <div class="textblock"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['this']['amObj']->description_en)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['this']['amObj']->description)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
<?php endif; ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3 d-none">
    <div class="row speakers-grid js-speakers-grid speakers_2019">
        <?php if ($this->_tpl_vars['this']['spmList']): ?>
        <!-- loop start -->
        <?php $_from = $this->_tpl_vars['this']['spmList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['speaker']):
?>
        <div class="col-6 col-md-3 grid-entry speaker">
            <a class="person-teaser js-popover <?php echo ((is_array($_tmp=$this->_tpl_vars['speaker']['tags'])) ? $this->_run_mod_handler('tagtocssclass', true, $_tmp) : smarty_modifier_tagtocssclass($_tmp)); ?>
" href="#" data-speaker-id="<?php echo $this->_tpl_vars['speaker']['id']; ?>
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
                <div class="icon-country <?php echo $this->_tpl_vars['speaker']['country']; ?>
"></div>
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
<br/><?php echo $this->_tpl_vars['speaker']['secondName_en']; ?>
</p>
                        <p class="job"><?php echo $this->_tpl_vars['speaker']['company_en']; ?>
<?php if ($this->_tpl_vars['speaker']['cityName_en']): ?><br/><?php echo $this->_tpl_vars['speaker']['cityName_en']; ?>
<?php endif; ?></p>
                    <?php else: ?>
                        <p class="name"><?php echo $this->_tpl_vars['speaker']['name']; ?>
<br/><?php echo $this->_tpl_vars['speaker']['secondName']; ?>
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

<div class="stick-to-footer container mt-3">
    <div class="instagram-gallery">
        <div class="gallery-col">
            <h2 class="section-headline" style="margin-top: 4rem;margin-bottom: 2.75rem;">Gastreet<br> History</h2>
            <img src="/images/collages/barstreet1.jpg">
        </div>
        <div class="gallery-col">
            <img src="/images/collages/barstreet2.jpg">
            <div class="gallery-row">
                <div class="gallery-col-1of2"><img src="/images/collages/barstreet3.jpg"></div>
                <div class="gallery-col-1of2"><img src="/images/collages/barstreet4.jpg"></div>
            </div>
        </div>
        <div class="gallery-col">
            <img src="/images/collages/barstreet5.jpg">
            <div class="gallery-row">
                <div class="gallery-col-1of2"><img src="/images/collages/barstreet6.jpg"></div>
                <div class="gallery-col-1of2"><img src="/images/collages/barstreet7.jpg"></div>
            </div>
            <img src="/images/collages/barstreet8.jpg">
        </div>
    </div>
</div>
<div class="container gss-tag">#gastreetshow</div>