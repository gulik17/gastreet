<?php /* Smarty version 2.6.13, created on 2019-11-28 16:37:56
         compiled from /home/c484884/gastreet.com/www/app/Templates/CatalogControl12.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'dbtexttohtml', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl12.html', 50, false),array('modifier', 'tstocheck', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl12.html', 69, false),array('modifier', 'dateformat', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl12.html', 92, false),array('modifier', 'getidyoutubevideo', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl12.html', 93, false),array('modifier', 'isproductpic', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl12.html', 95, false),array('modifier', 'round0', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl12.html', 122, false),array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl12.html', 63, false),array('function', 'declension', '/home/c484884/gastreet.com/www/app/Templates/CatalogControl12.html', 105, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['CatalogControl']); ?>

<div class="main-bg">
    <nav class="navbar" id="navbar">
        <div class="container">
            <div class="navbar-header">
                <div class="gastreet">
                    <div class="place">
                        <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                            <p>Sochi, Krasnaya Polyana,<br /> Gorki Gorod, +960</p>
                        <?php else: ?>
                            <p>Сочи, Красная Поляна,<br />Горки Город, +960</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="navbar-header navbar-right">
                <div class="con-block">
                    <div class="icon-block">
                        <a href="https://www.instagram.com/gastreetshow" target="_blank" class="icon instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        <a href="https://www.facebook.com/gastreetshow" target="_blank" class="icon facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    </div>
                    <p class="phone"></p>
                </div>
            </div>
        </div>
    </nav>
    <div class="header_title">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                        <h1 class="title"><?php echo $this->_tpl_vars['this']['amObj']->name_en; ?>
</h1>
                        <p class="subtitle">В городе Сочи так много достопримечательностей, известных объектов и захватывающих природных пейзажей, что побывать тут и не посетить их - будет непростительной ошибкой.</p>
                    <?php else: ?>
                        <h1 class="title"><?php echo $this->_tpl_vars['this']['amObj']->name; ?>
</h1>
                        <p class="subtitle">В городе Сочи так много достопримечательностей, известных объектов и захватывающих природных пейзажей, что побывать тут и не посетить их - будет непростительной ошибкой.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="page-container">
        <div class="row">
            <?php if ($this->_tpl_vars['this']['amObj']): ?>
                <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                    <?php echo ((is_array($_tmp=$this->_tpl_vars['this']['amObj']->description_en)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>

                <?php else: ?>
                    <?php echo ((is_array($_tmp=$this->_tpl_vars['this']['amObj']->description)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>

                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if ($this->_tpl_vars['this']['products']): ?>
    <?php $this->assign('productiteration', 0); ?>
    <?php $this->assign('oldareaid', 0); ?>
    <?php $this->assign('oldeventtsstart', 0); ?>
    <?php if ($this->_tpl_vars['this']['productId']): ?><form action="<?php echo smarty_function_link(array('do' => 'add'), $this);?>
" method="post"><input type="hidden" name="productId" value="<?php echo $this->_tpl_vars['this']['productId']; ?>
" /><?php endif; ?>
        <?php $_from = $this->_tpl_vars['this']['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['productloop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['productloop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['productloop']['iteration']++;
?>
        <?php if ($this->_tpl_vars['oldareaid'] != $this->_tpl_vars['product']->areaId): ?>
            <?php $this->assign('newareaid', $this->_tpl_vars['product']->areaId); ?>
            <!-- area delimiter -->
        <?php endif; ?>
        <?php $this->assign('eventtsstart', ((is_array($_tmp=$this->_tpl_vars['product']->eventTsStart)) ? $this->_run_mod_handler('tstocheck', true, $_tmp) : smarty_modifier_tstocheck($_tmp))); ?>
        <?php $this->assign('placeid', $this->_tpl_vars['product']->placeId); ?>
        <?php $this->assign('speakerid', $this->_tpl_vars['product']->speakerId); ?>
        <?php $this->assign('speaker', $this->_tpl_vars['this']['speakers'][$this->_tpl_vars['speakerid']]); ?>
        <?php if ($this->_tpl_vars['oldeventtsstart'] != $this->_tpl_vars['eventtsstart']): ?>
            <!-- another date -->
        <?php endif; ?>

        <?php if ($this->_tpl_vars['productiteration'] >= 3): ?>
            <?php if ($this->_tpl_vars['productiteration'] > 0): ?>
            </div>
            <?php endif; ?>
            <?php $this->assign('productiteration', 0); ?>
            <!-- event delimiter -->
        <?php endif; ?>

        <?php if ($this->_tpl_vars['productiteration'] == 0): ?>
            <div class="page-subsection l-row">
        <?php endif; ?>

        <?php $this->assign('productiteration', $this->_tpl_vars['productiteration']+1); ?>
            <div class="l-col-tbl-4 l-as-row">
                <div class="event-teaser">
                   <!-- <p class="date"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->eventTsStart)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd M') : smarty_modifier_dateformat($_tmp, 'd M')); ?>
</p> -->
                    <?php $this->assign('idYoutubeVideo', ((is_array($_tmp=$this->_tpl_vars['product']->youtube)) ? $this->_run_mod_handler('getidyoutubevideo', true, $_tmp) : smarty_modifier_getidyoutubevideo($_tmp))); ?>
                    <a class="thumb js-popover" href="#popover-win-<?php echo $this->_tpl_vars['product']->id; ?>
" data-popover="#popover-win-<?php echo $this->_tpl_vars['product']->id; ?>
" data-idyoutubevideo="<?php echo $this->_tpl_vars['idYoutubeVideo']; ?>
">
                        <?php $this->assign('isimgproduct', ((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('isproductpic', true, $_tmp) : smarty_modifier_isproductpic($_tmp))); ?>
                        <figure class="themed-photo">
                            <?php if ($this->_tpl_vars['isimgproduct']): ?>
                                <img class="photo" src="/images/products/resized/<?php echo $this->_tpl_vars['product']->id; ?>
.jpg?v=<?php echo $this->_tpl_vars['product']->tsUpdate; ?>
">
                            <?php else: ?>
                                <img class="photo" src="/content/event<?php echo $this->_tpl_vars['productiteration']; ?>
.jpg">
                            <?php endif; ?>
                        </figure>
                        <div class="about">
                            <!-- <p class="time"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->eventTsStart)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'H:i') : smarty_modifier_dateformat($_tmp, 'H:i')); ?>
</p> -->
                            <?php if ($this->_tpl_vars['product']->leftCount): ?><p class="count">Доступно:<br><?php echo smarty_function_declension(array('count' => $this->_tpl_vars['product']->leftCount,'form1' => "билет",'form2' => "билета",'form5' => "билетов"), $this);?>
</p><?php endif; ?>
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
                        <div class="more">Подробнее</div>
                    </a>
                    <div class="speaker">
                        <p class="name"><?php echo $this->_tpl_vars['product']->name; ?>
</p>
                        <p class="job"><?php echo $this->_tpl_vars['this']['plmArray'][$this->_tpl_vars['placeid']]; ?>
</p>
                    </div>
                    <div class="order">
                        <?php if ($this->_tpl_vars['product']->price > 0): ?><p class="price"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->price)) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
 руб.</p><?php endif; ?>
                        <?php if ($this->_tpl_vars['product']->leftCount > 0 && ! $this->_tpl_vars['this']['disableAllBecauseNoBaseTicket'] && $this->_tpl_vars['canShowButton'] && ! $this->_tpl_vars['this']['productId']): ?><a class="btn-cart" href="#" onclick='window.location.href = "/index.php?do=add&product=<?php echo $this->_tpl_vars['product']->id; ?>
"; return false;' title="Купить">Купить</a><?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="popover-win-<?php echo $this->_tpl_vars['product']->id; ?>
" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="popover-win">
                            <span class="close" data-dismiss="modal">&times;</span>
                            <?php if ($this->_tpl_vars['idYoutubeVideo']): ?>
                                <div class="thumb">
                                    <iframe src="" frameborder="0" allowfullscreen></iframe>
                                </div>
                            <?php else: ?>
                                <figure class="thumb">
                                    <?php if ($this->_tpl_vars['isimgproduct']): ?>
                                        <img src="/images/products/resized/<?php echo $this->_tpl_vars['product']->id; ?>
.jpg?v=<?php echo $this->_tpl_vars['product']->tsUpdate; ?>
">
                                    <?php else: ?>
                                        <img src="content/popover.jpg">
                                    <?php endif; ?>
                                </figure>
                            <?php endif; ?>
                            <p class="title"><?php echo $this->_tpl_vars['product']->name; ?>
</p>
                            <div class="desc"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->description)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
</div>
                            <?php if ($this->_tpl_vars['product']->leftCount > 0 && ! $this->_tpl_vars['this']['disableAllBecauseNoBaseTicket'] && $this->_tpl_vars['canShowButton'] && ! $this->_tpl_vars['this']['productId']): ?><div class="order"><a href="#" onclick='window.location.href = "/index.php?do=add&product=<?php echo $this->_tpl_vars['product']->id; ?>
"; return false;' title="Купить">Купить</a></div><?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->assign('oldeventtsstart', ((is_array($_tmp=$this->_tpl_vars['product']->eventTsStart)) ? $this->_run_mod_handler('tstocheck', true, $_tmp) : smarty_modifier_tstocheck($_tmp))); ?>
        <?php endforeach; endif; unset($_from); ?>
    </div>
    <?php if ($this->_tpl_vars['this']['productId']): ?><div class="container padding-top-bottom-10"><input type="submit" value="Заменить"/></div></form><?php endif; ?>
<?php endif; ?>