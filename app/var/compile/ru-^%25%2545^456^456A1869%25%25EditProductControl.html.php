<?php /* Smarty version 2.6.13, created on 2019-12-03 11:25:32
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/EditProductControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditProductControl.html', 2, false),array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditProductControl.html', 4, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditProductControl.html', 20, false),array('function', 'html_options', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditProductControl.html', 25, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['EditProductControl']); ?>
<?php echo smarty_function_formrestore(array('id' => 'form'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/jquery.placeholder.min.js','type' => 'js'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/fckeditor/jquery.FCKEditor.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/fckeditor/jquery.form.js','type' => 'js'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/md5.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/caretaker.js','type' => 'js'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/pages/editproduct.js','type' => 'js'), $this);?>



<h2><?php if ($this->_tpl_vars['this']['product']): ?>Редактирование <?php else: ?>Создание <?php endif; ?> мастер-класса, ужина 
    <span style="float:right;font-size:12px;font-weight:200;margin:-5px 0 0 0;">
        <a class="btn btn-default" href="/adminka/index.php?do=copyproduct&id=<?php echo $this->_tpl_vars['this']['product']->id; ?>
">Копировать</a>
    </span>
</h2>
<form id="form" action="<?php echo smarty_function_alink(array('do' => 'saveproduct'), $this);?>
" method="post" enctype="multipart/form-data" onsubmit="ignoreSnapshot();">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['this']['product']->id; ?>
" />
    <div class="form-group">
        <label>Статус:</label>
        <select class="form-control" name="status" id="status">
            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['statusList'],'selected' => $this->_tpl_vars['this']['product']->status), $this);?>

        </select>
    </div>
    <div class="form-group">
        <label>
            <input type="checkbox" name="showInSchedule" id="showInSchedule" <?php if ($this->_tpl_vars['this']['product']->showInSchedule): ?>checked="checked"<?php endif; ?> />
            Показывать в расписании:
        </label>
    </div>
    <div class="form-group">
        <label>Название:</label>
        <input class="form-control" type="text" name="name" id="name" value="<?php echo $this->_tpl_vars['this']['product']->name; ?>
"/>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label>Цена:</label>
            <input class="form-control" type="text" name="price" id="price" value="<?php echo $this->_tpl_vars['this']['product']->price; ?>
"/>
        </div>
        <div class="col-md-6 form-group">
            <label>Кол-во билетов:</label>
            <input class="form-control" type="text" name="maxCount" id="maxCount" value="<?php echo $this->_tpl_vars['this']['product']->maxCount; ?>
"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label>Имя:</label>
            <input class="form-control" type="text" name="firstName" id="firstName" value="<?php echo $this->_tpl_vars['this']['product']->firstName; ?>
"/>
        </div>
        <div class="col-md-6 form-group">
            <label>Фамилия:</label>
            <input class="form-control" type="text" name="secondName" id="secondName" value="<?php echo $this->_tpl_vars['this']['product']->secondName; ?>
"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 form-group">
            <label>Компания:</label>
            <input class="form-control" type="text" name="company" id="company" value="<?php echo $this->_tpl_vars['this']['product']->company; ?>
"/>
        </div>
        <div class="col-md-4 form-group">
            <label>Должность:</label>
            <input class="form-control" type="text" name="position" id="position" value="<?php echo $this->_tpl_vars['this']['product']->position; ?>
"/>
        </div>
        <div class="col-md-4 form-group">
            <label>Город:</label>
            <input class="form-control" type="text" name="cityName" id="cityName" value="<?php echo $this->_tpl_vars['this']['product']->cityName; ?>
"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-inline">
                <label style="display:block;padding-top:10px;">Дата и время начала мероприятия:</label>
                <div class="form-group">
                    <input class="form-control" type="text" name="startDay" placeholder="дд" value="<?php if ($this->_tpl_vars['this']['startDay'] != null): ?><?php echo $this->_tpl_vars['this']['startDay']; ?>
<?php endif; ?>" style="width: 44px;" /> . 
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="startMonth" placeholder="мм" value="<?php if ($this->_tpl_vars['this']['startMonth'] != null): ?><?php echo $this->_tpl_vars['this']['startMonth']; ?>
<?php endif; ?>" style="width: 44px;" /> . 
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="startYear" placeholder="гггг" value="<?php if ($this->_tpl_vars['this']['startYear'] != null): ?><?php echo $this->_tpl_vars['this']['startYear']; ?>
<?php endif; ?>" style="width: 60px;" /> в 
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="startHours" value="<?php if ($this->_tpl_vars['this']['startHours'] != null): ?><?php echo $this->_tpl_vars['this']['startHours']; ?>
<?php else: ?>00<?php endif; ?>" style="width: 44px;" /> : 
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="startMinutes" value="<?php if ($this->_tpl_vars['this']['startMinutes'] != null): ?><?php echo $this->_tpl_vars['this']['startMinutes']; ?>
<?php else: ?>00<?php endif; ?>" style="width: 44px;" />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-inline">
                <label style="display:block;padding-top:10px;">Дата и время завершения мероприятия:</label>
                <div class="form-group">
                    <input class="form-control" type="text" name="finishDay" placeholder="дд" value="<?php if ($this->_tpl_vars['this']['finishDay'] != null): ?><?php echo $this->_tpl_vars['this']['finishDay']; ?>
<?php endif; ?>" style="width: 44px;" /> . 
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="finishMonth" placeholder="мм" value="<?php if ($this->_tpl_vars['this']['finishMonth'] != null): ?><?php echo $this->_tpl_vars['this']['finishMonth']; ?>
<?php endif; ?>" style="width: 44px;" /> . 
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="finishYear" placeholder="гггг" value="<?php if ($this->_tpl_vars['this']['finishYear'] != null): ?><?php echo $this->_tpl_vars['this']['finishYear']; ?>
<?php endif; ?>" style="width: 60px;" /> в 
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="finishHours" value="<?php if ($this->_tpl_vars['this']['finishHours'] != null): ?><?php echo $this->_tpl_vars['this']['finishHours']; ?>
<?php else: ?>23<?php endif; ?>" style="width: 44px;" /> : 
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="finishMinutes" value="<?php if ($this->_tpl_vars['this']['finishMinutes'] != null): ?><?php echo $this->_tpl_vars['this']['finishMinutes']; ?>
<?php else: ?>59<?php endif; ?>" style="width: 44px;" />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label style="display:block;padding-top:10px">Спикер 1:</label>
            <select class="form-control chosen-select" name="speakerId" id="speakerId">
                <option value="">-- не выбран --</option>
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['speakers'],'selected' => $this->_tpl_vars['this']['product']->speakerId), $this);?>

            </select>
        </div>
        <div class="col-md-6 form-group">
            <label style="display:block;padding-top:10px">Спикер 2:</label>
            <select class="form-control chosen-select" name="speaker2Id" id="speaker2Id">
                <option value="">-- не выбран --</option>
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['speakers'],'selected' => $this->_tpl_vars['this']['product']->speaker2Id), $this);?>

            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label>Спикер 3:</label>
            <select class="form-control chosen-select" name="speaker3Id" id="speaker3Id">
                <option value="">-- не выбран --</option>
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['speakers'],'selected' => $this->_tpl_vars['this']['product']->speaker3Id), $this);?>

            </select>
        </div>
        <div class="col-md-6 form-group">
            <label>Спикер 4:</label>
            <select class="form-control chosen-select" name="speaker4Id" id="speaker4Id">
                <option value="">-- не выбран --</option>
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['speakers'],'selected' => $this->_tpl_vars['this']['product']->speaker4Id), $this);?>

            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label>Спикер 5:</label>
            <select class="form-control chosen-select" name="speaker5Id" id="speaker5Id">
                <option value="">-- не выбран --</option>
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['speakers'],'selected' => $this->_tpl_vars['this']['product']->speaker5Id), $this);?>

            </select>
        </div>
        <div class="col-md-6 form-group">
            <label>Спикер 6:</label>
            <select class="form-control chosen-select" name="speaker6Id" id="speaker6Id">
                <option value="">-- не выбран --</option>
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['speakers'],'selected' => $this->_tpl_vars['this']['product']->speaker6Id), $this);?>

            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label>Место проведения:</label>
            <select class="form-control chosen-select" name="placeId" id="placeId">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['places'],'selected' => $this->_tpl_vars['this']['product']->placeId), $this);?>

            </select>
        </div>
        <div class="col-md-6 form-group">
            <label>Программа:</label>
            <select class="form-control chosen-select" name="areaId" id="areaId">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['areas'],'selected' => $this->_tpl_vars['this']['product']->areaId), $this);?>

            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 form-group">
            <label>Теги:</label>
            <input class="form-control" type="text" name="tags" id="tags" value="<?php echo $this->_tpl_vars['this']['product']->tags; ?>
"/>
        </div>
        <div class="col-md-3 form-group">
            <label>Описание тега:</label>
            <input class="form-control" type="text" name="tag_desc" id="tag_desc" value="<?php echo $this->_tpl_vars['this']['product']->tag_desc; ?>
"/>
        </div>
        <div class="col-md-6 form-group">
            <label>Партнер мероприятия:</label>
            <select class="form-control chosen-select" name="partner_id" id="partner_id">
                <option value="">-- не выбран --</option>
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['partners'],'selected' => $this->_tpl_vars['this']['product']->partner_id), $this);?>

            </select>
        </div>
    </div>
    <div class="form-group" id="desc-dl">
        <label id="desc-dt">Описание:</label>
        <div id="desc-dd">
            <textarea class="form-control" name="description" id="description"><?php echo $this->_tpl_vars['this']['product']->description; ?>
</textarea>
        </div>
    </div>
    <div class="form-group">
        <label>Ссылка на YouTube:</label>
        <input class="form-control" type="text" name="youtube" id="youtube" value="<?php echo $this->_tpl_vars['this']['product']->youtube; ?>
" />
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label><?php if ($this->_tpl_vars['this']['product']->pic1): ?>Заменить картинку:<?php else: ?>Загрузить картинку:<?php endif; ?></label>
            <input class="form-control" name="file1" type="file" />
        </div>
        <div class="col-md-6 form-group">
            <label><?php if ($this->_tpl_vars['this']['product']->pic2): ?>Заменить картинку:<?php else: ?>Загрузить картинку:<?php endif; ?></label>
            <input class="form-control" name="file2" type="file" />
        </div>
    </div>
    <div class="form-group">
        <input class="btn btn-success" id="submitProduct" type="submit" value="Сохранить"/>
    </div>
</form>

<div class="row">
    <div class="col-md-6">
        <?php if ($this->_tpl_vars['this']['product']->pic1): ?>
        <h4>Картинка: <a class="btn btn-danger" style="margin-left: 30px;" href="<?php echo smarty_function_alink(array('do' => 'deleteimg','id' => $this->_tpl_vars['this']['product']->pic1,'item' => 'products'), $this);?>
">Удалить картинку</a></h4>
        <img class="img-responsive" src="/images/products/resized/<?php echo $this->_tpl_vars['this']['product']->pic1; ?>
?v=<?php echo $this->_tpl_vars['this']['product']->tsUpdate; ?>
" />
        <?php endif; ?>
    </div>
    <div class="col-md-6">
        <?php if ($this->_tpl_vars['this']['product']->pic2): ?>
        <h4>Картинка: <a class="btn btn-danger" style="margin-left: 30px;" href="<?php echo smarty_function_alink(array('do' => 'deleteimg','id' => $this->_tpl_vars['this']['product']->pic2,'item' => 'products'), $this);?>
">Удалить картинку</a></h4>
        <img class="img-responsive" src="/images/products/resized/<?php echo $this->_tpl_vars['this']['product']->pic2; ?>
?v=<?php echo $this->_tpl_vars['this']['product']->tsUpdate; ?>
" />
        <?php endif; ?>
    </div>
</div>