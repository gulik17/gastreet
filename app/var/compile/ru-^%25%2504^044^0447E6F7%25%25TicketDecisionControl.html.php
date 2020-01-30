<?php /* Smarty version 2.6.13, created on 2019-12-16 14:34:07
         compiled from /home/c484884/gastreet.com/www/app/Templates/TicketDecisionControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/TicketDecisionControl.html', 2, false),array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/TicketDecisionControl.html', 4, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['TicketDecisionControl']); ?>
<?php echo smarty_function_formrestore(array('id' => "ticket-decision"), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/css/ketchup/jquery.ketchup.css','type' => 'css'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/ketchup/jquery.ketchup.all.min.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/pages/ticketdecision.js','type' => 'js'), $this);?>


<?php if ($this->_tpl_vars['this']['tickets']): ?>
    <?php $_from = $this->_tpl_vars['this']['tickets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ticket']):
?>
        <h4>Ваш билет: <?php echo $this->_tpl_vars['ticket']['baseTicketName']; ?>
</h4>
        <?php $this->assign('canchange', 0); ?>
        <?php if ($this->_tpl_vars['this']['allTickets'] && $this->_tpl_vars['ticket']['returnedAmount']+$this->_tpl_vars['ticket']['needAmount']-$this->_tpl_vars['ticket']['payAmount']-$this->_tpl_vars['ticket']['ulAmount']-$this->_tpl_vars['ticket']['discountAmount'] > 0): ?>
            <!-- возможна замена -->
            <?php $_from = $this->_tpl_vars['this']['allTickets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oneTicket']):
?>
                <?php if ($this->_tpl_vars['oneTicket']->id != $this->_tpl_vars['ticket']['baseTicketId']): ?>
                <?php $this->assign('canchange', 1); ?>
                    <button class="ticket-decision ticket-<?php echo $this->_tpl_vars['oneTicket']->id; ?>
">Можно заменить на <?php echo $this->_tpl_vars['oneTicket']->name; ?>
</button>
                <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
        <?php elseif ($this->_tpl_vars['this']['allTickets'] && $this->_tpl_vars['ticket']['needAmount'] < $this->_tpl_vars['this']['ticketObj']->needAmount): ?>
            <!-- возможен апгрейд -->
            <?php $_from = $this->_tpl_vars['this']['allTickets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oneTicket']):
?>
                <?php if ($this->_tpl_vars['oneTicket']->id != $this->_tpl_vars['ticket']['baseTicketId'] && $this->_tpl_vars['oneTicket']->price < $this->_tpl_vars['ticket']['needAmount']): ?>
                <?php $this->assign('canchange', 1); ?>
                    <button class="ticket-decision ticket-<?php echo $this->_tpl_vars['oneTicket']->id; ?>
">Можно заменить на <?php echo $this->_tpl_vars['oneTicket']->name; ?>
</button>
                <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
        <?php endif; ?>
        <p><?php if (! $this->_tpl_vars['canchange']): ?>Нельзя заменить, но Вы можете оформить запрос на возврат.<?php endif; ?></p>
    <?php endforeach; endif; unset($_from); ?>
<?php endif; ?>