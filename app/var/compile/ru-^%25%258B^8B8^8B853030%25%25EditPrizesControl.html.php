<?php /* Smarty version 2.6.13, created on 2019-11-29 17:19:51
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/EditPrizesControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditPrizesControl.html', 2, false),array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditPrizesControl.html', 4, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditPrizesControl.html', 23, false),array('function', 'html_options', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditPrizesControl.html', 30, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['EditPrizesControl']); ?>
<?php echo smarty_function_formrestore(array('id' => 'form'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/jquery.placeholder.min.js','type' => 'js'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/fckeditor/jquery.FCKEditor.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/fckeditor/jquery.form.js','type' => 'js'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/md5.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/caretaker.js','type' => 'js'), $this);?>


<?php echo '
<script>
    $().ready(function() {
        $(\'input\').placeholder();
        $(\'#description\').fck({path: \'/fckeditor/\'});
        $(\'#description_en\').fck({path: \'/fckeditor/\'});
    });
</script>
'; ?>


<h2><?php if ($this->_tpl_vars['this']['news']): ?>Редактирование новости/ништяка<?php else: ?>Создание новости/ништяка<?php endif; ?></h2>
<form id="form" action="<?php echo smarty_function_alink(array('do' => 'saveprizes'), $this);?>
" method="post" enctype="multipart/form-data" onsubmit="ignoreSnapshot();">
    <div class="row">
        <div class="col-md-8">
            <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['this']['prize']->id; ?>
" />
            <div class="form-group">
                <label>Статус:</label>
                <select class="form-control" name="status" id="status">
                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['prizeStatuses'],'selected' => $this->_tpl_vars['this']['prize']->status), $this);?>

                </select>
            </div>
            <div class="form-group">
                <label>Заголовок:</label>
                <input type="text" class="form-control" name="name" maxlength="255" value="<?php echo $this->_tpl_vars['this']['prize']->name; ?>
"/>
            </div>
            <div class="form-group">
                <label>Заголовок (eng):</label>
                <input type="text" class="form-control" name="name_en" maxlength="255" value="<?php echo $this->_tpl_vars['this']['prize']->name_en; ?>
"/>
            </div>
            <div class="form-group">
                <label>Аннотация:</label>
                <textarea class="form-control" name="annotation" id="annotation" rows="8" cols="50"><?php echo $this->_tpl_vars['this']['prize']->annotation; ?>
</textarea>
            </div>
            <div class="form-group">
                <label>Аннотация (eng):</label>
                <textarea class="form-control" name="annotation_en" id="annotation_en" rows="8" cols="50"><?php echo $this->_tpl_vars['this']['prize']->annotation_en; ?>
</textarea>
            </div>
            <div class="form-group">
                <label>Текст:</label>
                <textarea class="form-control" name="description" id="description" rows="8" cols="50"><?php echo $this->_tpl_vars['this']['prize']->description; ?>
</textarea>
            </div>
            <div class="form-group">
                <label>Текст (eng):</label>
                <textarea class="form-control" name="description_en" id="description_en" rows="8" cols="50"><?php echo $this->_tpl_vars['this']['prize']->description_en; ?>
</textarea>
            </div>
            <div class="form-group">
                <label>Ссылка на YouTube:</label>
                <input class="form-control" type="text" name="youtube" id="youtube" value="<?php echo $this->_tpl_vars['this']['prize']->youtube; ?>
" />
            </div>
            <div class="form-group">
                <label><?php if ($this->_tpl_vars['this']['prizeImg']): ?>Заменить картинку:<?php else: ?>Загрузить картинку:<?php endif; ?></label>
                <input class="form-control" name="file1" type="file" />
            </div>
            <div class="form-group">
                <input id="submitPrizes" class="btn btn-success" type="submit" value="Сохранить"/>
            </div>
        </div>
        <div class="col-md-4">
            <?php if ($this->_tpl_vars['this']['prizeImg']): ?>
            <label>Картинка:</label>
            <img class="img-responsive" src="/images/prizes/resized/<?php echo $this->_tpl_vars['this']['prizeImg']; ?>
?v=<?php echo $this->_tpl_vars['this']['prize']->tsUpdate; ?>
" />
            <?php endif; ?>
        </div>
    </div>
</form>