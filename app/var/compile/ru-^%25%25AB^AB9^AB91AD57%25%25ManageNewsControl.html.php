<?php /* Smarty version 2.6.13, created on 2019-12-02 11:15:47
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManageNewsControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageNewsControl.html', 6, false),array('function', 'cycle', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageNewsControl.html', 20, false),array('function', 'pager', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageNewsControl.html', 37, false),array('modifier', 'forcewrap', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageNewsControl.html', 23, false),array('modifier', 'nl2br', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageNewsControl.html', 23, false),array('modifier', 'dateformat', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageNewsControl.html', 24, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManageNewsControl']); ?>

<h2>Управление новостями</h2>

<div class="create">
    <input class="btn btn-primary" type="button" onclick="window.location='<?php echo smarty_function_alink(array('show' => 'editnews'), $this);?>
'" value="Создать новость" />
</div>
<br/>

<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
    <tr>
        <th>ID</th>
        <th>Заголовок</th>
        <th>Текст</th>
        <th>Дата создания</th>
        <th>Действие</th>
    </tr>
    <?php if ($this->_tpl_vars['this']['news']): ?>
	<?php $_from = $this->_tpl_vars['this']['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['new']):
?>
            <tr class="<?php echo smarty_function_cycle(array('values' => 'color,'), $this);?>
">
                <td><?php echo $this->_tpl_vars['new']->id; ?>
</td>
                <td><?php echo $this->_tpl_vars['new']->subject; ?>
</td>
                <td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['new']->body)) ? $this->_run_mod_handler('forcewrap', true, $_tmp, 0, 300, false) : smarty_modifier_forcewrap($_tmp, 0, 300, false)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['new']->showDate)) ? $this->_run_mod_handler('dateformat', true, $_tmp) : smarty_modifier_dateformat($_tmp)); ?>
</td>
                <td class="text-center">
                    <a href="<?php echo smarty_function_alink(array('show' => 'editnews','newsid' => $this->_tpl_vars['new']->id), $this);?>
" class="glyphicon glyphicon-edit" title="Редактировать" aria-hidden="true"></a>&nbsp;|&nbsp;<a onclick="return confirm('Удалить?');" href="<?php echo smarty_function_alink(array('do' => 'deletenews','newsid' => $this->_tpl_vars['new']->id), $this);?>
" class="glyphicon glyphicon-trash" title="Удалить" aria-hidden="true"></a>
                </td>
            </tr>
	<?php endforeach; endif; unset($_from); ?>
    <?php else: ?>
        <tr class="<?php echo smarty_function_cycle(array('values' => 'color,'), $this);?>
">
            <td colspan="6" class="text-center">Список пуст</td>
        </tr>
    <?php endif; ?>
</table>
<?php if ($this->_tpl_vars['this']['news']): ?>
<?php echo smarty_function_pager(array('total' => $this->_tpl_vars['this']['total'],'per' => $this->_tpl_vars['this']['perPage']), $this);?>

<?php endif; ?>