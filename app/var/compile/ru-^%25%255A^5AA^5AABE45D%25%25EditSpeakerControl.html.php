<?php /* Smarty version 2.6.13, created on 2020-01-14 15:42:12
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/EditSpeakerControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditSpeakerControl.html', 2, false),array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditSpeakerControl.html', 4, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditSpeakerControl.html', 13, false),array('function', 'html_options', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditSpeakerControl.html', 23, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['EditSpeakerControl']); ?>
<?php echo smarty_function_formrestore(array('id' => 'form'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/fckeditor/jquery.FCKEditor.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/fckeditor/jquery.form.js','type' => 'js'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/md5.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/caretaker.js','type' => 'js'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/pages/adminkaeditspeaker.js','type' => 'js'), $this);?>


<h2><?php if ($this->_tpl_vars['this']['speaker']): ?>Редактирование <?php else: ?>Создание <?php endif; ?> спикера</h2>
<form id="form" action="<?php echo smarty_function_alink(array('do' => 'savespeaker'), $this);?>
" method="post" enctype="multipart/form-data" onsubmit="ignoreSnapshot();">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['this']['speaker']->id; ?>
" />
    <div class="form-group row">
        <div class="col-md-3">
            <label>Порядок сортировки:</label>
            <input class="form-control" type="text" name="sortOrder" id="sortOrder" value="<?php echo $this->_tpl_vars['this']['speaker']->sortOrder; ?>
"/>
        </div>
        <div class="col-md-3">
            <label>Статус:</label>
            <select class="form-control" name="status" id="status">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['statusList'],'selected' => $this->_tpl_vars['this']['speaker']->status), $this);?>

            </select>
        </div>
        <div class="col-md-3">
            <label>Флаг страны:</label>
            <select class="form-control chosen-select" name="country" id="country">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['countryList'],'selected' => $this->_tpl_vars['this']['speaker']->country), $this);?>

            </select>
        </div>
        <div class="col-md-3">
            <label>Звезд Мишлен:</label>
            <input class="form-control" type="text" name="michelin" id="michelin" value="<?php echo $this->_tpl_vars['this']['speaker']->michelin; ?>
"/>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label>Имя (рус):</label>
            <input class="form-control" type="text" name="name" id="name" value="<?php echo $this->_tpl_vars['this']['speaker']->name; ?>
"/>
        </div>
        <div class="col-md-6">
            <label>Имя (eng):</label>
            <input class="form-control" type="text" name="name_en" id="name_en" value="<?php echo $this->_tpl_vars['this']['speaker']->name_en; ?>
"/>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label>Фамилия (рус):</label>
            <input class="form-control" type="text" name="secondName" id="secondName" value="<?php echo $this->_tpl_vars['this']['speaker']->secondName; ?>
"/>
        </div>
        <div class="col-md-6">
            <label>Фамилия (eng):</label>
            <input class="form-control" type="text" name="secondName_en" id="secondName_en" value="<?php echo $this->_tpl_vars['this']['speaker']->secondName_en; ?>
"/>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label>Компания (рус):</label>
            <input class="form-control" type="text" name="company" id="company" value="<?php echo $this->_tpl_vars['this']['speaker']->company; ?>
"/>
        </div>
        <div class="col-md-6">
            <label>Компания (eng):</label>
            <input class="form-control" type="text" name="company_en" id="company_en" value="<?php echo $this->_tpl_vars['this']['speaker']->company_en; ?>
"/>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label>Должность (рус):</label>
            <input class="form-control" type="text" name="position" id="position" value="<?php echo $this->_tpl_vars['this']['speaker']->position; ?>
"/>
        </div>
        <div class="col-md-6">
            <label>Должность (eng):</label>
            <input class="form-control" type="text" name="position_en" id="position_en" value="<?php echo $this->_tpl_vars['this']['speaker']->position_en; ?>
"/>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label>Город (рус):</label>
            <input class="form-control" type="text" name="cityName" id="cityName" value="<?php echo $this->_tpl_vars['this']['speaker']->cityName; ?>
"/>
        </div>
        <div class="col-md-6">
            <label>Город (eng):</label>
            <input class="form-control" type="text" name="cityName_en" id="cityName_en" value="<?php echo $this->_tpl_vars['this']['speaker']->cityName_en; ?>
"/>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label>Теги:</label>
            <input class="form-control" type="text" name="tags" id="tags" value="<?php echo $this->_tpl_vars['this']['speaker']->tags; ?>
"/>
        </div>
        <div class="col-md-6">
            <label>Партнер:</label>
            <select class="form-control chosen-select" name="partner_id" id="partner_id">
                <option value="0">-- не выбран --</option>
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['partners'],'selected' => $this->_tpl_vars['this']['speaker']->partner_id), $this);?>

            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label>Года участия через запятую</label>
            <input class="form-control" type="text" name="years" value="<?php echo $this->_tpl_vars['this']['speaker']->years; ?>
"/>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-12">
            <label>Описание (рус):</label>
            <textarea class="form-control" name="description" id="description" rows="8"><?php echo $this->_tpl_vars['this']['speaker']->description; ?>
</textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-12">
            <label>Описание (eng):</label>
            <textarea class="form-control" name="description_en" id="description_en" rows="8"><?php echo $this->_tpl_vars['this']['speaker']->description_en; ?>
</textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-12">
            <label>Ссылка на Facebook:</label>
            <input class="form-control" type="text" name="facebook" id="facebook" value="<?php echo $this->_tpl_vars['this']['speaker']->facebook; ?>
"/>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-12">
            <label>Ссылка на VK:</label>
            <input class="form-control" type="text" name="vk" id="vk" value="<?php echo $this->_tpl_vars['this']['speaker']->vk; ?>
"/>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-12">
            <label>Ссылка на Instagram:</label>
            <input class="form-control" type="text" name="instagram" id="instagram" value="<?php echo $this->_tpl_vars['this']['speaker']->instagram; ?>
"/>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-12">
            <label>Ссылка на Twitter:</label>
            <input class="form-control" type="text" name="twitter" id="twitter" value="<?php echo $this->_tpl_vars['this']['speaker']->twitter; ?>
"/>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-12">
            <label>Ссылка на сайт</label>
            <input class="form-control" type="text" name="site" id="site" value="<?php echo $this->_tpl_vars['this']['speaker']->site; ?>
"/>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label><?php if ($this->_tpl_vars['this']['speackerImg1']): ?>Заменить картинку: <a class="btn btn-danger" style="margin-left: 30px;" href="<?php echo smarty_function_alink(array('do' => 'deleteimg','id' => $this->_tpl_vars['this']['speackerImg1'],'item' => 'speackers'), $this);?>
">Удалить картинку</a><?php else: ?>Загрузить картинку:<?php endif; ?></label>
            <?php if ($this->_tpl_vars['this']['speackerImg1']): ?><img class="img-responsive" src="/images/speackers/resized/<?php echo $this->_tpl_vars['this']['speackerImg1']; ?>
?v=<?php echo $this->_tpl_vars['this']['speaker']->tsUpdated; ?>
" /><?php endif; ?>
            <br/>
            <input class="form-control" name="file1" type="file" />
        </div>
        <div class="col-md-6">
            <label><?php if ($this->_tpl_vars['this']['speackerImg_app']): ?>Заменить картинку (ДЛЯ ПРИЛОЖЕНИЯ): <a class="btn btn-danger" style="margin-left: 30px;" href="<?php echo smarty_function_alink(array('do' => 'deleteimg','id' => $this->_tpl_vars['this']['speackerImg_app'],'item' => 'speackers'), $this);?>
">Удалить картинку</a><?php else: ?>Загрузить картинку (ДЛЯ ПРИЛОЖЕНИЯ):<?php endif; ?></label>
            <?php if ($this->_tpl_vars['this']['speackerImg_app']): ?><img class="img-responsive" src="/images/speackers/resized/<?php echo $this->_tpl_vars['this']['speackerImg_app']; ?>
?v=<?php echo $this->_tpl_vars['this']['speaker']->tsUpdated; ?>
" /><?php endif; ?>
            <br/>
            <input class="form-control" name="file2" type="file" />
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-12">
            <input class="btn btn-success" id="submitPlace" type="submit" value="Сохранить"/>
        </div>
    </div>
</form>

<br/>