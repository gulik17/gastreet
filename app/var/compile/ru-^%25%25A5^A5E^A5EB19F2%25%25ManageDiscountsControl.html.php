<?php /* Smarty version 2.6.13, created on 2019-12-05 11:54:59
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManageDiscountsControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageDiscountsControl.html', 6, false),array('function', 'cycle', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageDiscountsControl.html', 26, false),array('function', 'pager', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageDiscountsControl.html', 43, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManageDiscountsControl']); ?>

<h2>Управление скидками</h2>

<div class="create">
    <input class="btn btn-primary" type="button" onclick="window.location='<?php echo smarty_function_alink(array('show' => 'editdiscount'), $this);?>
'" value="Создать скидку" />
</div>
<br/>


<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
    <tr>
        <th>ID</th>
        <th>Код</th>
        <th>Процент</th>
        <!-- <th>Пользователь</th> -->
        <th>Тип</th>
        <th>Статус</th>
        <th>Действие</th>
    </tr>
    <?php if ($this->_tpl_vars['this']['discounts']): ?>
        <?php $_from = $this->_tpl_vars['this']['discounts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['discount']):
?>
            <?php $this->assign('userid', $this->_tpl_vars['discount']->userId); ?>
            <?php $this->assign('status', $this->_tpl_vars['discount']->status); ?>
            <?php $this->assign('type', $this->_tpl_vars['discount']->type); ?>
            <tr class="<?php echo smarty_function_cycle(array('values' => 'color,'), $this);?>
">
                <td><?php echo $this->_tpl_vars['discount']->id; ?>
</td>
                <td><a href="<?php echo smarty_function_alink(array('show' => 'admincodeused','id' => $this->_tpl_vars['discount']->id), $this);?>
"><?php echo $this->_tpl_vars['discount']->code; ?>
</a></td>
                <td><?php echo $this->_tpl_vars['discount']->percent; ?>
</td>
                <!-- <td><?php if ($this->_tpl_vars['userid']): ?><?php echo $this->_tpl_vars['this']['users'][$this->_tpl_vars['userid']]->phone; ?>
<?php if ($this->_tpl_vars['this']['users'][$this->_tpl_vars['userid']]->lastname): ?>, <?php echo $this->_tpl_vars['this']['users'][$this->_tpl_vars['userid']]->lastname; ?>
 <?php echo $this->_tpl_vars['this']['users'][$this->_tpl_vars['userid']]->name; ?>
<?php endif; ?><?php else: ?>-<?php endif; ?></td> -->
                <td><?php echo $this->_tpl_vars['this']['types'][$this->_tpl_vars['type']]; ?>
</td>
                <td><?php echo $this->_tpl_vars['this']['statuses'][$this->_tpl_vars['status']]; ?>
</td>
                <td><a href="<?php echo smarty_function_alink(array('show' => 'editdiscount','id' => $this->_tpl_vars['discount']->id), $this);?>
">Редактировать</a></td>
            </tr>
        <?php endforeach; endif; unset($_from); ?>
    <?php else: ?>
    <tr class="<?php echo smarty_function_cycle(array('values' => 'color,'), $this);?>
">
        <td colspan="9" class="text-center">Список пуст</td>
    </tr>
    <?php endif; ?>
</table>
<?php if ($this->_tpl_vars['this']['total']): ?>
    <?php echo smarty_function_pager(array('total' => $this->_tpl_vars['this']['total'],'per' => $this->_tpl_vars['this']['perPage']), $this);?>

<?php endif; ?>