<?php /* Smarty version 2.6.13, created on 2020-01-14 01:39:00
         compiled from /home/c484884/gastreet.com/www/app/Templates/ContactsControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', '/home/c484884/gastreet.com/www/app/Templates/ContactsControl.html', 34, false),array('modifier', 'dbtexttohtml', '/home/c484884/gastreet.com/www/app/Templates/ContactsControl.html', 40, false),array('modifier', 'mobilephone', '/home/c484884/gastreet.com/www/app/Templates/ContactsControl.html', 46, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ContactsControl']); ?>

<div class="jumbotron-blank">
    <div class="container">
        <div class="content">
            <ul class="breadcrumbs">
                <li><a href="/">Home</a></li>
                <li><span>Contacts</span></li>
            </ul>
        </div>
    </div>
</div>

<div class="page-container mb-5" id="page-container">
    <div class="container">
        <div class="row">
            <div class="offset-md-7 col-md-5">
                <div class="g-emoji-content">
                    <div class="g-emoji-icon">
                        <img src="/images/emoji/13.png" class="img-fluid" alt="">
                    </div>
                    <div class="g-emoji-balun">Есть вопросы - звони, не стесняйся!</div>
                </div>
            </div>
        </div>
        <div class="row text-center contacts-tabs justify-content-center">
            <div class="col-6 col-md-3 h5"><a href="#" data-target=".type_participants" class="active"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>For participants<?php else: ?>Участникам<?php endif; ?></a></div>
            <div class="col-6 col-md-3 h5"><a href="#" data-target=".type_partners"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>For partners<?php else: ?>Партнёрам<?php endif; ?></a></div>
            <div class="col-6 col-md-3 h5"><a href="#" data-target=".type_speakers"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>For speakers<?php else: ?>Спикерам<?php endif; ?></a></div>
            <div class="col-6 col-md-3 h5"><a href="#" data-target=".type_volunteers"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>For volunteers<?php else: ?>Волонтёрам<?php endif; ?></a></div>
        </div>

        <?php $_from = $this->_tpl_vars['this']['cType']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['type']):
?>
        <div class="row <?php echo ((is_array($_tmp=$this->_tpl_vars['k'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
 <?php if ($this->_tpl_vars['k'] == 'TYPE_PARTICIPANTS'): ?>active<?php endif; ?> contacts-tabs-item">
            <div class="col-md-12">
                <?php $_from = $this->_tpl_vars['this']['cmList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['contact']):
?>
                    <?php if ($this->_tpl_vars['k'] == $this->_tpl_vars['contact']->type): ?>
                    <div class="row pt-3">
                        <div class="col-md-4 col-desc">
                            <p><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['contact']->title_en)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['contact']->title)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
<?php endif; ?></p>
                        </div>
                        <div class="col-md-1 d-none d-md-block"><span class="line"></span></div>
                        <div class="col-md-3 col-contacts">
                            <p class="name"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['contact']->name_en)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['contact']->name)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
<?php endif; ?></p>
                            <?php if ($this->_tpl_vars['contact']->email): ?><p class="email"><a href="mailto:<?php echo $this->_tpl_vars['contact']->email; ?>
"><?php echo $this->_tpl_vars['contact']->email; ?>
</a></p><?php endif; ?>
                            <?php if ($this->_tpl_vars['contact']->phone): ?><p class="phone"><?php echo ((is_array($_tmp=$this->_tpl_vars['contact']->phone)) ? $this->_run_mod_handler('mobilephone', true, $_tmp) : smarty_modifier_mobilephone($_tmp)); ?>
</p><?php endif; ?>
                            <?php if ($this->_tpl_vars['contact']->facebookurl): ?>
                                <p class="email"><a href="<?php echo $this->_tpl_vars['contact']->facebookurl; ?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Facebook page<?php else: ?>Страница на Facebook<?php endif; ?></a></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                            <?php if ($this->_tpl_vars['k'] == 'TYPE_PARTICIPANTS'): ?>
                                <?php if ($this->_tpl_vars['contact']->whatsapp || $this->_tpl_vars['contact']->viber || $this->_tpl_vars['contact']->facebookurl): ?>
                                <p>Чат с оператором</p>
                                <div class="contacts-icons">
                                    <?php if ($this->_tpl_vars['contact']->whatsapp): ?>
                                        <a href="https://api.whatsapp.com/send?phone=<?php echo $this->_tpl_vars['contact']->whatsapp; ?>
" target="_blank" class="whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                                    <?php endif; ?>
                                    <?php if ($this->_tpl_vars['contact']->viber && $this->_tpl_vars['browser'] == 'Safari'): ?>
                                        <a href="viber://add?number=<?php echo $this->_tpl_vars['contact']->viber; ?>
" class="viber"><i class="fa fa-viber" aria-hidden="true"></i></a>
                                    <?php endif; ?>
                                    <?php if ($this->_tpl_vars['contact']->telegram): ?>
                                        <a href="tg://resolve?domain=<?php echo $this->_tpl_vars['contact']->telegram; ?>
" class="telegram"><i class="fa fa-telegram" aria-hidden="true"></i></a>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            <?php elseif ($this->_tpl_vars['contact']->email == 'pr@gastreet.com'): ?>
<!--                                <a target="_blank" href="https://goo.gl/forms/ytZNdskZKKP5qTxj1" class="btn-press-form">Заполнить форму аккредитации для прессы</a>-->
                            <?php elseif ($this->_tpl_vars['contact']->email == 'gamaiun@restalliance.ru'): ?>
                                <a target="_blank" href="mailto:gamaiun@restalliance.ru" class="btn-press-form">Отправить запрос на участие</a>
                            <?php elseif ($this->_tpl_vars['contact']->email == 'crazy@gastreet.com'): ?>
                                <a target="_blank" href="mailto:crazy@gastreet.com" class="btn-press-form">Отправить запрос на участие</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </div>
        </div>
        <?php endforeach; endif; unset($_from); ?>
    </div>
</div>