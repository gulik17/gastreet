<?php /* Smarty version 2.6.13, created on 2019-11-28 14:59:41
         compiled from /home/c484884/gastreet.com/www/app/Templates/AdminkamenuControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/AdminkamenuControl.html', 4, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['AdminkamenuControl']); ?>
<?php if ($this->_tpl_vars['this']['permissions']): ?>
<ul>
    <li><a href="<?php echo smarty_function_alink(array('show' => 'mainpage'), $this);?>
"><i class="fa fa-fw fa-home"></i> Статистика</a></li>
    <?php $_from = $this->_tpl_vars['this']['permissions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['perm']):
?>
        <?php if ($this->_tpl_vars['perm']['perm'] == 'Y'): ?>
            <li><a href="<?php echo smarty_function_alink(array('show' => $this->_tpl_vars['perm']['name']), $this);?>
"><i class="fa fa-fw <?php echo $this->_tpl_vars['perm']['icon']; ?>
"></i> <?php echo $this->_tpl_vars['perm']['desc']; ?>
</a></li>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
</ul>
<?php endif; ?>