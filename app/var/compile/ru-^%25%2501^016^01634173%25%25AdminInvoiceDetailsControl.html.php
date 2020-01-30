<?php /* Smarty version 2.6.13, created on 2019-12-03 10:17:21
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/AdminInvoiceDetailsControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/adminka/AdminInvoiceDetailsControl.html', 3, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/AdminInvoiceDetailsControl.html', 21, false),array('modifier', 'dateformat', '/home/c484884/gastreet.com/www/app/Templates/adminka/AdminInvoiceDetailsControl.html', 17, false),array('modifier', 'round0', '/home/c484884/gastreet.com/www/app/Templates/adminka/AdminInvoiceDetailsControl.html', 48, false),array('modifier', 'mobilephone', '/home/c484884/gastreet.com/www/app/Templates/adminka/AdminInvoiceDetailsControl.html', 124, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['AdminInvoiceDetailsControl']); ?>

<?php echo smarty_function_loadscript(array('file' => '/js/jquery.placeholder.min.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/pages/admininvoicedetails.js','type' => 'js'), $this);?>


<?php $this->assign('type', $this->_tpl_vars['this']['pay']->type); ?>
<?php $this->assign('status', $this->_tpl_vars['this']['pay']->status); ?>
<?php $this->assign('userId', $this->_tpl_vars['this']['pay']->userId); ?>

<h4>Счёт на оплату номер: <?php echo $this->_tpl_vars['this']['pay']->id; ?>
</h4>
<dl>
    <dt>Сумма:</dt>
    <dd><?php echo $this->_tpl_vars['this']['pay']->needAmount; ?>
</dd>
</dl>
<dl>
    <dt>Дата создания:</dt>
    <dd><?php if ($this->_tpl_vars['this']['pay']->tsCreated): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['this']['pay']->tsCreated)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
<?php else: ?>-<?php endif; ?></dd>
</dl>

<!-- редактирование реквизитов контрагента -->
<form id="form" action="<?php echo smarty_function_alink(array('do' => 'adminsaveuserdetails'), $this);?>
" method="post" style="max-width: 400px">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['this']['details']->id; ?>
" />
    <div class="form-group">
        <label>Компания:</label>
        <input class="form-control" type="text" name="company" id="company" value="<?php echo $this->_tpl_vars['this']['details']->company; ?>
"/>
    </div>
    <div class="form-group">
        <label>ИНН:</label>
        <input class="form-control" type="text" name="inn" id="inn" value="<?php echo $this->_tpl_vars['this']['details']->inn; ?>
"/>
    </div>
    <div class="form-group">
        <label>КПП:</label>
        <input class="form-control" type="text" name="kpp" id="kpp" value="<?php echo $this->_tpl_vars['this']['details']->kpp; ?>
"/>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Сохранить"/>
    </div>
</form>

<?php if (! $this->_tpl_vars['this']['pay']->payAmount && $this->_tpl_vars['status'] != 'STATUS_PAID' && $this->_tpl_vars['type'] == 'TYPE_INVOICE'): ?>
    <div class="well" style="max-width: 400px">
        <h4>Отметить что счёт оплачен:</h4>
        <form method="post" action="<?php echo smarty_function_alink(array('do' => 'invoicepayed'), $this);?>
">
            <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['this']['pay']->id; ?>
"/>
            <div class="filter-buyers">
                <div class="form-group">
                    <label class="">Фактическая сумма безналом:</label>
                    <input class="form-control" type="text" name="amount" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['this']['pay']->needAmount)) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
" />
                </div>

                <div class="form-group form-inline">
                    <label style="display:block;">Дата оплаты:</label>
                    <input class="form-control" type="text" name="startDay" placeholder="дд" value="<?php if ($this->_tpl_vars['this']['startDay'] != null): ?><?php echo $this->_tpl_vars['this']['startDay']; ?>
<?php endif; ?>" style="width:44px;" /> - 
                    <input class="form-control" type="text" name="startMonth" placeholder="мм" value="<?php if ($this->_tpl_vars['this']['startMonth'] != null): ?><?php echo $this->_tpl_vars['this']['startMonth']; ?>
<?php endif; ?>" style="width:44px;" /> - 
                    <input class="form-control" type="text" name="startYear" placeholder="гггг" value="<?php if ($this->_tpl_vars['this']['startYear'] != null): ?><?php echo $this->_tpl_vars['this']['startYear']; ?>
<?php endif; ?>" style="width:60px;" />
                </div>
                
                <label style="margin-bottom: 15px;"><input type="checkbox" name="inBalance"/> Зачислить на внутренний баланс</label>
                
                <div class="form-group">
                    <input class="btn btn-success" type="submit" id="submit" value="Отметить что счёт оплачен"/>
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>

<?php if ($this->_tpl_vars['this']['invoiceBaskets'] || $this->_tpl_vars['this']['invoiceBasketProducts']): ?>
    <h2>Содержимое счёта:</h2>
    <h4>(товары на оплату по счёту):</h4>
<?php endif; ?>

<?php if ($this->_tpl_vars['this']['wrongBasket'] || $this->_tpl_vars['this']['wrongBasketProducts']): ?>
    <p style="color: red;">Внимание! По данному счёту оплачены позиции, которых уже нет в корзине покупателя!</p>
<?php endif; ?>

<?php if ($this->_tpl_vars['this']['invoiceBaskets']): ?>
    <h4>Билеты</h4>
    <table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
        <tr>
            <th>Билет</th>
            <th>Базовая цена</th>
            <th>Оплачено</th>
        </tr>
        <?php $_from = $this->_tpl_vars['this']['invoiceBaskets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ticket']):
?>
        <?php $this->assign('basketId', $this->_tpl_vars['ticket']->id); ?>
        <?php $this->assign('childid', $this->_tpl_vars['ticket']->childId); ?>
        <tr>
            <td><?php echo $this->_tpl_vars['ticket']->baseTicketName; ?>
<?php if ($this->_tpl_vars['ticket']->childId && $this->_tpl_vars['this']['children'][$this->_tpl_vars['childid']]): ?> <i>для <?php echo $this->_tpl_vars['this']['children'][$this->_tpl_vars['childid']]; ?>
</i><?php endif; ?></td>
            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->needAmount)) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
</td>
            <td><?php if ($this->_tpl_vars['ticket']->payAmount+$this->_tpl_vars['ticket']->ulAmount-$this->_tpl_vars['ticket']->returnedAmount > $this->_tpl_vars['ticket']->needAmount-$this->_tpl_vars['ticket']->discountAmount): ?><b><?php echo $this->_tpl_vars['ticket']->payAmount+$this->_tpl_vars['ticket']->ulAmount-$this->_tpl_vars['ticket']->returnedAmount; ?>
</b><?php else: ?><?php echo $this->_tpl_vars['ticket']->payAmount+$this->_tpl_vars['ticket']->ulAmount-$this->_tpl_vars['ticket']->returnedAmount; ?>
<?php endif; ?></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
    </table>
<?php endif; ?>

<?php if ($this->_tpl_vars['this']['invoiceBasketProducts']): ?>
<h4>Мастер-классы</h4>
<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
    <tr>
        <th>Наименование</th>
        <th>Базовая цена</th>
        <th>Оплачено</th>
    </tr>
    <?php $_from = $this->_tpl_vars['this']['invoiceBasketProducts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
    <?php $this->assign('basketProductId', $this->_tpl_vars['product']->id); ?>
    <?php $this->assign('childid', $this->_tpl_vars['product']->childId); ?>
    <tr>
        <td><?php echo $this->_tpl_vars['product']->productName; ?>
<?php if ($this->_tpl_vars['product']->childId && $this->_tpl_vars['this']['children'][$this->_tpl_vars['childid']]): ?> <i>для <?php echo $this->_tpl_vars['this']['children'][$this->_tpl_vars['childid']]; ?>
</i><?php endif; ?></td>
        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->needAmount)) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
</td>
        <td><?php if ($this->_tpl_vars['product']->payAmount+$this->_tpl_vars['product']->ulAmount-$this->_tpl_vars['product']->returnedAmount > $this->_tpl_vars['product']->needAmount-$this->_tpl_vars['product']->discountAmount): ?><b><?php echo $this->_tpl_vars['product']->payAmount+$this->_tpl_vars['product']->ulAmount-$this->_tpl_vars['product']->returnedAmount; ?>
</b><?php else: ?><?php echo $this->_tpl_vars['product']->payAmount+$this->_tpl_vars['product']->ulAmount-$this->_tpl_vars['product']->returnedAmount; ?>
<?php endif; ?></td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?>

<br/>
<h2>Содержимое корзины:</h2>
<?php $this->assign('showBronButton', 0); ?>

<div class="gss-basket">
    <h4>Основной участник</h4>
    <div class="user">
        <p><?php echo $this->_tpl_vars['this']['user']->lastname; ?>
 <?php echo $this->_tpl_vars['this']['user']->name; ?>
 <span class="phone"><?php echo ((is_array($_tmp=$this->_tpl_vars['this']['user']->phone)) ? $this->_run_mod_handler('mobilephone', true, $_tmp) : smarty_modifier_mobilephone($_tmp)); ?>
</span></p>
    </div>
    <?php if ($this->_tpl_vars['this']['purchasedTickets']): ?>
    <table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
        <tr>
            <th>Наименование</th>
            <th>Цена</th>
            <th>Оплата</th>
            <th>Скидка</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        <?php $_from = $this->_tpl_vars['this']['purchasedTickets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ticket']):
?>
            <?php $this->assign('basketId', $this->_tpl_vars['ticket']['id']); ?>
            <?php $this->assign('basketStatus', $this->_tpl_vars['ticket']['status']); ?>
            <?php $this->assign('basketUserId', $this->_tpl_vars['ticket']['userId']); ?>
            <?php $this->assign('basketChildId', $this->_tpl_vars['ticket']['childId']); ?>
            <?php ob_start(); ?><?php echo $this->_tpl_vars['basketUserId']; ?>
_<?php if ($this->_tpl_vars['basketChildId']): ?><?php echo $this->_tpl_vars['basketChildId']; ?>
<?php endif; ?><?php $this->_smarty_vars['capture']['capturedBasketUserIdChildId'] = ob_get_contents(); ob_end_clean(); ?>
            <?php $this->assign('basketUserIdChildId', $this->_smarty_vars['capture']['capturedBasketUserIdChildId']); ?>
            <tr>
                <td style="width: 50%;">Билет &laquo;<?php echo $this->_tpl_vars['ticket']['baseTicketName']; ?>
&raquo;</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']['needAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']['payAmount']+$this->_tpl_vars['ticket']['ulAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']['discountAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
</td>
                <td><?php echo $this->_tpl_vars['this']['basketStatuses'][$this->_tpl_vars['basketStatus']]; ?>
</td>
                <td>
                    <?php if (( $this->_tpl_vars['ticket']['needAmount']-$this->_tpl_vars['ticket']['payAmount']-$this->_tpl_vars['ticket']['ulAmount']+$this->_tpl_vars['ticket']['returnedAmount']-$this->_tpl_vars['ticket']['discountAmount'] ) > 0): ?>
                        <?php $this->assign('total', $this->_tpl_vars['total']+$this->_tpl_vars['ticket']['needAmount']-$this->_tpl_vars['ticket']['payAmount']-$this->_tpl_vars['ticket']['ulAmount']+$this->_tpl_vars['ticket']['returnedAmount']-$this->_tpl_vars['ticket']['discountAmount']); ?>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['basketStatus'] == 'STATUS_NEW'): ?><a href="<?php echo smarty_function_alink(array('do' => 'adminmarkticketpaid','basketId' => $this->_tpl_vars['basketId']), $this);?>
" onclick="return confirm('Вы уверены что нужно отметить эту позицию как оплаченную?');">Отметить что оплачено</a><?php else: ?>-<?php endif; ?>
                </td>
            </tr>
        <?php endforeach; endif; unset($_from); ?>
    </table>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['this']['purchasedProducts']): ?>
    <p class="mk-title">Мастер-классы, ужины:</p>
    <table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
        <tr>
            <th>Наименование</th>
            <th>Цена</th>
            <th>Оплата</th>
            <th>Скидка</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        <?php $_from = $this->_tpl_vars['this']['purchasedProducts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
            <?php $this->assign('basketProductId', $this->_tpl_vars['product']['id']); ?>
            <?php $this->assign('basketStatus', $this->_tpl_vars['product']['status']); ?>
            <?php $this->assign('basketUserId', $this->_tpl_vars['product']['userId']); ?>
            <?php $this->assign('basketChildId', $this->_tpl_vars['product']['childId']); ?>
            <?php ob_start(); ?><?php echo $this->_tpl_vars['basketUserId']; ?>
_<?php if ($this->_tpl_vars['basketChildId']): ?><?php echo $this->_tpl_vars['basketChildId']; ?>
<?php endif; ?><?php $this->_smarty_vars['capture']['capturedBasketUserIdChildId'] = ob_get_contents(); ob_end_clean(); ?>
            <?php $this->assign('basketUserIdChildId', $this->_smarty_vars['capture']['capturedBasketUserIdChildId']); ?>
            <tr>
                <td style="width: 50%;"><?php echo $this->_tpl_vars['product']['productName']; ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['needAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['payAmount']+$this->_tpl_vars['product']['ulAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['discountAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
</td>
                <td><?php echo $this->_tpl_vars['this']['basketProductStatuses'][$this->_tpl_vars['basketStatus']]; ?>
</td>
                <td>
                    <?php if (( $this->_tpl_vars['product']['needAmount']-$this->_tpl_vars['product']['payAmount']-$this->_tpl_vars['product']['ulAmount']+$this->_tpl_vars['product']['returnedAmount']-$this->_tpl_vars['product']['discountAmount'] ) > 0): ?>
                        <?php $this->assign('total', $this->_tpl_vars['total']+$this->_tpl_vars['product']['needAmount']-$this->_tpl_vars['product']['payAmount']-$this->_tpl_vars['product']['ulAmount']+$this->_tpl_vars['product']['returnedAmount']-$this->_tpl_vars['product']['discountAmount']); ?>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['basketStatus'] == 'STATUS_NEW'): ?><a href="<?php echo smarty_function_alink(array('do' => 'adminmarkproductpaid','basketProductId' => $this->_tpl_vars['basketProductId']), $this);?>
" onclick="return confirm('Вы уверены что нужно отметить эту позицию как оплаченную?');">Отметить что оплачено</a><?php else: ?>-<?php endif; ?>
                </td>
            </tr>
        <?php endforeach; endif; unset($_from); ?>
    </table>
    <?php endif; ?>

    <br/>

    <?php $this->assign('purchasedTickets', 0); ?>
    <?php $this->assign('includedProducts', 0); ?>
    <?php $this->assign('purchasedProducts', 0); ?>

    <?php if ($this->_tpl_vars['this']['children']): ?>
        <?php $_from = $this->_tpl_vars['this']['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['childid'] => $this->_tpl_vars['child']):
?>
            <?php $this->assign('purchasedTickets', $this->_tpl_vars['this']['purchasedChildTickets'][$this->_tpl_vars['childid']]); ?>
            <?php $this->assign('includedProducts', $this->_tpl_vars['this']['includedChildProducts'][$this->_tpl_vars['childid']]); ?>
            <?php $this->assign('purchasedProducts', $this->_tpl_vars['this']['purchasedChildProducts'][$this->_tpl_vars['childid']]); ?>
            <?php $this->assign('gotChildrenBalance', $this->_tpl_vars['this']['childrenBalance'][$this->_tpl_vars['childid']]); ?>
            <div class="ch-user">
                <?php echo $this->_tpl_vars['child']; ?>

            </div>

            <?php if (! $this->_tpl_vars['purchasedTickets'] && ! $this->_tpl_vars['purchasedProducts']): ?>
                <p class="ch-empty">Корзина данного участника пуста.</p>
            <?php endif; ?>

            <?php if ($this->_tpl_vars['purchasedTickets']): ?>
            <table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
                <tr>
                    <th>Наименование</th>
                    <th>Цена</th>
                    <th>Оплата</th>
                    <th>Скидка</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
                <?php $_from = $this->_tpl_vars['purchasedTickets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ticket']):
?>
                    <?php $this->assign('basketId', $this->_tpl_vars['ticket']['id']); ?>
                    <?php $this->assign('basketStatus', $this->_tpl_vars['ticket']['status']); ?>
                    <?php $this->assign('basketUserId', $this->_tpl_vars['ticket']['userId']); ?>
                    <?php $this->assign('basketChildId', $this->_tpl_vars['ticket']['childId']); ?>
                    <?php ob_start(); ?><?php echo $this->_tpl_vars['basketUserId']; ?>
_<?php if ($this->_tpl_vars['basketChildId']): ?><?php echo $this->_tpl_vars['basketChildId']; ?>
<?php endif; ?><?php $this->_smarty_vars['capture']['capturedBasketUserIdChildId'] = ob_get_contents(); ob_end_clean(); ?>
                    <?php $this->assign('basketUserIdChildId', $this->_smarty_vars['capture']['capturedBasketUserIdChildId']); ?>
                    <tr>
                        <td style="width: 50%;">Билет &laquo;<?php echo $this->_tpl_vars['ticket']['baseTicketName']; ?>
&raquo;</td>
                        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']['needAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
</td>
                        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']['payAmount']+$this->_tpl_vars['ticket']['ulAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
</td>
                        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']['discountAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
</td>
                        <td><?php echo $this->_tpl_vars['this']['basketStatuses'][$this->_tpl_vars['basketStatus']]; ?>
</td>
                        <td>
                            <?php if (( $this->_tpl_vars['ticket']['needAmount']-$this->_tpl_vars['ticket']['payAmount']-$this->_tpl_vars['ticket']['ulAmount']+$this->_tpl_vars['ticket']['returnedAmount']-$this->_tpl_vars['ticket']['discountAmount'] ) > 0): ?>
                                <?php $this->assign('total', $this->_tpl_vars['total']+$this->_tpl_vars['ticket']['needAmount']-$this->_tpl_vars['ticket']['payAmount']-$this->_tpl_vars['ticket']['ulAmount']+$this->_tpl_vars['ticket']['returnedAmount']-$this->_tpl_vars['ticket']['discountAmount']); ?>
                            <?php endif; ?>
                            <?php if ($this->_tpl_vars['basketStatus'] == 'STATUS_NEW'): ?><a href="<?php echo smarty_function_alink(array('do' => 'adminmarkticketpaid','basketId' => $this->_tpl_vars['basketId']), $this);?>
" onclick="return confirm('Вы уверены что нужно отметить эту позицию как оплаченную?');">Отметить что оплачено</a><?php else: ?>-<?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; endif; unset($_from); ?>
            </table>
            <?php endif; ?>

            <?php if ($this->_tpl_vars['purchasedProducts']): ?>
            <p class="mk-title">Мастер-классы, ужины:</p>
            <table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
                <tr>
                    <th>Наименование</th>
                    <th>Цена</th>
                    <th>Оплата</th>
                    <th>Скидка</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
                <?php $_from = $this->_tpl_vars['purchasedProducts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
                    <?php $this->assign('basketProductId', $this->_tpl_vars['product']['id']); ?>
                    <?php $this->assign('basketStatus', $this->_tpl_vars['product']['status']); ?>
                    <?php $this->assign('basketUserId', $this->_tpl_vars['product']['userId']); ?>
                    <?php $this->assign('basketChildId', $this->_tpl_vars['product']['childId']); ?>
                    <?php ob_start(); ?><?php echo $this->_tpl_vars['basketUserId']; ?>
_<?php if ($this->_tpl_vars['basketChildId']): ?><?php echo $this->_tpl_vars['basketChildId']; ?>
<?php endif; ?><?php $this->_smarty_vars['capture']['capturedBasketUserIdChildId'] = ob_get_contents(); ob_end_clean(); ?>
                    <?php $this->assign('basketUserIdChildId', $this->_smarty_vars['capture']['capturedBasketUserIdChildId']); ?>
                    <tr>
                        <td style="width: 50%;"><?php echo $this->_tpl_vars['product']['productName']; ?>
</td>
                        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['needAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
</td>
                        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['payAmount']+$this->_tpl_vars['product']['ulAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
</td>
                        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['discountAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
</td>
                        <td><?php echo $this->_tpl_vars['this']['basketProductStatuses'][$this->_tpl_vars['basketStatus']]; ?>
</td>
                        <td>
                            <?php if (( $this->_tpl_vars['product']['needAmount']-$this->_tpl_vars['product']['payAmount']-$this->_tpl_vars['product']['ulAmount']+$this->_tpl_vars['product']['returnedAmount']-$this->_tpl_vars['product']['discountAmount'] ) > 0): ?>
                                <?php $this->assign('total', $this->_tpl_vars['total']+$this->_tpl_vars['product']['needAmount']-$this->_tpl_vars['product']['payAmount']-$this->_tpl_vars['product']['ulAmount']+$this->_tpl_vars['product']['returnedAmount']-$this->_tpl_vars['product']['discountAmount']); ?>
                            <?php endif; ?>
                            <?php if ($this->_tpl_vars['basketStatus'] == 'STATUS_NEW'): ?><a href="<?php echo smarty_function_alink(array('do' => 'adminmarkproductpaid','basketProductId' => $this->_tpl_vars['basketProductId']), $this);?>
" onclick="return confirm('Вы уверены что нужно отметить эту позицию как оплаченную?');">Отметить что оплачено</a><?php else: ?>-<?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; endif; unset($_from); ?>
            </table>
            <?php endif; ?>
            <br/>
        <?php endforeach; endif; unset($_from); ?>
    <?php endif; ?>

</div>


<?php if ($this->_tpl_vars['this']['bomList']): ?>
    <h3>Бронирования:</h3>
    <table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
        <tr>
            <th>ID</th>
            <th>Дата оплаты</th>
            <th>Забронировано до</th>
            <th>Оплачено</th>
        </tr>
        <?php $_from = $this->_tpl_vars['this']['bomList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['bom']):
?>
            <tr>
                <td><?php echo $this->_tpl_vars['bom']->id; ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['bom']->tsPay)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['bom']->tsFinish)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['bom']->payAmount)) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
</td>
            </tr>
        <?php endforeach; endif; unset($_from); ?>
    </table>
<?php endif; ?>