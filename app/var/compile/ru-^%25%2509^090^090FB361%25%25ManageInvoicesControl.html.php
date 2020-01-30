<?php /* Smarty version 2.6.13, created on 2020-01-09 17:46:20
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManageInvoicesControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageInvoicesControl.html', 2, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageInvoicesControl.html', 26, false),array('function', 'cycle', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageInvoicesControl.html', 48, false),array('function', 'pager', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageInvoicesControl.html', 71, false),array('modifier', 'dateformat', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageInvoicesControl.html', 55, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManageInvoicesControl']); ?>
<?php echo smarty_function_formrestore(array('id' => "invoices-filter"), $this);?>


<h2>Счета на оплату</h2>

<a role="button" data-toggle="collapse" href="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter"><h4>Фильтр для поиска <span class="caret"></span></h4></a>
<div id="form-filter-add-buttons">
    <div class="collapse" id="collapseFilter">
        <div class="well" style="max-width: 400px;">
            <form id="invoices-filter" method="post" action="">
                <input type="hidden" name="show" value="manageinvoices"/>
                <input type="hidden" name="isalive" value="1"/>
                <div class="filter">
                    <div class="form-group">
                        <label>ID (номер) счёта:</label>
                        <input class="form-control" type="text" name="id" id="id" />
                    </div>
                    <div class="form-group">
                        <input class="btn btn-info" type="submit" id="submit" value="Показать список отбора"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div>
        <a class="btn btn-success" href="<?php echo smarty_function_alink(array('do' => 'adminsaveinvoices'), $this);?>
">Выгрузить все счета</a>
    </div>
</div>

<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
    <tr>
        <th>ID (номер счёта)</th>
        <th>Контрагент</th>
        <th>Пользователь</th>
        <th>Сумма к оплате</th>
        <th>Оплачено</th>
        <th>Статус</th>
        <th>Дата создания</th>
        <th>Дата оплаты</th>
        <th>Действия</th>
    </tr>
    <?php if ($this->_tpl_vars['this']['payList']): ?>
        <?php $_from = $this->_tpl_vars['this']['payList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pay']):
?>
            <?php $this->assign('status', $this->_tpl_vars['pay']->status); ?>
            <?php $this->assign('userId', $this->_tpl_vars['pay']->userId); ?>
            <?php $this->assign('oneuserdetails', $this->_tpl_vars['this']['userDetails'][$this->_tpl_vars['userId']]); ?>
            <?php $this->assign('oneuser', $this->_tpl_vars['this']['users'][$this->_tpl_vars['userId']]); ?>
            <tr class="<?php echo smarty_function_cycle(array('values' => 'color,'), $this);?>
">
                <td><?php echo $this->_tpl_vars['pay']->id; ?>
</td>
                <td><a href="<?php echo smarty_function_alink(array('show' => 'admininvoicedetails','payid' => $this->_tpl_vars['pay']->id), $this);?>
"><?php echo $this->_tpl_vars['oneuserdetails']->company; ?>
 (<?php echo $this->_tpl_vars['oneuserdetails']->inn; ?>
/<?php echo $this->_tpl_vars['oneuserdetails']->kpp; ?>
)</a></td>
                <td>ID: <?php echo $this->_tpl_vars['oneuser']->id; ?>
, +<?php echo $this->_tpl_vars['oneuser']->phone; ?>
<?php if ($this->_tpl_vars['oneuser']->lastname): ?>, <?php echo $this->_tpl_vars['oneuser']->lastname; ?>
 <?php echo $this->_tpl_vars['oneuser']->name; ?>
<?php endif; ?><?php if ($this->_tpl_vars['oneuser']->confirmedEmail): ?>, <?php echo $this->_tpl_vars['oneuser']->confirmedEmail; ?>
<?php else: ?><?php if ($this->_tpl_vars['oneuser']->email): ?>, <?php endif; ?><?php echo $this->_tpl_vars['oneuser']->email; ?>
<?php endif; ?></td>
                <td><?php echo $this->_tpl_vars['pay']->needAmount; ?>
</td>
                <td><?php if ($this->_tpl_vars['pay']->payAmount): ?><?php echo $this->_tpl_vars['pay']->payAmount; ?>
<?php else: ?>-<?php endif; ?></td>
                <td><?php echo $this->_tpl_vars['this']['payStatuses'][$this->_tpl_vars['status']]; ?>
</td>
                <td><?php if ($this->_tpl_vars['pay']->tsCreated): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['pay']->tsCreated)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
<?php else: ?>-<?php endif; ?></td>
                <td><?php if ($this->_tpl_vars['pay']->tsUpdated): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['pay']->tsUpdated)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
<?php else: ?>-<?php endif; ?></td>
                <td>
                    <?php if (! $this->_tpl_vars['pay']->payAmount && $this->_tpl_vars['status'] != 'STATUS_PAID'): ?>
                        <a href="<?php echo smarty_function_alink(array('do' => 'invoicepayed','id' => $this->_tpl_vars['pay']->id), $this);?>
" onclick="return confirm('Вы уверены, что данный счёт оплачен?');">Оплачен</a>&nbsp;
                        <a href="<?php echo smarty_function_alink(array('do' => 'delinvoice','id' => $this->_tpl_vars['pay']->id), $this);?>
" onclick="return confirm('Вы уверены, что хотите удалить счет?');" style="color: #f00">Удалить</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; endif; unset($_from); ?>
    <?php else: ?>
        <tr class="<?php echo smarty_function_cycle(array('values' => 'color,'), $this);?>
">
            <td colspan="9" class="text-center">Список пуст</td>
        </tr>
    <?php endif; ?>
    </table>
    <p><?php echo smarty_function_pager(array('total' => $this->_tpl_vars['this']['total'],'per' => $this->_tpl_vars['this']['perPage']), $this);?>
</p>