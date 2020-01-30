<?php /* Smarty version 2.6.13, created on 2019-11-28 17:04:50
         compiled from /home/c484884/gastreet.com/www/app/Templates/TicketControl.html */ ?>
<?php $this->assign('this', $this->_tpl_vars['TicketControl']); ?>

<section class="header">
    <div class="main_screen">
        <div class="main-bg"></div>
        <nav class="navbar" id="navbar">
            <div class="container">
                <div class="navbar-header">
                    <div class="gastreet">
                        <div class="place">
                            <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                            <p>Sochi, Krasnaya Polyana,<br /> Gorki Gorod, +960</p>
                            <?php else: ?>
                            <p>Сочи, Красная Поляна,<br />Горки Город, +960</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="navbar-header navbar-right">
                    <div class="con-block">
                        <div class="icon-block">
                            <a href="https://www.instagram.com/gastreetshow" target="_blank" class="icon instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="https://www.facebook.com/gastreetshow" target="_blank" class="icon facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </div>
                        <p class="phone">8 800 700-93-20</p>
                    </div>
                </div>
            </div>
        </nav>
        <div class="header_title">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                        <h1 class="title">Tickets</h1>
                        <p class="subtitle">Now we are developing a fireworks program for you, so at the moment only basic tickets are available for purchase</p>
                        <?php else: ?>
                        <h1 class="title">Билеты</h1>
                        <p class="subtitle">Сейчас мы разрабатываем для вас огненную программу, поэтому в&nbsp;данный момент доступны для покупки только основные билеты</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="page_body">
            <div class="container">
                <div class="row">
                    <div class="col-md-20 ticket clearfix">
                        <h2 class="ticket_header"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Like a King<?php else: ?>Как король<?php endif; ?></h2>
                        <p class="ticket_cost">150 000 ₽</p>
                        <p class="ticket_new_cost"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>from February 1, 170 000 ₽<?php else: ?>с 1 февраля 170 000 ₽<?php endif; ?><br>
                            <?php if ($this->_tpl_vars['lang'] == 'en'): ?>from May 1, 200 000 ₽<?php else: ?>с 1 мая 200 000 ₽<?php endif; ?></p>
                        <a class="icollapse_more" data-toggle="collapse" href="#collapse1" aria-expanded="false" aria-controls="collapse1">Подробнее <span class="caret"></span></a>
                        <div class="collapse" id="collapse1">
                            <p class="ticket_desc"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The ticket includes:<?php else: ?>В билет входит:<?php endif; ?></p>
                            <ul class="ticket_item">
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>All speaker's presentations<?php else: ?>Все выступления спикеров<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Gastreet Business School<?php else: ?>Бизнес-Школа Gastreet<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Chefstreet<?php else: ?>Шефстрит<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Barstreet<?php else: ?>Барстрит<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Cooking school<?php else: ?>Кулинарная школа<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Open air music festival<?php else: ?>Музыкальный фестиваль под открытым небом<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>POP-UP SHOW<?php else: ?>POP-UP SHOW<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Street food market<?php else: ?>Уличный маркет еды<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The best suppliers<?php else: ?>Лучшие поставщики<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Dedicated VIP-hotline<?php else: ?>Выделенная телефонная VIP-линия поддержки<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Closed parties with speakers<?php else: ?>Закрытые тусовки со спикерами<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>And much else<?php else: ?>И что-то еще<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Accommodation in hotel 5 *<?php else: ?>Проживание в отеле 5*<?php endif; ?></li>
                            </ul>
                        </div>
                        <?php if ($this->_tpl_vars['this']['tickets'][0]->leftCount): ?><div class="capacity"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Available tickets:<?php else: ?>Доступно билетов:<?php endif; ?> <?php echo $this->_tpl_vars['this']['tickets'][0]->leftCount; ?>
</div><?php endif; ?>
                        <?php $this->assign('canShowButton', 1); ?>
                        <?php if ($this->_tpl_vars['this']['userBasketTickets']): ?>
                        <?php $_from = $this->_tpl_vars['this']['userBasketTickets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['userTicket']):
?>
                        <?php if ($this->_tpl_vars['userTicket']['baseTicketId'] == $this->_tpl_vars['this']['tickets'][0]->id || $this->_tpl_vars['userTicket']['needAmount'] > $this->_tpl_vars['this']['tickets'][0]->price): ?>
                        <?php $this->assign('canShowButton', 0); ?>
                        <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php $this->assign('canShowButton', 0); ?>
                        <?php endif; ?>
                        <?php if ($this->_tpl_vars['this']['tickets'][0]->leftCount > 0 && $this->_tpl_vars['canShowButton']): ?>
                        <?php if ($this->_tpl_vars['this']['useAjax']): ?>
                        <a href="#" class="btn btn-black btn-line buy-ticket-click-pc" id="buy-ticket-pc-<?php echo $this->_tpl_vars['this']['tickets'][0]->id; ?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Buy<?php else: ?>Купить<?php endif; ?></a>
                        <?php else: ?>
                        <a href="/index.php?do=add&ticket=<?php echo $this->_tpl_vars['this']['tickets'][0]->id; ?>
" class="btn btn-black btn-line"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Buy<?php else: ?>Купить<?php endif; ?></a>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-20 ticket clearfix">
                        <h2 class="ticket_header"><span class="title_blue"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Profi<?php else: ?>Профи<?php endif; ?></span></h2>
                        <p class="ticket_cost">20 000 ₽</p>
                        <p class="ticket_new_cost"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>from February 1, 25 000 ₽<?php else: ?>с 1 февраля 25 000 ₽<?php endif; ?><br>
                            <?php if ($this->_tpl_vars['lang'] == 'en'): ?>from May 1, 30 000 ₽<?php else: ?>с 1 мая 30 000 ₽<?php endif; ?></p>
                        <a class="icollapse_more" data-toggle="collapse" href="#collapse2" aria-expanded="false" aria-controls="collapse2">Подробнее <span class="caret"></span></a>
                        <div class="collapse" id="collapse2">
                            <p class="ticket_desc"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The ticket includes:<?php else: ?>В билет входит:<?php endif; ?></p>
                            <ul class="ticket_item">
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>All speaker's presentations<?php else: ?>Все выступления спикеров<?php endif; ?></li>
                                <li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Gastreet Business School<?php else: ?>Бизнес-Школа Gastreet<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Chefstreet<?php else: ?>Шефстрит<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Barstreet<?php else: ?>Барстрит<?php endif; ?></li>
                                <li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Cooking school<?php else: ?>Кулинарная школа<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Open air music festival<?php else: ?>Музыкальный фестиваль под открытым небом<?php endif; ?></li>
                                <li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>POP-UP SHOW<?php else: ?>POP-UP SHOW<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Street food market<?php else: ?>Уличный маркет еды<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The best suppliers<?php else: ?>Лучшие поставщики<?php endif; ?></li>
                            </ul>
                        </div>
                        <?php if ($this->_tpl_vars['this']['tickets'][1]->leftCount): ?><div class="capacity"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Available tickets:<?php else: ?>Доступно билетов:<?php endif; ?> <?php echo $this->_tpl_vars['this']['tickets'][1]->leftCount; ?>
</div><?php endif; ?>
                        <?php $this->assign('canShowButton', 1); ?>
                        <?php if ($this->_tpl_vars['this']['userBasketTickets']): ?>
                        <?php $_from = $this->_tpl_vars['this']['userBasketTickets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['userTicket']):
?>
                        <?php if ($this->_tpl_vars['userTicket']['baseTicketId'] == $this->_tpl_vars['this']['tickets'][1]->id || $this->_tpl_vars['userTicket']['needAmount'] > $this->_tpl_vars['this']['tickets'][1]->price): ?>
                        <?php $this->assign('canShowButton', 0); ?>
                        <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php $this->assign('canShowButton', 0); ?>
                        <?php endif; ?>
                        <?php if ($this->_tpl_vars['this']['tickets'][1]->leftCount > 0 && $this->_tpl_vars['canShowButton']): ?>
                        <?php if ($this->_tpl_vars['this']['useAjax']): ?>
                        <a href="#" class="btn btn-black btn-line buy-ticket-click-pc" id="buy-ticket-pc-<?php echo $this->_tpl_vars['this']['tickets'][1]->id; ?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Buy<?php else: ?>Купить<?php endif; ?></a>
                        <?php else: ?>
                        <a href="/index.php?do=add&ticket=<?php echo $this->_tpl_vars['this']['tickets'][1]->id; ?>
" class="btn btn-black btn-line"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Buy<?php else: ?>Купить<?php endif; ?></a>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-20 ticket clearfix">
                        <h2 class="ticket_header"><span class="title_green"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Chef's<?php else: ?>Шефский<?php endif; ?></span></h2>
                        <p class="ticket_cost">10 000 ₽</p>
                        <p class="ticket_new_cost"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>from February 1, 15 000 ₽<?php else: ?>с 1 февраля 15 000 ₽<?php endif; ?><br>
                            <?php if ($this->_tpl_vars['lang'] == 'en'): ?>from May 1, 20 000 ₽<?php else: ?>с 1 мая 20 000 ₽<?php endif; ?></p>
                        <a class="icollapse_more" data-toggle="collapse" href="#collapse3" aria-expanded="false" aria-controls="collapse3">Подробнее <span class="caret"></span></a>
                        <div class="collapse" id="collapse3">
                            <p class="ticket_desc"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The ticket includes:<?php else: ?>В билет входит:<?php endif; ?></p>
                            <ul class="ticket_item">
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>All speaker's presentations (Main stage only)<?php else: ?>Выступления спикеров (Только главная сцена)<?php endif; ?></li>
                                <li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Gastreet Business School<?php else: ?>Бизнес-Школа Gastreet<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Chefstreet<?php else: ?>Шефстрит<?php endif; ?></li>
                                <li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Barstreet<?php else: ?>Барстрит<?php endif; ?></li>
                                <li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Cooking school<?php else: ?>Кулинарная школа<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Open air music festival<?php else: ?>Музыкальный фестиваль под открытым небом<?php endif; ?></li>
                                <li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>POP-UP SHOW<?php else: ?>POP-UP SHOW<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Street food market<?php else: ?>Уличный маркет еды<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The best suppliers<?php else: ?>Лучшие поставщики<?php endif; ?></li>
                            </ul>
                        </div>
                        <?php if ($this->_tpl_vars['this']['tickets'][2]->leftCount): ?><div class="capacity"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Available tickets:<?php else: ?>Доступно билетов:<?php endif; ?> <?php echo $this->_tpl_vars['this']['tickets'][2]->leftCount; ?>
</div><?php endif; ?>
                        <?php $this->assign('canShowButton', 1); ?>
                        <?php if ($this->_tpl_vars['this']['userBasketTickets']): ?>
                        <?php $_from = $this->_tpl_vars['this']['userBasketTickets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['userTicket']):
?>
                        <?php if ($this->_tpl_vars['userTicket']['baseTicketId'] == $this->_tpl_vars['this']['tickets'][2]->id || $this->_tpl_vars['userTicket']['needAmount'] > $this->_tpl_vars['this']['tickets'][2]->price): ?>
                        <?php $this->assign('canShowButton', 0); ?>
                        <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php $this->assign('canShowButton', 0); ?>
                        <?php endif; ?>
                        <?php if ($this->_tpl_vars['this']['tickets'][2]->leftCount > 0 && $this->_tpl_vars['canShowButton']): ?>
                        <?php if ($this->_tpl_vars['this']['useAjax']): ?>
                        <a href="#" class="btn btn-black btn-line buy-ticket-click-pc" id="buy-ticket-pc-<?php echo $this->_tpl_vars['this']['tickets'][2]->id; ?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Buy<?php else: ?>Купить<?php endif; ?></a>
                        <?php else: ?>
                        <a href="/index.php?do=add&ticket=<?php echo $this->_tpl_vars['this']['tickets'][2]->id; ?>
" class="btn btn-black btn-line"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Buy<?php else: ?>Купить<?php endif; ?></a>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-20 ticket clearfix">
                        <h2 class="ticket_header"><span class="title_red"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Barstreet<?php else: ?>Барстрит<?php endif; ?></span></h2>
                        <p class="ticket_cost">9 000 ₽</p>
                        <p class="ticket_new_cost"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>from February 1, 12 000 ₽<?php else: ?>с 1 февраля 12 000 ₽<?php endif; ?><br>
                            <?php if ($this->_tpl_vars['lang'] == 'en'): ?>from May 1, 15 000 ₽<?php else: ?>с 1 мая 15 000 ₽<?php endif; ?></p>
                        <a class="icollapse_more" data-toggle="collapse" href="#collapse4" aria-expanded="false" aria-controls="collapse4">Подробнее <span class="caret"></span></a>
                        <div class="collapse" id="collapse4">
                            <p class="ticket_desc"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The ticket includes:<?php else: ?>В билет входит:<?php endif; ?></p>
                            <ul class="ticket_item">
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>All speaker's presentations (Main stage only)<?php else: ?>Выступления спикеров (Только главная сцена)<?php endif; ?></li>
                                <li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Gastreet Business School<?php else: ?>Бизнес-Школа Gastreet<?php endif; ?></li>
                                <li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Chefstreet<?php else: ?>Шефстрит<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Barstreet<?php else: ?>Барстрит<?php endif; ?></li>
                                <li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Cooking school<?php else: ?>Кулинарная школа<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Open air music festival<?php else: ?>Музыкальный фестиваль под открытым небом<?php endif; ?></li>
                                <li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>POP-UP SHOW<?php else: ?>POP-UP SHOW<?php endif; ?></li>
                                <li style="display: none;" class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>First professional restaurant award<?php else: ?>Первая профессиональная ресторанная премия<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Street food market<?php else: ?>Уличный маркет еды<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The best suppliers<?php else: ?>Лучшие поставщики<?php endif; ?></li>
                            </ul>
                        </div>
                        <?php if ($this->_tpl_vars['this']['tickets'][3]->leftCount): ?><div class="capacity"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Available tickets:<?php else: ?>Доступно билетов:<?php endif; ?> <?php echo $this->_tpl_vars['this']['tickets'][3]->leftCount; ?>
</div><?php endif; ?>
                        <?php $this->assign('canShowButton', 1); ?>
                        <?php if ($this->_tpl_vars['this']['userBasketTickets']): ?>
                        <?php $_from = $this->_tpl_vars['this']['userBasketTickets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['userTicket']):
?>
                        <?php if ($this->_tpl_vars['userTicket']['baseTicketId'] == $this->_tpl_vars['this']['tickets'][3]->id || $this->_tpl_vars['userTicket']['needAmount'] > $this->_tpl_vars['this']['tickets'][3]->price): ?>
                        <?php $this->assign('canShowButton', 0); ?>
                        <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php $this->assign('canShowButton', 0); ?>
                        <?php endif; ?>
                        <?php if ($this->_tpl_vars['this']['tickets'][3]->leftCount > 0 && $this->_tpl_vars['canShowButton']): ?>
                        <?php if ($this->_tpl_vars['this']['useAjax']): ?>
                        <a href="#" class="btn btn-black btn-line buy-ticket-click-pc" id="buy-ticket-pc-<?php echo $this->_tpl_vars['this']['tickets'][3]->id; ?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Buy<?php else: ?>Купить<?php endif; ?></a>
                        <?php else: ?>
                        <a href="/index.php?do=add&ticket=<?php echo $this->_tpl_vars['this']['tickets'][3]->id; ?>
" class="btn btn-black btn-line"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Buy<?php else: ?>Купить<?php endif; ?></a>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-20 ticket clearfix">
                        <h2 class="ticket_header"><span class="title_gay"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Basic<?php else: ?>Базовый<?php endif; ?></span></h2>
                        <p class="ticket_cost">5 000 ₽</p>
                        <p class="ticket_new_cost"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>from February 1, 7 000 ₽<?php else: ?>с 1 февраля 7 000 ₽<?php endif; ?><br>
                            &nbsp;</p>
                        <a class="icollapse_more" data-toggle="collapse" href="#collapse5" aria-expanded="false" aria-controls="collapse5">Подробнее <span class="caret"></span></a>
                        <div class="collapse in" id="collapse5">
                            <p class="ticket_desc"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The ticket includes:<?php else: ?>В билет входит:<?php endif; ?></p>
                            <ul class="ticket_item">
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>All speaker's presentations (Main stage only)<?php else: ?>Выступления спикеров (Только главная сцена)<?php endif; ?></li>
                                <li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Gastreet Business School<?php else: ?>Бизнес-Школа Gastreet<?php endif; ?></li>
                                <li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Chefstreet<?php else: ?>Шефстрит<?php endif; ?></li>
                                <li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Barstreet<?php else: ?>Барстрит<?php endif; ?></li>
                                <li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Cooking school<?php else: ?>Кулинарная школа<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Open air music festival<?php else: ?>Музыкальный фестиваль под открытым небом<?php endif; ?></li>
                                <li class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>POP-UP SHOW<?php else: ?>POP-UP SHOW<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Street food market<?php else: ?>Уличный маркет еды<?php endif; ?></li>
                                <li><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The best suppliers<?php else: ?>Лучшие поставщики<?php endif; ?></li>
                            </ul>
                        </div>
                        <?php if ($this->_tpl_vars['this']['tickets'][4]->leftCount): ?><div class="capacity"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Available tickets:<?php else: ?>Доступно билетов:<?php endif; ?> <?php echo $this->_tpl_vars['this']['tickets'][4]->leftCount; ?>
</div><?php endif; ?>
                        <?php $this->assign('canShowButton', 1); ?>
                        <?php if ($this->_tpl_vars['this']['userBasketTickets']): ?>
                        <?php $_from = $this->_tpl_vars['this']['userBasketTickets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['userTicket']):
?>
                        <?php if ($this->_tpl_vars['userTicket']['baseTicketId'] == $this->_tpl_vars['this']['tickets'][4]->id || $this->_tpl_vars['userTicket']['needAmount'] > $this->_tpl_vars['this']['tickets'][4]->price): ?>
                        <?php $this->assign('canShowButton', 0); ?>
                        <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php $this->assign('canShowButton', 0); ?>
                        <?php endif; ?>
                        <?php if ($this->_tpl_vars['this']['tickets'][4]->leftCount > 0 && $this->_tpl_vars['canShowButton']): ?>
                        <?php if ($this->_tpl_vars['this']['useAjax']): ?>
                        <a href="#" class="btn btn-black btn-line buy-ticket-click-pc" id="buy-ticket-pc-<?php echo $this->_tpl_vars['this']['tickets'][4]->id; ?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Buy<?php else: ?>Купить<?php endif; ?></a>
                        <?php else: ?>
                        <a href="/index.php?do=add&ticket=<?php echo $this->_tpl_vars['this']['tickets'][4]->id; ?>
" class="btn btn-black btn-line"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Buy<?php else: ?>Купить<?php endif; ?></a>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row ticket_description">
                    <div class="col-md-12">
                        <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                        <h4>The following additional options can be added to the PROFI, CHEF'S, BARSTREET, and BASIC tickets:</h4>
                        <p>Speaker's presentations –<br> 1&nbsp;500₽/presentation</p>
                        <p>Gastreet Business School –<br> 4&nbsp;000₽/master class</p>
                        <p>Cooking School – the price to be announced</p>
                        <?php else: ?>
                        <h4>К билетам Профи, Шефский, Барстрит, и&nbsp;Базовый можно отдельно докупить:</h4>
                        <p>Выступления спикеров –<br> 1&nbsp;500₽/выступление</p>
                        <p>Бизнес – Школа Gastreet –<br> 4&nbsp;000₽/мастер-класс</p>
                        <p>Кулинарная школа – стоимость уточняется</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row schedule">
                    <div class="col-md-12">
                        <h3><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The draft schedule of the first day of 2019 Gastreet Show<?php else: ?>Примерное расписание одного&nbsp;дня Gastreet Show 2019<?php endif; ?></h3>
                        <div class="row odd">
                            <div class="col-md-2">
                                <p><b>10:00 - 12:30</b></p>
                            </div>
                            <div class="col-md-10">
                                <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                                <p>Performance on the <b>MAIN STAGE</b> (all guests are invited!) <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="The MAIN STAGE of the event will host the brightest performances of Gastreet'18. Successful caterers (and not only they!) from various countries will share their secrets. The same stage will host the official opening and closing of Gastreet'18. And if there is some money left, there will even be a salute:)"></span></p>
                                <?php else: ?>
                                <p>Выступление на <b>ГЛАВНОЙ СЦЕНЕ</b> (встречаются все!) <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="На ГЛАВНОЙ СЦЕНЕ нашего мероприятия состоятся самые яркие выступления Gastreet'18. Успешные рестораторы (и не только!) из разных стран поделятся своими секретами. Здесь же пройдет официальное открытие и закрытие Gastreet'18. А если останутся деньги, то будет даже салют:)"></span></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row even">
                            <div class="col-md-2">
                                <p><b>13:00 - 18:30</b></p>
                            </div>
                            <div class="col-md-10">
                                <p><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Master classes and workshops. <span style="color: #da3046">Attention! All locations operate in parallel!</span><?php else: ?>Мастер-классы и семинары. <span style="color: #da3046">Внимание! Все площадки работают одновременно!</span><?php endif; ?></p>
                                <div class="row area">
                                    <div class="col-md-20">
                                        <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                                        <h4><span class="title_green">CHEF-STREET <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="Gastronomic Madness location. The chefs from various restaurants, cities, and countries will perform their master classes here."></span></span></h4>
                                        <?php else: ?>  
                                        <h4><span class="title_green">Шеф-Street <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="Площадка гастрономического безумия. Шеф-повара из разных ресторанов, разных городов и разных стран зарядят здесь свои мастер-классы."></span></span></h4>
                                        <?php endif; ?>
                                        <p><?php if ($this->_tpl_vars['lang'] == 'en'): ?>1 location<?php else: ?>1 площадка<?php endif; ?></p>
                                        <p><?php if ($this->_tpl_vars['lang'] == 'en'): ?>5 MC per day<?php else: ?>5 МК в день<?php endif; ?></p>
                                    </div>
                                    <div class="col-md-20">
                                        <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                                        <h4><span class="title_red">Barstreet <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="On this location the best bar managers of the country will tell you everything about the management and economy of a bar as a department in an institution. How to build a bar, how to recruit bartenders, how to monitor, how many percent a bar may contribute to a restaurant's revenue and much more - all this you will learn on the Barstreet location."></span></span></h4>
                                        <?php else: ?>
                                        <h4><span class="title_red">Барстрит <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="На этой площадке лучшие бар - менеджеры страны расскажут обо всем, что касается управления баром и экономики бара как департамента в заведении.  Как строится бар, как набирать барменов, как контролировать, сколько процентов в ресторане может делать бар по выручке и о многом другом вы узнаете на площадке Барстрит."></span></span></h4>
                                        <?php endif; ?>
                                        <p><?php if ($this->_tpl_vars['lang'] == 'en'): ?>1 location<?php else: ?>1 площадка<?php endif; ?></p>
                                        <p><?php if ($this->_tpl_vars['lang'] == 'en'): ?>4 MC per day<?php else: ?>4 МК в день<?php endif; ?></p>
                                    </div>
                                    <div class="col-md-20">
                                        <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                                        <h4><span class="title_orange">GASTREET BUSINESS SCHOOL <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="Gastreet Business School is a series of comprehensive three hour workshops provided by the most successful and renowned industry consultants. Of course, all of them originate from the catering business."></span></span></h4>
                                        <?php else: ?>
                                        <h4><span class="title_orange">Бизнес-школа Gastreet <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="Бизнес-Школа Gastreet - это серия полноценных 3х часовых семинаров от самых успешных и&nbsp;известных консультантов отрасли. Все они, естественно, выходцы из ресторанного бизнеса."></span></span></h4>
                                        <?php endif; ?>
                                        <p><?php if ($this->_tpl_vars['lang'] == 'en'): ?>1 location<?php else: ?>1 площадка<?php endif; ?></p>
                                        <p><?php if ($this->_tpl_vars['lang'] == 'en'): ?>3 workshops per day<?php else: ?>3 семинара в день<?php endif; ?></p>
                                    </div>
                                    <div class="col-md-20">
                                        <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                                        <h4><span class="title_gay">Cooking School <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="The information to be specified."></span></span></h4>
                                        <?php else: ?>
                                        <h4><span class="title_gay">Кулинарная школа <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="Информация уточняется."></span></span></h4>
                                        <?php endif; ?>
                                        <p><?php if ($this->_tpl_vars['lang'] == 'en'): ?>1 location<?php else: ?>1 площадка<?php endif; ?></p>
                                        <p><?php if ($this->_tpl_vars['lang'] == 'en'): ?>4 MC per day<?php else: ?>4 МК в день<?php endif; ?></p>
                                    </div>
                                    <div class="col-md-20">
                                        <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                                        <h4><span class="title_blue">Business-Street <span class="itooltip" data-toggle="tooltip" data-placement="left" data-html="true" title="These will be the hour-long performances by caterers from all over the country and beyond, which will be held simultaneously at different locations. Staff management and tax planning, the main rules of restaurant design and competent PR, legal issues, and much more. 20 master classes a day will give you an opportunity to rack your brain and take with you not just emotions, but also a weighty bundle of knowledge."></span></span></h4>
                                        <?php else: ?>
                                        <h4><span class="title_blue">Business-Street <span class="itooltip" data-toggle="tooltip" data-placement="left" data-html="true" title="Это часовые выступления ресторанных практиков со всей страны и&nbsp;за её пределами, которые будут проходить одновременно на 5&nbsp;площадках. Управление персоналом и&nbsp;налоговое планирование, главные правила дизайна ресторана и&nbsp;грамотный PR, юридические вопросы и много чего еще. 20&nbsp;мастер-классов в&nbsp;день дадут вам возможность поскрипеть мозгами и&nbsp;увезти с&nbsp;собой не только эмоции, но и&nbsp;увесистый багаж знаний."></span></span></h4>
                                        <?php endif; ?>
                                        <p><?php if ($this->_tpl_vars['lang'] == 'en'): ?>5 locations<?php else: ?>5 площадок<?php endif; ?></p>
                                        <p><?php if ($this->_tpl_vars['lang'] == 'en'): ?>20 MC per day<?php else: ?>20 МК в день<?php endif; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row odd">
                            <div class="col-md-2">
                                <p><b>19:00 - 20:00</b></p>
                            </div>
                            <div class="col-md-10">
                                <p><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Performance on the <b>MAIN STAGE</b> (all guests are invited!)<?php else: ?>Выступление на <b>ГЛАВНОЙ СЦЕНЕ</b> (встречаются все!)<?php endif; ?></p>
                            </div>
                        </div>
                        <div class="row even">
                            <div class="col-md-2">
                                <p><b>20:00 - 22:00</b></p>
                            </div>
                            <div class="col-md-10">
                                <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                                <p>POP-UP SHOW <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="Every evening, the all-star teams of chefs from various cities will cook dinners! The guests of the dinner will be able not just to enjoy delicious food, but as well to look at their kitchen from a different prospective, to spy out interesting combinations and serving the dishes."></span></p>
                                <?php else: ?>
                                <p>POP-UP SHOW <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="Каждый вечер звёздные команды поваров из разных городов будут готовить ужины! Гости ужина смогут не только вкусно поесть, но и посмотреть на свою кухню под другим углом, подсмотреть интересные сочетания и подачу блюд."></span></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row odd">
                            <div class="col-md-2">
                                <p><b>21:00</b></p>
                            </div>
                            <div class="col-md-10">
                                <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                                <p>Open air music festival <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="The main square of Gastreet City will feature daily rock concerts. Put on convenient shoes, we'll swing it right!"></span></p>
                                <?php else: ?>
                                <p>Музыкальный фестиваль под открытым небом <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="Ежедневные рок-концерты на главной площади Gastreet City. Запасайся удобной обувью, будем уходить в отрыв!"></span></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row even">
                            <div class="col-md-2">
                                <p><b>23:00</b></p>
                            </div>
                            <div class="col-md-10">
                                <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                                <p>Partners parties <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="The information to be specified."></span></p>
                                <?php else: ?>
                                <p>Партнерские вечеринки <span class="itooltip" data-toggle="tooltip" data-placement="right" data-html="true" title="Информация уточняется."></span></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="copyright">
                            <p class="gastreet">Gastreet — International Restaurant Show<br />Услуги оказывает ООО «НОМЕР ОДИН»<br />ИНН 2319056763, ОГРН 1442367009916<br>и ООО «СИРОККО» ИНН 2320238493,<br />ОГРН 1162366052705</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</section>