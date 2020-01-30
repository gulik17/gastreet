<?php /* Smarty version 2.6.13, created on 2020-01-14 16:05:14
         compiled from /home/c484884/gastreet.com/www/app/Templates/layouts/adminka.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/layouts/adminka.html', 10, false),array('function', 'component', '/home/c484884/gastreet.com/www/app/Templates/layouts/adminka.html', 49, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/layouts/adminka.html', 57, false),array('function', 'displayerror', '/home/c484884/gastreet.com/www/app/Templates/layouts/adminka.html', 70, false),)), $this); ?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Gastreet Admin Panel</title>
        <?php echo smarty_function_loadscript(array('file' => '/js/plugins/chosen/chosen.min.css','type' => 'css'), $this);?>

        <!-- Bootstrap Core CSS -->
        <?php echo smarty_function_loadscript(array('file' => '/css/bootstrap.min.css','type' => 'css'), $this);?>

        <!-- Custom CSS -->
        <?php echo smarty_function_loadscript(array('file' => '/css/sb-admin.css','type' => 'css'), $this);?>

        <!-- Morris Charts CSS -->
        <?php echo smarty_function_loadscript(array('file' => '/css/plugins/morris.css','type' => 'css'), $this);?>

        <!-- Custom Fonts -->
        <?php echo smarty_function_loadscript(array('file' => '/css/font-awesome.min.css','type' => 'css'), $this);?>


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- jQuery -->
        <?php echo smarty_function_loadscript(array('file' => '/js/jquery.js','type' => 'js'), $this);?>

        <?php echo smarty_function_loadscript(array('file' => "/js/plugins/chosen/chosen.jquery.min.js",'type' => 'js'), $this);?>

        <!-- Bootstrap Core JavaScript -->
        <?php echo smarty_function_loadscript(array('file' => '/js/bootstrap.min.js','type' => 'js'), $this);?>

        <!-- Morris Charts JavaScript -->
        <?php echo smarty_function_loadscript(array('file' => '/js/plugins/morris/raphael.min.js','type' => 'js'), $this);?>

    </head>
    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Переключатель</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand dropdown-toggle" type="button" id="dropdownMenuAdmin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Gastreet Admin Panel <b class="caret"></b></a>
                    <div class="navbar-admin dropdown-menu" aria-labelledby="dropdownMenuAdmin">
                        <?php echo smarty_function_component(array('name' => 'Adminkamenu'), $this);?>

                    </div>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $this->_tpl_vars['actor']->name; ?>
 <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo smarty_function_alink(array('show' => 'operatorpassword'), $this);?>
"><i class="fa fa-fw fa-unlock-alt"></i> Сменить пароль оператора</a></li>
                            <li><a href="<?php echo smarty_function_alink(array('show' => 'manageoperators'), $this);?>
"><i class="fa fa-fw fa-users"></i> Операторы</a></li>
                            <li><a href="<?php echo smarty_function_alink(array('show' => 'masterpassword'), $this);?>
"><i class="fa fa-fw fa-shield"></i> Сменить мастер-пароль</a></li>
                            <hr/>
                            <li><a href="<?php echo smarty_function_alink(array('do' => 'operatorlogout'), $this);?>
"><i class="fa fa-fw fa-power-off"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo smarty_function_displayerror(array(), $this);?>

                            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['CURRENT_CONTROL_TEMPLATE'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
        <?php echo '
        <script type="text/javascript">
            $(document).ready(function() {
                $("select.chosen-select").chosen();
            });
            $(window).keydown(function(event) {
                let saveBtn = $("input[type=submit][value=Сохранить]");
                if (saveBtn.length) {
                    let keyCode = event.keyCode;
                    if (event.ctrlKey && keyCode === 83) {
                        saveBtn.click();
                        return false
                    }
                }
            });
        </script>
        '; ?>

    </body>
</html>