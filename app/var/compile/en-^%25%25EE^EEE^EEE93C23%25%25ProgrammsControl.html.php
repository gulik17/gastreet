<?php /* Smarty version 2.6.13, created on 2020-01-14 01:39:27
         compiled from /home/c484884/gastreet.com/www/app/Templates/ProgrammsControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/ProgrammsControl.html', 34, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ProgrammsControl']); ?>

<div class="jumbotron-blank">
    <div class="container">
        <div class="content">
            <ul class="breadcrumbs">
                <li><a href="/">Home</a></li>
                <li><span>Program</span></li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <div class="page-container gss-programms">
        <div class="row">
            <div class="col-md-8">
                <h4 class="page-headline"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Business program<?php else: ?>Обучение от GASTREET<?php endif; ?></h4>
            </div>
            <div class="col-md-4">
                <div class="g-emoji-content">
                    <div class="g-emoji-icon">
                        <img src="/images/emoji/1.png" class="img-fluid" alt="">
                    </div>
                    <div class="g-emoji-balun">
                        Все официальные образовательные площадки здесь
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <?php $_from = $this->_tpl_vars['this']['amList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['amObj']):
?>
            <?php if ($this->_tpl_vars['amObj']->areaTypeId == 1): ?>
            <div class="col-md-3 p-1">
                <div class="blank-img gss-programms-img ic_container capslide_img_cont3" onclick="window.location.href = '<?php echo smarty_function_link(array('show' => 'catalog','area' => $this->_tpl_vars['amObj']->id), $this);?>
';">
                    <img src="/images/areas/resized/01<?php echo $this->_tpl_vars['amObj']->id; ?>
.jpg?v=<?php echo $this->_tpl_vars['amObj']->tsUpdated; ?>
" alt="<?php echo $this->_tpl_vars['amObj']->name; ?>
" class="img-fluid">
                    <div class="ic_caption">
                        <h3><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['amObj']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['amObj']->name; ?>
<?php endif; ?></h3>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
        </div>

        <div class="row">
            <div class="col-md-8">
                <h4 class="page-headline"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Business program<?php else: ?>Обучение от партнеров<?php endif; ?></h4>
            </div>
            <div class="col-md-4">
                <div class="g-emoji-content">
                    <div class="g-emoji-icon">
                        <img src="/images/emoji/2.png" class="img-fluid" alt="">
                    </div>
                    <div class="g-emoji-balun">
                        А это образовательные площадки от наших крутых партнеров
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <?php $_from = $this->_tpl_vars['this']['amList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['amObj']):
?>
            <?php if ($this->_tpl_vars['amObj']->areaTypeId == 3): ?>
            <div class="col-md-3 p-1">
                <div class="blank-img gss-programms-img ic_container capslide_img_cont3" onclick="window.location.href = '<?php echo smarty_function_link(array('show' => 'catalog','area' => $this->_tpl_vars['amObj']->id), $this);?>
';">
                    <img src="/images/areas/resized/01<?php echo $this->_tpl_vars['amObj']->id; ?>
.jpg?v=<?php echo $this->_tpl_vars['amObj']->tsUpdated; ?>
" alt="<?php echo $this->_tpl_vars['amObj']->name; ?>
" class="img-fluid">
                    <div class="ic_caption">
                        <h3><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['amObj']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['amObj']->name; ?>
<?php endif; ?></h3>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
        </div>

        <div class="row">
            <div class="col-md-8">
                <h4 class="page-headline"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Communication<?php else: ?>Общение<?php endif; ?></h4>
            </div>
            <div class="col-md-4">
                <div class="g-emoji-content">
                    <div class="g-emoji-icon">
                        <img src="/images/emoji/3.png" class="img-fluid" alt="">
                    </div>
                    <div class="g-emoji-balun">
                        Ну а здесь всё про общение и&nbsp;тусовки
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <?php $_from = $this->_tpl_vars['this']['amList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['amObj']):
?>
            <?php if ($this->_tpl_vars['amObj']->areaTypeId == 2): ?>
            <div class="col-md-3 p-1">
                <div class="blank-img gss-programms-img ic_container capslide_img_cont3" onclick="window.location.href = '<?php echo smarty_function_link(array('show' => 'catalog','area' => $this->_tpl_vars['amObj']->id), $this);?>
';">
                    <img src="/images/areas/resized/01<?php echo $this->_tpl_vars['amObj']->id; ?>
.jpg?v=<?php echo $this->_tpl_vars['amObj']->tsUpdated; ?>
" alt="<?php echo $this->_tpl_vars['amObj']->name; ?>
" class="img-fluid">
                    <div class="ic_caption">
                        <h3><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['amObj']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['amObj']->name; ?>
<?php endif; ?></h3>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
        </div>
    </div>
</div>