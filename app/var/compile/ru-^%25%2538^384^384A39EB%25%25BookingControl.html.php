<?php /* Smarty version 2.6.13, created on 2020-01-10 15:37:25
         compiled from /home/c484884/gastreet.com/www/app/Templates/BookingControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'round0', '/home/c484884/gastreet.com/www/app/Templates/BookingControl.html', 7, false),array('modifier', 'dateformat', '/home/c484884/gastreet.com/www/app/Templates/BookingControl.html', 7, false),array('function', 'declension', '/home/c484884/gastreet.com/www/app/Templates/BookingControl.html', 9, false),array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/BookingControl.html', 17, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['BookingControl']); ?>

<div class="gss-booking">
    <h4>Забронировать билеты</h4>
    <?php if ($this->_tpl_vars['lang'] == 'en'): ?>

    <p>You can book tickets for <?php echo ((is_array($_tmp=$this->_tpl_vars['this']['amountBron'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
 rubles for 2 week (to <?php echo ((is_array($_tmp=$this->_tpl_vars['this']['daysBronTill'])) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, H:i')); ?>
).<br/>
        If there is no full payment for the ticket within 14 days - the amount of the booking is not refundable.</p>
        <?php if ($this->_tpl_vars['this']['children']): ?><p>You have <?php echo smarty_function_declension(array('count' => $this->_tpl_vars['this']['countchildren'],'form1' => 'member','form2' => 'members','form5' => 'members'), $this);?>
 and you.</p><?php endif; ?>
    <?php else: ?>
    <p>Вы можете забронировать билеты за <?php echo ((is_array($_tmp=$this->_tpl_vars['this']['amountBron'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
 р. на 2 недели (до <?php echo ((is_array($_tmp=$this->_tpl_vars['this']['daysBronTill'])) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, H:i')); ?>
).<br/>
<!--    <p>Вы можете забронировать билеты за <?php echo ((is_array($_tmp=$this->_tpl_vars['this']['amountBron'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)); ?>
 р. до 15 января.<br/>-->
        При отсутствии полной оплаты билета в течении указанного срока - сумма бронирования не возвращается.</p>
        <?php if ($this->_tpl_vars['this']['children']): ?><p>У Вас <?php echo smarty_function_declension(array('count' => $this->_tpl_vars['this']['countchildren'],'form1' => "участник",'form2' => "участника",'form5' => "участников"), $this);?>
 плюс Вы.</p><?php endif; ?>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['this']['ucmObjs']): ?>
    <form action="<?php echo smarty_function_link(array('do' => 'addbooking'), $this);?>
" method="POST">
        <div class="agree"><input type="checkbox" name="agree" id="bookingagree" /> <label for="bookingagree">Я согласен с условиями бронирования</label></div>
        <br/>
        <select name="cardId">
            <option value="0">-- Оплатить новой картой --</option>
            <?php $_from = $this->_tpl_vars['this']['ucmObjs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['cardselect'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cardselect']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['card']):
        $this->_foreach['cardselect']['iteration']++;
?>
            <option value="<?php echo $this->_tpl_vars['card']->id; ?>
"<?php if (($this->_foreach['cardselect']['iteration'] == $this->_foreach['cardselect']['total'])): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['card']->cardnumber; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
        <br/>
        <button id="submit-btn" type="submit" class="btn btn-black">Забронировать</button>
    </form>
    <?php else: ?>
    <form action="<?php echo smarty_function_link(array('do' => 'addbooking'), $this);?>
" onsubmit="yaCounter28771811.reachGoal('zabronirovat-booking'); return true" method="post">
        <div class="agree"><input type="checkbox" name="agree" id="bookingagree" /> <label for="bookingagree">Я согласен с условиями бронирования </label></div>
        <br/>
        <button id="submit-btn" type="submit" class="btn btn-black">Забронировать</button>
    </form>
    <?php endif; ?>
</div>