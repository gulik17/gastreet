<?php /* Smarty version 2.6.13, created on 2019-11-28 17:41:50
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ReportRegistrationsControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/ReportRegistrationsControl.html', 2, false),array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/adminka/ReportRegistrationsControl.html', 4, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ReportRegistrationsControl']); ?>
<?php echo smarty_function_formrestore(array('id' => "report-registrations"), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/css/morris.css','type' => 'css'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/morris.min.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/jquery.placeholder.min.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/pages/adminkreportregistrations.js','type' => 'js'), $this);?>


<h2>Конверсия регистраций</h2>

<form name="report-registrations" method="post" action="" style="max-width: 400px;">
    <div class="well">
        <input type="hidden" name="isalive" value="1" />
        <div class="form-group form-inline">
            <label style="display: block;">Дата с:</label>
            <input class="form-control" type="text" name="startDay" value="<?php echo $this->_tpl_vars['this']['startDay']; ?>
" placeholder="дд" style="width:44px" /> - 
            <input class="form-control" type="text" name="startMonth" value="<?php echo $this->_tpl_vars['this']['startMonth']; ?>
" placeholder="мм" style="width:44px" /> - 
            <input class="form-control" type="text" name="startYear" value="<?php echo $this->_tpl_vars['this']['startYear']; ?>
" placeholder="гггг" style="width:60px" />
        </div>
        <div class="form-group form-inline">
            <label style="display: block;">Дата по:</label>
            <input class="form-control" type="text" name="finishDay" value="<?php echo $this->_tpl_vars['this']['finishDay']; ?>
" placeholder="дд" style="width: 44px;" /> - 
            <input class="form-control" type="text" name="finishMonth" value="<?php echo $this->_tpl_vars['this']['finishMonth']; ?>
" placeholder="мм" style="width: 44px;" /> - 
            <input class="form-control" type="text" name="finishYear" value="<?php echo $this->_tpl_vars['this']['finishYear']; ?>
" placeholder="гггг" style="width: 60px;" />
        </div>
        <input class="btn btn-info" type="submit" value="Показать" />
    </div>
</form>
<br/>

<div id="reportdatanewusers" style="display: none;"><?php echo $this->_tpl_vars['this']['newUsers']; ?>
</div>
<div id="reportdataregisterusers" style="display: none;"><?php echo $this->_tpl_vars['this']['registerUsers']; ?>
</div>
<div id="reportdatasummaryusers" style="display: none;"><?php echo $this->_tpl_vars['this']['summaryUsers']; ?>
</div>
<div id="myfirstchart" style="height: 400px;"></div>

<?php if ($this->_tpl_vars['this']['conversion']): ?>
<h4>Новых пользователей за период:</h4>
<p><?php echo $this->_tpl_vars['this']['summNewUsers']; ?>
</p>

<h4>Подтвержденных регистраций за период:</h4>
<p><?php echo $this->_tpl_vars['this']['summRegisterUsers']; ?>
</p>

<h4>Конверсия за период:</h4>
<p><?php echo $this->_tpl_vars['this']['conversion']; ?>
</p>
<?php endif; ?>