<?php /* Smarty version 2.6.13, created on 2019-11-28 16:01:50
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManagePlacesControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManagePlacesControl.html', 6, false),array('function', 'cycle', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManagePlacesControl.html', 21, false),array('modifier', 'dbtexttohtml', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManagePlacesControl.html', 23, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManagePlacesControl']); ?>

<h2>Локации / отели</h2>

<div class="create">
    <a class="btn btn-primary" href="<?php echo smarty_function_alink(array('show' => 'editplace'), $this);?>
">Добавить локацию</a>
</div>

<?php if ($this->_tpl_vars['this']['placesList']): ?>
<br/>
<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Уровень</th>
        <th>ID видео</th>
        <th>Статус</th>
    </tr>
    <?php $_from = $this->_tpl_vars['this']['placesList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['place']):
?>
    <?php $this->assign('status', $this->_tpl_vars['place']->status); ?>
    <tr class="<?php echo smarty_function_cycle(array('values' => 'color,'), $this);?>
">
        <td><?php echo $this->_tpl_vars['place']->id; ?>
</td>
        <td><a href="<?php echo smarty_function_alink(array('show' => 'editplace','id' => $this->_tpl_vars['place']->id), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['place']->name)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
</a></td>
        <td><?php echo $this->_tpl_vars['place']->level; ?>
</td>
        <td><?php if ($this->_tpl_vars['place']->videoUrl): ?><a href="https://www.youtube.com/watch?v=<?php echo $this->_tpl_vars['place']->videoUrl; ?>
" title="Просмотреть видео на YouTube" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i> <?php echo $this->_tpl_vars['place']->videoUrl; ?>
</a><?php endif; ?></td>
        <td><?php echo $this->_tpl_vars['this']['statusDesc'][$this->_tpl_vars['status']]; ?>
</td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?>