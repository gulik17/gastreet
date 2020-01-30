<?php /* Smarty version 2.6.13, created on 2019-12-18 10:51:50
         compiled from /home/c484884/gastreet.com/www/app/Templates/layouts/userhome.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/layouts/userhome.html', 17, false),array('function', 'displaynotification', '/home/c484884/gastreet.com/www/app/Templates/layouts/userhome.html', 37, false),array('function', 'component', '/home/c484884/gastreet.com/www/app/Templates/layouts/userhome.html', 51, false),array('function', 'control', '/home/c484884/gastreet.com/www/app/Templates/layouts/userhome.html', 57, false),)), $this); ?>
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

        <?php echo smarty_function_loadscript(array('file' => '/css/jquery-ui/jquery-ui.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/css/modal-window.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/css/font-awesome.min.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/owl.carousel/assets/owl.carousel.min.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/owl.carousel/assets/owl.theme.default.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/plugins/chosen/chosen.min.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/css/bootstrap4/css/bootstrap.min.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/css/docs.min.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/css/half-slider.css','type' => 'css'), $this);?>


        <?php echo smarty_function_loadscript(array('file' => '/css/gss/styles-new.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/css/style.css','type' => 'css'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/css/style-gss.css','type' => 'css'), $this);?>

        
        <?php echo smarty_function_loadscript(array('file' => '/js/jquery.min.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/jquery-ui.min.js','type' => 'js'), $this);?>


        <link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@19.8.0/dist/css/suggestions.min.css" rel="stylesheet" />

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
                <div class="container mt-5">
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['CURRENT_CONTROL_TEMPLATE'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </div>
                <?php echo smarty_function_control(array('name' => 'Age'), $this);?>

            </div>
        </main>
        <?php echo smarty_function_control(array('name' => 'Footer'), $this);?>

        <?php echo smarty_function_control(array('name' => 'Webstat'), $this);?>

        <?php echo smarty_function_control(array('name' => 'Avatarlink'), $this);?>


        <?php if ($this->_tpl_vars['jivoSite'] == 1 && ! $this->_tpl_vars['app'] && ! $this->_tpl_vars['dev']): ?>
            <?php echo smarty_function_loadscript(array('file' => '/js/jivosite.js','type' => 'js'), $this);?>

        <?php endif; ?>

        <?php echo smarty_function_loadscript(array('file' => '/js/modernizr/modernizr.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/viewport-size/viewportSize-min.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => '/js/plugins/chosen/chosen.jquery.min.js','type' => 'js'), $this);?>

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


        <?php echo $this->_tpl_vars['includedJS']; ?>

        <script src="https://cdn.jsdelivr.net/npm/suggestions-jquery@19.8.0/dist/js/jquery.suggestions.min.js"></script>
        <?php echo '
        <script>
            $("#tmp_add_city").suggestions({
                // Замените на свой API-ключ
                token: "130f8f12a29f4f7ca990ad4be6fe1f1e5bc497c1",
                type: "ADDRESS",
                geoLocation: false,
                constraints: {
                    locations: { country: "*" },
                    label: ""
                },
                onSelect: function(suggestion) {
                    $("#tmp_add_city").parents(".form-group").find(\'input[name=country]\').val(suggestion.data.country_iso_code.toLowerCase());
                    $("#tmp_add_city").parents(".form-group").find(\'input[name=city]\').val(suggestion.data.city);
                }
            });
            $("#tmp_edit_city").suggestions({
                // Замените на свой API-ключ
                token: "130f8f12a29f4f7ca990ad4be6fe1f1e5bc497c1",
                type: "ADDRESS",
                geoLocation: false,
                constraints: {
                    locations: { country: "*" },
                    label: ""
                },
                onSelect: function(suggestion) {
                    $("#tmp_edit_city").parents(".form-group").find(\'input[name=country]\').val(suggestion.data.country_iso_code.toLowerCase());
                    $("#tmp_edit_city").parents(".form-group").find(\'input[name=city]\').val(suggestion.data.city);
                }
            });
            $("#tmpaddress").suggestions({
                // Замените на свой API-ключ
                token: "130f8f12a29f4f7ca990ad4be6fe1f1e5bc497c1",
                type: "ADDRESS",
                geoLocation: false,
                constraints: {
                    locations: { country: "*" },
                    label: ""
                },
                onSelect: function(suggestion) {
                    $("#tmpaddress").parents(".form-group").find(\'input[name=countryName]\').val(suggestion.data.country_iso_code.toLowerCase());
                    $("#tmpaddress").parents(".form-group").find(\'input[name=cityName]\').val(suggestion.data.city);
                }
            });

            $("#tmpinn").suggestions({
                // Замените на свой API-ключ
                token: "130f8f12a29f4f7ca990ad4be6fe1f1e5bc497c1",
                type: "PARTY",
                onSelect: function(suggestion) {
                    console.log(suggestion.data.address);
                    $(\'#dadataOrganizationModal input[name=tmp_company]\').val(suggestion.value);
                    $(\'#dadataOrganizationModal input[name=tmp_inn]\').val(suggestion.data.inn);
                    $(\'#dadataOrganizationModal input[name=tmp_kpp]\').val(suggestion.data.kpp);
                    $(\'#dadataOrganizationModal input[name=tmp_address]\').val(suggestion.data.address.value);
                    if (suggestion.data.opf.short === "ИП") {
                        $(\'#dadataOrganizationModal input[name=tmp_company_type]\').val(3);
                    } else {
                        $(\'#dadataOrganizationModal input[name=tmp_company_type]\').val(2);
                    }
                }
            });

            $(document).ready(function() {
                $("select.chosen-select").chosen();
            });
        </script>
        '; ?>

    </body>
</html>