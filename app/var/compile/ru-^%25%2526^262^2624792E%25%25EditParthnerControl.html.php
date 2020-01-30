<?php /* Smarty version 2.6.13, created on 2019-12-05 22:50:53
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/EditParthnerControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditParthnerControl.html', 2, false),array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditParthnerControl.html', 4, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditParthnerControl.html', 11, false),array('function', 'html_options', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditParthnerControl.html', 20, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['EditParthnerControl']); ?>
<?php echo smarty_function_formrestore(array('id' => 'form'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/md5.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/caretaker.js','type' => 'js'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/pages/adminkaeditparthner.js','type' => 'js'), $this);?>



<h2><?php if ($this->_tpl_vars['this']['ticket']): ?>Редактирование <?php else: ?>Создание <?php endif; ?> партнера</h2>
<form id="form" action="<?php echo smarty_function_alink(array('do' => 'saveparthner'), $this);?>
" method="post" enctype="multipart/form-data" onsubmit="ignoreSnapshot();" style="max-width: 400px;">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['this']['parthner']->id; ?>
" />
    <div class="form-group">
        <label>Порядок сортировки:</label>
        <input class="form-control" type="text" name="sortOrder" id="sortOrder" value="<?php echo $this->_tpl_vars['this']['parthner']->sortOrder; ?>
"/>
    </div>
    <div class="form-group">
        <label>Статус:</label>
        <select class="form-control" name="status" id="status">
            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['statusList'],'selected' => $this->_tpl_vars['this']['parthner']->status), $this);?>

        </select>
    </div>
    <div class="form-group">
        <label>Тип партнера:</label>
        <select class="form-control" name="parthnerTypeId" id="parthnerTypeId">
            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['parthnerTypes'],'selected' => $this->_tpl_vars['this']['parthner']->parthnerTypeId), $this);?>

        </select>
    </div>
    <div class="form-group">
        <label>Название:</label>
        <input class="form-control" type="text" name="name" id="name" value="<?php echo $this->_tpl_vars['this']['parthner']->name; ?>
"/>
    </div>
    <div class="form-group">
        <label>Заголовок на главной:</label>
        <input class="form-control" type="text" name="title" id="title" value="<?php echo $this->_tpl_vars['this']['parthner']->title; ?>
"/>
    </div>
    <div class="form-group">
        <label>Ссылка:</label>
        <input class="form-control" type="text" name="url" id="url" value="<?php echo $this->_tpl_vars['this']['parthner']->url; ?>
"/>
    </div>
    <div class="form-group" id="file-dl">
        <label id="file-dt"><?php if ($this->_tpl_vars['this']['parthnerImg']): ?>Заменить картинку:<?php else: ?>Загрузить картинку:<?php endif; ?></label>
        <div id="file-dd">
            <input class="u-file form-control" name="file1" type="file" />
        </div>
    </div>
    <div class="form-group">
        <input class="btn btn-success" id="submitParthner" type="submit" value="Сохранить"/>
    </div>
</form>

<?php if ($this->_tpl_vars['this']['parthnerImg']): ?>
    <h4>Картинка:</h4>
    <img src="/images/parthners/resized/<?php echo $this->_tpl_vars['this']['parthnerImg']; ?>
?v=<?php echo $this->_tpl_vars['this']['parthner']->tsUpdate; ?>
" style="background-color: #aaa;" />
<?php endif; ?>

<br/><br/>&nbsp;