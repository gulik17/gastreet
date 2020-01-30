<?php /* Smarty version 2.6.13, created on 2019-12-28 03:39:00
         compiled from /home/c484884/gastreet.com/www/app/Templates/layouts//landingindex.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'displaynotification', '/home/c484884/gastreet.com/www/app/Templates/layouts//landingindex.html', 25, false),array('function', 'control', '/home/c484884/gastreet.com/www/app/Templates/layouts//landingindex.html', 40, false),)), $this); ?>
<!DOCTYPE html>
<html lang="<?php echo $this->_tpl_vars['lang']; ?>
">
    <head>
        <meta charset="utf-8">
        <title><?php echo $this->_tpl_vars['pageTitle']; ?>
</title>
        <base href="//<?php echo $this->_tpl_vars['host']; ?>
/"/>
        <meta property="og:title" content="<?php echo $this->_tpl_vars['pageTitle']; ?>
"/>
        <meta name="keywords" content=""/>
        <meta name="description" content="<?php echo $this->_tpl_vars['pageDesc']; ?>
"/>
        <meta property="og:description" content="<?php echo $this->_tpl_vars['pageDesc']; ?>
"/>
        <meta property="og:image" content="https://gastreet.com/images/fb_share_6.jpg">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
        <link rel="shortcut icon" href="/app/landing/favicon.ico"/>
        <link rel="apple-touch-icon" href="/app/landing/images/touch-icon-iphone.png"/>
        <link rel="apple-touch-icon" sizes="152x152" href="/app/landing/images/touch-icon-ipad.png"/>
        <link rel="apple-touch-icon" sizes="180x180" href="/app/landing/images/touch-icon-iphone-retina.png"/>
        <link rel="apple-touch-icon" sizes="167x167" href="/app/landing/images/touch-icon-ipad-retina.png"/>
        <link rel="stylesheet" type="text/css" href="/app/landing/css/owl.carousel.min.css"/>
        <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/app/landing/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="/app/landing/css/style.css"/>
        
        <script>
            var message = '<?php echo smarty_function_displaynotification(array(), $this);?>
';
        </script>
        <link rel="manifest" href="/manifest.json">
        <script src="https://cdn.viapush.com/cdn/v1/sdks/viapush.js" async="" charset="UTF-8"></script>
        <?php echo '
        <script>
            var ViaPush = window.ViaPush || [];
            ViaPush.push(["init", { appId: "b58fa8ab-cf0e-8196-4952-9be21bc2b1f6" }]);
        </script>
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-869423439"></script>
        <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag(\'js\', new Date()); gtag(\'config\', \'AW-869423439\'); </script>
        '; ?>

    </head>
    <body>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['CURRENT_CONTROL_TEMPLATE'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php echo smarty_function_control(array('name' => 'Webstat'), $this);?>

        <?php echo smarty_function_control(array('name' => 'Avatarlink'), $this);?>


        <?php if ($this->_tpl_vars['jivoSite'] == 1): ?>
            <script src="/js/jivosite.js"></script>
        <?php endif; ?>

        <script src="/js/jquery.min.js" type="text/javascript"></script>
        <script src="/js/jquery.inputmask.min.js"></script>
        <script src="/js/inputmask/phone-codes/phone.min.js"></script>
        <script src="/app/landing/js/owl.carousel.min.js"></script>
        <script src="/app/landing/js/bootstrap.js"></script>
        <script src="/js/jquery.cookie.js"></script>
        <script src="/app/landing/js/main.js"></script>
        <?php echo $this->_tpl_vars['includedJS']; ?>

    </body>
</html>