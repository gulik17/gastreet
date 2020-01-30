<?php /* Smarty version 2.6.13, created on 2019-12-16 13:19:11
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/MasterpasswordControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/MasterpasswordControl.html', 2, false),array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/adminka/MasterpasswordControl.html', 4, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/MasterpasswordControl.html', 10, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['MasterpasswordControl']); ?>
<?php echo smarty_function_formrestore(array('id' => "edit-hint"), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/css/ketchup/jquery.ketchup.css','type' => 'css'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/ketchup/jquery.ketchup.all.min.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/pages/adminkamasterpassword.js','type' => 'js'), $this);?>


<h2>Смена мастер-пароля (подходит ко всем аккаунтам)</h2>

<form id="edit-hint" method="post" action="<?php echo smarty_function_alink(array('do' => 'savemaster'), $this);?>
" style="max-width: 400px;">
	<div class="form-group">
		<label>Новый мастер-пароль:</label>
                <input class="form-control" type="text" data-validate="validate(required, maxlength(255))" name="master"/>
	</div>
	<input class="btn btn-primary" id="submitHint" type="submit" value="Сохранить"/>
</form>