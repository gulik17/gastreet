<?php /* Smarty version 2.6.13, created on 2019-12-16 08:37:51
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/UserControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/UserControl.html', 7, false),array('function', 'html_options', '/home/c484884/gastreet.com/www/app/Templates/adminka/UserControl.html', 105, false),array('modifier', 'round0', '/home/c484884/gastreet.com/www/app/Templates/adminka/UserControl.html', 66, false),array('modifier', 'dateformat', '/home/c484884/gastreet.com/www/app/Templates/adminka/UserControl.html', 73, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['UserControl']); ?>
<?php $this->assign('status', $this->_tpl_vars['this']['user']->status); ?>
<?php $this->assign('userTypeId', $this->_tpl_vars['this']['user']->typeId); ?>

<h2>
    <span style="float:right;font-size:12px;font-weight:200;margin:-5px 0 0 0;">
        <a class="btn btn-default" href="<?php echo smarty_function_alink(array('show' => 'adminkaedituser','id' => $this->_tpl_vars['this']['user']->id), $this);?>
">Редактировать</a>
    </span>
    <span style="float:right;font-size:12px;font-weight:200;margin:-5px 15px 0 0;">
        <a class="btn btn-success" href="<?php echo smarty_function_alink(array('do' => 'updatebit','id' => $this->_tpl_vars['this']['user']->id), $this);?>
">Обновить данные в БИТ</a>
    </span>
    <span style="float:right;font-size:12px;font-weight:200;margin:-5px 15px 0 0;">
        <a class="btn btn-success" href="<?php echo smarty_function_alink(array('do' => 'updateapp','id' => $this->_tpl_vars['this']['user']->id), $this);?>
">Обновить данные в App</a>
    </span>
    <span>Данные пользователя</span>
</h2>
<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
    <tr>
        <td>ID:</td>
        <td><?php echo $this->_tpl_vars['this']['user']->id; ?>
</td>
    </tr>
    <tr>
        <td>Тип пользователя:</td>
        <td><?php if (! $this->_tpl_vars['userTypeId']): ?>—<?php else: ?><?php echo $this->_tpl_vars['this']['userTypes'][$this->_tpl_vars['userTypeId']]; ?>
<?php endif; ?></td>
    </tr>
    <tr>
        <td>ФИО:</td>
        <td><?php echo $this->_tpl_vars['this']['user']->lastname; ?>
 <?php echo $this->_tpl_vars['this']['user']->name; ?>
</td>
    </tr>
    <tr>
        <td>Страна:</td>
        <td>
            <?php $this->assign('countryName', $this->_tpl_vars['this']['user']->countryName); ?>
            <?php echo $this->_tpl_vars['this']['country'][$this->_tpl_vars['countryName']]; ?>

        </td>
    </tr>
    <tr>
        <td>Город:</td>
        <td><?php echo $this->_tpl_vars['this']['user']->cityName; ?>
</td>
    </tr>
    <tr>
        <td>Компания:</td>
        <td><?php echo $this->_tpl_vars['this']['user']->company; ?>
</td>
    </tr>
    <tr>
        <td>Должность:</td>
        <td><?php echo $this->_tpl_vars['this']['user']->position; ?>
</td>
    </tr>
    <tr>
        <td>Номер мобильного:</td>
        <td><?php echo $this->_tpl_vars['this']['user']->phone; ?>
</td>
    </tr>
    <tr>
        <td>E-Mail:</td>
        <td><?php if ($this->_tpl_vars['this']['user']->confirmedEmail): ?><?php echo $this->_tpl_vars['this']['user']->confirmedEmail; ?>
<?php else: ?><?php echo $this->_tpl_vars['this']['user']->email; ?>
<?php endif; ?></td>
    </tr>
    <tr>
        <td>Статус:</td>
        <td><?php echo $this->_tpl_vars['this']['userStatuses'][$this->_tpl_vars['status']]; ?>
</td>
    </tr>
    <tr>
        <td>Баланс на авансовом счёте:</td>
        <td>
            <form action="<?php echo smarty_function_alink(array('do' => 'adminsavenewbalance'), $this);?>
" method="post" class="form-inline">
                <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['this']['user']->id; ?>
" />
                <input type="text" class="form-control" name="balance" value="<?php if ($this->_tpl_vars['this']['user']->ulBalance): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['this']['user']->ulBalance)) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
<?php else: ?>0<?php endif; ?>"/>
                <input type="submit" class="btn btn-default" value="Обновить" />
            </form>
        </td>
    </tr>
    <tr>
        <td>Дата создания:</td>
        <td><?php if ($this->_tpl_vars['this']['user']->tsCreated): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['this']['user']->tsCreated)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
<?php else: ?>-<?php endif; ?></td>
    </tr>
    <?php if ($this->_tpl_vars['this']['user']->status == 'STATUS_REGISTERED'): ?>
    <tr>
        <td>Дата регистрации:</td>
        <td><?php if ($this->_tpl_vars['this']['user']->tsRegister): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['this']['user']->tsRegister)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
<?php else: ?>-<?php endif; ?></td>
    </tr>
    <?php endif; ?>
    <tr>
        <td>Был на сайте:</td>
        <td><?php if ($this->_tpl_vars['this']['user']->tsOnline): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['this']['user']->tsOnline)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
<?php else: ?>-<?php endif; ?></td>
    </tr>
    <?php if ($this->_tpl_vars['this']['user']->youAboutUs): ?>
    <tr>
        <td>Как узнал:</td>
        <td><?php echo $this->_tpl_vars['this']['user']->youAboutUs; ?>
</td>
    </tr>
    <?php endif; ?>
    <tr>
        <td>UTM метки:</td>
        <td><?php if ($this->_tpl_vars['this']['user']->utm): ?><?php echo $this->_tpl_vars['this']['user']->utm; ?>
<?php else: ?>—<?php endif; ?></td>
    </tr>
</table>

<!-- перенести в группу -->
<form action="<?php echo smarty_function_alink(array('do' => 'adminsetusertype'), $this);?>
" method="post" class="form-inline">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['this']['user']->id; ?>
" />
    <dl>
        <dt>Перенести участника в группу:</dt>
        <dd>
            <select name="userTypeId" class="form-control">
                <option value="0">Покупатель</option>
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['userTypes'],'selected' => $this->_tpl_vars['this']['user']->typeId), $this);?>

            </select>
            <input id="submit" type="submit" value="Перенести" class="btn btn-success"/>
        </dd>
    </dl>
</form><br/>


<?php if ($this->_tpl_vars['this']['dmList']): ?>
    <h4>Купоны на скидку:</h4>
    <table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
        <tr>
            <th>Код</th>
            <th>Скидка</th>
            <th>Тип</th>
            <th>Статус</th>
        </tr>
        <?php $_from = $this->_tpl_vars['this']['dmList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['discount']):
?>
        <?php $this->assign('discountType', $this->_tpl_vars['discount']->type); ?>
        <?php $this->assign('discountStatus', $this->_tpl_vars['discount']->status); ?>
        <tr>
            <td><?php echo $this->_tpl_vars['discount']->code; ?>
</td>
            <td><?php echo $this->_tpl_vars['discount']->percent; ?>
%</td>
            <td><?php echo $this->_tpl_vars['this']['discountTypes'][$this->_tpl_vars['discountType']]; ?>
</td>
            <td><?php echo $this->_tpl_vars['this']['discountStatuses'][$this->_tpl_vars['discountStatus']]; ?>
</td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
    </table>
<?php endif; ?>

<a href="/adminka/index.php?show=editdiscount&userId=<?php echo $this->_tpl_vars['this']['user']->id; ?>
" class="btn btn-primary">Добавить купон на скидку</a><br/>

<?php if ($this->_tpl_vars['this']['udmObj']): ?>
<span style="float:right;font-size:12px;font-weight:200;margin-top:-5px;">
    <a class="btn btn-default" href="<?php echo smarty_function_alink(array('show' => 'edituserdetails','id' => $this->_tpl_vars['this']['udmObj']->id), $this);?>
">Редактировать</a>
</span>
<h2>Реквизиты:</h2>
<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
    <tr>
        <td>Юридический статус:</td>
        <td>
        <?php if ($this->_tpl_vars['this']['udmObj']->company_type == 2): ?>Юридическое лицо<?php endif; ?>
        <?php if ($this->_tpl_vars['this']['udmObj']->company_type == 3): ?>Индивидуальный предприниматель<?php endif; ?>
        </td>
    </tr>
    <tr>
        <td>Компания:</td><td><?php echo $this->_tpl_vars['this']['udmObj']->company; ?>
</td>
    </tr>
    <?php if ($this->_tpl_vars['this']['udmObj']->countryName): ?>
    <tr>
        <td>Страна:</td><td><?php echo $this->_tpl_vars['this']['udmObj']->countryName; ?>
</td>
    </tr><?php endif; ?>
    <?php if ($this->_tpl_vars['this']['udmObj']->cityName): ?>
    <tr>
        <td>Город:</td><td><?php echo $this->_tpl_vars['this']['udmObj']->cityName; ?>
</td>
    </tr><?php endif; ?>
    <?php if ($this->_tpl_vars['this']['udmObj']->inn): ?>
    <tr>
        <td>ИНН:</td><td><?php echo $this->_tpl_vars['this']['udmObj']->inn; ?>
</td>
    </tr><?php endif; ?>
    <?php if ($this->_tpl_vars['this']['udmObj']->kpp): ?>
    <tr>
        <td>КПП:</td><td><?php echo $this->_tpl_vars['this']['udmObj']->kpp; ?>
</td>
    </tr><?php endif; ?>
    <?php if ($this->_tpl_vars['this']['udmObj']->rs): ?>
    <tr>
        <td>р/с:</td><td><?php echo $this->_tpl_vars['this']['udmObj']->rs; ?>
</td>
    </tr><?php endif; ?>
    <?php if ($this->_tpl_vars['this']['udmObj']->bank): ?>
    <tr>
        <td>Банк:</td><td><?php echo $this->_tpl_vars['this']['udmObj']->bank; ?>
</td>
    </tr><?php endif; ?>
    <?php if ($this->_tpl_vars['this']['udmObj']->corr): ?>
    <tr>
        <td>к/с:</td><td><?php echo $this->_tpl_vars['this']['udmObj']->corr; ?>
</td>
    </tr><?php endif; ?>
    <?php if ($this->_tpl_vars['this']['udmObj']->bik): ?>
    <tr>
        <td>БИК:</td><td><?php echo $this->_tpl_vars['this']['udmObj']->bik; ?>
</td>
    </tr><?php endif; ?>
    <?php if ($this->_tpl_vars['this']['udmObj']->director): ?>
    <tr>
        <td>Директор:</td><td><?php echo $this->_tpl_vars['this']['udmObj']->director; ?>
</td>
    </tr><?php endif; ?>
    <?php if ($this->_tpl_vars['this']['udmObj']->buh): ?>
    <tr>
        <td>Гл. бухгалтер:</td><td><?php echo $this->_tpl_vars['this']['udmObj']->buh; ?>
</td>
    </tr><?php endif; ?>
    <?php if ($this->_tpl_vars['this']['udmObj']->address): ?>
    <tr>
        <td>Адрес:</td><td><?php echo $this->_tpl_vars['this']['udmObj']->address; ?>
</td>
    </tr><?php endif; ?>
</table>
<?php endif; ?>

<?php if ($this->_tpl_vars['this']['qrmObj']): ?>
<h2>QR код:</h2>
<img src="/qr/code.php?code=<?php echo $this->_tpl_vars['this']['qrmObj']->code; ?>
" /><br/>
<?php endif; ?>

<!-- бронирования -->
<?php if ($this->_tpl_vars['this']['bookings']): ?>
<br/><h4>Бронирования:</h4>
<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
    <tr>
        <th>ID</th>
        <th>Создано</th>
        <th>Оплачено</th>
        <th>До ...</th>
        <th>Сумма</th>
        <th>ID транзакции</th>
        <th>Статус</th>
    </tr>
    <?php $_from = $this->_tpl_vars['this']['bookings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['booking']):
?>
    <tr>
        <td><?php echo $this->_tpl_vars['booking']->id; ?>
</td>
        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['booking']->tsCreate)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
</td>
        <td><?php if ($this->_tpl_vars['booking']->tsPay): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['booking']->tsPay)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
<?php else: ?>—<?php endif; ?></td>
        <td><?php if ($this->_tpl_vars['booking']->tsFinish): ?><?php if ($this->_tpl_vars['booking']->tsFinish > $this->_tpl_vars['this']['ts']): ?><b><?php endif; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['booking']->tsFinish)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
 <a href="#" class="btn btn-danger booking_plus" data-id="<?php echo $this->_tpl_vars['booking']->id; ?>
">+1 день</a><?php if ($this->_tpl_vars['booking']->tsFinish > $this->_tpl_vars['this']['ts']): ?></b><?php endif; ?><?php else: ?>-<?php endif; ?></td>
        <td><?php if ($this->_tpl_vars['booking']->payAmount): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['booking']->payAmount)) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
<?php else: ?>—<?php endif; ?></td>
        <td><?php if ($this->_tpl_vars['booking']->monetaOperationId): ?><?php echo $this->_tpl_vars['booking']->monetaOperationId; ?>
<?php else: ?>—<?php endif; ?></td>
        <td><?php if ($this->_tpl_vars['booking']->status == 'STATUS_PAID'): ?>Оплачено<?php else: ?>—<?php endif; ?></td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?>

<?php if ($this->_tpl_vars['this']['parentObj']): ?>
<?php $this->assign('parentstatus', $this->_tpl_vars['this']['parentObj']->status); ?>
<h2>Родитель</h2>
<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
    <tr>
        <td>ID:</td>
        <td><?php echo $this->_tpl_vars['this']['parentObj']->id; ?>
</td>
    </tr>
    <tr>
        <td>Номер мобильного:</td>
        <td><?php echo $this->_tpl_vars['this']['parentObj']->phone; ?>
</td>
    </tr>
    <tr>
        <td>E-Mail:</td>
        <td><?php if ($this->_tpl_vars['this']['parentObj']->confirmedEmail): ?><?php echo $this->_tpl_vars['this']['parentObj']->confirmedEmail; ?>
<?php else: ?><?php echo $this->_tpl_vars['this']['parentObj']->email; ?>
<?php endif; ?></td>
    </tr>
    <tr>
        <td>Статус:</td>
        <td><?php echo $this->_tpl_vars['this']['userStatuses'][$this->_tpl_vars['parentstatus']]; ?>
</td>
    </tr>
    <?php if ($this->_tpl_vars['this']['parentObj']->status == 'STATUS_REGISTERED'): ?>
    <tr>
        <td>Дата регистрации:</td>
        <td><?php if ($this->_tpl_vars['this']['parentObj']->tsCreated): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['this']['parentObj']->tsCreated)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
<?php else: ?>-<?php endif; ?></td>
    </tr>
    <?php endif; ?>
    <tr>
        <td>Был на сайте:</td>
        <td><?php if ($this->_tpl_vars['this']['parentObj']->tsOnline): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['this']['parentObj']->tsOnline)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
<?php else: ?>-<?php endif; ?></td>
    </tr>
    <?php if ($this->_tpl_vars['this']['parentObj']->youAboutUs): ?><tr>
        <td>Как узнал:</td>
        <td><?php echo $this->_tpl_vars['this']['parentObj']->youAboutUs; ?>
</td>
    </tr><?php endif; ?>
</table><br/>
<a href="<?php echo smarty_function_alink(array('show' => 'user','id' => $this->_tpl_vars['this']['parentObj']->id), $this);?>
">Перейти в родителя</a><br/>
<?php endif; ?>

<?php if ($this->_tpl_vars['this']['parentDetailsObj']): ?>
<h2>Реквизиты родителя:</h2>
<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
    <tr>
        <td>Компания:</td>
        <td><?php echo $this->_tpl_vars['this']['parentDetailsObj']->company; ?>
</td>
    </tr>
    <?php if ($this->_tpl_vars['this']['parentDetailsObj']->countryName): ?><tr>
        <td>Страна:</td>
        <td><?php echo $this->_tpl_vars['this']['parentDetailsObj']->countryName; ?>
</td>
    </tr><?php endif; ?>
    <?php if ($this->_tpl_vars['this']['parentDetailsObj']->cityName): ?><tr>
        <td>Город:</td>
        <td><?php echo $this->_tpl_vars['this']['parentDetailsObj']->cityName; ?>
</td>
    </tr><?php endif; ?>
    <?php if ($this->_tpl_vars['this']['parentDetailsObj']->inn): ?><tr>
        <td>ИНН:</td>
        <td><?php echo $this->_tpl_vars['this']['parentDetailsObj']->inn; ?>
</td>
    </tr><?php endif; ?>
    <?php if ($this->_tpl_vars['this']['parentDetailsObj']->kpp): ?><tr>
        <td>КПП:</td>
        <td><?php echo $this->_tpl_vars['this']['parentDetailsObj']->kpp; ?>
</td>
    </tr><?php endif; ?>
    <?php if ($this->_tpl_vars['this']['parentDetailsObj']->rs): ?><tr>
        <td>р/с:</td>
        <td><?php echo $this->_tpl_vars['this']['parentDetailsObj']->rs; ?>
</td>
    </tr><?php endif; ?>
    <?php if ($this->_tpl_vars['this']['parentDetailsObj']->bank): ?><tr>
        <td>Банк:</td>
        <td><?php echo $this->_tpl_vars['this']['parentDetailsObj']->bank; ?>
</td>
    </tr><?php endif; ?>
    <?php if ($this->_tpl_vars['this']['parentDetailsObj']->corr): ?><tr>
        <td>к/с:</td>
        <td><?php echo $this->_tpl_vars['this']['parentDetailsObj']->corr; ?>
</td>
    </tr><?php endif; ?>
    <?php if ($this->_tpl_vars['this']['parentDetailsObj']->bik): ?><tr>
        <td>БИК:</td>
        <td><?php echo $this->_tpl_vars['this']['parentDetailsObj']->bik; ?>
</td>
    </tr><?php endif; ?>
    <?php if ($this->_tpl_vars['this']['parentDetailsObj']->director): ?><tr>
        <td>Директор:</td>
        <td><?php echo $this->_tpl_vars['this']['parentDetailsObj']->director; ?>
</td>
    </tr><?php endif; ?>
    <?php if ($this->_tpl_vars['this']['parentDetailsObj']->buh): ?><tr>
        <td>Гл. бухгалтер:</td>
        <td><?php echo $this->_tpl_vars['this']['parentDetailsObj']->buh; ?>
</td>
    </tr><?php endif; ?>
</table>
<?php endif; ?>


<?php if ($this->_tpl_vars['this']['tickets']): ?>
<h2>Билеты участника</h2>
<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
    <tr>
        <th>Добавлен</th>
        <th>Билет</th>
        <th>Цена</th>
        <th>Статус</th>
        <th>Оплачено</th>
        <th>Скидка</th>
        <th>Промо-код</th>
        <th>% скидки</th>
        <th>ID транзакции</th>
        <th>Действия</th>
    </tr>
    <?php $_from = $this->_tpl_vars['this']['tickets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ticket']):
?>
    <?php $this->assign('basketId', $this->_tpl_vars['ticket']['id']); ?>
    <?php $this->assign('ticketstatus', $this->_tpl_vars['ticket']['status']); ?>
    <tr>
        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']['tsCreated'])) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
</td>
        <td><?php echo $this->_tpl_vars['ticket']['baseTicketName']; ?>
<?php if ($this->_tpl_vars['this']['includedProducts']): ?> (Включено: <?php $_from = $this->_tpl_vars['this']['includedProducts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['inclproducts'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['inclproducts']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['includedProduct']):
        $this->_foreach['inclproducts']['iteration']++;
?><?php echo $this->_tpl_vars['includedProduct']->name; ?>
<?php if (! ($this->_foreach['inclproducts']['iteration'] == $this->_foreach['inclproducts']['total'])): ?>, <?php endif; ?><?php endforeach; endif; unset($_from); ?>)<?php endif; ?><?php if ($this->_tpl_vars['ticket']['childId']): ?><?php $this->assign('childid', $this->_tpl_vars['ticket']['childId']); ?> <i>для <?php echo $this->_tpl_vars['this']['children'][$this->_tpl_vars['childid']]; ?>
</i><?php endif; ?></td>
        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']['needAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
</td>
        <td><?php echo $this->_tpl_vars['this']['basketStatuses'][$this->_tpl_vars['ticketstatus']]; ?>
</td>
        <td>
            <?php if ($this->_tpl_vars['ticket']['payAmount']+$this->_tpl_vars['ticket']['ulAmount']-$this->_tpl_vars['ticket']['returnedAmount'] > $this->_tpl_vars['ticket']['needAmount']-$this->_tpl_vars['ticket']['discountAmount']): ?><b><?php echo $this->_tpl_vars['ticket']['payAmount']+$this->_tpl_vars['ticket']['ulAmount']-$this->_tpl_vars['ticket']['returnedAmount']; ?>
</b><?php else: ?><?php echo $this->_tpl_vars['ticket']['payAmount']+$this->_tpl_vars['ticket']['ulAmount']-$this->_tpl_vars['ticket']['returnedAmount']; ?>
<?php endif; ?>
            <?php if ($this->_tpl_vars['ticket']['tsPay']): ?>, дата: <?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']['tsPay'])) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
<?php endif; ?>
        </td>
        <td><?php if ($this->_tpl_vars['ticket']['discountAmount']): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']['discountAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
<?php else: ?>-<?php endif; ?></td>
        <td><?php if ($this->_tpl_vars['ticket']['discountCode']): ?><?php echo $this->_tpl_vars['ticket']['discountCode']; ?>
<?php else: ?>-<?php endif; ?></td>
        <td><?php if ($this->_tpl_vars['ticket']['discountPercent']): ?><?php echo $this->_tpl_vars['ticket']['discountPercent']; ?>
%<?php else: ?>-<?php endif; ?></td>
        <td><?php if ($this->_tpl_vars['ticket']['monetaOperationId']): ?><?php echo $this->_tpl_vars['ticket']['monetaOperationId']; ?>
<?php else: ?>-<?php endif; ?></td>
        <td><a href="<?php echo smarty_function_alink(array('do' => 'admindelticket','id' => $this->_tpl_vars['ticket']['id']), $this);?>
" onclick="return confirm('Вы уверены? Удаление будет не обратимым!');">Удалить</a></td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?>

<?php if ($this->_tpl_vars['this']['products']): ?>
<h2>Купленные на участника мастер-классы</h2>
<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
    <tr>
        <th>Дата / время</th>
        <th>Наименование</th>
        <th>Цена</th>
        <th>Статус</th>
        <th>Оплачено</th>
        <th>Скидка</th>
        <th>Промо-код</th>
        <th>% скидки</th>
        <th>ID транзакции</th>
        <th>Действия</th>
    </tr>
    <?php $_from = $this->_tpl_vars['this']['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
    <?php $this->assign('basketProductId', $this->_tpl_vars['product']['id']); ?>
    <?php $this->assign('productstatus', $this->_tpl_vars['product']['status']); ?>
    <tr>
        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['eventTsStart'])) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd M') : smarty_modifier_dateformat($_tmp, 'd M')); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['eventTsStart'])) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'H:i') : smarty_modifier_dateformat($_tmp, 'H:i')); ?>
-<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['eventTsFinish'])) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'H:i') : smarty_modifier_dateformat($_tmp, 'H:i')); ?>
</td>
        <td><?php echo $this->_tpl_vars['product']['productName']; ?>
<?php if ($this->_tpl_vars['product']['childId']): ?><?php $this->assign('childid', $this->_tpl_vars['product']['childId']); ?> <i>для <?php echo $this->_tpl_vars['this']['children'][$this->_tpl_vars['childid']]; ?>
</i><?php endif; ?></td>
        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['needAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
</td>
        <td><?php echo $this->_tpl_vars['this']['basketProductStatuses'][$this->_tpl_vars['productstatus']]; ?>
</td>
        <td>
            <?php if ($this->_tpl_vars['product']['payAmount']+$this->_tpl_vars['product']['ulAmount']-$this->_tpl_vars['product']['returnedAmount'] > $this->_tpl_vars['product']['needAmount']-$this->_tpl_vars['product']['discountAmount']): ?><b><?php echo $this->_tpl_vars['product']['payAmount']+$this->_tpl_vars['product']['ulAmount']-$this->_tpl_vars['product']['returnedAmount']; ?>
</b><?php else: ?><?php echo $this->_tpl_vars['product']['payAmount']+$this->_tpl_vars['product']['ulAmount']-$this->_tpl_vars['product']['returnedAmount']; ?>
<?php endif; ?>
            <?php if ($this->_tpl_vars['product']['tsPay']): ?>, дата: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['tsPay'])) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
<?php endif; ?>
        </td>
        <td><?php if ($this->_tpl_vars['product']['discountAmount']): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['discountAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
<?php else: ?>-<?php endif; ?></td>
        <td><?php if ($this->_tpl_vars['product']['discountCode']): ?><?php echo $this->_tpl_vars['product']['discountCode']; ?>
<?php else: ?>-<?php endif; ?></td>
        <td><?php if ($this->_tpl_vars['product']['discountPercent']): ?><?php echo $this->_tpl_vars['product']['discountPercent']; ?>
%<?php else: ?>-<?php endif; ?></td>
        <td><?php if ($this->_tpl_vars['product']['monetaOperationId']): ?><?php echo $this->_tpl_vars['product']['monetaOperationId']; ?>
<?php else: ?>-<?php endif; ?></td>
        <td><a href="<?php echo smarty_function_alink(array('do' => 'admindeluserproduct','id' => $this->_tpl_vars['product']['id']), $this);?>
" onclick="return confirm('Вы уверены? Удаление будет не обратимым!');">Удалить</a></td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?>


<?php if ($this->_tpl_vars['this']['payments']): ?>
<h2>Оплаты участника</h2>
<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
    <tr>
        <th>ID</th>
        <th>Тип оплаты</th>
        <th>Сумма оплачено</th>
        <th>Дата оплаты</th>
        <th>Скидка</th>
        <th>ID транзакции</th>
    </tr>
    <?php $_from = $this->_tpl_vars['this']['payments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['payment']):
?>
    <?php $this->assign('paymentType', $this->_tpl_vars['payment']->type); ?>
    <tr>
        <td><?php echo $this->_tpl_vars['payment']->id; ?>
</td>
        <td><?php echo $this->_tpl_vars['this']['paymentTypes'][$this->_tpl_vars['paymentType']]; ?>
</td>
        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['payment']->payAmount)) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
</td>
        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['payment']->tsUpdated)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
</td>
        <td>
            <?php if ($this->_tpl_vars['payment']->discountId): ?>
            <?php $this->assign('discountType', $this->_tpl_vars['payment']->discountType); ?>
            <?php $this->assign('discountStatus', $this->_tpl_vars['payment']->discountStatus); ?>
            <?php echo $this->_tpl_vars['payment']->discountCode; ?>
, <?php echo $this->_tpl_vars['payment']->discountPercent; ?>
%, <?php echo $this->_tpl_vars['this']['discountTypes'][$this->_tpl_vars['discountType']]; ?>
, <?php echo $this->_tpl_vars['this']['discountStatuses'][$this->_tpl_vars['discountStatus']]; ?>

            <?php else: ?>
            -
            <?php endif; ?>
        </td>
        <td><?php if ($this->_tpl_vars['payment']->monetaOperationId): ?><?php echo $this->_tpl_vars['payment']->monetaOperationId; ?>
<?php else: ?>-<?php endif; ?></td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?>

<br/><p>&nbsp;</p>
<?php echo '
<script type="text/javascript">
    $(document).ready(function() {
        $(\'.booking_plus\').click(function () {
            var id      = $(this).data(\'id\');
            var btn     = $(this);
            var btnText = $(this).html();
            var gotdata = \'job=booking_plus\' + \'&id=\' + id;
            $(this).addClass(\'disabled\');
            $(this).html(\'Секунду...\');
            $.ajax({
                type: \'POST\',
                dataType: \'JSON\',
                url: \'/ajax\',
                data: gotdata,
                success: function (data) {
                    if (data.error) {
                        alert(data.msg);
                    } else {
                        alert(\'Бронь продлена на 1 день\');
                        window.location.reload();
                    }
                    $(btn).removeClass(\'disabled\');
                    $(btn).html(btnText);
                }
            });
            return false;
        });
    });
</script>
'; ?>