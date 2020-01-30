<?php /* Smarty version 2.6.13, created on 2019-12-02 11:20:38
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManageMessageLogControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageMessageLogControl.html', 2, false),array('function', 'cycle', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageMessageLogControl.html', 39, false),array('function', 'pager', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageMessageLogControl.html', 48, false),array('modifier', 'dateformat', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageMessageLogControl.html', 40, false),array('modifier', 'htmltoplaintext', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageMessageLogControl.html', 44, false),array('modifier', 'truncate', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageMessageLogControl.html', 44, false),array('modifier', 'nl2br', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageMessageLogControl.html', 44, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManageMessageLogControl']); ?>
<?php echo smarty_function_formrestore(array('id' => "log-filter"), $this);?>


<h2>Лог сообщений</h2>

<a role="button" data-toggle="collapse" href="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter" aria-expanded="true"><h4>Фильтр для поиска <span class="caret"></span></h4></a>
<div class="collapse" id="collapseFilter">
    <form id="log-filter" method="post" action="" style="max-width: 400px;">
        <div class="well">
            <input type="hidden" name="show" value="managemessagelog"/>
            <input type="hidden" name="isalive" value="1"/>
            <div class="filter-users">
                <div class="form-group">
                    <label>Номер мобильного:</label>
                    <input class="form-control" type="text" name="phone" id="phone" />
                </div>
                <div class="form-group">
                    <label>E-Mail:</label>
                    <input class="form-control" type="text" name="email" id="email" />
                </div>
                <div class="form-group">
                    <input class="btn btn-info" type="submit" id="submit" value="Показать список отбора"/>
                </div>
            </div>
        </div>
    </form>
</div>

<?php if ($this->_tpl_vars['this']['logList']): ?>
    <table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
        <tr>
            <th>Дата создания</th>
            <th>Дата отправки</th>
            <th>Номер мобильного</th>
            <th>E-Mail</th>
            <th>Сообщение</th>
        </tr>
        <?php $_from = $this->_tpl_vars['this']['logList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['log']):
?>
            <tr class="<?php echo smarty_function_cycle(array('values' => 'color,'), $this);?>
">
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['log']->tsCreate)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
</td>
                <td><?php if ($this->_tpl_vars['log']->tsSent): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['log']->tsSent)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
<?php else: ?>-<?php endif; ?></td>
                <td><?php if ($this->_tpl_vars['log']->phone): ?><?php echo $this->_tpl_vars['log']->phone; ?>
<?php else: ?>-<?php endif; ?></td>
                <td><?php if ($this->_tpl_vars['log']->email): ?><?php echo $this->_tpl_vars['log']->email; ?>
<?php else: ?>-<?php endif; ?></td>
                <td><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['log']->message)) ? $this->_run_mod_handler('htmltoplaintext', true, $_tmp) : smarty_modifier_htmltoplaintext($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 200, "...", true) : smarty_modifier_truncate($_tmp, 200, "...", true)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</td>
            </tr>
        <?php endforeach; endif; unset($_from); ?>
    </table>
    <p><?php echo smarty_function_pager(array('total' => $this->_tpl_vars['this']['total'],'per' => $this->_tpl_vars['this']['perPage']), $this);?>
</p>
<?php endif; ?>