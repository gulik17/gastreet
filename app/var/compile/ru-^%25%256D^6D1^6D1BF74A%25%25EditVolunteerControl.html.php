<?php /* Smarty version 2.6.13, created on 2019-11-29 09:38:30
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/EditVolunteerControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditVolunteerControl.html', 2, false),array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditVolunteerControl.html', 4, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditVolunteerControl.html', 8, false),array('function', 'html_options', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditVolunteerControl.html', 15, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['EditVolunteerControl']); ?>
<?php echo smarty_function_formrestore(array('id' => 'form'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/md5.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/caretaker.js','type' => 'js'), $this);?>


<h2>Редактирование волонтера</h2>
<form id="form" action="<?php echo smarty_function_alink(array('do' => 'savevolunteer'), $this);?>
" method="post" enctype="multipart/form-data" onsubmit="ignoreSnapshot();">
    <div class="row">
        <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['this']['volunteer']->id; ?>
" />
        <div class="col-md-6">
            <div class="form-group">
                <label>Статус:</label>
                <select class="form-control" name="status" id="status">
                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['statusList'],'selected' => $this->_tpl_vars['this']['volunteer']->status), $this);?>

                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Сортировка:</label>
                <input class="form-control" type="text" name="sort" id="sort" value="<?php echo $this->_tpl_vars['this']['volunteer']->sort; ?>
"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Номер мобильного: *</label>
                <input class="form-control" type="text" name="phone" id="phone" value="<?php echo $this->_tpl_vars['this']['volunteer']->phone; ?>
"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>E-Mail: *</label>
                <input class="form-control" type="text" name="email" id="email" value="<?php echo $this->_tpl_vars['this']['volunteer']->email; ?>
"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Фамилия:</label>
                <input class="form-control" type="text" name="lastname" id="lastname" value="<?php echo $this->_tpl_vars['this']['volunteer']->lastname; ?>
"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Имя:</label>
                <input class="form-control" type="text" name="name" id="name" value="<?php echo $this->_tpl_vars['this']['volunteer']->name; ?>
"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Страна:</label>
                <select class="form-control" name="countryName">
                    <option value="">-- Страна --</option>
                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['country'],'selected' => $this->_tpl_vars['this']['volunteer']->countryName), $this);?>

                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Город:</label>
                <input class="form-control" type="text" name="cityName" id="cityName" value="<?php echo $this->_tpl_vars['this']['volunteer']->cityName; ?>
"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Компания:</label>
                <input class="form-control" type="text" name="company" id="company" value="<?php echo $this->_tpl_vars['this']['volunteer']->company; ?>
"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Должность:</label>
                <input class="form-control" type="text" name="position" id="position" value="<?php echo $this->_tpl_vars['this']['volunteer']->position; ?>
"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Года работы:</label>
                <input class="form-control" type="text" name="years" id="years" value="<?php echo $this->_tpl_vars['this']['volunteer']->years; ?>
"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Ссылка на Facebook:</label>
                <input class="form-control" type="text" name="facebook" id="facebook" value="<?php echo $this->_tpl_vars['this']['volunteer']->facebook; ?>
"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Ссылка на VK:</label>
                <input class="form-control" type="text" name="vk" id="vk" value="<?php echo $this->_tpl_vars['this']['volunteer']->vk; ?>
"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Ссылка на Instagram:</label>
                <input class="form-control" type="text" name="instagram" id="instagram" value="<?php echo $this->_tpl_vars['this']['volunteer']->instagram; ?>
"/>
            </div>
        </div>
        
        
        
        <div class="col-md-12">
            <div class="form-group">
                <label>Описание:</label>
                <textarea class="form-control" name="description" id="description" rows="6"><?php echo $this->_tpl_vars['this']['volunteer']->description; ?>
</textarea>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group">
                <label><?php if ($this->_tpl_vars['this']['volunteer']->img): ?>Заменить картинку: <a class="btn btn-danger" style="margin-left: 30px;" href="<?php echo smarty_function_alink(array('do' => 'deleteimg','id' => $this->_tpl_vars['this']['volunteer']->id,'file' => $this->_tpl_vars['this']['volunteer']->img,'item' => 'volunteer'), $this);?>
">Удалить картинку</a><?php else: ?>Загрузить картинку:<?php endif; ?></label>
                <?php if ($this->_tpl_vars['this']['volunteer']->img): ?><img class="img-responsive" src="/images/volunteers/resized/<?php echo $this->_tpl_vars['this']['volunteer']->img; ?>
?v=<?php echo $this->_tpl_vars['this']['volunteer']->ts_updated; ?>
" /><?php endif; ?>
                <br/>
                <input class="form-control" name="file1" type="file" />
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <input class="btn btn-success" id="submitPlace" type="submit" value="Сохранить"/>
            </div>
        </div>
    </div>
</form>