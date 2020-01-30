<?php /* Smarty version 2.6.13, created on 2019-11-28 14:24:59
         compiled from /home/c484884/gastreet.com/www/app/Templates/layouts//index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/layouts//index.html', 16, false),array('function', 'displaynotification', '/home/c484884/gastreet.com/www/app/Templates/layouts//index.html', 33, false),array('function', 'component', '/home/c484884/gastreet.com/www/app/Templates/layouts//index.html', 47, false),array('function', 'control', '/home/c484884/gastreet.com/www/app/Templates/layouts//index.html', 51, false),)), $this); ?>
<!DOCTYPE html>
<html class="no-js" lang="<?php echo $this->_tpl_vars['lang']; ?>
">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <title><?php if ($this->_tpl_vars['pageTitle']): ?><?php echo $this->_tpl_vars['pageTitle']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['p'] > 1): ?> - Страница <?php echo $this->_tpl_vars['p']; ?>
<?php endif; ?></title>
        <meta name="description" content="<?php echo $this->_tpl_vars['pageDesc']; ?>
"/>
        <meta name="keywords" content=""/>
        <meta name="robots" content="index,follow,noodp,noydir"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <link rel="icon" href="/images/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
        <meta property="og:image" content="https://gastreet.com/images/fb_share_6.jpg">

        <?php echo smarty_function_loadscript(array('file' => '/js/owl.carousel/assets/owl.carousel.min.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/owl.carousel/assets/owl.theme.default.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/css/bootstrap4/css/bootstrap.min.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/lightgallery/css/lightgallery.min.css','type' => 'css'), $this);?>


        <?php echo smarty_function_loadscript(array('file' => '/css/modal-window.css','type' => 'css'), $this);?>


        <?php echo smarty_function_loadscript(array('file' => '/css/docs.min.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/css/half-slider.css','type' => 'css'), $this);?>


        <?php echo smarty_function_loadscript(array('file' => '/css/gss/styles-new.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/css/style.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/css/style-gss.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/css/style.last.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/css/font-awesome.min.css','type' => 'css'), $this);?>


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
    <body class="d-flex flex-column h-100">
        <?php echo smarty_function_component(array('name' => 'Topmenu'), $this);?>

        <main role="main" class="flex-shrink-0 pb-4">
            <div class="l-site">
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['CURRENT_CONTROL_TEMPLATE'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                <?php echo smarty_function_control(array('name' => 'Age'), $this);?>

            </div>
        </main>
        <?php echo smarty_function_control(array('name' => 'Footer'), $this);?>

        <?php echo smarty_function_control(array('name' => 'Webstat'), $this);?>

        <?php echo smarty_function_control(array('name' => 'Avatarlink'), $this);?>


        <?php if ($this->_tpl_vars['jivoSite'] == 1): ?>
            <?php echo smarty_function_loadscript(array('file' => '/js/jivosite.js','type' => 'js'), $this);?>

        <?php endif; ?>

        <?php echo smarty_function_loadscript(array('file' => '/js/jquery.min.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/modernizr/modernizr.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/viewport-size/viewportSize-min.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/css/bootstrap4/js/popper.min.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/css/bootstrap4/js/bootstrap.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/owl.carousel/owl.carousel.min.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/lightgallery/js/lightgallery.min.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/lightgallery/js/lg-video.min.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/isotope/isotope.pkgd.min.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/jquery.cookie.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/jquery.capSlide.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/app/layout.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/app/app.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/vkpixel.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/fbpixel.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/pages/userregister.js','type' => 'js'), $this);?>

        <?php if ($this->_tpl_vars['app']): ?>
            <script type="text/javascript" src="https://sdk.eventicious.com/eventicious_sdk-1.0.js"></script>
            <?php echo smarty_function_loadscript(array('file' => '/js/eventicious.sdk.js','type' => 'js'), $this);?>

            <?php echo smarty_function_loadscript(array('file' => '/js/eventicious.js','type' => 'js'), $this);?>

        <?php endif; ?>
        <?php echo $this->_tpl_vars['includedJS']; ?>

    </body>
</html>