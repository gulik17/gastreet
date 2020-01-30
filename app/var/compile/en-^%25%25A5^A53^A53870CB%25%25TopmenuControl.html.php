<?php /* Smarty version 2.6.13, created on 2020-01-15 17:08:10
         compiled from /home/c484884/gastreet.com/www/app/Templates/TopmenuControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/TopmenuControl.html', 12, false),array('modifier', 'truncate', '/home/c484884/gastreet.com/www/app/Templates/TopmenuControl.html', 80, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['TopmenuControl']); ?>
<?php if (! $this->_tpl_vars['app']): ?>
<header class="site-header has-fixed" id="site-header">
    <div class="container">
        <div class="content">
            <div class="col-left">
                <a class="logo <?php if ($this->_tpl_vars['time'] < '1578960000'): ?>santa<?php endif; ?>" href="/">Gastreet</a>
<!--                <a class="logo logo-metro" target="_blank" href="http://www.metro-cc.ru/">METRO</a>-->
            </div>
            <nav class="nav nav-menu" id="nav-menu">
                <ul class="menu">
                    <li class="for-mobile"><a href="<?php echo smarty_function_link(array('show' => 'programms'), $this);?>
"><span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Business program<?php else: ?>Описание площадок<?php endif; ?></span></a></li>
                    <li class="has-sub-menu">
                        <a href="<?php echo smarty_function_link(array('show' => 'programms'), $this);?>
"><span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Program<?php else: ?>Площадки<?php endif; ?></span></a>
                        <span></span>
                        <div>
                            <ul>
                                <li style="margin-bottom: 5px;"><b><?php if ($this->_tpl_vars['lang'] == 'en'): ?>TRAINING<?php else: ?>ОБУЧЕНИЕ<?php endif; ?></b></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'catalog','area' => 5), $this);?>
">#REBRO</a></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'catalog','area' => 6), $this);?>
">#БИЗНЕСШКОЛА</a></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'catalog','area' => 3), $this);?>
">#MAINSTREET</a></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'catalog','area' => 9), $this);?>
">#CHEFSTREET</a></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'catalog','area' => 7), $this);?>
">#BARSTREET</a></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'catalog','area' => 1), $this);?>
">#HOSTSTREET</a></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'catalog','area' => 28), $this);?>
">#ЦЕНТРАЛЬНАЯПЛОЩАДЬ</a></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'catalog','area' => 14), $this);?>
">#FUCKUP</a></li>
                            </ul>
                            <ul class="has-border">
                                <li style="margin-bottom: 5px;"><b><?php if ($this->_tpl_vars['lang'] == 'en'): ?>COMMUNICATION<?php else: ?>ОБЩЕНИЕ<?php endif; ?></b></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'catalog','area' => 8), $this);?>
">#FOODMARKET</a></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'catalog','area' => 10), $this);?>
">#DRINKZONE</a></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'catalog','area' => 16), $this);?>
">#BBQBEERSTREET</a></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'catalog','area' => 24), $this);?>
">#ЗОЖ</a></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'catalog','area' => 13), $this);?>
">#НОЧНОЕBBQ</a></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'catalog','area' => 4), $this);?>
">#POP-UPSHOW</a></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'catalog','area' => 2), $this);?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>#CONCERTS<?php else: ?>#КОНЦЕРТЫ<?php endif; ?></a></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'catalog','area' => 19), $this);?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>#PARTIES<?php else: ?>#ВЕЧЕРИНКИ<?php endif; ?></a></li>
                            </ul>
                            <ul class="has-border">
                                <li style="margin-bottom: 5px;"><b>ОТ ПАРТНЕРОВ</b></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'catalog','area' => 15), $this);?>
">#ШКОЛАСОМЕЛЬЕ</a></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'catalog','area' => 17), $this);?>
">#BARISTASTREET</a></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'catalog','area' => 11), $this);?>
">#ITТЕХНОЛОГИИ</a></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'catalog','area' => 18), $this);?>
">#FRANCHISESTREET</a></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'catalog','area' => 20), $this);?>
">#ЗОЖ</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="<?php echo smarty_function_link(array('show' => 'catalog'), $this);?>
" class="indicator-toggle cashback"><span>Tickets</span></a></li>
                    <li><a href="<?php echo smarty_function_link(array('show' => 'speakers'), $this);?>
"><span>Speakers</span></a></li>
                    <li><a href="<?php echo smarty_function_link(array('show' => 'schedule'), $this);?>
"><span>Schedule</span></a></li>
                    <li class="d-none"><a href="<?php echo smarty_function_link(array('show' => 'presentation'), $this);?>
"><span>Presentations</span></a></li>
                    <li class="for-mobile"><a href="<?php echo smarty_function_link(array('show' => 'video'), $this);?>
"><span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Video<?php else: ?>Кинотеатр<?php endif; ?></span></a></li>
                    <li class="for-mobile"><a href="<?php echo smarty_function_link(array('show' => 'place'), $this);?>
"><span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Where to live<?php else: ?>Где жить<?php endif; ?></span></a></li>
                    <li class="for-mobile"><a href="<?php echo smarty_function_link(array('show' => 'faq'), $this);?>
"><span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>FAQ<?php else: ?>ЧаВо<?php endif; ?></span></a></li>
                    <li class="for-mobile"><a href="<?php echo smarty_function_link(array('show' => 'volunteers'), $this);?>
"><span>Volunteers</span></a></li>
                    <li class="for-mobile"><a href="<?php echo smarty_function_link(array('show' => 'map'), $this);?>
"><span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Gastreet City Map<?php else: ?>Карта Gastreet City<?php endif; ?></span></a></li>
                    <!--<li class="for-mobile"><a href="<?php echo smarty_function_link(array('show' => 'memory'), $this);?>
"><span>Memory</span></a></li>-->
                    <li class="for-mobile"><a href="<?php echo smarty_function_link(array('show' => 'contacts'), $this);?>
"><span>Contacts</span></a></li>
                    <li class="has-sub-menu">
                        <a href="javascript:void(0)"><span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Info<?php else: ?>Инфо<?php endif; ?></span></a>
                        <span></span>
                        <div>
                            <ul>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'video'), $this);?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Video<?php else: ?>Кинотеатр<?php endif; ?></a></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'place'), $this);?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Where to live<?php else: ?>Где жить<?php endif; ?></a></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'faq'), $this);?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>FAQ<?php else: ?>ЧаВо<?php endif; ?></a></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'volunteers'), $this);?>
"><span>Volunteers</span></a></li>
                                <li><a href="<?php echo smarty_function_link(array('show' => 'map'), $this);?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Gastreet City Map<?php else: ?>Карта Gastreet City<?php endif; ?></a></li>
                                <!--<li><a href="<?php echo smarty_function_link(array('show' => 'memory'), $this);?>
">Memory</a></li>-->
                                <li><a href="<?php echo smarty_function_link(array('show' => 'contacts'), $this);?>
">Contacts</a></li>
                            </ul>
                        </div> 
                    </li>
                    <?php if (! $this->_tpl_vars['this']['actor']): ?>
                    <li class="for-mobile"><a href="<?php echo smarty_function_link(array('show' => 'userregister'), $this);?>
"><span>Registration</span></a></li>
                    <li class="for-mobile"><a href="<?php echo smarty_function_link(array('show' => 'userlogin'), $this);?>
"><span>Login</span></a></li>
                    <?php else: ?>
                        <?php if ($this->_tpl_vars['this']['child']): ?>
                            <li class="for-mobile"><a href="<?php echo smarty_function_link(array('show' => 'usereditprofile'), $this);?>
" style="text-decoration: none; color: red !important;"><span><?php echo $this->_tpl_vars['this']['child']->lastname; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['this']['child']->name)) ? $this->_run_mod_handler('truncate', true, $_tmp, 2, ".") : smarty_modifier_truncate($_tmp, 2, ".")); ?>
</span></a></li>
                            <li class="for-mobile"><a href="<?php echo smarty_function_link(array('show' => 'basket'), $this);?>
"><span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Basket<?php else: ?>Корзина<?php endif; ?><?php if ($this->_tpl_vars['ticketsCount'] > 0): ?></span> <span class="badge"><?php echo $this->_tpl_vars['ticketsCount']; ?>
</span><?php endif; ?></a></li>
                            <li class="for-mobile"><a href="<?php echo smarty_function_link(array('do' => 'userparticipantlogout'), $this);?>
" style="color: red;"><span class="glyphicon glyphicon-log-out" aria-hidden="true" title="Sign Out"></span> <span>Sign Out</span></a>
                        <?php else: ?>
                            <li class="for-mobile"><a href="<?php echo smarty_function_link(array('show' => 'usereditprofile'), $this);?>
" style="text-decoration: none;"><span><?php echo $this->_tpl_vars['this']['actor']->lastname; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['this']['actor']->name)) ? $this->_run_mod_handler('truncate', true, $_tmp, 2, ".") : smarty_modifier_truncate($_tmp, 2, ".")); ?>
</span></a></li>
                            <li class="for-mobile"><a href="<?php echo smarty_function_link(array('show' => 'basket'), $this);?>
"><span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Basket<?php else: ?>Корзина<?php endif; ?><?php if ($this->_tpl_vars['ticketsCount'] > 0): ?></span> <span class="badge"><?php echo $this->_tpl_vars['ticketsCount']; ?>
</span><?php endif; ?></a></li>
                            <li class="for-mobile"><a href="<?php echo smarty_function_link(array('do' => 'logout'), $this);?>
"><span class="glyphicon glyphicon-log-out" aria-hidden="true" title="Sign Out"></span> <span>Sign Out</span></a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
                <!--                    <div class="for-mobile social-operations text-center d-none">-->
                <!--                        <a class="text" href="/avatar">Сделать аватар</a>-->
                <!--                    </div>-->
            </nav>
            <div class="col-right" id="header-col-right">
                <?php if (! $this->_tpl_vars['this']['actor']): ?>
                    <a id="dLabel" class="indicator-toggle gaz" href="<?php echo smarty_function_link(array('show' => 'userregister'), $this);?>
">Registration</a>
                    <div class="user user-panel js-user-panel">
                        <a class="login" href="<?php echo smarty_function_link(array('show' => 'userlogin'), $this);?>
"><span class="icon"></span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Login<?php else: ?>Вход<?php endif; ?></a>
                    </div>
<!--                    <div class="dropdown">-->
<!--                        <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">-->
<!--                            <?php if ($this->_tpl_vars['lang'] == 'en'): ?>Sign In<?php else: ?>Войти<?php endif; ?> <i class="fa fa-caret-down" aria-hidden="true"></i>-->
<!--                        </a>-->
<!--                        <ul class="dropdown-menu" aria-labelledby="dLabel">-->
<!--                            <li><a href="<?php echo smarty_function_link(array('show' => 'userregister'), $this);?>
">Registration</a></li>-->
<!--                            <li><a href="<?php echo smarty_function_link(array('show' => 'userlogin'), $this);?>
"><span class="icon"></span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Sign In<?php else: ?>Авторизация<?php endif; ?></a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
                <?php else: ?>
                    <?php if ($this->_tpl_vars['this']['child']): ?>
                        <div class="dropdown">
                            <a id="dLabel" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="text-decoration: none; color: red !important;">
                                <?php echo $this->_tpl_vars['this']['child']->lastname; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['this']['child']->name)) ? $this->_run_mod_handler('truncate', true, $_tmp, 2, ".") : smarty_modifier_truncate($_tmp, 2, ".")); ?>
 <i class="fa fa-caret-down" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                <li><a href="/basket?q=2"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Profile<?php else: ?>Профиль<?php endif; ?></a></li>
                                <li><a class="basket" href="<?php echo smarty_function_link(array('show' => 'basket'), $this);?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Basket<?php else: ?>Корзина<?php endif; ?><?php if ($this->_tpl_vars['ticketsCount'] > 0): ?> <span class="badge badge-info"><?php echo $this->_tpl_vars['ticketsCount']; ?>
</span><?php endif; ?></a></li>
                                <li><a href="<?php echo smarty_function_link(array('do' => 'userparticipantlogout'), $this);?>
"><i class="fa fa-sign-out" aria-hidden="true"></i> <span>Sign Out</span></a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div class="dropdown">
                            <a id="dLabel" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="text-decoration: none;">
                                <?php echo $this->_tpl_vars['this']['actor']->lastname; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['this']['actor']->name)) ? $this->_run_mod_handler('truncate', true, $_tmp, 2, ".") : smarty_modifier_truncate($_tmp, 2, ".")); ?>
 <i class="fa fa-caret-down" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                <li><a href="/basket?q=2"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Profile<?php else: ?>Профиль<?php endif; ?></a></li>
                                <li><a class="basket" href="<?php echo smarty_function_link(array('show' => 'basket'), $this);?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Basket<?php else: ?>Корзина<?php endif; ?><?php if ($this->_tpl_vars['ticketsCount'] > 0): ?> <span class="badge badge-info"><?php echo $this->_tpl_vars['ticketsCount']; ?>
</span><?php endif; ?></a></li>
                                <li><a href="<?php echo smarty_function_link(array('do' => 'logout'), $this);?>
"><i class="fa fa-sign-out" aria-hidden="true"></i> <span>Sign Out</span></a></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <button type="button" id="nav-mobile-toggle" class="menu-toggle"><span></span></button>
                <a href="<?php echo smarty_function_link(array('show' => 'avatar'), $this);?>
" class="avatar-link bounce d-none" data-toggle="tooltip" data-placement="bottom" aria-hidden="true" data-original-title="Сделать аватар"><i class="fa fa-id-badge" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
    <div class="nav-mobile-area">
        <nav class="nav-mobile" id="nav-mobile-nav">
            <div class="l-container" id="nav-mobile"></div>
        </nav>
    </div>
    <?php if ($this->_tpl_vars['time'] < '1578960000'): ?>
        <div id="snow">
            <div class="lay_1"></div>
            <div class="lay_2"></div>
            <div class="lay_3"></div>
        </div>
    <?php endif; ?>
</header>
<?php endif; ?>