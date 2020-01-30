<?php /* Smarty version 2.6.13, created on 2019-11-29 10:03:28
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManageAreasControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageAreasControl.html', 6, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManageAreasControl']); ?>

<h2>Программы</h2>

<div class="create">
    <a class="btn btn-primary" href="<?php echo smarty_function_alink(array('show' => 'editarea'), $this);?>
">Создать программу</a>
</div>

<?php if ($this->_tpl_vars['this']['areasList']): ?>
<br/>
<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th></th>
        <th>Тип программы</th>
        <th>Статус</th>
        <th>Действия</th>
    </tr>
    <?php $_from = $this->_tpl_vars['this']['areasList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['area']):
?>
    <?php $this->assign('status', $this->_tpl_vars['area']->status); ?>
    <tr>
        <td><?php echo $this->_tpl_vars['area']->id; ?>
</td>
        <td><?php echo $this->_tpl_vars['area']->name; ?>
</td>
        <td style="width:40px"><i class="section_color_bar" style="background: <?php echo $this->_tpl_vars['area']->color; ?>
;"></i></td>
        <td>
            <?php $this->assign('areaTypeId', $this->_tpl_vars['area']->areaTypeId); ?>
            <?php if ($this->_tpl_vars['areaTypeId']): ?>
            <?php echo $this->_tpl_vars['this']['areaTypes'][$this->_tpl_vars['areaTypeId']]; ?>

            <?php endif; ?>
        </td>
        <td><?php echo $this->_tpl_vars['this']['statusDesc'][$this->_tpl_vars['status']]; ?>
</td>
        <td>
            <a href="<?php echo smarty_function_alink(array('show' => 'editarea','id' => $this->_tpl_vars['area']->id), $this);?>
">Редактировать</a>
        </td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?>