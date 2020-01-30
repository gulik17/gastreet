<?php /* Smarty version 2.6.13, created on 2020-01-14 15:45:53
         compiled from /home/c484884/gastreet.com/www/app/Templates/layouts/adminkaindex.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/layouts/adminkaindex.html', 3, false),array('function', 'revision', '/home/c484884/gastreet.com/www/app/Templates/layouts/adminkaindex.html', 5, false),array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/layouts/adminkaindex.html', 8, false),array('function', 'displayerror', '/home/c484884/gastreet.com/www/app/Templates/layouts/adminkaindex.html', 15, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/layouts/adminkaindex.html', 17, false),)), $this); ?>
<!DOCTYPE html>
<html lang="ru">
    <?php echo smarty_function_formrestore(array('id' => "operator-login"), $this);?>

    <head>
        <title><?php echo $this->_tpl_vars['pageTitle']; ?>
 <?php echo smarty_function_revision(array(), $this);?>
</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700">
        <?php echo smarty_function_loadscript(array('file' => '/css/adminka.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/plugins/chosen/chosen.min.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/css/adminkalogin.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => "/js/jquery.js",'type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => "/js/plugins/chosen/chosen.jquery.min.js",'type' => 'js'), $this);?>

    </head>
    <body>
        <?php echo smarty_function_displayerror(array(), $this);?>

        <div id="login">
            <form name="form-login" id="operator-login" action="<?php echo smarty_function_alink(array('do' => 'operatorlogin'), $this);?>
" method="post">
                <span><i class="fa fa-user" aria-hidden="true"></i></span>
                <input type="text" id="email" name="email" placeholder="Email">
                <span><i class="fa fa-lock" aria-hidden="true"></i></span>
                <input type="password" name="password" id="password" placeholder="Password">
                <input type="submit" value="Войти">
            </form>
        </div>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['CURRENT_CONTROL_TEMPLATE'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </body>
</html>