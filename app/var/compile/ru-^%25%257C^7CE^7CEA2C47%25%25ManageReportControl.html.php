<?php /* Smarty version 2.6.13, created on 2019-11-28 17:42:52
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManageReportControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageReportControl.html', 2, false),array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageReportControl.html', 4, false),array('function', 'cycle', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageReportControl.html', 43, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageReportControl.html', 52, false),array('modifier', 'dateformat', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageReportControl.html', 45, false),array('modifier', 'round0', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageReportControl.html', 49, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManageReportControl']); ?>
<?php echo smarty_function_formrestore(array('id' => "report-filter"), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/jquery.placeholder.min.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/pages/managereport.js','type' => 'js'), $this);?>


<h2>Отчёт о покупателях</h2>
<form id="buyers-filter" method="post" action="" style="max-width: 400px;">
    <div class="well">
        <input type="hidden" name="show" value="managereport"/>
        <input type="hidden" name="isalive" value="1"/>
        <div class="filter-buyers form-group form-inline">
            <label style="display: block;">Дата с:</label>
            <input class="form-control" type="text" name="startDay" placeholder="дд" value="<?php if ($this->_tpl_vars['this']['startDay'] != null): ?><?php echo $this->_tpl_vars['this']['startDay']; ?>
<?php endif; ?>" style="width: 44px;" /> - 
            <input class="form-control" type="text" name="startMonth" placeholder="мм" value="<?php if ($this->_tpl_vars['this']['startMonth'] != null): ?><?php echo $this->_tpl_vars['this']['startMonth']; ?>
<?php endif; ?>" style="width: 44px;" /> - 
            <input class="form-control" type="text" name="startYear" placeholder="гггг" value="<?php if ($this->_tpl_vars['this']['startYear'] != null): ?><?php echo $this->_tpl_vars['this']['startYear']; ?>
<?php endif; ?>" style="width: 60px;" />
        </div>
        <div class="form-group form-inline">
            <label style="display: block;">Дата по:</label>
            <input class="form-control" type="text" name="finishDay" placeholder="дд" value="<?php if ($this->_tpl_vars['this']['finishDay'] != null): ?><?php echo $this->_tpl_vars['this']['finishDay']; ?>
<?php endif; ?>" style="width:44px;" /> - 
            <input class="form-control" type="text" name="finishMonth" placeholder="мм" value="<?php if ($this->_tpl_vars['this']['finishMonth'] != null): ?><?php echo $this->_tpl_vars['this']['finishMonth']; ?>
<?php endif; ?>" style="width:44px;" /> - 
            <input class="form-control" type="text" name="finishYear" placeholder="гггг" value="<?php if ($this->_tpl_vars['this']['finishYear'] != null): ?><?php echo $this->_tpl_vars['this']['finishYear']; ?>
<?php endif; ?>" style="width: 60px;" />
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" id="submit" value="Сформировать"/>
        </div>
    </div>
</form>

<?php if ($this->_tpl_vars['this']['reports']): ?>
    <a href="#" class="btn btn-primary" style="margin-bottom:15px;" onclick="window.location.href = '/adminka/index.php?show=managereport'; return false;">Обновить</a>
    <table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
        <tr>
            <th>ID</th>
            <th>С</th>
            <th>По</th>
            <th>Генерация начата</th>
            <th>Генерация завершена</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
    <?php $_from = $this->_tpl_vars['this']['reports']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['report']):
?>
        <tr class="<?php echo smarty_function_cycle(array('values' => 'color,'), $this);?>
">
            <td><?php echo $this->_tpl_vars['report']->id; ?>
</td>
            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['report']->tsStart)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y') : smarty_modifier_dateformat($_tmp, 'd.m.Y')); ?>
</td>
            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['report']->tsFinish)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y') : smarty_modifier_dateformat($_tmp, 'd.m.Y')); ?>
</td>
            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['report']->tsGenerateStart)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
</td>
            <td><?php if ($this->_tpl_vars['report']->tsGenerateFinish): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['report']->tsGenerateFinish)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
<?php else: ?>-<?php endif; ?></td>
            <td><?php if ($this->_tpl_vars['report']->status == 'STATUS_GENERATED'): ?>Сформирован<?php else: ?><div id="bgrp-<?php echo $this->_tpl_vars['report']->id; ?>
" class="gss-big-report">Формируется ... <?php if ($this->_tpl_vars['report']->totalUsersCount): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['report']->currentUsersProcessed/$this->_tpl_vars['report']->totalUsersCount*100)) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
%<?php endif; ?></div><?php endif; ?></td>
            <td>
                <?php if ($this->_tpl_vars['report']->status == 'STATUS_GENERATED'): ?>
                <a href="<?php echo smarty_function_alink(array('do' => 'adminsavereportxls','id' => $this->_tpl_vars['report']->id), $this);?>
">Excel</a> | <a href="<?php echo smarty_function_alink(array('do' => 'adminsavereportcsv','id' => $this->_tpl_vars['report']->id), $this);?>
">CSV</a> | 
                <?php endif; ?>
                <a href="<?php echo smarty_function_alink(array('do' => 'admindelreport','id' => $this->_tpl_vars['report']->id), $this);?>
" onclick="return confirm('Вы уверены что хотите удалить отчёт?');">Удалить</a>
            </td>
        </tr>
    <?php endforeach; endif; unset($_from); ?>
    </table>
<?php endif; ?>