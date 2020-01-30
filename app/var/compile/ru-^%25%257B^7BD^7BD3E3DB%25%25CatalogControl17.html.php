<?php /* Smarty version 2.6.13, created on 2019-11-28 21:03:44
         compiled from /home/c484884/gastreet.com/www/app/Templates/CatalogControl17.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl17.html', 19, false),array('modifier', 'dbtexttohtml', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl17.html', 28, false),)), $this); ?>
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
<?php else: ?><?php echo $this->_tpl_vars['this']['amObj']->name; ?>
<?php endif; ?></span></li>
                        </ul>
                        <h1 class="page-headline"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['this']['amObj']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['this']['amObj']->name; ?>
<?php endif; ?></h1>
                        <div class="tickects-video-catalog-page tickects-video-catalog-17 gss-video-watch-catalog-page">
                            <div class="js-videos-gallery">
                                <div><a data-target="#video-modal" data-toggle="modal" data-link="z0GPYg-kWSQ" data-title="<?php if ($this->_tpl_vars['lang'] == 'en'): ?>about BARISTA STREET<?php else: ?>О BARISTA STREET<?php endif; ?>" href="#"><span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Watch the video<br>about BARISTA STREET<?php else: ?>Посмотрите ролик<br>о BARISTA STREET<?php endif; ?></span></a></div>
                            </div>
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
<div class="stick-to-footer container mt-3">
    <div class="instagram-gallery">
        <div class="gallery-col">
            <h2 class="section-headline" style="margin-top: 4rem;margin-bottom: 3.04rem;">Gastreet<br> History</h2>
            <img src="/images/collages/baristastreet1.jpg">
        </div>
        <div class="gallery-col">
            <img src="/images/collages/baristastreet2.jpg">
            <div class="gallery-row">
                <div class="gallery-col-1of2"><img src="/images/collages/baristastreet3.jpg"></div>
                <div class="gallery-col-1of2"><img src="/images/collages/baristastreet4.jpg"></div>
            </div>
        </div>
        <div class="gallery-col">
            <img src="/images/collages/baristastreet5.jpg">
            <div class="gallery-row">
                <div class="gallery-col-1of2"><img src="/images/collages/baristastreet6.jpg"></div>
                <div class="gallery-col-1of2"><img src="/images/collages/baristastreet7.jpg"></div>
            </div>
            <img src="/images/collages/baristastreet8.jpg">
        </div>
    </div>
</div>
<div class="container gss-tag">#gastreetshow</div>