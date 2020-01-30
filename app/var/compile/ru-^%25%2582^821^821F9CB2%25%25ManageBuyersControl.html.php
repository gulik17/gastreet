<?php /* Smarty version 2.6.13, created on 2019-11-29 08:50:07
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManageBuyersControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageBuyersControl.html', 2, false),array('function', 'cycle', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageBuyersControl.html', 57, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageBuyersControl.html', 65, false),array('function', 'pager', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageBuyersControl.html', 76, false),array('modifier', 'dateformat', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageBuyersControl.html', 63, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManageBuyersControl']); ?>
<?php echo smarty_function_formrestore(array('id' => "buyers-filter"), $this);?>


<h2>Покупатели и покупки</h2>

<a role="button" data-toggle="collapse" href="#collapseFilter" aria-expanded="true" aria-controls="collapseFilter"><h4>Фильтр для поиска <span class="caret"></span></h4></a>
<div class="collapse in" id="collapseFilter">
    <div class="well" style="max-width: 400px;">
        <form id="buyers-filter" method="post" action="">
            <input type="hidden" name="show" value="managebuyers"/>
            <input type="hidden" name="isalive" value="1"/>
            <div class="filter-buyers">
                <div class="form-group">
                    <label>ID:</label>
                    <input class="form-control" type="text" name="userid" id="userid" />
                </div>
                <div class="form-group">
                    <label>Фамилия:</label>
                    <input class="form-control" type="text" name="lastname" id="lastname" />
                </div>
                <div class="form-group">
                    <label>Имя:</label>
                    <input class="form-control" type="text" name="name" id="name" />
                </div>
                <div class="form-group">
                    <label>Номер мобильного:</label>
                    <input class="form-control" type="text" name="phone" id="phone" />
                </div>
                <div class="form-group">
                    <label>E-Mail:</label>
                    <input class="form-control" type="text" name="email" id="email" />
                </div>
                <div class="form-group">
                    <input class="btn btn-info" type="submit" id="submit" value="Показать список отбора"/>
                </div>
            </div>
        </form>
    </div>
</div>

<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
    <tr>
        <th>ID</th>
        <th>Номер мобильного</th>
        <th>ФИО</th>
        <th>E-Mail</th>
        <th>Статус</th>
        <th>Был на сайте</th>
        <th>Сумма покупок</th>
        <th>Действия</th>
    </tr>
    <?php if ($this->_tpl_vars['this']['userList']): ?>
        <?php $_from = $this->_tpl_vars['this']['userList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
            <?php $this->assign('status', $this->_tpl_vars['user']->status); ?>
            <?php $this->assign('userid', $this->_tpl_vars['user']->id); ?>
            <?php $this->assign('parentid', $this->_tpl_vars['user']->parentUserId); ?>
            <tr class="<?php echo smarty_function_cycle(array('values' => 'color,'), $this);?>
">
                <td><?php echo $this->_tpl_vars['user']->id; ?>
</td>
                <td><?php echo $this->_tpl_vars['user']->phone; ?>
</td>
                <td><?php echo $this->_tpl_vars['user']->lastname; ?>
 <?php echo $this->_tpl_vars['user']->name; ?>
</td>
                <td><?php if ($this->_tpl_vars['user']->confirmedEmail): ?><?php echo $this->_tpl_vars['user']->confirmedEmail; ?>
<?php else: ?><?php echo $this->_tpl_vars['user']->email; ?>
<?php endif; ?></td>
                <td><?php if ($this->_tpl_vars['parentid']): ?><i>добавлен от</i> <?php echo $this->_tpl_vars['this']['parentList'][$this->_tpl_vars['parentid']]; ?>
<?php else: ?><?php echo $this->_tpl_vars['this']['userStatuses'][$this->_tpl_vars['status']]; ?>
<?php endif; ?></td>
                <td><?php if ($this->_tpl_vars['user']->tsOnline): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['user']->tsOnline)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
<?php else: ?>-<?php endif; ?></td>
                <td align="right"><?php echo $this->_tpl_vars['this']['userAmountArray'][$this->_tpl_vars['userid']]; ?>
</td>
                <td><a href="<?php echo smarty_function_alink(array('show' => 'buyer','id' => $this->_tpl_vars['user']->id), $this);?>
">Покупки</a></td>
            </tr>
        <?php endforeach; endif; unset($_from); ?>
    <?php else: ?>
        <tr class="<?php echo smarty_function_cycle(array('values' => 'color,'), $this);?>
">
            <td colspan="8" class="text-center">Список пуст</td>
        </tr>
    <?php endif; ?>
</table>

<?php if ($this->_tpl_vars['this']['total']): ?>
    <?php echo smarty_function_pager(array('total' => $this->_tpl_vars['this']['total'],'per' => $this->_tpl_vars['this']['perPage']), $this);?>

<?php endif; ?>