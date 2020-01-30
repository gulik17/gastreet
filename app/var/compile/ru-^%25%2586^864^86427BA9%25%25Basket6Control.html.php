<?php /* Smarty version 2.6.13, created on 2019-12-03 12:41:03
         compiled from /home/c484884/gastreet.com/www/app/Templates/Basket6Control.html */ ?>
<?php $this->assign('this', $this->_tpl_vars['BasketControl']); ?>
<?php $this->assign('total', 0); ?>
<?php $this->assign('balance', 0); ?>

<?php $this->assign('showBronButton', 0); ?>
<?php $this->assign('showBronProductButton', 0); ?>

<script type="text/javascript" src="https://www.googleadservices.com/pagead/conversion.js"></script>
<noscript>
    <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="https://www.googleadservices.com/pagead/conversion/869423439/?label=G4tVCLCX3G4Qz7LJngM&amp;guid=ON&amp;script=0"/>
    </div>
</noscript>

<div class="alert alert-info hidden" role="alert"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Hotel booking will be available January 15, 2018<?php else: ?>Бронирование отелей будет доступно 15 января 2018 года<?php endif; ?></div>

<div class="gss-basket register-page">
    <div class="row">
        <div class="col-md-9">
            <h3 class="header-title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Promo-code<?php else: ?>Промо-коды<?php endif; ?></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 order-md-2">
            <div class="list-group tab-menu">
                <a href="/basket?q=2" class="list-group-item list-group-item-action"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Members<?php else: ?>Участники<?php endif; ?></a>
                <a href="/basket?q=3" class="list-group-item list-group-item-action"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Choose a main ticket<?php else: ?>Выбрать основной билет<?php endif; ?></a>
                <a href="/basket?q=4" class="list-group-item list-group-item-action d-none"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Choose additional options<?php else: ?>Выбрать доп. услуги<?php endif; ?></a>
                <a href="/basket" class="list-group-item list-group-item-action"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Pay<?php else: ?>Оплатить участие<?php endif; ?></a>
                <a href="/basket?q=5" class="list-group-item list-group-item-action"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Print the ticket<?php else: ?>Распечатать билет<?php endif; ?></a>
                <a href="/basket?q=6" class="list-group-item list-group-item-action active"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Add promo-code<?php else: ?>Ввести промо-код<?php endif; ?></a>
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
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="form-title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>User Registration:<?php else: ?>Основной участник:<?php endif; ?></h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-control"><span><?php echo $this->_tpl_vars['this']['user']->name; ?>
 <?php echo $this->_tpl_vars['this']['user']->lastname; ?>
</span></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php if ($this->_tpl_vars['this']['user']->baseTicketId > 0 && $this->_tpl_vars['this']['user']->baseTicketStatus == 'STATUS_NEW' && $this->_tpl_vars['this']['user']->baseTicketDiscount == 0): ?>
                    <div class="gss-basket-promocode">
                        <div class="form-group">
                            <input class="form-control" autocomplete="off" id="discount-code-<?php echo $this->_tpl_vars['this']['user']->id; ?>
" placeholder="Есть промо-код?" type="text" maxlength="100">
                            <a href="#" class="discount-code-button" id="discount-code-button-<?php echo $this->_tpl_vars['this']['user']->id; ?>
">Применить</a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ($this->_tpl_vars['this']['children']): ?>
            <div class="row pt-4">
                <div class="col-md-12">
                    <h4 class="form-title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Additional members<?php else: ?>Дополнительные участники<?php endif; ?>:</h4>
                </div>
                <?php $_from = $this->_tpl_vars['this']['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['childid'] => $this->_tpl_vars['child']):
?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-control"><span><?php echo $this->_tpl_vars['child']->name; ?>
 <?php echo $this->_tpl_vars['child']->lastname; ?>
</span></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php if ($this->_tpl_vars['child']->baseTicketId > 0 && $this->_tpl_vars['child']->baseTicketStatus == 'STATUS_NEW' && $this->_tpl_vars['child']->baseTicketDiscount == 0): ?>
                        <div class="gss-basket-promocode">
                            <div class="form-group">
                                <input class="form-control" autocomplete="off" id="discount-code-<?php echo $this->_tpl_vars['child']->id; ?>
" type="text" placeholder="Есть промо-код?" maxlength="100">
                                <a href="#" class="discount-code-button" id="discount-code-button-<?php echo $this->_tpl_vars['child']->id; ?>
">Применить</a>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; endif; unset($_from); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>