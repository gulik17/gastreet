<?php /* Smarty version 2.6.13, created on 2019-12-03 16:39:28
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/SettingsManagerControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/SettingsManagerControl.html', 2, false),array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/adminka/SettingsManagerControl.html', 4, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/SettingsManagerControl.html', 9, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['SettingsManagerControl']); ?>
<?php echo smarty_function_formrestore(array('id' => 'st_edit'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/md5.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/caretaker.js','type' => 'js'), $this);?>



<h2>Редактирование настроек сайта</h2>
<form id="st_edit" action="<?php echo smarty_function_alink(array('do' => 'savesettings'), $this);?>
" method="post" onsubmit="ignoreSnapshot();">
<?php $_from = $this->_tpl_vars['this']['settingslist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oneitem']):
?>
    <div class="form-group">
        <label><?php echo $this->_tpl_vars['oneitem']['description']; ?>
</label>
        <?php if ($this->_tpl_vars['oneitem']['type'] == 'TYPE_TEXT'): ?>
            <input class="form-control" type="text" name="<?php echo $this->_tpl_vars['oneitem']['name']; ?>
" value="<?php echo $this->_tpl_vars['oneitem']['value']; ?>
" />
        <?php endif; ?>
        <?php if ($this->_tpl_vars['oneitem']['type'] == 'TYPE_CHECKBOX'): ?>
            <?php if ($this->_tpl_vars['oneitem']['value'] == 'on'): ?>
                <input class="form-control" type="checkbox" name="<?php echo $this->_tpl_vars['oneitem']['name']; ?>
" checked="checked" />
            <?php else: ?>
                <input class="form-control" type="checkbox" name="<?php echo $this->_tpl_vars['oneitem']['name']; ?>
" />
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php endforeach; endif; unset($_from); ?>
<dl>
    <dd>
        <input id="send_data_button" type="submit" class="btn btn-success" value="Сохранить"/>
    </dd>
</dl>
</form>