<?php /* Smarty version 2.6.13, created on 2020-01-09 15:26:33
         compiled from /home/c484884/gastreet.com/www/app/Templates/Register5Control.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'round0', '/home/c484884/gastreet.com/www/app/Templates/Register5Control.html', 44, false),array('modifier', 'numberformat', '/home/c484884/gastreet.com/www/app/Templates/Register5Control.html', 110, false),array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/Register5Control.html', 59, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['RegisterControl']); ?>

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

<div class="register-page">
    <div class="row">
        <div class="col-md-12">
            <h1 class="header-title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Registration<?php else: ?>Регистрация<?php endif; ?></h1>
            <ul class="breadcrumbs-register">
                <li><a href="/register" class=""><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Step 1<?php else: ?>Шаг 1<?php endif; ?></a></li>
                <li><a href="/register?step=2" class=""><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Step 2<?php else: ?>Шаг 2<?php endif; ?></a></li>
                <li><a href="/register?step=3" class=""><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Step 3<?php else: ?>Шаг 3<?php endif; ?></a></li>
                <li><a href="/register?step=4" class=""><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Step 4<?php else: ?>Шаг 4<?php endif; ?></a></li>
                <li><a href="/register?step=5" class="active"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Step 5<?php else: ?>Шаг 5<?php endif; ?></a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <h3 class="header-title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Confirmation<?php else: ?>Подтверждение<?php endif; ?></h3>
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
                                <?php if ($this->_tpl_vars['product']['status'] == 'STATUS_PAID'): ?><span class="badge badge-success">Оплачен</span><?php else: ?><span class="badge badge-danger">Не оплачен</span><?php endif; ?>
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
" maxlength="12"/>
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
" class="btn btn-white" onclick="yaCounter28771811.reachGoal('oplatit-kartoj-korzina');return true">Оплатить картой</a>
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
        </div>
        <div class="col-md-4">
            <div class="information">
                <p class="title">ИНФОРМАЦИЯ</p>
                <p>Ты почти справился - это последний этап регистрации.</p>
                <p>Внимательно проверь все данные. Выбери способ оплаты. Все, что тебе осталось - оплатить билет.</p>
                <p>Имей ввиду, что ты можешь забронировать билет на 14&nbsp;дней за 1000 рублей.</p>
                <p>Счёт нужно оплатить в&nbsp;течении 7&nbsp;дней, в&nbsp;противном случае он аннулируется.</p>
                <p>Поздравляем, ты мужественно справился с&nbsp;регистрацией! Добро пожаловать на GASTREET'20!</p>
            </div>
            <?php if ($this->_tpl_vars['showWarning'] == 1): ?>
            <div class="information badge-danger mt-4">
                <p class="title">ВНИМАНИЕ!!!</p>
                <p><b>Обязательно</b> подтвердите почту участника, чтобы получать важные email уведомления и&nbsp;новости, в&nbsp;том числе билет на почту после оплаты.</p>
            </div>
            <?php endif; ?>
            <div class="list-group mb-5">
                <a href="/basket?q=6" class="list-group-item list-group-item-action"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Add promo-code<?php else: ?>Ввести промо-код<?php endif; ?></a>
            </div>
        </div>
    </div>
</div>