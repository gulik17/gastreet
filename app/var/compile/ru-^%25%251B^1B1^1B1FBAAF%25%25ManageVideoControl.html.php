<?php /* Smarty version 2.6.13, created on 2019-11-28 17:01:12
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManageVideoControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageVideoControl.html', 6, false),array('function', 'cycle', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageVideoControl.html', 22, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManageVideoControl']); ?>

<h2>Управление видеороликами</h2>

<div class="create">
    <input class="btn btn-primary" type="button" onclick="window.location='<?php echo smarty_function_alink(array('show' => 'editvideo'), $this);?>
'" value="Добавить видеоролик" />
</div>

<?php if ($this->_tpl_vars['this']['videoList']): ?>
<br/>
<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Название (англ)</th>
        <th>URL</th>
        <th>Статус</th>
        <th>Действия</th>
    </tr>
    <?php $_from = $this->_tpl_vars['this']['videoList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['video']):
?>
	<?php $this->assign('status', $this->_tpl_vars['video']->status); ?>
	<tr class="<?php echo smarty_function_cycle(array('values' => 'color,'), $this);?>
">
            <td><?php echo $this->_tpl_vars['video']->id; ?>
</td>
            <td><a href="<?php echo smarty_function_alink(array('show' => 'editvideo','id' => $this->_tpl_vars['video']->id), $this);?>
"><?php echo $this->_tpl_vars['video']->name; ?>
</a></td>
            <td><a href="<?php echo smarty_function_alink(array('show' => 'editvideo','id' => $this->_tpl_vars['video']->id), $this);?>
"><?php echo $this->_tpl_vars['video']->name_en; ?>
</a></td>
            <td><a href="https://www.youtube.com/watch?v=<?php echo $this->_tpl_vars['video']->url; ?>
" title="Просмотреть видео на YouTube" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i> <?php echo $this->_tpl_vars['video']->url; ?>
</a></td>
            <td><?php echo $this->_tpl_vars['this']['statusDesc'][$this->_tpl_vars['status']]; ?>
</td>
            <td><a href="<?php echo smarty_function_alink(array('do' => 'delvideo','id' => $this->_tpl_vars['video']->id), $this);?>
" onclick="return confirm('Вы уверены что хотите удалить?');">Удалить</a></td>
	</tr>
    <?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?>