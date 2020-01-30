<?php /* Smarty version 2.6.13, created on 2019-11-28 17:08:47
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/EditVideoControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditVideoControl.html', 2, false),array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditVideoControl.html', 4, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditVideoControl.html', 9, false),array('function', 'html_options', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditVideoControl.html', 22, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['EditVideoControl']); ?>
<?php echo smarty_function_formrestore(array('id' => 'form'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/md5.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/caretaker.js','type' => 'js'), $this);?>



<h2><?php if ($this->_tpl_vars['this']['video']): ?>Редактирование <?php else: ?>Добавление <?php endif; ?> видеоролика</h2>
<form id="form" action="<?php echo smarty_function_alink(array('do' => 'savevideo'), $this);?>
" method="post" enctype="multipart/form-data" onsubmit="ignoreSnapshot();" style="max-width: 400px">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['this']['video']->id; ?>
" />
    <div class="form-group">
        <label>Группа:</label>
        <input class="form-control" type="text" name="v_group" id="v_group" value="<?php echo $this->_tpl_vars['this']['video']->v_group; ?>
"/>
    </div>
    <div class="form-group">
        <label>Порядок сортировки:</label>
        <input class="form-control" type="text" name="sortOrder" id="sortOrder" value="<?php echo $this->_tpl_vars['this']['video']->sortOrder; ?>
"/>
    </div>
    <div class="form-group">
        <label>Статус:</label>
        <select class="form-control" name="status" id="status">
            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['statusList'],'selected' => $this->_tpl_vars['this']['video']->status), $this);?>

        </select>
    </div>
    <div class="form-group">
        <label>Имя:</label>
        <input class="form-control" type="text" name="name" id="name" value="<?php echo $this->_tpl_vars['this']['video']->name; ?>
"/>
    </div>
    <div class="form-group">
        <label>Имя (англ):</label>
        <input class="form-control" type="text" name="name_en" id="name_en" value="<?php echo $this->_tpl_vars['this']['video']->name_en; ?>
"/>
    </div>
    <div class="form-group">
        <label>URL:</label>
        <input class="form-control" type="text" name="url" id="url" value="<?php echo $this->_tpl_vars['this']['video']->url; ?>
"/>
    </div>
    <?php if ($this->_tpl_vars['this']['video']->url): ?>
    <div class="form-group">
        <label>Картинка:</label>
        <img class="img-responsive" src="https://i.ytimg.com/vi/<?php echo $this->_tpl_vars['this']['video']->url; ?>
/hqdefault.jpg" />
    </div>
    <?php endif; ?>

    <div class="form-group">
        <input class="btn btn-success" id="submitPlace" type="submit" value="Сохранить"/>
    </div>
</form>