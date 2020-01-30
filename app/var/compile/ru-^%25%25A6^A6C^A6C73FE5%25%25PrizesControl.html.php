<?php /* Smarty version 2.6.13, created on 2019-11-28 15:39:30
         compiled from /home/c484884/gastreet.com/www/app/Templates/PrizesControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'getidyoutubevideo', '/home/c484884/gastreet.com/www/app/Templates/PrizesControl.html', 24, false),array('modifier', 'isprizepic', '/home/c484884/gastreet.com/www/app/Templates/PrizesControl.html', 25, false),array('modifier', 'dbtexttohtml', '/home/c484884/gastreet.com/www/app/Templates/PrizesControl.html', 68, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['PrizesControl']); ?>

<div class="jumbotron-blank">
    <div class="container">
        <div class="content">
            <ul class="breadcrumbs">
                <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                <li><a href="/">Home</a></li>
                <li><span>News and goodies</span></li>
                <?php else: ?>
                <li><a href="/">Главная</a></li>
                <li><span>Новости и ништяки</span></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <h1 class="page-headline"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>News and goodies<?php else: ?>Новости и ништяки<?php endif; ?></h1>
    <div class="row">
        <?php if ($this->_tpl_vars['this']['pmList']): ?>
            <!-- loop start -->
            <?php $_from = $this->_tpl_vars['this']['pmList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prize']):
?>
            <?php $this->assign('idYoutubeVideo', ((is_array($_tmp=$this->_tpl_vars['prize']->youtube)) ? $this->_run_mod_handler('getidyoutubevideo', true, $_tmp) : smarty_modifier_getidyoutubevideo($_tmp))); ?>
            <?php $this->assign('isPrizeImg1', ((is_array($_tmp=$this->_tpl_vars['prize']->id)) ? $this->_run_mod_handler('isprizepic', true, $_tmp) : smarty_modifier_isprizepic($_tmp))); ?>
                <div class="col-md-3 mb-4">
                    <a class="person-teaser js-popover" href="#popover-win-prize-<?php echo $this->_tpl_vars['prize']->id; ?>
" data-popover="#popover-win-prize-<?php echo $this->_tpl_vars['prize']->id; ?>
" data-idyoutubevideo="<?php echo $this->_tpl_vars['idYoutubeVideo']; ?>
" data-timer="on">
                        <?php if ($this->_tpl_vars['isPrizeImg1']): ?>
                        <img src="/images/prizes/resized/<?php echo $this->_tpl_vars['prize']->id; ?>
.jpg?v=<?php echo $this->_tpl_vars['prize']->tsUpdate; ?>
" data-ratio="1">
                        <?php else: ?>
                        <img src="/images/gss/speaker.jpg" data-ratio="1">
                        <?php endif; ?>
                        <div class="prizes-about">
                            <p class="prizes-name"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['prize']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['prize']->name; ?>
<?php endif; ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; endif; unset($_from); ?>
            <!-- loop end -->
        <?php endif; ?>
    </div>
</div>

<?php $_from = $this->_tpl_vars['this']['pmList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prize']):
?>
<?php $this->assign('idYoutubeVideo', ((is_array($_tmp=$this->_tpl_vars['prize']->youtube)) ? $this->_run_mod_handler('getidyoutubevideo', true, $_tmp) : smarty_modifier_getidyoutubevideo($_tmp))); ?>
<?php $this->assign('isPrizeImg1', ((is_array($_tmp=$this->_tpl_vars['prize']->id)) ? $this->_run_mod_handler('isprizepic', true, $_tmp) : smarty_modifier_isprizepic($_tmp))); ?>
    <div class="modal fade" id="popover-win-prize-<?php echo $this->_tpl_vars['prize']->id; ?>
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
                        <figure class="thumb fg-container">
                            <?php if ($this->_tpl_vars['isPrizeImg1']): ?>
                                <img src="/images/prizes/resized/<?php echo $this->_tpl_vars['prize']->id; ?>
.jpg?v=<?php echo $this->_tpl_vars['prize']->tsUpdate; ?>
">
                            <?php else: ?>
                                <img src="/images/gss/speaker.jpg">
                            <?php endif; ?>
                        </figure>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                    <p class="title"><?php echo $this->_tpl_vars['prize']->name_en; ?>
</p>
                    <div class="desc">
                        <p><?php echo ((is_array($_tmp=$this->_tpl_vars['prize']->description_en)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
</p>
                    </div>
                    <?php else: ?>
                    <p class="title"><?php echo $this->_tpl_vars['prize']->name; ?>
</p>
                    <div class="desc">
                        <p><?php echo ((is_array($_tmp=$this->_tpl_vars['prize']->description)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; endif; unset($_from); ?>