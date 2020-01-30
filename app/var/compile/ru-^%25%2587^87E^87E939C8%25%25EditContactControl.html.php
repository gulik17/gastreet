<?php /* Smarty version 2.6.13, created on 2019-12-03 12:10:15
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/EditContactControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditContactControl.html', 2, false),array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditContactControl.html', 4, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditContactControl.html', 13, false),array('function', 'html_options', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditContactControl.html', 23, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['EditContactControl']); ?>
<?php echo smarty_function_formrestore(array('id' => 'form'), $this);?>


<!--<?php echo smarty_function_loadscript(array('file' => '/js/fckeditor/jquery.FCKEditor.js','type' => 'js'), $this);?>
-->
<!--<?php echo smarty_function_loadscript(array('file' => '/js/fckeditor/jquery.form.js','type' => 'js'), $this);?>
-->

<?php echo smarty_function_loadscript(array('file' => '/js/md5.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/caretaker.js','type' => 'js'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/pages/adminkaeditcontact.js','type' => 'js'), $this);?>


<h2><?php if ($this->_tpl_vars['this']['contact']): ?>Редактирование контактной информации<?php else: ?>Создание контакта<?php endif; ?></h2>
<form id="form" action="<?php echo smarty_function_alink(array('do' => 'savecontact'), $this);?>
" method="post" enctype="multipart/form-data" onsubmit="ignoreSnapshot();">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['this']['contact']->id; ?>
" />
    <div class="row">
        <div class="col-md-3 form-group">
            <label>Порядок сортировки:</label>
            <input class="form-control" type="text" name="sortOrder" id="sortOrder" value="<?php echo $this->_tpl_vars['this']['contact']->sortOrder; ?>
"/>
        </div>
        <div class="col-md-3 form-group">
            <label>Категория:</label>
            <select class="form-control" name="type" id="type">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['cType'],'selected' => $this->_tpl_vars['this']['contact']->type), $this);?>

            </select>
        </div>
        <div class="col-md-3 form-group">
            <label>Заголовок:</label>
            <input class="form-control" type="text" name="title" id="title" value="<?php echo $this->_tpl_vars['this']['contact']->title; ?>
"/>
        </div>
        <div class="col-md-3 form-group">
            <label>Заголовок (англ):</label>
            <input class="form-control" type="text" name="title_en" id="title_en" value="<?php echo $this->_tpl_vars['this']['contact']->title_en; ?>
"/>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-3 form-group">
            <label>Имя:</label>
            <input class="form-control" type="text" name="name" id="name" value="<?php echo $this->_tpl_vars['this']['contact']->name; ?>
"/>
        </div>
        <div class="col-md-3 form-group">
            <label>Имя (англ):</label>
            <input class="form-control" type="text" name="name_en" id="name_en" value="<?php echo $this->_tpl_vars['this']['contact']->name_en; ?>
"/>
        </div>
        <div class="col-md-3 form-group">
            <label>E-Mail:</label>
            <input class="form-control" type="email" name="email" id="email" value="<?php echo $this->_tpl_vars['this']['contact']->email; ?>
"/>
        </div>
        <div class="col-md-3 form-group">
            <label>Телефон:</label>
            <input class="form-control" name="phone" id="phone" value="<?php echo $this->_tpl_vars['this']['contact']->phone; ?>
">
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-3 form-group">
            <label>Телефон доп:</label>
            <input class="form-control" name="phone2" id="phone2" value="<?php echo $this->_tpl_vars['this']['contact']->phone2; ?>
">
        </div>
        <div class="col-md-3 form-group">
            <label>WhatsApp:</label>
            <input class="form-control" name="whatsapp" id="whatsapp" value="<?php echo $this->_tpl_vars['this']['contact']->whatsapp; ?>
">
        </div>
        <div class="col-md-3 form-group">
            <label>Viber:</label>
            <input class="form-control" name="viber" id="viber" value="<?php echo $this->_tpl_vars['this']['contact']->viber; ?>
">
        </div>
        <div class="col-md-3 form-group">
            <label>Telegram:</label>
            <input class="form-control" name="telegram" id="telegram" value="<?php echo $this->_tpl_vars['this']['contact']->telegram; ?>
">
        </div>
        <div class="col-md-3 form-group">
            <label>Адрес страницы на Facebook:</label>
            <input class="form-control" type="url" name="facebookurl" id="facebookurl" value="<?php echo $this->_tpl_vars['this']['contact']->facebookurl; ?>
"/>
        </div>
        <div class="col-md-12 form-group" id="file-dl">
            <label id="file-dt">Загрузить картинку:</label>
            <div id="file-dd">
                <input class="u-file form-control" name="file1" type="file" />
            </div>
        </div>
        <!--<dl>-->
        <!--<dt>Описание:</dt>-->
        <!--<dd><textarea style="width: 400px; height: 150px;" name="info" id="info"><?php echo $this->_tpl_vars['this']['contact']->info; ?>
</textarea></dd>-->
        <!--</dl>-->
        <div class="col-md-12 form-group">
            <input class="btn btn-success" id="submitPlace" type="submit" value="Сохранить"/>
        </div>
    </div>
    <?php if ($this->_tpl_vars['this']['contactImg']): ?>
        <div class="row">
            <div class="col-md-12 form-group">
                <label>Фото:</label>
                <div>
                    <img src="/images/contacts/resized/<?php echo $this->_tpl_vars['this']['contactImg']; ?>
" />
                </div>
            </div>
        </div>
    <?php endif; ?>
</form>