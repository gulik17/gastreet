<?php /* Smarty version 2.6.13, created on 2020-01-09 15:47:06
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManageAreaTypeControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageAreaTypeControl.html', 6, false),array('function', 'cycle', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageAreaTypeControl.html', 18, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManageAreaTypeControl']); ?>

<h2>Типы программ</h2>

<div class="create">
	<input class="btn btn-primary" type="button" onclick="window.location='<?php echo smarty_function_alink(array('show' => 'editareatype'), $this);?>
'" value="Создать тип программы" />
</div>

<?php if ($this->_tpl_vars['this']['areaTypeList']): ?>
<br/>
<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
	<tr>
		<th>ID</th>
		<th>Название</th>
		<th>Действия</th>
	</tr>
	<?php $_from = $this->_tpl_vars['this']['areaTypeList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['areaType']):
?>
		<tr class="<?php echo smarty_function_cycle(array('values' => 'color,'), $this);?>
">
			<td><?php echo $this->_tpl_vars['areaType']->id; ?>
</td>
			<td><?php echo $this->_tpl_vars['areaType']->name; ?>
</td>
			<td>
				<a href="<?php echo smarty_function_alink(array('show' => 'editareatype','id' => $this->_tpl_vars['areaType']->id), $this);?>
">Редактировать</a> | <a href="<?php echo smarty_function_alink(array('do' => 'delareatype','id' => $this->_tpl_vars['areaType']->id), $this);?>
" onclick="return confirm('Вы уверены что хотите удалить?');">Удалить</a>
			</td>
		</tr>
	<?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?>