<?php /* Smarty version 2.6.13, created on 2019-11-28 20:07:52
         compiled from /home/c484884/gastreet.com/www/app/Templates/CatalogControl4.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl4.html', 20, false),array('function', 'declension', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl4.html', 73, false),array('modifier', 'dbtexttohtml', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl4.html', 30, false),array('modifier', 'tstocheck', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl4.html', 41, false),array('modifier', 'dateformat', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl4.html', 48, false),array('modifier', 'getidyoutubevideo', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl4.html', 49, false),array('modifier', 'isproductpic', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl4.html', 51, false),array('modifier', 'round0', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl4.html', 70, false),)), $this); ?>
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
                        <?php if ($this->_tpl_vars['app'] != 1): ?>
                        <ul class="breadcrumbs">
                            <li><a href="/">Home</a></li>
                            <li><a href="<?php echo smarty_function_link(array('show' => 'programms'), $this);?>
">Program</a></li>
                            <li><span><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['this']['amObj']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['this']['amObj']->name; ?>
<?php endif; ?></span></li>
                        </ul>
                        <?php endif; ?>
                        <h1 class="page-headline"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['this']['amObj']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['this']['amObj']->name; ?>
<?php endif; ?></h1>
                        <div class="tickects-video-catalog-page tickects-video-catalog-4 gss-video-watch-catalog-page">
                            <div class="js-videos-gallery">
                                <div><a data-target="#video-modal" data-toggle="modal" data-link="QM0iXj08IuQ" data-title="<?php if ($this->_tpl_vars['lang'] == 'en'): ?>about POP-UP SHOW<?php else: ?>О POP-UP SHOW<?php endif; ?>" href="#"><span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Watch the video<br>about POP-UP SHOW<?php else: ?>Посмотрите ролик<br>о POP-UP SHOW<?php endif; ?></span></a></div>
                            </div>
                        </div>
                        <div class="textblock"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['this']['amObj']->description_en)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['this']['amObj']->description)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
<?php endif; ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row mt-4 mb-4">
            <?php if ($this->_tpl_vars['this']['products']): ?>
                <?php $this->assign('productiteration', 0); ?>
                <?php $this->assign('oldareaid', 0); ?>
                <?php $this->assign('oldeventtsstart', 0); ?>
                <?php $_from = $this->_tpl_vars['this']['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['productloop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['productloop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['productloop']['iteration']++;
?>
                    <?php $this->assign('eventtsstart', ((is_array($_tmp=$this->_tpl_vars['product']->eventTsStart)) ? $this->_run_mod_handler('tstocheck', true, $_tmp) : smarty_modifier_tstocheck($_tmp))); ?>
                    <?php $this->assign('placeid', $this->_tpl_vars['product']->placeId); ?>
                    <?php $this->assign('speakerid', $this->_tpl_vars['product']->speakerId); ?>
                    <?php $this->assign('speaker', $this->_tpl_vars['this']['speakers'][$this->_tpl_vars['speakerid']]); ?>

                    <div class="col-md-4">
                        <div class="event-teaser">
                            <p class="date"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->eventTsStart)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd M') : smarty_modifier_dateformat($_tmp, 'd M')); ?>
</p>
                            <?php $this->assign('idYoutubeVideo', ((is_array($_tmp=$this->_tpl_vars['product']->youtube)) ? $this->_run_mod_handler('getidyoutubevideo', true, $_tmp) : smarty_modifier_getidyoutubevideo($_tmp))); ?>
                            <a class="thumb js-popover" href="#" data-toggle="modal" data-target="#popover-win-<?php echo $this->_tpl_vars['product']->id; ?>
" data-idyoutubevideo="<?php echo $this->_tpl_vars['idYoutubeVideo']; ?>
">
                                <?php $this->assign('isimgproduct', ((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('isproductpic', true, $_tmp) : smarty_modifier_isproductpic($_tmp))); ?>
                                <figure class="themed-photo">
                                    <?php if ($this->_tpl_vars['product']->pic2): ?>
                                        <img class="photo" src="/images/products/resized/<?php echo $this->_tpl_vars['product']->pic2; ?>
?v=<?php echo $this->_tpl_vars['product']->tsUpdate; ?>
">
                                    <?php else: ?>
                                        <img class="photo" src="/content/event1.jpg">
                                    <?php endif; ?>
                                </figure>
                                <div class="about"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->eventTsStart)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'H:i') : smarty_modifier_dateformat($_tmp, 'H:i')); ?>
</div>
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
                            </a>
                            <div class="order">
                                <?php if ($this->_tpl_vars['product']->price > 0): ?><p class="price"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->price)) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
 руб.</p><?php endif; ?>
                                <?php if ($this->_tpl_vars['product']->leftCount > 0 && $this->_tpl_vars['canShowButton'] && $this->_tpl_vars['app'] != 1 && ! $this->_tpl_vars['this']['productId']): ?><a class="btn-cart" href="/index.php?do=add&product=<?php echo $this->_tpl_vars['product']->id; ?>
"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a><?php endif; ?>
                            </div>
                            <?php if ($this->_tpl_vars['product']->leftCount): ?><p class="count">Доступно: <?php echo smarty_function_declension(array('count' => $this->_tpl_vars['product']->leftCount,'form1' => "билет",'form2' => "билета",'form5' => "билетов"), $this);?>
</p><?php endif; ?>
                            <div class="speaker">
                                <p class="job"><?php echo $this->_tpl_vars['this']['plmArray'][$this->_tpl_vars['placeid']]; ?>
</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal popup-modal fade" id="popover-win-<?php echo $this->_tpl_vars['product']->id; ?>
" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header p-3">
                                    <p class="title m-0"><?php echo $this->_tpl_vars['product']->name; ?>
</p>
                                    <span class="close" data-dismiss="modal">&times;</span>
                                </div>
                                <div class="modal-body p-0 pl-3 pb-3 pr-3">
                                    <?php if ($this->_tpl_vars['idYoutubeVideo']): ?>
                                        <div class="thumb">
                                            <iframe src="" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                    <?php else: ?>
                                        <figure class="thumb">
                                            <?php if ($this->_tpl_vars['product']->pic2): ?>
                                                <img class="img-fluid" src="/images/products/resized/<?php echo $this->_tpl_vars['product']->pic2; ?>
?v=<?php echo $this->_tpl_vars['product']->tsUpdate; ?>
">
                                            <?php else: ?>
                                            <img class="img-fluid" style="width: 100%;" src="/content/event1.jpg">
                                            <?php endif; ?>
                                        </figure>
                                    <?php endif; ?>
                                    
                                    <div class="desc"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->description)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
</div>
                                    <?php if ($this->_tpl_vars['product']->leftCount > 0 && $this->_tpl_vars['canShowButton'] && $this->_tpl_vars['app'] != 1 && ! $this->_tpl_vars['this']['productId']): ?><div class="order"><a class="btn btn-white" href="/index.php?do=add&product=<?php echo $this->_tpl_vars['product']->id; ?>
"><i class="fa fa-shopping-cart mr-2" aria-hidden="true"></i>Купить</a></div><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; endif; unset($_from); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="stick-to-footer container">
    <div class="instagram-gallery">
        <div class="gallery-col">
            <h2 class="section-headline" style="margin-top: 4rem;margin-bottom: 2.75rem;">Gastreet<br> History</h2>
            <img src="/images/collages/gala1.jpg">
        </div>
        <div class="gallery-col">
            <img src="/images/collages/gala2.jpg">
            <div class="gallery-row">
                <div class="gallery-col-1of2"><img src="/images/collages/gala3.jpg"></div>
                <div class="gallery-col-1of2"><img src="/images/collages/gala4.jpg"></div>
            </div>
        </div>
        <div class="gallery-col">
            <img src="/images/collages/gala5.jpg">
            <div class="gallery-row">
                <div class="gallery-col-1of2"><img src="/images/collages/gala6.jpg"></div>
                <div class="gallery-col-1of2"><img src="/images/collages/gala7.jpg"></div>
            </div>
            <img src="/images/collages/gala8.jpg">
        </div>
    </div>
</div>
<div class="container gss-tag">#gastreetshow</div>