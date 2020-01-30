<?php /* Smarty version 2.6.13, created on 2020-01-20 14:17:45
         compiled from /home/c484884/gastreet.com/www/app/Templates/VideoControl.html */ ?>
<?php $this->assign('this', $this->_tpl_vars['VideoControl']); ?>

<?php if ($this->_tpl_vars['this']['vmList']): ?>
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-7">
            <h2 class="section-headline m-0">After movie</h2>
        </div>
        <div class="col-md-5">
            <div class="g-emoji-content">
                <div class="g-emoji-icon">
                    <img src="/images/emoji/9.png" class="img-fluid" alt="">
                </div>
                <div class="g-emoji-balun">
                    Смотри видосики со всех GASTREET'ов
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php $_from = $this->_tpl_vars['this']['vmList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['video']):
?>
            <?php if ($this->_tpl_vars['video']->v_group == 1): ?>
            <div class="col-md-4 mb-4">
                <a class="video-teaser js-video-item" data-target="#video-modal" data-toggle="modal" data-link="<?php echo $this->_tpl_vars['video']->url; ?>
" data-title="<?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['video']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['video']->name; ?>
<?php endif; ?>" href="https://youtu.be/<?php echo $this->_tpl_vars['video']->url; ?>
">
                    <img src="https://i.ytimg.com/vi/<?php echo $this->_tpl_vars['video']->url; ?>
/hqdefault.jpg">
                    <p class="title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['video']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['video']->name; ?>
<?php endif; ?></p>
                </a>
            </div>
            <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
        <div class="controls">
            <div class="dots js-dots-videos">&nbsp;</div>
        </div>
    </div>
    <br>
    <h2 class="section-headline">БЕКСТЕЙДЖ</h2>
    <div class="row">
        <?php $_from = $this->_tpl_vars['this']['vmList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['video']):
?>
        <?php if ($this->_tpl_vars['video']->v_group == 2): ?>
        <div class="col-md-4 mb-4">
            <a class="video-teaser js-video-item" data-target="#video-modal" data-toggle="modal" data-link="<?php echo $this->_tpl_vars['video']->url; ?>
" data-title="<?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['video']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['video']->name; ?>
<?php endif; ?>" href="https://youtu.be/<?php echo $this->_tpl_vars['video']->url; ?>
">
                <img src="https://i.ytimg.com/vi/<?php echo $this->_tpl_vars['video']->url; ?>
/hqdefault.jpg">
                <p class="title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['video']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['video']->name; ?>
<?php endif; ?></p>
            </a>
        </div>
        <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
        <div class="controls">
            <div class="dots js-dots-videos">&nbsp;</div>
        </div>
    </div>
</div>
<?php endif; ?>