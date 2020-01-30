<?php /* Smarty version 2.6.13, created on 2019-11-29 09:43:11
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/EditOperatorControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditOperatorControl.html', 2, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditOperatorControl.html', 5, false),array('function', 'html_options', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditOperatorControl.html', 11, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['EditOperatorControl']); ?>
<?php echo smarty_function_formrestore(array('id' => 'form'), $this);?>


<h2><?php if ($this->_tpl_vars['this']['area']): ?>Редактирование <?php else: ?>Создание <?php endif; ?> оператора</h2>
<form id="form" action="<?php echo smarty_function_alink(array('do' => 'saveoperator'), $this);?>
" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['this']['operator']->id; ?>
" />
    <div class="row">
        <div class="col-md-6 form-group">
            <label>Статус:</label>
            <select class="form-control" name="status" id="status">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['statusList'],'selected' => $this->_tpl_vars['this']['operator']->status), $this);?>

            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 form-group">
            <label>Логин:</label>
            <input class="form-control" autocomplete="off" type="text" name="login" id="login" value="<?php echo $this->_tpl_vars['this']['operator']->login; ?>
"/>
        </div>
        <div class="col-md-3 form-group">
            <label>Имя:</label>
            <input class="form-control" autocomplete="off" type="text" name="name" id="name" value="<?php echo $this->_tpl_vars['this']['operator']->name; ?>
"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 form-group">
            <label>Телефон:</label>
            <input class="form-control" autocomplete="off" type="text" name="phone" id="phone" value="<?php echo $this->_tpl_vars['this']['operator']->phone; ?>
"/>
        </div>
        <div class="col-md-3 form-group">
            <label>Пароль:</label>
            <input class="form-control" autocomplete="off" type="password" name="password" id="password" value=""/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <div class="bs-example">
                <?php $_from = $this->_tpl_vars['this']['permissions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['perm']):
?>
                    <div class="checkbox">
                        <label><input name="<?php echo $this->_tpl_vars['perm']['name']; ?>
" type="checkbox" value="Y" <?php if ($this->_tpl_vars['perm']['perm'] == 'Y'): ?>checked<?php endif; ?>> <?php echo $this->_tpl_vars['perm']['desc']; ?>
</label>
                    </div>
                <?php endforeach; endif; unset($_from); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <input class="btn btn-success" id="submitOperator" type="submit" value="Сохранить"/>
    </div>
</form>

<br/><br/>