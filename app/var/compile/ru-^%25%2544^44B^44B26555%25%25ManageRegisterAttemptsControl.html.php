<?php /* Smarty version 2.6.13, created on 2020-01-14 23:48:36
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManageRegisterAttemptsControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageRegisterAttemptsControl.html', 2, false),array('function', 'cycle', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageRegisterAttemptsControl.html', 42, false),array('function', 'pager', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageRegisterAttemptsControl.html', 58, false),array('modifier', 'dateformat', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageRegisterAttemptsControl.html', 43, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManageRegisterAttemptsControl']); ?>
<?php echo smarty_function_formrestore(array('id' => "attempts-filter"), $this);?>


<h2>Попытки регистрации</h2>

<a role="button" data-toggle="collapse" href="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter"><h4>Фильтр для поиска <span class="caret"></span></h4></a>
<div class="collapse" id="collapseFilter">
    <form id="attempts-filter" method="post" action="" style="max-width: 400px;">
        <div class="well">
            <input type="hidden" name="show" value="manageregisterattempts"/>
            <input type="hidden" name="isalive" value="1"/>
            <div class="filter-users">
                <div class="form-group">
                    <label>Номер мобильного:</label>
                    <input class="form-control" type="text" name="phone" id="phone" />
                </div>
                <div class="form-group">
                    <label>IP:</label>
                    <input class="form-control" type="text" name="ip" id="ip" />
                </div>
                <div class="form-group">
                    <input class="btn btn-info" type="submit" id="submit" value="Показать список отбора"/>
                </div>
            </div>
        </div>
    </form>
</div>

<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
    <tr>
        <th>Дата, время</th>
        <th>Номер мобильного</th>
        <th>ФИО</th>
        <th>IP</th>
        <th>Код</th>
        <th>Информация</th>
    </tr>
    <?php if ($this->_tpl_vars['this']['attemptList']): ?>
	<?php $_from = $this->_tpl_vars['this']['attemptList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attempt']):
?>
            <?php $this->assign('attmptPhone', $this->_tpl_vars['attempt']->phone); ?>
            <?php $this->assign('gotUser', $this->_tpl_vars['this']['usersByPhones'][$this->_tpl_vars['attmptPhone']]); ?>
            <tr class="<?php echo smarty_function_cycle(array('values' => 'color,'), $this);?>
">
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['attempt']->ts)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
</td>
                <td><?php echo $this->_tpl_vars['attempt']->phone; ?>
</td>
                <td><?php if ($this->_tpl_vars['gotUser']): ?><?php echo $this->_tpl_vars['gotUser']->lastname; ?>
 <?php echo $this->_tpl_vars['gotUser']->name; ?>
<?php endif; ?></td>
                <td><?php echo $this->_tpl_vars['attempt']->ip; ?>
</td>
                <td><?php echo $this->_tpl_vars['attempt']->code; ?>
</td>
                <td><?php echo $this->_tpl_vars['attempt']->client; ?>
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
<?php if ($this->_tpl_vars['this']['attemptList']): ?>
<?php echo smarty_function_pager(array('total' => $this->_tpl_vars['this']['total'],'per' => $this->_tpl_vars['this']['perPage']), $this);?>

<?php endif; ?>