<?php /* Smarty version 2.6.13, created on 2019-12-02 11:16:06
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/EditBroadcastTemplateControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditBroadcastTemplateControl.html', 2, false),array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditBroadcastTemplateControl.html', 4, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditBroadcastTemplateControl.html', 11, false),array('function', 'html_options', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditBroadcastTemplateControl.html', 16, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['EditBroadcastTemplateControl']); ?>
<?php echo smarty_function_formrestore(array('id' => 'form'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/fckeditor/jquery.FCKEditor.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/fckeditor/jquery.form.js','type' => 'js'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/md5.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/caretaker.js','type' => 'js'), $this);?>


<h2><?php echo $this->_tpl_vars['pageTitle']; ?>
</h2>
<form id="form" action="<?php echo smarty_function_alink(array('do' => 'savebroadcasttemplate'), $this);?>
" method="post" enctype="multipart/form-data" onsubmit="ignoreSnapshot();">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['this']['broadcastTemplate']->id; ?>
" />
    <div class="form-group">
        <label>Статус:</label>
        <select class="form-control" name="status" id="status">
            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['statusList'],'selected' => $this->_tpl_vars['this']['broadcastTemplate']->status), $this);?>

        </select>
    </div>
    <div class="form-group">
        <label>Редактирование:</label>
        <select class="form-control" name="editType" id="editType">
            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['editType'],'selected' => $this->_tpl_vars['this']['broadcastTemplate']->editType), $this);?>

        </select>
    </div>
    <div class="form-group">
        <label>Тип уведомления:</label>
        <select class="form-control" name="sendType" id="sendType">
            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['sendType'],'selected' => $this->_tpl_vars['this']['broadcastTemplate']->sendType), $this);?>

        </select>
    </div>
    <div class="form-group">
        <label>Тип тригера:</label>
        <select class="form-control" name="triggerType" id="triggerType">
            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['triggerType'],'selected' => $this->_tpl_vars['this']['broadcastTemplate']->triggerType), $this);?>

        </select>
    </div>
    <div class="form-group" id="messageEl">
        <label>Текст уведомления:</label>
        <textarea class="form-control" name="message" id="message" rows="8"><?php echo $this->_tpl_vars['this']['broadcastTemplate']->message; ?>
</textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-success" id="submitPlace" type="submit" value="Сохранить"/>
    </div>
</form>