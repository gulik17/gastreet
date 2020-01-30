<?php /* Smarty version 2.6.13, created on 2019-11-28 16:02:41
         compiled from /home/c484884/gastreet.com/www/app/Templates/UserLoginControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/UserLoginControl.html', 2, false),array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/UserLoginControl.html', 14, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['UserLoginControl']); ?>
<?php echo smarty_function_formrestore(array('id' => "user-login"), $this);?>


<div class="container">
    <div class="page-container has-pos-fix" id="page-container">
        <div class="row page-container-inner">
            <div class="l-col-dsk-8 l-as-row"><img class="img-responsive" src="/content/welcome.jpg"></div>
            <div class="l-col-dsk-4 l-as-row">
                <ul class="breadcrumbs">
                    <li><a href="/"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Home<?php else: ?>Главная<?php endif; ?></a></li>
                    <li><span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Login<?php else: ?>Вход<?php endif; ?></span></li>
                </ul>
                <h1 class="page-headline"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Login<?php else: ?>Авторизация<?php endif; ?></h1>
                <form action="<?php echo smarty_function_link(array('do' => 'userlogin'), $this);?>
" id="user-login" method="post" autocomplete="off">
                    <div class="form-group">
                        <label for="reg_phone"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Your Phone:<?php else: ?>Ваш телефон: +7...<?php endif; ?></label>
                        <input class="form-control" autocomplete="off" id="reg_phone" name="phone" data-validate="validate(required, maxlength(20))" type="text" />
                    </div>
                    <div class="form-group">
                        <label for="reg_code"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>SMS Code:<?php else: ?>Код СМС:<?php endif; ?></label>
                        <input class="form-control" autocomplete="off" type="password" id="reg_code" name="code" maxlength="10" data-validate="validate(required, digits)" />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-white"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Login<?php else: ?>Вход<?php endif; ?></button>
                    </div>
                </form>
                <br/>
                <a class="editdetail" href="<?php echo smarty_function_link(array('show' => 'userregister'), $this);?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Register (forgot the password?)<?php else: ?>Регистрация (забыли пароль?)<?php endif; ?></a>
            </div>
        </div>
    </div>
</div>