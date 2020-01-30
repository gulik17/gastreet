<?php /* Smarty version 2.6.13, created on 2019-12-02 11:13:40
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManageBroadcastControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageBroadcastControl.html', 21, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageBroadcastControl.html', 29, false),array('modifier', 'dateformat', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageBroadcastControl.html', 23, false),array('modifier', 'htmltoplaintext', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageBroadcastControl.html', 27, false),array('modifier', 'truncate', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageBroadcastControl.html', 27, false),array('modifier', 'nl2br', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageBroadcastControl.html', 27, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManageBroadcastControl']); ?>

<h2>Менеджер уведомлений</h2>

<?php if ($this->_tpl_vars['this']['allTemplates']): ?>
<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
    <tr>
        <th>ID</th>
        <th>Обновлено</th>
        <th>Статус</th>
        <th>Тип</th>
        <th>Назначение</th>
        <th>Шаблон</th>
        <th>Действия</th>
    </tr>
    <?php $_from = $this->_tpl_vars['this']['allTemplates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tpl']):
?>
    <?php $this->assign('status', $this->_tpl_vars['tpl']->status); ?>
    <?php $this->assign('editType', $this->_tpl_vars['tpl']->editType); ?>
    <?php $this->assign('sendType', $this->_tpl_vars['tpl']->sendType); ?>
    <?php $this->assign('triggerType', $this->_tpl_vars['tpl']->triggerType); ?>
    <tr class="<?php echo smarty_function_cycle(array('values' => 'color,'), $this);?>
">
        <td><?php echo $this->_tpl_vars['tpl']->id; ?>
</td>
        <td><?php if ($this->_tpl_vars['tpl']->tsUpdate): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['tpl']->tsUpdate)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
<?php else: ?>-<?php endif; ?></td>
        <td><?php echo $this->_tpl_vars['this']['statusDesc'][$this->_tpl_vars['status']]; ?>
</td>
        <td><?php echo $this->_tpl_vars['this']['sendTypeDesc'][$this->_tpl_vars['sendType']]; ?>
</td>
        <td><?php echo $this->_tpl_vars['this']['triggerTypeDesc'][$this->_tpl_vars['triggerType']]; ?>
</td>
        <td><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['tpl']->message)) ? $this->_run_mod_handler('htmltoplaintext', true, $_tmp) : smarty_modifier_htmltoplaintext($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 200, "...", true) : smarty_modifier_truncate($_tmp, 200, "...", true)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</td>
        <td>
            <a href="<?php echo smarty_function_alink(array('show' => 'editbroadcasttemplate','id' => $this->_tpl_vars['tpl']->id), $this);?>
">Редактировать</a>
        </td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?>