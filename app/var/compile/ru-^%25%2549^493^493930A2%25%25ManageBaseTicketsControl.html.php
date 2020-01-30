<?php /* Smarty version 2.6.13, created on 2019-12-02 12:54:53
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManageBaseTicketsControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageBaseTicketsControl.html', 6, false),array('modifier', 'lower', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageBaseTicketsControl.html', 24, false),array('modifier', 'dateformat', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageBaseTicketsControl.html', 31, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManageBaseTicketsControl']); ?>

<h2>Основные билеты</h2>

<div class="create">
    <input class="btn btn-primary" type="button" onclick="window.location='<?php echo smarty_function_alink(array('show' => 'editbaseticket'), $this);?>
'" value="Создать билет" />
</div>

<?php if ($this->_tpl_vars['this']['ticketsList']): ?>
<br/>
<table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Статус</th>
        <th>Цена</th>
        <th>Кол-во билетов</th>
        <th>Осталось билетов</th>
        <th>С ... по ...</th>
        <th>Актуализировано</th>
    </tr>
    <?php $_from = $this->_tpl_vars['this']['ticketsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ticket']):
?>
    <?php $this->assign('status', $this->_tpl_vars['ticket']->status); ?>
    <tr class="<?php echo ((is_array($_tmp=$this->_tpl_vars['status'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
">
        <td><?php echo $this->_tpl_vars['ticket']->id; ?>
</td>
        <td><a href="<?php echo smarty_function_alink(array('show' => 'editbaseticket','id' => $this->_tpl_vars['ticket']->id), $this);?>
" title="Редактировать <?php echo $this->_tpl_vars['ticket']->name; ?>
"><?php echo $this->_tpl_vars['ticket']->name; ?>
</a></td>
        <td><?php echo $this->_tpl_vars['this']['statusDesc'][$this->_tpl_vars['status']]; ?>
</td>
        <td><?php echo $this->_tpl_vars['ticket']->price; ?>
</td>
        <td><?php if ($this->_tpl_vars['ticket']->maxCount): ?><?php echo $this->_tpl_vars['ticket']->maxCount; ?>
<?php else: ?>-<?php endif; ?></td>
        <td><?php if ($this->_tpl_vars['ticket']->leftCount): ?><?php echo $this->_tpl_vars['ticket']->leftCount; ?>
<?php else: ?>-<?php endif; ?></td>
        <td><?php if ($this->_tpl_vars['ticket']->eventTsStart || $this->_tpl_vars['ticket']->eventTsFinish): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->eventTsStart)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, H:i')); ?>
<?php if ($this->_tpl_vars['ticket']->eventTsFinish): ?> - <?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->eventTsFinish)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, H:i')); ?>
<?php endif; ?><?php endif; ?></td>
        <td><?php if ($this->_tpl_vars['ticket']->leftCountTs): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['ticket']->leftCountTs)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
<?php else: ?>-<?php endif; ?></td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?>