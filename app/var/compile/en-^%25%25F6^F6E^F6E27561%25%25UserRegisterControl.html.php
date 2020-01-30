<?php /* Smarty version 2.6.13, created on 2019-11-28 20:07:43
         compiled from /home/c484884/gastreet.com/www/app/Templates/UserRegisterControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/UserRegisterControl.html', 2, false),array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/UserRegisterControl.html', 15, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['UserRegisterControl']); ?>
<?php echo smarty_function_formrestore(array('id' => "user-register"), $this);?>


<div class="container">
    <div class="page-container has-pos-fix" id="page-container">
        <div class="row page-container-inner">
            <div class="col-md-8 l-as-row"><img class="img-responsive" src="/content/welcome.jpg"></div>
            <div class="col-md-4 l-as-row">
                <ul class="breadcrumbs">
                    <li><a href="/"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Home<?php else: ?>Главная<?php endif; ?></a></li>
                    <li><span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Registration<?php else: ?>Регистрация<?php endif; ?></span></li>
                </ul>
                <h1 class="page-headline"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Registration<?php else: ?>Регистрация<?php endif; ?></h1>
                <p class="reg-desc"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Please, enter your phone number for SMS confirmation<?php else: ?>После ввода телефона, мы вышлем Вам SMS уведомление для подтверждения номера<?php endif; ?></p>
                <form action="<?php echo smarty_function_link(array('do' => 'userregister'), $this);?>
" id="user-register" method="post">
                    <div class="form-group">
                        <label for="reg_phone"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Your phone:<?php else: ?>Ваш телефон: +7...<?php endif; ?></label>
                        <input class="form-control" autocomplete="off" id="reg_phone" name="phone" data-validate="validate(required, maxlength(20))" type="text" />
                    </div>
                    <div class="form-group hidden">
                        <label for="reg_you_about_us"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>How did you hear about Gastreet?<?php else: ?>Как Вы узнали о Gastreet?<?php endif; ?></label>
                        <input class="form-control" autocomplete="off" id="reg_you_about_us" name="youAboutUs" data-validate="validate(required, maxlength(100))" value="empty" type="text" />
                    </div>
                    <div class="form-group" id="reg_hide_code">
                        <label for="reg_code"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>SMS Code:<?php else: ?>Код СМС:<?php endif; ?></label>
                        <input class="form-control" type="password" autocomplete="off" id="reg_code" name="code" maxlength="10" data-validate="validate(required, digits)" />
                    </div>
                    <div class="form-submit">
                        <button id="reg_get_phone" class="reg_get_phone btn btn-white" type="submit"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Get Code<?php else: ?>Получить код<?php endif; ?></button>
                    </div>
                </form>
                <br>
                <a class="editdetail" href="<?php echo smarty_function_link(array('show' => 'userlogin'), $this);?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Login for registered<?php else: ?>Вход для зарегистрированных<?php endif; ?></a>
            </div>
        </div>
    </div>
</div>