<?php /* Smarty version 2.6.13, created on 2020-01-20 12:12:27
         compiled from /home/c484884/gastreet.com/www/app/Templates/UserticketControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'getticket', '/home/c484884/gastreet.com/www/app/Templates/UserticketControl.html', 6, false),array('modifier', 'numberprice', '/home/c484884/gastreet.com/www/app/Templates/UserticketControl.html', 8, false),array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/UserticketControl.html', 183, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['UserticketControl']); ?>

<?php if ($this->_tpl_vars['this']['gastreetpartner']): ?>
	<div class="ticket col-md-3">
		<?php $this->assign('ticketId', 3); ?> <!-- УКАЗАТЬ ID БИЛЕТА «Профи» -->
		<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
		<h2 class="ticket_header"><span class="title_blue"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></span></h2>
		<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
		<ul class="ticket_item">
			<li>Опции по данному билету уточняйте у своего менеджера</li>
		</ul>
		<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
		<div>
			<a href="#" class="btn btn-white btn-line buy-ticket-click" <?php if ($this->_tpl_vars['this']['child']->id > 0): ?>data-extuser="<?php echo $this->_tpl_vars['this']['child']->id; ?>
"<?php endif; ?> data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
">
				Купить
			</a>
		</div>
		<?php endif; ?>
		<div class="capacity<?php if ($this->_tpl_vars['ticket']->leftCount <= 0): ?> sold-out<?php endif; ?>">
			<span>
				<?php if ($this->_tpl_vars['lang'] == 'en'): ?>Available tickets:<?php else: ?>Доступно билетов:<?php endif; ?>
				<?php echo $this->_tpl_vars['ticket']->leftCount; ?>

			</span>
		</div>
	</div>
	<div class="ticket col-md-3">
		<?php $this->assign('ticketId', 12); ?> <!-- УКАЗАТЬ ID БИЛЕТА «Партнер» -->
		<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
		<h2 class="ticket_header"><span class="title_tourist"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></span></h2>
		<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
		<ul class="ticket_item">
			<li>Опции по данному билету уточняйте у своего менеджера</li>
		</ul>
		<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
		<div>
			<a href="#" class="btn btn-white btn-line buy-ticket-click" <?php if ($this->_tpl_vars['this']['child']->id > 0): ?>data-extuser="<?php echo $this->_tpl_vars['this']['child']->id; ?>
"<?php endif; ?> data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
">
				Купить
			</a>
		</div>
		<?php endif; ?>
		<div class="capacity<?php if ($this->_tpl_vars['ticket']->leftCount <= 0): ?> sold-out<?php endif; ?>">
			<span>
				<?php if ($this->_tpl_vars['lang'] == 'en'): ?>Available tickets:<?php else: ?>Доступно билетов:<?php endif; ?>
				<?php echo $this->_tpl_vars['ticket']->leftCount; ?>

			</span>
		</div>
	</div>
	<div class="ticket col-md-3">
		<?php $this->assign('ticketId', 13); ?> <!-- УКАЗАТЬ ID БИЛЕТА «Staff» -->
		<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
		<h2 class="ticket_header"><span class="title_tourist"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?></span></h2>
		<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
		<ul class="ticket_item">
			<li>Опции по данному билету уточняйте у своего менеджера</li>
		</ul>
		<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
		<div>
			<a href="#" class="btn btn-white btn-line buy-ticket-click" <?php if ($this->_tpl_vars['this']['child']->id > 0): ?>data-extuser="<?php echo $this->_tpl_vars['this']['child']->id; ?>
"<?php endif; ?> data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
">
				Купить
			</a>
		</div>
		<?php endif; ?>
		<div class="capacity<?php if ($this->_tpl_vars['ticket']->leftCount <= 0): ?> sold-out<?php endif; ?>">
			<span>
				<?php if ($this->_tpl_vars['lang'] == 'en'): ?>Available tickets:<?php else: ?>Доступно билетов:<?php endif; ?>
				<?php echo $this->_tpl_vars['ticket']->leftCount; ?>

			</span>
		</div>
	</div>
<?php elseif ($this->_tpl_vars['this']['gastreetspecial']): ?>
	<div class="col-md-2 ticket ticket-king">
		<?php $this->assign('ticketId', 12); ?>
		<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?> <!-- УКАЗАТЬ ID БИЛЕТА «КАК КОРОЛЬ» -->
		<h2 class="ticket_header">
			<?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?>
			<p>Могу себе позволить!</p>
		</h2>
		<p class="ticket_special">Цена для тебя</p>
		<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
		<p class="ticket_new_cost">Цена для других 180000&nbsp;₽</p>
		<p class="ticket_vigoda">Выгода 10000 ₽</p>
		<hr>
		<a class="icollapse_more" data-toggle="collapse" href="#collapse<?php echo $this->_tpl_vars['ticketId']; ?>
" aria-expanded="false" aria-controls="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">Что входит в билет? <i class="fa fa-caret-down" aria-hidden="true"></i></a>
		<div class="collapse" id="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">
			<p class="ticket_desc"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The ticket includes:<?php else: ?>В билет входит:<?php endif; ?></p>
			<ul class="ticket_item">
				<li class="li_title">ОБУЧЕНИЕ</li>
				<li>#REBRO</li>
				<li>#MAINSTREET</li>
				<li>#БИЗНЕСШКОЛА</li>
				<li>#CHEFSTREET</li>
				<li>#BARSTREET</li>
				<li>#HOSTSTREET</li>
				<li>#ЦЕНТРАЛЬНАЯПЛОЩАДЬ</li>
				<li>#FUCKUP</li>
				<li>#BARISTASTREET</li>
				<li>#ITТЕХНОЛОГИИ</li>
				<li>#FRANCHISESTREET</li>
				<li>#ШКОЛАСОМЕЛЬЕ</li>
				<li>#ЗОЖ</li>
				<li class="li_title">ОБЩЕНИЕ</li>
				<li>#FOODMARKET</li>
				<li>#BBQBEERSTREET</li>
				<li>#ЗОЖ</li>
				<li>#НОЧНОЕBBQ</li>
				<li>#КОНЦЕРТЫ</li>
				<li>#ВЕЧЕРИНКИ</li>
				<li>POP-UP SHOW</li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The best suppliers<?php else: ?>Лучшие поставщики<?php endif; ?></li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Accommodation in hotel 5 *<?php else: ?>Проживание в отеле 5* (5&nbsp;ночей)<?php endif; ?></li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Dedicated VIP-hotline<?php else: ?>Выделенная телефонная VIP-линия поддержки<?php endif; ?></li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own restaurant<?php else: ?>Собственный ресторан<?php endif; ?></li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own bar<?php else: ?>Собственный бар<?php endif; ?></li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Closed parties with speakers<?php else: ?>Закрытые тусовки со спикерами<?php endif; ?></li>
			</ul>
		</div>
		<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
		<div>
			<a href="#" class="btn btn-white btn-line buy-ticket-click" <?php if ($this->_tpl_vars['this']['child']->id > 0): ?>data-extuser="<?php echo $this->_tpl_vars['this']['child']->id; ?>
"<?php endif; ?> data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
">
				Купить
			</a>
		</div>
		<?php endif; ?>
		<div class="capacity<?php if ($this->_tpl_vars['ticket']->leftCount <= 0): ?> sold-out<?php endif; ?>">
			<span>
				<?php if ($this->_tpl_vars['lang'] == 'en'): ?>Available tickets:<?php else: ?>Доступно билетов:<?php endif; ?>
				<?php echo $this->_tpl_vars['ticket']->leftCount; ?>

			</span>
		</div>
	</div>
	<div class="col-md-2 ticket ticket-rebro">
		<?php $this->assign('ticketId', 13); ?>
		<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?> <!-- УКАЗАТЬ ID БИЛЕТА «Ребро» -->
		<h2 class="ticket_header">
			<img src="/images/rebro_green-logo.png">
			<p>Для владельцев<br>
				бизнеса ONLY</p>
		</h2>
		<p class="ticket_special">Цена для тебя</p>
		<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
		<p class="ticket_new_cost">Цена для других 60000&nbsp;₽</p>
		<p class="ticket_vigoda" style="color: #b0cb1f">Выгода 10000 ₽</p>
		<hr>
		<a class="icollapse_more" data-toggle="collapse" href="#collapse<?php echo $this->_tpl_vars['ticketId']; ?>
" aria-expanded="false" aria-controls="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">Что входит в билет? <i class="fa fa-caret-down" aria-hidden="true"></i></a>
		<div class="collapse" id="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">
			<p class="ticket_desc"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The ticket includes:<?php else: ?>В билет входит:<?php endif; ?></p>
			<ul class="ticket_item">
				<li class="li_title">ОБУЧЕНИЕ</li>
				<li>#REBRO</li>
				<li>#MAINSTREET</li>
				<li class="disabled">#БИЗНЕСШКОЛА</li>
				<li>#CHEFSTREET</li>
				<li>#BARSTREET</li>
				<li>#HOSTSTREET</li>
				<li>#ЦЕНТРАЛЬНАЯПЛОЩАДЬ</li>
				<li>#FUCKUP</li>
				<li>#BARISTASTREET</li>
				<li>#ITТЕХНОЛОГИИ</li>
				<li>#FRANCHISESTREET</li>
				<li>#ШКОЛАСОМЕЛЬЕ</li>
				<li>#ЗОЖ</li>
				<li class="li_title">ОБЩЕНИЕ</li>
				<li>#FOODMARKET</li>
				<li>#BBQBEERSTREET</li>
				<li>#ЗОЖ</li>
				<li>#НОЧНОЕBBQ</li>
				<li>#КОНЦЕРТЫ</li>
				<li>#ВЕЧЕРИНКИ</li>
				<li class="disabled">POP-UP SHOW</li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The best suppliers<?php else: ?>Лучшие поставщики<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Accommodation in hotel 5 *<?php else: ?>Проживание в отеле 5* (5&nbsp;ночей)<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Dedicated VIP-hotline<?php else: ?>Выделенная телефонная VIP-линия поддержки<?php endif; ?></li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own restaurant<?php else: ?>Собственный ресторан<?php endif; ?></li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own bar<?php else: ?>Собственный бар<?php endif; ?></li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Closed parties with speakers<?php else: ?>Закрытые тусовки со спикерами<?php endif; ?></li>
			</ul>
		</div>
		<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
			<?php if ($this->_tpl_vars['this']['child']->wantRebro == 1 || $this->_tpl_vars['ticket']->wantRebro == 1): ?>
				<div class="capacity"><span>Мы приняли вашу заявку!</span></div>
			<?php else: ?>
			<div>
				<a href="<?php echo smarty_function_link(array('do' => 'add','ticket' => 'rebro'), $this);?>
" class="btn btn-white btn-line">
					<?php if ($this->_tpl_vars['lang'] == 'en'): ?>Submit your application<?php else: ?>Подать заявку<?php endif; ?>
				</a>
			</div>
			<?php endif; ?>
		<?php endif; ?>
		<div class="capacity<?php if ($this->_tpl_vars['ticket']->leftCount <= 0): ?> sold-out<?php endif; ?>">
			<span>
				<?php if ($this->_tpl_vars['lang'] == 'en'): ?>Available tickets:<?php else: ?>Доступно билетов:<?php endif; ?>
				<?php echo $this->_tpl_vars['ticket']->leftCount; ?>

			</span>
		</div>
	</div>
	<div class="col-md-2 ticket ticket-profi">
		<?php $this->assign('ticketId', 7); ?> <!-- УКАЗАТЬ ID БИЛЕТА «ПРОФИ» -->
		<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
		<h2 class="ticket_header">
			<div class="ticket-hit">Хит продаж</div>
			<?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?>
			<p>Оптимальный<br>
				вариант, роднуль</p>
		</h2>
		<p class="ticket_special">Цена для тебя</p>
		<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
		<p class="ticket_new_cost">Цена для других 35000&nbsp;₽</p>
		<p class="ticket_vigoda">Выгода 5000 ₽</p>
		<hr>
		<a class="icollapse_more" data-toggle="collapse" href="#collapse<?php echo $this->_tpl_vars['ticketId']; ?>
" aria-expanded="false" aria-controls="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">Что входит в билет? <i class="fa fa-caret-down" aria-hidden="true"></i></a>
		<div class="collapse" id="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">
			<p class="ticket_desc"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The ticket includes:<?php else: ?>В билет входит:<?php endif; ?></p>
			<ul class="ticket_item">
				<li class="li_title">ОБУЧЕНИЕ</li>
				<li class="disabled">#REBRO</li>
				<li>#MAINSTREET</li>
				<li class="disabled">#БИЗНЕСШКОЛА</li>
				<li>#CHEFSTREET</li>
				<li>#BARSTREET</li>
				<li>#HOSTSTREET</li>
				<li>#ЦЕНТРАЛЬНАЯПЛОЩАДЬ</li>
				<li>#FUCKUP</li>
				<li>#BARISTASTREET</li>
				<li>#ITТЕХНОЛОГИИ</li>
				<li>#FRANCHISESTREET</li>
				<li>#ШКОЛАСОМЕЛЬЕ</li>
				<li>#ЗОЖ</li>
				<li class="li_title">ОБЩЕНИЕ</li>
				<li>#FOODMARKET</li>
				<li>#BBQBEERSTREET</li>
				<li>#ЗОЖ</li>
				<li>#НОЧНОЕBBQ</li>
				<li>#КОНЦЕРТЫ</li>
				<li>#ВЕЧЕРИНКИ</li>
				<li class="disabled">POP-UP SHOW</li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The best suppliers<?php else: ?>Лучшие поставщики<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Accommodation in hotel 5 *<?php else: ?>Проживание в отеле 5* (5&nbsp;ночей)<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Dedicated VIP-hotline<?php else: ?>Выделенная телефонная VIP-линия поддержки<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own restaurant<?php else: ?>Собственный ресторан<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own bar<?php else: ?>Собственный бар<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Closed parties with speakers<?php else: ?>Закрытые тусовки со спикерами<?php endif; ?></li>
			</ul>
		</div>
		<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
		<div>
			<a href="#" class="btn btn-white btn-line buy-ticket-click" <?php if ($this->_tpl_vars['this']['child']->id > 0): ?>data-extuser="<?php echo $this->_tpl_vars['this']['child']->id; ?>
"<?php endif; ?> data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
">
				Купить
			</a>
		</div>
		<?php endif; ?>
		<div class="capacity<?php if ($this->_tpl_vars['ticket']->leftCount <= 0): ?> sold-out<?php endif; ?>">
			<span>
				<?php if ($this->_tpl_vars['lang'] == 'en'): ?>Available tickets:<?php else: ?>Доступно билетов:<?php endif; ?>
				<?php echo $this->_tpl_vars['ticket']->leftCount; ?>

			</span>
		</div>
	</div>
	<div class="col-md-2 ticket ticket-chef">
		<?php $this->assign('ticketId', 6); ?> <!-- УКАЗАТЬ ID БИЛЕТА «ШЕФСКИЙ» -->
		<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
		<h2 class="ticket_header">
			<?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?>
			<p>Для будущих<br>
				и настоящих шефов</p>
		</h2>
		<p class="ticket_special">Цена для тебя</p>
		<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
		<p class="ticket_new_cost">Цена для других 30000&nbsp;₽</p>
		<p class="ticket_vigoda">Выгода 5000 ₽</p>
		<hr>
		<a class="icollapse_more" data-toggle="collapse" href="#collapse<?php echo $this->_tpl_vars['ticketId']; ?>
" aria-expanded="false" aria-controls="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">Что входит в билет? <i class="fa fa-caret-down" aria-hidden="true"></i></a>
		<div class="collapse" id="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">
			<p class="ticket_desc"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The ticket includes:<?php else: ?>В билет входит:<?php endif; ?></p>
			<ul class="ticket_item">
				<li class="li_title">ОБУЧЕНИЕ</li>
				<li class="disabled">#REBRO</li>
				<li class="disabled">#MAINSTREET</li>
				<li class="disabled">#БИЗНЕСШКОЛА</li>
				<li>#CHEFSTREET</li>
				<li class="disabled">#BARSTREET</li>
				<li class="disabled">#HOSTSTREET</li>
				<li>#ЦЕНТРАЛЬНАЯПЛОЩАДЬ</li>
				<li>#FUCKUP</li>
				<li>#BARISTASTREET</li>
				<li>#ITТЕХНОЛОГИИ</li>
				<li>#FRANCHISESTREET</li>
				<li>#ШКОЛАСОМЕЛЬЕ</li>
				<li>#ЗОЖ</li>
				<li class="li_title">ОБЩЕНИЕ</li>
				<li>#FOODMARKET</li>
				<li>#BBQBEERSTREET</li>
				<li>#ЗОЖ</li>
				<li>#НОЧНОЕBBQ</li>
				<li>#КОНЦЕРТЫ</li>
				<li>#ВЕЧЕРИНКИ</li>
				<li class="disabled">POP-UP SHOW</li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The best suppliers<?php else: ?>Лучшие поставщики<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Accommodation in hotel 5 *<?php else: ?>Проживание в отеле 5* (5&nbsp;ночей)<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Dedicated VIP-hotline<?php else: ?>Выделенная телефонная VIP-линия поддержки<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own restaurant<?php else: ?>Собственный ресторан<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own bar<?php else: ?>Собственный бар<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Closed parties with speakers<?php else: ?>Закрытые тусовки со спикерами<?php endif; ?></li>
			</ul>
		</div>
		<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
		<div>
			<a href="#" class="btn btn-white btn-line buy-ticket-click" <?php if ($this->_tpl_vars['this']['child']->id > 0): ?>data-extuser="<?php echo $this->_tpl_vars['this']['child']->id; ?>
"<?php endif; ?> data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
">
				Купить
			</a>
		</div>
		<?php endif; ?>
		<div class="capacity<?php if ($this->_tpl_vars['ticket']->leftCount <= 0): ?> sold-out<?php endif; ?>">
			<span>
				<?php if ($this->_tpl_vars['lang'] == 'en'): ?>Available tickets:<?php else: ?>Доступно билетов:<?php endif; ?>
				<?php echo $this->_tpl_vars['ticket']->leftCount; ?>

			</span>
		</div>
	</div>
	<div class="col-md-2 ticket ticket-barstreet">
		<?php $this->assign('ticketId', 9); ?> <!-- УКАЗАТЬ ID БИЛЕТА «БАРСТРИТ» -->
		<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
		<h2 class="ticket_header">
			<?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?>
			<p>Для тех, кто<br>
				с баром и за баром</p>
		</h2>
		<p class="ticket_special">Цена для тебя</p>
		<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
		<p class="ticket_new_cost">Цена для других 20000&nbsp;₽</p>
		<p class="ticket_vigoda">Выгода 5000 ₽</p>
		<hr>
		<a class="icollapse_more" data-toggle="collapse" href="#collapse<?php echo $this->_tpl_vars['ticketId']; ?>
" aria-expanded="false" aria-controls="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">Что входит в билет? <i class="fa fa-caret-down" aria-hidden="true"></i></a>
		<div class="collapse" id="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">
			<p class="ticket_desc"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The ticket includes:<?php else: ?>В билет входит:<?php endif; ?></p>
			<ul class="ticket_item">
				<li class="li_title">ОБУЧЕНИЕ</li>
				<li class="disabled">#REBRO</li>
				<li class="disabled">#MAINSTREET</li>
				<li class="disabled">#БИЗНЕСШКОЛА</li>
				<li class="disabled">#CHEFSTREET</li>
				<li>#BARSTREET</li>
				<li class="disabled">#HOSTSTREET</li>
				<li>#ЦЕНТРАЛЬНАЯПЛОЩАДЬ</li>
				<li>#FUCKUP</li>
				<li>#BARISTASTREET</li>
				<li>#ITТЕХНОЛОГИИ</li>
				<li>#FRANCHISESTREET</li>
				<li>#ШКОЛАСОМЕЛЬЕ</li>
				<li>#ЗОЖ</li>
				<li class="li_title">ОБЩЕНИЕ</li>
				<li>#FOODMARKET</li>
				<li>#BBQBEERSTREET</li>
				<li>#ЗОЖ</li>
				<li>#НОЧНОЕBBQ</li>
				<li>#КОНЦЕРТЫ</li>
				<li>#ВЕЧЕРИНКИ</li>
				<li class="disabled">POP-UP SHOW</li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The best suppliers<?php else: ?>Лучшие поставщики<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Accommodation in hotel 5 *<?php else: ?>Проживание в отеле 5* (5&nbsp;ночей)<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Dedicated VIP-hotline<?php else: ?>Выделенная телефонная VIP-линия поддержки<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own restaurant<?php else: ?>Собственный ресторан<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own bar<?php else: ?>Собственный бар<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Closed parties with speakers<?php else: ?>Закрытые тусовки со спикерами<?php endif; ?></li>
			</ul>
		</div>
		<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
		<div>
			<a href="#" class="btn btn-white btn-line buy-ticket-click" <?php if ($this->_tpl_vars['this']['child']->id > 0): ?>data-extuser="<?php echo $this->_tpl_vars['this']['child']->id; ?>
"<?php endif; ?> data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
">
				Купить
			</a>
		</div>
		<?php endif; ?>
		<div class="capacity<?php if ($this->_tpl_vars['ticket']->leftCount <= 0): ?> sold-out<?php endif; ?>">
			<span>
				<?php if ($this->_tpl_vars['lang'] == 'en'): ?>Available tickets:<?php else: ?>Доступно билетов:<?php endif; ?>
				<?php echo $this->_tpl_vars['ticket']->leftCount; ?>

			</span>
		</div>
	</div>
	<div class="col-md-2 ticket ticket-host">
		<?php $this->assign('ticketId', 15); ?> <!-- УКАЗАТЬ ID БИЛЕТА «HOSTSTREET» -->
		<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
		<h2 class="ticket_header">
			<?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?>
			<p>Отельерам<br>
				будет полезно</p>
		</h2>
		<p class="ticket_special">Цена для тебя</p>
		<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
		<p class="ticket_new_cost">Цена для других 20000&nbsp;₽</p>
		<p class="ticket_vigoda" style="color:#e51a4b">Выгода 5000 ₽</p>
		<hr>
		<a class="icollapse_more" data-toggle="collapse" href="#collapse<?php echo $this->_tpl_vars['ticketId']; ?>
" aria-expanded="false" aria-controls="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">Что входит в билет? <i class="fa fa-caret-down" aria-hidden="true"></i></a>
		<div class="collapse" id="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">
			<p class="ticket_desc"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The ticket includes:<?php else: ?>В билет входит:<?php endif; ?></p>
			<ul class="ticket_item">
				<li class="li_title">ОБУЧЕНИЕ</li>
				<li class="disabled">#REBRO</li>
				<li class="disabled">#MAINSTREET</li>
				<li class="disabled">#БИЗНЕСШКОЛА</li>
				<li class="disabled">#CHEFSTREET</li>
				<li class="disabled">#BARSTREET</li>
				<li>#HOSTSTREET</li>
				<li>#ЦЕНТРАЛЬНАЯПЛОЩАДЬ</li>
				<li>#FUCKUP</li>
				<li>#BARISTASTREET</li>
				<li>#ITТЕХНОЛОГИИ</li>
				<li>#FRANCHISESTREET</li>
				<li>#ШКОЛАСОМЕЛЬЕ</li>
				<li>#ЗОЖ</li>
				<li class="li_title">ОБЩЕНИЕ</li>
				<li>#FOODMARKET</li>
				<li>#BBQBEERSTREET</li>
				<li>#ЗОЖ</li>
				<li>#НОЧНОЕBBQ</li>
				<li>#КОНЦЕРТЫ</li>
				<li>#ВЕЧЕРИНКИ</li>
				<li class="disabled">POP-UP SHOW</li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The best suppliers<?php else: ?>Лучшие поставщики<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Accommodation in hotel 5 *<?php else: ?>Проживание в отеле 5* (5&nbsp;ночей)<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Dedicated VIP-hotline<?php else: ?>Выделенная телефонная VIP-линия поддержки<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own restaurant<?php else: ?>Собственный ресторан<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own bar<?php else: ?>Собственный бар<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Closed parties with speakers<?php else: ?>Закрытые тусовки со спикерами<?php endif; ?></li>
			</ul>
		</div>
		<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
		<div>
			<a href="#" class="btn btn-white btn-line buy-ticket-click" <?php if ($this->_tpl_vars['this']['child']->id > 0): ?>data-extuser="<?php echo $this->_tpl_vars['this']['child']->id; ?>
"<?php endif; ?> data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
">
				Купить
			</a>
		</div>
		<?php endif; ?>
		<div class="capacity<?php if ($this->_tpl_vars['ticket']->leftCount <= 0): ?> sold-out<?php endif; ?>">
			<span>
				<?php if ($this->_tpl_vars['lang'] == 'en'): ?>Available tickets:<?php else: ?>Доступно билетов:<?php endif; ?>
				<?php echo $this->_tpl_vars['ticket']->leftCount; ?>

			</span>
		</div>
	</div>
<?php else: ?>
	<div class="col-md-2 ticket ticket-king">
		<?php $this->assign('ticketId', 5); ?>
		<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?> <!-- УКАЗАТЬ ID БИЛЕТА «КАК КОРОЛЬ» -->
		<h2 class="ticket_header">
			<?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?>
			<p>Могу себе позволить!</p>
		</h2>
		<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
		<p class="ticket_new_cost">190&nbsp;000&nbsp;₽ с&nbsp;01.03.2020<br>
									200&nbsp;000&nbsp;₽ с&nbsp;01.05.2020</p>
		<a class="icollapse_more" data-toggle="collapse" href="#collapse<?php echo $this->_tpl_vars['ticketId']; ?>
" aria-expanded="false" aria-controls="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">Что входит в билет? <i class="fa fa-caret-down" aria-hidden="true"></i></a>
		<div class="collapse" id="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">
			<p class="ticket_desc"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The ticket includes:<?php else: ?>В билет входит:<?php endif; ?></p>
			<ul class="ticket_item">
				<li class="li_title">ОБУЧЕНИЕ</li>
				<li>#REBRO</li>
				<li>#MAINSTREET</li>
				<li>#БИЗНЕСШКОЛА</li>
				<li>#CHEFSTREET</li>
				<li>#BARSTREET</li>
				<li>#HOSTSTREET</li>
				<li>#ЦЕНТРАЛЬНАЯПЛОЩАДЬ</li>
				<li>#FUCKUP</li>
				<li>#BARISTASTREET</li>
				<li>#ITТЕХНОЛОГИИ</li>
				<li>#FRANCHISESTREET</li>
				<li>#ШКОЛАСОМЕЛЬЕ</li>
				<li>#ЗОЖ</li>
				<li class="li_title">ОБЩЕНИЕ</li>
				<li>#FOODMARKET</li>
				<li>#BBQBEERSTREET</li>
				<li>#ЗОЖ</li>
				<li>#НОЧНОЕBBQ</li>
				<li>#КОНЦЕРТЫ</li>
				<li>#ВЕЧЕРИНКИ</li>
				<li>POP-UP SHOW</li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The best suppliers<?php else: ?>Лучшие поставщики<?php endif; ?></li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Accommodation in hotel 5 *<?php else: ?>Проживание в отеле 5* (5&nbsp;ночей)<?php endif; ?></li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Dedicated VIP-hotline<?php else: ?>Выделенная телефонная VIP-линия поддержки<?php endif; ?></li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own restaurant<?php else: ?>Собственный ресторан<?php endif; ?></li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own bar<?php else: ?>Собственный бар<?php endif; ?></li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Closed parties with speakers<?php else: ?>Закрытые тусовки со спикерами<?php endif; ?></li>
			</ul>
		</div>
		<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
			<div>
				<a href="#" class="btn btn-white btn-line buy-ticket-click" <?php if ($this->_tpl_vars['this']['child']->id > 0): ?>data-extuser="<?php echo $this->_tpl_vars['this']['child']->id; ?>
"<?php endif; ?> data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
">
					Купить
				</a>
			</div>
		<?php endif; ?>
		<div class="tinkoff-credit">
			<a href="#" data-toggle="modal" data-target="#tinkoffModal">Купить в рассрочку</a>
		</div>
		<div class="capacity<?php if ($this->_tpl_vars['ticket']->leftCount <= 0): ?> sold-out<?php endif; ?>">
			<span>
				<?php if ($this->_tpl_vars['lang'] == 'en'): ?>Available tickets:<?php else: ?>Доступно билетов:<?php endif; ?>
				<?php echo $this->_tpl_vars['ticket']->leftCount; ?>

			</span>
		</div>
	</div>
	<div class="col-md-2 ticket ticket-rebro">
		<?php $this->assign('ticketId', 8); ?>
		<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?> <!-- УКАЗАТЬ ID БИЛЕТА «Ребро» -->
		<h2 class="ticket_header">
			<img src="/images/rebro_green-logo.png" alt="ReBro">
			<p>Для владельцев<br>
				бизнеса ONLY</p>
		</h2>
		<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
		<p class="ticket_new_cost">65&nbsp;000&nbsp;₽ с&nbsp;01.03.2020<br>
									70&nbsp;000&nbsp;₽ с&nbsp;01.05.2020</p>
		<a class="icollapse_more" data-toggle="collapse" href="#collapse<?php echo $this->_tpl_vars['ticketId']; ?>
" aria-expanded="false" aria-controls="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">Что входит в билет? <i class="fa fa-caret-down" aria-hidden="true"></i></a>
		<div class="collapse" id="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">
			<p class="ticket_desc"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The ticket includes:<?php else: ?>В билет входит:<?php endif; ?></p>
			<ul class="ticket_item">
				<li class="li_title">ОБУЧЕНИЕ</li>
				<li>#REBRO</li>
				<li>#MAINSTREET</li>
				<li class="disabled">#БИЗНЕСШКОЛА</li>
				<li>#CHEFSTREET</li>
				<li>#BARSTREET</li>
				<li>#HOSTSTREET</li>
				<li>#ЦЕНТРАЛЬНАЯПЛОЩАДЬ</li>
				<li>#FUCKUP</li>
				<li>#BARISTASTREET</li>
				<li>#ITТЕХНОЛОГИИ</li>
				<li>#FRANCHISESTREET</li>
				<li>#ШКОЛАСОМЕЛЬЕ</li>
				<li>#ЗОЖ</li>
				<li class="li_title">ОБЩЕНИЕ</li>
				<li>#FOODMARKET</li>
				<li>#BBQBEERSTREET</li>
				<li>#ЗОЖ</li>
				<li>#НОЧНОЕBBQ</li>
				<li>#КОНЦЕРТЫ</li>
				<li>#ВЕЧЕРИНКИ</li>
				<li class="disabled">POP-UP SHOW</li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The best suppliers<?php else: ?>Лучшие поставщики<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Accommodation in hotel 5 *<?php else: ?>Проживание в отеле 5* (5&nbsp;ночей)<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Dedicated VIP-hotline<?php else: ?>Выделенная телефонная VIP-линия поддержки<?php endif; ?></li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own restaurant<?php else: ?>Собственный ресторан<?php endif; ?></li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own bar<?php else: ?>Собственный бар<?php endif; ?></li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Closed parties with speakers<?php else: ?>Закрытые тусовки со спикерами<?php endif; ?></li>
			</ul>
		</div>
		<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
			<?php if ($this->_tpl_vars['this']['child']->wantRebro == 1 || $this->_tpl_vars['ticket']->wantRebro == 1): ?>
				<div class="capacity"><span>Мы приняли вашу заявку!</span></div>
			<?php else: ?>
			<div>
				<a href="<?php echo smarty_function_link(array('do' => 'add','ticket' => 'rebro'), $this);?>
" class="btn btn-white btn-line">
					<?php if ($this->_tpl_vars['lang'] == 'en'): ?>Submit your application<?php else: ?>Подать заявку<?php endif; ?>
				</a>
			</div>
			<?php endif; ?>
		<?php endif; ?>
		<div class="tinkoff-credit">
			<a href="#" data-toggle="modal" data-target="#tinkoffModal">Купить в рассрочку</a>
		</div>
		<div class="capacity<?php if ($this->_tpl_vars['ticket']->leftCount <= 0): ?> sold-out<?php endif; ?>">
			<span>
				<?php if ($this->_tpl_vars['lang'] == 'en'): ?>Available tickets:<?php else: ?>Доступно билетов:<?php endif; ?>
				<?php echo $this->_tpl_vars['ticket']->leftCount; ?>

			</span>
		</div>
	</div>
	<div class="col-md-2 ticket ticket-profi">
		<?php $this->assign('ticketId', 3); ?> <!-- УКАЗАТЬ ID БИЛЕТА «ПРОФИ» -->
		<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
		<h2 class="ticket_header">
			<div class="ticket-hit">Хит продаж</div>
			<?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?>
			<p>Оптимальный<br> вариант, роднуль</p>
		</h2>
		<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
		<p class="ticket_new_cost">40&nbsp;000&nbsp;₽ с&nbsp;01.03.2020<br>
									45&nbsp;000&nbsp;₽ с&nbsp;01.05.2020</p>
		<a class="icollapse_more" data-toggle="collapse" href="#collapse<?php echo $this->_tpl_vars['ticketId']; ?>
" aria-expanded="false" aria-controls="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">Что входит в билет? <i class="fa fa-caret-down" aria-hidden="true"></i></a>
		<div class="collapse" id="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">
			<p class="ticket_desc"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The ticket includes:<?php else: ?>В билет входит:<?php endif; ?></p>
			<ul class="ticket_item">
				<li class="li_title">ОБУЧЕНИЕ</li>
				<li class="disabled">#REBRO</li>
				<li>#MAINSTREET</li>
				<li class="disabled">#БИЗНЕСШКОЛА</li>
				<li>#CHEFSTREET</li>
				<li>#BARSTREET</li>
				<li>#HOSTSTREET</li>
				<li>#ЦЕНТРАЛЬНАЯПЛОЩАДЬ</li>
				<li>#FUCKUP</li>
				<li>#BARISTASTREET</li>
				<li>#ITТЕХНОЛОГИИ</li>
				<li>#FRANCHISESTREET</li>
				<li>#ШКОЛАСОМЕЛЬЕ</li>
				<li>#ЗОЖ</li>
				<li class="li_title">ОБЩЕНИЕ</li>
				<li>#FOODMARKET</li>
				<li>#BBQBEERSTREET</li>
				<li>#ЗОЖ</li>
				<li>#НОЧНОЕBBQ</li>
				<li>#КОНЦЕРТЫ</li>
				<li>#ВЕЧЕРИНКИ</li>
				<li class="disabled">POP-UP SHOW</li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The best suppliers<?php else: ?>Лучшие поставщики<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Accommodation in hotel 5 *<?php else: ?>Проживание в отеле 5* (5&nbsp;ночей)<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Dedicated VIP-hotline<?php else: ?>Выделенная телефонная VIP-линия поддержки<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own restaurant<?php else: ?>Собственный ресторан<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own bar<?php else: ?>Собственный бар<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Closed parties with speakers<?php else: ?>Закрытые тусовки со спикерами<?php endif; ?></li>
			</ul>
		</div>
		<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
		<div>
			<a href="#" class="btn btn-white btn-line buy-ticket-click" <?php if ($this->_tpl_vars['this']['child']->id > 0): ?>data-extuser="<?php echo $this->_tpl_vars['this']['child']->id; ?>
"<?php endif; ?> data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
">
				Купить
			</a>
		</div>
		<?php endif; ?>
		<div class="tinkoff-credit">
			<a href="#" data-toggle="modal" data-target="#tinkoffModal">Купить в рассрочку</a>
		</div>
		<div class="capacity<?php if ($this->_tpl_vars['ticket']->leftCount <= 0): ?> sold-out<?php endif; ?>">
			<span>
				<?php if ($this->_tpl_vars['lang'] == 'en'): ?>Available tickets:<?php else: ?>Доступно билетов:<?php endif; ?>
				<?php echo $this->_tpl_vars['ticket']->leftCount; ?>

			</span>
		</div>
	</div>
	<div class="col-md-2 ticket ticket-chef">
		<?php $this->assign('ticketId', 2); ?> <!-- УКАЗАТЬ ID БИЛЕТА «ШЕФСКИЙ» -->
		<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
		<h2 class="ticket_header">
			<?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?>
			<p>Для будущих<br>
				и настоящих шефов</p>
		</h2>
		<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
		<p class="ticket_new_cost">35&nbsp;000&nbsp;₽ с&nbsp;01.03.2020<br>
									40&nbsp;000&nbsp;₽ с&nbsp;01.05.2020</p>
		<a class="icollapse_more" data-toggle="collapse" href="#collapse<?php echo $this->_tpl_vars['ticketId']; ?>
" aria-expanded="false" aria-controls="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">Что входит в билет? <i class="fa fa-caret-down" aria-hidden="true"></i></a>
		<div class="collapse" id="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">
			<p class="ticket_desc"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The ticket includes:<?php else: ?>В билет входит:<?php endif; ?></p>
			<ul class="ticket_item">
				<li class="li_title">ОБУЧЕНИЕ</li>
				<li class="disabled">#REBRO</li>
				<li class="disabled">#MAINSTREET</li>
				<li class="disabled">#БИЗНЕСШКОЛА</li>
				<li>#CHEFSTREET</li>
				<li class="disabled">#BARSTREET</li>
				<li class="disabled">#HOSTSTREET</li>
				<li>#ЦЕНТРАЛЬНАЯПЛОЩАДЬ</li>
				<li>#FUCKUP</li>
				<li>#BARISTASTREET</li>
				<li>#ITТЕХНОЛОГИИ</li>
				<li>#FRANCHISESTREET</li>
				<li>#ШКОЛАСОМЕЛЬЕ</li>
				<li>#ЗОЖ</li>
				<li class="li_title">ОБЩЕНИЕ</li>
				<li>#FOODMARKET</li>
				<li>#BBQBEERSTREET</li>
				<li>#ЗОЖ</li>
				<li>#НОЧНОЕBBQ</li>
				<li>#КОНЦЕРТЫ</li>
				<li>#ВЕЧЕРИНКИ</li>
				<li class="disabled">POP-UP SHOW</li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The best suppliers<?php else: ?>Лучшие поставщики<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Accommodation in hotel 5 *<?php else: ?>Проживание в отеле 5* (5&nbsp;ночей)<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Dedicated VIP-hotline<?php else: ?>Выделенная телефонная VIP-линия поддержки<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own restaurant<?php else: ?>Собственный ресторан<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own bar<?php else: ?>Собственный бар<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Closed parties with speakers<?php else: ?>Закрытые тусовки со спикерами<?php endif; ?></li>
			</ul>
		</div>
		<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
		<div>
			<a href="#" class="btn btn-white btn-line buy-ticket-click" <?php if ($this->_tpl_vars['this']['child']->id > 0): ?>data-extuser="<?php echo $this->_tpl_vars['this']['child']->id; ?>
"<?php endif; ?> data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
">
				Купить
			</a>
		</div>
		<?php endif; ?>
		<div class="tinkoff-credit">
			<a href="#" data-toggle="modal" data-target="#tinkoffModal">Купить в рассрочку</a>
		</div>
		<div class="capacity<?php if ($this->_tpl_vars['ticket']->leftCount <= 0): ?> sold-out<?php endif; ?>">
			<span>
				<?php if ($this->_tpl_vars['lang'] == 'en'): ?>Available tickets:<?php else: ?>Доступно билетов:<?php endif; ?>
				<?php echo $this->_tpl_vars['ticket']->leftCount; ?>

			</span>
		</div>
	</div>
	<div class="col-md-2 ticket ticket-barstreet">
		<?php $this->assign('ticketId', 4); ?> <!-- УКАЗАТЬ ID БИЛЕТА «БАРСТРИТ» -->
		<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
		<h2 class="ticket_header">
			<?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?>
			<p>Для тех, кто<br>
				с баром и за баром</p>
		</h2>
		<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
		<p class="ticket_new_cost">25&nbsp;000&nbsp;₽ с&nbsp;01.03.2020<br>
									30&nbsp;000&nbsp;₽ с&nbsp;01.05.2020</p>
		<a class="icollapse_more" data-toggle="collapse" href="#collapse<?php echo $this->_tpl_vars['ticketId']; ?>
" aria-expanded="false" aria-controls="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">Что входит в билет? <i class="fa fa-caret-down" aria-hidden="true"></i></a>
		<div class="collapse" id="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">
			<p class="ticket_desc"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The ticket includes:<?php else: ?>В билет входит:<?php endif; ?></p>
			<ul class="ticket_item">
				<li class="li_title">ОБУЧЕНИЕ</li>
				<li class="disabled">#REBRO</li>
				<li class="disabled">#MAINSTREET</li>
				<li class="disabled">#БИЗНЕСШКОЛА</li>
				<li class="disabled">#CHEFSTREET</li>
				<li>#BARSTREET</li>
				<li class="disabled">#HOSTSTREET</li>
				<li>#ЦЕНТРАЛЬНАЯПЛОЩАДЬ</li>
				<li>#FUCKUP</li>
				<li>#BARISTASTREET</li>
				<li>#ITТЕХНОЛОГИИ</li>
				<li>#FRANCHISESTREET</li>
				<li>#ШКОЛАСОМЕЛЬЕ</li>
				<li>#ЗОЖ</li>
				<li class="li_title">ОБЩЕНИЕ</li>
				<li>#FOODMARKET</li>
				<li>#BBQBEERSTREET</li>
				<li>#ЗОЖ</li>
				<li>#НОЧНОЕBBQ</li>
				<li>#КОНЦЕРТЫ</li>
				<li>#ВЕЧЕРИНКИ</li>
				<li class="disabled">POP-UP SHOW</li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The best suppliers<?php else: ?>Лучшие поставщики<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Accommodation in hotel 5 *<?php else: ?>Проживание в отеле 5* (5&nbsp;ночей)<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Dedicated VIP-hotline<?php else: ?>Выделенная телефонная VIP-линия поддержки<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own restaurant<?php else: ?>Собственный ресторан<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own bar<?php else: ?>Собственный бар<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Closed parties with speakers<?php else: ?>Закрытые тусовки со спикерами<?php endif; ?></li>
			</ul>
		</div>
		<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
		<div>
			<a href="#" class="btn btn-white btn-line buy-ticket-click" <?php if ($this->_tpl_vars['this']['child']->id > 0): ?>data-extuser="<?php echo $this->_tpl_vars['this']['child']->id; ?>
"<?php endif; ?> data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
">
				Купить
			</a>
		</div>
		<?php endif; ?>
		<div class="tinkoff-credit">
			<a href="#" data-toggle="modal" data-target="#tinkoffModal">Купить в рассрочку</a>
		</div>
		<div class="capacity<?php if ($this->_tpl_vars['ticket']->leftCount <= 0): ?> sold-out<?php endif; ?>">
			<span>
				<?php if ($this->_tpl_vars['lang'] == 'en'): ?>Available tickets:<?php else: ?>Доступно билетов:<?php endif; ?>
				<?php echo $this->_tpl_vars['ticket']->leftCount; ?>

			</span>
		</div>
	</div>
	<div class="col-md-2 ticket ticket-host">
		<?php $this->assign('ticketId', 10); ?> <!-- УКАЗАТЬ ID БИЛЕТА «HOSTSTREET» -->
		<?php $this->assign('ticket', ((is_array($_tmp=$this->_tpl_vars['ticketId'])) ? $this->_run_mod_handler('getticket', true, $_tmp) : smarty_modifier_getticket($_tmp))); ?>
		<h2 class="ticket_header">
			<?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['ticket']->name_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['ticket']->name; ?>
<?php endif; ?>
			<p>Отельерам<br>
				будет полезно</p>
		</h2>
		<p class="ticket_cost"><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->price)) ? $this->_run_mod_handler('numberprice', true, $_tmp) : smarty_modifier_numberprice($_tmp)); ?>
 ₽</p>
		<p class="ticket_new_cost">25&nbsp;000&nbsp;₽ с&nbsp;01.03.2020<br>
									30&nbsp;000&nbsp;₽ с&nbsp;01.05.2020</p>
		<a class="icollapse_more" data-toggle="collapse" href="#collapse<?php echo $this->_tpl_vars['ticketId']; ?>
" aria-expanded="false" aria-controls="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">Что входит в билет? <i class="fa fa-caret-down" aria-hidden="true"></i></a>
		<div class="collapse" id="collapse<?php echo $this->_tpl_vars['ticketId']; ?>
">
			<p class="ticket_desc"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The ticket includes:<?php else: ?>В билет входит:<?php endif; ?></p>
			<ul class="ticket_item">
				<li class="li_title">ОБУЧЕНИЕ</li>
				<li class="disabled">#REBRO</li>
				<li class="disabled">#MAINSTREET</li>
				<li class="disabled">#БИЗНЕСШКОЛА</li>
				<li class="disabled">#CHEFSTREET</li>
				<li class="disabled">#BARSTREET</li>
				<li>#HOSTSTREET</li>
				<li>#ЦЕНТРАЛЬНАЯПЛОЩАДЬ</li>
				<li>#FUCKUP</li>
				<li>#BARISTASTREET</li>
				<li>#ITТЕХНОЛОГИИ</li>
				<li>#FRANCHISESTREET</li>
				<li>#ШКОЛАСОМЕЛЬЕ</li>
				<li>#ЗОЖ</li>
				<li class="li_title">ОБЩЕНИЕ</li>
				<li>#FOODMARKET</li>
				<li>#BBQBEERSTREET</li>
				<li>#ЗОЖ</li>
				<li>#НОЧНОЕBBQ</li>
				<li>#КОНЦЕРТЫ</li>
				<li>#ВЕЧЕРИНКИ</li>
				<li class="disabled">POP-UP SHOW</li>
				<li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The best suppliers<?php else: ?>Лучшие поставщики<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Accommodation in hotel 5 *<?php else: ?>Проживание в отеле 5* (5&nbsp;ночей)<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Dedicated VIP-hotline<?php else: ?>Выделенная телефонная VIP-линия поддержки<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own restaurant<?php else: ?>Собственный ресторан<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Own bar<?php else: ?>Собственный бар<?php endif; ?></li>
				<li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Closed parties with speakers<?php else: ?>Закрытые тусовки со спикерами<?php endif; ?></li>
			</ul>
		</div>
		<?php if ($this->_tpl_vars['ticket']->leftCount > 0): ?>
		<div>
			<a href="#" class="btn btn-white btn-line buy-ticket-click" <?php if ($this->_tpl_vars['this']['child']->id > 0): ?>data-extuser="<?php echo $this->_tpl_vars['this']['child']->id; ?>
"<?php endif; ?> data-id="<?php echo $this->_tpl_vars['ticket']->id; ?>
">
				Купить
			</a>
		</div>
		<?php endif; ?>
		<div class="tinkoff-credit">
			<a href="#" data-toggle="modal" data-target="#tinkoffModal">Купить в рассрочку</a>
		</div>
		<div class="capacity<?php if ($this->_tpl_vars['ticket']->leftCount <= 0): ?> sold-out<?php endif; ?>">
			<span>
				<?php if ($this->_tpl_vars['lang'] == 'en'): ?>Available tickets:<?php else: ?>Доступно билетов:<?php endif; ?>
				<?php echo $this->_tpl_vars['ticket']->leftCount; ?>

			</span>
		</div>
	</div>	
<?php endif; ?>

<!-- Modal -->
<div class="modal fade" id="tinkoffModal" tabindex="-1" role="dialog" aria-labelledby="tinkoffModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body tinkoff-body">
				<img src="/images/tinkoff-logo.png" alt="Тинькофф" class="img-fluid">
				<div class="h5 mb-3">Билеты в рассрочку</div>
				<p>Теперь билеты на GASTREET можно купить в&nbsp;рассрочку на 4&nbsp;месяца. Просто в&nbsp;корзине выбери способ оплаты купить в&nbsp;рассрочку, заполни заявку на странице «Тинькофф банка», дождись ее одобрения и&nbsp;билет твой!</p>
				<p>Дополнительной наценки и&nbsp;процентов нет. Ты платишь только за билет равными платежами, а&nbsp;услуги банка мы берем на себя.</p>
			</div>
		</div>
	</div>
</div>