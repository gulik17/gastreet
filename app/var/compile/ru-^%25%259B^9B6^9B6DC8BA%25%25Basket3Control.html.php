<?php /* Smarty version 2.6.13, created on 2019-12-16 16:15:48
         compiled from /home/c484884/gastreet.com/www/app/Templates/Basket3Control.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'getuserticket', '/home/c484884/gastreet.com/www/app/Templates/Basket3Control.html', 50, false),array('modifier', 'getticket', '/home/c484884/gastreet.com/www/app/Templates/Basket3Control.html', 87, false),array('modifier', 'numberprice', '/home/c484884/gastreet.com/www/app/Templates/Basket3Control.html', 90, false),array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/Basket3Control.html', 147, false),)), $this); ?>
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

<div class="gss-basket register-page page_body">
    <div class="row">
        <div class="col-md-12 page_body">
            <h3 class="header-title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Ticket selection<?php else: ?>Выбор билета<?php endif; ?></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 order-md-2">
            <div class="list-group tab-menu">
                <a href="/basket?q=2" class="list-group-item list-group-item-action"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Members<?php else: ?>Участники<?php endif; ?></a>
                <a href="/basket?q=3" class="list-group-item list-group-item-action active"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Choose a main ticket<?php else: ?>Выбрать основной билет<?php endif; ?></a>
                <a href="/basket?q=4" class="list-group-item list-group-item-action d-none"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Choose additional options<?php else: ?>Выбрать доп. услуги<?php endif; ?></a>
                <a href="/basket" class="list-group-item list-group-item-action"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Pay<?php else: ?>Оплатить участие<?php endif; ?></a>
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
        </div>
        <div class="col-md-8 page_body order-md-1">
            <h4 class="form-title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>User Registration:<?php else: ?>Основной участник:<?php endif; ?></h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="form-control<?php if ($this->_tpl_vars['this']['user']->baseTicketId): ?> ticket_<?php echo $this->_tpl_vars['this']['user']->baseTicketId; ?>
<?php endif; ?>"><span><?php echo $this->_tpl_vars['this']['user']->name; ?>
 <?php echo $this->_tpl_vars['this']['user']->lastname; ?>
</span><a href="#" class="btn btn-link main-set-ticket" data-id="<?php echo ((is_array($_tmp=$this->_tpl_vars['this']['user']->id)) ? $this->_run_mod_handler('getuserticket', true, $_tmp) : smarty_modifier_getuserticket($_tmp)); ?>
" data-target=".user-modal-ticket"><?php if ($this->_tpl_vars['this']['user']->baseTicketId): ?><?php echo $this->_tpl_vars['this']['user']->baseTicketName; ?>
<?php else: ?><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Choose a ticket<?php else: ?>Выбрать билет<?php endif; ?><?php endif; ?></a></div>
                    </div>
                </div>
            </div>

            <?php if ($this->_tpl_vars['this']['children']): ?>
            <div class="row pt-4">
                <div class="col-md-12">
                    <h4 class="form-title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Additional members<?php else: ?>Дополнительные участники<?php endif; ?>:</h4>
                </div>
                <?php $_from = $this->_tpl_vars['this']['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['child']):
?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-control<?php if ($this->_tpl_vars['child']->baseTicketId): ?> ticket_<?php echo $this->_tpl_vars['child']->baseTicketId; ?>
<?php endif; ?>"><span><?php echo $this->_tpl_vars['child']->name; ?>
 <?php echo $this->_tpl_vars['child']->lastname; ?>
</span><a href="#" data-id="<?php echo ((is_array($_tmp=$this->_tpl_vars['child']->id)) ? $this->_run_mod_handler('getuserticket', true, $_tmp) : smarty_modifier_getuserticket($_tmp)); ?>
" data-target=".user-modal-ticket" data-extuser="<?php echo $this->_tpl_vars['child']->id; ?>
" class="btn btn-link child-set-ticket"><?php if ($this->_tpl_vars['child']->baseTicketId): ?><?php echo $this->_tpl_vars['child']->baseTicketName; ?>
<?php else: ?><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Choose a ticket<?php else: ?>Выбрать билет<?php endif; ?><?php endif; ?></a></div>
                        </div>
                    </div>
                <?php endforeach; endif; unset($_from); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="modal fade user-modal-ticket" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Выберите билет</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <?php if ($this->_tpl_vars['this']['gastreetspecial']): ?>
								<div class="col-md-12">
									<?php $this->assign('ticketId', 1); ?> <!-- УКАЗАТЬ ID БИЛЕТА «СПУТНИК» -->
									<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
									<div class="ticket ticket-tourist" data-ri="<?php echo $this->_tpl_vars['ticketId']; ?>
">
										<h2 class="ticket_header"><span class="title_tourist"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></span></h2>
										<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
										<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
											<a href="#" class="btn btn-cart buy-ticket-click" data-extuser="" data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
										<?php endif; ?>
									</div>
								</div>
								<div class="col-md-12">
									<?php $this->assign('ticketId', 9); ?> <!-- УКАЗАТЬ ID БИЛЕТА «Barstreet» -->
									<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
									<div class="ticket ticket-barstreet" data-ri="<?php echo $this->_tpl_vars['ticketId']; ?>
">
										<h2 class="ticket_header"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></h2>
										<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
										<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
											<a href="#" class="btn btn-cart buy-ticket-click" data-extuser="" data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
										<?php endif; ?>
									</div>
								</div>
								<div class="col-md-12">
									<?php $this->assign('ticketId', 15); ?> <!-- УКАЗАТЬ ID БИЛЕТА «Host Street» -->
									<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
									<div class="ticket ticket-host" data-ri="<?php echo $this->_tpl_vars['ticketId']; ?>
">
										<h2 class="ticket_header"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></h2>
										<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
										<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
											<a href="#" class="btn btn-cart buy-ticket-click" data-extuser="" data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
										<?php endif; ?>
									</div>
								</div>
								<div class="col-md-12">
									<?php $this->assign('ticketId', 6); ?> <!-- УКАЗАТЬ ID БИЛЕТА «ШЕФСКИЙ» -->
									<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
									<div class="ticket ticket-chef" data-ri="<?php echo $this->_tpl_vars['ticketId']; ?>
">
										<h2 class="ticket_header"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></h2>
										<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
										<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
											<a href="#" class="btn btn-cart buy-ticket-click" data-extuser="" data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
										<?php endif; ?>
									</div>
								</div>
								<div class="col-md-12">
									<?php $this->assign('ticketId', 7); ?> <!-- УКАЗАТЬ ID БИЛЕТА «ПРОФИ» -->
									<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
									<div class="ticket ticket-profi" data-ri="<?php echo $this->_tpl_vars['ticketId']; ?>
">
										<h2 class="ticket_header"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></h2>
										<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
										<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
											<a href="#" class="btn btn-cart buy-ticket-click" data-extuser="" data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
										<?php endif; ?>
									</div>
								</div>
								<div class="col-md-12">
									<?php $this->assign('ticketId', 13); ?> <!-- УКАЗАТЬ ID БИЛЕТА «ReBro» -->
									<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
									<div class="ticket ticket-rebro" data-ri="<?php echo $this->_tpl_vars['ticketId']; ?>
">
										<h2 class="ticket_header"><img src="/images/rebro_green-logo.png"></h2>
										<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
										<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
											<a href="<?php echo smarty_function_link(array('do' => 'add','ticket' => 'rebro'), $this);?>
" class="btn btn-cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
										<?php endif; ?>
									</div>
								</div>
								<div class="col-md-12">
									<?php $this->assign('ticketId', 12); ?> <!-- УКАЗАТЬ ID БИЛЕТА «Как король» -->
									<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
									<div class="ticket ticket-king" data-ri="<?php echo $this->_tpl_vars['ticketId']; ?>
">
										<h2 class="ticket_header"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></h2>
										<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
										<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
											<a href="#" class="btn btn-cart buy-ticket-click" data-extuser="" data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
										<?php endif; ?>
									</div>
								</div>
                            <?php elseif ($this->_tpl_vars['this']['gastreetpartner']): ?>
								<div class="col-md-12">
									<?php $this->assign('ticketId', 3); ?> <!-- УКАЗАТЬ ID БИЛЕТА «Профи» -->
									<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
									<div class="ticket ticket-profi" data-ri="<?php echo $this->_tpl_vars['ticketId']; ?>
">
										<h2 class="ticket_header"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></h2>
										<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
										<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
											<a href="#" class="btn btn-cart buy-ticket-click" data-extuser="" data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
										<?php endif; ?>
									</div>
								</div>
								<div class="col-md-12">
									<?php $this->assign('ticketId', 12); ?> <!-- УКАЗАТЬ ID БИЛЕТА «Партнер» -->
									<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
									<div class="ticket" data-ri="<?php echo $this->_tpl_vars['ticketId']; ?>
">
										<h2 class="ticket_header"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></h2>
										<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
										<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
											<a href="#" class="btn btn-cart buy-ticket-click" data-extuser="" data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
										<?php endif; ?>
									</div>
								</div>
								<div class="col-md-12">
									<?php $this->assign('ticketId', 13); ?> <!-- УКАЗАТЬ ID БИЛЕТА «Staff» -->
									<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
									<div class="ticket" data-ri="<?php echo $this->_tpl_vars['ticketId']; ?>
">
										<h2 class="ticket_header"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></h2>
										<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
										<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
											<a href="#" class="btn btn-cart buy-ticket-click" data-extuser="" data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
										<?php endif; ?>
									</div>
								</div>
							<?php else: ?>
								<div class="col-md-12">
									<?php $this->assign('ticketId', 1); ?> <!-- УКАЗАТЬ ID БИЛЕТА «СПУТНИК» -->
									<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
									<div class="ticket ticket-tourist" data-ri="<?php echo $this->_tpl_vars['ticketId']; ?>
">
										<h2 class="ticket_header"><span class="title_tourist"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></span></h2>
										<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
										<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
											<a href="#" class="btn btn-cart buy-ticket-click" data-extuser="" data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
										<?php endif; ?>
									</div>
								</div>
								<div class="col-md-12">
									<?php $this->assign('ticketId', 4); ?> <!-- УКАЗАТЬ ID БИЛЕТА «Barstreet» -->
									<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
									<div class="ticket ticket-barstreet" data-ri="<?php echo $this->_tpl_vars['ticketId']; ?>
">
										<h2 class="ticket_header"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></h2>
										<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
										<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
											<a href="#" class="btn btn-cart buy-ticket-click" data-extuser="" data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
										<?php endif; ?>
									</div>
								</div>
								<div class="col-md-12">
									<?php $this->assign('ticketId', 10); ?> <!-- УКАЗАТЬ ID БИЛЕТА «Host street» -->
									<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
									<div class="ticket ticket-host" data-ri="<?php echo $this->_tpl_vars['ticketId']; ?>
">
										<h2 class="ticket_header"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></h2>
										<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
										<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
											<a href="#" class="btn btn-cart buy-ticket-click" data-extuser="" data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
										<?php endif; ?>
									</div>
								</div>
								<div class="col-md-12">
									<?php $this->assign('ticketId', 2); ?> <!-- УКАЗАТЬ ID БИЛЕТА «ШЕФСКИЙ» -->
									<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
									<div class="ticket ticket-chef" data-ri="<?php echo $this->_tpl_vars['ticketId']; ?>
">
										<h2 class="ticket_header"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></h2>
										<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
										<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
											<a href="#" class="btn btn-cart buy-ticket-click" data-extuser="" data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
										<?php endif; ?>
									</div>
								</div>
								<div class="col-md-12">
									<?php $this->assign('ticketId', 3); ?> <!-- УКАЗАТЬ ID БИЛЕТА «ПРОФИ» -->
									<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
									<div class="ticket ticket-profi" data-ri="<?php echo $this->_tpl_vars['ticketId']; ?>
">
										<h2 class="ticket_header"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></h2>
										<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
										<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
											<a href="#" class="btn btn-cart buy-ticket-click" data-extuser="" data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
										<?php endif; ?>
									</div>
								</div>
								<div class="col-md-12">
									<?php $this->assign('ticketId', 8); ?> <!-- УКАЗАТЬ ID БИЛЕТА «ReBro» -->
									<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
									<div class="ticket ticket-rebro" data-ri="<?php echo $this->_tpl_vars['ticketId']; ?>
">
										<h2 class="ticket_header"><img src="/images/rebro_green-logo.png"></h2>
										<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
										<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
											<a href="<?php echo smarty_function_link(array('do' => 'add','ticket' => 'rebro'), $this);?>
" class="btn btn-cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
										<?php endif; ?>
									</div>
								</div>
								<div class="col-md-12">
									<?php $this->assign('ticketId', 5); ?> <!-- УКАЗАТЬ ID БИЛЕТА «Как король» -->
									<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
									<div class="ticket ticket-king" data-ri="<?php echo $this->_tpl_vars['ticketId']; ?>
">
										<h2 class="ticket_header"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></h2>
										<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
										<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
											<a href="#" class="btn btn-cart buy-ticket-click" data-extuser="" data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
										<?php endif; ?>
									</div>
								</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>