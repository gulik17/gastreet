<?php /* Smarty version 2.6.13, created on 2020-01-09 13:08:56
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManageFaqControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageFaqControl.html', 6, false),array('function', 'cycle', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageFaqControl.html', 19, false),array('modifier', 'forcewrap', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageFaqControl.html', 22, false),array('modifier', 'nl2br', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageFaqControl.html', 22, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManageFaqControl']); ?>

<h2>ЧаВо</h2>

<div class="create">
	<input class="btn btn-primary" type="button" onclick="window.location='<?php echo smarty_function_alink(array('show' => 'editfaq'), $this);?>
'" value="Добавить вопрос" />
</div>

<?php if ($this->_tpl_vars['this']['faqList']): ?>
<br/>
<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
	<tr>
		<th>ID</th>
		<th>Вопрос</th>
		<th>Ответ</th>
		<th>Действия</th>
	</tr>
	<?php $_from = $this->_tpl_vars['this']['faqList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['faq']):
?>
	<tr class="<?php echo smarty_function_cycle(array('values' => 'color,'), $this);?>
">
		<td><?php echo $this->_tpl_vars['faq']->id; ?>
</td>
		<td width="15%"><?php echo $this->_tpl_vars['faq']->question; ?>
</td>
		<td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['faq']->answer)) ? $this->_run_mod_handler('forcewrap', true, $_tmp, 0, 300, false) : smarty_modifier_forcewrap($_tmp, 0, 300, false)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</td>
		<td width="15%">
			<a href="<?php echo smarty_function_alink(array('show' => 'editfaq','id' => $this->_tpl_vars['faq']->id), $this);?>
">Редактировать</a> | <a href="<?php echo smarty_function_alink(array('do' => 'delfaq','id' => $this->_tpl_vars['faq']->id), $this);?>
" onclick="return confirm('Вы уверены что хотите удалить?');">Удалить</a>
		</td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?>