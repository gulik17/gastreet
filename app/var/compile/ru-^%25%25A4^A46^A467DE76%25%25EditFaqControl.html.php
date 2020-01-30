<?php /* Smarty version 2.6.13, created on 2020-01-13 11:28:34
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/EditFaqControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditFaqControl.html', 2, false),array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditFaqControl.html', 4, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditFaqControl.html', 9, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['EditFaqControl']); ?>
<?php echo smarty_function_formrestore(array('id' => 'form'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/md5.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/caretaker.js','type' => 'js'), $this);?>



<h2><?php if ($this->_tpl_vars['this']['faq']): ?>Редактирование <?php else: ?>Создание <?php endif; ?> вопроса</h2>
<form id="form" action="<?php echo smarty_function_alink(array('do' => 'savefaq'), $this);?>
" method="post" enctype="multipart/form-data" onsubmit="ignoreSnapshot();">
	<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['this']['faq']->id; ?>
" />
	<div class="form-group">
		<label>Сортировка:</label>
		<input type="text" name="sortOrder" class="form-control" value="<?php echo $this->_tpl_vars['this']['faq']->sortOrder; ?>
" />
	</div>
	<div class="form-group">
		<label>Вопрос:</label>
		<textarea class="form-control" rows="5" name="question" id="question"><?php echo $this->_tpl_vars['this']['faq']->question; ?>
</textarea>
	</div>
	<div class="form-group">
		<label>Вопрос (eng):</label>
		<textarea class="form-control" rows="5" name="question_en" id="question_en"><?php echo $this->_tpl_vars['this']['faq']->question_en; ?>
</textarea>
	</div>
	<div class="form-group">
		<label>Ответ:</label>
		<textarea class="form-control" rows="12" name="answer" id="answer"><?php echo $this->_tpl_vars['this']['faq']->answer; ?>
</textarea>
	</div>
	<div class="form-group">
		<label>Ответ (eng):</label>
		<textarea class="form-control" rows="12" name="answer_en" id="answer_en"><?php echo $this->_tpl_vars['this']['faq']->answer_en; ?>
</textarea>
	</div>
	<div class="form-group">
		<input class="btn btn-success" id="submitPlace" type="submit" value="Сохранить"/>
	</div>
</form>
<br/>