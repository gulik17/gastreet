<?php /* Smarty version 2.6.13, created on 2020-01-09 09:49:48
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ReportPurchasesControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/ReportPurchasesControl.html', 2, false),array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/adminka/ReportPurchasesControl.html', 4, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ReportPurchasesControl']); ?>
<?php echo smarty_function_formrestore(array('id' => "report-purchases"), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/css/morris.css','type' => 'css'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/morris.min.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/jquery.placeholder.min.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/pages/adminkreportpurchases.js','type' => 'js'), $this);?>


<h2>Конверсия покупок</h2>
<form name="report-purchases" method="post" action="" style="max-width: 400px;">
    <div class="well">
        <input type="hidden" name="isalive" value="1" />
        <div class="filter-buyers form-group form-inline">
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
" placeholder="дд" style="width:44px" /> - 
            <input class="form-control" type="text" name="finishMonth" value="<?php echo $this->_tpl_vars['this']['finishMonth']; ?>
" placeholder="мм" style="width:44px" /> - 
            <input class="form-control" type="text" name="finishYear" value="<?php echo $this->_tpl_vars['this']['finishYear']; ?>
" placeholder="гггг" style="width:60px" />
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Показать" />
        </div>
    </div>
</form>
<br/>

<div id="reportdatanewpurchases" style="display: none;"><?php echo $this->_tpl_vars['this']['newBaskets']; ?>
</div>
<div id="reportdataregisterpurchases" style="display: none;"><?php echo $this->_tpl_vars['this']['paidBaskets']; ?>
</div>
<div id="reportdatasummarypurchases" style="display: none;"><?php echo $this->_tpl_vars['this']['summaryBaskets']; ?>
</div>
<div id="myfirstchart" style="height: 400px;"></div>

<?php if ($this->_tpl_vars['this']['conversion']): ?>
<h4>Положено в корзины за период:</h4>
<p><?php echo $this->_tpl_vars['this']['summNewBaskets']; ?>
</p>

<h4>Оплачено за период:</h4>
<p><?php echo $this->_tpl_vars['this']['summPaidBaskets']; ?>
</p>

<h4>Конверсия за период:</h4>
<p><?php echo $this->_tpl_vars['this']['conversion']; ?>
</p>
<?php endif; ?>