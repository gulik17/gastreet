<?php /* Smarty version 2.6.13, created on 2019-11-29 17:19:47
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManagePrizesControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManagePrizesControl.html', 6, false),array('function', 'cycle', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManagePrizesControl.html', 21, false),array('function', 'pager', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManagePrizesControl.html', 37, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManagePrizesControl']); ?>

<h2>Управление новостями и ништяками</h2>

<div class="create">
    <input class="btn btn-primary" type="button" onclick="window.location = '<?php echo smarty_function_alink(array('show' => 'editprizes'), $this);?>
'" value="Создать новость" />
</div>
<br/>

<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Аннотация</th>
        <th>Статус</th>
        <th>Действия</th>
    </tr>
    <?php if ($this->_tpl_vars['this']['prizes']): ?>
    <?php $_from = $this->_tpl_vars['this']['prizes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prize']):
?>
    <?php $this->assign('prizestatus', $this->_tpl_vars['prize']->status); ?>
    <tr class="<?php echo smarty_function_cycle(array('values' => 'color,'), $this);?>
">
        <td><?php echo $this->_tpl_vars['prize']->id; ?>
</td>
        <td><a href="<?php echo smarty_function_alink(array('show' => 'editprizes','id' => $this->_tpl_vars['prize']->id), $this);?>
" title="Редактировать"><?php echo $this->_tpl_vars['prize']->name; ?>
</a></td>
        <td><?php echo $this->_tpl_vars['prize']->annotation; ?>
</td>
        <td><?php echo $this->_tpl_vars['this']['prizeStatuses'][$this->_tpl_vars['prizestatus']]; ?>
</td>
        <td class="text-center">
            <a onclick="return confirm('Удалить?');" href="<?php echo smarty_function_alink(array('do' => 'deleteprize','id' => $this->_tpl_vars['prize']->id), $this);?>
" class="glyphicon glyphicon-trash" title="Удалить" aria-hidden="true"></a>
        </td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
    <?php else: ?>

    <?php endif; ?>
</table>

<?php if ($this->_tpl_vars['this']['prizes']): ?>
<?php echo smarty_function_pager(array('total' => $this->_tpl_vars['this']['total'],'per' => $this->_tpl_vars['this']['perPage']), $this);?>

<?php endif; ?>