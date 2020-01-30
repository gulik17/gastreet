<?php /* Smarty version 2.6.13, created on 2019-12-02 11:15:35
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/EditcontentControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditcontentControl.html', 2, false),array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditcontentControl.html', 4, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditcontentControl.html', 17, false),array('function', 'html_options', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditcontentControl.html', 42, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['EditcontentControl']); ?>
<?php echo smarty_function_formrestore(array('id' => "edit-content"), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/css/ketchup/jquery.ketchup.css','type' => 'css'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/ketchup/jquery.ketchup.all.min.js','type' => 'js'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/fckeditor/jquery.FCKEditor.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/fckeditor/jquery.form.js','type' => 'js'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/md5.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/caretaker.js','type' => 'js'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/pages/adminkaeditcontent.js','type' => 'js'), $this);?>



<h2>Создание/редактирование страницы</h2>
<form id="edit-content" method="post" action="<?php echo smarty_function_alink(array('do' => 'savecontent'), $this);?>
" onsubmit="ignoreSnapshot();">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['this']['content']->id; ?>
"/>
    <div class="form-group">
        <label>Заголовок:</label>
        <input class="form-control" type="text" data-validate="validate(required, maxlength(255))" name="title" value="<?php echo $this->_tpl_vars['this']['content']->title; ?>
"/>
    </div>
    <div class="form-group">
        <label>Meta title:</label>
        <input class="form-control" type="text" data-validate="validate(required, maxlength(255))" name="pageTitle" value="<?php echo $this->_tpl_vars['this']['content']->pageTitle; ?>
"/>
    </div>
    <div class="form-group">
        <label>Meta description:</label>
        <input class="form-control" type="text" data-validate="validate(required)" name="pageDesc" value="<?php echo $this->_tpl_vars['this']['content']->pageDesc; ?>
"/>
    </div>
    <div class="form-group">
        <label>Meta keys:</label>
        <input class="form-control" type="text" data-validate="validate(required)" name="pageKeys" value="<?php echo $this->_tpl_vars['this']['content']->pageKeys; ?>
"/>
    </div>
    <div class="form-group">
        <label>Псевдоним:</label>
        <input class="form-control" type="text" id="alias" data-validate="validate(required, username, maxlength(255))" name="alias" value="<?php echo $this->_tpl_vars['this']['content']->alias; ?>
"/>
    </div>
    <div class="form-group">
        <label>Положение в меню:</label>
        <select class="form-control" name="menu">
            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['menuList'],'selected' => $this->_tpl_vars['this']['content']->menu), $this);?>

        </select>
    </div>
    <div class="form-group">
        <label>Разметка страницы:</label>
	<textarea class="form-control" name="text" id="content"><?php echo $this->_tpl_vars['this']['content']->text; ?>
</textarea>
    </div>
    <div class="form-group">
        <label>Разметка страницы (ENG):</label>
	<textarea class="form-control" name="text_en" id="content_en"><?php echo $this->_tpl_vars['this']['content']->text_en; ?>
</textarea>
    </div>
    <div class="form-group">
        <label>Статус:</label>
        <select class="form-control" name="status">
            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['statusList'],'selected' => $this->_tpl_vars['this']['content']->status), $this);?>

        </select>
    </div>
    <div class="form-group">
        <input class="btn btn-success" id="submitContent" type="submit" value="Сохранить"/>
    </div>
</form>

<br/><br/>
<p>На страницу можно добавить параметры:</p>
<ul>
    <li><b>&#123;id&#125;</b> - ID пользователя,</li>
    <li><b>&#123;site&#125;</b> - URL этого сайта,</li>
    <li><b>&#123;lastname&#125;</b> - Фамилия пользователя,</li>
    <li><b>&#123;name&#125;</b> - Имя пользователя,</li>
    <li><b>&#123;email&#125;</b> - подтвержденный E-mail пользователя,</li>
    <li><b>&#123;phone&#125;</b> - мобильный номер телефона,</li>
    <li><b>&#123;country&#125;</b> - страна пользователя,</li>
    <li><b>&#123;city&#125;</b> - город пользователя,</li>
    <li><b>&#123;company&#125;</b> - компания, которую представляет пользователь,</li>
    <li><b>&#123;position&#125;</b> - должность пользователя,</li>
</ul>

<p>Реквизиты для выставления счёта:</p>
<ul>
    <li><b>&#123;ulcompany&#125;</b> - название юр. лица,</li>
    <li><b>&#123;ulcountry&#125;</b> - страна юр. лица,</li>
    <li><b>&#123;ulcity&#125;</b> - город юр. лица,</li>
    <li><b>&#123;ulinn&#125;</b> - ИНН,</li>
    <li><b>&#123;ulkpp&#125;</b> - КПП,</li>
    <li><b>&#123;ulrs&#125;</b> - р/с,</li>
    <li><b>&#123;ulbank&#125;</b> - название банка,</li>
    <li><b>&#123;ulcorr&#125;</b> - к/с,</li>
    <li><b>&#123;ulbik&#125;</b> - БИК,</li>
    <li><b>&#123;uldirector&#125;</b> - директор (фамилия, инициалы),</li>
    <li><b>&#123;ulbuh&#125;</b> - бухгалтер (фамилия, инициалы),</li>
    <li><b>&#123;amount&#125;</b> - сумма,</li>
    <li><b>&#123;amountinwords&#125;</b> - сумма прописью,</li>
    <li><b>&#123;invoice&#125;</b> - номер счёта,</li>
    <li><b>&#123;invoicedate&#125;</b> - дата счёта.</li>
</ul>

<br><p>&nbsp;</p>