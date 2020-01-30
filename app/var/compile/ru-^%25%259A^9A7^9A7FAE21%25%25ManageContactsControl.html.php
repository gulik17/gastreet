<?php /* Smarty version 2.6.13, created on 2019-12-03 12:10:10
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManageContactsControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageContactsControl.html', 6, false),array('function', 'cycle', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageContactsControl.html', 23, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManageContactsControl']); ?>

<h2>Контакты</h2>

<div class="create">
	<input class="btn btn-primary" type="button" onclick="window.location='<?php echo smarty_function_alink(array('show' => 'editcontact'), $this);?>
'" value="Создать контакт" />
</div>

<?php if ($this->_tpl_vars['this']['contactsList']): ?>
<br/>
<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
	<tr>
		<th>ID</th>
		<th>Заголовок</th>
		<th>Имя</th>
		<th>E-Mail</th>
		<th>Телефон</th>
		<th>Телефон доп</th>
		<th>Facebook</th>
		<th>Действия</th>
	</tr>
	<?php $_from = $this->_tpl_vars['this']['contactsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['contact']):
?>
	<tr class="<?php echo smarty_function_cycle(array('values' => 'color,'), $this);?>
">
		<td><?php echo $this->_tpl_vars['contact']->id; ?>
</td>
		<td><?php echo $this->_tpl_vars['contact']->title; ?>
</td>
		<td><?php echo $this->_tpl_vars['contact']->name; ?>
</td>
		<td><?php echo $this->_tpl_vars['contact']->email; ?>
</td>
		<td><?php echo $this->_tpl_vars['contact']->phone; ?>
</td>
		<td><?php echo $this->_tpl_vars['contact']->phone2; ?>
</td>
		<td><?php echo $this->_tpl_vars['contact']->facebookurl; ?>
</td>
		<td>
			<a href="<?php echo smarty_function_alink(array('show' => 'editcontact','id' => $this->_tpl_vars['contact']->id), $this);?>
">Редактировать</a> | <a href="<?php echo smarty_function_alink(array('do' => 'delcontact','id' => $this->_tpl_vars['contact']->id), $this);?>
" onclick="return confirm('Вы уверены что хотите удалить?');">Удалить</a>
		</td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?>