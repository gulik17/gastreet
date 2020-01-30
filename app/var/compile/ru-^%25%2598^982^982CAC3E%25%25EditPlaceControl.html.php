<?php /* Smarty version 2.6.13, created on 2019-11-28 16:01:51
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/EditPlaceControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditPlaceControl.html', 2, false),array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditPlaceControl.html', 4, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditPlaceControl.html', 13, false),array('function', 'html_options', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditPlaceControl.html', 22, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['EditPlaceControl']); ?>
<?php echo smarty_function_formrestore(array('id' => 'form'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/fckeditor/jquery.FCKEditor.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/fckeditor/jquery.form.js','type' => 'js'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/md5.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/caretaker.js','type' => 'js'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/pages/adminkaeditplace.js','type' => 'js'), $this);?>


<h2><?php if ($this->_tpl_vars['this']['place']): ?>Редактирование <?php else: ?>Создание <?php endif; ?> места проживания</h2>
<form id="form" action="<?php echo smarty_function_alink(array('do' => 'saveplace'), $this);?>
" method="post" enctype="multipart/form-data" onsubmit="ignoreSnapshot();">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['this']['place']->id; ?>
" />
    <div class="form-group">
        <label>Порядок сортировки:</label>
        <input class="form-control" type="text" name="sortOrder" id="sortOrder" value="<?php echo $this->_tpl_vars['this']['place']->sortOrder; ?>
"/>
    </div>
    <div class="form-group">
        <label>Статус:</label>
        <select class="form-control" name="status" id="status">
            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['statusList'],'selected' => $this->_tpl_vars['this']['place']->status), $this);?>

        </select>
    </div>
    <div class="row">
        <div class="col-md-3 form-group">
            <label>Название:</label>
            <input class="form-control" type="text" name="name" id="name" value="<?php echo $this->_tpl_vars['this']['place']->name; ?>
"/>
            <label>Название (англ):</label>
            <input class="form-control" type="text" name="name_en" id="name_en" value="<?php echo $this->_tpl_vars['this']['place']->name_en; ?>
"/>
        </div>
        <div class="col-md-3 form-group">
            <label>Sup Title:</label>
            <input class="form-control" type="text" name="suptitle" id="suptitle" value="<?php echo $this->_tpl_vars['this']['place']->suptitle; ?>
"/>
            <label>Sub Title:</label>
            <input class="form-control" type="text" name="subtitle" id="subtitle" value="<?php echo $this->_tpl_vars['this']['place']->subtitle; ?>
"/>
        </div>
        <div class="col-md-3 form-group">
            <label>Телефон:</label>
            <input class="form-control" type="text" name="phone" id="phone" value="<?php echo $this->_tpl_vars['this']['place']->phone; ?>
"/>
            <label>E-mail:</label>
            <input class="form-control" type="text" name="email" id="email" value="<?php echo $this->_tpl_vars['this']['place']->email; ?>
"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 form-group">
            <label>Уровень:</label>
            <input class="form-control" type="text" name="level" id="level" value="<?php echo $this->_tpl_vars['this']['place']->level; ?>
"/>
            <label>Цена от:</label>
            <input class="form-control" type="text" name="price" id="price" value="<?php echo $this->_tpl_vars['this']['place']->price; ?>
"/>
            <label>Звезд:</label>
            <select class="form-control" type="text" name="stars" id="stars">
                <option value="1" <?php if ($this->_tpl_vars['this']['place']->stars == 1): ?>selected<?php endif; ?>>★☆☆☆☆</option>
                <option value="2" <?php if ($this->_tpl_vars['this']['place']->stars == 2): ?>selected<?php endif; ?>>★★☆☆☆</option>
                <option value="3" <?php if ($this->_tpl_vars['this']['place']->stars == 3): ?>selected<?php endif; ?>>★★★☆☆</option>
                <option value="4" <?php if ($this->_tpl_vars['this']['place']->stars == 4): ?>selected<?php endif; ?>>★★★★☆</option>
                <option value="5" <?php if ($this->_tpl_vars['this']['place']->stars == 5): ?>selected<?php endif; ?>>★★★★★</option>
            </select>
        </div>
        <div class="col-md-3 form-group">
            <label>В стоимость проживания входит</label>
            <select class="form-control" name="inclusive[]" size="8" multiple="multiple">
                <option value="1" <?php if ($this->_tpl_vars['this']['inclusive'][1] == 1): ?>selected<?php endif; ?>>Завтрак</option>
                <option value="2" <?php if ($this->_tpl_vars['this']['inclusive'][2] == 2): ?>selected<?php endif; ?>>Бассейн</option>
                <option value="3" <?php if ($this->_tpl_vars['this']['inclusive'][3] == 3): ?>selected<?php endif; ?>>СПА</option>
                <option value="4" <?php if ($this->_tpl_vars['this']['inclusive'][4] == 4): ?>selected<?php endif; ?>>Тренажерный зал</option>
                <option value="5" <?php if ($this->_tpl_vars['this']['inclusive'][5] == 5): ?>selected<?php endif; ?>>Номера для инвалидов</option>
                <option value="6" <?php if ($this->_tpl_vars['this']['inclusive'][6] == 6): ?>selected<?php endif; ?>>Детская комната</option>
                <option value="7" <?php if ($this->_tpl_vars['this']['inclusive'][7] == 7): ?>selected<?php endif; ?>>Возможно размещение с дом. животными</option>
            </select>
        </div>
        <div class="col-md-3 form-group">
            <label>Платные услуги</label>
            <select class="form-control" name="notinclusive[]" size="8" multiple="multiple">
                <option value="1" <?php if ($this->_tpl_vars['this']['notinclusive'][1] == 1): ?>selected<?php endif; ?>>Завтрак</option>
                <option value="2" <?php if ($this->_tpl_vars['this']['notinclusive'][2] == 2): ?>selected<?php endif; ?>>Бассейн</option>
                <option value="3" <?php if ($this->_tpl_vars['this']['notinclusive'][3] == 3): ?>selected<?php endif; ?>>СПА</option>
                <option value="4" <?php if ($this->_tpl_vars['this']['notinclusive'][4] == 4): ?>selected<?php endif; ?>>Тренажерный зал</option>
                <option value="5" <?php if ($this->_tpl_vars['this']['notinclusive'][5] == 5): ?>selected<?php endif; ?>>Номера для инвалидов</option>
                <option value="6" <?php if ($this->_tpl_vars['this']['notinclusive'][6] == 6): ?>selected<?php endif; ?>>Детская комната</option>
                <option value="7" <?php if ($this->_tpl_vars['this']['notinclusive'][7] == 7): ?>selected<?php endif; ?>>Возможно размещение с дом. животными</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label>Описание:</label>
            <textarea class="form-control" name="description" rows="8" id="description"><?php echo $this->_tpl_vars['this']['place']->description; ?>
</textarea>
        </div>
        <div class="col-md-6 form-group">
            <label>Описание (англ):</label>
            <textarea class="form-control" name="description_en" rows="8" id="description_en"><?php echo $this->_tpl_vars['this']['place']->description_en; ?>
</textarea>
        </div>
        <div class="col-md-6 form-group">
            <label>Описание в модальном окне:</label>
            <textarea class="form-control" name="modal_desc" rows="8" id="modal_desc"><?php echo $this->_tpl_vars['this']['place']->modal_desc; ?>
</textarea>
        </div>
        <div class="col-md-6 form-group">
            <label>Описание в модальном окне (англ):</label>
            <textarea class="form-control" name="modal_desc_en" rows="8" id="modal_desc_en"><?php echo $this->_tpl_vars['this']['place']->modal_desc_en; ?>
</textarea>
        </div>
        <div class="col-md-12 form-group">
            <label>Видеоролик (только ID видео на YouTube):</label>
            <input class="form-control" type="text" name="videoUrl" id="videoUrl" value="<?php echo $this->_tpl_vars['this']['place']->videoUrl; ?>
"/>
        </div>
        <?php if ($this->_tpl_vars['this']['placeImg']): ?>
        <div class="col-md-12 form-group">
            <label>Картинка:</label>
            <div>
                <img src="/images/places/resized/<?php echo $this->_tpl_vars['this']['placeImg']; ?>
" />
            </div>
        </div>
        <?php endif; ?>
        <div class="col-md-12 form-group" id="file-dl">
            <label id="file-dt"><?php if ($this->_tpl_vars['this']['placeImg']): ?>Заменить картинку:<?php else: ?>Загрузить картинку:<?php endif; ?></label>
            <div id="file-dd">
                <input class="form-control u-file" name="file1" type="file" />
            </div>
        </div>
        <div class="col-md-12 form-group">
            <input class="btn btn-success" id="submitPlace" type="submit" value="Сохранить"/>
        </div>
    </div>
</form>