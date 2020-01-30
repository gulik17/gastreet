<?php /* Smarty version 2.6.13, created on 2019-12-02 11:13:31
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManageContentControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageContentControl.html', 6, false),array('function', 'cycle', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageContentControl.html', 19, false),array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageContentControl.html', 21, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManageContentControl']); ?>

<h2>Управление контентом</h2>

<div class="man-con-create">
	<input class="btn btn-primary" type="button" onclick="window.location='<?php echo smarty_function_alink(array('show' => 'editcontent'), $this);?>
'" value="Создать страницу" />
</div><br/>

<?php if ($this->_tpl_vars['this']['list']): ?>
<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">

	<tr>
		<th>Заголовок</th>
		<th>Положение в меню</th>
		<th>Действие</th>
	</tr>

	<?php $_from = $this->_tpl_vars['this']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['pages'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['pages']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['pages']['iteration']++;
?>
	<tr class="<?php echo smarty_function_cycle(array('values' => 'color,'), $this);?>
">
		<td>
			<a target="_blank" href="<?php echo smarty_function_link(array('show' => 'page','name' => $this->_tpl_vars['item']->alias), $this);?>
"><?php echo $this->_tpl_vars['item']->title; ?>
</a>
		</td>
		<td>
			<?php $this->assign('menutype', $this->_tpl_vars['item']->menu); ?>
			<?php echo $this->_tpl_vars['this']['menuTypeList'][$this->_tpl_vars['menutype']]; ?>

		</td>
		<td class="edit">
			<a href="<?php echo smarty_function_alink(array('show' => 'editcontent','id' => $this->_tpl_vars['item']->id), $this);?>
">Редактировать</a> |
			<a onclick="return confirm('Удалить?');" href="<?php echo smarty_function_alink(array('do' => 'deletecontent','id' => $this->_tpl_vars['item']->id), $this);?>
">Удалить</a>
		</td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>

</table>
<?php endif; ?>