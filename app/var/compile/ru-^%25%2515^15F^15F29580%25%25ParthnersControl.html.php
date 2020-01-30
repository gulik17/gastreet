<?php /* Smarty version 2.6.13, created on 2019-11-28 16:56:52
         compiled from /home/c484884/gastreet.com/www/app/Templates/ParthnersControl.html */ ?>
<?php $this->assign('this', $this->_tpl_vars['ParthnersControl']); ?>

<div class="jumbotron-blank">
    <div class="l-container">
        <div class="content">
            <ul class="breadcrumbs">
                <li><a href="/">Главная</a></li>
                <li><span>Партнеры</span></li>
            </ul>
        </div>
    </div>
</div>
<div class="l-container">

    <h2 class="section-headline has-align-center has-size-sm">Партнеры мероприятия</h2>
    <div class="partners-list">
        <ul>
            <?php $_from = $this->_tpl_vars['this']['parthners']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['parthner']):
?>
                <?php if ($this->_tpl_vars['parthner']->parthnerTypeId == 1): ?>
                    <li class="gss-parthner-show-one">
                        <div class="gss-parthner-text">&nbsp;<?php echo $this->_tpl_vars['parthner']->title; ?>
&nbsp;</div>
                        <figure><?php if ($this->_tpl_vars['parthner']->url): ?><a href="<?php echo $this->_tpl_vars['parthner']->url; ?>
" title="<?php echo $this->_tpl_vars['parthner']->name; ?>
" target="_blank" rel="nofollow"><?php endif; ?><img src="/images/parthners/resized/<?php echo $this->_tpl_vars['parthner']->id; ?>
.jpg?v=<?php echo $this->_tpl_vars['parthner']->tsUpdate; ?>
" /><?php if ($this->_tpl_vars['parthner']->url): ?></a><?php endif; ?></figure>
                    </li>
                <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
    </div>

    <br/>
    <h2 class="section-headline has-align-center has-size-sm">Партнеры по организации</h2>
    <div class="partners-list">
        <ul>
            <?php $_from = $this->_tpl_vars['this']['parthners']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['parthner']):
?>
            <?php if ($this->_tpl_vars['parthner']->parthnerTypeId == 2): ?>
            <li class="gss-parthner-show-one">
                <div class="gss-parthner-text">&nbsp;<?php echo $this->_tpl_vars['parthner']->title; ?>
&nbsp;</div>
                <figure><?php if ($this->_tpl_vars['parthner']->url): ?><a href="<?php echo $this->_tpl_vars['parthner']->url; ?>
" title="<?php echo $this->_tpl_vars['parthner']->name; ?>
" target="_blank" rel="nofollow"><?php endif; ?><img src="/images/parthners/resized/<?php echo $this->_tpl_vars['parthner']->id; ?>
.jpg?v=<?php echo $this->_tpl_vars['parthner']->tsUpdate; ?>
" /><?php if ($this->_tpl_vars['parthner']->url): ?></a><?php endif; ?></figure>
            </li>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
    </div>

    <br/>
    <h2 class="section-headline has-align-center has-size-sm">Информационные партнеры</h2>
    <div class="partners-list">
        <ul>
            <?php $_from = $this->_tpl_vars['this']['parthners']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['parthner']):
?>
            <?php if ($this->_tpl_vars['parthner']->parthnerTypeId == 3): ?>
            <li class="gss-parthner-show-one">
                <div class="gss-parthner-text">&nbsp;<?php echo $this->_tpl_vars['parthner']->title; ?>
&nbsp;</div>
                <figure><?php if ($this->_tpl_vars['parthner']->url): ?><a href="<?php echo $this->_tpl_vars['parthner']->url; ?>
" title="<?php echo $this->_tpl_vars['parthner']->name; ?>
" target="_blank" rel="nofollow"><?php endif; ?><img src="/images/parthners/resized/<?php echo $this->_tpl_vars['parthner']->id; ?>
.jpg?v=<?php echo $this->_tpl_vars['parthner']->tsUpdate; ?>
" /><?php if ($this->_tpl_vars['parthner']->url): ?></a><?php endif; ?></figure>
            </li>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
    </div>

</div>
