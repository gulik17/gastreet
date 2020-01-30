<?php /* Smarty version 2.6.13, created on 2020-01-21 21:18:07
         compiled from /home/c484884/gastreet.com/www/app/Templates/BasketControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'round0', '/home/c484884/gastreet.com/www/app/Templates/BasketControl.html', 76, false),array('modifier', 'numberformat', '/home/c484884/gastreet.com/www/app/Templates/BasketControl.html', 143, false),array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/BasketControl.html', 91, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['BasketControl']); ?>
<?php $this->assign('total', 0); ?>
<?php $this->assign('balance', $this->_tpl_vars['this']['user']->ulBalance); ?>

<?php $this->assign('showBronButton', 0); ?>
<?php $this->assign('showBronProductButton', 0); ?>

<?php $this->assign('showWarning', 0); ?>

<?php if (! $this->_tpl_vars['this']['user']->confirmedEmail): ?>
    <?php $this->assign('showWarning', 1); ?>
<?php endif; ?>
<?php $_from = $this->_tpl_vars['this']['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['child']):
?>
    <?php if (! $this->_tpl_vars['child']->confirmedEmail && $this->_tpl_vars['child']->baseTicketId): ?>
        <?php $this->assign('showWarning', 1); ?>
    <?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<script type="text/javascript" src="https://www.googleadservices.com/pagead/conversion.js"></script>
<noscript>
    <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="https://www.googleadservices.com/pagead/conversion/869423439/?label=G4tVCLCX3G4Qz7LJngM&amp;guid=ON&amp;script=0"/>
    </div>
</noscript>

<div class="alert alert-info hidden" role="alert"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Hotel booking will be available January 15, 2018<?php else: ?>Бронирование отелей будет доступно 15 января 2018 года<?php endif; ?></div>

<div class="gss-basket register-page">
    <div class="row">
        <div class="col-md-12">
            <h2 class="title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Basket<?php else: ?>Корзина<?php endif; ?></h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 order-md-2">
            <div class="list-group tab-menu">
                <a href="/basket?q=2" class="list-group-item list-group-item-action"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Members<?php else: ?>Участники<?php endif; ?></a>
                <a href="/basket?q=3" class="list-group-item list-group-item-action"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Choose a main ticket<?php else: ?>Выбрать основной билет<?php endif; ?></a>
                <a href="/basket?q=4" class="list-group-item list-group-item-action d-none"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Choose additional options<?php else: ?>Выбрать доп. услуги<?php endif; ?></a>
                <a href="/basket" class="list-group-item list-group-item-action active"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Pay<?php else: ?>Оплатить участие<?php endif; ?></a>
                <a href="/basket?q=5" class="list-group-item list-group-item-action"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Print the ticket<?php else: ?>Распечатать билет<?php endif; ?></a>
                <a href="/basket?q=6" class="list-group-item list-group-item-action"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Add promo-code<?php else: ?>Ввести промо-код<?php endif; ?></a>
                <a href="/presentation" class="list-group-item list-group-item-action">Презентации</a>
                <?php if (1 == 2): ?>
                    <?php if ($this->_tpl_vars['this']['comItem'] == 'STATUS_ENABLED'): ?>
                        <span class="list-group-item list-group-item-action"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><i class="fa fa-check" aria-hidden="true"></i> You passed test<?php else: ?><i class="fa fa-check" aria-hidden="true"></i> Вы прошли тест<?php endif; ?></span>
                    <?php elseif ($this->_tpl_vars['this']['comItem'] == 'STATUS_DISABLED'): ?>
                        <span class="list-group-item list-group-item-action"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><i class="fa fa-times" aria-hidden="true"></i> You did`t pass test<?php else: ?><i class="fa fa-times" aria-hidden="true"></i> Вы не прошли тест<?php endif; ?></span>
                    <?php else: ?>
                        <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#testModal"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Pizza Championship<?php else: ?>Чемпионат по пицце<?php endif; ?></a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <?php if ($this->_tpl_vars['showWarning'] == 1): ?>
            <div class="information badge-danger mt-4">
                <p class="title">ВНИМАНИЕ!!!</p>
                <p><b>Обязательно</b> подтвердите почту всех участников, чтобы получать важные email уведомления и&nbsp;новости, в&nbsp;том числе билет на почту после оплаты.</p>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-md-8 order-md-1">
            <div class="register-basket">
                <div class="user-container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="h4 basket-user"><?php echo $this->_tpl_vars['this']['user']->name; ?>
 <?php echo $this->_tpl_vars['this']['user']->lastname; ?>
 <span class="basket-phone"><?php echo $this->_tpl_vars['this']['user']->phone; ?>
</span> <?php if (! $this->_tpl_vars['this']['user']->confirmedEmail): ?><?php $this->assign('showWarning', 1); ?><span class="badge badge-danger">E-mail не подтвержден</span><?php endif; ?></div>
                            <div class="basket-desc">Состав билета</div>
                        </div>
                    </div>
                    <?php $this->assign('count', 1); ?>
                    <?php $_from = $this->_tpl_vars['this']['purchasedTickets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ticket']):
?>
                        <?php $this->assign('total', $this->_tpl_vars['total']+$this->_tpl_vars['ticket']['needAmount']-$this->_tpl_vars['ticket']['payAmount']-$this->_tpl_vars['ticket']['ulAmount']+$this->_tpl_vars['ticket']['returnedAmount']-$this->_tpl_vars['ticket']['discountAmount']); ?>
                        <div class="row basket-row">
                            <div class="col-md-6"><span class="counter"><?php echo $this->_tpl_vars['count']; ?>
.</span> <span class="ticket-name"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Ticket<?php else: ?>Билет<?php endif; ?> &laquo;<?php echo $this->_tpl_vars['ticket']['baseTicketName']; ?>
&raquo;</span></div>
                            <div class="col-6 col-md-2 discount-field"><?php if ($this->_tpl_vars['ticket']['discountAmount'] > 0): ?>-<?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']['discountAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
 ₽<?php endif; ?></div>
                            <div class="col-6 col-md-2"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']['needAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
 ₽</div>
                            <div class="col-md-2"><?php if ($this->_tpl_vars['ticket']['status'] == 'STATUS_PAID'): ?><span class="badge badge-success">Оплачен</span><?php else: ?><span class="badge badge-danger">Не оплачен</span><?php endif; ?></div>
                        </div>
                        <?php $this->assign('count', $this->_tpl_vars['count']+1); ?>
                    <?php endforeach; endif; unset($_from); ?>
                    <?php $_from = $this->_tpl_vars['this']['purchasedProducts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['countId'] => $this->_tpl_vars['product']):
?>
                        <?php $this->assign('total', $this->_tpl_vars['total']+$this->_tpl_vars['product']['needAmount']-$this->_tpl_vars['product']['payAmount']-$this->_tpl_vars['product']['ulAmount']+$this->_tpl_vars['product']['returnedAmount']-$this->_tpl_vars['product']['discountAmount']); ?>
                        <div class="row basket-row">
                            <div class="col-md-6"><span class="counter"><?php echo $this->_tpl_vars['count']; ?>
.</span> <span class="ticket-name"><?php echo $this->_tpl_vars['product']['productName']; ?>
</span></div>
                            <div class="col-6 col-md-2 discount-field"><?php if ($this->_tpl_vars['product']['discountAmount'] > 0): ?>-<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['discountAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
 ₽<?php endif; ?></div>
                            <div class="col-6 col-md-2"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['needAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
 ₽</div>
                            <div class="col-md-2">
                                <?php if ($this->_tpl_vars['product']['status'] == 'STATUS_PAID'): ?><span class="badge badge-success"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Payed<?php else: ?>Оплачен<?php endif; ?></span><?php else: ?><span class="badge badge-danger"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Not payed<?php else: ?>Не оплачен<?php endif; ?></span><?php endif; ?>
                                <?php if ($this->_tpl_vars['product']['status'] == 'STATUS_NEW'): ?>
                                    <a href="<?php echo smarty_function_link(array('do' => 'delproduct','id' => $this->_tpl_vars['product']['id']), $this);?>
" title="<?php if ($this->_tpl_vars['lang'] == 'en'): ?>Remove<?php else: ?>Удалить<?php endif; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> <?php if ($this->_tpl_vars['lang'] == 'en'): ?>Remove<?php else: ?>Удалить<?php endif; ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php $this->assign('count', $this->_tpl_vars['count']+1); ?>
                    <?php endforeach; endif; unset($_from); ?>
                </div>
                <?php $_from = $this->_tpl_vars['this']['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['child']):
?>
                    <?php $this->assign('balance', $this->_tpl_vars['balance']+$this->_tpl_vars['child']->ulBalance); ?>
                    <?php $this->assign('child_id', $this->_tpl_vars['child']->id); ?>
                    <?php if ($this->_tpl_vars['this']['purchasedChildTickets'][$this->_tpl_vars['child_id']]): ?>
                    <div class="user-container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="h4 basket-user"><?php echo $this->_tpl_vars['child']->name; ?>
 <?php echo $this->_tpl_vars['child']->lastname; ?>
 <span class="basket-phone"><?php echo $this->_tpl_vars['child']->phone; ?>
</span> <?php if (! $this->_tpl_vars['child']->confirmedEmail): ?><?php $this->assign('showWarning', 1); ?><span class="badge badge-danger">E-mail не подтвержден</span><?php endif; ?></div>
                                <div class="basket-desc">Состав билета</div>
                            </div>
                        </div>
                        <?php $this->assign('count', 1); ?>
                        <?php $_from = $this->_tpl_vars['this']['purchasedChildTickets'][$this->_tpl_vars['child_id']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ticket']):
?>
                            <?php $this->assign('total', $this->_tpl_vars['total']+$this->_tpl_vars['ticket']['needAmount']-$this->_tpl_vars['ticket']['payAmount']-$this->_tpl_vars['ticket']['ulAmount']+$this->_tpl_vars['ticket']['returnedAmount']-$this->_tpl_vars['ticket']['discountAmount']); ?>
                            <div class="row basket-row">
                                <div class="col-md-6"><span class="counter"><?php echo $this->_tpl_vars['count']; ?>
.</span> <span class="ticket-name"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Ticket<?php else: ?>Билет<?php endif; ?> &laquo;<?php echo $this->_tpl_vars['ticket']['baseTicketName']; ?>
&raquo;</span></div>
                                <div class="col-6 col-md-2 discount-field"><?php if ($this->_tpl_vars['ticket']['discountAmount'] > 0): ?>-<?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']['discountAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
 ₽<?php endif; ?></div>
                                <div class="col-6 col-md-2"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']['needAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
 ₽</div>
                                <div class="col-md-2"><?php if ($this->_tpl_vars['ticket']['status'] == 'STATUS_PAID'): ?><span class="badge badge-success">Оплачен</span><?php else: ?><span class="badge badge-danger">Не оплачен</span><?php endif; ?></div>
                            </div>
                            <?php $this->assign('count', $this->_tpl_vars['count']+1); ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php $_from = $this->_tpl_vars['this']['purchasedChildProducts'][$this->_tpl_vars['child_id']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
                            <?php $this->assign('total', $this->_tpl_vars['total']+$this->_tpl_vars['product']['needAmount']-$this->_tpl_vars['product']['payAmount']-$this->_tpl_vars['product']['ulAmount']+$this->_tpl_vars['product']['returnedAmount']-$this->_tpl_vars['product']['discountAmount']); ?>
                            <div class="row basket-row">
                                <div class="col-md-6"><span class="counter"><?php echo $this->_tpl_vars['count']; ?>
.</span> <span class="ticket-name"><?php echo $this->_tpl_vars['product']['productName']; ?>
</span></div>
                                <div class="col-6 col-md-2 discount-field"><?php if ($this->_tpl_vars['product']['discountAmount'] > 0): ?>-<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['discountAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
 ₽<?php endif; ?></div>
                                <div class="col-6 col-md-2"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['needAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
 ₽</div>
                                <div class="col-md-2">
                                    <?php if ($this->_tpl_vars['product']['status'] == 'STATUS_PAID'): ?><span class="badge badge-success">Оплачен</span><?php else: ?><span class="badge badge-danger">Не оплачен</span><?php endif; ?>
                                    <?php if ($this->_tpl_vars['product']['status'] == 'STATUS_NEW'): ?>
                                        <a href="<?php echo smarty_function_link(array('do' => 'delproduct','id' => $this->_tpl_vars['product']['id'],'extuser' => $this->_tpl_vars['child_id'],'mode' => 'existuser'), $this);?>
" title="<?php if ($this->_tpl_vars['lang'] == 'en'): ?>Remove<?php else: ?>Удалить<?php endif; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> <?php if ($this->_tpl_vars['lang'] == 'en'): ?>Remove<?php else: ?>Удалить<?php endif; ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php $this->assign('count', $this->_tpl_vars['count']+1); ?>
                        <?php endforeach; endif; unset($_from); ?>
                    </div>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </div>
            <?php if ($this->_tpl_vars['total']): ?>
                <div class="row register-total">
                    <div class="col-md-12">
                        <div class="desc">Общая сумма к оплате:</div>
                        <div class="total"><?php echo ((is_array($_tmp=$this->_tpl_vars['total'])) ? $this->_run_mod_handler('numberformat', true, $_tmp) : smarty_modifier_numberformat($_tmp)); ?>
&nbsp;₽</div>
                    </div>
                </div>
                <div class="row register-pay">
                    <div class="col-md-12">
                        <div class="basket-desc">Выберите способ оплаты:</div>
                        <div class="radiobox">
                            <div><input type="radio" name="pay" id="check1" checked> <label for="check1">Банковской картой</label></div>
                            <div><input type="radio" name="pay" id="check2"> <label for="check2">Выставить счет</label></div>
                            <div><input type="radio" name="pay" id="check3"> <label for="check3">Забронировать на <?php echo $this->_tpl_vars['this']['daysBron']; ?>
 дней</label></div>
<!--                            <div><input type="radio" name="pay" id="check3"> <label for="check3">Забронировать до 15 января</label></div>-->
                            <div><input type="radio" name="pay" id="check6"> <label for="check3">Купить в рассрочку</label></div>
                        </div>
                        <div class="ul-detail">
                            <div class="row">
                                <input type="hidden" name="company_type" value="<?php if ($this->_tpl_vars['this']['udmObj']->company_type): ?><?php echo $this->_tpl_vars['this']['udmObj']->company_type; ?>
<?php else: ?>3<?php endif; ?>">
                                <div class="col-md-12">
                                    <div class="basket-desc">Введите данные компании:</div>
                                    <div class="ul-group">
                                        <span><input type="radio" name="face" id="check4" checked> <label for="check4">ИП</label></span>
                                        <span><input type="radio" name="face" id="check5"> <label for="check5">ООО</label></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Company<?php else: ?>Наименование<?php endif; ?></label>
                                        <input class="form-control" autocomplete="off" id="company" name="company" type="text" value="<?php echo $this->_tpl_vars['this']['udmObj']->company; ?>
" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inn"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>INN<?php else: ?>ИНН<?php endif; ?></label>
                                        <input class="form-control" type="text" id="inn" name="inn" value="<?php echo $this->_tpl_vars['this']['udmObj']->inn; ?>
" maxlength="12" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <a href="#" id="invoice-pay" onclick="yaCounter28771811.reachGoal('vystavit-schet-korzina'); return true" class="btn btn-white">Выставить счёт</a>
                                </div>
                                <div class="col-md-12">
                                    <p class="oferta mt-4">Нажимая кнопку «Выставить счёт» Вы соглашаетесь с&nbsp;<a href="/oferta">договором-оферты</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="bron-btn">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="/booking" class="btn btn-white">Забронировать</a>
                                </div>
                            </div>
                        </div>
                        <div class="pay-card-btn">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="/index.php?do=payment&total=<?php echo $this->_tpl_vars['total']; ?>
&mode=alfa" class="btn btn-white" onclick="yaCounter28771811.reachGoal('oplatit-kartoj-korzina');return true">Оплатить картой</a>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" id="applePay"></button>
                                </div>
                                <div class="col-md-12">
                                    <p class="oferta mt-4">Нажимая кнопку «Оплатить картой» Вы соглашаетесь с&nbsp;<a href="/oferta">договором-оферты</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="installment-btn">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="https://loans.tinkoff.ru/api/partners/v1/lightweight/create" method="post">
                                        <input name="shopId" value="7760c05a-0238-4cbb-a3df-43d606b24954" type="hidden">
                                        <input name="showcaseId" value="1ebb478c-8dbf-4d11-922d-57837f23be48" type="hidden">
                                        <input name="sum" value="<?php echo $this->_tpl_vars['total']; ?>
" type="hidden">
                                        <input name="promoCode" value="installment_4" type="hidden">
                                        <input name="customerEmail" value="<?php echo $this->_tpl_vars['actor']->email; ?>
" type="hidden">
                                        <input name="customerPhone" value="<?php echo $this->_tpl_vars['actor']->phone; ?>
" type="hidden">
                                        <input type="submit" value="Купить в рассрочку" class="btn btn-white">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['total'] > 0 && $this->_tpl_vars['balance'] > 0): ?>
                <h4>Баланс: <?php echo ((is_array($_tmp=$this->_tpl_vars['balance'])) ? $this->_run_mod_handler('numberformat', true, $_tmp) : smarty_modifier_numberformat($_tmp)); ?>
 ₽</h4>
                <br/>
                <div class="pay-buttons">
                    <a href="#" class="btn btn-white" id="basket-balance-pay"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Pay from balance<?php else: ?>Оплатить с баланса<?php endif; ?></a>
                    <span class="pay-buttons-txt"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>or<?php else: ?>или<?php endif; ?></span>
                    <a href="#" class="btn btn-white" id="basket-balance-add"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Add balance<?php else: ?>Пополнить баланс<?php endif; ?></a>
                </div>
                <br/>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['this']['offPayBtn']): ?>
                <h4 class="total"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Total<?php else: ?>Итого<?php endif; ?>: <?php echo ((is_array($_tmp=$this->_tpl_vars['total'])) ? $this->_run_mod_handler('numberformat', true, $_tmp) : smarty_modifier_numberformat($_tmp)); ?>
 ₽</h4>
                <p class="alert alert-danger" style="margin-top: 15px;">Вы не можете оплатить билеты в Вашей корзине без промо-кода!</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    let debug               = true;
    let merchantIdentifier  = '<?php echo $this->_tpl_vars['this']['PRODUCTION_MERCHANTIDENTIFIER']; ?>
';
    let currencyCode        = '<?php echo $this->_tpl_vars['this']['PRODUCTION_CURRENCYCODE']; ?>
';
    let countryCode         = '<?php echo $this->_tpl_vars['this']['PRODUCTION_COUNTRYCODE']; ?>
';
    let label               = '<?php echo $this->_tpl_vars['this']['PRODUCTION_DISPLAYNAME']; ?>
';
    var runningAmount       = <?php echo $this->_tpl_vars['total']; ?>
;
    var orderNumber         = '';
    var subTotalDescr       = 'Оплата заказа';
</script>

<?php echo '
<script>
    if (window.ApplePaySession) {
        let promise = ApplePaySession.canMakePaymentsWithActiveCard(merchantIdentifier);
        promise.then(function (canMakePayments) {
            if (canMakePayments) {
                document.getElementById("applePay").style.display = "inline-block";
                logit(\'Hi, I can do ApplePay\');
            } else {
                logit(\'ApplePay is possible on this browser, but not currently activated.\');
            }
        });
    } else {
        logit(\'ApplePay is not available on this browser\');
    }

    document.getElementById("applePay").onclick = function(evt) {
        let runningPP		= 0;
        let runningTotal	= function() { return runningAmount + runningPP; }

        let promiseDB = sendPaymentDataToDB();
        promiseDB.then(function (success) {
            var status = \'STATUS_FAILURE\';
            if (success) {
                status = \'STATUS_SUCCESS\';
                runningAmount = success.amount;
                //runningAmount = 10;
                orderNumber = success.orderNumber;
                subTotalDescr = success.msg;
            }
            logit( "result of sendPaymentDataToDB() function =  " + status );
        });

        console.log(subTotalDescr);

        let paymentRequest = {
            currencyCode: currencyCode,
            countryCode: countryCode,
            lineItems: [{label: subTotalDescr, amount: runningAmount }],
            total: {
                label: label,
                amount: runningTotal()
            },
            supportedNetworks: [\'maestro\', \'visa\' ],
            merchantCapabilities: [ \'supports3DS\', \'supportsCredit\', \'supportsDebit\' ]
        };

        let session = new ApplePaySession(1, paymentRequest);
        // Merchant Validation
        session.onvalidatemerchant = function (event) {
            logit(event);
            let promise = performValidation(event.validationURL);
            promise.then(function (merchantSession) {
                session.completeMerchantValidation(merchantSession);
            });
        }

        function performValidation(valURL) {
            return new Promise(function(resolve, reject) {
                let xhr = new XMLHttpRequest();
                xhr.onload = function() {
                    let data = JSON.parse(this.responseText);
                    logit(data);
                    resolve(data);
                };
                xhr.onerror = reject;
                xhr.open(\'GET\', \'apple_pay_comm.php?u=\' + valURL);
                xhr.send();
            });
        }

        session.onpaymentmethodselected = function(event) {
            logit(\'starting session.onpaymentmethodselected\');
            logit(event);
            var newTotal = { type: \'final\', label: label, amount: runningTotal() };
            var newLineItems = [{type: \'final\',label: subTotalDescr, amount: runningAmount }];
            session.completePaymentMethodSelection( newTotal, newLineItems );
        }

        session.onpaymentauthorized = function (event) {
            logit(\'starting session.onpaymentauthorized\');
            logit(\'NB: This is the first stage when you get the *full shipping address* of the customer, in the event.payment.shippingContact object\');
            logit(event);
            let promise = sendPaymentToken(event.payment.token);
            promise.then(function (success) {
                var status;
                if (success) {
                    status = ApplePaySession.STATUS_SUCCESS;
                    document.getElementById("applePay").style.display = "none";
                    session.completePayment(status);
                    alert("Платеж выполнен. Данные обновятся в течение минуты.");
                } else {
                    status = ApplePaySession.STATUS_FAILURE;
                    session.completePayment(status);
                }
                logit( "result of sendPaymentToken() function =  " + success );
            });
        }

        function sendPaymentToken(paymentToken) {
            return new Promise(function(resolve, reject) {
                logit(\'starting function sendPaymentToken()\');
                logit(paymentToken);

                var xhr = new XMLHttpRequest();
                xhr.onerror = reject;
                var data = new FormData();
                paymentToken.orderNumber = orderNumber;
                paymentToken.desc = subTotalDescr;
                data.append("json", JSON.stringify(paymentToken));

                xhr.open(\'POST\', \'/apple_pay_alfa.php\', true);
                xhr.send(data);

                if ( debug == true ) {
                    resolve(true);
                } else {
                    reject;
                }
            });
        }

        function sendPaymentDataToDB() {
            return new Promise(function(resolve, reject) {
                let xhr = new XMLHttpRequest();
                xhr.onload = function() {
                    let data = JSON.parse(this.responseText);
                    logit(data);
                    resolve(data);
                };
                xhr.onerror = reject;
                xhr.open(\'GET\', \'/ajax?job=apple_pay\');
                xhr.send();
            });
        }

        session.oncancel = function(event) {
            logit(\'starting session.cancel\');
            logit(event);
        }
        session.begin();
    };

    function logit( data ) {
        if( debug == true ) {
            console.log(data);
        }
    };
</script>
'; ?>