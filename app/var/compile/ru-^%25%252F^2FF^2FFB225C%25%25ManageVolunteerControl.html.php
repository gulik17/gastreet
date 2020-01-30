<?php /* Smarty version 2.6.13, created on 2019-11-29 09:38:16
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManageVolunteerControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageVolunteerControl.html', 2, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageVolunteerControl.html', 42, false),array('function', 'cycle', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageVolunteerControl.html', 53, false),array('function', 'pager', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageVolunteerControl.html', 68, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManageVolunteerControl']); ?>
<?php echo smarty_function_formrestore(array('id' => "volunteer-filter"), $this);?>


<h2>Работа с волонтерами</h2>

<a role="button" data-toggle="collapse" href="#collapseFilter" aria-expanded="true" aria-controls="collapseFilter"><h4>Фильтр для поиска <span class="caret"></span></h4></a>
<div class="collapse in" id="collapseFilter">
    <div class="well" style="max-width: 400px;">
        <form id="volunteer-filter" method="post" action="">
            <input type="hidden" name="show" value="managevolunteer"/>
            <input type="hidden" name="isalive" value="1"/>
            <div class="filter-volunteer">
                <div class="form-group">
                    <label>ID:</label>
                    <input type="text" name="volunteerid" id="volunteerid" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Фамилия:</label>
                    <input type="text" name="lastname" id="lastname" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Имя:</label>
                    <input type="text" name="name" id="name" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Номер мобильного:</label>
                    <input type="text" name="phone" id="phone" class="form-control" />
                </div>
                <div class="form-group">
                    <label>E-Mail:</label>
                    <input type="text" name="email" id="email" class="form-control" />
                </div>
                <div class="form-group">
                    <input type="submit" id="submit" value="Показать список отбора" class="btn btn-info"/>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="create">
    <a href="<?php echo smarty_function_alink(array('show' => 'editvolunteer'), $this);?>
" class="btn btn-primary">Добавить волонтера</a>
</div>
<?php if ($this->_tpl_vars['this']['volunteerList']): ?>
    <br>
    <table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
        <tr>
            <th>ID</th><th>ФИО</th><th>Телефон</th><th>E-Mail</th><th>Статус</th><th>&nbsp;</th>
        </tr>
	<?php $_from = $this->_tpl_vars['this']['volunteerList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['volunteer']):
?>
            <?php $this->assign('status', $this->_tpl_vars['volunteer']->status); ?>
            <?php $this->assign('volunteerid', $this->_tpl_vars['volunteer']->id); ?>
            <tr class="<?php echo smarty_function_cycle(array('values' => 'color,'), $this);?>
">
                <td><a href="<?php echo smarty_function_alink(array('show' => 'editvolunteer','id' => $this->_tpl_vars['volunteer']->id), $this);?>
"><?php echo $this->_tpl_vars['volunteer']->id; ?>
</a></td>
                <td><a href="<?php echo smarty_function_alink(array('show' => 'editvolunteer','id' => $this->_tpl_vars['volunteer']->id), $this);?>
"><?php echo $this->_tpl_vars['volunteer']->lastname; ?>
 <?php echo $this->_tpl_vars['volunteer']->name; ?>
</a></td>
		<td><?php echo $this->_tpl_vars['volunteer']->phone; ?>
</td>
                <td><?php echo $this->_tpl_vars['volunteer']->email; ?>
</td>
                <td><?php echo $this->_tpl_vars['this']['volunteerStatuses'][$this->_tpl_vars['status']]; ?>
</td>
                <td class="text-center">
                    <a href="<?php echo smarty_function_alink(array('do' => 'delvolunteer','id' => $this->_tpl_vars['volunteer']->id), $this);?>
" title="Удалить" onclick="return confirm('Точно удалить?');">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </a>
                </td>
            </tr>
	<?php endforeach; endif; unset($_from); ?>
    </table>
    <?php if ($this->_tpl_vars['this']['total']): ?>
        <?php echo smarty_function_pager(array('total' => $this->_tpl_vars['this']['total'],'per' => $this->_tpl_vars['this']['perPage']), $this);?>

    <?php endif; ?>
<?php endif; ?>