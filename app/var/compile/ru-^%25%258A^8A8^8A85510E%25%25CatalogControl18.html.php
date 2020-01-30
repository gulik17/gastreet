<?php /* Smarty version 2.6.13, created on 2019-11-29 00:34:22
         compiled from /home/c484884/gastreet.com/www/app/Templates/CatalogControl18.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl18.html', 20, false),array('modifier', 'dbtexttohtml', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl18.html', 24, false),)), $this); ?>
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
                        <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                        <ul class="breadcrumbs">
                            <li><a href="/">Home</a></li>
                            <li><a href="<?php echo smarty_function_link(array('show' => 'programms'), $this);?>
">Program</a></li>
                            <li><span><?php echo $this->_tpl_vars['this']['amObj']->name_en; ?>
</span></li>
                        </ul>
                        <h1 class="page-headline"><?php echo $this->_tpl_vars['this']['amObj']->name_en; ?>
</h1>
                        <div class="textblock"><?php echo ((is_array($_tmp=$this->_tpl_vars['this']['amObj']->description_en)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
</div>
                        <?php else: ?>
                        <ul class="breadcrumbs">
                            <li><a href="/">Главная</a></li>
                            <li><a href="<?php echo smarty_function_link(array('show' => 'programms'), $this);?>
">Программы</a></li>
                            <li><span><?php echo $this->_tpl_vars['this']['amObj']->name; ?>
</span></li>
                        </ul>
                        <h1 class="page-headline"><?php echo $this->_tpl_vars['this']['amObj']->name; ?>
</h1>
                        <div class="textblock"><?php echo ((is_array($_tmp=$this->_tpl_vars['this']['amObj']->description)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
</div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="stick-to-footer container d-none">
    <div class="instagram-gallery">
        <div class="gallery-col">
            <h2 class="section-headline" style="margin-top: 4rem;margin-bottom: 2.75rem;">Gastreet<br> History</h2>
            <img src="/images/collages/funeral1.jpg">
        </div>
        <div class="gallery-col">
            <img src="/images/collages/funeral2.jpg">
            <div class="gallery-row">
                <div class="gallery-col-1of2"><img src="/images/collages/funeral3.jpg"></div>
                <div class="gallery-col-1of2"><img src="/images/collages/funeral4.jpg"></div>
            </div>
        </div>
        <div class="gallery-col">
            <img src="/images/collages/funeral5.jpg">
            <div class="gallery-row">
                <div class="gallery-col-1of2"><img src="/images/collages/funeral6.jpg"></div>
                <div class="gallery-col-1of2"><img src="/images/collages/funeral7.jpg"></div>
            </div>
            <img src="/images/collages/funeral8.jpg">
        </div>
    </div>
</div>
<div class="container gss-tag">#gastreetshow</div>
