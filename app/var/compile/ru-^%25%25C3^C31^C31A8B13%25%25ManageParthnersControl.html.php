<?php /* Smarty version 2.6.13, created on 2019-12-05 22:50:33
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManageParthnersControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageParthnersControl.html', 6, false),array('function', 'pager', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageParthnersControl.html', 36, false),array('modifier', 'lower', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageParthnersControl.html', 23, false),array('modifier', 'truncate', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageParthnersControl.html', 27, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManageParthnersControl']); ?>

<h2>Партнеры</h2>

<div class="create">
    <input class="btn btn-primary" type="button" onclick="window.location='<?php echo smarty_function_alink(array('show' => 'editparthner'), $this);?>
'" value="Создать партнера" />
</div>

<?php if ($this->_tpl_vars['this']['parthnerList']): ?>
    <br/>
    <table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Тип</th>
            <th>Ссылка</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        <?php $_from = $this->_tpl_vars['this']['parthnerList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['parthner']):
?>
            <?php $this->assign('status', $this->_tpl_vars['parthner']->status); ?>
            <?php $this->assign('typeid', $this->_tpl_vars['parthner']->parthnerTypeId); ?>
            <tr class="<?php echo ((is_array($_tmp=$this->_tpl_vars['status'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
">
                <td><?php echo $this->_tpl_vars['parthner']->id; ?>
</td>
                <td><?php echo $this->_tpl_vars['parthner']->name; ?>
</td>
                <td><?php echo $this->_tpl_vars['this']['parthnerTypes'][$this->_tpl_vars['typeid']]; ?>
</td>
                <td><span title="<?php echo $this->_tpl_vars['parthner']->url; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['parthner']->url)) ? $this->_run_mod_handler('truncate', true, $_tmp, 40, "...", true) : smarty_modifier_truncate($_tmp, 40, "...", true)); ?>
</span></td>
                <td><?php echo $this->_tpl_vars['this']['statusDesc'][$this->_tpl_vars['status']]; ?>
</td>
                <td>
                    <a href="<?php echo smarty_function_alink(array('show' => 'editparthner','id' => $this->_tpl_vars['parthner']->id), $this);?>
">Редактировать</a>
                </td>
            </tr>
        <?php endforeach; endif; unset($_from); ?>
    </table>
    <?php if ($this->_tpl_vars['this']['total']): ?>
        <?php echo smarty_function_pager(array('total' => $this->_tpl_vars['this']['total'],'per' => $this->_tpl_vars['this']['perPage']), $this);?>

    <?php endif; ?>
<?php endif; ?>