<?php /* Smarty version 2.6.13, created on 2019-12-17 09:47:56
         compiled from /home/c484884/gastreet.com/www/app/Templates/Register2Control.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'getuserticket', '/home/c484884/gastreet.com/www/app/Templates/Register2Control.html', 24, false),array('modifier', 'getticket', '/home/c484884/gastreet.com/www/app/Templates/Register2Control.html', 82, false),array('modifier', 'numberprice', '/home/c484884/gastreet.com/www/app/Templates/Register2Control.html', 85, false),array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/Register2Control.html', 142, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['RegisterControl']); ?>

<div class="register-page page_body">
    <div class="row">
        <div class="col-md-12">
            <h1 class="header-title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Registration<?php else: ?>Регистрация<?php endif; ?></h1>
            <ul class="breadcrumbs-register">
                <li><a href="/register" class=""><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Step 1<?php else: ?>Шаг 1<?php endif; ?></a></li>
                <li><a href="/register?step=2" class="active"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Step 2<?php else: ?>Шаг 2<?php endif; ?></a></li>
                <li><a href="/register?step=3" class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Step 3<?php else: ?>Шаг 3<?php endif; ?></a></li>
                <li><a href="/register?step=4" class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Step 4<?php else: ?>Шаг 4<?php endif; ?></a></li>
                <li><a href="/register?step=5" class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Step 5<?php else: ?>Шаг 5<?php endif; ?></a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 page_body">
            <h3 class="header-title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Ticket selection<?php else: ?>Выбор билета<?php endif; ?></h3>
            <h4 class="form-title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>User Registration:<?php else: ?>Основной участник:<?php endif; ?></h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="form-control<?php if ($this->_tpl_vars['this']['user']->baseTicketId): ?> ticket_<?php echo $this->_tpl_vars['this']['user']->baseTicketId; ?>
<?php endif; ?>"><span><?php echo $this->_tpl_vars['this']['user']->name; ?>
 <?php echo $this->_tpl_vars['this']['user']->lastname; ?>
</span><a href="#" class="btn btn-link main-set-ticket" data-target=".user-modal-ticket" data-id="<?php echo ((is_array($_tmp=$this->_tpl_vars['this']['user']->id)) ? $this->_run_mod_handler('getuserticket', true, $_tmp) : smarty_modifier_getuserticket($_tmp)); ?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Choose a ticket<?php else: ?>Выбрать билет<?php endif; ?></a></div>
                    </div>
                </div>
            </div>

            <?php if ($this->_tpl_vars['this']['children']): ?>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="form-title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Additional members<?php else: ?>Дополнительные участники<?php endif; ?>:</h4>
                </div>
                <?php $_from = $this->_tpl_vars['this']['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['childid'] => $this->_tpl_vars['child']):
?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-control<?php if ($this->_tpl_vars['child']->baseTicketId): ?> ticket_<?php echo $this->_tpl_vars['child']->baseTicketId; ?>
<?php endif; ?>"><span><?php echo $this->_tpl_vars['child']->name; ?>
 <?php echo $this->_tpl_vars['child']->lastname; ?>
</span><a href="#" data-id="<?php echo ((is_array($_tmp=$this->_tpl_vars['child']->id)) ? $this->_run_mod_handler('getuserticket', true, $_tmp) : smarty_modifier_getuserticket($_tmp)); ?>
" data-extuser="<?php echo $this->_tpl_vars['child']->id; ?>
" data-target=".user-modal-ticket" class="btn btn-link child-set-ticket"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Choose a ticket<?php else: ?>Выбрать билет<?php endif; ?></a></div>
                        </div>
                    </div>

                <?php endforeach; endif; unset($_from); ?>
            </div>
            <?php endif; ?>

            <div class="row buttons<?php if ($this->_tpl_vars['this']['user']->email): ?> show<?php endif; ?>">
                <div class="col-md-6">
                    <a href="/register?step=3" class="btn btn-link"><i class="fa fa-arrow-right" aria-hidden="true"></i> <span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Next step<?php else: ?>Продолжить<?php endif; ?></span></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="information">
                <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                <?php else: ?>
                    <p class="title">ИНФОРМАЦИЯ</p>
                    <p>Сначала выбери тип билета для каждого участника. Внимательно прочитай описание каждого билета, чтобы выбрать подходящий для тебя и&nbsp;твоей команды.</p>
                    <p><u>Помни, что ты не сможешь отдельно докупить участие в&nbsp;мастер-классах. Тебе доступны только те события, которые входят в&nbsp;выбранный тобой билет.</u></p>
                    <p>Когда ты закончил, проверь еще раз и&nbsp;нажми кнопку «ПРОДОЛЖИТЬ».</p>
                <?php endif; ?>
            </div>
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
									<p style="font-size:16px;">Ты — избранный. И&nbsp;только тебе доступны специальные цены. До 31&nbsp;декабря.</p>
								</div>
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
"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Выбрать</a>
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
"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Выбрать</a>
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
"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Выбрать</a>
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
"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Выбрать</a>
										<?php endif; ?>
									</div>
								</div>
								<div class="col-md-12">
									<?php $this->assign('ticketId', 7); ?> <!-- УКАЗАТЬ ID БИЛЕТА «ПРОФИ» -->
									<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
									<div class="ticket ticket-profi" data-ri="<?php echo $this->_tpl_vars['ticketId']; ?>
">
										<h2 class="ticket_header"><div class="ticket-hit">Хит продаж</div><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></h2>
										<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
										<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
											<a href="#" class="btn btn-cart buy-ticket-click" data-extuser="" data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Выбрать</a>
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
" class="btn btn-cart">Подать заявку</a>
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
"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Выбрать</a>
										<?php endif; ?>
									</div>
								</div>
                            <?php elseif ($this->_tpl_vars['this']['gastreetpartner']): ?>
								<div class="col-md-12">
									<?php $this->assign('ticketId', 3); ?> <!-- УКАЗАТЬ ID БИЛЕТА «Профи» -->
									<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
									<div class="ticket ticket-profi" data-ri="<?php echo $this->_tpl_vars['ticketId']; ?>
">
										<h2 class="ticket_header"><div class="ticket-hit">Хит продаж</div><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></h2>
										<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
										<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
											<a href="#" class="btn btn-cart buy-ticket-click" data-extuser="" data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Выбрать</a>
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
"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Выбрать</a>
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
"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Выбрать</a>
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
"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Выбрать</a>
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
"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Выбрать</a>
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
"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Выбрать</a>
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
"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Выбрать</a>
										<?php endif; ?>
									</div>
								</div>
								<div class="col-md-12">
									<?php $this->assign('ticketId', 3); ?> <!-- УКАЗАТЬ ID БИЛЕТА «ПРОФИ» -->
									<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
									<div class="ticket ticket-profi" data-ri="<?php echo $this->_tpl_vars['ticketId']; ?>
">
										<h2 class="ticket_header"><div class="ticket-hit">Хит продаж</div><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></h2>
										<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
										<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
											<a href="#" class="btn btn-cart buy-ticket-click" data-extuser="" data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Выбрать</a>
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
" class="btn btn-cart">Подать заявку</a>
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
"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Выбрать</a>
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