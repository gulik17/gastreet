<?php /* Smarty version 2.6.13, created on 2019-11-28 16:23:52
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManageUsersControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageUsersControl.html', 2, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageUsersControl.html', 42, false),array('function', 'cycle', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageUsersControl.html', 54, false),array('function', 'pager', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageUsersControl.html', 71, false),array('modifier', 'dateformat', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageUsersControl.html', 61, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManageUsersControl']); ?>
<?php echo smarty_function_formrestore(array('id' => "users-filter"), $this);?>


<h2>Работа с пользователями</h2>

<a role="button" data-toggle="collapse" href="#collapseFilter" aria-expanded="true" aria-controls="collapseFilter"><h4>Фильтр для поиска <span class="caret"></span></h4></a>
<div class="collapse in" id="collapseFilter">
    <div class="well" style="max-width: 400px;">
        <form id="users-filter" method="post" action="">
            <input type="hidden" name="show" value="manageusers"/>
            <input type="hidden" name="isalive" value="1"/>
            <div class="filter-users">
                <div class="form-group">
                    <label>ID:</label>
                    <input type="text" name="userid" id="userid" class="form-control" />
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
    <input type="button" onclick="window.location='<?php echo smarty_function_alink(array('show' => 'adminkaedituser'), $this);?>
'" class="btn btn-primary" value="Создать нового пользователя" />
</div>
<?php if ($this->_tpl_vars['this']['userList']): ?>
    <br>
    <table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
        <tr>
            <th>ID</th><th>ФИО</th><th>Телефон</th><th>E-Mail</th><th>Билет</th><th>Статус</th><th>Был на сайте</th><th>&nbsp;</th>
        </tr>
	<?php $_from = $this->_tpl_vars['this']['userList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
            <?php $this->assign('status', $this->_tpl_vars['user']->status); ?>
            <?php $this->assign('userid', $this->_tpl_vars['user']->id); ?>
            <?php $this->assign('parentid', $this->_tpl_vars['user']->parentUserId); ?>
            <tr class="<?php echo smarty_function_cycle(array('values' => 'color,'), $this);?>
">
                <td><a href="<?php echo smarty_function_alink(array('show' => 'user','id' => $this->_tpl_vars['user']->id), $this);?>
"><?php echo $this->_tpl_vars['user']->id; ?>
</a></td>
                <td><a href="<?php echo smarty_function_alink(array('show' => 'user','id' => $this->_tpl_vars['user']->id), $this);?>
"><?php echo $this->_tpl_vars['user']->lastname; ?>
 <?php echo $this->_tpl_vars['user']->name; ?>
</a></td>
		        <td><?php echo $this->_tpl_vars['user']->phone; ?>
</td>
                <td><?php if ($this->_tpl_vars['user']->confirmedEmail): ?><?php echo $this->_tpl_vars['user']->confirmedEmail; ?>
<?php else: ?><?php echo $this->_tpl_vars['user']->email; ?>
<?php endif; ?></td>
                <td><?php echo $this->_tpl_vars['user']->baseTicket; ?>
</td>
                <td><?php if ($this->_tpl_vars['parentid']): ?><i>добавлен от</i> <?php echo $this->_tpl_vars['this']['parentList'][$this->_tpl_vars['parentid']]; ?>
<?php else: ?><?php echo $this->_tpl_vars['this']['userStatuses'][$this->_tpl_vars['status']]; ?>
<?php endif; ?></td>
                <td><?php if ($this->_tpl_vars['user']->tsOnline): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['user']->tsOnline)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
<?php else: ?>-<?php endif; ?></td>
                <td class="text-center">
                    <a href="<?php echo smarty_function_alink(array('do' => 'admindeluser','id' => $this->_tpl_vars['user']->id), $this);?>
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