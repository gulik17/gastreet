<?php /* Smarty version 2.6.13, created on 2019-11-29 10:03:33
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/EditAreaControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditAreaControl.html', 2, false),array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditAreaControl.html', 4, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditAreaControl.html', 14, false),array('function', 'html_options', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditAreaControl.html', 20, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['EditAreaControl']); ?>
<?php echo smarty_function_formrestore(array('id' => 'form'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/fckeditor/jquery.FCKEditor.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/fckeditor/jquery.form.js','type' => 'js'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/md5.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/caretaker.js','type' => 'js'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/pages/adminkaeditarea.js','type' => 'js'), $this);?>



<h2><?php if ($this->_tpl_vars['this']['area']): ?>Редактирование <?php else: ?>Создание <?php endif; ?> программы</h2>
<form id="form" action="<?php echo smarty_function_alink(array('do' => 'savearea'), $this);?>
" method="post" enctype="multipart/form-data" onsubmit="ignoreSnapshot();">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['this']['area']->id; ?>
" />
    <div class="row">
        <div class="col-md-3 form-group">
            <label>Статус:</label>
            <select class="form-control" name="status" id="status">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['statusList'],'selected' => $this->_tpl_vars['this']['area']->status), $this);?>

            </select>
        </div>
        <div class="col-md-3 form-group">
            <label>Тип программы:</label>
            <select class="form-control" name="areaTypeId" id="areaTypeId">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['areaTypes'],'selected' => $this->_tpl_vars['this']['area']->areaTypeId), $this);?>

            </select>
        </div>
        <div class="col-md-3 form-group">
            <label>Цвет (hex: #e3e3e3):</label>
            <input class="form-control" type="text" name="color" id="color" value="<?php echo $this->_tpl_vars['this']['area']->color; ?>
"/>
        </div>
        <div class="col-md-3 form-group">
            <label>Сортировка:</label>
            <input class="form-control" type="text" name="sortOrder" id="sortOrder" value="<?php echo $this->_tpl_vars['this']['area']->sortOrder; ?>
"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label>Название:</label>
            <input class="form-control" type="text" name="name" id="name" value="<?php echo $this->_tpl_vars['this']['area']->name; ?>
"/>
        </div>
        <div class="col-md-6 form-group">
            <label>Название (англ):</label>
            <input class="form-control" type="text" name="name_en" id="name_en" value="<?php echo $this->_tpl_vars['this']['area']->name_en; ?>
"/>
        </div>
    </div>
    <div class="form-group">
        <label>Описание:</label>
        <textarea class="form-control" name="description" rows="12" id="description"><?php echo $this->_tpl_vars['this']['area']->description; ?>
</textarea>
    </div>
    <div class="form-group">
        <label>Описание (англ):</label>
        <textarea class="form-control" name="description_en" rows="12" id="description_en"><?php echo $this->_tpl_vars['this']['area']->description_en; ?>
</textarea>
    </div>
    <div class="form-group">
        <label>Описание фото:</label>
        <textarea class="form-control" rows="8" name="photoDescription"><?php echo $this->_tpl_vars['this']['area']->photoDescription; ?>
</textarea>
    </div>
    <div class="form-group">
        <label>Аннотация:</label>
        <textarea class="form-control" rows="8" name="annotation"><?php echo $this->_tpl_vars['this']['area']->annotation; ?>
</textarea>
    </div>
    <div class="form-group">
        <label>Ссылка на страницу:</label>
        <input class="form-control" name="url" id="url" value="<?php echo $this->_tpl_vars['this']['area']->url; ?>
"/>
    </div>

    <?php if ($this->_tpl_vars['this']['areaImg1']): ?>
        <div class="form-group">
            <label>Картинка №1 (600x300):</label>
            <img class="img-responsive" src="/images/areas/resized/<?php echo $this->_tpl_vars['this']['areaImg1']; ?>
?v=<?php echo $this->_tpl_vars['this']['area']->tsUpdated; ?>
" />
        </div>
    <?php endif; ?>
    <div class="form-group" id="file-dl1">
        <label id="file-dt1"><?php if ($this->_tpl_vars['this']['areaImg1']): ?>Заменить<?php else: ?>Загрузить<?php endif; ?> картинку №1 (600x300):</label>
        <div id="file-dd1">
            <input class="u-file form-control" name="file1" type="file" />
	    </div>
    </div>

    <?php if ($this->_tpl_vars['this']['areaImg2']): ?>
        <div class="form-group">
            <label>Картинка №2 (218x220):</label>
            <img class="img-responsive" src="/images/areas/resized/<?php echo $this->_tpl_vars['this']['areaImg2']; ?>
?v=<?php echo $this->_tpl_vars['this']['area']->tsUpdated; ?>
" />
	    </div>
    <?php endif; ?>
    <div class="form-group" id="file-dl2">
        <label id="file-dt2"><?php if ($this->_tpl_vars['this']['areaImg2']): ?>Заменить<?php else: ?>Загрузить<?php endif; ?> картинку №2 (218x220):</label>
        <div id="file-dd2">
            <input class="u-file form-control" name="file2" type="file" />
        </div>
    </div>

    <?php if ($this->_tpl_vars['this']['areaImg3']): ?>
        <div class="form-group">
            <label>Картинка №3 (800x960):</label>
            <img class="img-responsive" src="/images/areas/resized/<?php echo $this->_tpl_vars['this']['areaImg3']; ?>
?v=<?php echo $this->_tpl_vars['this']['area']->tsUpdated; ?>
" />
        </div>
    <?php endif; ?>
    
    <div class="form-group" id="file-dl3">
        <label id="file-dt3"><?php if ($this->_tpl_vars['this']['areaImg3']): ?>Заменить<?php else: ?>Загрузить<?php endif; ?> картинку №3 (800x960):</label>
        <div id="file-dd3">
            <input class="u-file form-control" name="file3" type="file" />
        </div>
    </div>

    <div class="form-group">
        <input class="btn btn-success" id="submitArea" type="submit" value="Сохранить"/>
    </div>
</form>

<br/><br/>&nbsp;