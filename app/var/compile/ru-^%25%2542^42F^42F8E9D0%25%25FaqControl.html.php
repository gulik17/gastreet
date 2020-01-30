<?php /* Smarty version 2.6.13, created on 2020-01-20 14:53:21
         compiled from /home/c484884/gastreet.com/www/app/Templates/FaqControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'dbtexttohtml', '/home/c484884/gastreet.com/www/app/Templates/FaqControl.html', 41, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['FaqControl']); ?>

<div class="container">
    <div class="page-container" id="page-container">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-container-image" id="page-container-image">
                    <picture>
                        <source srcset="content/page-faq.jpg" media="(min-width: 992px)">
                        <img class="img-fixed" src="content/page-faq-m.jpg">
                    </picture>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="page-container-inner" id="page-container-inner">
                    <ul class="breadcrumbs">
                        <li><a href="/">Главная</a></li>
                        <li><span>ЧаВо</span></li>
                    </ul>
                    <h1 class="page-headline">Вопрос/ответ</h1>

                    <div class="g-emoji-content">
                        <div class="g-emoji-icon">
                            <img src="/images/emoji/10.png" class="img-fluid" alt="">
                        </div>
                        <div class="g-emoji-balun">
                            Самые часто задаваемые вопросы здесь!
                        </div>
                    </div>

                    <?php if ($this->_tpl_vars['this']['fmList']): ?>
                    <!-- loop start -->
                    <?php $_from = $this->_tpl_vars['this']['fmList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['faq']):
?>
                    <div class="spoiler js-spoiler">
                        <div class="spoiler-head js-spoiler-head">
                            <div class="gss-question-point align-self-center"><span class="mark fa fa-g"></span></div>
                            <div class="gss-question align-self-center">
                                <span class="title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo $this->_tpl_vars['faq']->question_en; ?>
<?php else: ?><?php echo $this->_tpl_vars['faq']->question; ?>
<?php endif; ?></span>
                            </div>
                        </div>
                        <div class="spoiler-body js-spoiler-body"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['faq']->answer_en)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['faq']->answer)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)); ?>
<?php endif; ?></div>
                    </div>
                    <?php endforeach; endif; unset($_from); ?>
                    <!-- loop end -->
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>