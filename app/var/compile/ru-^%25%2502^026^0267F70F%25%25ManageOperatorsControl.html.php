<?php /* Smarty version 2.6.13, created on 2019-11-29 09:42:22
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManageOperatorsControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageOperatorsControl.html', 6, false),array('function', 'pager', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageOperatorsControl.html', 40, false),array('modifier', 'dateformat', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageOperatorsControl.html', 30, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManageOperatorsControl']); ?>

<h2>Работа с операторами</h2>

<div class="create">
    <a href="<?php echo smarty_function_alink(array('show' => 'editoperator'), $this);?>
" class="btn btn-primary">Создать нового оператора</a>
</div>

<?php if ($this->_tpl_vars['this']['operatorList']): ?>
    <br>
    <table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Логин</th>
            <th>Телефон</th>
            <th>Статус</th>
            <th>Был на сайте</th>
            <th>&nbsp;</th>
        </tr>
	<?php $_from = $this->_tpl_vars['this']['operatorList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['operator']):
?>
            <?php $this->assign('status', $this->_tpl_vars['operator']->status); ?>
            <?php $this->assign('userid', $this->_tpl_vars['operator']->id); ?>
            <tr>
                <td><a href="<?php echo smarty_function_alink(array('show' => 'editoperator','id' => $this->_tpl_vars['operator']->id), $this);?>
"><?php echo $this->_tpl_vars['operator']->id; ?>
</a></td>
                <td><a href="<?php echo smarty_function_alink(array('show' => 'editoperator','id' => $this->_tpl_vars['operator']->id), $this);?>
"><?php echo $this->_tpl_vars['operator']->login; ?>
</a></td>
		<td><?php echo $this->_tpl_vars['operator']->name; ?>
</td>
                <td><?php echo $this->_tpl_vars['operator']->phone; ?>
</td>
                <td><?php echo $this->_tpl_vars['this']['operatorStatuses'][$this->_tpl_vars['status']]; ?>
</td>
                <td><?php if ($this->_tpl_vars['operator']->dateLastVisit): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['operator']->dateLastVisit)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
<?php else: ?>-<?php endif; ?></td>
                <td class="text-center">
                    <a href="<?php echo smarty_function_alink(array('do' => 'deloperator','id' => $this->_tpl_vars['operator']->id), $this);?>
" title="Удалить" onclick="return confirm('Вы уверены?');">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </a>
                </td>
            </tr>
	<?php endforeach; endif; unset($_from); ?>
    </table>
    <?php if ($this->_tpl_vars['this']['total']): ?>
        <?php echo smarty_function_pager(array('total' => $this->_tpl_vars['this']['total'],'per' => $this->_tpl_vars['this']['perPage']), $this);?>

    <?php endif; ?>
<?php endif; ?>