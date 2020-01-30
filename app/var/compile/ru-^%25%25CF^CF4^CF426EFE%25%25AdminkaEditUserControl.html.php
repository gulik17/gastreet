<?php /* Smarty version 2.6.13, created on 2019-12-18 17:01:12
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/AdminkaEditUserControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/AdminkaEditUserControl.html', 2, false),array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/adminka/AdminkaEditUserControl.html', 4, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/AdminkaEditUserControl.html', 8, false),array('function', 'html_options', '/home/c484884/gastreet.com/www/app/Templates/adminka/AdminkaEditUserControl.html', 16, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['AdminkaEditUserControl']); ?>
<?php echo smarty_function_formrestore(array('id' => 'form'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/md5.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/caretaker.js','type' => 'js'), $this);?>


<h2>Редактирование пользователей</h2>
<form id="form" action="<?php echo smarty_function_alink(array('do' => 'adminsaveuser'), $this);?>
" method="post" enctype="multipart/form-data" onsubmit="ignoreSnapshot();">
    <div class="row">
        <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['this']['user']->id; ?>
" />
        <div class="col-md-4">
            <div class="form-group">
                <label>Тип пользователя:</label>
                <select class="form-control" name="type">
                    <option value="0">-- Тип пользователя --</option>
                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['types'],'selected' => $this->_tpl_vars['this']['user']->typeId), $this);?>

                </select>
            </div>
            <div class="form-group">
                <label>Номер мобильного: *</label>
                <input class="form-control" type="text" name="phone" id="phone" value="<?php echo $this->_tpl_vars['this']['user']->phone; ?>
"/>
            </div>
            <div class="form-group">
                <label>E-Mail: *</label>
                <input class="form-control" type="text" name="email" id="email" value="<?php echo $this->_tpl_vars['this']['user']->email; ?>
"/>
            </div>
            <div class="form-group">
                <label>Подтвержденный E-Mail:</label>
                <input class="form-control" type="text" name="confirmedEmail" id="confirmedEmail" value="<?php echo $this->_tpl_vars['this']['user']->confirmedEmail; ?>
"/>
            </div>
            <div class="form-group">
                <label>Фамилия:</label>
                <input class="form-control" type="text" name="lastname" id="lastname" value="<?php echo $this->_tpl_vars['this']['user']->lastname; ?>
"/>
            </div>
            <div class="form-group">
                <label>Имя:</label>
                <input class="form-control" type="text" name="name" id="name" value="<?php echo $this->_tpl_vars['this']['user']->name; ?>
"/>
            </div>
            <div class="form-group">
                <label>Текущий код доступа (СМС):</label>
                <input class="form-control" type="text" name="code" id="code" value="<?php echo $this->_tpl_vars['this']['user']->code; ?>
"/>
            </div>
            <div class="form-group">
                <label>Страна:</label>
                <select class="form-control" name="countryName">
                    <option value="">-- Страна --</option>
                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['country'],'selected' => $this->_tpl_vars['this']['user']->countryName), $this);?>

                </select>
            </div>
            <div class="form-group">
                <label>Город:</label>
                <input class="form-control" type="text" name="cityName" id="cityName" value="<?php echo $this->_tpl_vars['this']['user']->cityName; ?>
"/>
            </div>
            <div class="form-group">
                <label>Компания:</label>
                <input class="form-control" type="text" name="company" id="company" value="<?php echo $this->_tpl_vars['this']['user']->company; ?>
"/>
            </div>
            <div class="form-group">
                <label>Должность:</label>
                <input class="form-control" type="text" name="position" id="position" value="<?php echo $this->_tpl_vars['this']['user']->position; ?>
"/>
            </div>
            <div class="form-group">
                <input class="btn btn-success" id="submitPlace" type="submit" value="Сохранить"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Запретить пользователю редактирвать свой профиль:</label>
                <select class="form-control" name="hasEdit">
                    <option value="0" <?php if ($this->_tpl_vars['this']['user']->hasEdit == 0): ?>selected<?php endif; ?>>Нет</option>
                    <option value="1" <?php if ($this->_tpl_vars['this']['user']->hasEdit == 1): ?>selected<?php endif; ?>>Да</option>
                </select>
            </div>
            <div class="form-group">
                <label>Информация для пользователя (Раздел «Важно»):</label>
                <textarea class="form-control" rows="6" name="userInfo"><?php echo $this->_tpl_vars['this']['user']->userInfo; ?>
</textarea>
            </div>
            <div class="form-group alert alert-info">
                <label>ID родителя:</label>
                <input class="form-control" type="text" name="parentUserId" id="parentUserId" value="<?php echo $this->_tpl_vars['this']['user']->parentUserId; ?>
"/>
                <p class="" style="margin-top: 15px;">Изменение этого параметра влияет на статус участника.<br>Если это поле пустое, то данный участник станет основным.<br>Будьте внимательны при редактировании этого поля!</p>
            </div>
        </div>
    </div>
</form>