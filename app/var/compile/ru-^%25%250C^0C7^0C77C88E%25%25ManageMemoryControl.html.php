<?php /* Smarty version 2.6.13, created on 2019-12-02 15:46:25
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManageMemoryControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageMemoryControl.html', 21, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManageMemoryControl']); ?>

<h2>Отзывы</h2>

<?php if ($this->_tpl_vars['this']['memories']): ?>
<br/>
<table class="table table-striped table-bordered table-hover table-memories" cellspacing="0" cellpadding="0">
    <tr>
        <th>ID</th>
        <th>Отзыв</th>
        <th>Статус</th>
        <th>Действия</th>
    </tr>
    <?php $_from = $this->_tpl_vars['this']['memories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['memory']):
?>
    <?php $this->assign('status', $this->_tpl_vars['memory']['status']); ?>
    <tr>
        <td><?php echo $this->_tpl_vars['memory']['id']; ?>
</td>
        <td>
            <h4 class="m-0"><?php echo $this->_tpl_vars['memory']['subject']; ?>
</h4>
            <p><?php echo $this->_tpl_vars['memory']['message']; ?>
</p>
            <p><a href="<?php echo smarty_function_alink(array('show' => 'user','id' => $this->_tpl_vars['memory']['user_id']), $this);?>
">Карточка участника</a></p>
        </td>
        <td><?php echo $this->_tpl_vars['this']['statusDesc'][$this->_tpl_vars['status']]; ?>
</td>
        <td>
            <nobr><a href="<?php echo smarty_function_alink(array('do' => 'confirmmemory','id' => $this->_tpl_vars['memory']['id']), $this);?>
">Опубликовать</a> | <a href="<?php echo smarty_function_alink(array('do' => 'delmemory','id' => $this->_tpl_vars['memory']['id']), $this);?>
">Удалить</a></nobr>
        </td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?>