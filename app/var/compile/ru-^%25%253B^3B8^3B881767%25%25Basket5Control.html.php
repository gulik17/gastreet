<?php /* Smarty version 2.6.13, created on 2019-12-05 12:07:02
         compiled from /home/c484884/gastreet.com/www/app/Templates/Basket5Control.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/Basket5Control.html', 55, false),)), $this); ?>
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

<div class="alert alert-info d-none" role="alert"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Hotel booking will be available January 15, 2018<?php else: ?>Бронирование отелей будет доступно 15 января 2018 года<?php endif; ?></div>

<div class="gss-basket register-page">
    <div class="row">
        <div class="col-md-12">
            <h3 class="header-title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Print the ticket<?php else: ?>Распечатать билет<?php endif; ?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 order-md-2">
            <div class="list-group tab-menu">
                <a href="/basket?q=2" class="list-group-item list-group-item-action"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Members<?php else: ?>Участники<?php endif; ?></a>
                <a href="/basket?q=3" class="list-group-item list-group-item-action"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Choose a main ticket<?php else: ?>Выбрать основной билет<?php endif; ?></a>
                <a href="/basket?q=4" class="list-group-item list-group-item-action d-none"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Choose additional options<?php else: ?>Выбрать доп. услуги<?php endif; ?></a>
                <a href="/basket" class="list-group-item list-group-item-action"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Pay<?php else: ?>Оплатить участие<?php endif; ?></a>
                <a href="/basket?q=5" class="list-group-item list-group-item-action active"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Print the ticket<?php else: ?>Распечатать билет<?php endif; ?></a>
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
        </div>
        <div class="col-md-8 page_body order-md-1">
            <h4 class="form-title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>User Registration:<?php else: ?>Основной участник:<?php endif; ?></h4>
            <div class="row">
                <div class="col-md-2">
                    <img class="qr-img" src="/qr/code.php?code=<?php echo $this->_tpl_vars['this']['qrmObj']->code; ?>
" />
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <div class="form-control"><span><?php echo $this->_tpl_vars['this']['user']->name; ?>
 <?php echo $this->_tpl_vars['this']['user']->lastname; ?>
</span></div>
                    </div>
                    <div class="mb-5">
                        <a class="btn btn-white" href="<?php echo smarty_function_link(array('do' => 'usergetbilet','id' => $this->_tpl_vars['this']['user']->id), $this);?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Ticket<?php else: ?>Билет<?php endif; ?></a>
                        <?php if ($this->_tpl_vars['this']['user']->baseTicketId != 1 && $this->_tpl_vars['this']['user']->baseTicketId != 14): ?>
                            <a class="btn btn-white d-none" href="<?php echo smarty_function_link(array('do' => 'usergethotelkupon'), $this);?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Accommodation coupon<?php else: ?>Купон на проживание<?php endif; ?></a>
                        <?php endif; ?>
                        <a class="btn btn-white d-none" href="/pdf/gastreet19_memo.pdf"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Memo<?php else: ?>Памятка<?php endif; ?></a>
                        <?php if ($this->_tpl_vars['this']['user']->baseTicketId != 1 && $this->_tpl_vars['this']['user']->baseTicketId != 14): ?>
                            <a class="btn btn-white d-none" href="<?php echo smarty_function_link(array('do' => 'usergetcert'), $this);?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Certificate of participant<?php else: ?>Сертификат участника<?php endif; ?></a>
                        <?php endif; ?>
                    </div> 
                </div>
            </div>

            <?php if ($this->_tpl_vars['this']['children']): ?>
            <div class="row mb-4">
                <div class="col-md-12">
                    <h4 class="form-title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Additional members<?php else: ?>Дополнительные участники<?php endif; ?>:</h4>
                </div>
                <?php $_from = $this->_tpl_vars['this']['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['child']):
?>
                    <?php $this->assign('childId', $this->_tpl_vars['child']->id); ?>
                    <div class="col-md-2">
                        <img class="qr-img" src="/qr/code.php?code=<?php echo $this->_tpl_vars['this']['qrList'][$this->_tpl_vars['childId']]; ?>
" />
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <div class="form-control"><span><?php echo $this->_tpl_vars['child']->name; ?>
 <?php echo $this->_tpl_vars['child']->lastname; ?>
</span></div>
                        </div>
                        <div class="mb-4">
                            <a class="btn btn-white" href="<?php echo smarty_function_link(array('do' => 'usergetbilet','id' => $this->_tpl_vars['child']->id), $this);?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Ticket<?php else: ?>Билет<?php endif; ?></a>
                            <?php if ($this->_tpl_vars['child']->baseTicketId != 1 && $this->_tpl_vars['child']->baseTicketId != 14 && $this->_tpl_vars['child']->baseTicketId): ?>
                                <a class="btn btn-white d-none" href="<?php echo smarty_function_link(array('do' => 'usergethotelkupon','id' => $this->_tpl_vars['child']->id), $this);?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Accommodation coupon<?php else: ?>Купон на проживание<?php endif; ?></a>
                            <?php endif; ?>
                            <a class="btn btn-white d-none" href="/pdf/gastreet19_memo.pdf"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Memo<?php else: ?>Памятка<?php endif; ?></a>
                            <?php if ($this->_tpl_vars['child']->baseTicketId != 1 && $this->_tpl_vars['child']->baseTicketId != 14 && $this->_tpl_vars['child']->baseTicketId): ?>
                                <a class="btn btn-white d-none" href="<?php echo smarty_function_link(array('do' => 'usergetcert','id' => $this->_tpl_vars['child']->id), $this);?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Certificate of participant<?php else: ?>Сертификат участника<?php endif; ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; endif; unset($_from); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>