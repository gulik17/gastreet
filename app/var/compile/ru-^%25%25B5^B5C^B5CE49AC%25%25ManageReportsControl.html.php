<?php /* Smarty version 2.6.13, created on 2019-11-28 17:41:45
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManageReportsControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageReportsControl.html', 5, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManageReportsControl']); ?>

<h2>Отчеты, статистика</h2><br/>

<p><a href="<?php echo smarty_function_alink(array('show' => 'managereport'), $this);?>
">Отчёт о покупателях</a></p>

<p><a href="<?php echo smarty_function_alink(array('show' => 'reportregistrations'), $this);?>
">Конверсия регистраций</a></p>

<p><a href="<?php echo smarty_function_alink(array('show' => 'reportpurchases'), $this);?>
">Конверсия покупок</a></p>

<p><a href="<?php echo smarty_function_alink(array('show' => 'reportfewproducts'), $this);?>
">Малый остаток товаров</a></p>

<p><a href="<?php echo smarty_function_alink(array('show' => 'reportlotsproducts'), $this);?>
">Большой остаток товаров</a></p>

<p><a href="<?php echo smarty_function_alink(array('show' => 'reportcountproducts'), $this);?>
">Остаток товаров</a></p>

<p><a href="<?php echo smarty_function_alink(array('show' => 'reportpayproduct'), $this);?>
">Выгрузка купленных МК</a></p>